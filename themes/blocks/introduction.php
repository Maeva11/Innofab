<style>

    .valeur {
        overflow-x: hidden;
        background: #1F2243;
        position: relative;
        height: 450px;
    }

    .list {
        height: 200px;
        position: absolute;
        top: 45%;
        left: 50%;
        transform: translate(-50%,-50%)
    }

    .list li {
        list-style-type: none;
        width: 300px;
        height: auto;
        opacity: .25;
        position: absolute;
        left: 50%;
        margin-left: -100px;
        border-radius: 2px;
        background: #9C89B8;
        transition: transform 1s, opacity 1s;
    }

    .list .act {
        opacity: 1;
    }

    .list .prev,
    .list .next {
        cursor: pointer;
    }

    .list .prev {
        transform: translateX(-350px) scale(.85);
    }

    .list .next {
        transform: translateX(350px) scale(.85);
    }

    .list .hide {
        transform: translateX(-420px) scale(.85);
    }

    .list .new-next {
        transform: translateX(420px) scale(.85);
    }

    .list .hide,
    .list .new-next {
        opacity: 0;
        transition: opacity .5s, transform .5s;
    }

    .swipe {
        width: 270px;
        height: 200px;
        position: absolute;
        background-color: green;
        border-radius: 2px;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
        opacity: 0;
    }
</style>

<section class="valeur">
    <ul class="list">
        <li class="col text-center shadow-lg rounded bg-white prev">
            <i class="fas fa-wrench fa-3x rounded-circle mb-2 p-4 pb-0" style="color:#EA581D"></i>
            <div class="card border-0 bg-transparent">
                <div class="card-body">
                    <h5 class="card-title">Créer</h5>
                    <p class="card-text border-3">Les machines du fablab sont accessibles aux adhérents<br><br>

                        Pensez à réserver votre créneau !</p>
                    <hr class="p-1" style="background-color:#EA581D">
                </div>
            </div>
        </li>
        <li class="col text-center shadow-lg rounded bg-white act">
            <i class="fas fa-clover fa-3x rounded-circle mb-2 p-4 pb-0" style="color:#EA581D"></i>
            <div class="card border-0 bg-transparent">
                <div class="card-body">
                    <h5 class="card-title">Partager</h5>
                    <p class="card-text border-3">Venez partager vos connaissances et compétences <br><br>
                        Les apéros projets c’est tous les derniers vendredis du mois !</p>
                    <hr class="p-1" style="background-color: #EA581D">
                </div>
            </div>
        </li>
        <li class="col text-center shadow-lg rounded bg-white next">
            <i class="fas fa-brain fa-3x rounded-circle mb-2 p-4 pb-0" style="color:#EA581D"></i>
            <div class="card border-0 bg-transparent">
                <div class="card-body">
                    <h5 class="card-title">Coopérer</h5>
                    <p class="card-text border-3">Venez participer à nos projets collaboratifs et à la vie de l’association
<br><br>
                        Contactez nous !</p>
                    <hr class="p-1" style="background-color: #EA581D">
                </div>
            </div>
        </li>
    </ul>

    <div class="swipe"></div>
</section>

<script>
    $(document).ready(function(){
        // Fonction pour déplacer le carousel vers la gauche
        function moveCarouselLeft() {
            var $currentAct = $(".list .act");
            var $nextAct = $currentAct.next().length ? $currentAct.next() : $(".list li").first();
            var $prevAct = $currentAct.prev().length ? $currentAct.prev() : $(".list li").last();

            $(".list li").removeClass("act prev next");

            $currentAct.removeClass("act").addClass("prev");
            $nextAct.removeClass("prev next").addClass("act");
            $prevAct.removeClass("prev next").addClass("next");

            $(".list li").not(".act").css("opacity", "0.25");
            $(".list .act").css("opacity", "1");

            $(".swipe").animate({left: '-=220px'}, 500, function(){
                $(".swipe").css("left", "-=220px");
            });
        }

        // Déplacement automatique du carrousel toutes les 15 secondes
        var interval = setInterval(function() {
            moveCarouselLeft();
        }, 5000);

        // Clic sur une carte du carrousel (désactivé)
        $(".list li").click(function(){
            // Désactiver les clics pendant le déplacement automatique
            return false;
        });
    });

</script>
