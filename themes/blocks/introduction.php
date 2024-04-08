<style>

    .carousel-value #carousel {
        background-color: #1F2243;
        margin-top: 50px;
    }

    #carousel {
        height: 500px;
        overflow: hidden;
        padding-top: 50px;
        padding-bottom: 20px
    }

    #carousel > div {
        position: absolute;
        transition: transform 0.8s, left 1s, opacity 1s, z-index 0s;
        opacity: 1;
    }

    #carousel > div .card-carousel {
        width: 400px;
        height: 400px;
        border-radius: 20px;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        font-family: 'Arial', sans-serif;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 15px;
        align-items: center;
        transition: width 1s;
    }

    #carousel div.prev {
        z-index: 5;
        left: 30%;
        transform: translateY(50px) translateX(-50%);
    }

    #carousel div.prev p {
        font-size: 10px;
    }

    #carousel div.prev .card-carousel {
        width: 300px;
        height: 300px;
    }

    #carousel div.prev .user-pic {
        width: 80px;
        height: 80px;
    }

    #carousel div.prev .user-pic img {
        width: 80px;
        height: 80px;
    }

    #carousel div.selected {
        z-index: 10;
        left: 50%;
        transform: translateY(0px) translateX(-50%);
    }

    #carousel div.next {
        z-index: 5;
        left: 70%;
        transform: translateY(50px) translateX(-50%);
    }

    #carousel div.next p {
        font-size: 10px;
    }

    #carousel div.next .card-carousel {
        width: 300px;
        height: 300px;
    }

    #carousel div.next .user-pic {
        width: 80px;
        height: 80px;
    }

    #carousel div.next  .user-pic img {
        width: 80px;
        height: 80px;
    }

    .user-pic {
        width: 150px;
        height: 150px;
        overflow: hidden;
        border-radius: 100%;
        margin: 20px auto 20px;
        border-left: 3px solid #ddd;
        border-right: 3px solid #ddd;
        border-top: 3px solid #007bff;
        border-bottom: 3px solid #007bff;
        transform: rotate(-30deg);
        transition: 0.5s;
    }

    .user-pic img {
        width: 145px;
        height: 145px;
    }

    .card-carousel:hover .user-pic {
        transform: rotate(0deg);
        transform: scale(1.1);
    }

    .card-carousel h4 {
        font-size: 1.5rem;
    }

    .card-carousel p {
        color: #808080;
        font-size: 15px;
    }

</style>

<section class="carousel-value">

    <div id="carousel">
        <?php
        $Valeurs = new Valeur();
        $valeurs = $Valeurs->getBy(['active' => 1]);

        foreach ($valeurs as $valeur) {
            ?>
            <div>
                <div class="card-carousel">
                    <div class="user-pic">
                        <img src="<?= $valeur->image ?>"
                             class="img-fluid" alt="User Pic">
                    </div>
                    <h4><?= $valeur->titre ?></h4>
                    <hr>
                    <p><?= $valeur->description ?></p>
                    <hr>
                </div>
            </div>
            <?php
        }
        ?>
    </div>

</section>

<script>
    let currentIndex = 0; // Index de l'élément sélectionné au début

    function moveToSelected(elementIndex) {
        const elements = $("#carousel > div");

        // Assurez-vous que l'index est dans les limites
        currentIndex = (elementIndex + elements.length) % elements.length;

        elements.each(function (index, element) {
            const $element = $(element);
            $element.removeClass();

            if (index === currentIndex) {
                $element.addClass("selected");
            } else if (index === (currentIndex + 1) % elements.length) {
                $element.addClass("next");
            } else if (index === (currentIndex - 1 + elements.length) % elements.length) {
                $element.addClass("prev");
            }
        });
    }

    function startCarousel() {
        moveToSelected(currentIndex);

        setTimeout(function () {
            currentIndex = (currentIndex + 1) % $("#carousel > div").length;
            moveToSelected(currentIndex);
            startCarousel();
        }, 3000); // Change every 3 seconds
    }

    function handleCarouselClick() {
        stopCarousel();
        const clickedIndex = $(this).index();
        currentIndex = clickedIndex;
        moveToSelected(currentIndex);
        setTimeout(startCarousel, 2000); // Wait for 2 seconds after manual click to start auto scroll again
    }

    function stopCarousel() {
        clearTimeout();
    }

    startCarousel();

    $('#carousel > div').click(handleCarouselClick);
</script> 
