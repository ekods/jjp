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
        $('.single-Professionals .js-nav-offset').css({
            'padding-top': hblock,
        });
        $('.headerInner').addClass('scrolled');
      } else {
        $('.headerInner').removeClass('scrolled');
        $('.single-Professionals .js-nav-offset').removeAttr('style');
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

    var swiperNewsroom = new Swiper(".sliderNewsroom", {
      autoHeight: true,
      loop: false,
      slidesPerView: 1.2,
      spaceBetween: 16,
      freeMode: true,
      loop: false,
      // autoplay: {
      //   delay: 2500,
      //   disableOnInteraction: false,
      // },
      keyboard: {
        enabled: false,
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      breakpoints: {
        320: {
          slidesPerView: 1.2,
        },
        480: {
          slidesPerView: 1.2,
        },
        769: {
          slidesPerView: 2.2,
        },
      }
    });


    var swiperProfessionals = new Swiper(".sliderProfessionals", {
      loop: false,
      slidesPerView: 2,
      spaceBetween: 27,
      loop: true,
      // autoplay: {
      //   delay: 2500,
      //   disableOnInteraction: false,
      // },
      keyboard: {
        enabled: false,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      breakpoints: {
        320: {
          slidesPerView: 1,
          spaceBetween: 15
        },
        330: {
          slidesPerView: 2,
          spaceBetween: 15
        },
        600: {
          slidesPerView: 3,
          spaceBetween: 15
        },
        769: {
          slidesPerView: 4,
        },
        1080: {
          slidesPerView: 5,
        },
      }
    });
    


  var init = false;

  function swiperCard() {
    if (window.innerWidth <= 767) {
      if (!init) {
        init = true;
        swiper = new Swiper(".sliderPracticeareas-side", {
          direction: "horizontal",
          slidesPerView: "auto",
          spaceBetween: 27,
          slidesPerView: 3,
          pagination: {
            el: ".swiper-pagination",
            clickable: true,
          },
          breakpoints: {
            320: {
              slidesPerView: 1,
              spaceBetween: 15
            },
            330: {
              slidesPerView: 2,
              spaceBetween: 15
            },
            600: {
              slidesPerView: 3,
              spaceBetween: 15
            },
          }
        });
      }
    } else if (init) {
      swiper.destroy();
      init = false;
    }
  }
  swiperCard();
  window.addEventListener("resize", swiperCard);


    // init Isotope
    var $grid = $('.--professionalsList-isotope').isotope({
      itemSelector: '.professionalsItem',
      layoutMode: 'fitRows'
    });
    // filter functions
    var filterFns = {
      // show if number is greater than 50
      numberGreaterThan50: function() {
        var number = $(this).find('.number').text();
        return parseInt( number, 10 ) > 50;
      },
      // show if name ends with -ium
      ium: function() {
        var name = $(this).find('.name').text();
        return name.match( /ium$/ );
      }
    };
    // bind filter on select change
    $('.filters-select').on( 'change', function() {
      // get filter value from option value
      var filterValue = this.value;
      // use filterFn if matches value
      filterValue = filterFns[ filterValue ] || filterValue;
      $grid.isotope({ filter: filterValue });
    });


    $('.accordionLabel').click(function() {
        
      //$(".accordionBody").not($(this).next()).removeClass("accordionBody-open");
      $(this).next().toggleClass("accordionBody-open");
      
      //$(".accordionItem").not($(this).closest(".accordionItem")).removeClass("accordion-open");
      $(this).closest(".accordionItem").toggleClass("accordion-open");
    });
    
});