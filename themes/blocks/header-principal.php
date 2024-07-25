<div class="slider_bg">
    <h1 class="cd-headline rotate-1 text-white mb-4 pb-2">
        <span>InnoFab pour</span>
        <span class="cd-words-wrapper" style="width: 217px;">
                                    <b class="is-visible">Imaginer</b>
                                    <b class="is-hidden">Créer</b>
                                </span>

        <a class="custom-btn btn button" href="#intro-section">
            <span>Qui sommes-nous ?</span>
        </a>

    </h1></div>

<?php
$Membres = new Membres();
$datas = $Membres->getBy(['active' => 1], 'id', 'DESC');
?>
<section class="logoslider">
    <h2>Nos membres fondateurs</h2>
    <div class="logos">
        <div class="logo_items">
            <?php
            for ($j = 0; $j < 23; $j++) {
                foreach ($datas as $data) {
                    ?>
                    <img style="width: 200px; height: 100px; object-fit: contain; margin-left: 30px; margin-right: 30px"
                         src="<?= $data->logo ?>" alt="Logo">
                    <?php
                }
            }
            ?>
        </div>
    </div>
</section>

<div class="wrap topsl_bg ">
    <div class="topsl_inner container t3-sl">
        <div class="t3-module module " id="Mod331">
            <div class="module-inner">
                <div class="module-ct">

                    <div class="custom">
                        <div class="what-we-do-wrap">
                            <div class="col-md-6 col-sm-6 col-xs-12 what-we-do">
                                <div class="clearfix margin-bottom-2">
                                    <figure class="img-leading"><img class="img-responsive"
                                                                     src="/themes/assets/images/img-about.png"></figure>
                                    <div class="glow-wrap"><i class="glow"></i></div>
                                </div>
                            </div>
                            <!--end item-->
                            <div class="col-md-6 col-sm-6 col-xs-12 what-we-do">
                                <p>&nbsp;</p>
                                <br>
                                <div class="bordered-title"><h4>Innofab</h4></div>
                                <h1 class="leading">Un espace où vos idées vont prendre réalité !</h1>
                                <p class="intro-about">Lorem Ipsum is simply dummy text of the printing and typesetting
                                    industry. Ever since
                                    the 1500s, when an unknown printer took a galley of type and scrambled it to make a
                                    type
                                    specimen book.</p>
                                <div class="col-xs-12 col-lg-6 col-md-6">
                                    <ul>
                                        <li><i class="fa fa-medkit" aria-hidden="true"> </i><a href="#">Professional
                                                Consultancy </a></li>
                                        <li><i class="fa fa-money" aria-hidden="true"> </i> <a href="#">Financial
                                                Opportunities</a></li>
                                    </ul>
                                </div>
                                <div class="col-xs-12 col-lg-6 col-md-6">
                                    <ul>
                                        <li><i class="fa fa-handshake-o" aria-hidden="true"> </i><a href="/../amitza/">Solution
                                                Partnership</a></li>
                                        <li><i class="fa fa-bar-chart" aria-hidden="true"> </i><a href="/../amitza/">Marketing
                                                Research</a></li>
                                    </ul>
                                </div>
                                <br><br><br>
                                <div style="clear: both; margin-top: 20px;" class="styled-text">
                                    <p>Lorem Ipsum is simply
                                        dummy text of the printing and typesetting industry. Ever since the 1500s, when
                                        an
                                        unknown printer took a galley of type...</p>
                                </div>
                                <p>&nbsp;</p>
                                <br> <a href="#" class="tp-button red exeltis"
                                        style="min-height: 0px; min-width: 0px; line-height: 27px; border-width: 0px; margin: 0px; padding: 15px; letter-spacing: 0px; font-size: 16px;">SEE
                                    OUR PROJECTS </a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>