<!DOCTYPE html>
<html>
<head>
    <title>Delivery Statistics</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .chart-container {
            width: 50%;
            height: 50vh;
            margin: auto;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="chart-container">
        <canvas id="myChart1"></canvas>
    </div>

    <div class="chart-container">
        <canvas id="myChart2"></canvas>
    </div>

    <?php
        // Replace with your actual database connection and query
        $db = new PDO('mysql:host=localhost;dbname=testdb;charset=utf8', 'username', 'password');
        
        $query = $db->query('SELECT month, deliveries, sales FROM deliveries_sales ORDER BY month ASC');
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        $months = [];
        $deliveries = [];
        $sales = [];
        foreach ($result as $row) {
            $months[] = $row['month'];
            $deliveries[] = $row['deliveries'];
            $sales[] = $row['sales'];
        }

        // Save the PHP arrays as JSON strings
        $monthsJSON = json_encode($months);
        $deliveriesJSON = json_encode($deliveries);
        $salesJSON = json_encode($sales);
    ?>

    <script>
        // Parse the PHP JSON strings into JavaScript arrays
        var months = JSON.parse('<?= $monthsJSON ?>');
        var deliveries = JSON.parse('<?= $deliveriesJSON ?>');
        var sales = JSON.parse('<?= $salesJSON ?>');

        var ctx1 = document.getElementById('myChart1').getContext('2d');
        var myChart1 = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: 'Number of Deliveries',
                    data: deliveries,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var ctx2 = document.getElementById('myChart2').getContext('2d');
        var myChart2 = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: 'Sales',
                    data: sales,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
