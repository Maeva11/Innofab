<?php $el = @$data['datasblock'];?>
<div class="card col-10 offset-1">
    <div class="card-header card-header-tabs card-header-primary">
        <div class="nav-tabs-navigation">
            <div class="nav-tabs-wrapper">
                <span class="nav-tabs-title">Blocks</span>
                <ul class="nav nav-tabs float-right">

                    <li class="nav-item"><a class="nav-link active" href="<?= ADMIN_URL ?>blockBuilder"><i
                                    class="material-icons">code</i> Retour</a></li>
                </ul>
            </div>
        </div>
    </div>
    <form method='POST' class="card-body row">
        <?php if (@$_GET['trad'] == "en") {
            echo Tools::generateInput("hidden", "", "trad", "en");
        } ?>
        <?= Tools::generateInput('text', 'Nom du bloc', 'name', @$el->name, 'col-6'); ?>
        <?= Tools::generateInput("radio", "Active", "active", @$el->active, 'col-6', '', ['oui'=> 1, 'non'=>0]); ?>

        <div class="is_crud col-12">
            <?php
            $block_crud[] = "Choisissez un Block";
            foreach (scandir("../themes/blocks") as $bc) {
                if ($bc != ".." && $bc != ".") {
                    $block_crud[explode(".", $bc)[0]] = explode(".", $bc)[0];
                }
            }
            ?>
            <?= Tools::generateSelect('Block du crud', 'crud_block', $block_crud, @$el->crud_block, 'col-6'); ?>
        </div>
        <div class="not-crud col-12">
            <h3 class="col-12">Structure</h3>
            <div class="row">
                <?= Tools::generateInput('textarea', '', 'structure', htmlentities(@$el->structure), 'col-7 not-tiny', '<section>Ma structure</section>'); ?>
                <div class="advices col-5">
                    <h2>  &#128161;Conseils : </h2>
                    <p>Rajoutez sur la section la classe <strong>"editable-nomblock"</strong> </p>
                    <p>Exemple : &lt;section class="editable-listingactu"&gt; </p>
                </div>
            </div>
        </div>
        <?= Tools::generateInput('hidden', '', 'id', @$el->id); ?>
        <?= Tools::generateInput('submit', '', '', 'Valider', 'btn-style2'); ?>
    </form>
</div>