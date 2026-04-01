let slideIndex = 1;
let timer = null; // Holds the timer ID

showSlides(slideIndex);
autoSlide(); 


function plusSlides(n) {
  clearTimeout(timer); 
  showSlides(slideIndex += n);
  autoSlide(); 
}

function showSlides(n) {
  let slides = document.getElementsByClassName("mySlides");
  if (n > slides.length) {slideIndex = 1;}
  if (n < 1) {slideIndex = slides.length;}
  for (let i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slides[slideIndex-1].style.display = "block";
}

// Automatic function
function autoSlide() {
  timer = setTimeout(function() {
    showSlides(slideIndex += 1);
    autoSlide(); 
  }, 3000); 
}
