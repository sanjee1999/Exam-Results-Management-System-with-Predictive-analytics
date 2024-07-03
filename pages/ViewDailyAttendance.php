<?php
$sub_code=$date=$month=$year=$regno=$level=null;

  if($_SERVER["REQUEST_METHOD"]=="POST"){
    $sub_code=(isset($_POST['sub_code']))?($_POST['sub_code']):null;
    $level=(isset($_POST['level']))?($_POST['level']):null;
    $date=(isset($_POST['date']))?($_POST['date']):null;
    $month=(isset($_POST['month']))?($_POST['month']):null;
    $year=(isset($_POST['year']))?($_POST['year']):null;
    $regno=(isset($_POST['regno']))?($_POST['regno']):null;
    $type=(isset($_POST['type']))?($_POST['type']):null;
   
    echo "$sub_code $date $month $year $regno $level <br>";

    $_SESSION['sub_code']=isset($sub_code)?$sub_code:null;
    $_SESSION['level']=isset($level)?$level:null;
    $_SESSION['date']=isset($date)?$date:null;
    $_SESSION['month']=isset($month)?$month:null;
    $_SESSION['year']=isset($year)?$year:null;
    $_SESSION['regno']=isset($regno)?$regno:null;
    $_SESSION['type']=isset($type)?$type:null;
  }
?>    
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
                    <option value="sub_1">Subject 01</option>
                    <option value="sub_2">Subject 02</option>
                    <option value="sub_3">Subject 03</option>
                    <option value="sub_4">Subject 04</option>
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
                
                <div class="form-group col-md-3" id="regno">
                  <input type="text" name="regno" id="regno" class="form-control" placeholder="Reg_No"/>
                  <input type="hidden" name="type" id="type" class="form-control" value="attendance"/>

                </div>

                <!-- <div class="form-group col-md-3">
                  <button class="btn btn-primary w-100">View</button>
                </div> -->
              </form>
            </div>
          </div>
          <div class="title text-center">
            <h3>- Attendance for
              <?php   
                  echo "$regno $sub_code $date $month $year $level";
              ?>
            -</h3>
          </div>
        </div>
        <div class="container" id="viewout">
          <!-- <section class="p-5">
            <div class="table-responsive" id="table1">
              <?php 
                // if($_SERVER["REQUEST_METHOD"]=="POST"){  
                //   $table='attendance';
                //   $query=querygenarator($table);
                //   outputQueryInTable($conn,$query);
                // }
              ?>
            </div>
          </section> -->
        </div>

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

