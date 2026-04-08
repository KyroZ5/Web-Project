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


var orderLink = document.getElementById("tocart");

orderLink.addEventListener("click", function (e) {
  var qty = document.getElementById("quantity").value;
  var baseHref = orderLink.getAttribute("href");
  orderLink.setAttribute("href", baseHref + "&quantity=" + encodeURIComponent(qty));
});

var popup = document.getElementById("popup");
var okBtn = document.getElementById("okBtn");

if (window.location.search.includes("cart_status=success")) {
  popup.querySelector(".popup-text").textContent = "Added to Cart";
  popup.style.display = "flex";
} else if (window.location.search.includes("cart_status=updated")) {
  popup.querySelector(".popup-text").textContent = "Quantity Updated";
  popup.style.display = "flex";
}

okBtn.addEventListener("click", function () {
  popup.style.display = "none";
});

