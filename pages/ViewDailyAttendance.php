<?php
$sub_code=$date=$month=$year=$regno=$level=null;

// if($_SERVER["REQUEST_METHOD"]=="POST"){
//   $sub_code=(isset($_POST['sub_code']))?($_POST['sub_code']):null;
//   $sub_type=(isset($_POST['sub_type']))?($_POST['sub_type']):null;
//   $level=(isset($_POST['level']))?($_POST['level']):null;
//   $date=(isset($_POST['date']))?($_POST['date']):null;
//   $month=(isset($_POST['month']))?($_POST['month']):null;
//   $year=(isset($_POST['year']))?($_POST['year']):null;
//   $regno=(isset($_POST['regno']))?($_POST['regno']):null;
//   $type=(isset($_POST['type']))?($_POST['type']):null;
//   $attend=(isset($_POST['attend']))?($_POST['attend']):null;
//   $batch = isset($_POST['batch']) ? $_POST['batch'] : null;
//   $sem = isset($_POST['sem']) ? $_POST['sem'] : null;
//   $dep = isset($_POST['dep']) ? $_POST['dep'] : null;
//   $course = isset($_POST['course']) ? $_POST['course'] : null;
//   $ica = isset($_POST['ica']) ? $_POST['ica'] : null;
//   $index_no = isset($_POST['index_no']) ? $_POST['index_no'] : null;
//   $detail = isset($_POST['detail']) ? $_POST['detail'] : null;
//   $graph = isset($_POST['graph']) ? $_POST['graph'] : null;
 
//   echo "$sub_code $date $month $year $regno $level $attend<br>";

//   $_SESSION['sub_code']=isset($sub_code)?$sub_code:null;
//   $_SESSION['sub_type']=isset($sub_type)?$sub_type:null;
//   $_SESSION['level']=isset($level)?$level:null;
//   $_SESSION['date']=isset($date)?$date:null;
//   $_SESSION['month']=isset($month)?$month:null;
//   $_SESSION['year']=isset($year)?$year:null;
//   $_SESSION['regno']=isset($regno)?$regno:null;
//   $_SESSION['type']=isset($type)?$type:null;
//   $_SESSION['attend'] = isset($attend) ? $attend : null;
//   $_SESSION['batch'] = isset($batch) ? $batch : null;
//   $_SESSION['sem'] = isset($sem) ? $sem : null;
//   $_SESSION['dep'] = isset($dep) ? $dep : null;
//   $_SESSION['course'] = isset($course) ? $course : null;
//   $_SESSION['ica'] = isset($ica) ? $ica : null;
//   $_SESSION['index_no'] = isset($index_no) ? $index_no : null;
//   $_SESSION['graph'] = isset($graph) ? $graph : null;
// }
//  ?>    
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>View dail attendance</title>
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
  </head>
  <body>
    
          <div class="title text-center">
            <h3>- View Daily Attendance -</h3>
          </div>
        <div class="container">
          <div class="input-section py-8 mb-5">
            <div class="form d-flex justify-content-center align-items-center">
              <form action="" method="post" class="row" oninput="submitForm()" id="searchForm">
                <div class="form-group col-md-3" id="sub_code">
                  <select name="sub_code" id="sub_code" class="form-control">
                    <option value="" selected disabled>Select Sub_code</option>
                    <?php optiongen($conn, 'subject', 'sub_code','sub_name') ?>
                  </select>
                </div>
                <div class="form-group" id="sub_type">
                  <select name="sub_type" id="sub_type" class="form-control" required>
                    <option value="" selected disabled>Select Subject Type</option>
                    <option value="T" <?php #if ($year == '1') echo 'selected'; ?>>Theory</option>
                    <option value="P" <?php #if ($year == '1') echo 'selected'; ?>>Practical</option> 
                  </select>
                </div>
                <div class="form-group col-md-3" id="level">
                  <select name="level" id="level" class="form-control">
                    <option value="" selected disabled>Select Level</option>
                    <option value="1">1st Year</option>
                    <option value="2">2nd Year</option>
                    <option value="3">3rd Year</option>
                    <option value="4">4th Year</option>
                  </select>
                </div>
                <div class="form-group col-md-3" id="attend">
                  <select name="attend" id="attend" class="form-control">
                    <option value="" selected disabled>Select Attendance Status</option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                  </select>
                </div>

                <div class="form-group col-md-3" id="date">
                  <input
                    type="date"
                    name="date"
                    id="date"
                    class="form-control"
                  />
                </div>

                <div class="form-group col-md-3" id="month">
                  <select name="month" id="month" class="form-control">
                    <option value="" selected disabled>Select Month</option>
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                  </select>
                </div>

                <div class="form-group col-md-3" id="year">
                  <select name="year" id="year" class="form-control">
                    <option value="" selected disabled>Select Year</option>
                    <?php
                        $current_year = date('Y');
                        $start_year = $current_year - 10;
                        
                        for ($y = $start_year; $y <= $current_year; $y++) {
                            echo '<option value="' . $y . '">' . $y . '</option>';
                        }
                    ?>
                  </select>
                </div>
                
                <div class="form-group col-md-3" id="batch">
                  <input type="text" name="batch" id="batch" class="form-control" placeholder="Batch"/>
                </div>
                <div class="form-group col-md-3" id="dep">
                    <select name="dep" id="dep" class="form-control">
                      <option value="" selected disabled>Select Department</option>
                      <?php optiongen($conn, 'department', 'dep_id','dep_name') ?>
                    </select>
                </div>
                <div class="form-group col-md-3" id="course">
                    <select name="course" id="course" class="form-control">
                      <option value="" selected disabled>Select Course</option>
                      <?php optiongen($conn, 'course', 'course_id','course_name') ?>
                    </select>
                </div>
                <div class="form-group col-md-3" id="sem">
                  <input type="text" name="sem" id="sem" class="form-control" placeholder="Semester"/>
                </div>
                
                <div class="form-group col-md-3" id="regno">
                  <input type="text" name="regno" id="regno" class="form-control" placeholder="Reg_No"/>
                  <input type="hidden" name="type" id="type" class="form-control" value="attendance"/>
                </div>
                <!-- <div class="form-check form-switch form-group" id="graph">
                  <input class="form-check-input" type="checkbox" role="switch" name="graph" id="graph" value="graph">
                  <label class="form-check-label" for="graph">Graph View</label>
                </div> -->

                <!-- <div class="form-group col-md-3">
                  <button class="btn btn-primary w-100">View</button>
                </div> -->
              </form>
            </div>
          </div>
          <div class="title text-center">
            <h3>- Attendance for
              <?php   
                  debug("$regno $sub_code $date $month $year $level") ;
              ?>
            -</h3>
          </div>
        </div>
        <div class="container" id="viewout">
        
        </div>
    
       

          <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
 
            
          
          
         

<div class="chart">
            <canvas id="myChart"></canvas>
</div>
<!-- <script>
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
</script> -->
       

    <!-- Bootstrap JS -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    <script src="../script/filter.js"></script>
    <script src="../Sidebar/Main.js"></script>


   
  </body>
</html>

