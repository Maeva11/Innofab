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


