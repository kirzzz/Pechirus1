(function ($) {
    "use strict";

    window.dataLayer = window.dataLayer || [];

    /*--
    Menu Stick
    -----------------------------------*/
    var header = $('.sticky-bar');
    var win = $(window);
    win.on('scroll', function() {
        var scroll = win.scrollTop();
        if (scroll < 200) {
            header.removeClass('stick');
        } else if(!$(".cd-dropdown-trigger").hasClass('dropdown-is-active')) {
            header.addClass('stick');
        }
    });
    
    /*--------------------------------
        Slider active 1
    -----------------------------------*/

    $('.slider-active-1').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        loop: true,
        dots: false,
        arrows: true,
        prevArrow: '<span class="slider-icon slider-icon-prev"><i class="icofont-simple-left"></i></span>',
        nextArrow: '<span class="slider-icon slider-icon-next"><i class="icofont-simple-right"></i></span>',
        responsive: [{
            breakpoint: 1500,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            }
        },
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    autoplay: false,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });

    /*--------------------------------
        Slider active 2
    -----------------------------------*/
    $('.slider-active-2').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        loop: true,
        dots: true,
        arrows: false,
        prevArrow: '<span class="slider-icon slider-icon-prev"><i class="icofont-simple-left"></i></span>',
        nextArrow: '<span class="slider-icon slider-icon-next"><i class="icofont-simple-right"></i></span>',
        responsive: [{
            breakpoint: 1500,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            }
        },
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    autoplay: false,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });

    /*--
        Slider active 3
    -----------------------------------*/
    $('.slider-active-3').slick({
        arrows: false,
        infinite: true,
        slidesToShow: 1,
        dots: true,
        fade: true,
        autoplay: false,
        autoplaySpeed: 5000,
        customPaging: function (slider, i) {
            var thumb = $(slider.$slides[i]).data('thumb');
            return '<button class="overlay"><img src="' + thumb + '"></button>';
        },
        responsive: [
            {
                breakpoint: 767,
                settings: {
                    dots: true,
                    autoplay: false,
                    autoplaySpeed: 5000,
                }
            }
        ]
    });


    /*--------------------------------
        slider active 4
    -----------------------------------*/
    $('.slider-active-4').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        loop: true,
        dots: true,
        arrows: false,
        prevArrow: '<span class="slider-icon slider-icon-prev"><i class="icofont-simple-left"></i></span>',
        nextArrow: '<span class="slider-icon slider-icon-next"><i class="icofont-simple-right"></i></span>',
        responsive: [{
            breakpoint: 1500,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            }
        },
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    autoplay: false,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });

    /*--------------------------------
        Slider active 5
    -----------------------------------*/
    $('.slider-active-5').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        loop: true,
        dots: true,
        arrows: false,
        prevArrow: '<span class="slider-icon slider-icon-prev"><i class="icofont-simple-left"></i></span>',
        nextArrow: '<span class="slider-icon slider-icon-next"><i class="icofont-simple-right"></i></span>',
    });


    /*--------------------------------
        Product slider active 1
    -----------------------------------*/
    $('.product-slider-active-1').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        loop: true,
        dots: false,
        arrows: false,
        responsive: [{
            breakpoint: 1500,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
            }
        },
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    autoplay: false,
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 575,
                settings: {
                    autoplay: false,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });


    /*--------------------------------
        Product slider active 2
    -----------------------------------*/
    $('.product-slider-active-2').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        loop: true,
        dots: false,
        arrows: false,
        responsive: [{
            breakpoint: 1500,
            settings: {
                slidesToShow: 6,
                slidesToScroll: 1,
            }
        },
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    autoplay: false,
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 575,
                settings: {
                    autoplay: false,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });


    /*--------------------------------
        Product slider active 3
    -----------------------------------*/
    $('.product-slider-active-3').slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        loop: true,
        dots: false,
        arrows: false,
        responsive: [{
            breakpoint: 1500,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
            }
        },
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    autoplay: false,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 575,
                settings: {
                    autoplay: false,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });

    /*--------------------------------
        Product slider active 4
    -----------------------------------*/
    $('.product-slider-active-4').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        loop: true,
        dots: false,
        arrows: false,
        responsive: [{
            breakpoint: 1500,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 1,
            }
        },
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    autoplay: false,
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 575,
                settings: {
                    autoplay: false,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });


    /*--------------------------------
        Brand logo active
    -----------------------------------*/
    $('.brand-logo-active , .brand-logo-active-2').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        loop: true,
        dots: false,
        arrows: false,
        responsive: [{
            breakpoint: 1500,
            settings: {
                slidesToShow: 6,
                slidesToScroll: 1,
            }
        },
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    autoplay: false,
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 575,
                settings: {
                    autoplay: false,
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            }
        ]
    });

    /*--------------------------------
        Brand logo active 3
    -----------------------------------*/
    $('.brand-logo-active-3').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        loop: true,
        dots: true,
        arrows: false,
        responsive: [{
            breakpoint: 1500,
            settings: {
                slidesToShow: 6,
                slidesToScroll: 1,
            }
        },
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    autoplay: false,
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 575,
                settings: {
                    autoplay: false,
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            }
        ]
    });

    /*---------------------
        Countdown 1
      --------------------- */
    $('.timer-1 [data-countdown]').each(function() {
        var $this = $(this),
            finalDate = $(this).data('countdown');
        $this.countdown(finalDate, function(event) {
            $this.html(event.strftime('<span class="cdown day"> <span>%-D </span><p>Days</p></span> <span class="cdown hour"> <span> %-H</span> <p>Hours</p></span> <span class="cdown minutes"><span>%M</span> <p>Minutes</p> </span>'));
        });
    });
    
    $('.timer-2 [data-countdown]').each(function() {
        var $this = $(this),
            finalDate = $(this).data('countdown');
        $this.countdown(finalDate, function(event) {
            $this.html(event.strftime('<span class="cdown day"> <span>%-D </span><p>Day</p></span> <span class="cdown hour"> <span> %-H</span> <p>Hour</p></span> <span class="cdown minutes"><span>%M</span> <p>Minute</p> </span> <span class="cdown second"><span>%S</span> <p>Second</p> </span>'));
        });
    });
    
    $('.timer-3 [data-countdown]').each(function() {
        var $this = $(this),
            finalDate = $(this).data('countdown');
        $this.countdown(finalDate, function(event) {
            $this.html(event.strftime('<span class="cdown hour"> <span> %-H</span> <p>Hour</p></span> <span class="cdown minutes"><span>%M</span> <p>Minute</p> </span> <span class="cdown second"><span>%S</span> <p>Second</p> </span>'));
        });
    });
    
    /*---------------------
        svg img color
    --------------------- */
    // Elements to inject
    var mySVGsToInject = document.querySelectorAll('img.inject-me');
      // Do the injection
    SVGInjector(mySVGsToInject);
    
    
    /*------ Wow Active ----*/
    new WOW().init();
    
    
    /*------------
        ScrollUp
    ------------------ */
    $.scrollUp({
        scrollText: '<i class="icofont-arrow-up"></i>',
        easingType: 'linear',
        scrollSpeed: 900,
        animation: 'fade'
    });
    
    /*----------------------------
    	Cart Plus Minus Button
    ------------------------------ */
    var CartPlusMinus = $('.cart-plus-minus');
    CartPlusMinus.prepend('<div class="dec qtybutton">-</div>');
    CartPlusMinus.append('<div class="inc qtybutton">+</div>');
    $(".qtybutton").on("click", function() {
        var $button = $(this);
        var oldValue = $button.parent().find("input").val();
        var newVal;
        if ($button.text() === "+") {
            newVal = parseFloat(oldValue) + 1;
        } else {
            if (oldValue > 1) {
                newVal = parseFloat(oldValue) - 1;
            }else{
                newVal = 1;
            }
        }
        $button.parent().find("input").val(newVal).trigger('change');
    });
    
    
    /*------- Color active -----*/
    $('.pro-details-color-content').on('click', 'a', function(e){
        e.preventDefault();
        $(this).addClass('active').parent().siblings().children('a').removeClass('active');
    });
    
    
    /*--------------------------------
        Cart active
    -----------------------------------*/
    if ($('.pro-details-action').length) {
        var $body = $('body'),
            $cartWrap = $('.pro-details-action'),
            $cartContent = $cartWrap.find('.product-dec-social');
        $cartWrap.on('click', '.social', function(e) {
            e.preventDefault();
            var $this = $(this);
            if (!$this.parent().hasClass('show')) {
                $this.siblings('.product-dec-social').addClass('show').parent().addClass('show');
            } else {
                $this.siblings('.product-dec-social').removeClass('show').parent().removeClass('show');
            }
        });
        /*Close When Click Outside*/
        $body.on('click', function(e) {
            var $target = e.target;
            if (!$($target).is('.pro-details-action') && !$($target).parents().is('.pro-details-action') && $cartWrap.hasClass('show')) {
                $cartWrap.removeClass('show');
                $cartContent.removeClass('show');
            }
        });
    }
    
    /* Language-dropdown */
    $(".language-dropdown-active").on("click", function(e) {
        e.preventDefault();
        $(this).parent().find('.language-dropdown').slideToggle('medium');
    })
    
    /* NiceSelect */
    $('.nice-select').niceSelect();
    
    
    /*--------------------------------
        Testimonial active
    -----------------------------------*/
    $('.testimonial-active , .testimonial-active-2').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        loop: true,
        dots: false,
        arrows: false,
        responsive: [{
                breakpoint: 1500,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    autoplay: false,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 575,
                settings: {
                    autoplay: false,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });
    
    
    
    
    /*====== SidebarCart ======*/
    function miniCart() {
        var navbarTrigger = $('.cart-active'),
            endTrigger = $('.cart-close'),
            container = $('.sidebar-cart-active'),
            wrapper2 = $('.main-wrapper');
        
        wrapper2.prepend('<div class="body-overlay"></div>');
        
        navbarTrigger.on('click', function(e) {
            e.preventDefault();
            container.addClass('inside');
            wrapper2.addClass('overlay-active');
        });
        
        endTrigger.on('click', function() {
            container.removeClass('inside');
            wrapper2.removeClass('overlay-active');
        });
        
        $('.body-overlay').on('click', function() {
            container.removeClass('inside');
            wrapper2.removeClass('overlay-active');
        });
    };
    miniCart();
    
    /*-------------------------------
	   Header Search Toggle
    -----------------------------------*/
    var searchToggle = $('.search-toggle');
    searchToggle.on('click', function(e){
        e.preventDefault();
        if($(this).hasClass('open')){
           $(this).removeClass('open');
           $(this).siblings('.search-wrap-3').removeClass('open');
        }else{
           $(this).addClass('open');
           $(this).siblings('.search-wrap-3').addClass('open');
        }
    })
    
    
     /*====== Sidebar Active ======*/
    function sidebarActive() {
        var navbarTrigger = $('.sidebar-active'),
            endTrigger = $('.sidebar-close'),
            container = $('.clickalbe-sidebar-wrapper-active'),
            wrapper3 = $('.main-wrapper-2');
        
        wrapper3.prepend('<div class="body-overlay-2"></div>');
        
        navbarTrigger.on('click', function(e) {
            e.preventDefault();
            container.addClass('sidebar-visible');
            wrapper3.addClass('overlay-active-2');
        });
        
        endTrigger.on('click', function() {
            container.removeClass('sidebar-visible');
            wrapper3.removeClass('overlay-active-2');
        });
        
        $('.body-overlay-2').on('click', function() {
            container.removeClass('sidebar-visible');
            wrapper3.removeClass('overlay-active-2');
        });
    };
    sidebarActive();
    
    /*====== clickable Main Menu active ======*/
    var $clickableMainMenu = $('.clickable-mainmenu-wrap'),
        $clickableSubMenu = $clickableMainMenu.find('.sub-menu-2');
    $clickableSubMenu.siblings('div').append('<span class="menu-expand ml-3 px-2 d-flex align-items-center"><i class="icofont-plus"></i></span>');
    $clickableSubMenu.slideUp();
    $clickableMainMenu.on('click', 'li .menu-expand', function(e) {
        var $this = $(this);
        if ($this.closest('li').hasClass('has-sub-menu') || ($this.attr('href') === '#' || $this.hasClass('menu-expand'))) {
            if ($this.closest('li').children('ul:visible').length) {
                $this.closest('li').removeClass('active').children('ul').slideUp().siblings('div').find('.menu-expand i').removeClass('icofont-minus').addClass('icofont-plus');
                $this.closest('li').siblings('li').removeClass('active').find('ul:visible').slideUp().siblings('div').find('.menu-expand i').removeClass('icofont-minus').addClass(' icofont-plus ');
            } else {
                $this.closest('li').addClass('active').children('ul').slideDown().siblings('div').find('.menu-expand i').removeClass(' icofont-plus ').addClass('icofont-minus');
                $this.closest('li').siblings('li').removeClass('active').find('ul:visible').slideUp().siblings('div').find('.menu-expand i').removeClass('icofont-minus').addClass(' icofont-plus ');
            }
        }
    });
    
    
     /*====== Sidebar menu Active ======*/
    function mobileMenuActive() {
        var navbarTrigger = $('.mobile-menu-button-active'),
            endTrigger = $('.sidebar-close'),
            container = $('.mobile-menu-active'),
            wrapper4 = $('.main-wrapper-3');
        
        wrapper4.prepend('<div class="body-overlay-3"></div>');
        
        navbarTrigger.on('click', function(e) {
            e.preventDefault();
            container.addClass('sidebar-visible');
            wrapper4.addClass('overlay-active-3');
        });
        
        endTrigger.on('click', function() {
            container.removeClass('sidebar-visible');
            wrapper4.removeClass('overlay-active-3');
        });
        
        $('.body-overlay-3').on('click', function() {
            container.removeClass('sidebar-visible');
            wrapper4.removeClass('overlay-active-3');
        });
    };
    mobileMenuActive();
    
    /*--- Language currency active ----*/
    $('.mobile-language-active').on('click', function(e) {
        e.preventDefault();
        $('.lang-dropdown-active').slideToggle(900);
    });
    
    
    /*------------------------------------
        Testimonial img slider active
    -----------------------------------*/
    $('.testimonial-img-slider-active').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        draggable: false,
        fade: false,
        asNavFor: '.testimonial-active-3',
    });

    /*--------------------------------
       Testimonial active 3
    -----------------------------------*/
    $('.testimonial-active-3').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        asNavFor: '.testimonial-img-slider-active , .testimonial-img-slider-active-3',
        dots: true,
        focusOnSelect: true,
        fade: true,
        arrows: false
    });
    
    /*----------------------------------------------------------
        Testimonial img slider active 3 ( home mega fashion )
    --------------------------------------------------------------*/
    $('.testimonial-img-slider-active-3').on('init afterChange',function(){
        const titleImg = document.querySelector('.testimonial-next-img img');
        const activeSlide = document.querySelector('.testimonial-img-slider.slick-current');
        titleImg.src = activeSlide.nextSibling.querySelector('img').src;
    });
    $('.testimonial-img-slider-active-3').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        draggable: false,
        fade: false,
        asNavFor: '.testimonial-active-3'
    });
    
    
    
    
    // Isotope active
    $('.grid').imagesLoaded(function() {
        // init Isotope
        var $grid = $('.grid').isotope({
            itemSelector: '.grid-item',
            percentPosition: true,
            layoutMode: 'masonry',
            masonry: {
                // use outer width of grid-sizer for columnWidth
                columnWidth: '.grid-item',
            }
        });
    });
    
    /*--------------------------
        Isotope active
    ---------------------------- */
    
    $('.grid-2').imagesLoaded(function() {
        // init Isotope
        $('.grid-2').isotope({
            itemSelector: '.grid-item-2',
            percentPosition: true,
            layoutMode: 'masonry',
            masonry: {
                // use outer width of grid-sizer for columnWidth
                columnWidth: '.grid-sizer',
            }
        });
    });
    /*--------------------------
        Isotope active
    ---------------------------- */
    
    $('.grid-3').imagesLoaded(function() {
        // init Isotope
        $('.grid-3').isotope({
            itemSelector: '.grid-item-3',
            percentPosition: true,
            layoutMode: 'masonry',
            masonry: {
                // use outer width of grid-sizer for columnWidth
                columnWidth: 1,
            }
        });
    });
    
    /*------------------------------------
        testimonial img slider active 2
    --------------------------------------*/
    $('.testimonial-img-slider-active-2').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        arrows: false,
        dots: false,
        focusOnSelect: true,
        draggable: false,
        fade: false,
        asNavFor: '.testimonial-active-4',
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 4,
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 5,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 2,
                }
            }
        ]
    });

    /*--------------------------------
        Testimonial active 4
    -----------------------------------*/
    $('.testimonial-active-4').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        asNavFor: '.testimonial-img-slider-active-2',
        dots: false,
        focusOnSelect: true,
        fade: true,
        arrows: false
    });
    
    /*--------------------------------
        Testimonial active 5
    -----------------------------------*/
    $('.testimonial-active-5').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        fade: false,
        arrows: false,
        responsive: [{
                breakpoint: 1500,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    autoplay: true,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });
    
    /*--------------------------------
        Categori slider active
    -----------------------------------*/
    $('.categori-slider-active').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        dots: false,
        fade: false,
        arrows: false,
        responsive: [{
                breakpoint: 1500,
                settings: {
                    slidesToShow: 6,
                    slidesToScroll: 1, 
                }
            },
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 6,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    autoplay: true,
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 575,
                settings: {
                    autoplay: true,
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            }
        ]
    });
    
    
    /*--------------------------------
        Testimonial active 6
    -----------------------------------*/
    $('.testimonial-active-6').slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        dots: true,
        fade: false,
        arrows: false,
        responsive: [{
                breakpoint: 1500,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    autoplay: true,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });
    
    /*--------------------------------
        Product img slider active
    -----------------------------------*/
    $('.product-img-slider-active').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        fade: false,
        arrows: false,
    });
    
    /*--------------------------------
        Testimonial active 7
    -----------------------------------*/
    $('.testimonial-active-7').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        fade: false,
        arrows: false,
    });
    
    /*--------------------------------
        Product details 3 img slider
    -----------------------------------*/
    $('.product-details-3-img-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        loop: true,
        fade: false,
        arrows: false,
    });
    /*--------------------------------
        Product details 3 img slider 2
    -----------------------------------*/
    $('.product-details-3-img-slider-2').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        loop: true,
        fade: false,
        arrows: false,
    });
   
    
     /*====== SidebarSearch ======*/
    function sidebarSearch() {
        var searchTrigger = $('.search-active'),
            endTriggersearch = $('.megashop-search-close'),
            container = $('.main-search-active');
        
        searchTrigger.on('click', function(e) {
            e.preventDefault();
            container.addClass('search-visible');
        });
        
        endTriggersearch.on('click', function() {
            container.removeClass('search-visible');
        });
        
    };
    sidebarSearch();
    
    /*---------------------
        Price range
    --------------------- */
    var sliderrange = $('#slider-range');
    var amountprice = $('#amount');
    $(function() {
        sliderrange.slider({
            range: true,
            min: 16,
            max: 400,
            values: [0, 300],
            slide: function(event, ui) {
                amountprice.val("$" + ui.values[0] + " - $" + ui.values[1]);
            }
        });
        amountprice.val("$" + sliderrange.slider("values", 0) +
            " - $" + sliderrange.slider("values", 1));
    });
    
    
    /*---------------------
        Video popup
    --------------------- */
    $('.video-popup').magnificPopup({
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        zoom: {
            enabled: true,
        }
    });
    
    
    /*-------------------------------------
        checkout one click toggle function
    ---------------------------------------*/
    var checked = $( '.sin-payment input:checked' )
    if(checked){
        $(checked).siblings( '.payment-box' ).slideDown(900);
    };
	 $( '.sin-payment input' ).on('change', function() {
        $( '.payment-box' ).slideUp(900);
        $(this).siblings( '.payment-box' ).slideToggle(900);
    });
    
    
    /*-----------------------
        Shop filter active 
    ------------------------- */
    $('.shop-filter-active').on('click', function(e) {
        e.preventDefault();
        $('.product-filter-wrapper').toggleClass('active');
    })
    var shopFiltericon = $('.shop-filter-active');
    shopFiltericon.on('click', function() {
        $('.shop-filter-active').toggleClass('active');
    })
    
    
    
    
    /*--
        Product details slider 2
    -----------------------------------*/
    $('.pro-dec-big-img-slider-2').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        draggable: false,
        fade: false,
        asNavFor: '.product-dec-slider-2',
    });
    
    /*--
        Product details 2 slick carousel as Nav
    --------------------------------------------*/
    $('.product-dec-slider-2').slick({
        slidesToShow: 7,
        slidesToScroll: 1,
        vertical: true,
        asNavFor: '.pro-dec-big-img-slider-2',
        dots: false,
        focusOnSelect:true,
        fade: false,
        arrows: false,
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 7,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 575,
                settings: {
                    autoplay: true,
                    slidesToShow: 3,
                }
            }
        ]
    });
    
    
    // Instantiate EasyZoom instances
    var $easyzoom = $('.easyzoom').easyZoom();
    
    
    /*--------------------------------
        Product details slider 5 active
    -----------------------------------*/
    $('.product-details-slider-5-active').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        loop: true,
        fade: false,
        arrows: false,
    });
    
    /*--------------------------------
        Product details tab small
    -----------------------------------*/
    $('.product-details-tab-small').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        dots: false,
        loop: true,
        fade: false,
        arrows: false,
        responsive: [
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            }
        ]
    });
    
    /*--------------------------
        Tab active
    ---------------------------- */
	var ProductDetailsSmall = $('.product-details-tab-small a');
    ProductDetailsSmall.on('click', function(e) {
        e.preventDefault();
        var $href = $(this).attr('href');
        ProductDetailsSmall.removeClass('active');
        $(this).addClass('active');
        $('.product-details-tab-large .tab-pane').removeClass('active');
        $('.product-details-tab-large ' + $href).addClass('active');
    })


    $(".star-box-wrap .single-ratting-star").on('click', function(e) {
        $(".star-box-wrap .single-ratting-star").removeClass('active');
        $(this).toggleClass('active');
        $('#comments-rating').val($(this).children().length<6?$(this).children().length:5);
    });
    $(document).on('click',"[data-basket-mini-add]", function () {
        let id = $(this).attr('data-basket-mini-add');
        let type = $(this).attr('data-basket-mini-type');
        let $elem = $(this);
        let url = $("#url-basket").attr('data-basket-mini-url');
        if(id){
            $.ajax({
                type: "POST",
                url: url,
                data: {"id":id,'type':type},
                success: function(data){
                    data = JSON.parse(data);
                    if(data['success']){
                        if(type == 'basket'){
                            $("#basket-mini-helper").html($("#basket-mini-helper").html()+data['data']);
                            $("#basket-mini-helper-total-price").text(+$("#basket-mini-helper-total-price").text() + data['price']);
                            $('.cart-active').trigger('click');
                        }
                        $elem.addClass('active');
                        $elem.removeAttr('data-basket-mini-add');
                        $elem.attr('data-basket-mini-delete',id);
                        console.log(data);
                        if(typeof(data['product']) != "undefined" && data['product'] !== null)
                            dataLayer.push({
                                "ecommerce": {
                                    "currencyCode": "RUB",
                                    "add": {
                                        "products": [
                                            {
                                                "id": data.product.article,
                                                "name" : data.product.name,
                                                "price": data.product.price,
                                                "brand": data.product.brand,
                                                "category": data.product.category,
                                            }
                                        ]
                                    }
                                }
                            });
                    }else{
                        modal_helper(data['error']);
                    }
                }
            });
        }else{
            modal_helper("Не удалось распознать данные :(");
        }
    });

    $(document).on('click',"[data-basket-mini-delete]", function () {
        let id = $(this).attr('data-basket-mini-delete');
        let type = $(this).attr('data-basket-mini-type');
        let $obj = $(this);
        let url = $("#url-basket").attr('data-basket-mini-remove-url');
        if(id){
            $.ajax({
                type: "POST",
                url: url,
                data: {"id":id,'type':type},
                success: function(data){
                    data = JSON.parse(data);
                    console.log(data);
                    if(data['success']){
                        if(type == 'basket'){
                            $("#basket-mini-helper").find('a[data-basket-mini-delete="'+id+'"]').closest('li').remove();
                            $("#basket-mini-helper-total-price").text(+$("#basket-mini-helper-total-price").text() - data['price']);
                            if(typeof(data['product']) != "undefined" && data['product'] !== null)
                                dataLayer.push({
                                    "ecommerce": {
                                        "currencyCode": "RUB",
                                        "remove": {
                                            "products": [
                                                {
                                                    "id": data.product.data.article,
                                                    "name" : data.product.data.name,
                                                    "price": data.product.data.price,
                                                    "brand": data.product.brand,
                                                    "category": data.product.category,
                                                    "quantity": 1
                                                }
                                            ]
                                        }
                                    }
                                });
                        }else if(type == 'compare'){
                            $obj.closest('table').find('td[data-compare-id="'+id+'"]').remove();
                        }else if(type == 'wishlist'){
                            $obj.closest('tr').remove();
                        }
                        $obj.removeClass('active');
                        $obj.removeAttr('data-basket-mini-delete');
                        $obj.attr('data-basket-mini-add',id);
                    }else{
                        modal_helper(data['error']);
                    }
                }
            });
        }else{
            modal_helper("Не удалось распознать данные :(");
        }
    });

    let modal_helper = function (text) {
        $("#modal-helper p").html("");
        $("#modal-helper p").html(text);
        $("#modal-helper").modal({
            fadeDuration: 250,
            fadeDelay: 0.80,
        })
    }

    $("[data-remove-product]").on('click',function () {
        $(this).closest('tr').remove();
    });

    $("[data-count-product]").on('change',function () {
        $(this).closest('tr').find("[data-price-inp]").text(+$(this).val() * +($(this).closest('[data-price]').attr('data-price')));
    });

    $("[data-order-delivery-select]").on('change',function () {
        console.log($(this));
        if($(this).val() == 1){
            $("[data-order-delivery]").slideUp(900);
            $("[data-order-delivery]").find('input, select').attr('disabled',true);
        }else{
            $("[data-order-delivery]").find('input, select').removeAttr('disabled');
            $("select[data-order-delivery-region-select]").siblings('div.nice-select').find('li').slideDown(400)
            let show_elems = JSON.parse($(this).find('option:selected').attr('data-order-region-show'));
            var values = $("select[data-order-delivery-region-select]>option").map(function() { return $(this).val(); });
            let difference = values.filter(x => !show_elems.includes(x));
            for (let i = 0; i <difference.length; i++) {
                $("select[data-order-delivery-region-select]").siblings('div.nice-select').find('li[data-value="'+difference[i]+'"]').slideUp(400);
            }

            $("[data-order-delivery]").slideDown(900);
        }
    });

    $("[data-order-delivery-region-select]").on('change',function () {
        $("[data-order-delivery-price]").text('');
        $("[data-order-total-price]").text('');
        $("[data-order-delivery-price]").text(+$(this).find('option:selected').attr('data-order-region-price') + " " + $(this).find('option:selected').attr('data-order-region-date'));
        $("[data-order-total-price]").text(+$(this).find('option:selected').attr('data-order-region-price') + +$("[data-order-total-price]").attr('data-order-total-price'));
    });

    $("[data-toggle='tab'][data-order-sign-hide]").on('click',function () {
        $($(this).attr('href')).find('input').removeAttr('disabled');
        let id = $(this).attr('data-order-sign-hide');
        $(id).find('input').attr('disabled',true);
    });

    if($("#modal-helper").hasClass('error') || $("#modal-helper").hasClass('success')){
        $("#modal-helper").modal({
            fadeDuration: 250,
            fadeDelay: 0.80,
        })
    }

    $("[data-catalog-menu-btn]").on('click',function () {
        $(this).closest('div').siblings('.catalog-menu').toggleClass('active');
    });

    $("[data-catalog-article-open],[data-calaog-back]").on('click',function () {
        $(this).closest('[data-catalog-container]').find('[data-catalog-parent="'+$(this).attr('data-catalog-article-open')+'"]').toggleClass('d-none d-flex');
        $(this).closest('[data-catalog-parent]').toggleClass('d-none d-flex');

    });

    $("[data-catalog-back]").on('click',function () {
        $(this).closest('[data-catalog-container]').find('[data-catalog-article="'+$(this).attr('data-catalog-back')+'"]').closest('[data-catalog-parent]').toggleClass('d-none d-flex');
        $(this).closest('[data-catalog-parent]').toggleClass('d-none d-flex');
    });

    $("button[data-order-show-product]").on('click',function () {
        $(this).closest('table').find("tr[data-order-show-product]:visible").slideUp();
        if($(this).closest('tr').siblings("tr[data-order-show-product='"+$(this).attr('data-order-show-product')+"']:visible").length)
            $(this).closest('tr').siblings("tr[data-order-show-product='"+$(this).attr('data-order-show-product')+"']").slideUp();
        else
            $(this).closest('tr').siblings("tr[data-order-show-product='"+$(this).attr('data-order-show-product')+"']").slideDown();
    });

    $("button[data-order-trash]").on('click',function () {
        $("#modal-order a[data-remove-order-complete]").attr('data-remove-order-complete',$(this).attr('data-order-trash'));
        $("#modal-order").modal({
            fadeDuration: 250,
            fadeDelay: 0.80,
        });
    });

    $("a[data-remove-order-complete]").on('click',function () {
        if($(this).attr('data-remove-order-complete')){
            let id = $(this).attr('data-remove-order-complete');
            $.ajax({
                type: "POST",
                url: "order-remove",
                data: {"id":id},
                success: function(data){
                    data = JSON.parse(data);
                    if(data['success']){
                        modal_helper(data['text']);
                    }
                }
            });
        }
    });

    if($("#modal-helper").hasClass('error') || $("#modal-helper").hasClass('success')){
        $("#modal-helper").modal({
            fadeDuration: 250,
            fadeDelay: 0.80,
        })
    }

})(jQuery);

