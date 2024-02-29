<?php $el = @$data['datas']; ?>
<div class="card col-10 offset-1">
    <div class="card-header card-header-tabs card-header-primary">
        <div class="nav-tabs-navigation">
            <div class="nav-tabs-wrapper">
                <span class="nav-tabs-title">Optimisation</span>
                <ul class="nav nav-tabs float-right" data-tabs="tabs"><li class="nav-item mr-3"><a class="nav-link active" href="javascript:history.go(-1)"><i class="fas fa-arrow-left"></i> Retour</a></li></ul>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="tab-content">
            <p class="h5 mt-3"><?= $el['uploadNO'] ?> images importées sur <?= $el['upload'] ?> peuvent être optimisées</p>
            <p class="h5"><?= $el['globalNO'] ?> images globale sur <?= $el['global'] ?> peuvent être optimisées</p>
            <p class="h5"><?= $el['totalOptimize'] ?> images ont été optimisées</p>
            <div class="bottom-navigation">
                <a class="nav-link card-header-primary " href="<?= ADMIN_URL ?>console/optimisation/all"><i class="fas fa-arrow-left"></i> Tout optimisées</a>
            </div>
            </ul>

        </div>
    </div>
</div>
