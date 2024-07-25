<?php
$Formations = new Formation();
$datas = $Formations->getBy(['active' => 1]);
?>

<?php foreach ($datas as $data) { ?>
    <div class="col-md-4 col-sm-4">
        <div class="bt-inner exeltis-2 projects">
            <div class="bt-inner-bg">
                <div class="bt-center">
                    <div class="bt-imagecover-outer">
                        <div class="bt-imagecover">
                            <img class="hovereffect"
                                 src="<?= $data->image ?>"
                                 alt="House Isolated Field Project" style="width:767px;"
                                 title="House Isolated Field Project">
                        </div>
                    </div>
                </div>
                <div class="bt-introtitle-container">
                    <h3> <?= $data->title ?> </h3>
                    <div class="bt-introtext">
                        <?= $data->description ?>
                    </div>
                </div>
                <div></div>
                <div style="clear:both"></div>
            </div> <!---bt-inner-bg-->
            <div></div>
            <div style="clear:both"></div>
        </div>
    </div>
<?php } ?>
