"use strict";

/**
 *	Custom jQuery Scripts
 *	Date Modified: 09.03.2021
 *	Developed by: Lisa DeBona
 */
jQuery(document).ready(function ($) {
  var site_url = $("#site-logo a").attr("href");
  var site_logo = $("#site-logo a").html();
  $(window).scroll(function () {
    var nav = $('#masthead');
    var top = 200;

    if ($(window).scrollTop() >= top) {
      nav.addClass('fixed');
    } else {
      nav.removeClass('fixed');
    }
  });
  $("#primary-menu li.menu-item-has-children").hover(function () {
    $("#navOverlay").addClass('active');
  }, function () {
    $("#navOverlay").removeClass('active');
  });
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
  // $("#primary-menu > li > a").on("click",function(e){
  //   e.preventDefault();
  //   var target = $(this);
  //   var link = $(this).attr("href");
  //   if( link ) {
  //     if (location.href.indexOf("http") != -1) {
  //       $(this).addClass('pop');
  //       setTimeout(function(){
  //         window.location = link;
  //       },300)
  //     } 
  //   }
  // });
  // $("#primary-menu a").each(function(){
  //   if( $(this).attr("href")=='#logo' ) {
  //     $(this).parents("li").addClass("logo-area");
  //   }
  // }); 

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
      var homeLink = '<li id="homepagelink"><a href="' + siteURL + '">Home</a></li></li>';

      if ($("#homepagelink").length == 0) {
        $("#primary-menu").prepend(homeLink);
      }

      $("#primary-menu > li.menu-item-has-children > a").each(function () {
        $(this).attr("href", "#");
        $(this).addClass('parentMenu');
      });
      $(document).on("click", "a.parentMenu", function (e) {
        // e.preventDefault();
        e.stopImmediatePropagation();
        $(this).next().slideToggle(100); //$(this).next().toggleClass('open');
      });
    }
  }
  /* Smooth Anchor Scroll */
  // Select all links with hashes


  if (window.location.hash) {
    var urlHash = window.location.hash;

    if ($(urlHash).length) {
      do_smooth_anchor($(urlHash));
    }
  }

  $('a[href*="#"]').not('[href="#"]').not('[href="#0"]').click(function (event) {
    // On-page links
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']'); // Does a scroll target exist?

      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        do_smooth_anchor(target); // var offset = $('#site-logo').height() + 60;
        // $('html, body').animate({
        //   scrollTop: target.offset().top - offset
        // }, 1000, function() {
        //   // Callback after animation
        //   // Must change focus!
        //   var $target = $(target);
        //   $target.focus();
        //   if ($target.is(":focus")) { // Checking if the target was focused
        //     return false;
        //   } else {
        //     $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
        //     $target.focus(); // Set focus again
        //   };
        // });
      }
    }
  });

  function do_smooth_anchor(target) {
    var offset = $('#site-logo').height() + 60;
    $('html, body').animate({
      scrollTop: target.offset().top - offset
    }, 1000, function () {
      target.focus();

      if (target.is(":focus")) {
        // Checking if the target was focused
        return false;
      } else {
        target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable

        target.focus(); // Set focus again
      }

      ;
    });
  }
  /* PARALLAX */

  /** change value here to adjust parallax level */
  // var parallax = -0.5;
  // var $bg_images = $(".parallax-image-block");
  // var offset_tops = [];
  // $bg_images.each(function(i, el) {
  //   offset_tops.push($(el).offset().top);
  // });
  // $(window).scroll(function() {
  //   var dy = $(this).scrollTop();
  //   $bg_images.each(function(i, el) {
  //     var ot = offset_tops[i];
  //     $(el).css("background-position", "50% " + (dy - ot) * parallax + "px");
  //   });
  // });

});