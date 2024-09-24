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
   
    debug("$sub_code $date $month $year $regno $level $attend<br>") ;

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
    $_SESSION['detail'] = isset($detail) ? $detail : null;
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

    <link rel="stylesheet" href="../Dashboard/Sider.css" />
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
    <style>
        #updateModal {
            display: none; 
            position: fixed; 
            top: 50%; 
            left: 50%; 
            transform: translate(-50%, -50%); 
            background-color: white; 
            padding: 20px; 
            border-radius: 5px; 
            z-index: 1000;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        #overlay {
            display: none; 
            position: fixed; 
            top: 0; 
            left: 0; 
            width: 100%; 
            height: 100%; 
            background-color: rgba(0, 0, 0, 0.5); 
            z-index: 999;
        }

    </style>
   
  </head>
  <body>
  <div class="container mt-5">
        <!-- Export Button -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exportModal">
            Export Data
        </button>
    </div>
    <br><br>
          <?php 
              $label = [];
              $value = [];
                if($_SERVER["REQUEST_METHOD"]=="POST"){ 
                  if($type=='attendance'){ 
                      $query=queryattend();
                      if($graph=='graph'){
                        outputQueryInChart($conn,$query);
                        }else{
                        outputQueryInTable($conn,$query,'attendance','record_key');
                        }
                      }
                  
                
                  if($type=='ica'){ 
                    $query=queryica();
                    if($graph=='graph'){
                      outputQueryInChart($conn,$query);
                    }else{
                      outputQueryInTable($conn,$query,'','record_key');
                    }
                  }
                  if($type=='final'){ 
                    $query=queryfinal();
                    if($graph=='graph'){
                      outputQueryInChart($conn,$query);
                    }else{
                      outputQueryInTable($conn,$query,'','record_key');
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
              require '../pages/exportoption.php';
              ?>
            </div>
          <?php
               //$label=isset($label)?$label:NULL;
               //$value=isset($value)?$value:NULL;
              
               //print_r($value) ;
               //print_r($label) ;
               //header('Content-Type: application/json');
                //echo json_encode(['labels' => $label,'values' => $value]);
                // $value = array(1,1,1,0,1,0,1,0,1,0,1,1,0);
                // $label =array('a','b','c','d','e','f','g','h','i','j','k','l','m');
                // header('Content-Type: application/json');
                // echo json_encode([
                //     'labels' => $label,
                //     'values' => $value
                // ]);
              
          ?>
          
          
<!-- <div class="chart">
            <canvas id="myChart"></canvas>
</div> -->

    <!-- Bootstrap JS -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    <!-- <script src="../script/filter.js"></script> -->
    <script src="../Sidebar/Main.js"></script>
    <script src="../script/fetch.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
  </body>
  </html>
  <?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['action'])) {
      $action = $_POST['action'];
      $id = $_POST['id'];
      $table = $_POST['table'];
      $idcol = $_POST['column'];
   
      if ($action === 'delete') {
          $result=deltablerow($conn,$table,$idcol,$id);
          //$result = deleteRow($id, $conn, $table);
          $result=true;
          echo $result ? 'success' : 'error';
      } elseif ($action === 'update') {
          //$data = $_POST['data'];
          //$result = updateRow($id, $data, $conn, $table, $column);
          //echo $result ? 'success' : 'error';
          $id = $_POST['id'];
          $table = $_POST['table'];
          $column = $_POST['column'];
          $data = json_decode($_POST['data'], true); // Decode the JSON data into an associative array

          // Build the SQL UPDATE statement dynamically
          // $updateParts = [];
          // foreach ($data as $columns => $value) {
          //     $updateParts[] = "$columns = '$value'";
          // }
          // $updateString = implode(', ', $updateParts);

          $sql = "UPDATE $table SET attendance='$data' WHERE $column = '$id'";
          if ($conn->query($sql) === TRUE) {
              echo 'success';
              $result=true;
              echo $result ? 'success' : 'error';
          } else {
              echo 'error';
          }
          exit;
      }
      exit;
  }
}
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id']) && isset($_GET['table']) && isset($_GET['column']) && isset($_GET['columns'])) {
  $id = $_GET['id'];
  $table = $_GET['table'];
  $column = $_GET['column'];
  $columns = explode(',', $_GET['columns']);

  $columnsString = implode(',', $columns);
  $sql = "SELECT $columnsString FROM $table WHERE $column = '$id'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      echo json_encode($result->fetch_assoc());
  } else {
      echo json_encode([]);
  }
  exit;
}

// Handle Update
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'update') {
  
// }
?>
  