$(document).ready(function () {
    $('.addblock').on('click', function () {
        $('.display-popup').addClass('show-popup');
    });

    $('.listing-block').on('click', function (event) {
        event.stopPropagation();
    });

    $('.display-popup').on('click', function () {
        $(this).removeClass('show-popup');
    });

    $('.block-item').on('click', function () {
        let blockId = $(this).data('id');
        let pageId = $('body').data('id');
        sendBlock(blockId, pageId);
    });

    $('.deleteBlock').on('click', function (e) {
        let parentId = $(this).closest('.el-wrapper').data('id');
        sendDeleteBlock(parentId);
    });
});

function sendBlock(blockId, pageId) {
    $.ajax({
        url: '/sendBlock',
        method: 'POST',
        data: {blockId: blockId, pageId: pageId}, // Données à envoyer
        success: function (response) {
            if (response === "success") {
                location.reload();
            } else {
                console.error('Erreur lors de la suppression:', response);
            }
        },
        error: function (error) {
            console.error('Erreur lors de la requête AJAX:', error);
        }
    });
}

function sendDeleteBlock(blockId) {
    let isConfirmed = confirm("Êtes-vous sûr de vouloir supprimer ce bloc ?");
    if (isConfirmed) {
        $.ajax({
            url: '/deleteBlock',
            method: 'POST',
            data: {blockId: blockId},
            success: function (response) {
                if (response === "success") {
                    location.reload(); // Rafraîchir la page en cas de succès
                } else {
                    console.error('Erreur lors de la suppression:', response);
                }
            },
            error: function (error) {
                console.error('Erreur lors de la requête AJAX:', error);
            }
        });
    }
}

