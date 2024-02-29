<?php $el = @$data['datasblock'];?>
<div class="card col-10 offset-1">
    <div class="card-header card-header-tabs card-header-primary">
        <div class="nav-tabs-navigation">
            <div class="nav-tabs-wrapper">
                <span class="nav-tabs-title">Blocks</span>
                <ul class="nav nav-tabs float-right">
                    <?php if(@$_GET['trad'] == "en") { ?>
                        <li class="nav-item mr-3"><a class="nav-link active" href="?trad=fr" ><i class="fas fa-globe"></i> Français</a></li>
                    <?php }else{?>
                        <li class="nav-item mr-3"><a class="nav-link active" href="?trad=en" ><i class="fas fa-globe"></i> Anglais</a></li>
                    <?php } ?>
                    <li class="nav-item"><a class="nav-link active" href="<?= ADMIN_URL ?>blockBuilder"><i class="material-icons">code</i> Retour</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="card-body row">
        <?php if(@$_GET['trad'] == "en") { echo Tools::generateInput("hidden", "", "trad", "en"); } ?>
        <?= Tools::generateInput('text', 'Nom du block', 'name', @$el->nom, 'col-6'); ?>
        <?= Tools::generateInput('checkbox', 'Dublicable', 'duplicable', @$el->duplicable, 'col-2'); ?>
        <?= Tools::generateInput('checkbox', 'relié à un CRUD', 'crud', @$el->crud, 'col-2'); ?>
        <?= Tools::generateTextarea('Description', 'description', @$el->description, 'col-10'); ?>
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
            <?php
            $url[] = "Choisissez l'url du crud";
            foreach ((new Admin())->getDatas('', 'menu')['datas'] as $uc) {
            $url[ADMIN_URL.'crud/'.$uc->url] = $uc->nom;
            }
             ?>
            <?= Tools::generateSelect('Url du crud', 'crud_url', $url, @$el->crud_url, 'col-6'); ?>
        </div>
        <div class="not-crud col-12">
            <div class="tab-content mt-5  col-12">
                <div class="tab-pane active">
                    <table class="table dragDrop">
                        <tbody class="fields">
                        <?php
                        if (!empty($el->datas)) {
                            foreach (json_decode($el->datas) as $input) {
                                echo (new GenerateForm())->generateInputBuilder(0, $input);
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php
            $choices = [];
            foreach ($data['fields'] as $field) {
                $choices[$field->id] = $field->balise . ' ' . $field->type;
            }
            ?>
            <?= Tools::generateSelect('Type de champs', '', $choices, '', 'col-3 addfieldType'); ?>
            <?= Tools::generateInput('submit', '', '', '+ nouveau champ', 'btn-style2 addfield '); ?>
            <h3 class="col-12">Structure</h3>
            <div class="row">
                <?= Tools::generateInput('textarea', '', 'structure', @$el->structure, 'col-8 not-tiny', '<section>Ma structure</section>'); ?>
                <div class="tab-content mt-5  col-4">
                    <table class="table col-12">
                        <tbody class="duplicable">
                        <tr>
                            <td><span class="copie">Début Duplicable<input type="text" value="<duplicate>" class="inputCopie"></span></td>
                            <td><span class="copie">Fin Duplicable<input type="text" value="</duplicate>" class="inputCopie"></span></td>
                        </tr>
                        </tbody>
                        <tbody class="initVar"><tr><td class="text-center"><h3>aucune variables</h3></td></tr></tbody>
                    </table>
                </div>
            </div>
            <h3 class="col-12">Structure <img src='<?= ADMIN_URL ?>assets/flag-kingdom.png' style='height:30px;margin-left:1em;'></h3>
            <?= Tools::generateInput('textarea', '', 'structure_en', @$el->{"structure_en"}, 'col-8 not-tiny','<section>Ma structure</section>'); ?>
        </div>
        <?= Tools::generateInput('hidden', '', 'id', @$el->id); ?>
        <?= Tools::generateInput('submit', '', '', 'Valider', 'btn-style2 sendform'); ?>
    </div>
</div>
