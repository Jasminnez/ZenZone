export const reactionChartData = {
    type: "line",
    data: {
        labels:[],
        datasets: [
            {
                label:["Male"],
                fontColor: '#fff',
                data: [],
                backgroundColor: 'rgba(27, 130, 223, 1)',
                callbacks: true,

            },
            {
                label:["Female"],
                fontColor: '#fff',
                data: [],
                backgroundColor: 'rgba(181, 109,42)',
                callbacks: true,
            }
        ], 
    },
    options: {
        legend: {
            labels:{
                fontColor: '#fff'
            },
        },
        maintainAspectRatio: false,
        responsive: true,
        lineTension: 1,
        scales: {
            xAxes: [{
                ticks: {
                fontColor: "white",
                },
                gridLines: {
                    display: false
                }
            }],
            yAxes: [{
                gridLines: {
                    display: false
                },
                ticks: {
                    fontColor: "none",
                    beginAtZero: true
                },
            }]
        }
    }
};

export default reactionChartData;