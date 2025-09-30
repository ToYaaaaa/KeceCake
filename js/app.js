document.addEventListener("alpine:init", () => {
  Alpine.data("products", () => ({
    items: [],

    async init() {
      try {
        let res = await fetch("../php/System/API.php"); // path url ke index/lala.html
        let data = await res.json();
        this.items = data; // input data dari php/db kedalam array items
      } catch (err) {
        console.error("Gagal ambil data:", err);
      }
    },
    async loadProducts(cat = "all") {
      try {
        // encode untuk menghilangkan spasi bila ada
        let url = "../php/System/API.php?cat=" + encodeURIComponent(cat);
        let res = await fetch(url);
        this.items = await res.json();
      } catch (err) {
        console.error("Gagal ambil data:", err);
      }
    },
  }));
});
