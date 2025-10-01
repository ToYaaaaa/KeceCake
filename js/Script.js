//home image change
const imagehome = document.querySelector("#imagehome");
const imageabout = document.querySelector("#imageabout");
let counter = 0;

const ListImageHome = [
  "../image/klepon.png",
  "../image/serabi.png",
  "../image/nagasari.png",
  "../image/dadar-gulung.png",
  "../image/kue-ape.png",
];
const ListImageAboutus = [
  "../image/kue-lumpur.png",
  "../image/lapis-legit.png",
  "../image/onde-onde.png",
  "../image/putu-ayu.png",
  "../image/kue-lumpur.png",
];

// change image home
function ChangeImageHome() {
  counter = (counter + 1) % ListImageHome.length;
  imagehome.src = ListImageHome[counter];
}
setInterval(ChangeImageHome, 3000);

//change image about us
function ChangeImageAbout() {
  counter = (counter + 1) % ListImageAboutus.length;
  imageabout.src = ListImageAboutus[counter];
}
setInterval(ChangeImageAbout, 3000);

//cart pop up
const sidebar = document.querySelector("#cart");
const btncart = document.querySelector("#btncart");

btncart.addEventListener("click", function (e) {
  e.preventDefault();
  sidebar.classList.toggle("active");
});

document.addEventListener("click", (e) => {
  if (!sidebar.contains(e.target) && !btncart.contains(e.target)) {
    sidebar.classList.remove("active");
  }
});
