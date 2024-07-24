<?php
$reservations = @$data['datas'];
$User = new Users(); // Assurez-vous d'avoir inclus la classe Users ou son fichier correspondant
$Machines = new Machines(); // Assurez-vous d'avoir inclus la classe Machines ou son fichier correspondant
?>
<div class="card col-10 offset-1">
    <div class="card-header card-header-tabs card-header-primary">
        <div class="nav-tabs-navigation">
            <div class="nav-tabs-wrapper d-flex justify-content-between align-items-center">
                <span class="nav-tabs-title">Réservations</span>
                <ul class="nav nav-tabs">
                    <li class="nav-item mr-3">
                        <a class="nav-link active btn btn-secondary" href="javascript:history.go(-1)">
                            <i class="fas fa-arrow-left"></i> Retour
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active btn btn-secondary" href="<?= $_SERVER['REQUEST_URI'] ?>/set">
                            <i class="material-icons">code</i> Nouvelle réservation
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="tab-content">
            <div class="tab-pane active">
                <div class="row">
                    <div class="col-12">
                        <h3 style="color: orange; font-weight: 700">En Attente</h3>
                        <table class="table">
                            <tbody>
                            <?php foreach ($reservations as $reservation) {
                                $datedebut = DateTime::createFromFormat('Y-m-d H:i:s', $reservation->date_debut);
                                $datefin = DateTime::createFromFormat('Y-m-d H:i:s', $reservation->date_fin);

                                if ($reservation->statut == 'En attente') {
                                    $user = $User->get($reservation->id_user);
                                    $machine = $Machines->get($reservation->id_machine); ?>
                                    <tr>
                                        <td><?= substr(@$machine->nom, 0, 50); ?></td>
                                        <td><?= substr(@$user->nom . ' ' . @$user->prenom, 0, 50); ?></td>
                                            <td><?= $datedebut->format('d/m/Y') ?></td>
                                        <td><?= $datefin->format('d/m/Y') ?> </td>
                                        <td class="td-actions text-right">
                                            <form method="post" action="<?= ADMIN_URL ?>crud/reservation/set" style="display:inline;">
                                                <input type="hidden" name="id" value="<?= $reservation->id ?>">
                                                <input type="hidden" name="statut" value="Accepté">
                                                <button type="submit" class="btn btn-success btn-link btn-lg"><i class="fas fa-check"></i></button>
                                            </form>
                                            <form method="post" action="<?= ADMIN_URL ?>crud/reservation/set" style="display:inline;">
                                                <input type="hidden" name="id" value="<?= $reservation->id ?>">
                                                <input type="hidden" name="statut" value="Refusé">
                                                <button type="submit" class="btn btn-danger btn-link btn-lg"><i class="fas fa-times"></i></button>
                                            </form>
                                            <a href="<?= $_SERVER['REQUEST_URI'] ?>/delete/<?= $reservation->id ?>" onclick="return confirm('Êtes-vous de vouloir effectuer cette action ?')" class="btn btn-danger btn-link btn-lg"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php }
                            } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12">
                        <h3 style="color: green; font-weight: 700;">Accepté</h3>
                        <table class="table">
                            <tbody>
                                <?php foreach ($reservations as $reservation) {
                                    $datedebut = DateTime::createFromFormat('Y-m-d H:i:s', $reservation->date_debut);
                                    $datefin = DateTime::createFromFormat('Y-m-d H:i:s', $reservation->date_fin);
                                    if ($reservation->statut == 'Accepté') {
                                        $user = $User->get($reservation->id_user);
                                        $machine = $Machines->get($reservation->id_machine); ?>
                                        <tr>
                                            <td><?= substr(@$machine->nom, 0, 50); ?></td>
                                            <td><?= substr(@$user->nom . ' ' . @$user->prenom, 0, 50); ?></td>
                                            <td><?= $datedebut->format('d/m/Y') ?></td>
                                            <td><?= $datefin->format('d/m/Y') ?></td>
                                            <td class="td-actions text-right">
                                                <form method="post" action="<?= ADMIN_URL ?>crud/reservation/set" style="display:inline;">
                                                    <input type="hidden" name="id" value="<?= $reservation->id ?>">
                                                    <input type="hidden" name="statut" value="En attente">
                                                    <button type="submit" class="btn btn-warning btn-link btn-lg"><i class="fas fa-clock"></i></button>
                                                </form>
                                                <form method="post" action="<?= ADMIN_URL ?>crud/reservation/set" style="display:inline;">
                                                    <input type="hidden" name="id" value="<?= $reservation->id ?>">
                                                    <input type="hidden" name="statut" value="Refusé">
                                                    <button type="submit" class="btn btn-danger btn-link btn-lg"><i class="fas fa-times"></i></button>
                                                </form>
                                                <a href="<?= $_SERVER['REQUEST_URI'] ?>/delete/<?= $reservation->id ?>" onclick="return confirm('Êtes-vous de vouloir effectuer cette action ?')" class="btn btn-danger btn-link btn-lg"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12">
                        <h3 style="color: red; font-weight: 700">Refusé</h3>
                        <table class="table">
                            <tbody>
                            <?php foreach ($reservations as $reservation) {
                                $datedebut = DateTime::createFromFormat('Y-m-d H:i:s', $reservation->date_debut);
                                $datefin = DateTime::createFromFormat('Y-m-d H:i:s', $reservation->date_fin);
                                if ($reservation->statut == 'Refusé') {
                                    $user = $User->get($reservation->id_user);
                                    $machine = $Machines->get($reservation->id_machine); ?>
                                    <tr>
                                        <td><?= substr(@$machine->nom, 0, 50); ?></td>
                                        <td><?= substr(@$user->nom . ' ' . @$user->prenom, 0, 50); ?></td>
                                        <td><?= $datedebut->format('d/m/Y') ?></td>
                                        <td><?= $datefin->format('d/m/Y') ?></td>
                                        <td class="td-actions text-right">
                                            <form method="post" action="<?= ADMIN_URL ?>crud/reservation/set" style="display:inline;">
                                                <input type="hidden" name="id" value="<?= $reservation->id ?>">
                                                <input type="hidden" name="statut" value="Accepté">
                                                <button type="submit" class="btn btn-success btn-link btn-lg"><i class="fas fa-check"></i></button>
                                            </form>
                                            <form method="post" action="<?= ADMIN_URL ?>crud/reservation/set" style="display:inline;">
                                                <input type="hidden" name="id" value="<?= $reservation->id ?>">
                                                <input type="hidden" name="statut" value="En attente">
                                                <button type="submit" class="btn btn-warning btn-link btn-lg"><i class="fas fa-clock"></i></button>
                                            </form>
                                            <a href="<?= $_SERVER['REQUEST_URI'] ?>/delete/<?= $reservation->id ?>" onclick="return confirm('Êtes-vous de vouloir effectuer cette action ?')" class="btn btn-danger btn-link btn-lg"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php }
                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
