<?php

$app->get('/levels', function() use($app){
	$app->render('levels/levels.php');
})->name('levels');

?>