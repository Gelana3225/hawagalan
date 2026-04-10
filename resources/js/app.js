import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', function () {

    // ── Read More / Read Less toggle ──────────────────────────────────────────
    // Works on both desktop (click) and mobile (touch)
    document.querySelectorAll('.attraction-link').forEach(function (link) {
        // Use both click and touchend for mobile compatibility
        ['click', 'touchend'].forEach(function (eventType) {
            link.addEventListener(eventType, function (e) {
                e.preventDefault();
                e.stopPropagation();

                const card = this.closest('.attraction-content') || this.parentElement;
                const hiddenText = card ? card.querySelector('.hidden-text') : null;
                if (!hiddenText) return;

                const isExpanded = this.getAttribute('aria-expanded') === 'true';

                if (isExpanded) {
                    hiddenText.style.display = 'none';
                    this.setAttribute('aria-expanded', 'false');
                    this.textContent = 'Read More';
                } else {
                    hiddenText.style.display = 'block';
                    this.setAttribute('aria-expanded', 'true');
                    this.textContent = 'Read Less';
                }
            }, { passive: false });
        });
    });

    // ── Hover effects (desktop only, skip on touch devices) ──────────────────
    const isTouchDevice = ('ontouchstart' in window) || (navigator.maxTouchPoints > 0);

    if (!isTouchDevice) {
        document.querySelectorAll('.attraction-card').forEach(function (card) {
            card.addEventListener('mouseenter', function () {
                this.style.transform = 'translateY(-10px)';
                this.style.boxShadow = '0 20px 40px rgba(0,0,0,0.15)';
            });
            card.addEventListener('mouseleave', function () {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '0 10px 30px rgba(0,0,0,0.1)';
            });
        });

        document.querySelectorAll('.photo-box img').forEach(function (img) {
            img.parentElement.addEventListener('mouseenter', function () {
                img.style.transform = 'scale(1.05)';
            });
            img.parentElement.addEventListener('mouseleave', function () {
                img.style.transform = 'scale(1)';
            });
        });
    }

    // ── Page-specific initializations ────────────────────────────────────────
    if (document.querySelector('.farming-welcome')) initFarmingPage();
    if (document.querySelector('.tourism-hero')) initTourismPage();
});

function initFarmingPage() {
    document.querySelectorAll('.photo-box').forEach(function (box) {
        box.style.cursor = 'pointer';
    });
}

function initTourismPage() {
    const navLinks = document.querySelectorAll('.section-nav a');
    navLinks.forEach(function (link) {
        link.addEventListener('click', function () {
            navLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
        });
    });
}

// ── Smooth scroll for anchor links ───────────────────────────────────────────
document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
    anchor.addEventListener('click', function (e) {
        const href = this.getAttribute('href');
        if (href === '#') return;
        const target = document.querySelector(href);
        if (target) {
            e.preventDefault();
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
});
