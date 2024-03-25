String.prototype.sansAccent = function () {
    var accent = [
        /[\300-\306]/g, /[\340-\346]/g, // A, a
        /[\310-\313]/g, /[\350-\353]/g, // E, e
        /[\314-\317]/g, /[\354-\357]/g, // I, i
        /[\322-\330]/g, /[\362-\370]/g, // O, o
        /[\331-\334]/g, /[\371-\374]/g, // U, u
        /[\321]/g, /[\361]/g, // N, n
        /[\307]/g, /[\347]/g, // C, c
    ];
    var noaccent = ['A', 'a', 'E', 'e', 'I', 'i', 'O', 'o', 'U', 'u', 'N', 'n', 'C', 'c'];

    var str = this;
    for (var i = 0; i < accent.length; i++) {
        str = str.replace(accent[i], noaccent[i]);
    }

    return str;
}

tinymce.init({
    selector: 'textarea:not(.not-tiny)',
    plugins: ['lists link image hr anchor', 'code', 'table', 'paste', 'autoresize'],
    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist  outdent indent | link image',
    images_upload_url: '/gdadmin/tinymce_upload.php',
    images_upload_handler: function (blobInfo, success, failure) {
        var xhr, formData;
        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', '/gdadmin/tinymce_upload.php');
        xhr.onload = function () {
            var json;
            if (xhr.status != 200) {
                failure('HTTP Error: ' + xhr.status);
                return;
            }
            json = JSON.parse(xhr.responseText);
            if (!json || typeof json.location != 'string') {
                failure('Invalid JSON: ' + xhr.responseText);
                return;
            }
            success(json.location);
        };
        formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());
        xhr.send(formData);
    },
    forced_root_block: "",
    force_br_newlines: true,
    force_p_newlines: false,
    relative_urls: false,
    remove_script_host: false,
    convert_urls: true,
});

$(document).ready(function () {
    $('.addfield').on('click', function () {
        var id = $('.addfieldType select').val();
        $.post("/gdadmin/ajax/generateInputBuilder", {id: id}, function (data) {
            $('tbody.fields').prepend(data);
            keyup();
            position();
            deleted();
            initVar();
        });

    });
    $(".dragDrop tbody").sortable({
        cursor: "move",
        delay: 400,
        update: function () {
            position();
            initVar();
        }
    });
    deleted();
    keyup();
    position();
    tinymce.init({
        selector: 'textarea.editor',
        plugins: ['lists link image hr anchor', 'code', 'table', 'paste', 'autoresize'],
        images_upload_url: '../tinymce_upload.php',
        codesample_languages: [
            {text: 'HTML/XML', value: 'markup'},
            {text: 'JavaScript', value: 'javascript'},
            {text: 'CSS', value: 'css'},
            {text: 'PHP', value: 'php'},
            {text: 'Ruby', value: 'ruby'},
            {text: 'Python', value: 'python'},
            {text: 'Java', value: 'java'},
            {text: 'C', value: 'c'},
            {text: 'C#', value: 'csharp'},
            {text: 'C++', value: 'cpp'}
        ],
        toolbar: 'codesample',
        forced_root_block: "",
        force_br_newlines: true,
        force_p_newlines: false,
        relative_urls: false,
        remove_script_host: false,
        convert_urls: true,
    });
});

function deleted() {
    $('.btn.btn-danger.btn-link.delete').on('click', function (e) {
        e.preventDefault();
        $(this).parent().parent().remove();
        position();
        initVar();
    });
}

function keyup() {
    $('tbody.fields td input').on('keyup', function (e) {
        var data = $(this).val();
        var id = $(this).attr('id');
        $(this).parent().parent().attr("data-" + id, data);
        initVar();
    });
}

$('tbody.fields td input').each(function (e) {
    var data = $(this).val();
    var id = $(this).attr('id');
    $(this).parent().parent().attr("data-" + id, data);
    initVar();
});

function position() {
    $(".dragDrop tbody.fields tr").each(function () {
        $(this).attr("data-position", $(this).index());
    });
}

function initVar() {
    var html = "";
    $(".dragDrop tbody.fields tr input#label").each(function () {
        var label = $(this).val();
        if (label) {
            label = label.sansAccent().replace(/[_\W]+/g, "_")
            html += ' <tr>' +
                '<td><span class="copie">' + label + '<input type="text" value="[[' + label + ']]" class="inputCopie"></span></td>' +
                '<td><span class="copie">if<input type="text" value="[!' + label + ']]" class="inputCopie"></span></td>' +
                '<td><span class="copie">endif<input type="text" value="[[' + label + '!]" class="inputCopie"></span></td>' +
                '</tr>';
        }
    });
    if (html == "") {
        html = '<td class="text-center"><h3>aucune variables</h3></td>';
    }
    $('.initVar').html(html);
    $('span.copie').on('click', function () {
        var index = $(this).children("input");
        $(index).select();
        if (document.execCommand("copy")) {
            $(this).css("opacity", '0.5');
        }
        return false;
    });
}

$(".sendform").on('click', function () {
    tinyMCE.triggerSave();
    var champs = "";
    var id = $('input#id').val();
    var Name = $('input#name').val();
    var Desc = $('textarea#description').val();
    var structure = $('textarea#structure').val();
    var structure_en = $('textarea#structure_en').val();
    var crud_block = $('select#crud_block').val();
    var crud_url = $('select#crud_url').val();
    if ($('input#duplicable').is(':checked')) {
        var Duplicable = 1;
    } else {
        var Duplicable = 0;
    }
    if ($('input#crud').is(':checked')) {
        var Crud = 1;
    } else {
        var Crud = 0;
    }
    $(".dragDrop tbody.fields tr").each(function () {
        var position = $(this).data('position');
        var balise = $(this).data('balise');
        var type = $(this).data('type');
        var label = $(this).data('label');
        var name = $(this).data('label').sansAccent().replace(/[_\W]+/g, "_");
        var placeholder = $(this).data('placeholder');
        var masque = $(this).data('masque');
        var largeur = $(this).data('largeur');
        var datas = $(this).data('datas');
        var separator = "";
        if (position > 0) {
            separator = ",";
        }
        champs += separator + '{"position":"' + position + '","balise":"' + balise + '","type":"' + type + '","label":"' + label + '","name":"' + name + '","placeholder":"' + placeholder + '","masque":"' + masque + '","largeur":"' + largeur + '","datas":"' + datas + '"}';
    });
    champs = "[" + champs + "]";
    $.ajax({
        url: '/gdadmin/blockbuilder',
        type: 'post',
        //contentType: 'application/x-www-form-urlencoded',
        data: {
            id: id,
            nom: Name,
            description: Desc,
            datas: champs,
            crud: Crud,
            duplicable: Duplicable,
            structure: structure,
            structure_en: structure_en,
            crud_block: crud_block,
            crud_url: crud_url,
        },
        success: function (data) {
            window.location.replace("/gdadmin/blockBuilder");
        }
    });
});
$('#newConfiguration').on('click', function () {
    $('.configtab').before('<tr>\n' +
        '<td><i class="fas fa-arrows-alt"></i></td>\n' +
        '<td><input type="text" name="label[]" placeholder="label" class="form-control" value=""></td>\n' +
        '<td><input type="text" name="contenu[]" placeholder="Contenu" class="form-control" value=""></td>\n' +
        '<td class="td-actions text-right"><span class="btn btn-danger btn-link btn-lg delete"><i class="fas fa-times"></i></span></td>\n' +
        '</tr>');
    deleted();
});
$('#newAdminbuilder').on('click', function () {
    $('tbody').prepend('<tr>\n' +
        '<td><i class="fas fa-arrows-alt"></i></td>\n' +
        '<td><input type="text" name="nom[]" placeholder="nom" class="form-control" value=""></td>\n' +
        '<td><input type="text" name="url[]" placeholder="url" class="form-control" value=""></td>\n' +
        '<td><select name="icon[]" class="form-control icone"></select></td>\n' +
        '<td></td>\n' +
        '<td class="td-actions text-right"><span class="btn btn-danger btn-link btn-lg delete"><i class="fas fa-times"></i></span></td>\n' +
        '</tr>');
    faviconSelected()
    deleted();
    initIcon();
});
$('#newAdministrateur').on('click', function () {
    $('tbody').prepend('<tr>\n' +
        '    <td><i class="fas fa-arrows-alt"></i></td>\n' +
        '    <td><input type="text" name="identifiant[]" placeholder="identifiant" class="form-control" value=""></td>\n' +
        '    <td><select name="role[]" class="form-control"><option value="">Role</option><option value="root">root</option><option value="admin">admin</option></select></td>\n' +
        '    <td><input type="password" name="password[]" placeholder="password" class="form-control" value=""></td>\n' +
        '    <td class="td-actions text-right"><span class="btn btn-danger btn-link btn-lg delete" data-identifiant=""><i class="fas fa-times"></i></span></td>\n' +
        '</tr>');
    deleted();
});
$('#newTranslate').on('click', function () {
    $('tbody').prepend('<tr>\n' +
        '    <td><i class="fas fa-arrows-alt"></i><input type="hidden" name="id[]" value=""></td>\n' +
        '    <td><input type="text" name="EN[]" placeholder="EN" class="form-control" value=""></td>\n' +
        '    <td><input type="text" name="FR[]" placeholder="FR" class="form-control" value=""></td>\n' +
        '    <td class="td-actions text-right"><span class="btn btn-danger btn-link btn-lg delete" data-identifiant="<?= @$el->id ?>"><i class="fas fa-times"></i></span></td>\n' +
        '</tr>');
    deleted();
});
$('.deleteAdmin').on('click', function () {
    var id = $(this).data('identifiant');
    $.get("/gdadmin/console/deleteAdmin/" + id);
    $(this).parent().parent().remove();
});
$('.deleteTranslate').on('click', function () {
    var id = $(this).data('id');
    $.get("/gdadmin/console/deleteTranslate/" + id);
    $(this).parent().parent().remove();
});
var dropify = $('.dropify-fr').dropify({
    messages: {
        default: 'Glissez-déposez un fichier ici ou cliquez',
        replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
        remove: 'Supprimer',
        error: 'Désolé, le fichier trop volumineux'
    }
});
dropify.on('dropify.beforeClear', function (event, element) {
    $('input[name="' + element.element.name + '"]').val('');
});

$(document).ready(function () {
    if ($('input[name="duplicable"]').is(':checked')) {
        $('tbody.duplicable').css('display', 'table-row-group');
    } else {
        $('tbody.duplicable').css('display', 'none');
    }
    $('input[name="duplicable"]').on('click', function () {
        if ($(this).is(':checked')) {
            $('tbody.duplicable').css('display', 'table-row-group');
        } else {
            $('tbody.duplicable').css('display', 'none');
        }
    });
    if (!$('input[name="crud"]').is(':checked')) {
        $('.is_crud').css('display', 'none');
    } else {
        $('.is_crud').css('display', 'block');
    }
    $('input[name="crud"]').on('click', function () {
        if (!$(this).is(':checked')) {
            $('.is_crud').css('display', 'none');
        } else {
            $('.is_crud').css('display', 'block');

        }
    });
    $('input, select, textarea').each(function () {
        if ($(this).data("mask")) {
            $(this).mask($(this).data("mask"));
        }
    });
});
$('.new-terms').on('click', function (e) {
    e.preventDefault();
    tinymce.remove()
    $('.new-section').prepend($('.clone-terms >').clone());
    initTinymce();
});

function sortable() {
    $(".dragDrop").sortable({
        cursor: "move",
        delay: 400,
        update: function () {
            PageBuilderPosition();
        },
    });
}

duplicableBlockEl();
sortable();

function duplicableBlockEl() {
    $(".blocks .blocks-el a.btn-dupliquer, .blocks fieldset.btn-dupliquer").on('click', function (e) {
        e.preventDefault();
        tinymce.remove()
        $(this).parent().after($(this).parent().clone());
        PageBuilderPosition();
        deletable();
        duplicableBlockEl();
        sortable();
        initTinymce();
        $(this).off(e);
    });
    initTinymce();

    function initTinymce() {
        tinymce.init({
            selector: 'textarea:not(.not-tiny)',
            plugins: ['lists link image hr anchor', 'code', 'table', 'paste', 'autoresize'],
            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist  outdent indent | link image',
            images_upload_url: '../tinymce_upload.php',
            extended_valid_elements: 'span',
            images_upload_handler: function (blobInfo, success, failure) {
                var xhr, formData;
                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', '../../tinymce_upload.php');
                xhr.onload = function () {
                    var json;
                    if (xhr.status != 200) {
                        failure('HTTP Error: ' + xhr.status);
                        return;
                    }
                    json = JSON.parse(xhr.responseText);
                    if (!json || typeof json.location != 'string') {
                        failure('Invalid JSON: ' + xhr.responseText);
                        return;
                    }
                    success(json.location);
                };
                formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                xhr.send(formData);
            },
            forced_root_block: "",
            force_br_newlines: true,
            force_p_newlines: false,
            relative_urls: false,
            remove_script_host: false,
            convert_urls: true,
        });
    }
}

function PageBuilderPosition() {
    $(".dragDrop .blocks-el").each(function () {
        $(this).attr("data-position", $(this).index());
    });
    $(".dragDrop .blocks").each(function () {
        $(this).attr("data-position", $(this).index());
    });
}

function deletable() {
    $('.deletable').on('dblclick', function (e) {
        e.stopPropagation();
        $('.deletable .deleted').remove();
        $(this).prepend("<div class=\"deleted\">\n" +
            "    <i class=\"far fa-trash-alt\"></i>\n" +
            "    <i class=\"fas fa-external-link-alt\"></i>\n" +
            "</div>");
        $('.deletable .deleted .fa-trash-alt').on('click', function () {
            $(this).parent().parent().remove();
            PageBuilderPosition();
        });
        $('.deletable .deleted .fa-external-link-alt').on('click', function () {
            $(this).parent().remove();
        });
    });
}

deletable();
PageBuilderPosition();
$("form.pagebuilder input[type='submit']:not(input[value='Valider'])").on('click', function (e) {
    e.preventDefault();
});
$('.GenerateBlock input').on('click', function () {
    var id = $('.GenerateBlock select').val();
    $.post("/gdadmin/ajax/generateBlockBuilder", {id_block: id}, function (data) {
        tinymce.remove()
        $('.blocks-content').prepend(data);
        deletable();
        PageBuilderPosition();
        duplicableBlockEl();
        initTinymce();
    });
});

function cloneTinyMCE(data = "") {
    var html = data.remove(".tox-tinymce");
    html = data.removeAttr("aria-hidden");
    html = data.removeAttr("aria-hidden");
    return html = data.removeAttr("style");
}

initIcon();

function initIcon() {
    $('.edit-icon').on('keyup', function () {
        $(this).parent().next().html('<i class="fa fa-2x ' + $(this).val() + '"></i>');
    });
}
