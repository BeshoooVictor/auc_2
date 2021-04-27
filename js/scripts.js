/* Template: Vera - Business Landing Page Template
   Author: InovatikThemes
   Version: 1.0.0
   Created: Jun 2017
   Description: Custom JS file
*/


(function ($) {
    "use strict";

    /* PRELOADER */
    $(window).load(function () {
        var preloaderFadeOutTime = 500;
        function hidePreloader() {
            var preloader = $('.spinner-wrapper');
            setTimeout(function () {
                preloader.fadeOut(preloaderFadeOutTime);
            }, 500);
        }
        hidePreloader();
    });


    /* YTPLAYER FOR HEADER VIDEO BACKGROUND */
    $(".player").mb_YTPlayer();


    /* NAVBAR SCRIPTS */
    //jQuery to collapse the navbar on scroll
    $(window).scroll(function () {
        if ($(".navbar").offset().top > 50) {
            $(".navbar-fixed-top").addClass("top-nav-collapse");
        } else {
            $(".navbar-fixed-top").removeClass("top-nav-collapse");
        }
    });

    //jQuery for page scrolling feature - requires jQuery Easing plugin
    $(function () {
        $(document).on('click', 'a.page-scroll', function (event) {
            var $anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: $($anchor.attr('href')).offset().top
            }, 800, 'easeInOutExpo');
            event.preventDefault();
        });
    });
    // closes the responsive menu on menu item click
    $(".navbar-nav li a").on("click", function (event) {
        if (!$(this).parent().hasClass('dropdown'))
            $(".navbar-collapse").collapse('hide');
    });


    /* MORPHTEXT FOR ROTATING TEXT IN HEADER */
    $("#js-rotating").Morphext({
        // The [in] animation type. Refer to Animate.css for a list of available animations.
        animation: "fadeIn",
        // An array of phrases to rotate are created based on this separator. Change it if you wish to separate the phrases differently (e.g. So Simple | Very Doge | Much Wow | Such Cool).
        separator: ",",
        // The delay between the changing of each phrase in milliseconds.
        speed: 2000,
        complete: function () {
            // Called after the entrance animation is executed.
        }
    });


    /* CUSTOMERS LOGO SWIPER */
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 5,
        spaceBetween: 30,
        autoplay: 2800,
        loop: false,

        autoplayStopOnLast: false,
        breakpoints: {
            992: {
                slidesPerView: 3,
                spaceBetween: 30
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 20
            },
            468: {
                slidesPerView: 1,
                spaceBetween: 10
            }
        },

    });



    /* BACK TO TOP BUTTON */
    // create the back to top button
    $('body').prepend('<a href="#header" class="back-to-top page-scroll">Back to Top</a>');
    var amountScrolled = 700;
    $(window).scroll(function () {
        if ($(window).scrollTop() > amountScrolled) {
            $('a.back-to-top').fadeIn('500');
        } else {
            $('a.back-to-top').fadeOut('500');
        }
    });
    /* HEADER SWIPER */
    // var swiper = new Swiper('.swiper-container-header', {
    //     spaceBetween: 0,
    //     centeredSlides: true,
    //     autoplay: 5000,
    //     autoplayDisableOnInteraction: false,


    //     pagination: '.swiper-pagination',
    //     paginationType: 'bullets',
    //     paginationClickable: true
    // });

    /* SOLUTIONS IMAGE GALLERY SWIPER */
    var MySwiper = new Swiper('.my-swiper-container', {
        pagination: '.swiper-pagination',
        paginationClickable: true,
        loop: false,
        autoplayDisableOnInteraction: false,
        autoplay: 2500,
        observer: true,
        observeSlideChildren: true,
        observeParents: true,
    });


    /* MAGNIFIC POPUP FOR SOLUTIONS IMAGE GALLERY SWIPER */
    $('.popup-link').magnificPopup({
        removalDelay: 300,
        type: 'image',
        callbacks: {
            beforeOpen: function () {
                this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure ' + this.st.el.attr('data-effect'));
            },

            beforeClose: function () {
                $('.mfp-figure').addClass('fadeOut');
            }
        },
        gallery: {
            enabled: true //enable gallery mode
        }
    });


    /* MAGNIFIC POPUP FOR PRODUCT DETAILS */
    $('.popup-with-move-anim').magnificPopup({
        type: 'inline',

        fixedContentPos: false, /* keep it false to avoid html tag shift with margin-right: 17px */
        fixedBgPos: true,

        overflowY: 'auto',

        closeBtnInside: true,
        preloader: false,

        midClick: true,
        removalDelay: 300,
        mainClass: 'my-mfp-slide-bottom'
    });


    /* PORTFOLIO ISOTOPE INITIALIZATION */
    $('.grid').imagesLoaded(function () {
        var $grid = $('.grid').isotope({
            // options
            itemSelector: '.element-item',
            layoutMode: 'fitRows'
        });

        // filter items on button click
        $('.filters-button-group').on('click', 'a', function () {
            var filterValue = $(this).attr('data-filter');
            $grid.isotope({ filter: filterValue });
        });
        // change is-checked class on buttons
        $('.button-group').each(function (i, buttonGroup) {
            var $buttonGroup = $(buttonGroup);
            $buttonGroup.on('click', 'a', function () {
                $buttonGroup.find('.is-checked').removeClass('is-checked');
                $(this).addClass('is-checked');
            });
        });
    });


    /* COUNTERUP - STATISTICS */
    $('.counter').counterUp({
        delay: 10,
        time: 1200
    });


    /* SIGNUP FORM */
    $("#SignupForm").validator().on("submit", function (event) {
        if (event.isDefaultPrevented()) {
            // handle the invalid form...
            formError();
            submitMSG(false, "Check if all fields are filled in!");
        } else {
            // everything looks good!
            event.preventDefault();
            submitForm();
        }
    });

    function submitForm() {
        // initiate variables with form content
        var email = $("#email").val();

        $.ajax({
            type: "POST",
            url: "php/signupform-process.php",
            data: "&email=" + email,
            success: function (text) {
                if (text == "success") {
                    formSuccess();
                } else {
                    formError();
                    submitMSG(false, text);
                }
            }
        });
    }

    function formSuccess() {
        $("#SignupForm")[0].reset();
        submitMSG(true, "You Are Signed Up!")
    }

    function formError() {
        $("#SignupForm").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
            $(this).removeClass();
        });
    }

    function submitMSG(valid, msg) {
        if (valid) {
            var msgClasses = "h3 text-center tada animated text-success";
        } else {
            var msgClasses = "h3 text-center text-danger";
        }
        $("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
    }


    /* CONTACT FORM */
    $("#ContactForm").validator().on("submit", function (event) {
        if (event.isDefaultPrevented()) {
            // handle the invalid form...
            formCError();
            submitCMSG(false, "Check if all fields are filled in!");
        } else {
            // everything looks good!
            event.preventDefault();
            submitCForm();
        }
    });

    function submitCForm() {
        // initiate variables with form content
        var cfirstname = $("#cfirstname").val();
        var clastname = $("#clastname").val();
        var cemail = $("#cemail").val();
        var cmessage = $("#cmessage").val();

        $.ajax({
            type: "POST",
            url: "php/contactform-process.php",
            data: "firstname=" + cfirstname + "&lastname=" + clastname + "&email=" + cemail + "&message=" + cmessage,
            success: function (text) {
                if (text == "success") {
                    formCSuccess();
                } else {
                    formCError();
                    submitCMSG(false, text);
                }
            }
        });
    }

    function formCSuccess() {
        $("#ContactForm")[0].reset();
        submitCMSG(true, "Message Submitted!")
    }

    function formCError() {
        $("#ContactForm").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
            $(this).removeClass();
        });
    }

    function submitCMSG(valid, msg) {
        if (valid) {
            var msgClasses = "h3 text-center tada animated text-success";
        } else {
            var msgClasses = "h3 text-center text-danger";
        }
        $("#cmsgSubmit").removeClass().addClass(msgClasses).text(msg);
    }


    /* REMOVES LONG FOCUS ON BUTTONS */
    $(".button, a, button").mouseup(function () {
        $(this).blur();
    });


})(jQuery);