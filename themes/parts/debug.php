<style>
    /*****CSS DEBUG****/
    .popup-debug {
        width: 45%;
        padding: 50px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 999;
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
        background: #fff;
        box-shadow: 0 0 10px 1px #1a1a1a;
        border-radius: 1em;
    }

    .popup-debug .navbar-debug {
        display: flex;
        justify-content: space-around;
        width: 100%;
        margin-top: 1em;
    }

    .popup-debug .navbar-debug a, .popup-debug .navbar-debug a:hover {
        background: linear-gradient(60deg, #83bd73, #53a83b);
        padding: 1em 2em;
        color: #fff;
        text-decoration: none;
        border-radius: 0.5em;
        cursor: pointer;
    }
    .back-debugPopup{
        width: 100%;
        height: 100%;
        background: #1a1a1a5c;
        position: fixed;
        top: 0;
        left: 0;
    }
</style>
<script>
    var timer;
    $('img').on("mousedown", function () {
        var src = $(this).attr('src').split('/');
        var url = '/' + src[src.length - 2] + '/' + src[src.length - 1];
        timer = setTimeout(function () {
            $.get("<?= THEME_DIR ?>assets/optimize" + url, function () {
                $("body").append(popup("Cette image a été optimisée !<br><h5>(Il ne sera plus possible de la réoptimiser !)</h5>", "Retournez à la version précédente", "/unoptimize" + url, "Je garde cette version"));
            }).fail(function () {
                $("body").append(popup("Cette image n'a pas été optimisée !", "Optimiser l'image", "/optimize" + url, "Je garde cette version"));
            });
        }, 2 * 1000);
    }).on("mouseup mouseleave", function () {
        clearTimeout(timer);
    });

    function popup(phrase, btn1, url, btn2) {
        $("body .back-debugPopup").remove();
        return '<div class="back-debugPopup"><div class="popup-debug">' +
            '<h1>' + phrase + '</h1>' +
            '<div class="navbar-debug">' +
            '<a href="' + url + '" target="_blank" onclick="$(this).parent().parent().parent().remove()">' + btn1 + '</a>' +
            '<a onclick="$(this).parent().parent().parent().remove()">' + btn2 + '</a>' +
            '</div></div></div>';

    }
</script>