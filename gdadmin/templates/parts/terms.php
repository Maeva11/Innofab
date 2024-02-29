<?php $data = @$data['datas'];?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/js-yaml/3.6.0/js-yaml.min.js"></script>
<div class="card col-10 offset-1">
    <div class="card-header card-header-tabs card-header-primary">
        <div class="nav-tabs-navigation">
            <div class="nav-tabs-wrapper">
                <span class="nav-tabs-title">Adminbuilder</span>
                <ul class="nav nav-tabs float-right" data-tabs="tabs">
                    <li class="nav-item mr-3"><a class="nav-link active" href="javascript:history.go(-1)" ><i class="fas fa-arrow-left"></i> Retour</a></li>
                </ul>
            </div>
        </div>
    </div>
    <form method="post" action="<?= ADMIN_URL ?>terms">
        <div class="card-body">
            <div class="tab-content row">
                <?php foreach ($data as $el){ ?>
                <?= Tools:: generateInput('hidden', '', 'id[]', $el->id); ?>
                <?= Tools:: generateInput('text', 'Titre', 'titre[]', @$el->titre, 'col-6'); ?>
                <?= Tools:: generateInput('text', 'Sous titre', 'sous_titre[]', @$el->sous_titre, 'col-6'); ?>
                <?= Tools:: generateInput('textarea', 'contenu', 'contenu[]', @$el->contenu, 'col-12'); ?>
                <?php } ?>
                <div class="new-section col-12 row">

                </div>
                <div class="d-flex justify-content-end col-12">
                    <?= Tools::generateInput('submit', '', '', 'Ajouter une section', 'btn-style2 new-terms mr-3'); ?>
                    <?= Tools::generateInput('submit', '', '', 'Valider', 'btn-style2'); ?>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="clone-terms d-none">
    <?= Tools:: generateInput('hidden', '', 'id[]', '', ''); ?>
    <?= Tools:: generateInput('text', 'Titre', 'titre[]', '', 'col-6'); ?>
    <?= Tools:: generateInput('text', 'Sous titre', 'sous_titre[]', '', 'col-6'); ?>
    <?= Tools:: generateInput('textarea', 'contenu', 'contenu[]', '', 'col-12'); ?>
</div>