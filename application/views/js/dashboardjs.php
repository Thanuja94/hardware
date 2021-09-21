<!-- jQuery Mapael -->
<script src="<?php echo base_url()?>plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="<?php echo base_url()?>plugins/raphael/raphael.min.js"></script>
<script src="<?php echo base_url()?>plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="<?php echo base_url()?>plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url()?>plugins/chart.js/Chart.min.js"></script>
<!-- PAGE SCRIPTS -->
<!-- <script src="<?php echo base_url()?>dist/js/pages/dashboard2.js"></script> -->
 
<script src="<?php echo base_url()?>dist/js/pages/dashboard3.js"></script>

<script>

    // The Calender
    $('#calendar').datetimepicker({
        format: 'L',
        inline: true
    })

    // var pieChartCanvas = $('#supplierChart').get(0).getContext('2d');
    // designPieChart(pieChartCanvas);
    var $salesChart = $('#salesAnalysisChart')
    salesAnalysisChart($salesChart);
    var salesChartCanvas = document.getElementById('inventoryStockAnalysisChart').getContext('2d');
    inventoryStockAnalysisChart(salesChartCanvas);
    $salesChart = $('#frequentlyPurchasedItemsChart')
    frequentlyPurchasedItemsChart($salesChart);
 
 
    function designPieChart(pieChartCanvas) {
 
        var pieData = {
            labels: [
                'Chrome',
                'IE',
                'FireFox',
                'Safari',
                'Opera',
                'Navigator',
            ],
            datasets: [{
                data: [15, 55, 10],
                backgroundColor: ['#f56954', '#00a65a'],
            }]
        }
        var pieOptions = {
            legend: {
                display: false
            }
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        var pieChart = new Chart(pieChartCanvas, {
            type: 'doughnut',
            data: pieData,
            options: pieOptions
        })
 
    }
 
    function salesAnalysisChart(salesAnalysisChart) {
 
        var ticksStyle = {
            fontColor: '#495057',
            fontStyle: 'bold'
        }
 
        var mode = 'index'
        var intersect = true
 
        var salesChart = new Chart($salesChart, {
            type: 'bar',
            data: {
                labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN'],
                datasets: [{
                    backgroundColor: '#007bff',
                    borderColor: '#007bff',
                    data: <?php echo json_encode($total_sales)?>
                }
                ]
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    mode: mode,
                    intersect: intersect
                },
                hover: {
                    mode: mode,
                    intersect: intersect
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        // display: false,
                        gridLines: {
                            display: true,
                            lineWidth: '4px',
                            color: 'rgba(0, 0, 0, .2)',
                            zeroLineColor: 'transparent'
                        },
                        ticks: $.extend({
                            beginAtZero: true,
 
                            // Include a dollar sign in the ticks
                            callback: function (value, index, values) {
                                if (value >= 1000) {
                                    value /= 1000
                                    value += 'k'
                                }
                                return value
                            }
                        }, ticksStyle)
                    }],
                    xAxes: [{
                        display: true,
                        gridLines: {
                            display: false
                        },
                        ticks: ticksStyle
                    }]
                }
            }
        })
    }
 
 
    function inventoryStockAnalysisChart(salesChartCanvas) {
        var salesChartData = {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [
                {
                    label: 'Digital Goods',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: [28, 48, 40, 19, 86, 27, 90]
                },
                {
                    label: 'Electronics',
                    backgroundColor: 'rgba(210, 214, 222, 1)',
                    borderColor: 'rgba(210, 214, 222, 1)',
                    pointRadius: false,
                    pointColor: 'rgba(210, 214, 222, 1)',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data: [65, 59, 80, 81, 56, 55, 40]
                },
            ]
        }
 
        var salesChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: false
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false,
                    }
                }],
                yAxes: [{
                    gridLines: {
                        display: false,
                    }
                }]
            }
        }
 
        // This will get the first returned node in the jQuery collection.
        var salesChart = new Chart(salesChartCanvas, {
            type: 'line',
            data: salesChartData,
            options: salesChartOptions
        }
        )
    }
 
 
    function frequentlyPurchasedItemsChart(salesAnalysisChart) {

        var ticksStyle = {
            fontColor: '#495057',
            fontStyle: 'bold'
        }
 
        var mode = 'index'
        var intersect = true
 
        var salesChart = new Chart($salesChart, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($item_sales["names"])?>,
                datasets: [{
                    // backgroundColor: ['#007bff', '#f56954', '#00a65a'],
                    backgroundColor: "#f56954",
                    borderColor: '#007bff',
                    data: <?php echo json_encode($item_sales["values"])?>
                }
                ]
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    mode: mode,
                    intersect: intersect
                },
                hover: {
                    mode: mode,
                    intersect: intersect
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        // display: false,
                        gridLines: {
                            display: true,
                            lineWidth: '4px',
                            color: 'rgba(0, 0, 0, .2)',
                            zeroLineColor: 'transparent'
                        },
                        ticks: $.extend({
                            beginAtZero: true,
 
                            // Include a dollar sign in the ticks
                            callback: function (value, index, values) {
                                if (value >= 1000) {
                                    value /= 1000
                                    value += 'k'
                                }
                                return value
                            }
                        }, ticksStyle)
                    }],
                    xAxes: [{
                        display: true,
                        gridLines: {
                            display: false
                        },
                        ticks: ticksStyle
                    }]
                }
            }
        })
    }
 
    $.noConflict();
</script>
