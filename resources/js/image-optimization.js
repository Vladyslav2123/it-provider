/**
 * Оптимізація зображень
 */
document.addEventListener('DOMContentLoaded', function() {
    // Lazy loading для зображень
    const lazyImages = document.querySelectorAll('img[loading="lazy"]');
    
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src || img.src;
                    img.classList.add('loaded');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        lazyImages.forEach(function(img) {
            imageObserver.observe(img);
        });
    } else {
        // Fallback для браузерів, які не підтримують IntersectionObserver
        lazyImages.forEach(function(img) {
            img.src = img.dataset.src || img.src;
        });
    }
    
    // Адаптивні фонові зображення
    function updateBackgroundImages() {
        const width = window.innerWidth;
        const backgroundElements = document.querySelectorAll('[data-bg]');
        
        backgroundElements.forEach(function(element) {
            let bgImage = element.dataset.bgDesktop;
            
            if (width <= 640 && element.dataset.bgMobile) {
                bgImage = element.dataset.bgMobile;
            } else if (width <= 1024 && element.dataset.bgTablet) {
                bgImage = element.dataset.bgTablet;
            }
            
            if (bgImage) {
                element.style.backgroundImage = `url(${bgImage})`;
            }
        });
    }
    
    // Оновлюємо фонові зображення при завантаженні та зміні розміру вікна
    updateBackgroundImages();
    window.addEventListener('resize', updateBackgroundImages);
});
