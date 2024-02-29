<?php
include 'configuration.php';
use Slim\Factory\AppFactory;
require 'vendor/autoload.php';
$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);
use Slim\Exception\HttpNotFoundException;
@session_start();
include 'router/Get.php';
include 'router/Post.php';
$app->run();