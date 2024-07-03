<?php
session_start();
require_once '../connection/conf.php';
require_once '../function/fun.php';

$sub_code=$date=$month=$year=$regno=$level=$type=null;

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
                      $table='attendance';
                      $query=querygenarator($table);
                      outputQueryInTable($conn,$query);
                  }
                  if($type=='ica'){ 
                    $query=queryica();
                    outputQueryInTable($conn,$query);
                  }
              }
              ?>
            </div>
          </section>




  </body>
  </html>