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
</head>
<style>
    html {
        height: 100%;
    }

    body {
        margin: 0;
        padding: 0;
        font-family: sans-serif;
        background: linear-gradient(#141e30, #243b55);
    }

    .login-box {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 400px;
        padding: 40px;
        transform: translate(-50%, -50%);
        background: rgba(0, 0, 0, .5);
        box-sizing: border-box;
        box-shadow: 0 15px 25px rgba(0, 0, 0, .6);
        border-radius: 10px;
    }

    .login-box h2 {
        margin: 0 0 30px;
        padding: 0;
        color: #fff;
        text-align: center;
    }

    .login-box .user-box {
        position: relative;
    }

    .login-box .user-box input {
        width: 100%;
        padding: 10px 0;
        font-size: 16px;
        color: #fff;
        margin-bottom: 30px;
        border: none;
        border-bottom: 1px solid #fff;
        outline: none;
        background: transparent;
    }

    .login-box .user-box label {
        position: absolute;
        top: 0;
        left: 0;
        padding: 10px 0;
        font-size: 16px;
        color: #fff;
        pointer-events: none;
        transition: .5s;
    }

    .login-box .user-box input:focus ~ label,
    .login-box .user-box input:valid ~ label {
        top: -20px;
        left: 0;
        color: #e91e63;
        font-size: 12px;
    }


    .styled-button {
        position: relative;
        display: inline-block;
        padding: 10px 20px;
        color: #e91e63;
        font-size: 16px;
        text-decoration: none;
        text-transform: uppercase;
        overflow: hidden;
        transition: .5s;
        margin-top: 40px;
        letter-spacing: 4px;
        background: transparent;
        border: none;
    }

    .styled-button:hover {
        background: #e91e63;
        color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 5px #e91e63,
        0 0 25px #e91e63,
        0 0 50px #e91e63,
        0 0 100px #e91e63;
    }

    .styled-button span {
        position: absolute;
        display: block;
    }

    .styled-button span:nth-child(1) {
        top: 0;
        left: -100%;
        width: 100%;
        height: 2px;
        background: linear-gradient(195deg, #EC407A 0%, #D81B60 100%);
        animation: btn-anim1 1s linear infinite;
    }

    @keyframes btn-anim1 {
        0% {
            left: -100%;
        }
        50%, 100% {
            left: 100%;
        }
    }

    .styled-button span:nth-child(2) {
        top: -100%;
        right: 0;
        width: 2px;
        height: 100%;
        background: linear-gradient(195deg, #EC407A 0%, #D81B60 100%);
        animation: btn-anim2 1s linear infinite;
        animation-delay: .25s
    }

    @keyframes btn-anim2 {
        0% {
            top: -100%;
        }
        50%, 100% {
            top: 100%;
        }
    }

    .styled-button span:nth-child(3) {
        bottom: 0;
        right: -100%;
        width: 100%;
        height: 2px;
        background: linear-gradient(195deg, #EC407A 0%, #D81B60 100%);
        animation: btn-anim3 1s linear infinite;
        animation-delay: .5s
    }

    @keyframes btn-anim3 {
        0% {
            right: -100%;
        }
        50%, 100% {
            right: 100%;
        }
    }

    .styled-button span:nth-child(4) {
        bottom: -100%;
        left: 0;
        width: 2px;
        height: 100%;
        background: linear-gradient(195deg, #EC407A 0%, #D81B60 100%);
        animation: btn-anim4 1s linear infinite;
        animation-delay: .75s
    }

    @keyframes btn-anim4 {
        0% {
            bottom: -100%;
        }
        50%, 100% {
            bottom: 100%;
        }
    }
</style>

<div class="login-box">
    <h2><?= WEBSITE_NAME ?></h2>
    <form method="post">
        <div class="user-box">
            <input type="text" name="identifiant" required="">
            <label>Nom d'utilisateur</label>
        </div>
        <div class="user-box">
            <input type="password" name="password" required="">
            <label>Mot de passe</label>
        </div>
        <button type="submit" class="styled-button">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            Connexion
        </button>
    </form>
</div>
</html>