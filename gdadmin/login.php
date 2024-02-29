<?php
require_once '../configuration.php';
session_start();
if (!empty($_SESSION["auth"]) || @$_SESSION["auth"] == 'true') {
    header('Location: ' . ADMIN_URL);
    die();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    (new Admin())->connexion($_POST['identifiant'], $_POST['password']);
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connexion administrateur</title>
    <?= (!empty(BOOTSTRAP_CSS)) ? Tools::mapCss(BOOTSTRAP_CSS) : ''; ?>
    <?= Tools::mapCss(CSS_DIR . '/GDfirst.css'); ?>
    <style>
        body {
            background: #1a1a1a;
        }

        form {
            background: #fff;
            padding:60px 35px;
            border-radius: 1em;
            width: 500px;
            box-shadow: 0 0 50px -25px #eee;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        form h1 {
            text-align: center;
            letter-spacing: 1px;
            font-weight: 400;
        }

        form input[type="submit"], a {
            background: #53a83b;
            color: #fff;
            border: 0;
            font-weight: 400;
            line-height: 1.5;
            text-align: center;
            text-decoration: none;
            vertical-align: middle;
            cursor: pointer;
            padding: .375rem .75rem;
            font-size: 1rem;
            border-radius: .25rem;
            margin-top: 1em;
            width: 100%;
            transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }

        form a, form a:hover {
            text-decoration: none;
            padding: 10px;
            width: 100%;
            display: block;
            text-align: center;
            border-radius: 0.2em;
            color: #fff;
        }

        form p {
            font-size: 18px;
            text-align: center;
            font-weight: 600;
        }
    </style>
</head>
<body>
<form method="post">
    <h1><?= WEBSITE_NAME ?></h1>
    <?= Tools::generateInput('text', 'Votre identifiant', 'identifiant', '', '', 'Identifiant'); ?>
    <?= Tools::generateInput('password', 'Votre mot de passe', 'password', ''); ?>
    <?= Tools::generateInput('submit', '', '', 'Connexion'); ?>
    <a href="/">Retournez sur <?= WEBSITE_NAME ?></a>
</form>
</body>
</html>