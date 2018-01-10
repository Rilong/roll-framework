jQuery(document).ready(function($) {
    $('.theme-options-menu > .tab-link, .system-tabs > .tab-link').on('click', function (event) {

        var elem = $(event.target);
        var submenu = $(elem.parents('.tab-link')).find('.sub-tabs');

        showContent(elem);

        if(submenu.length && elem.parents('.sub-tabs').length === 0)
            if ($(this).is('.activeTab'))
                return false;
            else {
                $('.theme-options-menu > .tab-link').removeClass('activeTab');
                $('.theme-options-menu > .tab-link > .sub-tabs').slideUp(400);
            }

            submenu.slideDown(400);
            $(this).addClass('activeTab');
    });

    $('.roll-switcher').rcSwitcher();

    $('.roll-colorpicker').each(function () {
        var $this = $(this);
            $(this).ColorPicker({
                onChange: function(hsb, hex, rgb) {
                    var color = '#' + hex;
                    $this.val(color);
                }
            });
    });


    function showContent(elem) {
        var data_id = elem.parents('li').data('tabId');
        var tabContainer = elem.parents('ul');
        var selectorContent = '.tab-content[data-content-id="' + data_id + '"]';
        var elemContent = $(selectorContent);

        if(tabContainer.is('.system-tabs') && $('#plugin-include').is(':hidden')) {
            $('#root-include').hide();
            $('#plugin-include').show();
        }else {
            if ($('#root-include').is(':hidden')) {
                $('#root-include').show();
                $('#plugin-include').hide();
            }
        }
        if(elemContent.is(':hidden')) {
            $('.tab-content').fadeOut(300);
            setTimeout(function () {
                elemContent.fadeIn(300);
            }, 300);
        }
    }
});
function showMessage(message, typeError) {
    var $ = jQuery;
    var $message = $('.message-item');

    if (typeError == 'successful') {
        if ($message.is('.message-error'))
            $message.removeClass('message-error');

        $message.addClass('message-successful');
        $message.text(message);
        $message.addClass('active');
        setTimeout(function () {
            $message.removeClass('active');
        }, 2000);
    }else if (typeError == 'error') {
        if ($message.is('.message-successful'))
            $message.removeClass('message-successful');

        $message.addClass('message-error');
        $message.text(message);
        $message.addClass('active');
        setTimeout(function () {
            $message.removeClass('active');
        }, 2000);
    }
}