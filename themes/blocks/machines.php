<?php
include '../../classes/Machines.php';
$Machines = new Machines();

$machines = $Machines->getBy(["active" => 1]);
?>

<div class="machine-container">
    <div class="search-bar">
        <div class="search-container">
            <i class="fa fa-search search-icon"></i>
            <input type="search" id="machine-search" placeholder="Rechercher"/>
        </div>
    </div>
    
    <div class="listing-machines">
        <?php
            foreach($machines as $machine) {
        ?>
        <div class="machine-card" data-name="<?=$machine->nom?>">
            <div class="machine-color-feature"> 
                <div class="top-rectangle"></div>
                <div class="middle-rectangle"></div> 
                <div class="middle-ellipse"></div>
            </div>
            <img class="machine-img" src="/themes/assets/images/Plotter_VersaStudio_BN-20.png"/>
            <span class="machine-nom"><?=$machine->nom?></span>
            <?php
                if($machine->tag)
                {
            ?>
                    <span class="machine-tag"><?=$machine->tag?></span>
            <?php
                }
            ?>
            <span class="machine-description"><?=$machine->description?></span>
            <div class="machine-detail-link">
                <a href="">Détails</a>
                <i class="fa-solid fa-circle-info info-icon"></i>
            </div>
        </div>
        <?php
            }
        ?>
    </div>
</div>

<script>
    document.getElementById('machine-search').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const machines = document.querySelectorAll('.machine-card');

        machines.forEach(function(machine) {
            const name = machine.getAttribute('data-name').toLowerCase();
            if (name.includes(searchTerm)) {
                machine.style.display = '';
            } else {
                machine.style.display = 'none';
            }
        });
    });
</script>



