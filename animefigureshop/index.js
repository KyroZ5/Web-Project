var options = document.querySelectorAll(".option");

options.forEach(function (option) {
  option.addEventListener("click", function () {
    options.forEach(function (o) {
      o.classList.remove("active");
    });
    option.classList.add("active");

    document.getElementById("loginDiv").style.display = "none";
    document.getElementById("signupDiv").style.display = "none";

    if (option.dataset.method === "login") {
      document.getElementById("loginDiv").style.display = "block";
    } else {
      document.getElementById("signupDiv").style.display = "block";
    }
  });
});

var params = new URLSearchParams(window.location.search);
var tab = params.get("tab");

if (tab === "signup") {
  document.getElementById("signupDiv").style.display = "block";
  document.getElementById("loginDiv").style.display = "none";
  document.querySelector('[data-method="signup"]').classList.add("active");
  document.querySelector('[data-method="login"]').classList.remove("active");
} else {
  document.getElementById("loginDiv").style.display = "block";
  document.getElementById("signupDiv").style.display = "none";
  document.querySelector('[data-method="login"]').classList.add("active");
  document.querySelector('[data-method="signup"]').classList.remove("active");
}
