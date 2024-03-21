<?php $BlockBuilder = new Blockbuilder();
$blockBuilder = $BlockBuilder->getAll(); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card col-10 offset-1">
                <div class="card-header card-header-tabs card-header-primary">
                    <div class="nav-tabs-navigation">
                        <div class="nav-tabs-wrapper">
                            <span class="nav-tabs-title">BlockBuilder</span>
                            <ul class="nav nav-tabs float-right">
                                <li class="nav-item">
                                    <a class="nav-link active" href="<?= $_SERVER['REQUEST_URI'] ?>/set">
                                        <i class="material-icons">add</i> Ajouter
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nom
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Active
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if (!empty($blockBuilder)) {
                                    foreach ($blockBuilder as $block) { ?>
                                        <tr>
                                            <td class="text-center font-weight-bolder">
                                                <?= $block->name; ?>
                                            </td>
                                            <td class="text-center font-weight-bolder blockbuilder">
                                                <?php if ($block->active == 1) { ?>
                                                    <span class="toggle-button" data-id="<?= $block->id ?>"
                                                          data-state="active">
                                                        <i class="fa fa-check" style="color: green"></i>
                                                    </span>
                                                <?php } else { ?>
                                                    <span class="toggle-button" data-id="<?= $block->id ?>"
                                                          data-state="inactive">
                                                        <i class="fa fa-xmark" style="color: red"></i>
                                                    </span>
                                                <?php } ?>
                                            </td>
                                            <td class="td-actions text-center ">
                                                <a href="<?= $_SERVER['REQUEST_URI'] ?>/set/<?= $block->id ?>"
                                                   class="btn btn-warning btn-sm mr-3">Editer</a>
                                                <a href="<?= $_SERVER['REQUEST_URI'] ?>/delete/<?= $block->id ?>"
                                                   onclick="return confirm('Êtes-vous sûr ?')"
                                                   class="btn btn-danger btn-sm">Supprimer</a>
                                            </td>
                                        </tr>
                                    <?php }
                                } else {
                                    ?>
                                    <tr>
                                        <td class="text-center h4"><i>Aucune donnée</i></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>