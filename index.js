const slides = document.querySelectorAll('.slide');
const leftBtn = document.querySelector('.nav-btn.left');
const rightBtn = document.querySelector('.nav-btn.right');
let current = 0;

function showSlide(index) {
  slides.forEach((slide, i) => {
    slide.classList.remove('active');
    if (i === index || i === (index + 1) % slides.length) {
      slide.classList.add('active');
    }
  });
}

leftBtn.addEventListener('click', () => {
  current = (current - 1 + slides.length) % slides.length;
  showSlide(current);
});

rightBtn.addEventListener('click', () => {
  current = (current + 1) % slides.length;
  showSlide(current);
});

showSlide(current);


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


function sortArray(array) {
  if (array.length < 2) {
    console.log('Array dont have enough element')
  }
  let pivot = array[0];
  let left = [];
  let right = [];

  for (let i = 1; i < array.length - 1; i++) {
    if (array[i] > pivot) {
      left.push(array[i]);
    } else {
      right.push(array[i]);
    }

    // return [...sortArray(left), pivot, ...sortArray(right)];
  }
  return pivot
}

let array = [9, 0, 12, 15, 5];

const sortedArray = sortArray(array);
// console.log(sortedArray);


function binarySearch(array, target) {
  if(array.length<2){
    return false
  }
  let mid = Math.floor(array.length/2)
  left = array.slice(0, mid)
  right = array.slice(mid)
  if(target===array[mid]){
    return mid
  } 
  if(target>array[mid]){
    binarySearch(right, target)
  }else{
    binarySearch(left, target)
  }

}

let nums = [1, 2, 3, 4, 5]
// console.log(binarySearch(nums, 5));


