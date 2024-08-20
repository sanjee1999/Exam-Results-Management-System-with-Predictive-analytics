<?php

require '../vendor/autoload.php'; 

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;




if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  debug("post working<br>") ; 
}
if (isset($_FILES['file'])){
  debug("file working<br>") ;
  //print_r($_FILES['file']);
}

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
        $uploadDir = '../pages/uploads/';
        $uploadFile = $uploadDir . basename($_FILES['file']['name']);
        $_SESSION['uploadfile']=$uploadFile;

        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
            $spreadsheet = IOFactory::load($uploadFile);

            $worksheet = $spreadsheet->getActiveSheet();
            $firstRow = $worksheet->rangeToArray('A1:' . $worksheet->getHighestColumn() . '1')[0];
          
          //print_r($firstRow);
          debug("<br>line clear<br>") ;

            $_SESSION['firstRow']=$firstRow;
          
        } else {
            echo 'Possible file upload attack!<br>';
        }
    } else {
    echo 'Invalid request<br>';
    }
          
          if(isset($_GET['type'])){
            $type=$_GET['type'];
            debug($type."<br>") ;
          }
          if($_SERVER["REQUEST_METHOD"]=="POST"){
            
            $file=(isset($_POST['file']))?($_POST['file']):null;
            $course=(isset($_POST['course']))?($_POST['course']):null;
            $batch=(isset($_POST['batch']))?($_POST['batch']):null;
            $type = isset($_POST['type']) ? $_POST['type'] : null;
           
           debug("$course $batch $type") ;

            if (isset($_FILES['file'])) {
              $_SESSION['file']=isset($file)?$file:null;
              $_SESSION['batch']=isset($batch)?$batch:null;
              $_SESSION['course']=isset($course)?$course:null;
              $_SESSION['type'] = isset($type) ? $type : NULL;
              debug( "<br> ok session");
            }
          
          }
          if(isset($_GET['heading'])){
            $heading=$_GET['heading'];
            if($heading=='ica'){
              $heading=strtoupper($ica).' Marks';
            }elseif($heading=='final'){
              $heading=strtoupper($heading).' Marks';
            }
            debug($heading."<br>") ;
          }
      
          // if($_SERVER["REQUEST_METHOD"]=="POST"){
          //   $rego=(isset($_POST['regno']))?($_POST['regno']):null;
          //   $name=(isset($_POST[$type]))?($_POST[$type]):null;

          //       if(!empty($rego) && !empty($name)){
          //         echo "<br>".$rego ." *** ".$name;
          //       }
          // }
          
?> 
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add daily attendance</title>
    <!-- get icons -->
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />

    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <lord-icon trigger="hover" src="/my-icon.json"></lord-icon>

    <link rel="stylesheet" href="../Dashboard/Sider.css" />
    <link rel="stylesheet" href="../Style/AddDailyAttendance.css" />

    <!-- get bootstrap -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <style>
      #form1{
        display: none;
        }
      
    </style>
  </head>
  <body>
  <div class="title text-center">
            <h3>- Add Student Details -</h3>
  </div>
<?php 
    $i=$j=$k=$l=$m=$n=1;
      
?>
  <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post" id="form1999" >
    <div class="form-group" id="regno">
                    <select name="regno" id="regno" class="form-control" required>
                    <option value="" selected disabled>Select Reg.No Column</option>
                    <?php
                             foreach ($firstRow as $cell) {
                                 echo '<option value="'.$i.'">'. htmlspecialchars($cell) . '</option>';
                                 $i++;
                                 echo htmlspecialchars($cell) ;
                             } 
                    ?>
                   </select>
    </div>
    <div class="form-group" id="index_no">
                    <select name="index_no" id="index_no" class="form-control" required>
                    <option value="" selected disabled>Select Index.No Column</option>
                    <?php
                             foreach ($firstRow as $cell) {
                                 echo '<option value="'.$j.'">'. htmlspecialchars($cell) . '</option>';
                                 $j++;
                                 echo htmlspecialchars($cell) ;
                             } 
                    ?>
                   </select>
    </div>
    <div class="form-group" id="name">
                    <select name="name" id="name" class="form-control" required>
                    <option value="" selected disabled>Select Student Name Column</option>
                    <?php
                             foreach ($firstRow as $cell) {
                                 echo '<option value="'.$k.'">'. htmlspecialchars($cell) . '</option>';
                                 $k++;
                                 echo htmlspecialchars($cell) ;
                             } 
                    ?>
                   </select>
    </div>
    <div class="form-group" id="nic">
                    <select name="nic" id="nic" class="form-control" required>
                    <option value="" selected disabled>Select NIC Column</option>
                    <?php
                             foreach ($firstRow as $cell) {
                                 echo '<option value="'.$l.'">'. htmlspecialchars($cell) . '</option>';
                                 $l++;
                                 echo htmlspecialchars($cell) ;
                             } 
                    ?>
                   </select>
    </div>
    <div class="form-group" id="dob">
                    <select name="dob" id="dob" class="form-control" required>
                    <option value="" selected disabled>Select DOB Column</option>
                    <?php
                             foreach ($firstRow as $cell) {
                                 echo '<option value="'.$m.'">'. htmlspecialchars($cell) . '</option>';
                                 $m++;
                                 echo htmlspecialchars($cell) ;
                             } 
                    ?>
                   </select>
    </div>
    <div class="form-group" id="doa">
                    <select name="doa" id="doa" class="form-control" required>
                    <option value="" selected disabled>Select Date of Admission Column</option>
                    <?php
                             foreach ($firstRow as $cell) {
                                 echo '<option value="'.$n.'">'. htmlspecialchars($cell) . '</option>';
                                 $n++;
                                 echo htmlspecialchars($cell) ;
                             } 
                    ?>
                   </select>
    </div>
   
    <div class="form-group">
                  <button class="btn btn-primary" >Submit</button>
                </div>

  <?php 
 
$uploadFile=isset($_SESSION['uploadfile'])?$_SESSION['uploadfile']:null;
if($uploadFile){
$spreadsheet = IOFactory::load($uploadFile);

$worksheet = $spreadsheet->getActiveSheet();

  $highestRow = $worksheet->getHighestDataRow();
  // Get the highest column letter with data
  $highestColumn = $worksheet->getHighestDataColumn();
  $_SESSION['highestRow']=$highestRow;
  debug($highestRow)  ;

  // Convert the column letter to a column index
  $highestColumnIndex = PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
  $i = isset($_POST['regno']) ? $_POST['regno'] : null;
  $j = isset($_POST['index_no']) ? $_POST['index_no'] : null;
  $k = isset($_POST['name']) ? $_POST['name'] : null;
  $l = isset($_POST['nic']) ? $_POST['nic'] : null;
  $m = isset($_POST['dob']) ? $_POST['dob'] : null;
  $n = isset($_POST['doa']) ? $_POST['doa'] : null;
 
  debug("$i $j $k $l $m $n") ;
  

  if(!empty($i) && !empty($j) && !empty($k) && !empty($l) && !empty($m) && !empty($n)){
    $c1 = PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($i);
    $c2 = PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($j);
    $c3 = PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($k);
    $c4 = PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($l);
    $c5 = PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($m);
    $c6 = PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($n);
  
  //print Table
  // echo "<table border='1'>";
  //     $h1=$worksheet->getCell($c1.'1')->getValue();
  //     $h2=$worksheet->getCell($c2.'1')->getValue();
  //     echo "<tr><th>$h1</th><th>$h2</th></tr>";
  //     for($row=2; $row<=$highestRow ;$row++){
  //       $d1=$worksheet->getCell($c1.$row)->getValue();
  //       $d2=$worksheet->getCell($c2.$row)->getValue();
  //       echo "<tr><td>$d1</td>
  //             <td>$d2</td></tr>";
    
  //     }
  // echo "</table>";
      
  $col1 = [];
  $col2 = [];
  $col3 = [];
  $col4 = [];
  $col5 = [];
  $col6 = [];

     for ($row = 2; $row <= $highestRow; $row++) {
      #$col1[] = $worksheet->rangeToArray( $c1. $row . ':' . $c1 . $highestRow)[0];
      #$col2[] = $worksheet->rangeToArray( $c2. $row . ':' . $c2 . $highestRow)[0];
      #echo  $c1. $row . ':' . $c1 . $highestRow.'<br>';
      
          $col1[] = $worksheet->getCell($c1 . $row)->getValue();
          $col2[] = $worksheet->getCell($c2 . $row)->getValue();
          $col3[] = $worksheet->getCell($c3 . $row)->getValue();
          $col4[] = $worksheet->getCell($c4 . $row)->getValue();
          $col5[] = convertDate($worksheet->getCell($c5 . $row)->getValue());
          $col6[] = convertDate($worksheet->getCell($c6 . $row)->getValue());

          debug("ok outtt") ;
      }
      debug(print_r($col1));
    echo"<br>";
    debug(print_r($col2));
      $_SESSION['col1'] = isset($col1) ? $col1 : NULL;
      $_SESSION['col2'] = isset($col2) ? $col2 : NULL;
      $_SESSION['col3'] = isset($col3) ? $col3 : NULL;
      $_SESSION['col4'] = isset($col4) ? $col4 : NULL;
      $_SESSION['col5'] = isset($col5) ? $col5 : NULL;
      $_SESSION['col6'] = isset($col6) ? $col6 : NULL;
     
    upload($conn);
  }
}
    
?>

</body>



