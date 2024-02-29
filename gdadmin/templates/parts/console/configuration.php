<?php $data  = @$data['datas'];?>
<div class="card col-10 offset-1">
    <div class="card-header card-header-tabs card-header-primary">
        <div class="nav-tabs-navigation">
            <div class="nav-tabs-wrapper">
                <span class="nav-tabs-title">Configuration</span>
                <ul class="nav nav-tabs float-right" data-tabs="tabs">
                    <li class="nav-item mr-3"><a class="nav-link active" href="javascript:history.go(-1)" ><i class="fas fa-arrow-left"></i> Retour</a></li>
                    <li class="nav-item"><a class="nav-link active" id="newConfiguration"><i class="material-icons">code</i> Nouveau</a></li>
                </ul>
            </div>
        </div>
    </div>
    <form method="post" action="<?= ADMIN_URL ?>builder">
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active">
                    <table class="table active">
                        <tbody class="configtab">
                        <?php
                        if(!empty($data->datas)){
                            foreach (json_decode($data->datas) as $el){ ?>
                                <tr>
                                    <td><i class="fas fa-arrows-alt"></i></td>
                                    <td><input type="text" name="label[]" placeholder="label" class="form-control" value="<?= $el->label ?>"></td>
                                    <td><input type="text" name="contenu[]" placeholder="Contenu" class="form-control" value="<?= @$el->value ?>"></td>
                                    <td class="td-actions text-right"><span class="btn btn-danger btn-link btn-lg delete"><i class="fas fa-times"></i></span></td>
                                </tr>
                            <?php
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <?= Tools::generateInput('hidden', '', 'id', @$data->id); ?>
                <?= Tools::generateInput('hidden', '', 'block', "configuration"); ?>
                <?= Tools::generateInput('hidden', '', 'redirect', "configuration"); ?>
                <?= Tools::generateInput('submit', '', '', 'Mettre à jour', 'btn-style2 col-2 float-right'); ?>
            </div>
        </div>
    </form>
</div>
