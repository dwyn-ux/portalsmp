/**
 * Portal Digital SMP Muhammadiyah Unggulan Ashidiq
 * Main JavaScript
 */

document.addEventListener('DOMContentLoaded', () => {
    // CSRF token for AJAX
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // Image lazy loading
    if ('loading' in HTMLImageElement.prototype) {
        document.querySelectorAll('img[loading="lazy"]').forEach(img => {
            img.src = img.dataset.src;
        });
    }
});
