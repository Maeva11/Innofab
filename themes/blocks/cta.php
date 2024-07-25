<?php
$Rassurance = new Rassurance();
$datas = $Rassurance->getBy(['active' => 1]);
?>
<div class="wrap uppermain cta-block">
    <div class="uppermain">
        <div class="container t3-sl">
            <div class="t3-module module " id="Mod332">
                <div class="module-inner">
                    <div class="module-ct">

                        <div class="custom">
                            <div id="counter" class="homepage">
                                <?php foreach ($datas as $data) { ?>
                                    <div class="col-md-3 col-sm-3">
                                        <div class="counter-value"><i class="<?= $data->logo ?>"></i><span class="purecounter" data-chiffre="<?= $data->chiffre ?>">0</span>
                                            <h4><?= $data->title ?></h4>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div></div>
                                <div style="clear: both;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        function isScrolledIntoView($elem) {
            var docViewTop = $(window).scrollTop();
            var docViewBottom = docViewTop + $(window).height();
            var elemTop = $elem.offset().top;
            var elemBottom = elemTop + $elem.height();
            return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
        }

        function animateCounter() {
            $('.purecounter').each(function() {
                var $this = $(this);
                var countTo = $this.attr('data-chiffre');
                if (!$this.hasClass('counted') && isScrolledIntoView($this)) {
                    $this.addClass('counted'); // Ajoutez une classe pour éviter les répétitions
                    $({ countNum: $this.text() }).animate({
                            countNum: countTo
                        },
                        {
                            duration: 2000,
                            easing: 'linear',
                            step: function() {
                                $this.text(Math.floor(this.countNum));
                            },
                            complete: function() {
                                $this.text(this.countNum);
                            }
                        });
                }
            });
        }

        // Exécute l'animation au chargement initial
        animateCounter();

        // Exécute l'animation lors du défilement
        $(window).on('scroll', function() {
            animateCounter();
        });
    });
</script>