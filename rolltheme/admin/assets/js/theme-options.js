jQuery(document).ready(function($) {
    $('.theme-options-menu > .tab-link, .system-tabs > .tab-link').on('click', function (event) {

        var elem = $(event.target);
        var submenu = $(elem.parents('.tab-link')).find('.sub-tabs');
        var optionsContent = $('.options-content');
        var systemContent = $('.system-content');

        if (optionsContent.is(':hidden')) {
            systemContent.fadeOut(300, function () {
                optionsContent.fadeIn();
            });
        }

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

    $('.export-tab').on('click', function () {
       $('.options-content').fadeOut(300, function () {
           $('.system-content').fadeIn(300);
       });
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
        var selectorContent = '.tab-content[data-content-id="' + data_id + '"]';
        var elemContent = $(selectorContent);

        if(elemContent.is(':hidden')) {
            $('.tab-content').fadeOut(300);
            setTimeout(function () {
                elemContent.fadeIn(300);
            }, 300);
        }
    }
});