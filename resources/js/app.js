import './bootstrap';

// Türkçe: Scroll ile animasyonlu görünme için Intersection Observer
function observeAnimations() {
    const observer = new window.IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.15 });
    document.querySelectorAll('.animate-fade-in, .animate-slide-up').forEach(el => {
        observer.observe(el);
    });
}
document.addEventListener('DOMContentLoaded', observeAnimations);
// Türkçe: .animate-fade-in ve .animate-slide-up class'lı elementler scroll ile görünürken animasyonlu şekilde görünür.

// Türkçe: Anchor linklerde yumuşak kaydırma (smooth scroll)
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const target = document.querySelector(this.getAttribute('href'));
            if(target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
});
// Türkçe: Sayfa içi anchor linklere tıklandığında yumuşak kaydırma yapılır.

// Türkçe: Anlık (real-time) validasyon ve hata mesajı gösterimi
function setupRealtimeValidation() {
    document.querySelectorAll('form[data-realtime-validation] input, form[data-realtime-validation] textarea, form[data-realtime-validation] select').forEach(function(input) {
        input.addEventListener('input', function() {
            if (input.validity.valid) {
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
                if(input.nextElementSibling && input.nextElementSibling.classList.contains('form-error')) {
                    input.nextElementSibling.style.display = 'none';
                }
            } else {
                input.classList.remove('is-valid');
                input.classList.add('is-invalid');
                if(input.nextElementSibling && input.nextElementSibling.classList.contains('form-error')) {
                    input.nextElementSibling.style.display = 'block';
                }
            }
        });
    });
}
document.addEventListener('DOMContentLoaded', setupRealtimeValidation);
// Türkçe: Formlarda input değiştikçe anlık validasyon ve hata mesajı gösterimi yapılır.
