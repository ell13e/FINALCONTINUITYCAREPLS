/**
 * CCS theme scripts: menu toggle, smooth scroll
 */
(function() {
    'use strict';

    function init() {
        initMenuToggle();
        initSmoothScroll();
    }

    function initMenuToggle() {
        var toggle = document.querySelector('.menu-toggle');
        var nav = document.querySelector('.primary-nav');
        if (!toggle || !nav) return;

        function setExpanded(expanded) {
            toggle.setAttribute('aria-expanded', expanded ? 'true' : 'false');
            nav.classList.toggle('is-open', expanded);
        }

        toggle.addEventListener('click', function() {
            var expanded = nav.classList.contains('is-open');
            setExpanded(!expanded);
        });

        document.addEventListener('click', function(e) {
            if (nav.classList.contains('is-open') && !nav.contains(e.target) && !toggle.contains(e.target)) {
                setExpanded(false);
            }
        });
    }

    function initSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
            var href = anchor.getAttribute('href');
            if (href === '#') return;
            anchor.addEventListener('click', function(e) {
                var target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
