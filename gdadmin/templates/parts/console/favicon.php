
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
    <form method="post" action="<?= ADMIN_URL ?>favicon" enctype="multipart/form-data">
        <div class="card-body">
            <div class="tab-content">
                <div>Aperçu : <img src="../../../../themes/assets/favicon.png"></div>
                <?= Tools:: generateInput('file', 'Ajouter un favicon', 'image', '', 'col-12'); ?>
                <?= Tools::generateInput('submit', '', '', 'Valider', 'btn-style2 col-2 float-right'); ?>

            </div>
        </div>
    </form>
</div>
