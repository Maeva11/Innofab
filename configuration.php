<?php
setlocale(LC_TIME, 'fr_FR');
/***CDN JQUERY DEFINE***/
DEFINE('JQUERY', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js');
DEFINE('JQUERY_UI', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js');

/***CDN BOOTSTRAP DEFINE***/
DEFINE('BOOTSTRAP_CSS', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css');
DEFINE('BOOTSTRAP_JS', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js');

/***GLOBAL DEFINE***/
define('DB_PREFIX', 'gd_');
define('WEBSITE_NAME', 'GDCMS');
define('URL', 'https://' . $_SERVER['HTTP_HOST']);
define('URI', '/');
define('LANG', 'FR');//$_SESSION['lang'] = "EN"; pour la traduction en anglais
@session_start();
(!isset($_SESSION['lang']))? $_SESSION['lang'] = LANG : "";
define('_PREFIX_LANG_', (@$_SESSION['lang'] == 'EN') ? "_en" :  "");

/***DIR DEFINE***/
define('ADMIN_URL',URI. 'gdadmin/');
define('THEME_DIR', URI.'themes/');
define('ASSETS_DIR', THEME_DIR . 'assets/');
define('CSS_DIR', ASSETS_DIR . 'css/');
define('JS_DIR', ASSETS_DIR . 'js/');
define('IMG_DIR', ASSETS_DIR . 'images/');
define('UPLOAD_DIR', ASSETS_DIR . 'upload/');
/**TOKEN CLIENT TMA**/
define('TOKEN_TMA', "");//TOKEN API TINYPNG
/***DEBUG TINYPNG***/
define('API_TPNG', "DMlCyCfl0v6cPThk9M1b9fRTyL275qnZ");//TOKEN API TINYPNG
define('DEBUG_TPNG', TRUE);
/*********USER*********/
define('USER_FILE', "/");//Redirection user après connexion & inscription
require 'acces.php';
if (!defined('DB_NAME')) {
    if($_SERVER['PHP_SELF'] != "/install.php"){
        header('location: '.URL.'/install.php');
        die();
    }
} elseif (file_exists("install.php")) {
    unlink("install.php");
}

/***Require Classes***/
require 'classes/Controller.php';
require 'classes/GWModel.php';
require 'classes/Tools.php';
require __DIR__ . '/classes/Favicon.php';
require __DIR__ . '/classes/Admin.php';
require __DIR__ . '/classes/Upload.php';
require __DIR__ . '/classes/Mail.php';
require __DIR__ . '/classes/Auth.php';
require __DIR__ . '/classes/GenerateForm.php';
require __DIR__ . '/classes/Blockbuilder.php';
require __DIR__ . '/classes/Pagebuilder.php';
require __DIR__ . '/classes/Articles.php';
//require __DIR__ . '/classes/Configuration.php';

//require __DIR__ . '/classes/MenuAdmin.php';
