<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>

<p class="telephone"><i class="fa-solid fa-phone-volume"></i> <?= Tools::getValue('Téléphone'); ?></p>
<p class="email"><i class="fas fa-envelope"></i> <?= Tools::getValue('E-mail'); ?></p>
<p class="adresse"><i class="fas fa-map-marker-alt"></i> <?= Tools::getValue('Adresse'); ?></p>
<div class="hours">
    <p class="horaires"><i class="fas fa-clock"></i> Horaires :</p>
    <table>
        <tr>
            <td>Mercredi</td>
            <td>10h - 12h</td>
            <td>14h - 18h</td>
        </tr>
        <tr>
            <td>Jeudi</td>
            <td>10h - 12h</td>
            <td>14h - 18h</td>
        </tr>
        <tr>
            <td>Vendredi</td>
            <td>10h - 12h</td>
            <td>14h - 18h</td>
        </tr>
    </table>
</div>
</div>
<div class="form-section">
    <?= Tools::showFlash(); ?>
    <form method="post">
        <div class="form-row">
            <div class="form-group">
                <label for="nom">Nom*</label>
                <input type="text" id="nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom*</label>
                <input type="text" id="prenom" name="prenom" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label for="email">Email*</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="telephone">Téléphone*</label>
                <input type="tel" id="telephone" name="telephone" required>
            </div>
        </div>
        <div class="form-group">
            <label for="objet">Objet*</label>
            <input type="text" id="objet" name="objet" required>
        </div>
        <div class="form-group">
            <label for="message">Message*</label>
            <textarea id="message" name="message" required></textarea>
        </div>
        <div class="form-group privacy-consent">
            <input type="checkbox" class="form-checkbox" required>
            <label class="form-text">
                En cliquant sur ce bouton, vous acceptez notre
                <a href="/mentions-legales" class="form-link" target="_blank">Politique de confidentialité</a>
            </label>
        </div>
        <button type="submit" class="btn-send"><i class="fas fa-paper-plane"></i> Envoyer</button>
    </form>
</div>
</div>
</div>
<div class="container">
    <div id="map" class="mapp"></div>
</div>
</section>

<!-- Inclusion du script JavaScript de Leaflet -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    // Initialisation de la carte
    var map = L.map('map').setView([43.623998, 2.2636387], 15); // Coordonnées pour un lieu spécifique

    // Ajout d'une couche de tuiles OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Ajout d'un marqueur
    L.marker([43.623998, 2.2636387]).addTo(map)
        .bindPopup('Site de Innofab')
        .openPopup();
</script>
