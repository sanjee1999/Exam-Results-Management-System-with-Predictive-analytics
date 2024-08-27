<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <title>Document</title>
</head>
<body>
  
</body>
</html>
<?php 
              $label = [];
              $value1 = [];
              $value2 = [];
              $value3 = [];
              $value4 = [];
              $l1=$l2=$l3=$l4=NULL;
              //$row['ica_1_marks']=$row['ica_2_marks']=$row['ica_3_marks']=NULL;

                if($_SERVER["REQUEST_METHOD"]=="POST" ){ 
                  // if($type=='attendance'){ 
                  //       $query=queryattend();
                  //       $result = $conn->query($query);
                  //       while($row = $result->fetch_assoc()) {
                  //         $label[] = $row['Reg_No'];
                  //         $value1[] = $row['Attendance'];
                  //         $l1="Attendance";
                  //       }
                  // }
                  if($type=='ica'){ 
                    $query=queryica();
                    $result = $conn->query($query);
                    while($row = $result->fetch_assoc()) {
                      $label[] = $row['reg_no'];
                      $value1[] = isset($row['ica_1_marks'])?$row['ica_1_marks']:NULL;
                      $value2[] = isset($row['ica_2_marks'])?$row['ica_2_marks']:NULL;
                      $value3[] = isset($row['ica_3_marks'])?$row['ica_3_marks']:NULL;
                      $l1="ica_1_marks";
                      $l2="ica_2_marks";
                      $l3="ica_3_marks";
                    }
                  }
                  if($type=='final'){ 
                    $query=queryfinal();
                    $result = $conn->query($query);
                    while($row = $result->fetch_assoc()) {
                      $label[] = $row['reg_no'];
                      $value1[] = isset($row['marks_att1'])?$row['marks_att1']:NULL;
                      $value2[] = isset($row['marks_att2'])?$row['marks_att2']:NULL;
                      $value3[] = isset($row['marks_att3'])?$row['marks_att3']:NULL;
                      $value4[] = isset($row['marks_attsp'])?$row['marks_attsp']:NULL;
                      
                      $l1="marks_att1";
                      $l2="marks_att2";
                      $l3="marks_att3";
                      $l4="marks_attsp";
                    }
                  }
                  
                  if($type=='combo' && $sub_code && $batch){
                    $data=comboMarks($conn,$sub_code,$batch);
                    
                    foreach ($data as $row) {
                      $label[] = $row['reg_no'];
                      $value1[] = $row['Final_Result'];
                      $l1="Final result";
                    }
                        
                  }
              }
              ?>
            </div>
          </section>
<?php
          if ($_SERVER['REQUEST_METHOD'] === 'POST'){
          //echo "<canvas id='standardizedComparisonChart'></canvas> ";
          echo "<canvas id='myChart'></canvas> ";
          echo "<canvas id='histogramChart' width='800' height='400'></canvas>";
          
          }  
?>   

<?php // Function to calculate frequencies of unique values
          function calculate_frequencies($values) {
            // Filter out any non-integer or non-string values
            $filtered_values = array_filter($values, function($value) {
                return is_int($value) || is_string($value);
            });
        
            // Count the frequency of each value
            $frequencies = array_count_values($filtered_values);
        
            // Sort the frequencies by key (the score)
            ksort($frequencies);
        
            return $frequencies;
          }

          // Calculate frequencies for each dataset
          $frequencies1 = calculate_frequencies($value1);
          $frequencies2 = calculate_frequencies($value2);
          $frequencies3 = calculate_frequencies($value3);

          // Prepare data for Chart.js
          $labels1 = array_keys($frequencies1);
          $data1 = array_values($frequencies1);

          $labels2 = array_keys($frequencies2);
          $data2 = array_values($frequencies2);

          $labels3 = array_keys($frequencies3);
          $data3 = array_values($frequencies3);

          function calculate_mean_std_dev($values) {
            $n = count($values);
            if ($n === 0) {
                return [0, 0];
            }
            
            // Calculate mean
            $mean = array_sum($values) / $n;
            
            // Calculate variance
            $variance = array_reduce($values, function($carry, $value) use ($mean) {
                return $carry + pow($value - $mean, 2);
            }, 0) / $n;
            
            // Calculate standard deviation
            $std_dev = sqrt($variance);
            
            return [$mean, $std_dev];
          }
          function normal_distribution($x, $mean, $std_dev) {
            if ($std_dev == 0) {
                return 0; // To avoid division by zero
            }
            
            $exponent = exp(-0.5 * pow(($x - $mean) / $std_dev, 2));
            return (1 / ($std_dev * sqrt(2 * M_PI))) * $exponent;
          }

          // Function to fit data to normal distribution
          function fit_to_normal_distribution($values) {
            list($mean, $std_dev) = calculate_mean_std_dev($values);
            $fitted_values = [];
            $step = 1; // Adjust step size if needed

            $min = 0;   // Set minimum to 0 for exam scores
            $max = 100; // Set maximum to 100 for exam scores

            for ($x = $min; $x <= $max; $x += $step) {
                $fitted_values[$x] = normal_distribution($x, $mean, $std_dev);
            }
            
            ksort($fitted_values); // Sort for consistent plotting
            return $fitted_values;
          }


          // Fit the data to normal distribution
          $fitted_values1 = fit_to_normal_distribution($value1);
          $fitted_values2 = fit_to_normal_distribution($value2);
          $fitted_values3 = fit_to_normal_distribution($value3);

          // Convert fitted values to arrays
          $fitted_labels1 = array_keys($fitted_values1);
          $fitted_data1 = array_values($fitted_values1);

          $fitted_labels2 = array_keys($fitted_values2);
          $fitted_data2 = array_values($fitted_values2);

          $fitted_labels3 = array_keys($fitted_values3);
          $fitted_data3 = array_values($fitted_values3);

          function predefined_bell_curve($scaling_factor = 5) { // Increase scaling factor to boost height
            $mean = 50;
            $std_dev = 15;
            $bell_curve = [];
            
            for ($x = 0; $x <= 100; $x++) {
                $bell_curve[$x] = normal_distribution($x, $mean, $std_dev) * $scaling_factor;
            }
            
            return $bell_curve;
        }

          // Generate the predefined bell-shaped curve
          $bell_curve = predefined_bell_curve();

?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
        const ctx = document.getElementById('histogramChart').getContext('2d');
        const histogramChart = new Chart(ctx, {
            type: 'line', // Use 'line' type to create smooth curves
            data: {
                labels: [...Array(101).keys()], // 0-100 range for x-axis
                datasets: [
                    {
                        label: 'Fitted Normal Distribution for <?php echo "$l1"; ?>',
                        data: <?php echo json_encode($fitted_data1); ?>,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.1 // Smooth curve
                    },
                    {
                        label: 'Fitted Normal Distribution for <?php echo "$l2"; ?>',
                        data: <?php echo json_encode($fitted_data2); ?>,
                        borderColor: 'rgba(192, 75, 75, 1)',
                        backgroundColor: 'rgba(192, 75, 75, 0.2)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.1 // Smooth curve
                    },
                    {
                        label: 'Fitted Normal Distribution for <?php echo "$l3"; ?>',
                        data: <?php echo json_encode($fitted_data3); ?>,
                        borderColor: 'rgba(75, 75, 192, 1)',
                        backgroundColor: 'rgba(75, 75, 192, 0.2)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.1 // Smooth curve
                    },
                    {
                        label: 'Predefined Bell-Shaped Curve',
                        data: <?php echo json_encode(array_values($bell_curve)); ?>,
                        borderColor: 'rgba(255, 159, 64, 1)',
                        backgroundColor: 'rgba(255, 159, 64, 0.2)',
                        borderWidth: 2,
                        fill: false, // No fill, just the line
                        tension: 0.1 // Smooth curve
                    }
                ]
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Score'
                        },
                        min: 0, // Set minimum value to 0
                        max: 100, // Set maximum value to 100
                        ticks: {
                            autoSkip: false // Ensure all x-axis labels are shown
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Frequency'
                        },
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    }
                }
            }
        });
    </script>
<script>
  const ctx1 = document.getElementById("myChart").getContext('2d');

  new Chart(ctx1, {
    type: "bar",
    data: {
      labels: <?php echo json_encode($label);?> ,
      datasets: [
        {
          label: "<?php echo $l1; ?>",
          data: <?php echo json_encode($value1);?>,
          fill: false,
          backgroundColor: "rgba(176, 139, 241, 0.5)", // Set background color with 50% opacity
          borderColor: "#884DEE",
          borderWidth: 2,
          tension: 0.4,
        },
        {
          label: "<?php echo $l2; ?>",
          data: <?php echo json_encode($value2);?>,
          fill: false,
          backgroundColor: "rgba(176, 139, 241, 0.5)", // Set background color with 50% opacity
          borderColor: "#F84DEF",
          borderWidth: 2,
          tension: 0.4,
        },
        {
          label: "<?php echo $l3; ?>",
          data: <?php echo json_encode($value3);?>,
          fill: false,
          backgroundColor: "rgba(176, 139, 241, 0.5)", // Set background color with 50% opacity
          borderColor: "#FF0000",
          borderWidth: 2,
          tension: 0.4,
        },
        {
          label: "<?php echo $l4; ?>",
          data: <?php echo json_encode($value4);?>,
          fill: false,
          backgroundColor: "rgba(176, 139, 241, 0.5)", // Set background color with 50% opacity
          borderColor: "#00000",
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
