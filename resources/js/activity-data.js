export const activityChartData = {
    type: "bar",
    data: {
      labels: [],
      datasets: [
        {
          barPercentage: 0.5,
          barThickness: 10,
          maxBarThickness: 12,
          minBarLength: 0,
          data: [],
          backgroundColor:'rgba(181, 109,42)',
          color: 'rgba(255, 255, 255)',
          //borderColor: "#324F69",
          //borderWidth: 1
        }
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
  
  export default activityChartData;