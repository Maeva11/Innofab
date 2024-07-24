<?php
include '../../classes/Articles.php';
$Articles = new Articles();
$articles = $Articles->getBy(['active' => 1]);

$last_article = $Articles->getBy(['active' => 1], "date_add", "DESC", 1);
?>


<div class="last-actu-div d-flex align-items-center row" style="margin-top: 50px">
    <?php if ($last_article[0]->image) { ?>
        <div class="last-actu-image-div d-flex justify-content-end col-6">
            <img class="last-actu-image" src="..<?= $last_article[0]->image ?>" alt="image">
        </div>
    <?php } ?>
    <div class="last-actu-content w-25 col-<?php echo $last_article[0]->image ? '6' : '12'; ?>">
        <div class="row">
            <span class="last-actu-title mb-3 col-12"><?= $last_article[0]->titre ?></span>
            <span class="last-actu-desc mb-3 col-12"><?= $last_article[0]->description ?></span>
            <span class="last-actu-author mb-4 col-12"><?= $last_article[0]->auteur ?></span>
            <a href="<?= URL . URI ?>article/<?= $last_article[0]->id ?>/<?= Tools::slug_file($last_article[0]->titre) ?>"
               class="actu-button w-25 col-12">En savoir +</a>
        </div>
    </div>
</div>

<hr class="last-article-separation w-75">

<div class="row">
    <?php foreach ($articles as $article) { ?>
        <div class="col-6 article-div">
            <div class="row">
                <?php if ($article->image) { ?>
                    <img class="col-6" style="object-fit: cover" src="..<?= $article->image ?>" alt="image">
                <?php } else { ?>
                    <img class="col-6 no-img" src="/themes/assets/images/no_pic.png" alt="no image available">
                <?php } ?>

                <div class="card article-card d-flex flex-column col-6">
                    <div class="triangle-left"></div>
                    <span class="article-titre d-flex justify-content-center align-items-center mb-4"><?= $article->titre ?></span>
                    <div class="article-div-description">
                        <span class="article-description mb-4"><?= $article->description ?></span>
                        <hr class="article-separation w-75">
                    </div>
                    <span class="article-auteur d-flex justify-content-end align-items-end col-12"><?= $article->auteur ?></span>
                    <a href="<?= URL . URI ?>article/<?= $article->id ?>/<?= Tools::slug_file($article->titre) ?>"
                       class="actu-button d-flex align-items-center justify-content-center w-50 col-12">En savoir +</a>
                </div>
            </div>
        </div>
    <?php } ?>
