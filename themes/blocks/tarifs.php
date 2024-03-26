<?php
$Tarifs = new Tarifs();

$tarifs = $Tarifs->getBy(['active' => 1]);
?>

<div class="heleo"> <?php
    foreach ($tarifs as $tarif) { ?>

        <span> <?= $tarif->title ?> </span>
        <?php
    }
    ?>
