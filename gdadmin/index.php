<?php
define('_PREFIX_LANG_', (@$_GET['trad'] == 'en') ? "_en" :  "");
include '../configuration.php';
@session_start();
if (empty($_SESSION["auth"]) || $_SESSION["auth"] != 'true') {
    header('Location: '.ADMIN_URL.'login.php');
    die();
}
use Slim\Factory\AppFactory;
require '../vendor/autoload.php';
$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);
$app->setBasePath('/gdadmin');

include 'AdminRoutes.php';
$app->run();

