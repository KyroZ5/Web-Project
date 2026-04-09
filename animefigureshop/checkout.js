"use strict";

const options = document.querySelectorAll(".option");
const logisticsInput = document.getElementById("logisticsMethod");

options.forEach((option) => {
  option.addEventListener("click", () => {
    options.forEach((o) => o.classList.remove("active"));
    option.classList.add("active");

    document.getElementById("shipDiv").style.display = "none";
    document.getElementById("pickupDiv").style.display = "none";

    if (option.dataset.method === "Delivery") {
      logisticsInput.value = "Delivery";
      document.getElementById("shipDiv").style.display = "block";

      document.querySelectorAll("#shipDiv [required]").forEach((field) => {
        field.required = true;
      });
    } else if (option.dataset.method === "Pickup") {
      logisticsInput.value = "Pickup";
      document.getElementById("pickupDiv").style.display = "block";

      document.querySelectorAll("#shipDiv [required]").forEach((field) => {
        field.required = false;
      });
    }
  });
});

const radios = document.querySelectorAll('#shipDiv input[name="payment"], #pickupDiv input[name="payment"]');

radios.forEach((radio) => {
  radio.addEventListener("change", () => {
    const parentSection = radio.closest(".methodDiv");
    if (parentSection) {
      parentSection.querySelectorAll(".expandable").forEach((exp) => {
        exp.style.display = "none";
      });
    }

    const wrapper = radio.closest(".radio-option");
    if (wrapper) {
      const expandable = wrapper.querySelector(".expandable");
      if (expandable) {
        expandable.style.display = "block";
      }
    }
  });
});

["shipDiv", "pickupDiv"].forEach((sectionId) => {
  const checkedRadio = document.querySelector(`#${sectionId} input[name="payment"]:checked`);
  if (checkedRadio) {
    const wrapper = checkedRadio.closest(".radio-option");
    if (wrapper) {
      const expandable = wrapper.querySelector(".expandable");
      if (expandable) {
        expandable.style.display = "block";
      }
    }
  }
});

const popup = document.getElementById("popup");
const okBtn = document.getElementById("okBtn");

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

okBtn.addEventListener("click", () => {
  window.location.href = "home.php";
});

function NumberSpinner(spinnerElem) {
  const spinnerInput = spinnerElem.querySelector(".spinner__input");
  const btnSubtract = spinnerElem.querySelector(".js-spinner-horizontal-subtract");
  const btnAdd = spinnerElem.querySelector(".js-spinner-horizontal-add");

  const minLimit = parseInt(spinnerInput.getAttribute("min"), 10) || 0;
  const maxLimit = parseInt(spinnerInput.getAttribute("max"), 10) || Infinity;
  const step = parseInt(spinnerInput.getAttribute("step"), 10) || 1;

  function update(direction) {
    let num = parseInt(spinnerInput.value, 10) || 0;
    if (direction === "add") {
      spinnerInput.value = Math.min(num + step, maxLimit);
    } else if (direction === "subtract") {
      spinnerInput.value = Math.max(num - step, minLimit);
    }
    const hiddenQty = document.getElementById("hiddenQty");
    if (hiddenQty) hiddenQty.value = spinnerInput.value;
  }

  function changeSpinner(e) {
    e.preventDefault();
    update(e.target.getAttribute("data-type"));
  }

  function keySpinner(e) {
    if ([37, 40].includes(e.keyCode)) update("subtract");
    if ([38, 39].includes(e.keyCode)) update("add");
  }

  btnSubtract.addEventListener("click", changeSpinner);
  btnAdd.addEventListener("click", changeSpinner);
  spinnerInput.addEventListener("keyup", keySpinner);
}

document.querySelectorAll(".spinner").forEach(NumberSpinner);

document.getElementById("checkoutForm").addEventListener("submit", () => {
  const activeOption = document.querySelector(".option.active");
  if (activeOption) logisticsInput.value = activeOption.dataset.method;
});
