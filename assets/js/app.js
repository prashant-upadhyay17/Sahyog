document.addEventListener('DOMContentLoaded', () => {
    const scrollTop = document.querySelector('.scroll-top');
    if (scrollTop) {
        const toggleScroll = () => scrollTop.classList.toggle('show', window.scrollY > 420);
        toggleScroll();
        window.addEventListener('scroll', toggleScroll);
    }

    document.querySelectorAll('a[href^="#"], a[href*="index.php#"]').forEach((link) => {
        link.addEventListener('click', () => {
            const nav = document.querySelector('.navbar-collapse.show');
            if (nav && window.bootstrap) {
                bootstrap.Collapse.getOrCreateInstance(nav).hide();
            }
        });
    });
});
