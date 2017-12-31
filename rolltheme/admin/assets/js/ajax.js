jQuery(document).ready(function ($) {
    $('#roll-form').submit(function () {
        $.ajax({
            method: 'POST',
            url: ajaxurl,
            data: {
                'formData': $(this).serialize(),
                'action': 'roll_ajax'
            },
            beforeSend: function () {
                $('#submit').attr('disabled', true);
            },
            success: function (data) {
                $('#submit').attr('disabled', false);
                console.log(data);
            },
            error: function () {
                alert('ERROR!');
            }
        });
        return false;
    });

    $('#export-btn').on('click', function () {
        $.ajax({
            method: 'POST',
            url: ajaxurl,
            data: {
                'formData': $(this).serialize(),
                'action': 'roll_ajax_export'
            },
            success: function (data) {
                $('.export-view').text(data).fadeIn(300);
                $(this).append('<a href="'+ roll_export_dir +'" download>Download JSON file</a>');
            },
            error: function () {
                alert('ERROR!');
            }
        });
        return false;
    });
});