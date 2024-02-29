<?= Tools::getValue("E-mail") ?>
<?php foreach ($app->Footer as $el) {
    if (!empty($el->footer) && $el->footer != 0) {?>
        <li><a href="<?= $el->url ?>"><?= $el->nom ?></a></li>
    <?php }
} ?>
<?= (!empty(BOOTSTRAP_JS)) ? Tools::mapJs(BOOTSTRAP_JS) : ''; ?>