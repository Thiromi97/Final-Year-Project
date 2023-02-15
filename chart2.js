var invoiceCtx = document.getElementById('piechart').getContext('2d');
var invoiceChart = new Chart(invoiceCtx, {
  type: 'pie',
  data: {
    labels: ['Paid', 'Unpaid'],
    datasets: [{
      data: [75, 25],
      backgroundColor: ['blue', 'lightblue']
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false
  }
});