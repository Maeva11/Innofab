<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->tpl = (new Slim\Views\PhpRenderer('templates/'));
/**********************ROUTES**********************/
$app->get('/', function (Request $request, Response $response, $args) use ($app) {
    $args = ['block' => ['console']];
    return $app->tpl->render($response, "page.php", $args);
})->setName('root');

$app->get('/crud/{crud}[/{action}[/{id}]]', function (Request $request, Response $response, $args) use ($app) {
    $CRUD = $args['crud'];
    if (!isset($args['action'])) {
        $args = ['block' => [$CRUD], 'datas' => (new $CRUD())->getAll()];
    } else {
        if ($args['action'] == "delete") {
            (new $CRUD())->remove(@$args['id']);
            Tools::redirect(ADMIN_URL . 'crud/' . $CRUD);
        }
        if ($args['action'] == "set") {
            $args = ['block' => ["set/" . $CRUD], 'datas' => @(new $CRUD())->get(@$args['id'])];
        }
    }
    return $app->tpl->render($response, "page.php", $args);
});
$app->post('/crud/{crud}[/{action}[/{id}]]', function (Request $request, Response $response, $args) use ($app) {
    $CRUD = $args['crud'];
    if (@$args['crud'] == "creationfacture") {
        $Factures = new Factures();
        $LignesFactures = new LignesFactures();


        if (isset($_POST['ids'])) {
            $lignesFactures = $LignesFactures->getLigneFactureByArrayId($_POST['ids']);

            if (!empty($lignesFactures)) {
                $date_facture = date("Y-m-d H:i:s");
                $id_user = $lignesFactures[0]->id_user;
                $prix_total = 0;

                foreach ($lignesFactures as $ligneFacture) {
                    $prix_total = $prix_total + ($ligneFacture->quantite_prix * $ligneFacture->prix_ligne);
                }

                $id_facture = $Factures->insertFacture($date_facture, $prix_total, $id_user);

                if (isset($id_facture)) {
                    foreach ($lignesFactures as $ligneFacture) {
                        $LignesFactures->updateIdFactureLigneFacture($ligneFacture->id, $id_facture);
                    }
                }
            }

            Tools::redirect(ADMIN_URL . "crud/factures");
        } else {
            echo "Aucune case à cocher n'a été sélectionnée.";
            Tools::redirect(ADMIN_URL . "crud/" . $CRUD);
        }
    } else if ($CRUD == "reservation" && isset($_POST['statut']) && isset($_POST['id'])) {
        // Mise à jour du statut
        $id = $_POST['id'];
        $statut = $_POST['statut'];
        $reservation = new Reservation();
        if ($reservation->updateStatus($id, $statut)) {
            Tools::redirect(ADMIN_URL . 'crud/reservation');
        } else {
            echo "Erreur lors de la mise à jour du statut.";
        }
    } else if ($CRUD == "reservation") {
        // Création ou mise à jour d'une réservation
        $reservation = new Reservation();
        error_log("Saving reservation");  // Debugging
        error_log(json_encode($_POST));  // Debugging

        $id_machine = $_POST['id_machine'];
        $id_user = $_POST['id_user'];
        $date_debut = $_POST['date_debut'];
        $date_fin = $_POST['date_fin'];
        $statut = $_POST['statut'];
        $id = isset($_POST['id']) ? $_POST['id'] : null;

        if ($reservation->save($id_machine, $id_user, $date_debut, $date_fin, $statut, $id)) {
            Tools::redirect(ADMIN_URL . 'crud/reservation');
        } else {
            echo "Erreur lors de la sauvegarde de la réservation.";
            error_log("Erreur lors de la sauvegarde de la réservation");  // Debugging
        }
    } else if ($CRUD == "priseRendezVous" && isset($_POST['statut']) && isset($_POST['id'])) {

        $rendezVous = new PriseRendezVous();

        $id = $_POST['id'];
        $statut = $_POST['statut'];
        $email = $_POST['email'];

        if ($statut === "1" || $statut === "0") {
            
            if ($rendezVous->updateAcceptStatus($id, $statut)) {

                $Mailer = new Mail();
                $Mailer->setTo($email);
                $subject = $statut === "1" ? "Demande de rendez vous accepté" : "Demande de rendez vous refusé";
                $body = $statut === "1" ? "<li>Votre demande de rendez vous a été acceptée</li>" : "<li>Votre demande de rendez vous a été refusée</li>";

                $Mailer->setSubject($subject);
                $Mailer->setBody($body);

                if ($Mailer->send()['success']) {
                    Tools::setFlash("success", 'Merci ! Nous vous répondrons dès que possible !');
                } else {
                    Tools::setFlash("error", 'Désolé, votre message n\'a pas été envoyé !');
                }

                Tools::redirect(ADMIN_URL . 'crud/priseRendezvous');
            } else {
                echo "Erreur lors de la mise à jour du statut.";
            }
        } else {
            Tools::redirect(ADMIN_URL . 'crud/priseRendezvous');
        }

    // } else if ($CRUD == "machines") {
    //     $id = $_POST['id'];
    //     $tags = isset($_POST['tags']) ? (is_array($_POST['tags']) ? $_POST['tags'] : explode(',', $_POST['tags'])) : [];


    //     $machineTag = new MachineTag();
    //     if ($machineTag->insertTagsOfMachine($id, $tags)) {
    //         Tools::redirect(ADMIN_URL . 'crud/machines');
    //     } else {
    //         echo "Erreur lors de l'insertion.";
    //         error_log("Erreur lors de la sauvegarde de la réservation");  // Debugging
    //     }
    // } else if ($CRUD == "generatepdf") {
    } else {
        (new $CRUD())->set($_POST, @$_FILES);
        Tools::redirect(ADMIN_URL . "crud/" . $CRUD);
    }
});
$app->get('/blockBuilder[/{action}[/{id}]]', function (Request $request, Response $response, $args) use ($app) {
    $builder = new Blockbuilder();
    if (@$args['action'] == "set") {
        (@$args['id'] > 0) ? $block = @$builder->getBy(['id' => $args['id']])[0] : '';
        $args = [$args, 'block' => ['set/blockbuilder'], 'fields' => (new GenerateForm())->getAll(), 'datasblock' => @$block];
    } else {
        (@$args['action'] == "delete") ? $builder->remove(@$args['id']) : '';
        $args = [$args, 'block' => ['blockbuilder'], "blocks" => $builder->getAll()];
    }

    if (empty($args['action']) || is_null($args['action'])) {
        $Pagebuilder = new Pagebuilder();
        $pages = $Pagebuilder->getAll();
        $used_blocks = [];
        foreach ($pages as $page) {
            foreach ($page->datas as $block) {
                $used_blocks[$block->id_block] = $page->id;
            }
            if (isset($page->datas_en)) {
                foreach (json_decode($page->datas_en) as $block) {
                    $used_blocks[$block->id_block] = $page->id;
                }
            }
        }
        $args['used_blocks'] = $used_blocks;
    }

    return $app->tpl->render($response, "page.php", $args);
});

$app->post('/blockBuilder[/{action}[/{id}]]', function (Request $request, Response $response, $args) use ($app) {
    (new Blockbuilder())->set($_POST);
    Tools::redirect(ADMIN_URL . 'blockBuilder');
});

//$app->post('/blockbuilder', function (Request $request, Response $response, $args) use ($app) {
//    (new Blockbuilder())->set($_POST);
//    return $response;
//});

$app->get('/pageBuilder[/{action}[/{id}]]', function (Request $request, Response $response, $args) use ($app) {
    $builder = new Pagebuilder();
    if (@$args['action'] == "set") {
        (@$args['id'] > 0) ? $page = @$builder->getBy(['id' => $args['id']])[0] : '';
        $args = [$args, 'block' => ['set/pagebuilder'], 'dataspage' => @$page];
    } else {
        (@$args['action'] == "delete") ? $builder->remove(@$args['id']) : '';
        (@$args['action'] == "duplicate") ? $builder->duplicatePage($args['id']) : '';
        $args = [$args, 'block' => ['pagebuilder'], "pages" => $builder->getAll()];
    }
    return $app->tpl->render($response, "page.php", $args);
});
$app->post('/pageBuilder[/{action}[/{id}]]', function (Request $request, Response $response, $args) use ($app) {
    $PageBuilder = new Pagebuilder();
    $params = [
        "nom" => $_POST['nom'],
        "url" => $_POST['url'],
        "title" => $_POST['title'],
        "description" => $_POST['description'],
        "parent" => intval($_POST['parent']),
        "id" => $_POST['id'],
        "datas" => [],
        "LANG" => "",
        "footer" => "3",
        "menu" => "0",
    ];

    $PageBuilder->set($params, @$_FILES);
    Tools::redirect(ADMIN_URL . 'pageBuilder');
});
$app->get('/terms', function (Request $request, Response $response, $args) use ($app) {
    $args = ['block' => ['terms'], 'datas' => (new Admin())->getTerms()];
    return $app->tpl->render($response, "page.php", $args);
});
$app->post('/terms', function (Request $request, Response $response, $args) use ($app) {
    (new Admin())->setTerms($_POST);
    Tools::redirect(ADMIN_URL . 'terms');
});
$app->get('/deconnexion', function (Request $request, Response $response, $args) use ($app) {
    @session_start();
    session_destroy();
    Tools::redirect(ADMIN_URL);
});

$app->get('/console[/{action}[/{id}]]', function (Request $request, Response $response, $args) use ($app) {
    $admin = new Admin();
    (empty(@$args['action'])) ? $args = ['block' => ['console']] : "";
    (@$args['action'] == "adminBuilder") ? $args = ['block' => ['console/adminbuilder'], 'datas' => @$admin->getDatas('', 'menu')] : "";
    (@$args['action'] == "administrateur") ? $args = ['block' => ['console/administrateur'], 'datas' => @$admin->getDatas('', 'auth')] : "";
    (@$args['action'] == "configuration") ? $args = ['block' => ['console/configuration'], 'datas' => @$admin->getBy(['block' => 'configuration'])[0]] : "";
    (@$args['action'] == "traduction") ? $args = ['block' => ['console/traduction'], 'datas' => @$admin->getAllLANG()] : "";
    (@$args['action'] == "navigation") ? $args = ['block' => ['console/navigation'], "datas" => @(new Pagebuilder())->getAll()] : "";
    (@$args['action'] == "archive") ? $args = ['block' => ['console/archive']] : "";
    (@$args['action'] == "favicon") ? $args = ['block' => ['console/favicon']] : "";
    if (@$args['action'] == "optimisation") {
        $admin->initTinyPNG();
        if (@$args['id'] == "all") {
            $admin->Compressing(0, 0);
            Tools::redirect(ADMIN_URL . 'console/optimisation');
            die();
        }
        $args = ['block' => ['console/optimisation'], 'datas' => $admin->countImages()];
    }
    if (@$args['action'] == "deleteAdmin") {
        $admin->deleteAdmin($args['id']);
    }
    if (@$args['action'] == "deleteTranslate") {
        $admin->deleteTrad($args['id']);
    }
    if (@$args['action'] == "archiveSQL") {
        $admin->archiveSQL();
        Tools::redirect(ADMIN_URL . 'console/archive');
        die();
    }
    return $app->tpl->render($response, "page.php", $args);
});
$app->post('/ajax/generateInputBuilder', function (Request $request, Response $response, $args) {
    echo (new GenerateForm())->generateInputBuilder(@$_POST['id']);
    return $response;
});
$app->post('/builder', function (Request $request, Response $response, $args) use ($app) {
    (new Admin())->set($_POST);
    Tools::redirect(ADMIN_URL . 'console/' . $_POST['redirect']);
});
$app->post('/translate', function (Request $request, Response $response, $args) use ($app) {
    (new Admin())->setLANG($_POST);
    Tools::redirect(ADMIN_URL . 'console/traduction');
});
$app->post('/navigation', function (Request $request, Response $response, $args) use ($app) {
    (new Pagebuilder())->setNavigation($_POST);
    Tools::redirect(ADMIN_URL . 'console/navigation');
});
$app->post('/favicon', function (Request $request, Response $response, $args) use ($app) {
    $source = $_FILES['image']['tmp_name'];
    $destination = '../themes/assets/favicon.png';
    $ico_lib = new Favicon($source, array(array(32, 32)));
    $ico_lib->save_ico($destination);
    Tools::redirect(ADMIN_URL . 'console/favicon');
    die();
});
$app->post('/ajax/generateBlockBuilder', function (Request $request, Response $response, $args) {
    echo (new Pagebuilder())->generateBlocks(@$_POST['id_block']);
    return $response;
});

$app->get('/generatepdf[/{action}[/{id}]]', function (Request $request, Response $response, $args) use ($app) {
    (new Generatepdf())->set($_POST);
    Tools::redirect(ADMIN_URL . 'generatepdf');
});
