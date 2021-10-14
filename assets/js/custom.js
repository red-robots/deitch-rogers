"use strict";

/**
 *	Custom jQuery Scripts
 *	Date Modified: 09.03.2021
 *	Developed by: Lisa DeBona
 */
jQuery(document).ready(function ($) {
  var site_url = $("#site-logo a").attr("href");
  var site_logo = $("#site-logo a").html();
  /* Mobile Menu */

  $("#menutoggle").on("click", function (e) {
    e.preventDefault();
    $('body').toggleClass('mobile-menu-open');
    $('#siteNav').toggleClass('active');
    $(this).toggleClass('active');
  });
  $(".menu-overlay").on("click", function () {
    $('body').removeClass('mobile-menu-open');
    $('#siteNav,#menutoggle').removeClass('active');
  });
  /* Pop bubble when clicking a menu */

  $("#primary-menu > li > a").on("click", function (e) {
    e.preventDefault();
    var target = $(this);
    var link = $(this).attr("href");

    if (link) {
      if (location.href.indexOf("http") != -1) {
        $(this).addClass('pop');
        setTimeout(function () {
          window.location = link;
        }, 300);
      }
    }
  });
  $("#primary-menu a").each(function () {
    if ($(this).attr("href") == '#logo') {
      $(this).parents("li").addClass("logo-area");
    }
  });
  $('[data-fancybox]').fancybox({
    protect: true
  });
  /* Slideshow */

  var swiper = new Swiper('#slideshow', {
    effect: 'fade',

    /* "slide", "fade", "cube", "coverflow" or "flip" */
    loop: true,
    noSwiping: false,
    simulateTouch: false,
    speed: 1000,
    autoplay: {
      delay: 4000
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev'
    }
  });
  swiper.on('slideChangeTransitionStart', function () {
    var slideNum = $(".swiper-slide-active").attr("data-slide");
    $(".slideCaption").removeClass('active');
    $(".slideCaption." + slideNum).addClass('active'); // $(".swiper-slide").each(function(){
    //   if( $(this).hasClass("swiper-slide-active") ) {
    //     $(".slideCaption."+slideNum).addClass('active');
    //   } else {
    //     $(".slideCaption").removeClass('active');
    //   }
    // });
  });
  var wow = new WOW();
  wow.init();

  WOW.prototype.addBox = function (element) {
    this.boxes.push(element);
  };

  mobile_nav();
  $(window).on("resize", function () {
    mobile_nav();
  });

  function mobile_nav() {
    if ($(window).width() < 820) {
      /* Append Home URL */
      var homeLink = '<li><a href="' + siteURL + '">Home</a></li></li>';
      $("#primary-menu").prepend(homeLink);
      $("#primary-menu > li.menu-item-has-children > a").each(function () {
        $(this).attr("href", "#");
        $(this).addClass('parentMenu');
      });
      $(document).on("click", "a.parentMenu", function (e) {
        e.preventDefault();
        $(this).next().slideToggle();
      });
    }
  }
});