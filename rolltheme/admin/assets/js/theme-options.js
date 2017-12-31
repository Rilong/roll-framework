jQuery(document).ready(function($) {
    $('.theme-options-menu > .tab-link').on('click', function (event) {

        var elem = $(event.target);
        var submenu = $(elem.parents('.tab-link')).find('.sub-tabs');


        if(submenu.length && elem.parents('.sub-tabs').length === 0)
            submenu.slideToggle(400);
    });

    $('.export-tab').on('click', function () {
       $('.options-content').fadeOut(300, function () {
           $('.system-content').fadeIn(300);
       });
    });
});