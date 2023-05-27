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
        <canvas id="myChart1" width="700" height="400"></canvas>
        </canvas>
    </div>

    <div class="chart-container">
        <canvas id="myChart2" width="700" height="400"></canvas>
    </div>

    <?php
    require_once('php/connection.php');
    $query = "SELECT MONTH(orders.date) AS month, COUNT(o_id) AS count FROM orders WHERE orders.date >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH) GROUP BY MONTH(orders.date) ORDER BY MONTH(orders.date) ASC";
    $result = mysqli_query($link, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        // Process the result rows
        $months = [];
        $orderCounts = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[] = date('F', mktime(0, 0, 0, $i, 1));
            $orderCounts[] = 0;
        }
        foreach ($rows as $row) {
            $monthIndex = intval($row['month']) - 1;
            $orderCounts[$monthIndex] = intval($row['count']);
        }

        // Save the PHP arrays as JSON strings
        $monthsJSON = json_encode($months);
        $orderCountsJSON = json_encode($orderCounts);
        // $deliveriesJSON = json_encode($deliveries);
        // $salesJSON = json_encode($sales);
    } else {
        echo 'No data available.';
    }

    $query2 = "SELECT MONTH(orders.date) AS month, SUM(charge) AS total_profit FROM orders NATURAL JOIN packages WHERE orders.date >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH) GROUP BY MONTH(orders.date) ORDER BY MONTH(orders.date) ASC";
    $result2 = mysqli_query($link, $query2);
    if ($result2 && mysqli_num_rows($result2) > 0) {
        $rows = mysqli_fetch_all($result2, MYSQLI_ASSOC);
        // Process the result rows
        $months = [];
        $profitData = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[] = date('F', mktime(0, 0, 0, $i, 1));
            $profitData[] = 0;
        }
        foreach ($rows as $row) {
            $monthIndex = intval($row['month']) - 1;
            $profitData[$monthIndex] = intval($row['total_profit']);
        }
        // Save the PHP arrays as JSON strings
        $monthsJSON = json_encode($months);
        $profitDataJSON = json_encode($profitData);
    } else {
        echo 'No data available.';
    }
    ?>

    <script>
        // Parse the PHP JSON strings into JavaScript arrays
        var months = JSON.parse('<?= $monthsJSON ?>');
        // var deliveries = JSON.parse('<= $deliveriesJSON ?>');
        var profitData = JSON.parse('<?= $profitDataJSON ?>');
        var orderCounts = JSON.parse('<?= $orderCountsJSON ?>');

        var ctx = document.getElementById('myChart1').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: 'Number of Orders',
                    data: orderCounts,
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
                    label: 'Profit',
                    data: profitData,
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