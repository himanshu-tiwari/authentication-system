<?php

use Slim\Slim;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;

use Noodlehaus\Config;

use project\User\User;

session_cache_limiter(false);
session_start();

ini_set('display_errors', '1');
error_reporting(E_ALL);

define('INC_ROOT' , dirname(__DIR__));

require INC_ROOT.'/vendor/autoload.php';

$app = new Slim([
   'mode' => file_get_contents(INC_ROOT.'/mode.php'),
   'view' =>new Twig(),
   'templates.path' => INC_ROOT.'/app/Views'
]);

$app->configureMode($app->config('mode'), function() use($app){
    $app->config =Config::load(INC_ROOT."/app/config/{$app->mode}.php");
});

require 'database.php';
require 'routes.php';

$app->container->set('user', function(){
	return new User;
});

$app->get('/', function() use($app){
	$app->render('home.php');
});

$view = $app->view();

$view->parserOptions = [
     'debug' => $app->config->get('twig.debug')
];

$view->parserExtensions = [
     new TwigExtension
];

?>