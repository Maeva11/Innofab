<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= WEBSITE_NAME ?></title>
    <?= (!empty(BOOTSTRAP_CSS)) ? Tools::mapCss(BOOTSTRAP_CSS) : ''; ?>
    <?= Tools::mapCss(CSS_DIR . '/GDfirst.css'); ?>
    <style>
        body{background:#eeeeee;}
        form{
            background:#fff;
            padding:35px;
            border-radius:1em;
            width: 450px;
            box-shadow:0 0 20px 3px #1a1a1a;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }
        form h1{
            text-align: center;
            letter-spacing: 1px;
            font-weight: 400;
        }
        form input[type="submit"], a{
            background: #53a83b;
            color:#fff;
            border:0;
        }
        form a, form a:hover{
            text-decoration: none;
            padding: 10px;
            width: 100%;
            display: block;
            text-align: center;
            border-radius: 0.2em;
            color:#fff;
        }
        form p{
            font-size: 18px;
            text-align: center;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <form method="post">
        <h1><?= WEBSITE_NAME ?></h1>
        <?php if((new Auth)->VerifKey(@$data['key'])){ ?>
            <?= Tools::generateInput('password', 'Nouveau mot de passe', 'password'); ?>
            <?= Tools::generateInput('password', 'Répétez le mot de passe', 'passwordRepeat'); ?>
            <?= Tools::generateInput('submit', '', '', 'Confirmer'); ?>
        <?php }else{?>
        <p>Votre session a expiré, merci de procédé a une nouvelle demande !</p>
        <a href="/">Retourner sur <?= WEBSITE_NAME ?></a>
        <?php } ?>
    </form>
</body>
</html>