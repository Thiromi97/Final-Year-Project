var salesCtx = document.getElementById('barchart').getContext('2d');
var salesChart = new Chart(salesCtx, {
  type: 'line',
  data: {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
    datasets: [{
      label: 'Monthly Sales',
      data: [1000, 2000, 3000, 2500, 4000, 3500],
      backgroundColor: 'rgba(0, 0, 0, 0)',
      borderColor: 'blue'
    }]
  },
  options: {
    // responsive: true,
    // maintainAspectRatio: false,
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }]
    }
  }
});