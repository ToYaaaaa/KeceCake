document.addEventListener("alpine:init", () => {
  // alphine untuk data
  Alpine.data("products", () => ({
    //simpan data product
    items: [],
    //function untuk ambil data dari database
    async init() {
      try {
        // path url ke index/lala.html
        let res = await fetch("../php/System/API.php");
        let data = await res.json();
        // input data dari php/db kedalam array items
        this.items = data;
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
    //simpan data product juga di bagian cart
    items: [],
    //total harga dari semua barang yang dimasukin ke cart
    totalprice: 0,
    //jumlah barang yang dimasukin ke cart
    quantitytotal: 0,
    add(newItem) {
      //cek apakah barangnya itu sama atau gak
      let exist = this.items.find((i) => i.Product_id === newItem.Product_id);
      if (exist) {
        //qty untuk per barang
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
  //hapus scroll ke atas
  e.preventDefault();
  //formdata buat ambil data dari form
  const formData = new FormData(form);
  //urlsearchparam buat ubah dari key-value dari formdata ke query string karena di formdata itu berupa key-value
  const data = new URLSearchParams(formData);
  //fromentries biar bisa dipakai kayak object biasa
  const objdata = Object.fromEntries(data);

  //ambil transaction token
  try {
    const resp = await fetch("../php/System/Midtrans.php", {
      method: "POST",
      //isi dari objectnya
      body: data,
    });
    //text() ambil response
    const token = await resp.text();
    window.snap.pay(token, {
      onSuccess: function (result) {
        //cek sukses apa nggak
        console.log("success", result);

        // Tambahin data customer dan cart items manual
        result.customer_details = {
          first_name: objdata.name,
          email: objdata.email,
          phone: objdata.telephone,
        };

        result.item_detail = Alpine.store("cart").items.map((p) => ({
          product_id: p.Product_id,
          category: p.Product_category,
          image: p.Product_image,
          name: p.Product_name,
          price: p.Product_price,
          quantity: p.qty,
        }));

        // kirim data ke notification.php
        fetch("../php/System/notification.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          //json stringify buat ubah dari object js jadi json
          body: JSON.stringify(result),
        })
          .then((res) => res.text())
          .then((text) => {
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
      onPending: function (result) {
        console.log("pending", result);

        // tambahin data customer manual
        result.customer_details = {
          first_name: objdata.name,
          email: objdata.email,
          phone: objdata.telephone,
        };

        // tambahin data item manual
        result.item_detail = Alpine.store("cart").items.map((p) => ({
          product_id: p.Product_id,
          category: p.Product_category,
          image: p.Product_image,
          name: p.Product_name,
          price: p.Product_price,
          quantity: p.qty,
        }));

        // kirim ke backend (notification.php)
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
      },
      onClose: function (result) {
        console.log("pending", result);

        // tambahin data customer manual
        result.customer_details = {
          first_name: objdata.name,
          email: objdata.email,
          phone: objdata.telephone,
        };

        // tambahin data item manual
        result.item_detail = Alpine.store("cart").items.map((p) => ({
          product_id: p.Product_id,
          category: p.Product_category,
          image: p.Product_image,
          name: p.Product_name,
          price: p.Product_price,
          quantity: p.qty,
        }));

        // kirim ke backend (notification.php)
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
