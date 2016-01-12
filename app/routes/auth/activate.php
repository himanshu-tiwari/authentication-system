<?php

$app->get('/activate', $guest(), function() use($app){
	$request = $app->request;

	$email = $request->get('email');
	$identifier = $request->get('identifier');

	$hashedIdentifier = $app->hash->hash($identifier);

	$user = $app->user->where('email', $email)
	       ->where('active', false)
	       ->first();

	if(!$user || !$app->hash->hashCheck($user->active_hash, $hashedIdentifier)){
		$app->flash('global', 'There was a problem activating your account!');
		return $app->response->redirect($app->urlFor('home'));
	}else{
		$user->activateAccount();
		$app->flash('global', 'Your account has been activated! You can now sign in.');
		return $app->response->redirect($app->urlFor('home'));

	}

})->name('activate');

?>