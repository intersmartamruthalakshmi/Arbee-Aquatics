// Moved from the inline <script> blocks in the original includes/footer.php.

// LENIS
window.addEventListener('load', () => {
    const lenis = new Lenis({
        smoothWheel: true,
        smoothTouch: true,
        duration: 1,
        lerp: 0.05,
        direction: 'vertical',
        gestureDirection: 'vertical',
        easing: (t) => 1 - Math.pow(2, -10 * t),
    });
    function raf(time) {
        lenis.raf(time);
        requestAnimationFrame(raf);
    }
    requestAnimationFrame(raf);

    window.lenis = lenis;

    document.addEventListener('show.bs.modal', (event) => {
        lenis.stop();
        const modal = event.target;
        modal.addEventListener('wheel', (e) => {
            e.stopPropagation();
        }, { passive: false });
    });
    document.addEventListener('hidden.bs.modal', () => {
        lenis.start();
    });
});

document.addEventListener("DOMContentLoaded", function () {
    // WOW
    if ($(".wow").length && typeof WOW !== "undefined") {
        var wow = new WOW({
            boxClass: "wow",
            animateClass: "animate__animated",
            mobile: true,
            live: true,
        });
        wow.init();
    }

    // SCROLL REVEAL
    const sr = ScrollReveal({
        distance: '50px',
        duration: 1000,
        easing: 'cubic-bezier(0.25, 0.1, 0.25, 1)',
        opacity: 0.5,
        scale: 1,
        cleanup: true,
        reset: true,
        viewFactor: 0.10
    });

    sr.reveal('.reveal-up', {
        origin: 'bottom'
    });
    sr.reveal('.reveal-down', {
        origin: 'top'
    });
    sr.reveal('.reveal-left', {
        origin: 'left'
    });
    sr.reveal('.reveal-right', {
        origin: 'right'
    });
    sr.reveal('.reveal-stagger > *', {
        origin: 'bottom',
        interval: 150
    });
    sr.reveal('.reveal-in', {
        distance: '0px',
        opacity: 0,
        scale: 1,
    });
    sr.reveal('.reveal-out', {
        distance: '0px',
        opacity: 1,
        scale: 1,
        afterReveal: function (el) {
            setTimeout(() => {
                el.style.transition = 'opacity 0.8s ease';
                el.style.opacity = '0';
            }, 1500);
        }
    });

    // FOOTER
    function footerAccordionSetup() {
        if ($(window).width() >= 992) {
            $(".ftAccordion .accordion-collapse").addClass("show");
            $(".ftAccordion .accordion-button")
                .removeClass("collapsed")
                .attr("aria-expanded", "true");
        } else {
            $(".ftAccordion .accordion-collapse").removeClass("show");
            $(".ftAccordion .accordion-button")
                .addClass("collapsed")
                .attr("aria-expanded", "false");
        }
    }
    footerAccordionSetup();
    $(window).on("resize", function () {
        footerAccordionSetup();
    });
    $(".ftAccordion .accordion-button").on("click", function () {
        if ($(window).width() < 992) {
            let target = $(this).attr("data-bs-target");
            $(".ftAccordion .accordion-collapse").not(target).collapse("hide");
            $(".ftAccordion .accordion-button").not(this)
                .addClass("collapsed")
                .attr("aria-expanded", "false");
        }
    });

    $(".select2").select2({
        minimumResultsForSearch: Infinity,
        closeOnSelect: true,
        theme: "select2-custom",
    });

    // MOBILE CODE
    $(".mobile_code").intlTelInput({
        initialCountry: "in",
        separateDialCode: true,
        autoPlaceholder: "off"
    });

    // PRELOADER
    window.addEventListener("load", function () {
        const preloader = document.getElementById("preloader");
        if (!preloader) return;
        preloader.style.opacity = "0";
        setTimeout(() => {
            preloader.style.display = "none";
            preloader.removeAttribute("inert");
        }, 500);
    });

    // LENIS
    if (window.lenis) {
        window.lenis.on('scroll', () => sr.sync());
    }

    // WordPress addition: keyboard support for the hamburger (custom.js handles the click).
    $("#hamburger").on("keydown", function (e) {
        if (e.key === "Enter" || e.key === " ") {
            e.preventDefault();
            this.click();
        }
    });
});
