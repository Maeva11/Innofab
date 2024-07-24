<?php $el = @$data['datas']; ?>
<div class="card col-10 offset-1">
    <div class="card-header card-header-tabs card-header-primary">
        <div class="nav-tabs-navigation">
            <div class="nav-tabs-wrapper">
                <span class="nav-tabs-title">Article</span>
                <ul class="nav nav-tabs float-right">
                    <li class="nav-item mr-3"><a class="nav-link active" href="javascript:history.go(-1)" ><i class="fas fa-arrow-left"></i> Retour</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="tab-content">
            <div class="tab-pane active">
                <form class="row" method="post" enctype="multipart/form-data">
                <?= Tools::generateInput("text", "Titre", "titre", @$el->{"titre"._PREFIX_LANG_}, "col-6"); ?>
                <?= Tools::generateInput("date", "Date", "date_add", @$el->date_add, "col-6"); ?>
                <?= Tools::generateInput("text", "Categorie", "categorie", @$el->{"categorie"._PREFIX_LANG_}, "col-6"); ?>
                <?= Tools::generateInput("text", "Auteur", "auteur", @$el->auteur, "col-6"); ?>
                <?= Tools::generateInput("textarea", "Résumé", "description", @$el->{"description"._PREFIX_LANG_}, "col-6"); ?>
                <?= Tools::generateInput("textarea", "Contenu", "texte", @$el->{"texte"._PREFIX_LANG_}, 'col-6'); ?>

                <?= Tools::generateInput("file", "Illustration", "image", @$el->image, 'col-12'); ?>
                <?= Tools::generateInput("radio", "Publié ?", "active", @$el->active, 'col-6', '', ['oui'=> 1, 'non'=>0]); ?>
                <?= Tools::generateInput("radio", "En-avant ?", "en_avant", @$el->en_avant, 'col-6', '', ['oui'=> 1, 'non'=>0]); ?>
                <?= Tools::generateInput("hidden", "", "id", @$el->id); ?>
                <?= Tools::generateInput("submit", "", "", "Valider", "btn-style2 float-right"); ?>
                </form>
            </div>
        </div>
    </div>
</div>
