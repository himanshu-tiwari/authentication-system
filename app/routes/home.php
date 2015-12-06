<?php

$app->get('/', function() use($app){
	$app->render('home.php');
})->name('home');

$app->get('/flash', function() use($app){
	$app->flash('global', 'Registered');
	$app->response->redirect($app->urlfor('home'));
});


?>