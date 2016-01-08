<?php

$app->get('/password-reset', $guest(), function() use($app){
	$request = $app->request;

	$email = $request->get('email');
	$identifier = $request->get('identifier');

	$hashedIdentifier = $app->hash->hash($identifier);

	$user = $app->user->where('email', $email)->first();

	if(!$user){
		$app->response->redirect($app->urlFor('home'));
	}

	if(!$user->recover_hash){
		$app->response->redirect($app->urlFor('home'));	
	}

	if(!$app->hash->hashCheck($user->recover_hash, $hashedIdentifier)){
		$app->response->redirect($app->urlFor('home'));
	}

	$app->render('auth/password/reset.php', [
		'email' => $user->email,
		'identifier' => $hashedIdentifier
	]);
})->name('password.reset');

$app->post('/password-reset', $guest(), function() use($app){
	$request = $app->request;

	$email = $request->get('email');
	$identifier = $request->get('identifier');

	$password = $request->post('password');
	$passwordConfirm = $request->post('password_confirm');

	$hashedIdentifier = $app->hash->hash($identifier);

	$user = $app->user->where('email', $email)->first();

	if(!$user){
		$app->response->redirect($app->urlFor('home'));
	}

	if(!$user->recover_hash){
		$app->response->redirect($app->urlFor('home'));	
	}

	if(!$app->hash->hashCheck($user->recover_hash, $identifier)){
		$app->response->redirect($app->urlFor('home'));
	}

	$v = $app->validation;

	$v->validate([
		'password' => [$password, 'required|min(6)'],
		'password_confirm' => [$passwordConfirm, 'required|matches(password)']
	]);

	if($v->passes()){
		$user->update([
			'password' => $app->hash->password($password),
			'recover_hash' => null
		]);

		$app->mail->send('email/auth/password/reset.php', [], function($message) use($user){
				$message->to($user->email);
				$message->subject('Your password has been reset');
		});

		$app->flash('global', 'Your password has been upadated. You can now sign in.');
		$app->response->redirect($app->urlFor('home'));
	}

	$app->render('auth/password/reset.php', [
		'errors' => $v->errors(),
		'email' => $user->email,
		'identifier' => $identifier
	]);

})->name('password.reset.post');

?>