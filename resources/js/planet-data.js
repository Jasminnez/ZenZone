export const planetChartData = {
    type: "line",
    data: {
      labels: ["1", "2"],//, "Utorak", "Srijeda", "Cetvrtak", "Petak", "Subota", "Nedelja"],
      datasets: [
        {
          label: "Reactions",
          data: [],
          backgroundColor: "rgba(54,73,93,.5)",
          borderColor: "#36495d",
          borderWidth: 3
        },
        {
          label: "Planetary Mass (relative to the Sun x 10^-6)",
          data: [],//, 2.081, 3.003, 0.323, 954.792, 285.886, 43.662],
          backgroundColor: "rgba(71, 183,132,.5)",
          borderColor: "#47b784",
          borderWidth: 3
        }
      ]
    },
    options: {
      responsive: true,
      lineTension: 1,
      scales: {
        yAxes: [
          {
            ticks: {
              beginAtZero: true,
              padding: 25
            }
          }
        ]
      }
    }
  };
  
  export default planetChartData;