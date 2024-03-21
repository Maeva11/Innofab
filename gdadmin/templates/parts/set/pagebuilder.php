<?php $el = @$data['dataspage']; ?>
<div class="card col-10 offset-1">
    <div class="card-header card-header-tabs card-header-primary">
        <div class="nav-tabs-navigation">
            <div class="nav-tabs-wrapper">
                <span class="nav-tabs-title">Pages</span>
                <ul class="nav nav-tabs float-right">
                    <li class="nav-item mr-3"><a class="nav-link active" href="javascript:history.go(-1)"><i
                                    class="fas fa-arrow-left"></i> Retour</a></li>
                </ul>
            </div>
        </div>
    </div>
    <form method="POST" class="card-body pagebuilder" enctype="multipart/form-data">
        <div class="tab-content">
            <div class="tab-pane active">
                <div class="row">
                    <?= Tools::generateInput("text", "Nom de la page", "nom", @$el->nom, 'col-md-3') ?>
                    <?= Tools::generateInput("text", "Titre SEO", "title", @$el->title, 'col-md-3') ?>
                    <?= Tools::generateInput("text", "Url de la page", "url", @$el->url, 'col-md-6') ?>
                    <?= Tools::generateInput("textarea", "Description SEO", "description", @$el->description, 'col-md-12') ?>

                    <?php
                    foreach ((new Pagebuilder())->getAll() as $pages) {
                        if (@$pages->id != @$el->id)
                            $option[$pages->id] = $pages->nom;
                    }
                    ?>
                    <?= Tools::generateInput("select", "Page parent", "parent", @$el->parent, "col-6", "Page parente", $option); ?>
                    <?php
                    $option = [];
                    // foreach (LANGUAGES as $key => $value) {
                    //     $option[$key] = $value;
                    //     if (count(LANGUAGES) == 1) {
                    //         echo Tools::generateInput("hidden", "", "LANG", $key, 'col-md-12');
                    //     }
                    // }
                    // if (count(LANGUAGES) > 1) {
                    //     echo Tools::generateInput("select", "Choisissez la langue de votre page", "LANG", @$el->LANG, "col-6", "Langue de la page", $option);
                    // }
                    // ?>
                    <br>
                    <?= Tools::generateInput('hidden', '', 'id', @$el->id); ?>
                    <?= Tools::generateInput('submit', '', '', 'Valider', 'btn-style2 float-right'); ?>
                </div>
            </div>
        </div>
    </form>
</div>