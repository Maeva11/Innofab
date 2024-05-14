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
    $User = new users();


    $email = $_POST['email'] ?? '';
    $password = $_POST['pwd'] ?? '';

    try {
        $id = $User->verifyPassword($email, $password);
        if ($id !== false) {

            $_SESSION["user"] = $id;
            // TODO redirect to page user connected
            //redirect to home
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



