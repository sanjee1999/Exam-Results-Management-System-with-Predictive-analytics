<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $sub_code=(isset($_POST['sub_code']))?($_POST['sub_code']):null;
    $sub_type=(isset($_POST['sub_type']))?($_POST['sub_type']):null;
    $level=(isset($_POST['level']))?($_POST['level']):null;
    $date=(isset($_POST['date']))?($_POST['date']):null;
    $month=(isset($_POST['month']))?($_POST['month']):null;
    $year=(isset($_POST['year']))?($_POST['year']):null;
    $regno=(isset($_POST['regno']))?($_POST['regno']):null;
    $type=(isset($_POST['type']))?($_POST['type']):null;
    $attend=(isset($_POST['attend']))?($_POST['attend']):null;
    $batch = isset($_POST['batch']) ? $_POST['batch'] : null;
    $sem = isset($_POST['sem']) ? $_POST['sem'] : null;
    $dep = isset($_POST['dep']) ? $_POST['dep'] : null;
    $course = isset($_POST['course']) ? $_POST['course'] : null;
    $ica = isset($_POST['ica']) ? $_POST['ica'] : null;
    $index_no = isset($_POST['index_no']) ? $_POST['index_no'] : null;
    $detail = isset($_POST['detail']) ? $_POST['detail'] : null;
    $graph = isset($_POST['graph']) ? $_POST['graph'] : null;
   
    echo "$sub_code $date $month $year $regno $level $attend<br>" ;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
               $label=array(1,1,1,0,0,1,0,0,0,0,0,0,1,1,0,1);
               $value=array(1,1,1,0,0,1,0,0,0,0,0,0,1,1,0,1);
              
               print_r($value) ;
               print_r($label) ;
               //header('Content-Type: application/json');
                //echo json_encode(['labels' => $label,'values' => $value]);
              
          ?>
       <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>  

<div class="chart">
            <canvas id="myChart"></canvas>
</div>
<script>
  const ctx = document.getElementById("myChart").getContext('2d');

  new Chart(ctx, {
    type: "bar",
    data: {
      labels: <?php echo json_encode($label);?> ,
      datasets: [
        {
          label: "Predicted marks",
          data: <?php echo json_encode($value);?>,
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