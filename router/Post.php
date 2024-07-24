<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


/**********************ROUTES POST**********************/

$app->post('/sendBlock', function (Request $request, Response $response, $args) use ($app) {
    $Structure = new Structure();
    $BlockBuilder = new BlockBuilder();
    $blockBuilder = $BlockBuilder->get($_POST['blockId']);

    $params = [
        "id_page" => $_POST['pageId'],
        "id_lang" => 1,
        "id_block" => $_POST['blockId'],
        "value" => $blockBuilder->structure,
        "field" => " ",
        "json" => " ",
        "position" => 1,
        "revision" => 0,
        "id_structure" => 0
    ];

    $Structure->set($params);
    $response->getBody()->write("success");
    return $response;
});

$app->post('/deleteBlock', function (Request $request, Response $response, $args) use ($app) {

    $Structure = new Structure();
    $Structure->removebyIdBlock($_POST['blockId']);
    $response->getBody()->write("success");  // Écrire "success" dans le corps de la réponse

    return $response;
});


$app->post('/connexion', function (Request $request, Response $response, $args) use ($app) {
    $Users = new users();


    $email = $_POST['email'] ?? '';
    $password = $_POST['pwd'] ?? '';

    try {
        $id = $Users->verifyPassword($email, $password);
        if ($id !== false) {

            $_SESSION["user"] = $id;
            $current_user = $Users->getBy(['id' => $id]);
            foreach($current_user as $user){
                $_SESSION["nameUser"] = $user->prenom;
            }
            Tools::redirect('/');
        } else {
            Tools::setFlash('danger', 'Mot de passe ou email incorrect');
            Tools::redirect('/connexion');
        }
    } catch (Exception $e) {
        Tools::setFlash('danger', 'Erreur lors de la connexion : ' . $e->getMessage());
        Tools::redirect('/connexion');
    }

    return $response;
});

$app->post('/uploadimg', function (Request $request, Response $response, $args) use ($app) {
    $Structure = new Structure();
    $id_structure = $_POST['wrapperId'];
    $structure = $Structure->get($id_structure);

    $editableContentId = $_POST['editableContentId'];

    var_dump($_POST);die;
});

$app->post('/liveedit', function (Request $request, Response $response, $args) use ($app) {
    $Structure = new Structure();
    $id_structure = $_POST['wrapperId'];
    $structure = $Structure->get($id_structure);
    $newContent = $_POST['content'];
    $oldContent = $structure->value;
    $editableContentId = $_POST['editableContentId'];

    $pattern = '/(<div[^>]*id="' . $editableContentId . '"[^>]*>)(.*?)(<\/div>)/s';

    $structure_value_updated = preg_replace($pattern, '$1' . $newContent . '$3', $oldContent);

    $Structure->update_structure($id_structure, $structure_value_updated);
    return $response;
});

$app->post('/prise-rendez-vous', function (Request $request, Response $response, $args) use ($app) {
    $Structure = new Structure();
    $rendezVous = new PriseRendezVous();

    $emailRegex = '/^[^\s@]+@[^\s@]+\.[^\s@]+$/';

    $nom = $_POST['lastname'];
    $prenom = $_POST['firstname'];
    $email = $_POST['email'];
    $dateRendezVous = $_POST['selectedDate'];
    $heureDebut = $_POST['selectHeure'];

    // Validation de l'email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        Tools::setFlash('danger', 'Veuillez saisir un email valide.');
        Tools::redirect('/prise-rendez-vous');
    }
    
    // Validation de la date
    $dateRendezVousObj = new DateTime($dateRendezVous);
    $dateActuelle = new DateTime();
    
    if ($dateRendezVousObj < $dateActuelle) {
        Tools::setFlash('danger', 'Veuillez saisir une date ultérieure à aujourd\'hui.');
        Tools::redirect('/prise-rendez-vous');
    }
    
    $params = [
        "nom" => $nom,
        "prenom" => $prenom,
        "email" => $email,
        "dateRendezVous" => $dateRendezVous,
        'heureDebut' => $heureDebut,
        'accept' => 0
    ];

    $rendezVous->insertRdv($params);

    $Mailer = new Mail();
    $Mailer->setSubject("Demande de rendez vous");
    $Mailer->setBody("<li>De : " . $nom . " " . $prenom . "</li><li>Le : " . $dateRendezVous . " à : " . $heureDebut . "</li>");
    if ($Mailer->send()['success']) {
        Tools::setFlash("success", 'Merci ! Nous vous répondrons dès que possible !');
    } else {
        Tools::setFlash("error", 'Désolé Votre message n\'a pas été envoyée  !');
    }
    Tools::redirect('/');

    return $response;
});


$app->post('/machine/{id}/{nom}', function (Request $request, Response $response, $args) use ($app) {
    $reservationMachine = new Reservation();
    if(!isset($_SESSION['user']) || empty($_SESSION['user']) || $_SESSION['user']=="") {
        header('Location: /connexion');
        exit;
    }else {
        $parsedBody = $request->getParsedBody();
        $idMachine = $parsedBody['machine_id'];
        $idUser = $_SESSION['user'];
        $dateDebut = $_POST['start_date'];
        $dateFin = $_POST['end_date'];
        $statut = 'En attente';
        $reservationMachine->save($idMachine, $idUser, $dateDebut, $dateFin, $statut);

        if ($reservationMachine) {
            Tools::setFlash('success', 'Votre réservation a bien été prise en compte');
        } else {
            Tools::setFlash('danger', 'Une erreur est survenue lors de la réservation');
        }
        Tools::redirect('/utilisateur');
    }

    return $response;
});


$app->post('/utilisateur', function (Request $request, Response $response, $args) use ($app) {
    $Users = new Users();
    $Reservations = new Reservation();
    $Machines = new Machines();

    $idUser = $_SESSION['user'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $libelle = $_POST['libelle'];
    $quantite = $_POST['quantite'];
    $duree = $_POST['duree'];
    $idConsommable = $_POST['consommable'];
    $idMachine = $_POST['machine'];
    $idReservation = $_POST['id_reservation'];

    $duree_presta = $_POST['duree_presta'];
    $presta = $_POST['presta'];


    if($nom == NULL && $prenom == NULL && $email == NULL && $phone == NULL && $address == NULL && $libelle == NULL) {
        $currentPassword = $_POST['currentPassword'];
        $newPassword = $_POST['newPassword'];
        $confirmNewPassword = $_POST['confirmNewPassword'];
        
        if ($newPassword == $confirmNewPassword) {
            if ($Users->checkPassword($idUser, $currentPassword)) {
                $Users->updatePassword($idUser, $newPassword);
                Tools::setFlash('success', 'Modification réussie');
            } else {
                Tools::setFlash('danger', 'Le mot de passe actuel est incorrect.');
            }
        } else {
            Tools::setFlash('danger', 'Les nouveaux mots de passe ne correspondent pas.');
        }
    }
    
    if($nom == NULL && $prenom == NULL && $email == NULL && $phone == NULL && $address == NULL && $currentPassword == NULL && $newPassword == NULL && $confirmNewPassword == NULL){
        $Users->addMachineLigneFacture($libelle, $duree, $idMachine);
        if($idConsommable != NULL) {
            $Users->addConsommableLigneFacture($libelle, $quantite, $idConsommable);
        }

        if(isset($_POST['duree_presta']) && isset($_POST['presta']))
        {
            $prix_presta = $Machines->getBy(['id' => $idMachine])[0]->prestation;
            $Users->addPrestationLigneFacture($duree_presta, $prix_presta);
        }

        $Reservations->delete($idReservation);
    }

    return $response->withHeader('Location', '/utilisateur')->withStatus(302);
});
