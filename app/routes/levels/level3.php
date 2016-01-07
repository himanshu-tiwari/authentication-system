<?php

$app->get('/levels/level3', function() use($app){
	$app->render('levels/level3.php');
})->name('levels.level3');

?>