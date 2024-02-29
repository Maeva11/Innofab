<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="card col-10 offset-1">
    <div class="card-header card-header-tabs card-header-primary">
        <div class="nav-tabs-navigation">
            <div class="nav-tabs-wrapper">
                <span class="nav-tabs-title">Pages</span>
                <ul class="nav nav-tabs float-right">
                    <li class="nav-item mr-3"><a class="nav-link active" href="javascript:history.go(-1)"><i
                                    class="fas fa-arrow-left"></i> Retour</a></li>
                    <li class="nav-item"><a class="nav-link active" href="<?= ADMIN_URL ?>pageBuilder/set"><i
                                    class="material-icons">code</i> Nouvelle page</a></li>

                </ul>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="tab-content">
            <div class="tab-pane active">
                <table class="table">
                    <tbody>
                    <?php
                    if (!empty($data['pages'])) {
                        foreach ($data['pages'] as $el) {
                            if ($el->parent) continue;
                            ?>
                            <tr>
                                <td><i class="fas fa-arrows-alt"></i></td>
                                <td><?= substr(@$el->nom, 0, 30); ?></td>
                                <td><a href="<?= URL ?>/<?= $el->url ?>" target="_blank">Accéder à la page</a></td>
                                <td class="td-actions text-right">
                                    <a href="<?= ADMIN_URL ?>pageBuilder/duplicate/<?= $el->id ?>"
                                       class="btn btn-link ">dupliquer </a>
                                    <a href="<?= ADMIN_URL ?>pageBuilder/set/<?= $el->id ?>"
                                       class="btn btn-warning btn-link btn-lg"> <i class="fas fa-pen"></i></a>
                                    <a href="<?= ADMIN_URL ?>pageBuilder/delete/<?= $el->id ?>"
                                       onclick="return confirm('Êtes-vous de vouloir effectuer cette action ?')"
                                       class="btn btn-danger btn-link btn-lg"><i class="fas fa-times"></i></a>
                                </td>
                            </tr>
                            <?php foreach ($data['pages'] as $subPage) {
                                if ($subPage->parent == $el->id) {
                                    ?>
                                    <tr style="transform: scale(0.9);">
                                        <td><i class="fa-solid fa-angle-right"></i></td>
                                        <td><?= substr(@$subPage->nom, 0, 30); ?></td>
                                        <td><a href="<?= URL ?>/<?= $subPage->url ?>" target="_blank">Accéder à la page</a>
                                        </td>
                                        <td class="td-actions text-right">
                                            <a href="<?= ADMIN_URL ?>pageBuilder/duplicate/<?= $subPage->id ?>"
                                               class="btn btn-link ">dupliquer </a>
                                            <a href="<?= ADMIN_URL ?>pageBuilder/set/<?= $subPage->id ?>"
                                               class="btn btn-warning btn-link btn-lg"> <i class="fas fa-pen"></i></a>
                                            <a href="<?= ADMIN_URL ?>pageBuilder/delete/<?= $subPage->id ?>"
                                               onclick="return confirm('Êtes-vous de vouloir effectuer cette action ?')"
                                               class="btn btn-danger btn-link btn-lg"><i class="fas fa-times"></i></a>
                                        </td>
                                    </tr>
                                <?php }
                            }
                        }
                    } else {
                        ?>
                        <tr>
                            <td class="text-center h4">Aucune page</td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
