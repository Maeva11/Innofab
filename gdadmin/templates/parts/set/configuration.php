<?php $el = @$data['datas']; ?>
<div class="card col-10 offset-1">
    <div class="card-header card-header-tabs card-header-primary">
        <div class="nav-tabs-navigation">
            <div class="nav-tabs-wrapper">
                <span class="nav-tabs-title">Configuration</span>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="tab-content">
            <div class="tab-pane active">
                <form class="row" method="post" enctype="multipart/form-data">
                    <?= Tools::generateInput("text", "Label", "label", @$el->label, "col-6"); ?>
                    <?= Tools::generateInput("text", "Valeur", "value", @$el->value, "col-6"); ?>
                    <?= Tools::generateInput("hidden", "", "id", @$el->id); ?>
                    <?= Tools::generateInput("submit", "", "", "Valider", "col-12 btn-style2 text-right"); ?>
                </form>
            </div>
        </div>
    </div>
</div>