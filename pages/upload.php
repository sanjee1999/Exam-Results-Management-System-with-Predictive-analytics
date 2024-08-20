<?php
#session_start();

require '../vendor/autoload.php'; // Include PHPSpreadsheet
//require '../function/fun.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;



if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  debug("post working<br>") ; 
}
if (isset($_FILES['file'])){
  debug("file working<br>") ;
  //debug(print_r($_FILES['file']));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $uploadDir = '../pages/uploads/';
    $uploadFile = $uploadDir . basename($_FILES['file']['name']);
    $_SESSION['uploadfile']=$uploadFile;

    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
        $spreadsheet = IOFactory::load($uploadFile);

        $worksheet = $spreadsheet->getActiveSheet();
        $firstRow = $worksheet->rangeToArray('A1:' . $worksheet->getHighestColumn() . '1')[0];
      
        //debug(print_r($firstRow));
        debug("<br>line clear<br>") ;

        $_SESSION['firstRow']=$firstRow;
        #$_SESSION['firstRow']=3;

        // echo '<h2>First Row Data:</h2>';
        // echo '<div class="form-group" id="year">';
        //           echo '<select name="year" id="year" class="form-control">';
        //             echo '<option value="" selected disabled>Select Year</option>';
        //                     foreach ($firstRow as $cell) {
        //                         echo '<option value="">'. htmlspecialchars($cell) . '</option>';
        //                         echo htmlspecialchars($cell) ;
        //                     }     
        //           echo '</select>';
        //         echo '</div>';
        #header('Location:../function/fun.php');
        #exit();
    } else {
        echo 'Possible file upload attack!<br>';
    }
} else {
    echo 'Invalid request<br>';
}
?>
<?php
          


          if(isset($_GET['type'])){
            $type=$_GET['type'];
            debug( $type."<br>");
          }
          if($_SERVER["REQUEST_METHOD"]=="POST"){
            
            $sub_code=(isset($_POST['sub_code']))?($_POST['sub_code']):null;
            $hour=(isset($_POST['hour']))?($_POST['hour']):null;
            $time=(isset($_POST['time']))?($_POST['time']):null;
            $date=(isset($_POST['date']))?($_POST['date']):null;
            $file=(isset($_POST['file']))?($_POST['file']):null;
            $level=(isset($_POST['level']))?($_POST['level']):null;
            $ica=(isset($_POST['ica']))?($_POST['ica']):null;
            $final=(isset($_POST['final']))?($_POST['final']):null;
            $sub_type=(isset($_POST['sub_type']))?($_POST['sub_type']):null;

            
            
           
            debug( " $level $sub_code $hour $time $date $file $type $ica");
          
          }
          if(isset($_GET['heading'])){
            $heading=$_GET['heading'];
            if($heading=='ica'){
              $heading=strtoupper($ica).' Marks';
            }elseif($heading=='final'){
              $heading=strtoupper($heading).' Marks';
            }
            debug($heading."<br>");
          }

        

          if($_SERVER["REQUEST_METHOD"]=="POST"){
            $rego=(isset($_POST['regno']))?($_POST['regno']):null;
            $name=(isset($_POST[$type]))?($_POST[$type]):null;

                if(!empty($rego) && !empty($name)){
                  debug("<br>".$rego ." *** ".$name) ;
                }
          }
          
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
            <h3>- Add <?php echo $heading ?> -</h3>
  </div>
<?php 
      $i=1;
      $j=1;
?>
  <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post">
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

    <div class="form-group" id="<?php echo isset($type)?$type:null;?>">
                    <select name="<?php echo isset($type)?$type:null;?>" id="<?php echo isset($type)?$type:null;?>" class="form-control" required>
                    <option value="" selected disabled>Select <?php echo $heading ?> Column</option>
                    <?php
                             foreach ($firstRow as $cell) {
                                 echo '<option value="'.$j.'">'. htmlspecialchars($cell) . '</option>';
                                 $j++;
                                 echo htmlspecialchars($cell) ;
                             } 
                    ?>
                   </select>
    </div>
    <div class="form-group">
                  <button class="btn btn-primary">Submit</button>
                </div>    
</form>


<table border="1">
  <?php 
  if (isset($_FILES['file'])) {
        $_SESSION['file']=isset($file)?$file:null;
        $_SESSION['level']=isset($level)?$level:null;
        $_SESSION['sub_code']=isset($sub_code)?$sub_code:null;
        $_SESSION['hour']=isset($hour)?$hour:null;
        $_SESSION['time']=isset($time)?$time:null;
        $_SESSION['date']=isset($date)?$date:null;
        $_SESSION['type']=isset($type)?$type:null;
        $_SESSION['heading']=isset($heading)?$heading:null;
        $_SESSION['ica']=isset($ica)?$ica:null;
        $_SESSION['sub_type']=isset($sub_type)?$sub_type:null;

  }
$uploadFile=isset($_SESSION['uploadfile'])?$_SESSION['uploadfile']:null;
if($uploadFile){
$spreadsheet = IOFactory::load($uploadFile);

$worksheet = $spreadsheet->getActiveSheet();

  $highestRow = $worksheet->getHighestDataRow();
  // Get the highest column letter with data
  $highestColumn = $worksheet->getHighestDataColumn();
  $_SESSION['highestRow']=$highestRow;

  // Convert the column letter to a column index
  $highestColumnIndex = PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
  $i=isset($_POST['regno'])?$_POST['regno']:null;
  $j=isset($_POST[$type])?$_POST[$type]:null;

  if(!empty($i) && !empty($j)){
  $c1 = PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($i);
  $c2 = PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($j);

    $h1=$worksheet->getCell($c1.'1')->getValue();
    $h2=$worksheet->getCell($c2.'1')->getValue();
    echo "<tr><th>$h1</th><th>$h2</th></tr>";
    for($row=2; $row<=$highestRow ;$row++){
      $d1=$worksheet->getCell($c1.$row)->getValue();
      $d2=$worksheet->getCell($c2.$row)->getValue();
      echo "<tr><td>$d1</td>
            <td>$d2</td></tr>";
  
    }
  

  ?>
</table>
<?php

     
     $col1=[];
     $col2=[];


     for ($row = 2; $row <= $highestRow; $row++) {
      #$col1[] = $worksheet->rangeToArray( $c1. $row . ':' . $c1 . $highestRow)[0];
      #$col2[] = $worksheet->rangeToArray( $c2. $row . ':' . $c2 . $highestRow)[0];
      #echo  $c1. $row . ':' . $c1 . $highestRow.'<br>';
      $col1[] = $worksheet->getCell($c1 . $row)->getValue();
      $col2[] = $worksheet->getCell($c2 . $row)->getValue();
    }
    debug(print_r($col1));
    echo"<br>";
    debug(print_r($col2));
     $_SESSION['col1']=isset($col1)?$col1:null;
     $_SESSION['col2']=isset($col2)?$col2:null;
    upload($conn);
  }
}
    
?>


</body>