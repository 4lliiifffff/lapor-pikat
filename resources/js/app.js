

import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// Intersection Observer for scroll reveal animations
document.addEventListener('DOMContentLoaded', () => {
    const revealElements = document.querySelectorAll('.reveal-on-scroll');

    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in-up');
                    entry.target.classList.remove('opacity-0', 'translate-y-4');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.08,
            rootMargin: '0px 0px -20px 0px'
        });

        revealElements.forEach((el) => {
            el.classList.add('opacity-0', 'translate-y-4', 'transition-all', 'duration-500');
            observer.observe(el);
        });
    } else {
        revealElements.forEach((el) => {
            el.classList.remove('opacity-0', 'translate-y-4');
        });
    }
});

