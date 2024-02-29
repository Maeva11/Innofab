<?php $data  = @$data['datas']; ?>
<div class="card col-10 offset-1">
    <div class="card-header card-header-tabs card-header-primary">
        <div class="nav-tabs-navigation">
            <div class="nav-tabs-wrapper">
                <span class="nav-tabs-title">Administrateur</span>
                <ul class="nav nav-tabs float-right" data-tabs="tabs">
                    <li class="nav-item mr-3"><a class="nav-link active" href="javascript:history.go(-1)" ><i class="fas fa-arrow-left"></i> Retour</a></li>
                    <li class="nav-item"><a class="nav-link active" id="newAdministrateur"><i class="material-icons">code</i> Nouveau</a></li>
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
                        if(!empty($data['datas'])){
                            foreach ($data['datas'] as $el){ ?>
                                <tr>
                                    <td><i class="fas fa-arrows-alt"></i></td>
                                    <td><input type="text" name="identifiant[]" placeholder="identifiant" class="form-control" value="<?= @$el->identifiant ?>"></td>
                                    <td>
                                        <select name="role[]" class="form-control">
                                            <option value="">Role</option>
                                            <option value="root" <?= (@$el->role == "root")? "selected" : "" ?>>root</option>
                                            <option value="admin"<?= (@$el->role == "admin")? "selected" : "" ?>>admin</option>
                                        </select>
                                    </td>
                                    <td><input type="password" name="password[]" placeholder="password" class="form-control" disabled></td>
                                    <td class="td-actions text-right"><span class="btn btn-danger btn-link btn-lg deleteAdmin" data-identifiant="<?= @$el->identifiant ?>"><i class="fas fa-times"></i></span></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <?= Tools::generateInput('hidden', '', 'id', @$data['id']); ?>
                <?= Tools::generateInput('hidden', '', 'block', "auth"); ?>
                <?= Tools::generateInput('hidden', '', 'redirect', "administrateur"); ?>
                <?= Tools::generateInput('submit', '', '', 'Mettre à jour', 'btn-style2 col-2 float-right'); ?>
            </div>
        </div>
    </form>
</div>
