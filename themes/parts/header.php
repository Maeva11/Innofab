<header class="site-header">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-12 d-flex flex-wrap">


                <?php
                $links = (new Pagebuilder())->getAll("menu", "asc");
                foreach ($links as $link) {
                    if (!empty($link->LANG)) continue;
                    if (!$link->menu) continue; ?>
                    <p class="d-flex me-4 mb-0">
                        <a class="<?= ($_SERVER['REQUEST_URI'] == "/$link->url") ? "active" : "" ?>"
                           href="//<?= $_SERVER['HTTP_HOST']; ?>/<?= $link->url ?>"><?= $link->nom ?></a>
                    </p>
                <?php } ?>
            </div>
        </div>
    </div>
</header>


