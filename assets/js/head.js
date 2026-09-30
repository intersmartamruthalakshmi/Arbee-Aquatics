// Moved from the inline <script> in the original main.php <head>.

// VIEWPORT_HEIGHT
const appHeight = () => document.documentElement.style.setProperty('--app-height', `${window.innerHeight}px`)
window.addEventListener('resize', function () {
    appHeight();
});
document.addEventListener("DOMContentLoaded", function () {
    appHeight();
});
// NO_JS
(function () {
    document.querySelectorAll('.no-js').forEach(function (element) {
        element.classList.remove('no-js');
    });
})();
