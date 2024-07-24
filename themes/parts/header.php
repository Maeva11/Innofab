<?php
session_start(); // Assurez-vous que la session est démarrée

function isCurrentPage($page)
{
    $url = $_SERVER['REQUEST_URI'];
    if ($page === '/') {
        return ($url === '/');
    } else {
        return (strpos($url, $page) !== false);
    }
}

$pages = [
    '/' => 'Accueil',
    '/machines' => 'Machines',
    '/les-actualites' => 'Actualités',
    '/tarifs' => 'Tarifs',
    '/contact' => 'Contact',
];

// Déterminez l'URL de connexion en fonction de la session utilisateur
$connexionUrl = isset($_SESSION['user']) ? '/utilisateur' : '/connexion';
?>

<div class="navbar-main">
    <img class="img-gauche" src="/themes/assets/images/BandeGauche.png"/>
    <img class="img-droite" src="/themes/assets/images/BandeDroite.png"/>
    <a href="/" class="lien-logo"><img class="logo-img" src="/themes/assets/images/logo-innofab-orange.jpeg"/></a>
    <ul>
        <?php foreach ($pages as $url => $label) { ?>
            <li>
                <a href="<?= $url ?>" class="<?= (isCurrentPage($url)) ? "active" : ""; ?>">
                    <?= $label ?>
                </a>
            </li>
        <?php } ?>
        <div class="div-connexion-header">
            <div class="connexion-header">
                <a href="<?= $connexionUrl ?>" class="<?= (isCurrentPage($connexionUrl)) ? "active" : ""; ?>">
                    <?= isset($_SESSION['user']) ? 'Mon compte' : 'Connexion' ?>
                </a>
            </div>
        </div>
    </ul>
</div>
