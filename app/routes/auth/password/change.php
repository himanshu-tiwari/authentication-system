<?php

$app->get('/change-password', $authenticated(), function() use($app){
	$app->render('auth/password/change.php');
})->name('password.change');

$app->post('/change-password', $authenticated(), function() use($app){
	$request = $app->request;

	$passwordOld = $app->request->post('password_old');
	$password = $app->request->post('password');
	$passwordConfirm = $app->request->post('password_confirm');

	$v = $app->validation;

	$v->validate([
		'password_old' => [$passwordOld, 'required|matchesCurrentPassword'],
		'password' => [$password, 'required|min(6)'],
		'password_confirm' => [$passwordConfirm, 'required|matches(password)']
	]);

	if($v->passes()){
		$user = $app->auth;
		
		$user->update([
			'password' => $app->hash->password($password)
		]);

		$app->mail->send('email/auth/password/changed.php', [], function($message) use($user){
			$message->to($user->email);
			$message->subject('Your password has been changed.');
		});

		$app->flash('global', 'Your password has been updated!');
		return $app->response->redirect($app->urlFor('home'));
	}

	$app->render('auth/password/change.php', [
		'errors' => $v->errors()
	]);
})->name('password.change.post');

?>