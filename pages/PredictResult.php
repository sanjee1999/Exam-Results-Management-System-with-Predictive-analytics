<?php
// Start PHP block to handle data fetching and output
//header('Content-Type: text/html; charset=UTF-8');

// Database connection
//session_start();
require_once '../connection/conf.php';
require_once '../function/fun.php';
// Query to fetch data with JOIN
$sql = "
    SELECT * FROM `ica_1` WHERE 1
    
";
$result = $conn->query($sql);

// $data = [];
// while ($row = $result->fetch_row()) {
//     $data[] = $row[0];
// }

// Close connection


// Encode data in JSON format for use in JavaScript
// $data_json = json_encode($data);

$labels = [];
$values = [];


while($row = $result->fetch_assoc()) {
    $labels[] = $row['reg_no'];
    $values[] = $row['marks'];
}

print_r($values) ;
print_r($labels) ;
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Slider</title>
    <!-- get icons -->
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />

    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="../Dashboard/Sider.css" />
    <link rel="stylesheet" href="../Style/PredictResult.css" />

    <!-- get bootstrap -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
  </head>
  <body>
    
          <div class="title text-center">
            <h3>- Predict Final Result -</h3>
          </div>

          <div class="input-section py-5 mb-5">
            <div class="form d-flex justify-content-center align-items-center">
              <form action="#" method="post" class="row">
                <div class="form-group col-md-3" id="subject">
                  <select name="subject" id="subject" class="form-control">
                    <option value="" selected disabled>Select Subject</option>
                    <option value="Subject-01">Subject 01</option>
                    <option value="Subject-02">Subject 02</option>
                    <option value="Subject-03">Subject 03</option>
                    <option value="Subject-04">Subject 04</option>
                  </select>
                </div>

                <div class="form-group col-md-3" id="year">
                  <select name="Year" id="year" class="form-control">
                    <option value="" selected disabled>Select Year</option>
                    <option value="2019/2020">1st Year</option>
                    <option value="2020/2021">2nd Year</option>
                    <option value="2021/2022">3rd Year</option>
                    <option value="2022/2023">4th Year</option>
                  </select>
                </div>

                <div class="form-group col-md-3">
                  <button class="btn btn-primary w-100">Predict</button>
                </div>
              </form>
            </div>
          </div>
          <div class="title text-center">
            <h3>- Predicted Result of CSC2113 -</h3>
          </div>

          <div class="chart" >
            <canvas id="myChart" class="table-responsive"></canvas>
          </div>
       
       <?php
          $data = array(1,1,1,0,1,0,1,0,1,0,0,0,1,1,0,0,1,0,0,1);
       ?>

    <!-- Bootstrap JS -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>

    <script src="../Sidebar/Main.js"></script>

    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
      const ctx = document.getElementById("myChart").getContext('2d');

      new Chart(ctx, {
        type: "line",
        data: {
          labels: <?php echo json_encode($labels);?> ,
          datasets: [
            {
              label: "Predicted marks",
              data: <?php echo json_encode($values);?>,
              fill: true,
              backgroundColor: "rgba(176, 139, 241, 0.5)", // Set background color with 50% opacity
              borderColor: "#884DEE",
              borderWidth: 2,
              tension: 0.4,
            },
          ],
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
            },
          },
        },
      });
    </script>
  </body>
</html>
