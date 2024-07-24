<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->tpl = (new Slim\Views\PhpRenderer('themes/'));
/**********************ROUTES GET**********************/
$app->get('/detectUselessBlocks', function (Request $request, Response $response, $args) use($app){
   echo "<h2>Detect useless blocks</h2>";
    $Pagebuilder = new Pagebuilder();
    $pages = $Pagebuilder->getAll();

    $used_blocks = [];
    foreach($pages as $page){
        foreach($page->datas as $block){
            $used_blocks[$block->id_block] = $page->id;
        }
        foreach(json_decode($page->datas_en) as $block) {
            $used_blocks[$block->id_block] = $page->id;
        }
    }

    $Blockbuilder = new Blockbuilder();
    $blocks = $Blockbuilder->getAll();

    foreach ($blocks as $block){
        if(!isset($used_blocks[$block->id])){
            echo "<h2>Le bloc : ".$block->nom." n'est pas utilisé</h2>";
        }
        if(isset($used_blocks[$block->id])){
            echo "<h2>Le bloc : ".$block->nom." est utilisé par la page ".$page->id."</h2>";
        }
    }

    die;
});
$app->get('/optimize[/{dir}/{file}]', function (Request $request, Response $response, $args) use ($app) {
    ((new Admin())->debugCompressing($args['dir'], $args['file'], "optimize")) ? $response->getBody()->write("Votre image a bien été optimisé") : "";
    return $response;
});
$app->get('/unoptimize[/{dir}/{file}]', function (Request $request, Response $response, $args) use ($app) {
    ((new Admin())->debugCompressing($args['dir'], $args['file'], "unptimize")) ? $response->getBody()->write("image d'origine récupérer") : "";
    return $response;
});
$app->get('/resetPassword/{key}', function (Request $request, Response $response, $args) use ($app) {
    return $app->tpl->render($response, "resetPassword.php", $args = ["key" => $args['key']]);
});

// PDF facture
$app->get('/generatepdf', function (Request $request, Response $response, $args) use ($app) {
    define('EURO', chr(128));
    define('EAIGU', chr(233));
    define('EGRAVE', chr(232));
    define('AAIGU', chr(224));

    $total_a_payer = 0;    

    $Factures = new Factures();
    $LignesFactures = new LignesFactures();
    $Users = new Users();
    
    $idfacture = $_GET['idfacture'];

    $facture = $Factures->getBy(['id' => $idfacture])[0];

    $date_facture = new DateTimeImmutable($facture->date_facture);

    // Create a timestamp for the given date
    $date = strtotime($facture->date_facture);

    // Format the date
    $formattedDate = strftime('%A %e %B %Y', $date);

    $datefacturedisplay = ucfirst($formattedDate);

    if(isset($facture))
    {
        $lignesFactures = $LignesFactures->getBy(['id_facture' => $idfacture]);
        $user =$Users->getBy(['id' => $facture->id_user])[0];
    }

    $pdf = new FPDF('P', 'mm', 'A4');
    
    $pdf->AddFont('LiberationSans','','LiberationSans-Regular.php');
    $pdf->AddFont('LiberationSans','B','LiberationSans-Bold.php');

    $pdf->AddPage();


    $pdf->SetFont('LiberationSans', 'B', 20);
    $pdf->Cell(180, 10, 'FACTURE No : '.$date_facture->format('Y').'-'.$facture->id, 0, 1, 'C');
    $pdf->SetFont('LiberationSans', 'B', 15);
    $pdf->Cell(180, 8, $datefacturedisplay, 0, 1, 'C');

    $pdf->Cell(180, 10, '', 0, 1);

    
    $pdf->SetFont('LiberationSans', 'B', 15);
    $pdf->Cell(71, 8, 'INNOFAB', 0, 0);
    $pdf->Cell(59, 8, '', 0, 0);
    $pdf->Cell(59, 8, 'Factur'.EAIGU.' '.AAIGU, 0, 1);


    $pdf->SetFont('LiberationSans', '', 10);
    $pdf->Cell(130, 5, 'Espace Ressources', 0, 0);
    $pdf->Cell(25, 5, 'ID Adh'.EAIGU.'rent :', 0, 0);
    $pdf->Cell(34, 5, $user->id, 0, 1);

    $pdf->Cell(130, 5, 'Le Causse Espace d\'Entreprises', 0, 0);
    $pdf->Cell(25, 5, 'Nom :', 0, 0);
    $pdf->Cell(34, 5, $user->nom, 0, 1);

    $pdf->Cell(130, 5, '81100 Castres', 0, 0);
    $pdf->Cell(25, 5, 'Pr'.EAIGU.'nom :', 0, 0);
    $pdf->Cell(34, 5, $user->prenom, 0, 1);
    
    $pdf->Cell(130, 5, 'www.innofab.fr', 0, 0);
    $pdf->Cell(25, 5, 'Adresse mail : ', 0, 0);
    $pdf->Cell(34, 5, $user->email, 0, 1);

    $pdf->Cell(130, 5, 'fabmanager.innofab@gmail.com', 0, 0);
    $pdf->Cell(25, 5, 'Adresse : ', 0, 0);
    $pdf->MultiCell(34, 5, $user->address, 0, 1);

    $pdf->SetFont('LiberationSans', 'B', 10);
    $pdf->Cell(189, 10, '', 0, 1);
    
    $pdf->Cell(50, 10, '', 0, 1);
    
    $pdf->SetFont('LiberationSans', 'B', 10);
    $pdf->Cell(85, 6, 'Description', 1, 0, 'C');
    $pdf->Cell(33, 6, 'Qte', 1, 0, 'C');
    $pdf->Cell(35, 6, 'Prix', 1, 0, 'C');
    $pdf->Cell(35, 6, 'Total', 1, 1, 'C');
    

    $pdf->SetFont('LiberationSans', 'B', 10);
    foreach ($lignesFactures as $ligneFacture) {
        $pdf->Cell(85, 6, $ligneFacture->libelle, 1, 0);
        $pdf->Cell(33, 6, $ligneFacture->quantite_prix, 1, 0, 'R');
        $pdf->Cell(35, 6, $ligneFacture->prix_ligne.' '.EURO, 1, 0, 'R');
        $pdf->Cell(35, 6, $ligneFacture->quantite_prix*$ligneFacture->prix_ligne.' '.EURO, 1, 1, 'R');
        $total_a_payer = $total_a_payer + ($ligneFacture->quantite_prix*$ligneFacture->prix_ligne);
    }
    
    $pdf->Cell(123, 6, '', 0, 0);
    $pdf->Cell(30, 6, 'Total '.AAIGU.' payer', 0, 0);
    $pdf->Cell(35, 6, $total_a_payer.' '.EURO, 1, 1, 'R');
    
    $pdf->Cell(188, 20, '', 0, 1);
    
    $pdf->SetFont('LiberationSans', '', 8);
    $pdf->Cell(188, 6, 'Association loi 1901 - Non assujetti '.AAIGU.' la TVA', 0, 1, 'C');
    $pdf->Cell(188, 6, 'No SIRET 813 526 951 00013', 0, 1, 'C');
    $pdf->Cell(188, 6, 'APE 9499 Z', 0, 1, 'C');
    $pdf->Cell(188, 6, 'Le r'.EAIGU.'glement est '.AAIGU.' effectuer par ch'.EGRAVE.'que '.AAIGU.' l\'ordre de INNOFAB', 0, 1, 'C');
    $pdf->Cell(188, 6, 'Ou par virement, CIC Sud Ouest IBAN : FR76 1005 7190 4900 0200 7200 118 BIC : CMCIFRPP', 0, 1, 'C');

    // Capture du contenu PDF
    $pdfContent = $pdf->Output('S');

    // Répondre avec le PDF
    $response->getBody()->write($pdfContent);
    return $response->withHeader('Content-Type', 'application/pdf')
                    ->withHeader('Content-Disposition', 'inline; filename="facture.pdf"');
});

$app->get('/deconnexion', function (Request $request, Response $response, $args) use ($app) {
    @session_start();
    session_destroy();
    Tools::redirect('/');
});

$app->get('/[{url}[/{id}[/{titre}]]]', function (Request $request, Response $response, $args) use ($app) {
    $id = $args['id'] ?? null;
    $blockbuilder = new Blockbuilder();
    $blocks = $blockbuilder->getAll();
    Tools::addAvis();
    $Structure = new Structure();

    $url = $args['url'] ?? "";
    $Pagebuilder = new Pagebuilder();
    $page = $Pagebuilder->getPageByURL(@$args['url']);
    $app->breadcrumb = $Pagebuilder->getBreadcrumb($page, $id);

    // faire passer des variables aux pages internes
    $params = [
        'id' => $id,
    ];
    $structure = $Structure->generateHtml($url, $app, $params);

    $datas = [
        "page" => (new Pagebuilder())->getPageByURL($url),
        "app" => $app,
        "id" => $id,
        "structure" => $structure,
        "blocks" => $blocks
    ];

    if ((!empty($args['url']) && $args['url'] == "article") && (!empty($args['id']) && $args['id'] > 0)) {
        $datas["breadcrumb"] = (new articles())->get($args['id'])->title ?? "";
    }

    $render = new Slim\Views\PhpRenderer('themes/');
    return $render->render($response, "page.php", $datas);
});

$app->post('/resetPassword[/{key}]', function (Request $request, Response $response, $args) use ($app) {
    if (!empty($args['key'])) {
        (new Auth())->resetPassword($args['key'], $_POST);
    } else {
        (new Auth())->ActiveResetPassword($_POST);
    }
    Tools::redirect('/');
});
$app->post('/editLANG', function (Request $request, Response $response, $args) use ($app) {
    @session_start();
    $_SESSION['lang'] = @$_POST['lang'];
    return $response;
});


$app->post('/contact', function (Request $request, Response $response, $args) use ($app) {
    $Mailer = new Mail();
    $Mailer->setSubject("Demande de contact");
    $Mailer->setBody("<li>Nom : " . @$_POST['nom'] . "</li><li>Téléphone : " . @$_POST['telephone'] . "</li><li>Email : " . @$_POST['email'] . "</li><li>Message : " . @$_POST['message'] . "</li>");
    if ($Mailer->send()['success']) {
        Tools::setFlash("success", 'Merci ! Nous vous répondrons dès que possible !');
    } else {
        Tools::setFlash("error", 'Désolé Votre message n\'a pas été envoyée  !');
    }
    Tools::redirect('/contact');
});

/*
$app->get('/sitemap.xml', function() use($app){
	header('Content-Type: application/xml; charset=utf-8');

	$xml = '<?xml version="1.0" encoding="UTF-8"?>
	<urlset
	xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
	xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
	xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
	http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
	<url>
	<loc>'.BASE_URL.'</loc>
	<lastmod>'.date('Y-m-d\TH:i:s').'+00:00</lastmod>
	</url>';
	$app->aMenu = $app->oMenuClass->getPagesTree();
	foreach($app->aMenu as $menu){
		$xml .= '<url>
			<loc>'.BASE_URL.Tools::getPageURL($menu['associatePage']).'</loc>
			<lastmod>'.date('Y-m-d\TH:i:s').'+00:00</lastmod>
			</url>';
	}
	$oActuClass = new Ttil(DB_PREFIX.'ttil', 'actu');
	$articles = $oActuClass->getAllActive();
	foreach($articles as $article){
		$xml .= '<url>
		<loc>'.substr(BASE_URL,0,-1).Tools::actuLink($article->id, $article->title).'</loc>
		<lastmod>'.date('Y-m-d\TH:i:s').'+00:00</lastmod>
		</url>';
	}
	$xml .= '</urlset>';
	echo $xml;
	die;
});*/