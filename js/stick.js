 $(window).scroll(function () {
        if ($(window).scrollTop() >= 99) {
            $('#nav').addClass('navbar-fixed-top');
        }


        if ($(window).scrollTop() >= 100) {
            $('#nav').addClass('show');
        } else {
            $('#nav').removeClass('show navbar-fixed-top');
        }
    }); 