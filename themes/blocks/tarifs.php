<?php
include '../assets/css/tarif.css';
?>
<?php
$Tarifs = new Tarifs();

$tarifs = $Tarifs->getBy(['active' => 1]);

// Tableau des suffixes pour les classes de cartes
$cardSuffixes = ['3', '2', '1', '2', '3'];
?>
<?php foreach ($tarifs as $i => $tarif) : ?>
    <?php
    $cardClass = 'tariff-card' . $cardSuffixes[$i % count($cardSuffixes)]; // Construire le nom de classe dynamiquement
    $headerClass = ($i % 2 == 0) ? 'tariff-header' : 'tariff-header1'; // Déterminer la classe de l'en-tête en fonction de $i
    ?>
    <span>
        <div class="<?= $cardClass; ?>">
            <div class="<?= $headerClass; ?>"><?= htmlspecialchars($tarif->title); ?></div>
            <!-- Utiliser la classe de l'en-tête dynamique -->
            <div class="tariff-body">
                <div class="tariff-price"><div class="tariff-font-price">30</div>€
                <span>/ans</span></div>
            </div>
            <button class="tariff-button">CHOISIR</br>CETTE OFFRE</button>
        </div>
    </span>
<?php endforeach; ?>
