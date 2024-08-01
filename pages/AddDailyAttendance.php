<?php
//require '../function/fun.php';

// if (isset($_SESSION['firstRow'])) {
//     $firstRow = $_SESSION['firstRow'];
//     unset($_SESSION['firstRow']); // Clear session data after use
// } else {
//     // Handle case where data is not set
//     $firstRow = [];
// }

?>
<?php
// if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['firstRow'])) {
//     $firstRow = $_POST['firstRow'];
//     // Store the variable or do whatever you need with it
//     // For demonstration, we will just echo it
//     echo "Received variable: " . $firstRow;
// } else {
//     echo "No variable received.";
// }
?>
<?php
          if($_SERVER["REQUEST_METHOD"]=="POST"){
            $level=(isset($_POST['level']))?($_POST['levels']):null;
            $sub_code=(isset($_POST['sub_code']))?($_POST['sub_code']):null;
            $hour=(isset($_POST['hour']))?($_POST['hour']):null;
            $time=(isset($_POST['time']))?($_POST['time']):null;
            $date=(isset($_POST['date']))?($_POST['date']):null;
            $file=(isset($_POST['file']))?($_POST['file']):null;
            echo "$year $subject $date $file";
           if(!empty($year) && !empty($subject) && !empty($date) && !empty($file) ){
            echo "$year $subject $date $file";
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

    <link rel="stylesheet" href="../Sidebar/Sider.css" />
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
            <h3>- Add Daily Attendance -</h3>
          </div>

          <div class="container">
            <div class="form d-flex justify-content-center align-items-center">
              <form action="../Dashboard/Sider.php?content=../pages/upload.php&heading=Daily%20Attendance&type=attendance" 
              method="post" id="mainform" enctype="multipart/form-data">
                
                <div class="form-group" id="sub_code">
                  <select name="sub_code" id="sub_code" class="form-control" required>
                    
                    <?php 
                        #$subject = isset($_POST['subject']) ? $_POST['subject'] : "Select Subject";
                        #echo "<option value='" . $subject . "'selected disabled>" ; echo $subject . "</option>"; 
                    ?>
                    <option value="" selected disabled>Select Sub_Code</option>
                    <?php optiongen($conn, 'subject', 'sub_code','sub_name') ?>
                  </select>
                </div>

                <div class="form-group" id="sub_type">
                  <select name="sub_type" id="sub_type" class="form-control" required>
                    <option value="" selected disabled>Select Subject Type</option>
                    <option value="T" <?php #if ($year == '1') echo 'selected'; ?>>Theory</option>
                    <option value="P" <?php #if ($year == '1') echo 'selected'; ?>>Practical</option> 
                  </select>
                </div>

                <div class="form-group" id="hour">
                 <input type="text" name="hour" id="hour" class="form-control" placeholder="Taken hours" required>
                </div>
             
                <div class="form-group" id="time">
                 <input type="time" name="time" id="time" class="form-control" required>
                </div>

                <div class="form-group" id="date">
                  <input
                    type="date"
                    name="date"
                    id="date"
                    class="form-control"
                    value="<?php echo isset($_POST['date']) ? htmlspecialchars($_POST['date']) : ''; ?>" 
                    required/>
                </div>

                <div class="form-group">
                  <input type="file" name="file" id="fileUpload" class="form-control" accept=".xlsx, .xls"
                    required/>
                </div>
                
                <div class="form-group">
                  <button class="btn btn-primary">Submit</button>
                </div>
              </form>

              <!-- <div id="output"></div> -->
                
               
                <script src="../script/fileupload.js">
                </script>
                <?php 
                    
                   require_once '../function/fun.php';
                   # print_r($firstRow);
                    // if(!empty($firstRow)){
                    //  exhead($firstRow);
                    // }
                    
                 
                ?>
                
            </div>
          </div>
          <?php
            $regno="regno";
            $attend="attend"; 
          ?>
          <div class="container" id="form1">
                <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post">
                  Reg.no:<?php if(!empty($firstRow)){ 
                    exhead($firstRow,$regno); 
                    }
                    ?><br>
                  Attendance:<?php if(!empty($firstRow)){
                    exhead($firstRow,$attend); 
                    }
                    ?><br>
                  
                  <button class="btn btn-primary">Submit</button>
                </form>
          </div>
          <?php
          if($_SERVER["REQUEST_METHOD"]=="POST"){
            $reg=(isset($_POST['regno']))?($_POST['regno']):null;
            $att=(isset($_POST['attend']))?($_POST['attend']):null;
            
            
           if(!empty($reg) && !empty($att)){
            echo "$reg $att";
           }
          }
          
?> 
          
    <!-- Bootstrap JS -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>

    <script src="../Sidebar/Main.js"></script>
  </body>
</html>
