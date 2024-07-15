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
  </head>
  <body>

          <section class="p-5">
            <div class="table-responsive" id="table1">
              <?php 
                if($_SERVER["REQUEST_METHOD"]=="POST"){ 
                  if($type=='attendance'){ 
                      $query=queryattend();
                      outputQueryInTable($conn,$query);
                  }
                  if($type=='ica'){ 
                    $query=queryica();
                    outputQueryInTable($conn,$query);
                  }
                  if($type=='final'){ 
                    $query=queryfinal();
                    outputQueryInTable($conn,$query);
                  }
              }
              ?>
            </div>
          </section>




  </body>
  </html>