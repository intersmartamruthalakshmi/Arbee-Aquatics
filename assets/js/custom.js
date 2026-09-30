$(document).ready(function () {
  $("#menubt1").click(function () {
    $(".main-navigation").toggleClass("active");
  });
  $("body").on("click", function (event) {
    if (!$(event.target).closest("#menubt1,.main-navigation").length) {
      $(".main-navigation").removeClass("active");
    }
  });

  if ($.fn.owlCarousel) {
    if ($(".owl-carousel.eventsection").length) {
      $(".owl-carousel.eventsection").owlCarousel({
        loop: true,
        nav: false,
        dots: false,
        autoplay: true,
        autoplayTimeout: 3000,
        smartSpeed: 2000,
        margin: 15,
        responsive: {
          0: {
            items: 1,
          },
          700: {
            items: 2,
          },
          1000: {
            items: 3,
          },
          1400: {
            items: 5,
          },
        },
      });
    }

    if ($(".owl-carousel.slideragent").length) {
      $(".owl-carousel.slideragent").owlCarousel({
        loop: true,
        nav: true,
        dots: false,
        autoplay: true,
        autoplayTimeout: 3000,
        margin: 25,
        responsive: {
          0: {
            items: 1,
          },
          700: {
            items: 2,
          },
        },
      });
    }

    if ($(".owl-carousel.certsliderpog").length) {
      $(".owl-carousel.certsliderpog").owlCarousel({
        loop: true,
        nav: true,
        dots: false,
        autoplay: true,
        margin: 10,
        responsive: {
          0: {
            items: 1,
          },
          450: {
            items: 2,
          },
          600: {
            items: 3,
          },
          800: {
            items: 4,
          },
          1200: {
            items: 3,
          },
          1500: {
            items: 4,
          },
        },
      });
    }
  }
});

// HEADER
document.addEventListener("DOMContentLoaded", () => {
  const header = document.getElementById("Header");
  const hamburger = document.getElementById("hamburger");
  const closeNav = document.getElementById("closeNav");
  const navMenu = document.getElementById("navMenu");

  let lastScrollY = window.scrollY;
  const isDesktop = () => window.innerWidth >= 992;
  const resetMenuState = (el) => {
    if (!el) return;
    el.classList.remove("active", "open");
    el.querySelectorAll(".active, .open").forEach((active) =>
      active.classList.remove("active", "open"),
    );
  };

  const closeMobileMenu = () => {
    resetMenuState(navMenu);
    hamburger?.classList.remove("active");
  };

  let ticking = false;
  window.addEventListener(
    "scroll",
    () => {
      if (!ticking) {
        window.requestAnimationFrame(() => {
          const currentY = window.scrollY;

          header?.classList.toggle("sticky", currentY > 80);
          header?.classList.toggle(
            "hide",
            currentY > lastScrollY && currentY > 120,
          );

          lastScrollY = currentY;
          ticking = false;
        });
        ticking = true;
      }
    },
    { passive: true },
  );

  hamburger?.addEventListener("click", (e) => {
    e.stopPropagation();
    hamburger.classList.toggle("active");
    const isOpen = navMenu?.classList.toggle("open");
    if (!isOpen) resetMenuState(navMenu);
  });

  closeNav?.addEventListener("click", (e) => {
    e.stopPropagation();
    closeMobileMenu();
  });

  document.addEventListener("click", (e) => {
    if (navMenu?.classList.contains("open") && !header?.contains(e.target)) {
      closeMobileMenu();
    }
  });

  if (navMenu) {
    navMenu.addEventListener("click", (e) => {
      if (isDesktop()) return;

      const toggleBtn = e.target.closest("button");
      const parentItem = toggleBtn?.closest(".subMenuItem, .navigationItem");
      if (!parentItem) return;

      e.preventDefault();
      e.stopPropagation();

      [...parentItem.parentElement.children].forEach((sib) => {
        if (sib !== parentItem) resetMenuState(sib);
      });

      parentItem.classList.toggle("active");
    });

    const menuItems = navMenu.querySelectorAll(
      ".navigationItem.hasMenu, .subMenuItem",
    );
    menuItems.forEach((item) => {
      item.addEventListener("mouseenter", () => {
        if (isDesktop()) item.classList.add("active");
      });
      item.addEventListener("mouseleave", () => {
        if (isDesktop()) resetMenuState(item);
      });
    });
  }
});
