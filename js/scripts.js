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


var swiper = new Swiper(".mySwiper", {
    slidesPerView: 1,
});


$(window).on('load', function() {
  LOADER.close(function() {
      $('body').addClass('loaded');
      
        var swiper = new Swiper(".mySwiper", {
          slidesPerView: 1,
          effect: "fade",
          loop: true,
          autoplay: {
            delay: 6000,
            disableOnInteraction: false,
          },
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
        $('body').addClass('sc');
      } else {
        $('.headerInner').removeClass('scrolled');
        $('.single-Professionals .js-nav-offset').removeAttr('style');
        $('body').removeClass('sc');
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
    




    var swiperTestimonials = new Swiper(".sliderTestimonials", {
      slidesPerView: 1,
      // effect: "fade",
      loop: true,
      autoplay: {
        delay: 6000,
        disableOnInteraction: false,
      },
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
      slidesPerView: 3.2,
      spaceBetween: 16,
      freeMode: true,
      loop: false,
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
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
          slidesPerView: 3.2,
        },
      }
    });


    var swiperProfessionals = new Swiper(".sliderProfessionals", {
      slidesPerView: 2,
      spaceBetween: 27,
      loop: false,
      // autoplay: {
      //   delay: 2500,
      //   disableOnInteraction: false,
      // },
      keyboard: {
        enabled: false,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev"
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
                    spaceBetween: 15
        },
        1080: {
          slidesPerView: 5,
                    spaceBetween: 15
        },
      }
    });






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


    // init Isotope
    var $grid_testimonials = $('.--testimonialsList-isotope').isotope({
      itemSelector: '.testimonialsGroup',
      resizable: false,
      animationEngine: 'jquery'
    });
    // filter functions
    var filterFns_testimonials = {
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
      filterValue = filterFns_testimonials[ filterValue ] || filterValue;
      $grid_testimonials.isotope({ filter: filterValue });
    });


    $('.tabsContent').hide();
    $('.tabsContent:first').show();
    $('.tabsNav li:first').addClass('active');
    $('.tabsNav li').click(function(event) {

      $('.tabsNav li').removeClass('active');
      $(this).addClass('active');
      $('.tabsContent').hide();

      var selectTab = $(this).find(".tabsNav-at").attr("data-tab");


      $(selectTab).fadeIn();
    });


    $('.filtersBox-page_practice_areas').change(function() {
        var $option = $(this).find('option:selected');
        var value = $option.val();

        $('.tabsNav li').removeClass('active');

        $(".tabsNav-at[data-tab = '"+value+"']").parent().addClass('active');


        $('.tabsContent').hide();
        $(value).fadeIn();
    });

    $('#filterArticle').on('change', function(){
      window.location = $(this).val();
   });


   $(".show-more").click(function () {
      if ($(this).text() == "Read More") {
        $(this).text("Read Less");
      }else{
        $(this).text("Read More");
      }

      $(this).parent().find('.testimonialsItem-content').toggleClass("show-more-height");

      $(".--testimonialsList-isotope").isotope('layout');

  });

  // Share   ------------------
  $(".shareContainer").share({
      networks: ['whatsapp', 'facebook', 'twitter', 'linkedin', 'email']
  });

});
