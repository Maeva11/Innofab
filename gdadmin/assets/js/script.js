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

tinymce.init({
    selector: '#editor',
    plugins: 'autolink lists link image charmap print preview hr anchor pagebreak textcolor',
    toolbar: 'undo redo | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | forecolor backcolor',
});

$(document).ready(function(){
    let clickedEditableContent; // Variable pour stocker la référence à l'élément .editable-content cliqué

    $('.editable-content').click(function(event) {
        event.stopPropagation();
        clickedEditableContent = $(this); // Stocker la référence à l'élément cliqué
        let content = $(this).html();
        tinymce.activeEditor.setContent(content);
        $('#editor-popup').show();
    });

    $('#save').click(function() {
        let content = tinymce.activeEditor.getContent();
        clickedEditableContent.html(content); // Utiliser la référence à l'élément cliqué
        let wrapperId = clickedEditableContent.closest('.el-wrapper').data('id'); // Cibler l'élément parent de l'élément cliqué
        let editableContentId = clickedEditableContent.attr('id');

        $('#editor-popup').hide();

        $.ajax({
            url: '/liveedit',
            type: 'POST',
            data: {content: content, wrapperId: wrapperId, editableContentId: editableContentId},
            success: function(response) {
                location.reload();
            }
        });
    });

    $('.popup-overlay').click(function() {
        $('#editor-popup').hide();
    });
});

