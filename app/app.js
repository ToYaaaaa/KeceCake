document.addEventListener("alpine:init", () => {
  // alphine untuk data
  Alpine.data("products", () => ({
    items: [],
    //function untuk ambil data dari database
    async init() {
      try {
        let res = await fetch("../php/System/API.php"); // path url ke index/lala.html
        let data = await res.json();
        this.items = data; // input data dari php/db kedalam array items
      } catch (err) {
        console.error("Gagal ambil data:", err);
      }
    },
    //function untuk search category
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
  //alphine untuk cart
  Alpine.store("cart", {
    items: [],
    totalprice: 0,
    quantitytotal: 0,
    add(newItem) {
      //cek apakah barangnya itu sama atau gak
      let exist = this.items.find((i) => i.Product_id === newItem.Product_id);

      if (exist) {
        exist.qty++;
      } else {
        this.items.push({ ...newItem, qty: 1 });
      }

      this.quantitytotal++;
      this.totalprice += newItem.Product_price;
      console.log(this.items);
    },
    min(p) {
      if (p.qty > 1) {
        p.qty--;
        this.quantitytotal--;
        this.totalprice -= p.Product_price;
      } else {
        // kalau sisa 1 hapus dari cart
        this.items = this.items.filter((i) => i.Product_id !== p.Product_id);
        this.quantitytotal--;
        this.totalprice -= p.Product_price;
      }
    },
  });
});

//konversi ke rupiah untuk harga

const rupiah = (number) => {
  return new Intl.NumberFormat("id-ID", {
    style: "currency",
    currency: "IDR",
    minimumFractionDigits: 0,
  }).format(number);
};
