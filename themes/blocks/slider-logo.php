<?php
$Valeurs = new Valeur();
$datas = $Valeurs->getBy(['active' => 1]);
?>

<?php foreach ($datas as $data) { ?>
    <div class="col-md-4 col-sm-4">
        <div class="xl-services-box-wrapper box-shadow">
            <div class="relative services-count-2 bg-white p-a30">
                <div class="services-xl inline-icon m-b25 text-primary styled-bg align-center">
                    <span class="services-cell"><i class="<?= $data->logo ?>"></i></span>
                </div>
                <div class="services-content">
                    <h4 class="xl-title m-b25"><?= $data->titre ?></h4>
                    <p><?= $data->description ?></p>
                </div>
            </div>
        </div>
    </div>
<?php } ?>