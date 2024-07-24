<?php $Configuration = new Configuration();
$configurations = $Configuration->getAll(); ?>

<div class="card col-10 offset-1">
    <div class="card-header card-header-tabs card-header-primary">
        <div class="nav-tabs-navigation">
            <div class="nav-tabs-wrapper">
                <span class="nav-tabs-title">Configuration</span>
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
    <form method="post" action="<?= ADMIN_URL ?>builder">
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active">
                    <table class="table active">
                        <tbody class="configtab">
                        <?php if (!empty($configurations)) {
                            foreach ($configurations as $configuration) { ?>
                                <tr>
                                    <td class="text-center font-weight-bolder">
                                        <?= $configuration->label; ?>
                                    </td>
                                    <td class="text-center font-weight-bolder">
                                        <?php if (empty($configuration->value)) { ?>
                                            /
                                        <?php } else {
                                            echo $configuration->value;
                                        } ?>
                                    </td>
                                    <td class="td-actions text-center ">
                                        <a href="<?= $_SERVER['REQUEST_URI'] ?>/set/<?= $configuration->id ?>"
                                           class="btn btn-warning btn-sm mr-3">Editer</a>
                                        <a href="<?= $_SERVER['REQUEST_URI'] ?>/delete/<?= $configuration->id ?>"
                                           onclick="return confirm('Êtes-vous sûr ?')"
                                           class="btn btn-danger btn-sm">Supprimer</a>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td class="text-center h4"><i>Aucune donnée</i></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
</div>
