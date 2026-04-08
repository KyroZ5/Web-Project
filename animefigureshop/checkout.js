'use strict';
var options = document.querySelectorAll(".option");

options.forEach(function (option) {
  option.addEventListener("click", function () {
    options.forEach(function (o) {
      o.classList.remove("active");
    });
    option.classList.add("active");
    document.getElementById("shipDiv").style.display = "none";
    document.getElementById("pickupDiv").style.display = "none";

    if (option.dataset.method === "ship") {
      document.getElementById("shipDiv").style.display = "block";
      document.getElementById("logisticsMethod").value = "ship";

      document.querySelectorAll('#shipDiv input[name="payment"]').forEach(function (radio) {
        radio.disabled = false;
      });

    } else {
      document.getElementById("pickupDiv").style.display = "block";
      document.getElementById("logisticsMethod").value = "pickup";

      var cashRadio = document.querySelector('#pickupDiv input[value="bank"]'); 
      if (cashRadio) {
        cashRadio.checked = true;
      }

      document.querySelectorAll('#pickupDiv input[name="payment"]').forEach(function (radio) {
        if (radio.value !== "bank") {
          radio.disabled = true;
        }
      });
    }
  });
});

// Payment expandable toggle
var radios = document.querySelectorAll('input[name="payment"]');
radios.forEach(function (radio) {
  radio.addEventListener("change", function () {
    document.querySelectorAll(".expandable").forEach(function (exp) {
      exp.style.display = "none";
    });

    var expandable = radio.closest(".radio-option").querySelector(".expandable");
    expandable.style.display = "block";
  });
});
document
  .querySelector('input[name="payment"]:checked')
  .closest(".radio-option")
  .querySelector(".expandable").style.display = "block";

// Pop-up
var popup = document.getElementById("popup");
var okBtn = document.getElementById("okBtn");

if (window.location.search.includes("order_status=success")) {
  popup.querySelector(".popup-text").textContent = "Order Placed Successfully";
  popup.style.display = "flex";
} else if (window.location.search.includes("order_status=failed")) {
  popup.querySelector(".popup-text").textContent = "Order Failed";
  popup.style.display = "flex";
} else if (window.location.search.includes("order_status=cancelled")) {
  popup.querySelector(".popup-text").textContent = "Order Cancelled";
  popup.style.display = "flex";
}

okBtn.addEventListener("click", function () {
  popup.style.display = "none";
});

// Amount spinner
function NumberSpinner(spinnerElem) {
  const spinnerInput = spinnerElem.querySelector('.spinner__input');
  const btnSubtract = spinnerElem.querySelector('.js-spinner-horizontal-subtract');
  const btnAdd = spinnerElem.querySelector('.js-spinner-horizontal-add');

  const minLimit = parseInt(spinnerInput.getAttribute('min'), 10) || 0;
  const maxLimit = parseInt(spinnerInput.getAttribute('max'), 10) || Infinity;
  const step = parseInt(spinnerInput.getAttribute('step'), 10) || 1;

  function update(direction) {
    let num = parseInt(spinnerInput.value, 10) || 0;
    if (direction === 'add') {
      spinnerInput.value = Math.min(num + step, maxLimit);
    } else if (direction === 'subtract') {
      spinnerInput.value = Math.max(num - step, minLimit);
    }
    // Sync hidden input inside form
    const hiddenQty = document.getElementById('hiddenQty');
    if (hiddenQty) hiddenQty.value = spinnerInput.value;
  }

  function changeSpinner(e) {
    e.preventDefault();
    const type = e.target.getAttribute('data-type');
    update(type);
  }

  function keySpinner(e) {
    switch (e.keyCode) {
      case 40: // down
      case 37: // left
        update('subtract');
        break;
      case 38: // up
      case 39: // right
        update('add');
        break;
    }
  }

  btnSubtract.addEventListener('click', changeSpinner);
  btnAdd.addEventListener('click', changeSpinner);
  spinnerInput.addEventListener('keyup', keySpinner);
}

// Initialize all spinners
document.querySelectorAll('.spinner').forEach(spinnerElem => {
  NumberSpinner(spinnerElem);
});