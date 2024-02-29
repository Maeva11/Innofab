<?php $data = @$data['datas'];?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/js-yaml/3.6.0/js-yaml.min.js"></script>
<div class="card col-10 offset-1">
    <div class="card-header card-header-tabs card-header-primary">
        <div class="nav-tabs-navigation">
            <div class="nav-tabs-wrapper">
                <span class="nav-tabs-title">Adminbuilder</span>
                <ul class="nav nav-tabs float-right" data-tabs="tabs">
                    <li class="nav-item mr-3"><a class="nav-link active" href="javascript:history.go(-1)" ><i class="fas fa-arrow-left"></i> Retour</a></li>
                    <li class="nav-item"><a class="nav-link active" id="newAdminbuilder"><i class="material-icons">code</i> Nouveau</a></li>
                </ul>
            </div>
        </div>
    </div>
    <form method="post" action="<?= ADMIN_URL ?>builder" class="adminbuilder-jsyaml">
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active">
                    <table class="table active">
                        <tbody class="dragdrop">
                        <?php if (!empty($data['datas'])) {
                            foreach ($data['datas'] as $el) { ?>
                                <tr>
                                    <td><i class="fas fa-arrows-alt"></i></td>
                                    <td><input type="text" name="nom[]" placeholder="nom" class="form-control" value="<?= @$el->nom ?>"></td>
                                    <td><input type="text" name="url[]" placeholder="url" class="form-control" value="<?= @$el->url ?>"></td>
                                    <td><input type="text" name="icone[]"class="form-control edit-icon" value="<?= $el->icone ?>" ></td>
                                    <td ><i id="icon" class="<?= $el->icone ?>"></td>
                                    <td class="td-actions text-right"><span class="btn btn-danger btn-link btn-lg delete"><i class="fas fa-times"></i></span></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <?= Tools::generateInput('hidden', '', 'id', @$data['id']); ?>
                <?= Tools::generateInput('hidden', '', 'block', "menu"); ?>
                <?= Tools::generateInput('hidden', '', 'redirect', "adminBuilder"); ?>
                <?= Tools::generateInput('submit', '', '', 'Mettre à jour', 'btn-style2 col-2 float-right'); ?>
            </div>
        </div>
    </form>
</div>
