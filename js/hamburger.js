const hamburger = document.getElementById("menu");
const navlist = document.getElementById("navlist");

hamburger.addEventListener("click", function (e) {
  e.stopPropagation();
  navlist.classList.toggle("active");
});

document.addEventListener("click", (e) => {
  if (!navlist.contains(e.target) && !hamburger.contains(e.target)) {
    navlist.classList.remove("active");
  }
});
