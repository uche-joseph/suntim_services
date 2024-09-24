document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const menuToggle = document.querySelector('.menu-toggle');
    const sideNav = document.querySelector('.side-nav');
    
    menuToggle.addEventListener('click', function() {
        sideNav.classList.toggle('open');
    });

    // Close side nav when clicking outside
    document.addEventListener('click', function(event) {
        if (!sideNav.contains(event.target) && !menuToggle.contains(event.target)) {
            sideNav.classList.remove('open');
        }
    });
});