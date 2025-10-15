fetch("../php/System/reportsale.php")
  .then((res) => res.json())
  .then((data) => {
    document.getElementById("pendapatanBulanan").textContent = data.bulanan;
    document.getElementById("pendapatanHarian").textContent = data.harian;
  })
  .catch((err) => console.error("Error:", err));
