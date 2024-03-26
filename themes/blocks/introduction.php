<style>
    /* Styles généraux */
    .carousel-container {
        width: 80%;
        margin: 50px auto;
        position: relative;
    }

    .carousel-item {
        width: 100%;
        height: 300px;
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0.5;
        transition: opacity 0.5s;
    }

    .carousel-item.active {
        opacity: 1;
        z-index: 1;
    }

    .carousel-item:nth-child(1) {
        z-index: 2;
    }

    /* Styles pour les flèches de navigation */
    .prev, .next {
        cursor: pointer;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        font-size: 24px;
        font-weight: bold;
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        padding: 10px;
        border-radius: 50%;
    }

    .prev {
        left: 10px;
    }

    .next {
        right: 10px;
    }
</style>

<section class="carousel-container">
    <div class="carousel-item active">
        <img src="image1.jpg" alt="Image 1">
    </div>
    <div class="carousel-item">
        <img src="image2.jpg" alt="Image 2">
    </div>
    <div class="carousel-item">
        <img src="image3.jpg" alt="Image 3">
    </div>

    <!-- Flèches de navigation -->
    <div class="prev" onclick="changeSlide(-1)">❮</div>
    <div class="next" onclick="changeSlide(1)">❯</div>
</section>

<script>
    let currentIndex = 0;
    const items = document.querySelectorAll('.carousel-item');

    function changeSlide(n) {
        items[currentIndex].classList.remove('active');
        currentIndex += n;

        if (currentIndex >= items.length) {
            currentIndex = 0;
        } else if (currentIndex < 0) {
            currentIndex = items.length - 1;
        }

        items[currentIndex].classList.add('active');
    }
</script>