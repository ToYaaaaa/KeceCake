document.addEventListener("alpine:init", () => {
  Alpine.data("products", () => ({
    items: [],

    async init() {
      try {
        let res = await fetch("../php/System/API.php"); // path relatif dari index/lala.html
        let data = await res.json();
        this.items = data; // masuk ke array Alpine
        console.log($data); // cek isi data
      } catch (err) {
        console.error("Gagal ambil data:", err);
      }
    },
    async loadProducts(cat = "all") {
      try {
        let url = "../php/System/API.php?cat=" + encodeURIComponent(cat);
        let res = await fetch(url);
        this.items = await res.json();
      } catch (err) {
        console.error("Gagal ambil data:", err);
      }
    },
  }));
});
