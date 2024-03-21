<!doctype html>
<html lang="FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="<?= @$data["page"]->description ?>">
    <?php
    $uri = $_SERVER['REQUEST_URI'];
    $segments = explode('/', $uri); ?>

    <title><?= empty(@$data['page']->title) ? ucfirst(str_replace('-', ' ', $segments[1])) . " - " . WEBSITE_NAME : @$data['page']->title . " - " . WEBSITE_NAME ?></title>
    <link rel="icon" type="image/png" sizes="32x32" href="/themes/assets/favicon.png">
    <?php include(__DIR__ . '/parts/auth_head.php') ?>

    <!--CSS CMS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!--CSS CMS-->

    <script async src="https://www.googletagmanager.com/gtag/js?id=CODE-GTAG"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'CODE-GTAG');
    </script>
</head>

<body id="page-<?= @$data["page"]->id ?>" data-id="<?= @$data["page"]->id ?>"
      class="<?= @$data["page"]->nom ?>">
<?php include("blocks/banniere.php"); ?>
<?php include("parts/header.php"); ?>
<?= $data["structure"];
if (!empty($_SESSION["auth"]) && $_SESSION["auth"] == 'true' && $_SESSION["role"] == 'root') {
    echo '<section data-add="add" id="add"> +</section>';
} ?>
<?php include("parts/footer.php"); ?>
<?php if ($_SESSION["auth"] == 'true' && $_SESSION["role"] == 'admin' || $_SESSION["role"] == 'root') {
    include 'gdadmin/templates/accueil.php';
    echo '<script type="text/javascript" src="/gdadmin/assets/js/script.js"/>';
    ?>
    <!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/dropify@0.2.2/dist/js/dropify.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?php
} ?>

</body>
</html>