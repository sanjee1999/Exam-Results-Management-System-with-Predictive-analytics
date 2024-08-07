<?php
session_start();
require_once '../connection/conf.php';
require_once '../function/fun.php';

$sub_code=$date=$month=$year=$regno=$level=$type=null;

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
   
    echo "$sub_code $date $month $year $regno $level $attend<br>";

    $_SESSION['sub_code']=isset($sub_code)?$sub_code:null;
    $_SESSION['sub_type']=isset($sub_type)?$sub_type:null;
    $_SESSION['level']=isset($level)?$level:null;
    $_SESSION['date']=isset($date)?$date:null;
    $_SESSION['month']=isset($month)?$month:null;
    $_SESSION['year']=isset($year)?$year:null;
    $_SESSION['regno']=isset($regno)?$regno:null;
    $_SESSION['type']=isset($type)?$type:null;
    $_SESSION['attend'] = isset($attend) ? $attend : null;
    $_SESSION['batch'] = isset($batch) ? $batch : null;
    $_SESSION['sem'] = isset($sem) ? $sem : null;
    $_SESSION['dep'] = isset($dep) ? $dep : null;
    $_SESSION['course'] = isset($course) ? $course : null;
    $_SESSION['ica'] = isset($ica) ? $ica : null;
    $_SESSION['index_no'] = isset($index_no) ? $index_no : null;
    $_SESSION['graph'] = isset($graph) ? $graph : null;
  }

  
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>View</title>
    <!-- get icons -->
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />

    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <lord-icon trigger="hover" src="/my-icon.json"></lord-icon>

    <link rel="stylesheet" href="../Sidebar/Sider.css" />
    <link rel="stylesheet" href="../Style/ViewDailyAttendance.css" />

    <!-- get bootstrap -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />

    <link rel="stylesheet" href="Slider.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../script/chartUtil.js" defer></script>
  </head>
  <body>

          <section class="p-5">
          
            <!-- <div class="table-responsive" id="table1"> -->
              <?php 
              $label = [];
              $value = [];
                if($_SERVER["REQUEST_METHOD"]=="POST"){ 
                  if($type=='attendance'){ 
                      $query=queryattend();
                      if($graph=='graph'){
                        $result=outputQueryInChart($conn,$query);
                        echo "hiiiiiiii";
                        while($row = $result->fetch_assoc()) {
                          $label[] = $row['Reg_No'];
                          $value[] = $row['Attendance'];
                        }
                        
                      }else{
                        outputQueryInTable($conn,$query);
                      }
                  }
                  if($type=='ica'){ 
                    $query=queryica();
                    if($graph=='graph'){
                      outputQueryInChart($conn,$query);
                    }else{
                      outputQueryInTable($conn,$query);
                    }
                  }
                  if($type=='final'){ 
                    $query=queryfinal();
                    if($graph=='graph'){
                      outputQueryInChart($conn,$query);
                    }else{
                      outputQueryInTable($conn,$query);
                    }
                  }
                  
                  if($type=='combo' && $sub_code && $batch){
                    $data=comboMarks($conn,$sub_code,$batch);
                    if($detail=='full'){
                        arrayTable($data);
                    }else{
                        $data=dropColumnsByIndex($data,3,11);
                        arrayTable($data);
                    }
                        
                  }
              }
              ?>
            </div>
          </section>
          <?php
               //$label=isset($label)?$label:NULL;
               //$value=isset($value)?$value:NULL;
               print_r($value) ;
               print_r($label) ;
              
          ?>
          <!-- <script>
              // Call the reusable function to fetch data and create the chart
              document.addEventListener('DOMContentLoaded', () => {
                  fetchDataAndCreateChart(
                      '../pages/view.php', // API URL
                      '<?php echo $label;?>', // Key for labels in JSON data
                      '<?php echo $value;?>', // Key for values in JSON data
                      'bar', // Type of chart
                      'myChart' // ID of the canvas element
                  );
              });
          </script> -->
          <!-- <canvas id="myChart" width="400" height="200"></canvas> -->


<!-- 
          <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById("myChart").getContext('2d');

  new Chart(ctx, {
    type: "line",
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
 -->

<div class="chart">
            <canvas id="viewout"></canvas>
          </div>
       

    <!-- Bootstrap JS -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>

    <script src="../Sidebar/Main.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
      const ctx = document.getElementById("viewout");

      new Chart(ctx, {
        type: "line",
        data: {
          labels: [
            "2019/ASP/01",
            "2019/ASP/02",
            "2019/ASP/03",
            "2019/ASP/04",
            "2019/ASP/05",
            "2019/ASP/06",
            "2019/ASP/07",
            "2019/ASP/08",
            "2019/ASP/09",
            "2019/ASP/10",
            "2019/ASP/11",
            "2019/ASP/12",
            "2019/ASP/13",
            "2019/ASP/14",
            "2019/ASP/15",
            "2019/ASP/16",
            "2019/ASP/17",
            "2019/ASP/18",
            "2019/ASP/19",
            "2019/ASP/20",
          ],
          datasets: [
            {
              label: "Predicted marks",
              data: [
                65, 59, 80, 81, 56, 25, 65, 59, 80, 81, 96, 55, 25, 65, 59, 80,
                81, 96, 55, 25,
              ],
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