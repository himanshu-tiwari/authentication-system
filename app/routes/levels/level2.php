<?php

$app->get('/levels/level2', function() use($app){
	$app->render('levels/level2.php');
})->name('levels.level2');

?>