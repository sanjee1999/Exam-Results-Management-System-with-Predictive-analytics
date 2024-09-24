<?php
      $result=false;
      if(isset($_GET['type'])){
        $type=$_GET['type'];
        debug( $type."<br>");
      }
      if($_SERVER["REQUEST_METHOD"]=="POST" && !empty($_POST['sub_code'])){
        
        $sub_code=(isset($_POST['sub_code']))?($_POST['sub_code']):null;
        $hour=(isset($_POST['hour']))?($_POST['hour']):null;
        $time=(isset($_POST['time']))?($_POST['time']):null;
        $date=(isset($_POST['date']))?($_POST['date']):null;
        $file=(isset($_POST['file']))?($_POST['file']):null;
        $batch=(isset($_POST['batch']))?($_POST['batch']):null;
        $ica=(isset($_POST['ica']))?($_POST['ica']):null;
        $final=(isset($_POST['final']))?($_POST['final']):null;
        $sub_type=(isset($_POST['sub_type']))?($_POST['sub_type']):null;

        $_SESSION['file']=isset($file)?$file:null;
        $_SESSION['batch']=isset($batch)?$batch:null;
        $_SESSION['sub_code']=isset($sub_code)?$sub_code:null;
        $_SESSION['hour']=isset($hour)?$hour:null;
        $_SESSION['time']=isset($time)?$time:null;
        $_SESSION['date']=isset($date)?$date:null;
        $_SESSION['type']=isset($type)?$type:null;
        $_SESSION['heading']=isset($heading)?$heading:null;
        $_SESSION['ica']=isset($ica)?$ica:null;
        $_SESSION['sub_type']=isset($sub_type)?$sub_type:null;
        $_SESSION['uploadfile']=true;
       
        debug( " $batch $sub_code $sub_type $hour $time $date $file $type $ica");
      
      

      $q1="SELECT st.reg_no FROM student st 
                JOIN course co ON st.course_id=co.course_id 
                JOIN subject su ON su.course_id=co.course_id 
                WHERE su.sub_code='$sub_code' AND st.batch='$batch' ";
      $q3="ORDER BY SUBSTRING_INDEX(st.reg_no, '/', 1) ASC,
                SUBSTRING_INDEX(SUBSTRING_INDEX(st.reg_no, '/', 2), '/', -1) ASC,
                CAST(SUBSTRING_INDEX(st.reg_no, '/', -1) AS UNSIGNED) ASC";
      $query=$q1.$q3;
      $result = $conn->query($query);
    }
        // if ($result === false) {
        // }else{
        //     $row_count = $result->num_rows;
        //     echo "Number of rows: " . $row_count;
        //     $_SESSION['highestRow']=$row_count;
        //     print_r($result) ;
        // }
if(isset($_GET['heading'])){
        $heading=$_GET['heading'];
        if($heading=='ica'){
          $heading=strtoupper($ica).' Marks';
        }elseif($heading=='final'){
          $heading=strtoupper($heading).' Marks';
        }
        debug($heading."<br>");
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
    <link rel="stylesheet" href="../Style/ViewDailyAttendance.css" />

    <!-- get bootstrap -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />

  </head>
  <body>

  <div class="title text-center">
            <h3>- Add <?php echo $heading ?> -</h3>
  </div>

  <form action="" method="POST">
        <table class="table bg-white">
            <thead class="bg-dark text-light">
                <tr>
                    <th>Reg No</th>
                    <th><?php echo $type; ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result === FALSE) {
                  echo "Error: " . $conn->error;
              } else {
                if ($result->num_rows > 0) {
                  $row_count = $result->num_rows;
                  debug("Number of rows: " . $row_count);
                  $_SESSION['highestRow']=$row_count+1;
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['reg_no'] . "<input type='hidden' name='col1[]' value='" . $row['reg_no'] . "'></td>";
                        echo "<td><input type='number' name='col2[]' required></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No students found</td></tr>";
                }
              }
                ?>
            </tbody>
        </table>
        <div class="form-group">
                  <button class="btn btn-primary">Submit</button>
        </div>
    </form>

  </body>
  </html>

  <?php

    if(!empty($_POST['col2'])){
      $col1=isset($_POST['col1'])?$_POST['col1']:null;
      $col2=isset($_POST['col2'])?$_POST['col2']:null;

      debug(print_r($col1));
      echo"<br>";
      debug(print_r($col2));
      $_SESSION['col1']=isset($col1)?$col1:null;
      $_SESSION['col2']=isset($col2)?$col2:null;
      upload($conn);
    }
  
  ?>