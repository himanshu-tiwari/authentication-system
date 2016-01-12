<?php

use Slim\Slim;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;

use Noodlehaus\Config;
use RandomLib\Factory as RandomLib;

use project\User\User;
use Mailgun\Mailgun;
use project\Mail\Mailer;
use project\Helpers\Hash;
use project\Validation\Validator;

use project\Middleware\BeforeMiddleware;
use project\Middleware\CsrfMiddleware;

session_cache_limiter(false);
session_start();

ini_set('display_errors', '1');
error_reporting(E_ALL);

define('INC_ROOT' , dirname(__DIR__));

require INC_ROOT.'/vendor/autoload.php';

$app = new Slim([
   'mode' => file_get_contents(INC_ROOT.'/mode.php'),
   'view' => new Twig(),
   'templates.path' => INC_ROOT.'/app/views'
]);

$app->add(new BeforeMiddleware);
$app->add(new CsrfMiddleware);

$app->configureMode($app->config('mode'), function() use($app){
    $app->config = Config::load(INC_ROOT."/app/config/{$app->mode}.php");
});

require 'database.php';
require 'filters.php';
require 'routes.php';

$app->auth = false;

$app->container->set('user', function(){
	return new User;
});

$app->container->singleton('hash', function() use($app){
	return new Hash($app->config);
});

$app->container->singleton('validation', function()use($app){
	return new Validator($app->user, $app->hash, $app->auth);
});

$app->container->singleton('mail', function() use($app){
  $mailer = new Mailgun($app->config->get('mail.secret'));

  return new Mailer($app->view, $app->config, $mailer);
});

$app->container->singleton('randomlib', function(){
  $factory = new RandomLib;
  return $factory->getMediumStrengthGenerator();
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