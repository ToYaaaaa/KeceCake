//order grafik harian
fetch("../php/System/chart/orders/harian/chart-order-harian.php")
  .then((res) => res.json())
  .then((dataharian) => {
    const tanggal = dataharian.map((item) => item.tanggal);
    const total = dataharian.map((item) => item.total_penjualan);

    new Chart(document.getElementById("graphicorderharian"), {
      type: "line",
      data: {
        labels: tanggal,
        datasets: [
          {
            label: "Chart penjualan Perhari",
            data: total,
            fill: true,
            tension: 0.3,
            borderWidth: 2,
            borderColor: "rgba(255, 99, 132, 1)",
            backgroundColor: "rgba(255, 99, 132, 0.2)",
          },
        ],
      },
      options: {
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              callback: function (value) {
                return "Rp " + value.toLocaleString("id-ID");
              },
            },
          },
        },
        plugins: {
          title: {
            display: true,
            text: "Grafik Penjualan per Hari",
          },
          legend: {
            display: true,
          },
        },
      },
    });
  })
  .catch((err) => console.error("Error:", err));

//order grafik bulanan
fetch("../php/System/chart/orders/bulanan/chart-order-bulanan.php")
  .then((res) => res.json())
  .then((databulanan) => {
    const bulan = databulanan.map((item) => item.bulan);
    const total = databulanan.map((item) => item.total_penjualan);

    new Chart(document.getElementById("graphicorderbulanan"), {
      type: "line",
      data: {
        labels: bulan,
        datasets: [
          {
            label: "Chart penjualan perbulan",
            data: total,
            fill: true,
            tension: 0.3,
            borderWidth: 2,
            borderColor: "rgba(255, 99, 132, 1)",
            backgroundColor: "rgba(255, 99, 132, 0.2)",
          },
        ],
      },
      options: {
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              callback: function (value) {
                return "Rp " + value.toLocaleString("id-ID");
              },
            },
          },
        },
        plugins: {
          title: {
            display: true,
            text: "Grafik Penjualan perbulan",
          },
          legend: {
            display: true,
          },
        },
      },
    });
  })
  .catch((err) => console.error("Error:", err));
