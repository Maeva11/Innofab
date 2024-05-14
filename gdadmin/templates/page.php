<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>Administration</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/themes/assets/favicon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/themes/assets/favicon.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/themes/assets/favicon.png">
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport'/>
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>
    <link href="<?= ADMIN_URL ?>assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet"/>
    <link href="<?= ADMIN_URL ?>assets/css/styleAdmin.css?v=2.1.2" rel="stylesheet"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <?= (!empty(JQUERY)) ? Tools::mapJs(JQUERY) : ''; ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.9.1/tinymce.min.js"
            integrity="sha512-wL4f713UTdXFhzoGj57R7cKAwWMp48nzQ4Z/OLy7r8Hrqsa53x3y9Wl1N27hNktcmmHUABHuIX5xQazAl0VMRg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.9.1/skins/content/dark/content.min.css"
          integrity="sha512-AwNEPWRQ809f3JZcq5PIUno3Iu2ElGhnT6hd7XXePM+3V0gA69WWW7Im8EU4uJsMnGmt7is8JuIopMdYstYLqg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link href="<?= ADMIN_URL ?>assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"
            integrity="sha512-hJsxoiLoVRkwHNvA5alz/GVA+eWtVxdQ48iy4sFRQLpDrBPn6BFZeUcW4R4kU+Rj2ljM9wHwekwVtsb0RY/46Q=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.11.2/jquery.mask.min.js"
            integrity="sha512-Y/GIYsd+LaQm6bGysIClyez2HGCIN1yrs94wUrHoRAD5RSURkqqVQEU6mM51O90hqS80ABFTGtiDpSXd2O05nw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
<div class="wrapper">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="/assets/img/sidebar-1.jpg">
        <div class="logo"><a href="<?= ADMIN_URL ?>" class="simple-text logo-normal"><img
                        src="/gdadmin/assets/images/logo-innofab-rose.png"></a></div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                <?php if ($_SESSION['role'] == "root") { ?>
                    <li class="nav-item active"><a class="nav-link" href="<?= ADMIN_URL ?>"><i class="material-icons">dashboard</i>
                            <p>Tableau de bord</p></a></li>
                    <li class="nav-item "><a class="nav-link" href="<?= ADMIN_URL ?>blockBuilder"><i
                                    class="fas fa-cubes"></i>
                            <p>BlockBuilder</p></a></li>
                    <li class="nav-item "><a class="nav-link" href="<?= ADMIN_URL ?>pageBuilder"><i
                                    class="fas fa-pager"></i>
                            <p>Mes pages</p></a></li>
                <?php } else { ?>
                    <li class="nav-item "><a class="nav-link" href="<?= ADMIN_URL ?>console/configuration"><i
                                    class="fas fa-puzzle-piece"></i>
                            <p>Configuration</p></a></li>
                <?php } ?>
                <div class="post-divider"></div>
                <?php
                $menu = (new Admin())->getDatas('', 'menu')['datas'];
                foreach ($menu as $el) { ?>
                    <li class="nav-item "><a class="nav-link" href="<?= ADMIN_URL ?>crud/<?= @$el->url ?>""><i
                                class="<?= @$el->icone ?>"></i>
                        <p><?= @$el->nom ?></p></a></li>
                <?php } ?>
                <li class="nav-item "><a class="nav-link" href="<?= ADMIN_URL ?>terms"><i class="fas fa-pen"></i>
                        <p>Mentions légales</p></a></li>
            </ul>
        </div>
    </div>
    <div class="main-panel">
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
            <div class="container-fluid justify-content-end">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown"><i
                                    class="material-icons">person</i></a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                            <a class="dropdown-item" href="/">Voir mon site</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= ADMIN_URL ?>deconnexion">Déconnexion</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="mt-5 pt-5">
            <?php
            if (!empty($data['block'])) {
                foreach ($data['block'] as $block) {
                    include('parts/' . $block . '.php');
                    include ('parts/stats.php');
                }
            }
            ?>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<?= (!empty(JQUERY_UI)) ? Tools::mapJs(JQUERY_UI) : ''; ?>
<script src="<?= ADMIN_URL ?>assets/js/gdadmin.js"></script>
<script>
    /**  $("textarea:not('textarea#structure')").each(function () {
     Simditor.locale = 'en-US';
     editor = new Simditor({
     textarea: $(this),
     placeholder: '',
     toolbar: ['title', 'bold', 'italic', 'underline', 'strikethrough', 'fontScale', 'color', '|', 'ol', 'ul', 'blockquote', 'code', 'table', '|', 'link', 'image', 'hr', '|', 'indent', 'outdent', 'alignment'],
     pasteImage: true,
     defaultImage: 'assets/images/image.png',
     forced_root_block : false,
     force_br_newlines : true,
     force_p_newlines : false,
     upload: location.search === '?upload' ? {
     url: '/upload'
     } : false
     });
     });**/
</script>
</body>

</html>