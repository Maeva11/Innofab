<div class="container contact">
    <p class="info">Besoin d'informations ? nous sommes là pour répondre à vos questions</p>
    <div class="row">
        <?= Tools::showFlash(); ?>
        <form method="post" action="<?= URL.URI ?>contact" class="col-lg-7">
            <?= Tools::generateInput("text", "Votre nom", "nom"); ?>
            <?= Tools::generateInput("text", "Votre e-mail", "email"); ?>
            <?= Tools::generateInput("text", "Votre n° de téléphone", "telephone"); ?>
            <?= Tools::generateInput("textarea", "Votre message", "message"); ?>
            <input type="submit" class="btn-avis" value="Envoyez">
        </form>
        <ul class="informations col-lg-5">
            <li>
                <p><?= Tools::getValue("Adresse ligne 1") ?></p>
                <p><?= Tools::getValue("Téléphone") ?></p>
                <p><?= Tools::getValue("E-mail") ?></p>
            </li>
        </ul>
    </div>
</div>
