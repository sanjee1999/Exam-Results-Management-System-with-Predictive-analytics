<script src="../script/confirm.js">
    </script>   
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
  unset($_SESSION['year']);
  unset($_SESSION['month']);
  unset($_SESSION['sub_code']);
  unset($_SESSION['sub_type']);
  unset($_SESSION['regno']);
  unset($_SESSION['attend']);
  unset($_SESSION['index_no']);
  unset($_SESSION['level']);
  unset($_SESSION['batch']);
  unset($_SESSION['sem']);
  unset($_SESSION['dep']);
  unset($_SESSION['course']);
  unset($_SESSION['firstRow']);
  unset($_SESSION['col1']);
  unset($_SESSION['col2']);
  unset($_SESSION['highestRow']);
  unset($_SESSION['type']);
  unset($_SESSION['heading']);
  unset($_SESSION['ica']);
  unset($_SESSION['uploadfile']);
  
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
  function queryInAll($conn, $table, ...$values) {
    // Ensure the connection is valid before proceeding
    if (!$conn || $conn->connect_errno) {
        echo "<script type='text/javascript'>alert('Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error . "');</script>";
        return;
    }

    // Escape values to prevent SQL injection
    $escapedValues = array_map(function($value) use ($conn) {
        return $conn->real_escape_string($value);
    }, $values);

    // Prepare the values part of the query
    $valuesString = "'" . implode("','", $escapedValues) . "'";

    // Construct the query
    $query = "INSERT INTO `$table` VALUES ($valuesString)";

    // Execute the query
    if ($conn->query($query) === TRUE) {
        echo "<script type='text/javascript'>alert('New record created successfully');</script>";
        echo "<script type='text/javascript'>window.location.href = '../Dashboard/Sider.php?content=../pages/viewEdit.php&table=$table';</script>";
    } else {
        echo "<script type='text/javascript'>alert('Error: " . addslashes($conn->error) . "');</script>";
        throw new Exception('Error: ' . $conn->error);
    }

    // Close the connection
    $conn->close();
}



function queryUpAll($conn, $table, $whereColumn, $whereValue, array $updateColumns, ...$values) {
  // Ensure the number of columns matches the number of values
  if (count($updateColumns) != count($values)) {
      throw new Exception('The number of columns does not match the number of values.');
  }

  // Escape the where value to prevent SQL injection
  $escapedWhereValue = $conn->real_escape_string($whereValue);

  // Escape the values to prevent SQL injection
  $escapedValues = array_map([$conn, 'real_escape_string'], $values);

  // Prepare the SET part of the query
  $setString = "";
  foreach ($updateColumns as $index => $column) {
      $escapedColumn = $conn->real_escape_string($column);
      $setString .= "`$escapedColumn` = '{$escapedValues[$index]}', ";
  }
  $setString = rtrim($setString, ', ');

  // Construct the query
  $query = "UPDATE `$table` SET $setString WHERE `$whereColumn` = '$escapedWhereValue'";
echo $query;
  // Execute the query
  if ($conn->query($query) === TRUE) {
      echo "<script type='text/javascript'>alert('Record updated successfully');</script>";
      echo "<script type='text/javascript'>window.location.href = '../Dashboard/Sider.php?content=../pages/viewEdit.php&table=$table';</script>";
  } else {
      echo "<script type='text/javascript'>alert('Error: " . addslashes($conn->error) . "');</script>";
      throw new Exception('Error: ' . $conn->error);
  }

  // Close the connection
  $conn->close();
}

function query1InAll($conn, $table, ...$values) {
  // Ensure the connection is valid before proceeding
  if (!$conn || $conn->connect_errno) {
      echo "<script type='text/javascript'>alert('Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error . "');</script>";
      return;
  }

  // Escape values to prevent SQL injection
  $escapedValues = array_map(function($value) use ($conn) {
      return $conn->real_escape_string($value);
  }, $values);

  // Prepare the values part of the query
  $valuesString = "'" . implode("','", $escapedValues) . "'";

  // Construct the query
  $query = "INSERT INTO `$table` VALUES ($valuesString)";

  // Execute the query
  if ($conn->query($query) === TRUE) {
      echo "<script type='text/javascript'>alert('New record created successfully');</script>";
  } else {
      echo "<script type='text/javascript'>alert('Error: " . addslashes($conn->error) . "');</script>";
  }
}


function query1UpAll($conn, $table, $whereColumn, $whereValue, array $updateColumns, ...$values) {
  // Ensure the number of columns matches the number of values
  if (count($updateColumns) != count($values)) {
      throw new Exception('The number of columns does not match the number of values.');
  }

  // Escape the where value to prevent SQL injection
  $escapedWhereValue = $conn->real_escape_string($whereValue);

  // Escape the values to prevent SQL injection
  $escapedValues = array_map([$conn, 'real_escape_string'], $values);

  // Prepare the SET part of the query
  $setString = "";
  foreach ($updateColumns as $index => $column) {
      $escapedColumn = $conn->real_escape_string($column);
      $setString .= "`$escapedColumn` = '{$escapedValues[$index]}', ";
  }
  $setString = rtrim($setString, ', ');

  // Construct the query
  $query = "UPDATE `$table` SET $setString WHERE `$whereColumn` = '$escapedWhereValue'";

  // Execute the query
  if ($conn->query($query) === TRUE) {
      echo "<script type='text/javascript'>alert('Record updated successfully');</script>";
  } else {
      echo "<script type='text/javascript'>alert('Error: " . addslashes($conn->error) . "');</script>";
      throw new Exception('Error: ' . $conn->error);
      
  }
      
}


function queryjoin($conn,$table,$table1,$tcol,$t1col){
  $query="SELECT * FROM `$table` LEFT JOIN `$table1` ON $table.$tcol=$table1.$t1col";
  echo $query."<br>";
  $result=mysqli_query($conn,$query);
  $row = $result->fetch_row();
  print_r($row);
  echo "<br>".$row[7];
  return $query;
}
  
function jsheader($url){
  echo "<script type='text/javascript'>window.location.href = '$url';</script>";
}

function loadsession(){
    $date = isset($_SESSION['date']) ? $_SESSION['date'] : null;
    $time = isset($_SESSION['time']) ? $_SESSION['time'] : null;
    $hour = isset($_SESSION['hour']) ? $_SESSION['hour'] : null;
    $year = isset($_SESSION['year']) ? $_SESSION['year'] : null;
    $month = isset($_SESSION['month']) ? $_SESSION['month'] : null;
    $sub_code = isset($_SESSION['sub_code']) ? $_SESSION['sub_code'] : null;
    $sub_type = isset($_SESSION['sub_type']) ? $_SESSION['sub_type'] : null;
    $regno = isset($_SESSION['regno']) ? $_SESSION['regno'] : null;
    $attend = isset($_SESSION['attend']) ? $_SESSION['attend'] : null;
    $index_no = isset($_SESSION['index_no']) ? $_SESSION['index_no'] : null;
    $level = isset($_SESSION['level']) ? $_SESSION['level'] : null;
    $batch = isset($_SESSION['batch']) ? $_SESSION['batch'] : null;
    $sem = isset($_SESSION['sem']) ? $_SESSION['sem'] : null;
    $dep = isset($_SESSION['dep']) ? $_SESSION['dep'] : null;
    $course = isset($_SESSION['course']) ? $_SESSION['course'] : null;
    $firstRow = isset($_SESSION['firstRow']) ? $_SESSION['firstRow'] : null;
    $col1 = isset($_SESSION['col1']) ? $_SESSION['col1'] : null;
    $col2 = isset($_SESSION['col2']) ? $_SESSION['col2'] : null;
    $highestRow = isset($_SESSION['highestRow']) ? $_SESSION['highestRow'] : null;
    $type = isset($_SESSION['type']) ? $_SESSION['type'] : null;
    $heading = isset($_SESSION['heading']) ? $_SESSION['heading'] : null;
    $ica = isset($_SESSION['ica']) ? $_SESSION['ica'] : null;
    $uploadFile = isset($_SESSION['uploadfile']) ? $_SESSION['uploadfile'] : null;
          
      return compact('date', 'time', 'hour', 'year','month','sub_code','sub_type' ,
                    'regno','attend','index_no','level', 'batch','sem','dep','course','firstRow', 'col1', 'col2', 'highestRow', 
                    'type', 'heading', 'ica', 'uploadFile');

}

function upload($conn){
      
      $sessionVariables = loadsession();
      extract($sessionVariables);
      //$col1=strtoupper($col1);
      $col1 = array_map('strtoupper', $col1);

  switch($type){
    
    case 'attendance':
      for($row=0; $row<$highestRow-1; $row++){
        if(empty($col1[$row]) || $col1[$row] == '0' || empty($col2[$row]) || $col2[$row] == '0'){
          continue;
        }
        $query="INSERT INTO attendance VALUES ('$col1[$row]','$date','$time','$hour','$sub_code','$col2[$row]','$sub_type')";
        $result=mysqli_query($conn,$query);
      }
       verify($conn,$result,$uploadFile) ;
      break;

    case 'ica':

      switch($ica){
        case 'ica1':
            for($row=0; $row<$highestRow-1; $row++){
              if(empty($col2[$row]) && $col2[$row] !== '0' && $col2[$row] !== 0){
                continue;
              }
              $query="INSERT INTO ica_1 VALUES ('$col1[$row]','$col2[$row]','$sub_code','$sub_type')";
              $result=mysqli_query($conn,$query);
            }
            verify($conn,$result,$uploadFile) ;
          break;

        case 'ica2':
          for($row=0; $row<$highestRow-1; $row++){
            if(empty($col2[$row]) && $col2[$row] !== '0' && $col2[$row] !== 0){
              continue;
            }
            $query="INSERT INTO ica_2 VALUES ('$col1[$row]','$col2[$row]','$sub_code','$sub_type')";
            $result=mysqli_query($conn,$query);
            }
            verify($conn,$result,$uploadFile) ;

          break;

        case 'ica3':
          for($row=0; $row<$highestRow-1; $row++){
            if(empty($col2[$row]) && $col2[$row] !== '0' && $col2[$row] !== 0){
              continue;
            }
            $query="INSERT INTO ica_3 VALUES ('$col1[$row]','$col2[$row]','$sub_code','$sub_type')";
            $result=mysqli_query($conn,$query);
          }
          verify($conn,$result,$uploadFile) ;
          break;

        case 'ica4':
          for($row=0; $row<$highestRow-1; $row++){
            if(empty($col2[$row])){
              continue;
            }
            $query="INSERT INTO ica_4 VALUES ('$col1[$row]','$col2[$row]','$sub_code','$sub_type')";
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
        if(empty($col2[$row]) && $col2[$row] !== '0' && $col2[$row] !== 0){
          continue;
        }

        $qtest = "SELECT marks_att1, marks_att2, marks_att3, marks_attsp 
                  FROM exam 
                  WHERE index_no = '$col1[$row]' 
                  AND sub_code = '$sub_code'
                  AND sub_type = '$sub_type'";
        $rtest = mysqli_query($conn, $qtest);
                
        if(mysqli_num_rows($rtest) == 0 ) {
            // Insert a new row if no matching row is found
            $query = "INSERT INTO exam VALUES ('$col1[$row]', '$col2[$row]', NULL, NULL, NULL, '$sub_code','$sub_type')";
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

function tableViewEdit($conn, $query, $idcol, $i) {
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
      echo '<th>Actions</th>'; // Add header for actions column
      echo '</tr>';
      echo '</thead>';

      // Output table rows
      echo '<tbody>';
      $formCounter = 0; // Counter to create unique form IDs
      while ($row = $result->fetch_row()) {
          $formId = 'form' . $formCounter; // Generate a unique form ID
          echo '<tr>';
          foreach ($row as $cell) {
              echo '<td>' . htmlspecialchars($cell) . '</td>';
          }
          // Create the form with a unique ID
          
          echo '<td><form id="' . $formId . '" action="" method="post">
                  <input type="hidden" name="id" value="' . htmlspecialchars($row[$i]) . '">
                  <input type="hidden" name="idcol" value="' . htmlspecialchars($idcol) . '">
                  <input type="hidden" name="action" id="action_' . $formId . '" value="">';
          echo '<button class="btn btn-primary" type="button" onclick="updateRecord(\'' . $formId . '\')">Update</button>';
          echo '<button class="btn btn-danger" type="button" onclick="confirmDelete(event, \'' . $formId . '\')">Delete</button>';
          echo '</form></td>';
          echo '</tr>';

          $formCounter++;
      }
      echo '</tbody>';
      // End table
      echo '</table>';
  }

  // Close connection
  $conn->close();
}

function tableView1Edit($conn,$query,$idcol,$i) {
   
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
      while ($row = $result->fetch_row()) {
          echo '<tr>';
          foreach ($row as $cell) {
              echo '<td>' . htmlspecialchars($cell) . '</td>';
          }
          // echo '<td><form action="" method="post" onsubmit="return confirmDelete();">
          echo '<td><form id="myForm" action="" method="post">
                <input type="hidden" name="id" value="'.$row[$i].'">
                <input type="hidden" name="idcol" value="'.$idcol.'">
                <input type="hidden" name="action" id="action" value="">';
          echo '<button class="btn btn-primary" type="button" onclick="updateRecord()">Update</button></td>';
          echo '<td><button class="btn btn-primary" type="button" onclick="confirmDelete(event)">Delete</button></form></td>';
          
          //echo '<td><button class="btn btn-primary">Delete</button></td>';
          // echo '<td><a href="" class="btn btn-primary">Update</a></td><td><a href="" class="btn btn-primary">Delete</a></td>';
          echo '</tr>';
      }
      echo '</tbody>';
      // End table
      echo '</table>';
  }
  $result = $conn->query($query);
  $row = $result->fetch_row();
  print_r($row);
  //echo "<br>".$row[7];
  unsetsession();
  // Close connection
  $conn->close();
  
}

function filehub($table) {
  switch($table) {
      case 'course':
          return 'AddCourse.php';
      case 'department':
          return 'AddDep.php';
      case 'faculty':
          return 'AddFaculty.php';
      case 'subject':
          return 'AddSub.php';  
      case 'lecture':
          return 'AddLec.php';  
  }
}
function uptablerow($conn,$file,$table,$idcol,$id){
    $query="SELECT * FROM $table WHERE $idcol='$id'";
    $result = $conn->query($query);
    $row = $result->fetch_row();
    header('location:../Dashboard/Sider.php?content=../pages/'.$file.'&type=Update&data=' . urlencode(serialize($row)));
}

function deltablerow($conn,$table,$idcol,$id){

  $query="DELETE FROM $table WHERE $idcol='$id'";
  echo "$query  ";
  $result = $conn->query($query);

  // Check if query was successful
  if ($result === FALSE) {
      echo "Error: " . $conn->error;
  } 
}

function up2tablerow($conn,$file,$table,$table1,$tcol,$t1col,$idcol,$id){
    $query="SELECT * FROM `$table` JOIN `$table1` ON $table.$tcol=$table1.$t1col WHERE $table.$idcol='$id' AND $table1.$idcol='$id'";
    echo "<br>$query<br>";
    $result = $conn->query($query);
    $row = $result->fetch_row();
    header('location:../Dashboard/Sider.php?content=../pages/'.$file.'&type=Update&table=lecture&table1=admin&data=' . urlencode(serialize($row)));
}

function del2tablerow($conn,$table,$table1,$idcol,$id){

  $query="DELETE FROM $table WHERE $idcol='$id'";
  $query1="DELETE FROM $table1 WHERE $idcol='$id'";
  echo "$query  <br>";
  echo "$query1  <br>";

  $result = $conn->query($query);
  // Check if query was successful
  if ($result === FALSE) {
      echo "Error: " . $conn->error;
  } 
  $result = $conn->query($query1);
  // Check if query was successful
  if ($result === FALSE) {
      echo "Error: " . $conn->error;
  } 
}


function queryattend() {
  $q1 = "SELECT at.reg_no AS Reg_No, 
          at.date AS Date, at.time AS Time, 
          at.hour AS Hours, at.sub_code AS Sub_Code,
          at.sub_type as Subject_type, at.attendance AS Attendance";
          
  $q2 = " FROM attendance at 
          LEFT JOIN subject su ON at.sub_code = su.sub_code 
          LEFT JOIN student st ON at.reg_no = st.reg_no 
          LEFT JOIN course co ON co.course_id = su.course_id 
          LEFT JOIN department de ON de.dep_id = co.dep_id";

  $q3 = " WHERE 1=1";  // Using "1=1" to simplify appending AND conditions

  $sessionVariables = loadsession();
  extract($sessionVariables);

  if (!empty($regno)) { 
      $q3 .= " AND at.reg_no = '$regno'";
  }    
  if (!empty($sub_code)) { 
      $q3 .= " AND at.sub_code = '$sub_code'";
  }
  if (!empty($sub_type)) { 
      $q3 .= " AND at.sub_type = '$sub_type'";
  }  
  if (!is_null($attend)) { 
      $q3 .= " AND at.attendance = '$attend'";
  }  
  if (!empty($month)) { 
      $q3 .= " AND MONTH(at.date) = '$month'";
  } 
  if (!empty($year)) { 
      $q3 .= " AND YEAR(at.date) = '$year'";
  }       
  if (!empty($date)) { 
      $q3 .= " AND at.date = '$date'";
  }
  if (!empty($level)) { 
      $q1 .= ", su.level AS Level";
      $q3 .= " AND su.level = '$level'";
  }  
  if (!empty($batch)) { 
      $q1 .= ", st.batch AS Batch";
      $q3 .= " AND st.batch = '$batch'";
  }
  if (!empty($sem)) { 
      $q1 .= ", su.semester AS Semester";
      $q3 .= " AND su.semester = '$sem'";
  }
  if (!empty($course)) { 
      $q1 .= ", co.name AS Course";
      $q3 .= " AND co.name = '$course'";
  }
  if (!empty($dep)) { 
      $q1 .= ", de.name AS Department";
      $q3 .= " AND de.name = '$dep'";
  }

  $orderBy = ' ORDER BY SUBSTRING_INDEX(at.reg_no, "/", 1) ASC,
               SUBSTRING_INDEX(SUBSTRING_INDEX(at.reg_no, "/", 2), "/", -1) ASC,
               CAST(SUBSTRING_INDEX(at.reg_no, "/", -1) AS UNSIGNED) ASC';

  $query = $q1 . $q2 . $q3 . $orderBy;
  echo $query;
  return $query;
}

function queryica() {
  $q1 = "SELECT st.reg_no AS reg_no";
  $q2 = " FROM ica_1 i1
           LEFT JOIN ica_2 i2 ON i1.reg_no = i2.reg_no AND i1.sub_code = i2.sub_code
           LEFT JOIN ica_3 i3 ON i1.reg_no = i3.reg_no AND i1.sub_code = i3.sub_code
           LEFT JOIN student st ON i1.reg_no = st.reg_no
           LEFT JOIN course co ON st.course_id = co.course_id
           LEFT JOIN department de ON co.dep_id = de.dep_id
           LEFT JOIN subject su ON i1.sub_code = su.sub_code";
  $q3 = " WHERE 1=1"; // Using "1=1" to simplify appending AND conditions

  $sessionVariables = loadsession();
  extract($sessionVariables);

  // ICA handling
  if (!empty($ica)) {
      foreach ($ica as $icaType) {
          if ($icaType == 'ica1') {
              $q1 .= ", i1.marks AS ica_1_marks";
          } 
          if ($icaType == 'ica2') {
              $q1 .= ", i2.marks AS ica_2_marks";
          } 
          if ($icaType == 'ica3') {
              $q1 .= ", i3.marks AS ica_3_marks";
          }
      }
  }

  // Additional conditions
  if (!empty($sub_code)) { 
      $q3 .= " AND (i1.sub_code = '$sub_code' OR i2.sub_code = '$sub_code' OR i3.sub_code = '$sub_code')";
  }
  if (!empty($sub_type)) { 
      $q3 .= " AND (i1.sub_type = '$sub_type' OR i2.sub_type = '$sub_type' OR i3.sub_type = '$sub_type')";
  } 
  if (!empty($regno)) { 
      $q3 .= " AND (i1.reg_no = '$regno' OR i2.reg_no = '$regno' OR i3.reg_no = '$regno')";
  }
  if (!empty($level)) {
      $q1 .= ", su.level AS level";
      $q3 .= " AND su.level = '$level'";
  }
  if (!empty($batch)) {
      $q1 .= ", st.batch AS batch";
      $q3 .= " AND st.batch = '$batch'";
  }
  if (!empty($dep)) {
      $q1 .= ", de.name AS department";
      $q3 .= " AND de.name = '$dep'";
  }
  if (!empty($course)) {
      $q1 .= ", co.name AS course";
      $q3 .= " AND co.name = '$course'";
  }
  if (!empty($sem)) {
      $q1 .= ", su.semester AS semester";
      $q3 .= " AND su.semester = '$sem'";
  }

  $orderBy = ' ORDER BY 
               SUBSTRING_INDEX(st.reg_no, "/", 1) ASC,
               SUBSTRING_INDEX(SUBSTRING_INDEX(st.reg_no, "/", 2), "/", -1) ASC,
               CAST(SUBSTRING_INDEX(i1.reg_no, "/", -1) AS UNSIGNED) ASC';

  $query = $q1 . $q2 . $q3 . $orderBy;
  echo $query;
  return $query;
}

function queryfinal(){
    $q1 = "SELECT ex.index_no AS index_no, 
            ind.reg_no AS reg_no, 
            ex.marks_att1 AS marks_att1,
            ex.marks_att2 AS marks_att2, 
            ex.marks_att3 AS marks_att3, 
            ex.marks_attsp AS marks_attsp, 
            ex.sub_code AS sub_code,
            ex.sub_type AS sub_type";

    $q2 = " FROM exam ex
             LEFT JOIN index_no ind ON ex.index_no = ind.index_no
             LEFT JOIN student st ON ind.reg_no = st.reg_no
             LEFT JOIN course co ON st.course_id = co.course_id
             LEFT JOIN department de ON co.dep_id = de.dep_id
             LEFT JOIN subject su ON ex.sub_code = su.sub_code";
    $q3 = " WHERE 1=1"; // Using "1=1" to simplify appending AND conditions

    $sessionVariables = loadsession();
    extract($sessionVariables);

    // Additional conditions
    if (!empty($sub_code)) { 
        $q3 .= " AND ex.sub_code = '$sub_code'";
    } 
    if (!empty($sub_type)) { 
        $q3 .= " AND ex.sub_type = '$sub_type'";
    } 
    if (!empty($regno)) { 
        $q3 .= " AND ind.reg_no = '$regno'";  
    }
    if (!empty($index_no)) { 
        $q3 .= " AND ex.index_no = '$index_no'";  
    }
    if (!empty($level)) {
        $q1 .= ", st.level AS level";
        $q3 .= " AND st.level = '$level'";
    }
    if (!empty($batch)) {
        $q1 .= ", st.batch AS batch";
        $q3 .= " AND st.batch = '$batch'";
    }
    if (!empty($dep)) {
        $q1 .= ", de.name AS department";
        $q3 .= " AND de.name = '$dep'";
    }
    if (!empty($course)) {
        $q1 .= ", co.name AS course";
        $q3 .= " AND co.name = '$course'";
    }
    if (!empty($sem)) {
        $q1 .= ", su.semester AS semester";
        $q3 .= " AND su.semester = '$sem'";
    }

    $orderBy = ' ORDER BY 
                 SUBSTRING_INDEX(ind.reg_no, "/", 1) ASC,
                 SUBSTRING_INDEX(SUBSTRING_INDEX(ind.reg_no, "/", 2), "/", -1) ASC,
                 CAST(SUBSTRING_INDEX(ind.reg_no, "/", -1) AS UNSIGNED) ASC';

    $query = $q1 . $q2 . $q3 . $orderBy;
    echo $query;
    return $query;
}

function infill($out){
  if(!is_null($out)){
    echo $out;
  }
}

function opfill($val){
  //echo "<option value='" . htmlspecialchars($val) . "'>" . htmlspecialchars($name) . "</option>";
  $_SESSION['value']=isset($val)?$val:null;
  echo "load";
}

function optiongen($conn, $table, $val,$name) {
  // Properly construct the SQL query
  $query = "SELECT `$val`,`$name` FROM `$table`";
  $result = $conn->query($query);
  
  $val_o = isset($_SESSION['value']) ? $_SESSION['value'] : null;
echo $val_o;
  //$name_o = isset($_SESSION['value']) ? $_SESSION['value'] : null;

  if ($result->num_rows > 0) {
      // Loop through each row
      while ($row = $result->fetch_row()) {
          // Properly fetch the column value
          $val = $row[0];
          $name = $row[1];
          echo "<option value='" . htmlspecialchars($val) . "'";
          if ($val == $val_o) {
            echo " selected";
          }
          echo ">" . htmlspecialchars($name) . "</option>";
        }
      unset($_SESSION['value']);
  } 
}



function queryGenTable($table){
  $query="SELECT * FROM ".$table;
  return $query;
}
function queryicaa(){
      $sessionVariables = loadsession();
      extract($sessionVariables);

  // $q1="SELECT a.reg_no AS reg_no,a.marks AS ica_1_marks,b.marks AS ica_2_marks,c.marks AS ica_3_marks,a.sub_code AS sub_code
  //       FROM ica_1 a JOIN ica_2 b ON a.reg_no = b.reg_no
  //       JOIN ica_3 c ON a.reg_no = c.reg_no";
  $q1="SELECT i1.reg_no AS reg_no,i1.marks AS ica_1_marks,i2.marks AS ica_2_marks,i3.marks AS ica_3_marks,i1.sub_code AS sub_code
        FROM ica_1 i1 JOIN ica_2 i2 ON i1.reg_no = i2.reg_no
        JOIN ica_3 i3 ON i1.reg_no = i3.reg_no";
  $q2=" WHERE ";

  $sessionVariables = loadsession();
      extract($sessionVariables);

  if(!empty($sub_code)){ 
    $q2=$q2.'i1.sub_code = "'.$sub_code.'"
        AND i2.sub_code = "'.$sub_code.'"
        AND i3.sub_code = "'.$sub_code.'" AND ';
   } 
   if(!empty($regno)){ 
    $q2=$q2.'i1.reg_no = "'.$regno.'" AND ';  
   } 
   $q2=$q2.'1=1 ORDER BY SUBSTRING_INDEX(i1.reg_no, "/", 1) ASC,
          SUBSTRING_INDEX(SUBSTRING_INDEX(i1.reg_no, "/", 2), "/", -1) ASC,
          CAST(SUBSTRING_INDEX(i1.reg_no, "/", -1) AS UNSIGNED) ASC;';
    $query=$q1.$q2;  
    echo $query;
    return $query;    

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