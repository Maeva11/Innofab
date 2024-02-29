<div class="card col-10 offset-1">
    <div class="card-header card-header-tabs card-header-primary">
        <div class="nav-tabs-navigation">
            <div class="nav-tabs-wrapper">
                <span class="nav-tabs-title">Archive</span>
                <ul class="nav nav-tabs float-right" data-tabs="tabs">
                    <li class="nav-item mr-3"><a class="nav-link active" href="javascript:history.go(-1)"><i
                                    class="fas fa-arrow-left"></i> Retour</a></li>
                    <li class="nav-item"><a class="nav-link active" href="<?= ADMIN_URL ?>console/archiveSQL"><i
                                    class="material-icons">code</i> Nouvelle archive</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="tab-content">
            <div class="tab-pane active">
                <table class="table active">
                    <tbody class="configtab">
                    <?php foreach (scandir('../archive') as $el) { ?>
                        <?php if (stristr($el, ".sql")) { ?>
                            <tr>
                                <td>Archive en date du <?= date("d M Y H:i:s.", fileatime('../archive/'.$el)); ?></td>
                                <td>(BDD Structure + données)</td>
                                <td><a href="/archive/<?= $el ?>" download>Télécharger l'archive</a></td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
