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

    
    const faqItems = document.querySelectorAll('.faq-item');
    
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        question.addEventListener('click', () => {
            item.classList.toggle('active');
        });
    }); 
    
    // Testimonial slider
    const testimonials = document.querySelectorAll(".testimonial");
    const nextButton = document.querySelector(".slider-button.next");
    const prevButton = document.querySelector(".slider-button.prev");
    let currentIndex = 0;

    // Hide all testimonials except the first one
    function showTestimonial(index) {
        testimonials.forEach((testimonial, i) => {
            testimonial.style.display = i === index ? "block" : "none";
        });
    }

    // Show the first testimonial initially
    showTestimonial(currentIndex);

    // Event listener for the next button
    nextButton.addEventListener("click", function() {
        currentIndex = (currentIndex + 1) % testimonials.length;
        showTestimonial(currentIndex);
    });

    // Event listener for the previous button
    prevButton.addEventListener("click", function() {
        currentIndex = (currentIndex - 1 + testimonials.length) % testimonials.length;
        showTestimonial(currentIndex);
    });

    
    const achievementNumbers = document.querySelectorAll('.achievement-number');
    
    function animateNumber(element) {
        const target = parseInt(element.getAttribute('data-target'));
        const duration = 2000; // Animation duration in milliseconds
        const step = target / (duration / 16); // 60 FPS
        let current = 0;

        const timer = setInterval(() => {
            current += step;
            element.textContent = Math.round(current);

            if (current >= target) {
                element.textContent = target;
                clearInterval(timer);
            }
        }, 16);
    }

    // Intersection Observer for achievements section
    const achievementsSection = document.querySelector('.achievements');
    const observer = new IntersectionObserver((entries) => {
        if (entries[0].isIntersecting) {
            achievementNumbers.forEach(animateNumber);
            observer.unobserve(achievementsSection);
        }
    }, { threshold: 0.5 });

    observer.observe(achievementsSection);
}); 

// Intersection Observer for animations
const animatedElements = document.querySelectorAll('.animate-fade-in-up');

const animationObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('animated');
            animationObserver.unobserve(entry.target);
        }
    });
}, { threshold: 0.1 });

animatedElements.forEach(el => animationObserver.observe(el));

// Cookie Consent
const cookieConsent = document.getElementById('cookie-consent');
const acceptCookies = document.getElementById('accept-cookies');

if (!localStorage.getItem('cookiesAccepted')) {
    setTimeout(() => {
        cookieConsent.classList.add('show');
    }, 1000);
}

acceptCookies.addEventListener('click', () => {
    localStorage.setItem('cookiesAccepted', 'true');
    cookieConsent.classList.remove('show');
});