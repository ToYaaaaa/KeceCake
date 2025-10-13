//grafik penjualan kue harian
const bulanSekarang = new Date().getMonth() + 1;
const tahunSekarang = new Date().getFullYear();

//grafik penjualan kue bulanan
fetch(
  `../php/System/chart/cake/chart-cake-bulanan.php?bulan=${bulanSekarang}&tahun=${tahunSekarang}`
)
  .then((res) => res.json())
  .then((data) => {
    const labels = data.map((item) => item.Product_name);
    const total = data.map((item) => item.total_terjual);

    new Chart(document.getElementById("graphiccakebulanan"), {
      type: "bar",
      data: {
        labels: labels,
        datasets: [
          {
            label: "Jumlah Terjual",
            data: total,
            backgroundColor: [
              "rgba(255, 99, 132, 0.5)",
              "rgba(255, 159, 64, 0.5)",
              "rgba(255, 205, 86, 0.5)",
              "rgba(75, 192, 192, 0.5)",
              "rgba(54, 162, 235, 0.5)",
              "rgba(153, 102, 255, 0.5)",
              "rgba(38, 50, 56, 0.5)",
              "rgba(189, 74, 38, 0.5)",
              "rgba(207, 92, 29, 0.5)",
              "rgba(151, 92, 46, 0.5)",
              "rgba(79, 95, 80, 0.5)",
              "rgba(15, 107, 116, 0.5)",
              "rgba(153, 160, 60, 0.5)",
              "rgba(79, 90, 153, 0.5)",
              "rgba(235, 69, 57, 0.5)",
            ],
            borderColor: "rgba(255, 99, 132, 1)",
            borderWidth: 1,
          },
        ],
      },
      options: {
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              precision: 0,
            },
            title: {
              display: true,
              text: "Jumlah Kue Terjual",
            },
          },
          x: {
            title: {
              display: true,
              text: "Nama Kue",
            },
          },
        },
        plugins: {
          title: {
            display: true,
            text: `Grafik Penjualan Kue Bulan ${bulanSekarang}`,
            font: { size: 16 },
          },
          legend: { display: false },
        },
      },
    });
  })
  .catch((err) => console.error("Error:", err));
