<?php
if (!isset($_SESSION['user']) || empty($_SESSION['user']) || $_SESSION['user'] == "") {
    header('Location: /connexion');
    exit;
}

$LignesFacture = new LignesFactures();
$lignesFactureUser = $LignesFacture->getLigneFactureByIdUser($_SESSION['user']);

$Facture = new Factures();
$facturesUser = $Facture->getBy(['id_user' => $_SESSION['user']]);

$Users = new Users();
$infosUser = $Users->getBy(['id' => $_SESSION['user']]);

$Reservations = new Reservation();
$lstReservation = $Reservations->getBy(['id_user' => $_SESSION['user']]);
usort($lstReservation, 'compareDateFin');

$Machines = new Machines();
$Consommables = new Consommables();

function compareDateFin($a, $b) {
    $dateA = new DateTime($a->date_fin);
    $dateB = new DateTime($b->date_fin);
    return $dateB <=> $dateA;
}

$currentDate = new DateTime();

?>


<div class="container infos-user">
    <?= Tools::showFlash(); ?>

    <div class="user-form">
        <h2>Informations</h2>
        <form id="userForm" method="POST">
            <?php foreach ($infosUser as $infoUser) : ?>
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($infoUser->nom, ENT_QUOTES, 'UTF-8') ?>">
                    <label for="prenom">Prénom</label>
                    <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($infoUser->prenom, ENT_QUOTES, 'UTF-8') ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($infoUser->email, ENT_QUOTES, 'UTF-8') ?>">
                    <label for="phone">Téléphone</label>
                    <input type="phone" id="phone" name="phone" value="<?= htmlspecialchars($infoUser->phone, ENT_QUOTES, 'UTF-8') ?>">
                </div>
                <div class="form-group">
                    <label for="address">Adresse</label>
                    <input type="address" id="address" name="address" value="<?= htmlspecialchars($infoUser->address, ENT_QUOTES, 'UTF-8') ?>">
                </div>
            <?php endforeach; ?>
            <button type="submit" id="submitButton" class="edit-button">Modifier</button>
            <button type="button" id="changePasswordButton" class="edit-button">Modifier le mot de passe</button>
        </form>
    </div>

    <div id="changePasswordModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Modifier le mot de passe</h2>
            <form id="changePasswordForm" method="POST">
                <div class="form-group">
                    <label for="currentPassword">Mot de passe actuel</label>
                    <input type="password" id="currentPassword" name="currentPassword" required>
                </div>
                <div class="form-group">
                    <label for="newPassword">Nouveau mot de passe</label>
                    <input type="password" id="newPassword" name="newPassword" required>
                </div>
                <div class="form-group">
                    <label for="confirmNewPassword">Confirmer le nouveau mot de passe</label>
                    <input type="password" id="confirmNewPassword" name="confirmNewPassword" required>
                </div>
                <button type="submit" class="edit-button">Enregistrer</button>
            </form>
        </div>
    </div>

    <div class="data-section">
    <h2 style="display: inline;">Consommations </h2><h6 style="display: inline; font-size: large; color: gray;">(Pas facturé)</h6>
        <ul class="invoice-list">
            <?php foreach ($lignesFactureUser as $lignefacture) :?>
                <li class="invoice-item">
                    <span class="title"><?= htmlspecialchars($lignefacture->libelle, ENT_QUOTES, 'UTF-8') ?> - <?= $lignefacture->type ?></span> 
                    <span class="description">
                        <span class="info">Quantité : <?= htmlspecialchars($lignefacture->quantite_prix, ENT_QUOTES, 'UTF-8') ?></span>
                        <span class="info">Prix unitaire : <?= htmlspecialchars($lignefacture->prix_ligne, ENT_QUOTES, 'UTF-8') ?> €</span>
                        <span class="info">Prix total : <?= htmlspecialchars($lignefacture->prix_ligne * $lignefacture->quantite_prix, ENT_QUOTES, 'UTF-8') ?> €</span>
                    </span>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="data-section-left">
        <h2>À saisir</h2>
        <ul class="invoice-list">
            <?php foreach ($lstReservation as $reservation) :
                $end = new DateTime($reservation->date_fin);
                $start = new DateTime($reservation->date_debut);
                if ($end < $currentDate && $reservation->id_machine != NULL && $reservation->statut == 'Accepté') {
                    $machine = $Machines->getBy(['id' => $reservation->id_machine]);?>
                    <li class="invoice-item">
                        <span class="title"><?= htmlspecialchars($machine[0]->nom, ENT_QUOTES, 'UTF-8') ?></span>
                        <span class="description">
                            <span class="info">Date fin : <?= htmlspecialchars($end->format('d/m/Y'))?></span>
                            <span class="info">Cliquer pour saisir</span>
                        </span>
                        <div class="reservation-form" style="display: none;">
                            <form method="POST">
                                <div class="form-group" hidden>
                                    <label for="libelle"></label>
                                    <input type="text" id="libelle" name="libelle" value="<?= htmlspecialchars($machine[0]->nom, ENT_QUOTES, 'UTF-8') ?>">
                                </div>
                                <div class="form-group" hidden>
                                    <label for="id_reservation"></label>
                                    <input type="text" id="id_reservation" name="id_reservation" value="<?=$reservation->id ?>">
                                </div>
                                <div class="form-group" hidden>
                                    <label for="machine"></label>
                                    <input type="text" id="machine" name="machine" value="<?= htmlspecialchars($reservation->id_machine, ENT_QUOTES, 'UTF-8') ?>">
                                </div>
                                <?php $consommables = $Consommables->getBy(['id_machine' => $reservation->id_machine]);
                                if (!empty($consommables)) { ?>
                                    <div class="form-group" style="gap: 25px; margin-top: 10px">
                                        <label for="consommable">Consommable</label>
                                        <select name='consommable' id="consommable">
                                            <option disabled="disabled" selected>--Choisir--</option>
                                            <?php foreach ($consommables as $conso) : ?>
                                                <option value="<?= htmlspecialchars($conso->id, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($conso->libelle, ENT_QUOTES, 'UTF-8') ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="quantite">Quantité</label>
                                        <input type="number" name="quantite" id="quantite">
                                    </div>
                                <?php } ?>
                                <div class="form-group">
                                    <label for="duree">Durée</label>
                                    <input type="number" name="duree" id="duree" step="0.1" oninput="validateInput(event)">
                                </div>

                                <?php if($machine[0]->prestation != 0) { ?>

                                    <div class="form-group">
                                        <label for="presta">Prestation</label>
                                        <input type="checkbox" name="presta" id="presta" style="flex: 0">
                                    </div>

                                    <div class="form-group hidden" id="duree_presta_div">
                                        <label for="duree_presta">Durée prestation</label>
                                        <input type="number" name="duree_presta" id="duree_presta" step="0.1">
                                    </div>

                                <?php } ?>

                                <script>
                                    document.getElementById('presta').addEventListener('change', function() {
                                        var dureePrestaDiv = document.getElementById('duree_presta_div');
                                        if (this.checked) {
                                            dureePrestaDiv.classList.remove('hidden');
                                        } else {
                                            dureePrestaDiv.classList.add('hidden');
                                        }
                                    });
                                </script>

                                <button type="submit" class="edit-button">Enregistrer</button>
                            </form>
                        </div>
                    </li>
            <?php }
            endforeach; ?>
        </ul>
    </div>

    <div class="data-section-res">
        <h2>Réservations</h2>
        <ul class="invoice-list">
            <?php foreach ($lstReservation as $reservation) :
                $end = new DateTime($reservation->date_fin);
                $start = new DateTime($reservation->date_debut);
                if ($end > $currentDate && $reservation->id_machine != NULL) {
                    $machine = $Machines->getBy(['id' => $reservation->id_machine]); ?>
                    <li class="invoice-item">
                        <span class="title"><?= htmlspecialchars($machine[0]->nom, ENT_QUOTES, 'UTF-8') ?></span>
                        <span class="description">
                            <span class="info">Du <?= htmlspecialchars($start->format('d/m/Y'), ENT_QUOTES, 'UTF-8') ?> au <?= htmlspecialchars($end->format('d/m/Y'), ENT_QUOTES, 'UTF-8') ?></span>
                            <?php
                            $status_class = '';
                            switch ($reservation->statut) {
                                case 'En attente':
                                    $status_class = 'orange';
                                    break;
                                case 'Refusé':
                                    $status_class = 'red';
                                    break;
                                case 'Accepté':
                                    $status_class = 'green';
                                    break;
                                default:
                                    $status_class = '';
                            }
                            ?>
                            <span class="status <?= htmlspecialchars($status_class, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($reservation->statut, ENT_QUOTES, 'UTF-8') ?></span>
                        </span>
                    </li>
            <?php }
            endforeach; ?>
        </ul>
    </div>

    <div class="data-section-wide">
        <h2>Mes factures</h2>
        <ul>
            <?php foreach ($facturesUser as $factureUser) :
                $date = new DateTime($factureUser->date_facture);
                $dateFacture = $date->format('d/m/Y'); ?>
                <li>
                    <a class="facture" href="/generatepdf?idfacture=<?= htmlspecialchars($factureUser->id, ENT_QUOTES, 'UTF-8') ?>" target="_blank">
                        <span class="description">
                            <span class="info">Date : <?= htmlspecialchars($dateFacture, ENT_QUOTES, 'UTF-8') ?></span>
                            <span class="info">Prix total : <?= htmlspecialchars($factureUser->prix_total, ENT_QUOTES, 'UTF-8') ?> €</span>
                            <span class="status <?= ($factureUser->is_paid == "0") ? 'unpaid' : 'paid' ?>">
                                Payé : <?= ($factureUser->is_paid == "0") ? 'Non' : 'Oui' ?>
                            </span>
                        </span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<script>
document.getElementById("changePasswordButton").addEventListener("click", function() {
    document.getElementById("changePasswordModal").style.display = "block";
});

// Fermer la modal lors du clic sur la croix
document.getElementsByClassName("close")[0].addEventListener("click", function() {
    document.getElementById("changePasswordModal").style.display = "none";
});

// Fermer la modal lors du clic en dehors de la modal
window.onclick = function(event) {
    if (event.target == document.getElementById("changePasswordModal")) {
        document.getElementById("changePasswordModal").style.display = "none";
    }
}

document.querySelectorAll('.invoice-item').forEach(item => {
    item.addEventListener('click', () => {
        const form = item.querySelector('.reservation-form');
        if (form.style.display === 'none' || form.style.display === '') {
            form.style.display = 'block';
        } 
    });
});

function validateInput(event) {
    const input = event.target;
    const value = parseFloat(input.value);
    if (!Number.isNaN(value) && !/^\d+(\.\d)?$/.test(input.value)) {
        input.value = "";
    }
}
</script>
