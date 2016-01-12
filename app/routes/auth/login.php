<?php

use Carbon\Carbon;

$app->get('/login', $guest(), function() use($app){
	$app->render('auth/login.php');
})->name('login');

$app->post('/login', $guest(), function() use($app){
	$request = $app->request;

	$identifier = $request->post('identifier');
	$password = $request->post('password');
	$remember = $request->post('remember');

	$v = $app->validation;
	$v->validate([
		'identifier'=>[$identifier, 'required'],
		'password'=>[$password, 'required']
	]);

	if($v->passes()){
		$user = $app->user
				->where('active', true)
				->where(function($query) use($identifier){
					return $query->where('username', $identifier)
						->orWhere('email', $identifier);
				})->first();

		$user->updateLogInStatus();

		if($user && $app->hash->passwordCheck($password, $user->password)){
			$_SESSION[$app->config->get('auth.session')] = $user->id;
			
			if ($remember == 'on') {
				$rememberIdentifier = $app->randomlib->generateString(128);
				$rememberToken = $app->randomlib->generateString(128);

				$user->updateRememberCredentials(
					$rememberIdentifier,
					$app->hash->hash($rememberToken)
				);

				$app->setCookie(
					$app->config->get('auth.remember'),
					"{$rememberIdentifier}___{$rememberToken}",
					Carbon::parse('+1 week')->timestamp
				);
			}

			$app->flash('global', 'you are now signed in!');
			return $app->response->redirect($app->urlFor('home'));
		}

		else{
			$app->flash('global', 'Sorry, you couldn\'t be logged in.');
			return $app->response->redirect($app->urlFor('login'));
		}
   	}

	$app->render('auth/login.php',[
		'errors'=>$v->errors(),
		'request'=>$request
	]);

})->name('login.post');

?>