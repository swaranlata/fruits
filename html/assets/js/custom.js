jQuery(function ($) {

    //Preloader
    var preloader = $('.preloader');
    $(window).load(function () {
        preloader.remove();
    });

    $('.slimmenu').slimmenu({
        resizeWidth: '992',
        collapserTitle: 'Menu',
        animSpeed: 'medium',
        indentChildren: true,
        childrenIndenter: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
        expandIcon: '<i class="fa fa-plus" aria-hidden="true"></i>',
        collapseIcon: '<i class="fa fa-minus" aria-hidden="true"></i>'
    });

    // Notification

    jQuery(window).on("load", function () {
        jQuery(".notificationModule").next().mCustomScrollbar({
            scrollButtons: {
                enable: true
            },
            theme: "light-3"
        });
    });

    // Custom Scrollbar
    
    $(window).on("load", function () {
        $(".notificationContent").mCustomScrollbar();
    });

});
