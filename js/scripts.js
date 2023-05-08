function introLoader(element,delay) {
  this.open = function(callback) {
    setTimeout(function() {
      $(element).fadeIn(500, function() {
        if(callback !== undefined) callback();
      });
    }, delay);

  };
  this.close = function(callback) {
    setTimeout(function() {
      $(element).fadeOut(500, function() {
        if(callback !== undefined) callback();
      });
    }, delay);
  };
}

var LOADER = new introLoader('#introLoader',500);
$(window).on('load', function() {
  LOADER.close(function() {
  });
});


// Init all functions------------------
$(document).ready(function () {

    const observer = lozad(); // lazy loads elements with default selector as ".lozad"
    observer.observe();
    // Initialize library
    lozad('.lozad', {
            load: function(el) {
                    el.src = el.dataset.src;
                    el.onload = function() {
                            el.classList.add('fade')
                    }
            }
    }).observe();




  
    // scroll
    $(window).scroll(function () {
      var scrollpos = $(window).scrollTop();
      var hblock = $('.headerInner').outerHeight();
      if(scrollpos > hblock) {
          // $('.js-nav-offset').css({
          //     'padding-top': hblock,
          // });
          $('.headerInner').addClass('scrolled');
      } else {
          $('.headerInner').removeClass('scrolled');
          //$('.js-nav-offset').removeAttr('style');
      }
    });
  
  
    var hamburgerMenu = $("#hamburger-menu");
    var overlay = $("#overlay");
    var html = $("html");
    hamburgerMenu.on("click", function(e) {
      //hamburgerMenu.toggleClass("active");
      overlay.toggleClass("overlay-active");
      html.toggleClass("menu-active");
      e.preventDefault();
    });
  
    $(".anchor-nav").on("click", function() {
      //hamburgerMenu.removeClass("active");
      overlay.removeClass("overlay-active");
      html.removeClass("menu-active");
    });
  

    $("#hamburger-menu-2").on("click", function(e) {
      //hamburgerMenu.removeClass("active");
      overlay.removeClass("overlay-active");
      html.removeClass("menu-active");
      e.preventDefault();
    });


    $('.openSearch').on('click', function(event){
      event.stopPropagation();
    
      $('.searchBlock').toggleClass('visible');
      $('.searchBlock .searchInput').focus();
    });
    
    $('body').on('click', function(){
      $('.searchBlock').removeClass('visible');
    });
    
    $('.searchBox').on('click', function(event){
      event.stopPropagation();
    });
    
    $('.searchInput').on('keyup', function(event){
      if($(this).val() !== ''){
        $(this).addClass('typing');
      } else {
        $(this).removeClass('typing');
      }
    });




    var swiper = new Swiper(".mySwiper", {
      slidesPerView: 1,
      effect: "fade",
      loop: true,
      // autoplay: {
      //   delay: 2500,
      //   disableOnInteraction: false,
      // },
      keyboard: {
        enabled: true,
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
    
});