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
    (new $CRUD())->set($_POST, @$_FILES);
    Tools::redirect(ADMIN_URL . "crud/" . $CRUD);
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