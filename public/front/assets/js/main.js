/**
* Template Name: Slider App
*/

(function () {
  "use strict";

  /**
   * Easy selector helper function
   */
  const select = (el, all = false) => {
    el = el.trim()
    if (all) {
      return [...document.querySelectorAll(el)]
    } else {
      return document.querySelector(el)
    }
  }


  /**
   * Easy event listener function
   */
  const on = (type, el, listener, all = false) => {
    let selectEl = select(el, all)
    if (selectEl) {
      if (all) {
        selectEl.forEach(e => e.addEventListener(type, listener))
      } else {
        selectEl.addEventListener(type, listener)
      }
    }
  }

  /**
   * Easy on scroll event listener 
   */
  const onscroll = (el, listener) => {
    el.addEventListener('scroll', listener)
  }

  /**
   * Navbar links active state on scroll
   */
  let navbarlinks = select('#navbar .scrollto', true)
  const navbarlinksActive = () => {
    let position = window.scrollY + 200
    navbarlinks.forEach(navbarlink => {
      if (!navbarlink.hash) return
      let section = select(navbarlink.hash)
      if (!section) return
      if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
        navbarlink.classList.add('active')
      } else {
        navbarlink.classList.remove('active')
      }
    })
  }
  window.addEventListener('load', navbarlinksActive)
  onscroll(document, navbarlinksActive)

  /**
   * Scrolls to an element with header offset
   */
  const scrollto = (el) => {
    let header = select('#header')
    let offset = header.offsetHeight

    if (!header.classList.contains('header-scrolled')) {
      offset -= 20
    }

    let elementPos = select(el).offsetTop
    window.scrollTo({
      top: elementPos - offset,
      behavior: 'smooth'
    })
  }

  /**
   * Toggle .header-scrolled class to #header when page is scrolled
   */
  let selectHeader = select('#header')
  if (selectHeader) {
    const headerScrolled = () => {
      if (window.scrollY > 100) {
        selectHeader.classList.add('header-scrolled')
      } else {
        selectHeader.classList.remove('header-scrolled')
      }
    }
    window.addEventListener('load', headerScrolled)
    onscroll(document, headerScrolled)
  }

  /**
   * Back to top button
   */
  let backtotop = select('.back-to-top')
  if (backtotop) {
    const toggleBacktotop = () => {
      if (window.scrollY > 100) {
        backtotop.classList.add('active')
      } else {
        backtotop.classList.remove('active')
      }
    }
    window.addEventListener('load', toggleBacktotop)
    onscroll(document, toggleBacktotop)
  }

  /**
   * Mobile nav toggle
   */
  on('click', '.mobile-nav-toggle', function (e) {
    select('#navbar').classList.toggle('navbar-mobile')
    this.classList.toggle('bi-list')
    this.classList.toggle('bi-x')
  })

  /**
   * Mobile nav dropdowns activate
   */
  on('click', '.navbar .dropdown > a', function (e) {
    if (select('#navbar').classList.contains('navbar-mobile')) {
      e.preventDefault()
      this.nextElementSibling.classList.toggle('dropdown-active')
    }
  }, true)

  /**
   * Scrool with ofset on links with a class name .scrollto
   */
  on('click', '.scrollto', function (e) {
    if (select(this.hash)) {
      e.preventDefault()

      let navbar = select('#navbar')
      if (navbar.classList.contains('navbar-mobile')) {
        navbar.classList.remove('navbar-mobile')
        let navbarToggle = select('.mobile-nav-toggle')
        navbarToggle.classList.toggle('bi-list')
        navbarToggle.classList.toggle('bi-x')
      }
      scrollto(this.hash)
    }
  }, true)

  /**
   * Scroll with ofset on page load with hash links in the url
   */
  window.addEventListener('load', () => {
    if (window.location.hash) {
      if (select(window.location.hash)) {
        scrollto(window.location.hash)
      }
    }
  });

  /**
   * Preloader
   */
  let preloader = select('#preloader');
  if (preloader) {
    window.addEventListener('load', () => {
      preloader.remove()
    });
  }

  /**
   * Initiate glightbox 
   */
  const glightbox = GLightbox({
    selector: '.glightbox'
  });

  /**
   * Testimonials slider
   */
  new Swiper('.testimonials-slider', {
    speed: 600,
    loop: true,
    autoplay: {
      delay: 8000,
      disableOnInteraction: false
    },
    slidesPerView: 'auto',
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
      clickable: true
    }
  });

  function getCurrentScroll() {
    return window.pageYOffset || document.documentElement.scrollTop;
  }

  /**
   * Porfolio isotope and filter
   */
  window.addEventListener('load', () => {

    let portfolioContainer = select('.portfolio-container');

    if (portfolioContainer) {
      let portfolioIsotope = new Isotope(portfolioContainer, {
        itemSelector: '.portfolio-item'
      });

      let portfolioFilters = select('#portfolio-flters li', true);

      on('click', '#portfolio-flters li', function (e) {
        e.preventDefault();
        portfolioFilters.forEach(function (el) {
          el.classList.remove('filter-active');
        });
        this.classList.add('filter-active');

        portfolioIsotope.arrange({
          filter: this.getAttribute('data-filter')
        });
        portfolioIsotope.on('arrangeComplete', function () {
          AOS.refresh()
        });

      }, true);
    }

  });

  /**
   * Initiate portfolio lightbox 
   */
  const portfolioLightbox = GLightbox({
    selector: '.portfolio-lightbox'
  });

  /**
   * Home Main slider
   */
  // Initialize the swiper slider
  var swiper = new Swiper('.homeSlide', {
    speed: 400,
    loop: true,
    autoplay: {
      delay: 8000,
      disableOnInteraction: false
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev"
    },
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
    },
  });

  // Stop the autoplay on mouse hover
  $('.homeSlide').hover(function () {
    swiper.autoplay.stop();
  }, function () {
    swiper.autoplay.start();
  });

  // happy customer slider

  new Swiper('.happy_customer_slide', {
    spaceBetween: 30,
    slidesPerView: 3,
    speed: 400,
    loop: true,
    autoplay: {
      delay: 8000,
      disableOnInteraction: false
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev"
    },
    breakpoints: {
      1024: {
        slidesPerView: 3,
        spaceBetween: 30,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 30,
      },
      640: {
        slidesPerView: 1,
        spaceBetween: 1,
      },
      320: {
        slidesPerView: 1,
        spaceBetween: 1,
      }
    }
  });

  /**
 * Expert Speak Slider
 */

  $(document).ready(function () {
    // Assign some jquery elements we'll need
    var $swiper = $(".expert-speak-slider");
    var $bottomSlide = null; // Slide whose content gets 'extracted' and placed
    // into a fixed position for animation purposes
    var $bottomSlideContent = null; // Slide content that gets passed between the
    // panning slide stack and the position 'behind'
    // the stack, needed for correct animation style

    var mySwiper = new Swiper(".expert-speak-slider", {
      spaceBetween: 1,
      slidesPerView: 3,
      centeredSlides: true,
      roundLengths: true,
      loop: true,
      loopAdditionalSlides: 30,
      autoplay: {
        delay: 8000,
        disableOnInteraction: false
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev"
      },
      pagination: {
        el: '.swiper-pagination',
        type: 'progressbar',
      },
      breakpoints: {
        1024: {
          slidesPerView: 3,
          spaceBetween: 1,
        },
        768: {
          slidesPerView: 3,
          spaceBetween: 1,
        },
        640: {
          slidesPerView: 1,
          spaceBetween: 1,
        },
        320: {
          slidesPerView: 1,
          spaceBetween: 1,
        }
      }
    });
  });


  /**
  * Lcs slider
  */

  new Swiper('.lcs-banner', {
    spaceBetween: 10,
    slidesPerView: 3,
    centeredSlides: true,
    speed: 400,
    loop: true,
    autoplay: {
      delay: 8000,
      disableOnInteraction: false
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev"
    },
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
      clickable: true
    },
    breakpoints: {
      1024: {
        slidesPerView: 2.5,
        spaceBetween: 10,
      },
      768: {
        slidesPerView: 2.1,
        spaceBetween: 10,
      },
      640: {
        slidesPerView: 1,
        spaceBetween: 10,
      },
      320: {
        slidesPerView: 1,
        spaceBetween: 10,
      }
    }
  });


  /**
     * Why Drink Slider App slider
     */

  new Swiper('.whydrinkslider', {
    spaceBetween: 10,
    slidesPerView: 1.8,
    speed: 400,
    loop: true,
    autoplay: {
      delay: 8000,
      disableOnInteraction: false,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev"
    },
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
      clickable: true
    },
    observer: true,
    observeParents: true,

    breakpoints: {
      1024: {
        slidesPerView: 3,
        spaceBetween: 10,
      },
      768: {
        slidesPerView: 1,
        spaceBetween: 10,
      },
      640: {
        slidesPerView: 1,
        spaceBetween: 10,
      },
      320: {
        slidesPerView: 1,
        spaceBetween: 10,
      }
    }
  });


  /**
     * Slider App slider
     */

  new Swiper('.yaklight-slider', {
    spaceBetween: 10,
    slidesPerView: 1,
    speed: 400,
    loop: true,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev"
    },
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
      clickable: true
    },
    observer: true,
    observeParents: true,

    breakpoints: {
      1024: {
        slidesPerView: 1,
        spaceBetween: 10,
      },
      768: {
        slidesPerView: 1,
        spaceBetween: 10,
      },
      640: {
        slidesPerView: 1,
        spaceBetween: 10,
      },
      320: {
        slidesPerView: 1,
        spaceBetween: 10,
      }
    }
  });

  // new-delivery-slide
  new Swiper('.delivery_slide', {
    spaceBetween: 10,
    slidesPerView: 1,
    speed: 400,
    loop: true,
    autoplay: {
      delay: 8000,
      disableOnInteraction: false
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev"
    },
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
      clickable: true
    },
    observer: true,
    observeParents: true,

    breakpoints: {
      1024: {
        slidesPerView: 1,
        spaceBetween: 10,
      },
      768: {
        slidesPerView: 1,
        spaceBetween: 10,
      },
      640: {
        slidesPerView: 1,
        spaceBetween: 10,
      },
      320: {
        slidesPerView: 1,
        spaceBetween: 10,
      }
    }
  });
  // end-delivery-slide


  /**
   * Waster Packers Slider
   */


  new Swiper('.wasteprackers-slider', {
    speed: 400,
    loop: true,
    autoplay: {
      delay: 8000,
      disableOnInteraction: false
    },
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
      clickable: true
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev"
    }
  });


  /**
   * News and Events Slider
   */


  const eventSlider = () => {
    let eventSliders = document.querySelectorAll('.event-swiper')
    let prevArrow = document.querySelectorAll('.prev')
    let nextArrow = document.querySelectorAll('.next')
    eventSliders.forEach((slider, index) => {
      // this bit checks if there's more than 1 slide, if there's only 1 it won't loop
      let sliderLength = slider.children[0].children.length
      let result = (sliderLength > 1) ? true : false
      const swiper = new Swiper(slider, {
        direction: 'horizontal',
        loop: result,
        navigation: {
          // the 'index' bit below is just the order of the class in the queryselectorAll array, so the first one would be NextArrow[0] etc
          nextEl: nextArrow[index],
          prevEl: prevArrow[index],
        },
        speed: 1000,
      });
    })
  }
  window.addEventListener('load', eventSlider)



  /**
   * Animation on scroll
   */
  window.addEventListener('load', () => {
    AOS.init({
      duration: 1000,
      easing: "ease-in-out",
      once: true,
      mirror: false
    });
  });


  /**
   * Initiate Pure Counter 
   */


  const videoSection = $("a.playVid");
  videoSection.on('click', function () {
    //alert('Video Popup');
    var dataUrl = $(this).data('video-url');
    var dataPoster = $(this).data('video-poster');
    //var strAttr =   			

    $('#popupVid').addClass('active');
    $('#popupVid iframe').attr({
      src: dataUrl,
      poster: dataPoster
    });
    //alert(dataPoster);
    //$('#popupVid video').attr('src', dataURL);
    //$('#popupVid video').attr('poster', dataPoster);

  });

  $('#cls_popup').on('click', function () {
    $('#popupVid').removeClass('active');
    //$('#popupVid video').removeAttr('poster');
    $('#popupVid iframe').removeAttr('src');
  })

  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })


  jQuery('.swiper-button-next, .swiper-button-prev').on('click', function (e) {
    var parent_div = jQuery(this).closest('section').toggleClass('red');
    parent_div.siblings().removeClass('red');
  });

})()
