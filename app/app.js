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
    delete(p) {
      this.items = this.items.filter((i) => i.Product_id !== p.Product_id);
      this.quantitytotal -= p.qty;
      this.totalprice -= p.qty * p.Product_price;
    },
  });
});

// kirim data ketika tombol checkout di klik
const checkoutButton = document.querySelector("#button");
const form = document.querySelector("#form");
checkoutButton.addEventListener("click", async function (e) {
  e.preventDefault();
  const formData = new FormData(form);
  const data = new URLSearchParams(formData);
  const objdata = Object.fromEntries(data);

  //ambil transaction token
  try {
    const resp = await fetch("../php/System/Midtrans.php", {
      method: "POST",
      body: data,
    });
    const token = await resp.text();
    window.snap.pay(token, {
      onSuccess: function (result) {
        console.log("success", result);

        // Tambahin data customer & cart items manual
        result.customer_details = {
          first_name: objdata.name,
          email: objdata.email,
          phone: objdata.telephone,
        };

        result.item_detail = Alpine.store("cart").items.map((p) => ({
          product_id: p.Product_id,
          name: p.Product_name,
          price: p.Product_price,
          quantity: p.qty,
        }));

        // kirim data ke notification.php
        fetch("../php/System/notification.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify(result),
        })
          .then((res) => res.text())
          .then((text) => {
            console.log("Raw response:", text);
            try {
              let json = JSON.parse(text);
              console.log("Parsed JSON:", json);
            } catch (e) {
              console.error("Invalid JSON", e);
            }
          });

        // reset cart setelah berhasil
        Alpine.store("cart").items = [];
        Alpine.store("cart").quantitytotal = 0;
        Alpine.store("cart").totalprice = 0;
      },
    });
  } catch (err) {
    console.log(err.message);
  }
});

//konversi ke rupiah untuk harga
const rupiah = (number) => {
  return new Intl.NumberFormat("id-ID", {
    style: "currency",
    currency: "IDR",
    minimumFractionDigits: 0,
  }).format(number);
};
