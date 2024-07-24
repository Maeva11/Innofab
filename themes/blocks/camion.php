<?php
include '../../classes/Machines.php';
$Machines = new Machines();
$machines = $Machines->getBy($where = ["is_camion" => 1]);
?>
<?php
include '../../classes/Articles.php';
$Articles = new Articles();
$articles = $Articles->getBy($where = ["categorie" => "Camion lieu"]);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camion Innofab</title>
</head>
<body>
    <div class="container">
        <div class="section bg-light py-5">
            <div class="container">
                <div class="header text-center mb-4">
                    <h2>Camion Innofab</h2>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <img src="/themes/assets/images/illustration_fabcamion.png" class="img-fluid rounded" alt="Camion nomCamion">
                    </div>
                    <div class="col-md-6">
                        <div class="text p-4 bg-white rounded shadow-sm">
                            <p>Nous avons créé un camion spécialement aménagé pour servir de lieu d'apprentissage, de partage et d'échange pour les Tarnais les plus éloignés du numérique. Ce véhicule est équipé de machines-outils variées, permettant d'offrir des ateliers pratiques et des formations adaptées à différents niveaux de compétence.</p>
                            <p>Notre objectif principal est de rapprocher ces personnes du monde numérique en leur proposant des formations de base et avancées en informatique et outils numériques. Pour concrétiser ce projet, nous avons également établi des partenariats avec les collectivités locales, les écoles et d'autres institutions afin d'optimiser l'impact et la portée de notre initiative.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="actualites my-5">
            <h2 class="text-center">Actualités</h2>
            <div class="articles-grid d-flex flex-wrap justify-content-center">
                <?php foreach ($articles as $article) { ?>
                    <div class="article-card bg-white m-3 p-3 rounded shadow-sm">
                        <img src="..<?= $article->image ?>" class="img-fluid rounded mb-3" alt="image">
                        <div class="article-content">
                            <h3><?= $article->titre ?></h3>
                            <p><?= $article->description ?></p>
                            <p class="author"><?= $article->auteur ?></p>
                            <a href="<?= URL . URI ?>article/<?= $article->id ?>/<?= Tools::slug_file($article->titre) ?>" class="btn btn-primary btn-camion">En savoir +</a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </section>
    </div>

    <h2 class="text-center">Nos machines</h2>

    <div class="listing-machines">
        <?php
            foreach($machines as $machine) {
        ?>
        <div class="machine-card" data-name="<?=$machine->nom?>">
            <div class="machine-color-feature"> 
                <div class="top-rectangle"></div>
                <div class="middle-rectangle"></div> 
                <div class="middle-ellipse"></div>
            </div>
            <?php
                if($machine->image) {
            ?>
                    <img class="machine-img" src="..<?=$machine->image?>"/>
            <?php
                } else {
            ?>
                    <img class="machine-no_img" src="/themes/assets/images/no_pic.png"/>
            <?php } ?>
            
            <span class="machine-nom"><?=$machine->nom?></span>
            <?php
                if($machine->tag)
                {
            ?>
                    <span class="machine-tag"><?=$machine->tag?></span>
            <?php
                }
            ?>
            <span class="machine-description"><?=$machine->info?></span>
            <a href="<?= URL . URI ?>machine/<?= $machine->id ?>/<?= Tools::slug_file($machine->nom) ?>"class="actu-button w-25 col-12">
                <div class="machine-detail-link">
                    <p>En savoir +</p>
                    <i class="fa-solid fa-circle-info info-icon"></i>
                </div>
            </a>
        </div>
        <?php
            }
        ?>
    </div>
</body>
</html>