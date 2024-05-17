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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" >

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <!--CSS CMS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/2bsbhghbkkt0wuumdefn8c5b3rik9fbveft0etfo1pn0sivj/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,700;1,400&display=swap"
          rel="stylesheet">

    <link href="/themes/source/css/bootstrap.min.css" rel="stylesheet">
    <link href="/themes/source/css/bootstrap-icons.css" rel="stylesheet">
    <link href="/themes/source/css/tooplate-clean-work.css" rel="stylesheet">
    <link href="/themes/assets/css/GDfirst.css" rel="stylesheet">
    <link href="/themes/assets/css/tarif.css" rel="stylesheet">
    <link href="/themes/assets/css/actualites.css" rel="stylesheet">
    <link href="/themes/assets/css/machines.css" rel="stylesheet">
    <link href="/themes/assets/css/connexion.css" rel="stylesheet">
    <link href="/themes/assets/css/footer.css" rel="stylesheet">
    <link href="/themes/assets/css/header.css" rel="stylesheet">
    <link href="/themes/assets/css/rendezVous.css" rel="stylesheet">

    <script async src="https://www.googletagmanager.com/gtag/js?id=CODE-GTAG"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'CODE-GTAG');
    </script>
</head>

<body id="page-<?= @$data["page"]->id ?>" data-id="<?= @$data["page"]->id ?>"
      class="<?= @$data["page"]->nom ?> <?= ($_SESSION["auth"] == 'true' && $_SESSION["role"] == 'admin' || $_SESSION["role"] == 'root') ? "admin" : ""?>">

<div class="popup-overlay" id="editor-popup">
    <div class="popup-content">
        <textarea id="editor"></textarea>
        <button id="save" class="save-button"> Enregistrer
            <span></span>
        </button>
    </div>
</div>

<div class="popup-overlay" id="editor-dropify">
    <div class="popup-content">
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="file" id="file" class="dropify" data-max-file-size="2M" data-allowed-file-extensions="jpg jpeg png gif" />
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
</div>

<?php include("blocks/banniere.php"); ?>
<?php include("parts/header.php"); ?>
<?= $data["structure"];
if (!empty($_SESSION["auth"]) && $_SESSION["auth"] == 'true' && $_SESSION["role"] == 'root') {
    echo '<section data-add="add" id="add"> <span class="addblock"> + </span></section>';
    echo '<div class="display-popup"><div class="listing-block" id="listing-block"></div></div>';

    $html = '<div class="display-popup">
            <div class="listing-block d-flex" id="listing-block"><div class="row">';
    $BlockBuilder = new BlockBuilder();
    $blocks = $BlockBuilder->getBy(["active" => 1]);

    foreach ($blocks as $block) {
        $html .= '<div class="col-lg-4 block-item" data-id="' . $block->id . '">' . htmlspecialchars($block->name) . '</div>';
    }

    $html .= '  </div>
  </div>    
        </div>';

// Affichage du HTML
    echo $html;

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

<script src="/themes/source/js/jquery.min.js"></script>
<script src="/themes/source/js/bootstrap.min.js"></script>
<script src="/themes/source/js/jquery.backstretch.min.js"></script>
<script src="/themes/source/js/counter.js"></script>
<script src="/themes/source/js/countdown.js"></script>
<script src="/themes/source/js/init.js"></script>
<script src="/themes/source/js/modernizr.js"></script>
<script src="/themes/source/js/animated-headline.js"></script>
<script src="/themes/source/js/custom.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.1/owl.carousel.min.js"></script>
<script src="/themes/assets/js/rendezVous.js"></script>
<script src="/themes/assets/js/GDcustom.js"></script>

<script>
    // Chargement de l'API YouTube Player
    var tag = document.createElement('script');
    tag.src = 'https://www.youtube.com/iframe_api';
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    // Création de l'objet du lecteur YouTube
    var player;

    function onYouTubeIframeAPIReady() {
        player = new YT.Player('youtube-player', {
            height: '315',
            width: '300%',
            videoId: 'https://www.youtube.com/watch?v=RkH9dLdsRr8', // Remplacez 'VIDEO_ID' par l'identifiant réel de votre vidéo YouTube
            playerVars: {
                'autoplay': 0,
                'controls': 1,
                'rel': 0,
                'showinfo': 0
            },
            events: {
                'onReady': onPlayerReady
            }
        });
    }

    function onPlayerReady(event) {
        // Vous pouvez ajouter des actions supplémentaires ici si nécessaire
    }
</script>
</body>
</html>