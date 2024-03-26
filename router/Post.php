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
});