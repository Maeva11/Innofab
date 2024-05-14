<div class="wave">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#ff5500" fill-opacity="5"
            d="M0,0L34.3,0C68.6,0,137,0,206,53.3C274.3,107,343,213,411,218.7C480,224,549,128,617,112C685.7,96,754,160,823,154.7C891.4,149,960,75,1029,69.3C1097.1,64,1166,128,1234,160C1302.9,192,1371,192,1406,192L1440,192L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z">
        </path>
    </svg>
</div>

<style>
.wave {
    position: relative;
    width: 100%;
    background-color : #f7f7f7;
    z-index: -1;
}

.wave svg {
    bottom: 0;
    width: 100%;
    height: auto;
    filter: drop-shadow(0px -10px 10px rgba(0, 0, 0, 0.3));
    
}

/* Media queries pour ajuster la vague en fonction de la largeur de l'écran */
@media (max-width: 1199.98px) {
    .wave svg {
        height: auto;
    }
}

@media (max-width: 991.98px) {
    .wave svg {
        height: auto;
    }
}

@media (max-width: 767.98px) {
    .wave svg {
        height: auto;
    }
}

@media (max-width: 575.98px) {
    .wave svg {
        height: auto;
    }
}

</style>