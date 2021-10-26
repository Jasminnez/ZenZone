export const genderChartData = {
    type: "doughnut",
    data: {
      labels: [],
      datasets: [
        {
          data: [],
          weight: 2,
          backgroundColor:['rgba(27, 130, 223, 1)', 'rgba(181, 109,42)'],
          borderColor: "#324F69",
          borderWidth: 1
        }
      ]
    },
    options: {
      responsive: true,
      legend: {
        display: false
     },
     tooltips: {
        enabled: false
     },
      //lineTension: 1,
      // scales: {
      //   yAxes: [
      //     {
      //       ticks: {
      //         beginAtZero: true,
      //         padding: 30
      //       }
      //     }
      //   ]
      // }
    }
  };
  
  export default genderChartData;