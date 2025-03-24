let currentTestimonial = 0;
const testimonials = document.querySelectorAll('.testimonial-item');
const dots = document.querySelectorAll('.dot');

function showTestimonial(index) {
    testimonials[currentTestimonial].classList.add('hidden');
    dots[currentTestimonial].classList.remove('bg-gray-900');
    dots[currentTestimonial].classList.add('bg-gray-300');

    currentTestimonial = index;

    testimonials[currentTestimonial].classList.remove('hidden');
    dots[currentTestimonial].classList.remove('bg-gray-300');
    dots[currentTestimonial].classList.add('bg-gray-900');
}

function autoSlide() {
    let nextTestimonial = (currentTestimonial + 1) % testimonials.length;
    showTestimonial(nextTestimonial);
}

// Initialize first testimonial
showTestimonial(0);
setInterval(autoSlide, 5000); // Change every 5 seconds