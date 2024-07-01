<?php 
 function exhead($firstRow,$name){
 
        echo '<div class="form-group" id="head">';
                  echo '<select name="'.$name.'" id="year" class="form-control">';
                    echo '<option value="" selected disabled>Select Year</option>';
                            foreach ($firstRow as $cell) {
                              $head=$cell;
                                echo '<option value="'.$cell.'">'. htmlspecialchars($cell) . '</option>';
                                echo htmlspecialchars($cell) ;
                            }     
                  echo '</select>';
                echo '</div>';
                #echo $head;
               # return $head;
                
}

function unsetsession(){
  unset($_SESSION['date']);
  unset($_SESSION['time']);
  unset($_SESSION['hour']);
  unset($_SESSION['sub_code']);
  unset($_SESSION['year']);
  unset($_SESSION['firstRow']);
  unset($_SESSION['col1']);
  unset($_SESSION['col2']);
  unset($_SESSION['highestRow']);
  unset($_SESSION['type']);
  unset($_SESSION['heading']);
  unset($_SESSION['uploadfile']);
  unset($_SESSION['level']);
  
}
function verify($conn,$result,$uploadFile){
  echo "<script type='text/javascript'>";
if ($result) {
   if (file_exists($uploadFile)) {
      unlink($uploadFile);
    unsetsession();
    echo "alert('Input successfully');";
   
    echo "window.location.href = '../Dashboard/Sider.php?content=../pages/Home.php';";
} else {
    echo "alert('There was an error');";
    #echo "window.location.href = '../Dashboard/Sider.php?content=../pages/Home.php';";
}
echo "</script>";
}
}
  // if($result){
  //   header('location:../Dashboard/Sider.php?content=../pages/Home.php');
  //   echo "<script type='text/javascript'>alert('Input successfully');</script>";
  //   unsetsession();
    
  // }
  // else{
  //   echo "<script type='text/javascript'>alert('There was an error');</script>";
  //   die("error".mysqli_error($conn));
  // }

  function loadsession(){
    $date = isset($_SESSION['date']) ? $_SESSION['date'] : null;
    $time = isset($_SESSION['time']) ? $_SESSION['time'] : null;
    $hour = isset($_SESSION['hour']) ? $_SESSION['hour'] : null;
    $year = isset($_SESSION['year']) ? $_SESSION['year'] : null;
    $month = isset($_SESSION['month']) ? $_SESSION['month'] : null;
    $sub_code = isset($_SESSION['sub_code']) ? $_SESSION['sub_code'] : null;
    $regno = isset($_SESSION['regno']) ? $_SESSION['regno'] : null;
    $indexno = isset($_SESSION['indexno']) ? $_SESSION['indexno'] : null;
    $level = isset($_SESSION['level']) ? $_SESSION['level'] : null;
    $firstRow = isset($_SESSION['firstRow']) ? $_SESSION['firstRow'] : null;
    $col1 = isset($_SESSION['col1']) ? $_SESSION['col1'] : null;
    $col2 = isset($_SESSION['col2']) ? $_SESSION['col2'] : null;
    $highestRow = isset($_SESSION['highestRow']) ? $_SESSION['highestRow'] : null;
    $type = isset($_SESSION['type']) ? $_SESSION['type'] : null;
    $heading = isset($_SESSION['heading']) ? $_SESSION['heading'] : null;
    $ica = isset($_SESSION['ica']) ? $_SESSION['ica'] : null;
    $uploadFile = isset($_SESSION['uploadfile']) ? $_SESSION['uploadfile'] : null;
          
      return compact('date', 'time', 'hour', 'year','month','sub_code',  
                    'regno','indexno','level', 'firstRow', 'col1', 'col2', 'highestRow', 
                    'type', 'heading', 'ica', 'uploadFile');

  }

function upload($conn){
      
      $sessionVariables = loadsession();
      extract($sessionVariables);

  switch($type){
    
    case 'attendance':
      for($row=0; $row<$highestRow-1; $row++){
        $query="INSERT INTO attendance VALUES ('$col1[$row]','$date','$time','$hour','$sub_code','$col2[$row]','$level')";
        $result=mysqli_query($conn,$query);
      }
       verify($conn,$result,$uploadFile) ;
      break;

    case 'ica':

      switch($ica){
        case 'ica1':
            for($row=0; $row<$highestRow-1; $row++){
                $query="INSERT INTO ica_1 VALUES ('$col1[$row]','$col2[$row]','$sub_code')";
                $result=mysqli_query($conn,$query);
            }
            verify($conn,$result,$uploadFile) ;
          break;

        case 'ica2':
          for($row=0; $row<$highestRow-1; $row++){
                $query="INSERT INTO ica_2 VALUES ('$col1[$row]','$col2[$row]','$sub_code')";
                $result=mysqli_query($conn,$query);
            }
            verify($conn,$result,$uploadFile) ;

          break;

        case 'ica3':
          for($row=0; $row<$highestRow-1; $row++){
            $query="INSERT INTO ica_3 VALUES ('$col1[$row]','$col2[$row]','$sub_code')";
            $result=mysqli_query($conn,$query);
          }
          verify($conn,$result,$uploadFile) ;
          break;

          case 'ica4':
            for($row=0; $row<$highestRow-1; $row++){
              $query="INSERT INTO ica_4 VALUES ('$col1[$row]','$col2[$row]','$sub_code')";
              $result=mysqli_query($conn,$query);
            }
          verify($conn,$result,$uploadFile) ;
          break;

        default:
      
          break;
      }
        
      break;
    
    case 'final':
      for($row=0; $row<$highestRow-1; $row++) {
        if(empty($col2[$row])){
            continue;
        }
        $qtest = "SELECT marks_att1, marks_att2, marks_att3, marks_attsp 
                  FROM exam 
                  WHERE index_no = '$col1[$row]' 
                  AND sub_code = '$sub_code'";
        $rtest = mysqli_query($conn, $qtest);
                
        if(mysqli_num_rows($rtest) == 0 ) {
            // Insert a new row if no matching row is found
            $query = "INSERT INTO exam VALUES ('$col1[$row]', '$col2[$row]', NULL, NULL, NULL, '$sub_code')";
            $result = mysqli_query($conn, $query);
        } else {
            $row_data = mysqli_fetch_assoc($rtest);
            
            if(is_null($row_data['marks_att1'])) {
                // Update marks_att1 if it is NULL
                $query = "UPDATE exam SET marks_att1 = '$col2[$row]' WHERE index_no = '$col1[$row]' AND sub_code = '$sub_code'";
            } elseif(is_null($row_data['marks_att2'])) {
                // Update marks_att2 if it is NULL
                $query = "UPDATE exam SET marks_att2 = '$col2[$row]' WHERE index_no = '$col1[$row]' AND sub_code = '$sub_code'";
            } elseif(is_null($row_data['marks_att3'])) {
                // Update marks_att3 if it is NULL
                $query = "UPDATE exam SET marks_att3 = '$col2[$row]' WHERE index_no = '$col1[$row]' AND sub_code = '$sub_code'";
            } elseif(is_null($row_data['marks_attsp'])) {
                // Update marks_attsp if it is NULL
                $query = "UPDATE exam SET marks_attsp = '$col2[$row]' WHERE index_no = '$col1[$row]' AND sub_code = '$sub_code'";
            } else {
                // If all columns are filled, log the error
                $errregno[] = $col1[$row];
                $errmarks[] = $col2[$row];
                continue; // Skip the insertion
            }
            $result = mysqli_query($conn, $query);
        }
    
        if(!$result) {
            // Handle the error if the query fails
            echo "Error: " . mysqli_error($conn);
        }
    }
     
      $_SESSION['errregno']=$errregno;
      $_SESSION['errmarks']=$errmarks;
    verify($conn,$result,$uploadFile);
        
        break;
    default:
      
      break;
  }

}

function querygenarator($table){
  $q1="SELECT * ";
  $q2="FROM $table WHERE ";

  $sessionVariables = loadsession();
      extract($sessionVariables);

  if(!empty($regno)){ 
    $q2=$q2." ".$table.".".'reg_no='.$regno.' AND';
   }    
  if(!empty($sub_code)){ 
    $q2=$q2." ".$table.".".'sub_code="'.$sub_code.'" AND';
   }
  if(!empty($level)){ 
    $q2=$q2." ".$table.".".'level='.$level.' AND';
   }    
  if(!empty($month)){ 
    $q2=$q2.'MONTH(date)='.$month.' AND';
   } 
   if(!empty($year)){ 
    $q2=$q2.'YEAR(date)='.$year.' AND';
   }       
  if(!empty($date)){ 
    $q2=$q2." ".$table.".".'date="'.$date.'" AND';
   }
   $q2=$q2.' 1=1 ORDER BY SUBSTRING_INDEX(reg_no, "/", 1) ASC,
          SUBSTRING_INDEX(SUBSTRING_INDEX(reg_no, "/", 2), "/", -1) ASC,
          CAST(SUBSTRING_INDEX(reg_no, "/", -1) AS UNSIGNED) ASC;';  
   $query=$q1.$q2;  
   echo $query;
   return $query;

}

function queryica(){
      $sessionVariables = loadsession();
      extract($sessionVariables);

  $q1="SELECT a.reg_no AS reg_no,a.marks AS ica_1_marks,b.marks AS ica_2_marks,c.marks AS ica_3_marks,a.sub_code AS sub_code
        FROM ica_1 a JOIN ica_2 b ON a.reg_no = b.reg_no
        JOIN ica_3 c ON a.reg_no = c.reg_no";
  $q2=" WHERE ";

  $sessionVariables = loadsession();
      extract($sessionVariables);

  if(!empty($sub_code)){ 
    $q2=$q2.'a.sub_code = "'.$sub_code.'"
        AND b.sub_code = "'.$sub_code.'"
        AND c.sub_code = "'.$sub_code.'"';
   } 
   if(!empty($regno)){ 
    $q2=$q2.'a.reg_no = "'.$regno.'"';  
   } 
   $q2=$q2.' ORDER BY SUBSTRING_INDEX(a.reg_no, "/", 1) ASC,
          SUBSTRING_INDEX(SUBSTRING_INDEX(a.reg_no, "/", 2), "/", -1) ASC,
          CAST(SUBSTRING_INDEX(a.reg_no, "/", -1) AS UNSIGNED) ASC;';
    $query=$q1.$q2;  
    echo $query;
    return $query;    

}
function outputQueryInTable($conn,$query) {
   
  // Execute query
  $result = $conn->query($query);

  // Check if query was successful
  if ($result === FALSE) {
      echo "Error: " . $conn->error;
  } else {
      // Start table
      echo '<table class="table bg-white">';
      
      // Output table headers
      echo '<thead class="bg-dark text-light">';
      echo '<tr>';
      while ($field = $result->fetch_field()) {
          echo '<th>' . htmlspecialchars($field->name) . '</th>';
      }
      echo '</tr>';
      echo '</thead>';

      // Output table rows
      echo '<tbody>';
      while ($row = $result->fetch_assoc()) {
          echo '<tr>';
          foreach ($row as $cell) {
              echo '<td>' . htmlspecialchars($cell) . '</td>';
          }
          echo '</tr>';
      }
      echo '</tbody>';
      // End table
      echo '</table>';
  }
  unsetsession();
  // Close connection
  $conn->close();
}
?>
<!-- for($row=0; $row<$highestRow-1; $row++){
        $qtest="SELECT marks_att1 FROM exam WHERE index_no='$col1[$row]' AND sub_code='$sub_code' ";
        $rtest=mysqli_query($conn,$qtest);
        if(!$rtest){
            $query="INSERT INTO exam VALUES ('$col1[$row]','$col2[$row]',NULL,NULL,NULL,'$sub_code')";
            $result=mysqli_query($conn,$query);
        }else{
            $qtest="SELECT marks_att1,marks_att2, FROM exam WHERE index_no='$col1[$row]' AND sub_code='$sub_code' ";
            $rtest=mysqli_query($conn,$qtest);
            if(!$rtest){
                $query="UPDATE exam SET marks_att2= '$col2[$row]' WHERE index_no='$col1[$row]'";
                $result=mysqli_query($conn,$query);
            }else{
                $qtest="SELECT marks_att1,marks_att2,marks_att3 FROM exam WHERE index_no='$col1[$row]' AND sub_code='$sub_code' ";
                $rtest=mysqli_query($conn,$qtest);
                if(!$rtest){
                    $query="UPDATE exam SET marks_att3= '$col2[$row]' WHERE index_no='$col1[$row]'";
                    $result=mysqli_query($conn,$query);
                }else{
                    $qtest="SELECT marks_att1,marks_att2,marks_att3,marks_attsp FROM exam WHERE index_no='$col1[$row]' AND sub_code='$sub_code' ";
                    $rtest=mysqli_query($conn,$qtest);
                    if(!$rtest){
                        $query="UPDATE exam SET marks_attsp= '$col2[$row]' WHERE index_no='$col1[$row]'";
                        $result=mysqli_query($conn,$query);
                    }else{
                        $errregno[]=$col1[$row];
                        $errmarks[]=$col2[$row];
                  }
              }
            }
        } 
      } -->