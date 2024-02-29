<?php $data  = @$data['datas'];?>
<div class="card col-10 offset-1">
    <div class="card-header card-header-tabs card-header-primary">
        <div class="nav-tabs-navigation">
            <div class="nav-tabs-wrapper">
                <span class="nav-tabs-title">Navigation</span>
                <ul class="nav nav-tabs float-right" data-tabs="tabs">
                    <li class="nav-item mr-3"><a class="nav-link active" href="javascript:history.go(-1)" ><i class="fas fa-arrow-left"></i> Retour</a></li>
                </ul>
            </div>
        </div>
    </div>
    <form method="post" action="<?= ADMIN_URL ?>navigation">
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active">
                    <table class="table active">
                        <tbody class="configtab">
                        <?php
                        if(!empty($data)){
                            $params[0] = "Aucune";
                        foreach ($data as $el) {
                            $params[$el->id] = $el->nom;
                        }
                            foreach ($data as $el){ ?>
                                <tr>
                                    <td><input type="hidden" name="id[]" value="<?= $el->id?>"><?= $el->nom ?></td>
                                    <td><a href="/<?= $el->url ?>">Accéder à la page</a></td>
                                    <td>
                                        <?= Tools::generateSelect("Page parent", "parent[]", $params, $el->parent); ?>
                                    </td>
                                    <td><?= Tools::generateInput("number", "Position menu", "menu[]", $el->menu) ?></td>
                                    <td><?= Tools::generateInput("number", "Position footer", "footer[]", $el->footer) ?></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                    <p class="info"><i class="fas fa-info-circle text-success"></i> Position à 0 ou vide pour désactiver une page du menu ou du footer</p>

                </div>
                <?= Tools::generateInput('submit', '', '', 'Valider', 'btn-style2 col-2 float-right'); ?>
            </div>
        </div>
    </form>
</div>
