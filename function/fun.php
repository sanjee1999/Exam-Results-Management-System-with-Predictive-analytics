<?php 

function colourGen(){
    ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);
   error_reporting(E_ALL);
   
   debug("User type: " . $_SESSION['user_type'] . "<br>") ;
   
   // Define primary and secondary colors for each user type
   $userColors = [
    'hod' => [
        'primary' => '#4B0082',   // Indigo for HOD
        'secondary' => '#9370DB'  // Medium Purple for HOD
    ],
    'lec' => [
        'primary' => '#008080',   // Teal for Lecture
        'secondary' => '#20B2AA'  // Light Sea Green for Lecture
    ],
    'superadmin' => [
        'primary' => '#2E8B57',   // Sea Green for Super Admin
        'secondary' => '#3CB371'  // Medium Sea Green for Super Admin
    ]
   ];
   
   $userType = $_SESSION['user_type'];
   if (!isset($userColors[$userType])) {
       echo "Invalid user type.";
       exit;
   }
   
   $primaryColor = $userColors[$userType]['primary'];
   $secondaryColor = $userColors[$userType]['secondary'];
   
   debug("Primary Color: $primaryColor<br>");
   debug("Secondary Color: $secondaryColor<br>");
   
   // Load the existing CSS file content
   $cssFilePath = '../Dashboard/Sider.css';
   if (!file_exists($cssFilePath)) {
       echo "CSS file does not exist.";
       exit;
   }
   
   $cssContent = file_get_contents($cssFilePath);
   
   // Replace the primary and secondary color placeholders
   $cssContent = preg_replace('/--primary-color: #[a-fA-F0-9]{6};/', "--primary-color: $primaryColor;", $cssContent);
   $cssContent = preg_replace('/--secondary-color: #[a-fA-F0-9]{6};/', "--secondary-color: $secondaryColor;", $cssContent);
   
   // Write the updated content back to the CSS file
   file_put_contents($cssFilePath, $cssContent);
   
   debug("CSS file updated.");
}
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
function debug($msg){
    if($_SESSION['debug']){
        echo "$msg";
    }

}

function logout(){
    session_unset();
    session_destroy();
    header('Location: ../pages/login.php');
    exit();
}
function passwordhash($password){
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    return $password_hash;
}

function isAuthenticated() {
    return isset($_SESSION['user']);
    
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
  unset($_SESSION['col3']);
  unset($_SESSION['col4']);
  unset($_SESSION['col5']);
  unset($_SESSION['col6']);
  unset($_SESSION['highestRow']);
  unset($_SESSION['type']);
  unset($_SESSION['heading']);
  unset($_SESSION['ica']);
  unset($_SESSION['uploadfile']);
  unset($_SESSION['graph']);
  
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
  echo debug($query)."<br>";
  //$result=mysqli_query($conn,$query);
  //$row = $result->fetch_row();
  //debug(print_r($row));
  //debug("<br>".$row[7]) ;
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
    $col3 = isset($_SESSION['col3']) ? $_SESSION['col3'] : null;
    $col4 = isset($_SESSION['col4']) ? $_SESSION['col4'] : null;
    $col5 = isset($_SESSION['col5']) ? $_SESSION['col5'] : null;
    $col6 = isset($_SESSION['col6']) ? $_SESSION['col6'] : null;
    $highestRow = isset($_SESSION['highestRow']) ? $_SESSION['highestRow'] : null;
    $type = isset($_SESSION['type']) ? $_SESSION['type'] : null;
    $heading = isset($_SESSION['heading']) ? $_SESSION['heading'] : null;
    $ica = isset($_SESSION['ica']) ? $_SESSION['ica'] : null;
    $uploadFile = isset($_SESSION['uploadfile']) ? $_SESSION['uploadfile'] : null;
    $graph = isset($_SESSION['graph']) ? $_SESSION['graph'] : null;
          
      return compact('date', 'time', 'hour', 'year','month','sub_code','sub_type' ,
                    'regno','attend','index_no','level', 'batch','sem','dep','course','firstRow', 
                    'col1', 'col2','col3','col4','col5','col6', 
                    'highestRow', 'type', 'heading', 'ica', 'uploadFile','graph');

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
    case 'student':
        for($row=0; $row<$highestRow-1; $row++){
            // if(empty($col1[$row]) || $col1[$row] == '0' || empty($col2[$row]) || $col2[$row] == '0'){
            //     echo "stop loop";
            //   continue;
            // }
            $query1="INSERT INTO student VALUES ('$col1[$row]','$col3[$row]','$col4[$row]','$col5[$row]','$col6[$row]','$course','$batch')";
            $result1=mysqli_query($conn,$query1);
            $query2="INSERT INTO index_no VALUES ('$col2[$row]','$col1[$row]')";
            $result2=mysqli_query($conn,$query2);
          }
          $result1 = isset($result1) ? $result1 : null;
          $result2 = isset($result2) ? $result2 : null;
        if($result1 && $result2){
            $result=true;
        }else{
            $result=false;
        }
           verify($conn,$result,$uploadFile) ;
        break;
    default:
      
      break;
  }

}

function outputQueryInChart($conn,$query){
    $result = $conn->query($query);
    $label = [];
    $value = [];
    while($row = $result->fetch_assoc()) {
        $label[] = $row['Reg_No'];
        $value[] = $row['Attendance'];
      }
      echo "<canvas id='myChart'></canvas>
      <script>
      const ctx = document.getElementById('myChart').getContext('2d');
    
      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: " . json_encode($label) . ",
          datasets: [
            {
              label: 'Predicted marks',
              data: " . json_encode($value) . ",
              fill: true,
              backgroundColor: 'rgba(176, 139, 241, 0.5)', // Set background color with 50% opacity
              borderColor: '#884DEE',
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
    </script>";
    
$conn->close();

return $result;
}
function outputQueryInTable($conn, $query, $table, $column) {
    $result = $conn->query($query);
    $table_col=[];
    if ($result === FALSE) {
        echo "Error: " . $conn->error;
    } else {
        echo '<table class="table bg-white">';
        echo '<thead class="bg-dark text-light">';
        echo '<tr>';
        while ($field = $result->fetch_field()) {
            if ($field->name == $column) {
                continue; // Skip the column specified in $excludeCol
            }
            $table_col[] = $field->name;
            echo '<th>' . htmlspecialchars($field->name) . '</th>';
        }
        echo '<th>Action</th>';
        echo '</tr>';
        echo '</thead>';
        $columnsString = "['" . implode("', '", $table_col) . "']";
        echo '<tbody>';
        while ($row = $result->fetch_assoc()) {
            $id = $row['record_key']; // Assuming 'id' is the unique identifier
            echo '<tr data-id="' . $id . '">';
            foreach ($row as $columns => $cell) {
                if ($columns == $column) {
                    continue; // Skip the column specified in $excludeCol
                }
                echo '<td>' . htmlspecialchars($cell) . '</td>';
            }
            echo '<td>
                    <button class="btn btn-danger btn-sm" onclick="openUpdateModal(' . $id . ', \'' . $table . '\', \'' . $column . '\', \'' . $columnsString . '\')">Update</button>
                    <button class="btn btn-danger btn-sm" onclick="deleteRow(' . $id . ', \'' . $table . '\', \'' . $column . '\')">Delete</button>
                  </td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    }
    $conn->close();
}
function outputQueryInTablekkk($conn,$query) {
   
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

function tableViewEditlot($conn, $query, $idcol, $i, $excludeCol) {
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
            if ($field->name == $excludeCol) {
                continue; // Skip the column specified in $excludeCol
            }
            echo '<th>' . htmlspecialchars($field->name) . '</th>';
        }
        echo '<th>Actions</th>'; // Add header for actions column
        echo '</tr>';
        echo '</thead>';

        // Output table rows
        echo '<tbody>';
        $formCounter = 0; // Counter to create unique form IDs
        while ($row = $result->fetch_assoc()) {
            $formId = 'form' . $formCounter; // Generate a unique form ID
            echo '<tr>';
            foreach ($row as $column => $cell) {
                if ($column == $excludeCol) {
                    continue; // Skip the column specified in $excludeCol
                }
                echo '<td>' . htmlspecialchars($cell) . '</td>';
            }

            // Create the form with a unique ID
            echo '<td><form id="' . $formId . '" action="" method="post">
                    <input type="hidden" name="id" value="' . htmlspecialchars($row[$idcol]) . '">
                    <input type="hidden" name="idcol" value="' . htmlspecialchars($idcol) . '">
                    <input type="hidden" name="action" id="action_' . $formId . '" value="">';
            echo '<button class="btn btn-danger btn-sm" type="button" onclick="updateRecord(\'' . $formId . '\')">Update</button>';
            echo '<button class="btn btn-danger btn-sm" type="button" onclick="confirmDelete(event, \'' . $formId . '\')">Delete</button>';
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

function comboMarksquery($sub_code,$sub_type,$batch){
    $query = "SELECT 
                    st.reg_no AS reg_no, 
                    ind.index_no AS index_no,
                    su.sub_code AS sub_code,
                    i1.marks AS ICA_1,
                    i2.marks AS ICA_2,
                    i3.marks AS ICA_3,
                    ex.marks_att1 AS marks_att1,
                    ex.marks_att2 AS marks_att2, 
                    ex.marks_att3 AS marks_att3, 
                    ex.marks_attsp AS marks_attsp
                FROM 
                    student st
                    LEFT JOIN course co ON co.course_id = st.course_id
                    LEFT JOIN subject su ON su.course_id = co.course_id
                    LEFT JOIN ica_1 i1 ON i1.reg_no = st.reg_no AND i1.sub_code = su.sub_code
                    LEFT JOIN ica_2 i2 ON i2.reg_no = st.reg_no AND i2.sub_code = su.sub_code
                    LEFT JOIN ica_3 i3 ON i3.reg_no = st.reg_no AND i3.sub_code = su.sub_code
                    LEFT JOIN index_no ind ON ind.reg_no = st.reg_no
                    LEFT JOIN exam ex ON ex.index_no = ind.index_no AND ex.sub_code = su.sub_code
                WHERE 
                    st.batch='$batch' 
                    AND ((i1.sub_code='$sub_code' AND i1.sub_type='$sub_type') 
                    OR (i2.sub_code='$sub_code' AND i2.sub_type='$sub_type') 
                    OR (i3.sub_code='$sub_code' AND i3.sub_type='$sub_type') 
                    OR (ex.sub_code='$sub_code' AND ex.sub_type='$sub_type'))
            ";
    return $query;
}
function comboMarks($conn,$sub_code,$batch){

    $q="SELECT practical_credit,theory_credit,pra_ica_ratio,theo_ica_ratio FROM subject WHERE sub_code='$sub_code'";
    $r = mysqli_query($conn, $q);
    $s = mysqli_fetch_row($r);
        $pc=$s[0];
        $tc=$s[1];
        $pir=$s[2];
        $tir=$s[3];

    $practical=0;
    $theory=0;
    
    if(!empty($pc)){
        $sub_type='P';
        $query = comboMarksquery($sub_code,$sub_type,$batch);
            
            // Execute the query and fetch results
            $result = mysqli_query($conn, $query);
            $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
            foreach ($data as &$row) {
                $row['best_ica'] = findBestIca(
                    $row['ICA_1'], 
                    $row['ICA_2'], 
                    $row['ICA_3']
                );
                $row['best_exam'] = findBestExam(
                    $row['marks_att1'], 
                    $row['marks_att2'], 
                    $row['marks_att3'], 
                    $row['marks_attsp']
                );
                $row['practical']=($pir*$row['best_ica']+(100-$pir)*$row['best_exam'] )/100;
            }        
    }
    if(!empty($tc)){
        $sub_type='T';
        $query = comboMarksquery($sub_code,$sub_type,$batch);
            
            // Execute the query and fetch results
            $result = mysqli_query($conn, $query);
            $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
            foreach ($data as &$row) {
                $row['best_ica'] = findBestIca(
                    $row['ICA_1'], 
                    $row['ICA_2'], 
                    $row['ICA_3']
                );
                $row['best_exam'] = findBestExam(
                    $row['marks_att1'], 
                    $row['marks_att2'], 
                    $row['marks_att3'], 
                    $row['marks_attsp']
                );
                $row['theory']=($tir*$row['best_ica']+(100-$tir)*$row['best_exam'] )/100;
            }       
    }
    

    if($pc!==0 || $tc!==0){
        foreach ($data as &$row) {
            $practical = isset($row['practical']) ? $row['practical'] : NULL;
            $theory = isset($row['theory']) ? $row['theory'] : NULL;

            $row['Final_Result'] = ($pc * $practical + $tc * $theory) / ($pc + $tc);     
        } 
    return $data;
    }else{
        echo "Please Ensure subject credits values in db.subject";
    }
} 
function findBestIca($ica1, $ica2, $ica3) {
    // Calculate the best 2 of 3 ICA marks
    $ica_marks = [$ica1, $ica2, $ica3];
    rsort($ica_marks);
    $best_ica_sum = ($ica_marks[0] + $ica_marks[1])/2;
    
   
    return $best_ica_sum ;
}
function findBestExam($att1, $att2, $att3, $attsp) {
   
    // Calculate the best of 4 exam marks 
    $exam_marks = [$att1, $att2, $att3, $attsp];
    $best_exam_mark = max($exam_marks);
    
    // Calculate the final result
    return  $best_exam_mark;
}
function calculateFinalResult($ica1, $ica2, $ica3, $att1, $att2, $att3, $attsp) {
    // Calculate the best 2 of 3 ICA marks
    $ica_marks = [$ica1, $ica2, $ica3];
    rsort($ica_marks);
    $best_ica_sum = $ica_marks[0] + $ica_marks[1];
    
    // Calculate the best of 4 exam marks 
    $exam_marks = [$att1, $att2, $att3, $attsp];
    $best_exam_mark = max($exam_marks);
    
    // Calculate the final result
    return $best_ica_sum + $best_exam_mark;
}


function arrayTable($data) {
    // Check if data is a valid mysqli_result object
    if ($data instanceof mysqli_result) {
        // Start table
        echo '<table class="table bg-white">';
        
        // Output table headers
        echo '<thead class="bg-dark text-light">';
        echo '<tr>';
        $fields = $data->fetch_fields();
        foreach ($fields as $field) {
            echo '<th>' . htmlspecialchars($field->name) . '</th>';
        }
        echo '</tr>';
        echo '</thead>';
        
        // Output table rows
        echo '<tbody>';
        while ($row = $data->fetch_assoc()) {
            echo '<tr>';
            foreach ($row as $cell) {
                echo '<td>' . htmlspecialchars($cell) . '</td>';
            }
            echo '</tr>';
        }
        echo '</tbody>';
        
        // End table
        echo '</table>';
        
    } elseif (is_array($data) && !empty($data)) {
        // Start table
        echo '<table class="table bg-white">';
        
        // Output table headers
        echo '<thead class="bg-dark text-light">';
        echo '<tr>';
        // Assuming all arrays have the same keys, use the first array to get headers
        $headers = array_keys($data[0]);
        foreach ($headers as $header) {
            echo '<th>' . htmlspecialchars($header) . '</th>';
        }
        echo '</tr>';
        echo '</thead>';
        
        // Output table rows
        echo '<tbody>';
        foreach ($data as $row) {
            echo '<tr>';
            foreach ($row as $cell) {
                echo '<td>' . htmlspecialchars($cell) . '</td>';
            }
            echo '</tr>';
        }
        echo '</tbody>';
        
        // End table
        echo '</table>';
        
    } else {
        echo "Error: Invalid Result";
    }
}

function dropColumnsByIndex(&$data, $startIndex, $endIndex) {
    // Check if the data is not empty and the first row exists
    if (empty($data) || !isset($data[0])) {
        return;
    }

    // Get column keys from the first row
    $keys = array_keys($data[0]);

    // Ensure indices are within bounds
    if ($startIndex < 0 || $endIndex >= count($keys)) {
        return;
    }

    // Drop columns from $startIndex to $endIndex
    foreach ($data as &$row) {
        for ($i = $startIndex; $i <= $endIndex; $i++) {
            unset($row[$keys[$i]]);
        }
    }
    return $data;
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

function convertDate($dateValue) {
     // Check if the value is a DateTime object
if ($dateValue instanceof \PhpOffice\PhpSpreadsheet\Shared\Date) {
    // Convert to PHP DateTime object
    $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($dateValue);
  } elseif (is_numeric($dateValue)) {
    // If it's a numeric value (timestamp), convert to DateTime
    $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($dateValue);
  } else {
    // Handle other types or invalid data
    $dateValue = null;
  }
  
  // Format the date to 'Y-m-d'
  $formattedDate = $dateValue ? $dateValue->format('Y-m-d') : null;
  return $formattedDate;
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
      case 'student':
          return 'AddEditStudent.php';  
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
  debug("$query  ") ;
  $result = $conn->query($query);

  // Check if query was successful
  if ($result === FALSE) {
      echo "Error: " . $conn->error;
  } 
  return $result;
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
          at.sub_type AS Subject_type, 
          at.attendance AS Attendance, record_key";
          
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
  if ($attend === "0" || $attend === "1") { 
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
      $q1 .= ", co.course_name AS Course";
      $q3 .= " AND co.course_id = '$course'";
  }
  if (!empty($dep)) { 
      $q1 .= ", de.dep_name AS Department";
      $q3 .= " AND de.dep_id = '$dep'";
  }

  $orderBy = " ORDER BY SUBSTRING_INDEX(at.reg_no, '/', 1) ASC,
               SUBSTRING_INDEX(SUBSTRING_INDEX(at.reg_no, '/', 2), '/', -1) ASC,
               CAST(SUBSTRING_INDEX(at.reg_no, '/', -1) AS UNSIGNED) ASC";

  $query = $q1 . $q2 . $q3 . $orderBy;
  debug($query) ;
  return $query;
}

function queryica() {
  $q1 = "SELECT st.reg_no AS reg_no , su.sub_code AS Subject,
        i1.record_key AS record_key,i2.record_key AS record_key,i3.record_key AS record_key";
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

  if (!empty($sub_code)) { 
    $q3 .= " AND (i1.sub_code = '$sub_code' OR i2.sub_code = '$sub_code' OR i3.sub_code = '$sub_code')";
    }
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
     $q1 .= ", de.dep_name AS Department";
      $q3 .= " AND de.dep_id = '$dep'";
  }
  if (!empty($course)) { 
      $q1 .= ", co.course_name AS Course";
      $q3 .= " AND co.course_id = '$course'";
  }
  if (!empty($sem)) {
      $q1 .= ", su.semester AS semester";
      $q3 .= " AND su.semester = '$sem'";
  }

  $orderBy = " ORDER BY 
               SUBSTRING_INDEX(st.reg_no, '/', 1) ASC,
               SUBSTRING_INDEX(SUBSTRING_INDEX(st.reg_no, '/', 2), '/', -1) ASC,
               CAST(SUBSTRING_INDEX(i1.reg_no, '/', -1) AS UNSIGNED) ASC";

  $query = $q1 . $q2 . $q3 . $orderBy;
  debug($query) ;
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
            ex.sub_type AS sub_type,record_key";

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
        $q1 .= ", su.level AS level";
        $q3 .= " AND su.level = '$level'";
    }
    if (!empty($batch)) {
        $q1 .= ", st.batch AS batch";
        $q3 .= " AND st.batch = '$batch'";
    }
    if (!empty($dep)) { 
        $q1 .= ", de.dep_name AS Department";
        $q3 .= " AND de.dep_id = '$dep'";
    }
    if (!empty($course)) { 
        $q1 .= ", co.course_name AS Course";
        $q3 .= " AND co.course_id = '$course'";
    }
    if (!empty($sem)) {
        $q1 .= ", su.semester AS semester";
        $q3 .= " AND su.semester = '$sem'";
    }

    $orderBy = " ORDER BY 
                 SUBSTRING_INDEX(ind.reg_no, '/', 1) ASC,
                 SUBSTRING_INDEX(SUBSTRING_INDEX(ind.reg_no, '/', 2), '/', -1) ASC,
                 CAST(SUBSTRING_INDEX(ind.reg_no, '/', -1) AS UNSIGNED) ASC";

    $query = $q1 . $q2 . $q3 . $orderBy;
    debug($query) ;
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
    debug($query) ;
    return $query;    

}


// for($row=0; $row<$highestRow-1; $row++){
//         $qtest="SELECT marks_att1 FROM exam WHERE index_no='$col1[$row]' AND sub_code='$sub_code' ";
//         $rtest=mysqli_query($conn,$qtest);
//         if(!$rtest){
//             $query="INSERT INTO exam VALUES ('$col1[$row]','$col2[$row]',NULL,NULL,NULL,'$sub_code')";
//             $result=mysqli_query($conn,$query);
//         }else{
//             $qtest="SELECT marks_att1,marks_att2, FROM exam WHERE index_no='$col1[$row]' AND sub_code='$sub_code' ";
//             $rtest=mysqli_query($conn,$qtest);
//             if(!$rtest){
//                 $query="UPDATE exam SET marks_att2= '$col2[$row]' WHERE index_no='$col1[$row]'";
//                 $result=mysqli_query($conn,$query);
//             }else{
//                 $qtest="SELECT marks_att1,marks_att2,marks_att3 FROM exam WHERE index_no='$col1[$row]' AND sub_code='$sub_code' ";
//                 $rtest=mysqli_query($conn,$qtest);
//                 if(!$rtest){
//                     $query="UPDATE exam SET marks_att3= '$col2[$row]' WHERE index_no='$col1[$row]'";
//                     $result=mysqli_query($conn,$query);
//                 }else{
//                     $qtest="SELECT marks_att1,marks_att2,marks_att3,marks_attsp FROM exam WHERE index_no='$col1[$row]' AND sub_code='$sub_code' ";
//                     $rtest=mysqli_query($conn,$qtest);
//                     if(!$rtest){
//                         $query="UPDATE exam SET marks_attsp= '$col2[$row]' WHERE index_no='$col1[$row]'";
//                         $result=mysqli_query($conn,$query);
//                     }else{
//                         $errregno[]=$col1[$row];
//                         $errmarks[]=$col2[$row];
//                   }
//               }
//             }
//         } 
//       } 
      ?>