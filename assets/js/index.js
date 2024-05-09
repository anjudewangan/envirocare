(function ($) {
    "use strict";

    var $window = $(window);

    // Call to Page

    preLoader();
    tapTop();

    // Pre Loader Part
    function preLoader() {
        var preLoader = document.getElementById("preloader");
        preLoader.innerHTML = '<div class="preload-content"><div id="sonar-load"><img src="./assets/images/logo/loader.png" alt="Envirocare Foundation Logo"></div></div>';
    }

    // Tap Top Part
    function tapTop() {
        var tapTop = document.getElementById("tap-top");
        tapTop.innerHTML = '<div class="tap-top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></div>';
    }

    // Preloader Active Code
    $window.on('load', function () {
        $('#preloader').fadeOut('slow', function () {
            $(this).remove();
        });
    });

    // tap top
    $('#tap-top').on('click', function () {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });

    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 600) {
            $('.tap-top').fadeIn();
        } else {
            $('.tap-top').fadeOut();
        }
    });

})(jQuery);    