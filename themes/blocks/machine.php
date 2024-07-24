<?php
    include '../../classes/Machines.php';
    $Machines = new Machines();

    $machineId = $data['id'];
    $current_machine = $Machines->getBy(['id' => $machineId]);
?>

<div class="machine-container">
    <div class="detail-machine">
        <?php foreach($current_machine as $machine): ?>
            <div class="machine-card" data-name="<?=$machine->nom?>">
                <form method="post">
                    <input type="hidden" name="machine_id" value="<?=$machine->id?>">
                    <div class="top-container">
                        <div class="image-container">
                            <?php if($machine->image): ?>
                                <img class="machine-img" src="<?=$machine->image?>"/>
                            <?php else: ?>
                                <img class="machine-no_img" src="/themes/assets/images/no_pic.png"/>
                            <?php endif; ?>
                        </div>
                        <div class="info-container">
                            <div class="machine-nom"><?=$machine->nom?></div>
                            <?php 
                            if($machine->prix):
                                $json_decode_price = json_decode($machine->prix);
                                foreach($json_decode_price as $key => $value): ?>
                                    <div class="machine-tarif">
                                        <span><?=$key?>€/<?=$value?></span>
                                    </div>
                                <?php endforeach;
                            else: ?>
                                <div class="machine-tarif">
                                    <span>Disponible pour les adhérents</span>
                                </div>
                            <?php endif; ?>
                            <?php if($machine->prestation): ?>
                                <div class="machine-prestation">Si prestation: <?=$machine->prestation?>€/heure</div>
                            <?php endif; ?>
                            <div class="description-container">
                                <div class="description-header" onclick="toggleDescription()">
                                    <span class="description-title">DESCRIPTION</span>
                                    <span class="arrow">&#9662;</span>
                                </div>
                                <div class="description-content">
                                    <span class="machine-description"><?=$machine->description?></span>
                                </div>
                            </div>
                            <div class="date-inputs">
                                <label for="machine-start-date">Date de début</label>
                                <input type="date" name="start_date" id="machine-start-date" required>
                            </div>
                            <div class="date-inputs">
                                <label for="machine-end-date">Date de fin</label>
                                <input type="date" name="end_date" id="machine-end-date" required>
                            </div>
                            <button type="submit">Réserver</button>
                        </div>
                    </div>
                    <?php if($machine->caracteristique):
                        $json_decode_caracteristique = json_decode($machine->caracteristique, true);
                        if ($json_decode_caracteristique): ?>
                            <div class="caracteristique-container">
                                <table class="caracteristique-table">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Caractéristique technique</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($json_decode_caracteristique as $key => $value): ?>
                                            <tr>
                                                <td><?=$key?></td>
                                                <td><?=$value?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                    <?php endif; endif; ?>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const startDateInput = document.getElementById('machine-start-date');
        const endDateInput = document.getElementById('machine-end-date');
        const today = new Date().toISOString().split('T')[0];

        startDateInput.setAttribute('min', today);

        startDateInput.addEventListener('change', function () {
            endDateInput.setAttribute('min', this.value);
        });
    });

    function toggleDescription() {
        const content = document.querySelector('.description-content');
        const arrow = document.querySelector('.arrow');

        if (content.classList.contains('open')) {
            content.classList.remove('open');
            arrow.classList.remove('up');
        } else {
            content.classList.add('open');
            arrow.classList.add('up');
        }
    }
</script>
