<?php include "./includes/header.php";
include "db/dashboard.php";
?>

<body>
    <div class="container">
        <?php include "./includes/left.php" ?>
        <div class="right">
            <div class="page ">
                <h1>dashboard</h1>
                <div class="content dashboard">
                    <div id="chart" style="width:100%;height:500px;max-width:600px;margin:auto"></div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Category', 'Amount'],
                <?php
                // while ($row = mysqli_fetch_array($result)) {
                //     echo "['" . $row["gender"] . "', " . $row["number"]."],";
                // }
                foreach ($valuesarray as $key => $value) {
                    echo "['" . $key . "', " . $value . "],";
                }
                ?>
            ]);
            var options = {
                title: 'Percentage of Expenses by Category',
                //is3D:true,  
                pieHole: 1,
                sliceVisibilityThreshold: 0,
            };
            var chart = new google.visualization.PieChart(document.getElementById('chart'));
            chart.draw(data, options);
        }
    </script>
    <?php include "includes/footer.php" ?>