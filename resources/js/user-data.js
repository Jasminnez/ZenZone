export const userChartData = {
    type: "line",
    data: {
      labels: [],
      datasets: [
        {
          data: [],
          backgroundColor:'rgba(27, 130, 223, 1)',
        },
        // {
        //     data: [],
        //     backgroundColor:'rgba(27, 130, 223, 1)',
        //   }
      ]
    },
    options: {
            plugins: {
                legend: {
                    display: false,
                }
            },
            legend: {
                display: false,
             },
             tooltips: {
                enabled: true,
             },
      responsive: true,
      maintainAspectRatio: false,
      lineTension: 1,
      scales: {
        xAxes: [{
          ticks: {
            fontColor: 'rgba(0, 0, 0, 0.005)',
            },
            gridLines: {
                display:false
            }
        }],
        yAxes: [{
            gridLines: {
                display:false
            },
            ticks: {
                fontColor: 'rgba(0, 0, 0, 0.005)',
                beginAtZero: true
            },   
        }]
      }
    }
  };
  
  export default userChartData;