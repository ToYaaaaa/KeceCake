//home image change
const imagehome = document.querySelector("#imagehome");
let counter = 0;

const ListImageHome = [
  "../image/Home1.png",
  "../image/Home2.png",
  "../image/Home3.png",
  "../image/Home4.png",
  "../image/Home5.png",
];
const ListImageAboutus = [
  "About1.png",
  "About2.png",
  "About3.png",
  "About4.png",
  "About5.png",
];

function ChangeImageHome() {
  counter = (counter + 1) % ListImageHome.length;
  imagehome.src = ListImageHome[counter];
}

setInterval(ChangeImageHome, 3000);
