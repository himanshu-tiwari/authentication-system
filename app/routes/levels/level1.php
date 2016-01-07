<?php

$app->get('/levels/level1', function() use($app){
	$app->render('levels/level1.php');
})->name('levels.level1');

?>