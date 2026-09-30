// Swiper initialisation, moved from the inline <script> at the bottom of each original page.
// Settings are unchanged; each slider is only created when its element is on the page.

document.addEventListener("DOMContentLoaded", function () {

  // COMMON AUTOPLAY PAUSE WHILE HOVER (index1.php)
  document.querySelectorAll('.swiper').forEach(el => el.swiper && (
    el.addEventListener('mouseenter', () => el.swiper.autoplay.stop()),
    el.addEventListener('mouseleave', () => el.swiper.autoplay.start())
  ));

  const autoplay = {
    delay: 2500,
    disableOnInteraction: false,
    pauseOnMouseEnter: true,
  };

  const init = (selector, options) => {
    if (document.querySelector(selector)) {
      return new Swiper(selector, options);
    }
    return null;
  };

  // MAIN BANNER SLIDER (home)
  init(".bannerSlider", {
    effect: "fade",
    speed: 500,
    autoplay: autoplay,
    loop: true,
  });

  // QUALITY SLIDER (home, about)
  init(".qualitySlider", {
    speed: 500,
    autoplay: autoplay,
    loop: true,
    slidesPerView: 2,
    spaceBetween: 0,
    breakpoints: {
      576: { slidesPerView: 3 },
      992: { slidesPerView: 4 },
      1200: { slidesPerView: 5 },
    },
  });

  // SNIPPET SLIDER (home)
  init(".snippetSlider", {
    speed: 500,
    autoplay: autoplay,
    loop: true,
    slidesPerView: 1,
    spaceBetween: 10,
    pagination: {
      el: ".snippetSlider .swiper-pagination",
      clickable: true,
    },
    breakpoints: {
      576: { slidesPerView: 1.2, spaceBetween: 10 },
      768: { slidesPerView: 2, spaceBetween: 10 },
      1551: { slidesPerView: 2, spaceBetween: 15 },
      1771: { slidesPerView: 2, spaceBetween: 20 },
    },
  });

  // MANUFACTURE SLIDER (home)
  init(".manufactureSlider", {
    speed: 500,
    autoplay: autoplay,
    loop: true,
    slidesPerView: 2,
    spaceBetween: 10,
    breakpoints: {
      576: { slidesPerView: 3, spaceBetween: 10 },
      768: { slidesPerView: 4, spaceBetween: 10 },
      992: { slidesPerView: 5, spaceBetween: 10 },
      1200: { slidesPerView: 6, spaceBetween: 10 },
      1551: { slidesPerView: 6, spaceBetween: 15 },
      1771: { slidesPerView: 6, spaceBetween: 20 },
    },
  });

  // CERTIFICATION SLIDER (why-arbee)
  init(".certificationSlider", {
    speed: 500,
    autoplay: autoplay,
    loop: true,
    slidesPerView: 3,
    spaceBetween: 0,
    breakpoints: {
      576: { slidesPerView: 5 },
      992: { slidesPerView: 5 },
      1200: { slidesPerView: 5 },
    },
  });

  // COUNTRY SLIDER (fish-meal)
  init(".countrySlider", {
    speed: 500,
    autoplay: autoplay,
    loop: true,
    slidesPerView: 2,
    spaceBetween: 0,
    breakpoints: {
      576: { slidesPerView: 3 },
      768: { slidesPerView: 4 },
      992: { slidesPerView: 5 },
      1200: { slidesPerView: 6 },
    },
  });

  // ANGLE SLIDER (fish-meal)
  init(".angleSlider", {
    speed: 500,
    autoplay: autoplay,
    loop: true,
    slidesPerView: 1,
    spaceBetween: 0,
    breakpoints: {
      576: { slidesPerView: 2 },
      768: { slidesPerView: 2 },
      992: { slidesPerView: 3 },
      1200: { slidesPerView: 3 },
    },
  });

  // APP SLIDER (fish-meal)
  init(".appSlider", {
    speed: 500,
    autoplay: autoplay,
    loop: true,
    slidesPerView: 2,
    spaceBetween: 10,
    breakpoints: {
      576: { slidesPerView: 3, spaceBetween: 15 },
      992: { slidesPerView: 4, spaceBetween: 15 },
      1200: { slidesPerView: 5, spaceBetween: 15 },
      1551: { slidesPerView: 5, spaceBetween: 20 },
      1771: { slidesPerView: 5, spaceBetween: 30 },
    },
  });
});
