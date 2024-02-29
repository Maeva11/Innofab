<?php $el = @$data['dataspage']; ?>
<div class="card col-10 offset-1">
    <div class="card-header card-header-tabs card-header-primary">
        <div class="nav-tabs-navigation">
            <div class="nav-tabs-wrapper">
                <span class="nav-tabs-title">Pages</span>
                <ul class="nav nav-tabs float-right">
                    <?php if (@$_GET['trad'] == "en") { ?>
                        <li class="nav-item mr-3"><a class="nav-link active" href="?trad=fr"><i
                                        class="fas fa-globe"></i> Français</a></li>
                    <?php } else { ?>
                        <li class="nav-item mr-3"><a class="nav-link active" href="?trad=en"><i
                                        class="fas fa-globe"></i> Anglais</a></li>
                    <?php } ?>
                    <li class="nav-item mr-3"><a class="nav-link active" href="javascript:history.go(-1)"><i
                                    class="fas fa-arrow-left"></i> Retour</a></li>
                </ul>
            </div>
        </div>
    </div>
    <form method="POST" class="card-body pagebuilder" enctype="multipart/form-data">
        <?php if (@$_GET['trad'] == "en") {
            echo Tools::generateInput("hidden", "", "trad", "en");
        } ?>
        <div class="tab-content">
            <div class="tab-pane active">
                <div class="row">
                    <?php if (@$_GET['trad'] != "en") { ?>
                        <?= Tools::generateInput("text", "Nom de la page", "nom_page", @$el->nom, 'col-md-4') ?>
                        <?= Tools::generateInput("text", "Url de la page", "url_page", @$el->url, 'col-md-4') ?>
                        <?php
                        foreach ((new Pagebuilder())->getAll() as $pages){
                            if($pages->id != $el->id)
                                $option[$pages->id] = $pages->nom;
                        }
                        ?>
                        <?= Tools::generateInput("select", "Page parent", "parent",  @$el->parent, "col-4", "Page parente", $option); ?>

                    <?php } ?>
                    <div class="col-12 d-inline-flex align-items-center">
                        <?php
                        $params[''] = 'Choisir un bloc';
                        foreach ((new Blockbuilder())->getAll() as $value) {
                            $params[$value->id] = $value->nom;
                        }
                        ?>
                        <?= Tools::generateSelect('', '', $params, '', 'col-3 GenerateBlock'); ?>
                        <?= Tools::generateInput('submit', '', '', '+ Ajouter', 'btn-style2 GenerateBlock'); ?>
                    </div>
                    <div class="dragDrop blocks-content col-12">
                        <?php
                        if (@$_GET['trad'] == "en") {
                            $datas = json_decode($el->datas_en);
                        } else {
                            $datas = json_decode($el->datas);
                        }
                        foreach ($datas as $blocks) {
                            echo (new Pagebuilder())->generateBlocks($blocks);
                        } ?>
                    </div>
                    <?= Tools::generateInput('hidden', '', 'id_page', @$el->id); ?>
                    <?= Tools::generateInput('submit', '', '', 'Valider', 'btn-style2 float-right'); ?>
                </div>
            </div>
        </div>
    </form>
</div>
