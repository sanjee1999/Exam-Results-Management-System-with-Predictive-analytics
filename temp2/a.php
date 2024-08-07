<?php
// Start PHP block to handle data fetching and output
header('Content-Type: text/html; charset=UTF-8');

// Database connection
session_start();
require_once '../connection/conf.php';
require_once '../function/fun.php';
// Query to fetch data with JOIN
$sql = "
    SELECT * FROM `ica_1` WHERE 1
    
";
$result = $conn->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Close connection
$conn->close();

// Encode data in JSON format for use in JavaScript
// $data_json = json_encode($data);

$labels = [];
$values = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $labels[] = $row['reg_no'];
        $values[] = $row['marks'];
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="myChart" width="400" height="200"></canvas>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar', // Change this to 'line', 'pie', etc. for different chart types
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'My Dataset',
                    data: <?php echo json_encode($values); ?>,
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
    </script>
</body>
</html>