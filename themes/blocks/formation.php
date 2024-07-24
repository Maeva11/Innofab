<?php
$Formations = new Formation();
$formations = $Formations->getBy(['active' => 1]);
?>


<div class="container mt-5">
    <div class="row">
        <?php foreach ($formations as $formation) { ?>
            <div class="col-12 col-md-6 mb-4" style="padding: 0">
                <div class="card">
                    <img src="<?= $formation->image ?>" alt="Nos formations" class="card-img">
                    <div class="overlay"></div>
                    <div class="content">
                        <h2>Nos formations</h2>
                        <p>Vous souhaitez apprendre à utiliser une machine, des logiciels open source?</p>
                        <hr class="separator">
                        <a href="/contact">En savoir plus</a>
                    </div>
                </div>
            </div>
        <?php } ?>
