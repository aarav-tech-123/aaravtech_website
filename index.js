const slides = document.querySelectorAll('.slide');
const leftBtn = document.querySelector('.nav-btn.left');
const rightBtn = document.querySelector('.nav-btn.right');
let current = 0;
let slidesToShow = window.innerWidth > 768 ? 2 : 1; // Default based on screen size

function showSlide(index) {
  slides.forEach((slide, i) => {
    slide.classList.remove('active');
    if (i >= index && i < index + slidesToShow) {
      slide.classList.add('active');
    }
  });
}

// Update slidesToShow on window resize
window.addEventListener("resize", () => {
  slidesToShow = window.innerWidth > 768 ? 2 : 1;
  showSlide(current);
});

leftBtn.addEventListener("click", () => {
  current = (current - 1 + slides.length) % slides.length;
  showSlide(current);
});

rightBtn.addEventListener("click", () => {
  current = (current + 1) % slides.length;
  showSlide(current);
});

// Initialize
showSlide(current+1);




const cards = document.querySelectorAll('.testimonial-card');
const prevBtn = document.querySelector('.nav-btn.left_test');
const nextBtn = document.querySelector('.nav-btn.right_test');

let current_card = 0;

function updateCards() {
  cards.forEach((card, index) => {
    card.classList.remove('active', 'prev', 'next');

    if (index === current_card) {
      card.classList.add('active');
    } else if (index === (current_card - 1 + cards.length) % cards.length) {
      card.classList.add('prev');
    } else if (index === (current_card + 1) % cards.length) {
      card.classList.add('next');
    }
  });
}

prevBtn.addEventListener('click', () => {
  current_card = (current_card - 1 + cards.length) % cards.length;
  updateCards();
});

nextBtn.addEventListener('click', () => {
  current_card = (current_card + 1) % cards.length;
  updateCards();
});

updateCards(); // initialize






