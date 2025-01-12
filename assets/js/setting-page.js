jQuery(document).ready(function ($) {
    let key = 0;

    $('select[name="menu_type"]').change(function () {
        var $menu_type = $('select[name="menu_type"] option:selected').val();
        if ("add_submenu_page" == $menu_type) {
            $('input[name="submenu"]').attr("disabled", false);
        } else {
            $('input[name="submenu"]').attr("disabled", true);
        }
        if ("add_menu_page" == $menu_type) {
            $('input[name="menu_icon"]').attr("disabled", false);
            $('select[name="menu_position"]').attr("disabled", false);
        } else {
            $('input[name="menu_icon"]').attr("disabled", true);
            $('select[name="menu_position"]').attr("disabled", true);
        }
    }).trigger("change");

    var single_fields = ["text", "number", "email", "password", "url", "date", "time", "color", "textarea", "file"];
    var multiple_fields = ["checkboxes", "radio", "select"];

    $(document).on('change', '.field-type', function () {
        var fieldtype = $(this).find("option:selected").val();
        let parentId = $(this).data('parent-id');
        let parent = $(parentId);

        console.log('fieldtype:- ' + fieldtype);
        console.log('parent:- ' + parentId);

        if ("" == fieldtype) {
            parent.find('.id').attr("disabled", true);
            parent.find('.label').attr("disabled", true);
            parent.find('.description').attr("disabled", true);
            parent.find('.placeholder').attr("disabled", true);
            parent.find('.options').attr("disabled", true);
        } else if (single_fields.indexOf(fieldtype) > -1) {
            parent.find('.id').attr("disabled", false);
            parent.find('.label').attr("disabled", false);
            parent.find('.description').attr("disabled", false);
            parent.find('.placeholder').attr("disabled", false);
            parent.find('.options').attr("disabled", true);
        } else if (multiple_fields.indexOf(fieldtype) > -1) {
            parent.find('.id').attr("disabled", false);
            parent.find('.label').attr("disabled", false);
            parent.find('.description').attr("disabled", false);
            parent.find('.placeholder').attr("disabled", true);
            parent.find('.options').attr("disabled", false);
        }
    }).trigger("change");

    $('.add-field-block').on('click', function() {
        key = parseInt(key) + parseInt(1);
        let html = $('#clone_fields').html();
            html = html.replace(/%KEY%/g, key);

        $('.field-container').append(html);
    });
});
