<!doctype html>
<html lang="<?= LANG ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= WEBSITE_NAME ?> - <?= @$data[0]['PageName'] ?></title>
    <link rel="icon" type="image/png" sizes="32x32" href="<?= ASSETS_DIR ?>favicon.png">
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
        <script async src="https://www.googletagmanager.com/gtag/js?id=GTAG_COD"></script>
    
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() {
            dataLayer.push(arguments);
        }
        // Default consent mode is "denied" for both ads and analytics, but delay for 2 seconds until the Cookie Solution is loaded
        gtag('consent', 'default', {
            'ad_storage': 'denied',
            'analytics_storage': 'denied'
        });
        gtag('js', new Date());
        gtag('config', 'GTAG_CODE');
        gtag("send", "pageview");
    </script>
<body>
<?php include("parts/header.php"); ?>
<div id="<?= Tools::slug_file(@$data[0]['PageName']) ?>">
    <?php
    if (!empty($data[0]['block'])) {
        foreach ($data[0]['block'] as $el) {
            echo (new Blockbuilder())->generateBlock($el->id_block, $el->datas, Tools::slug_file(@$data[0]['PageName']),  $data[1], $data[0]);
        }
    }
    if ($data[0]["page"]) {
        include("blocks/" . $data[0]["page"] . ".php");
    }
    ?>
</div>
<?php
include("parts/footer.php");
/**if (DEBUG_TPNG == TRUE) {
include('parts/debug.php');}**/ ?>
</body>
</html>
