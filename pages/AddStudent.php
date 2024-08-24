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
          // if($_SERVER["REQUEST_METHOD"]=="POST"){
          //   $level=(isset($_POST['level']))?($_POST['levels']):null;
          //   $sub_code=(isset($_POST['sub_code']))?($_POST['sub_code']):null;
          //   $hour=(isset($_POST['hour']))?($_POST['hour']):null;
          //   $time=(isset($_POST['time']))?($_POST['time']):null;
          //   $date=(isset($_POST['date']))?($_POST['date']):null;
          //   $file=(isset($_POST['file']))?($_POST['file']):null;
          //   echo "$year $subject $date $file";
          //  if(!empty($year) && !empty($subject) && !empty($date) && !empty($file) ){
          //   echo "$year $subject $date $file";
          //  }
          // }
          
?> 

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Student Details</title>
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
  </head>
  <body>
   
          <div class="title text-center">
            <h3>- Add Student Details -</h3>
          </div>

          <div class="container">
            <div class="form d-flex justify-content-center align-items-center">
              <form action="../Dashboard/Sider.php?content=../pages/upView.php"  
              method="post"  id="insertForm" enctype="multipart/form-data">
              
                <div class="form-group col-md-3" id="course">
                    <select name="course" id="course" class="form-control" required>
                      <option value="" selected disabled>Select Course</option>
                      <?php optiongen($conn, 'course', 'course_id','course_name') ?>
                    </select>
                </div>
                <div class="form-group" id="batch">
                 <input type="text" name="batch" id="batch" class="form-control" placeholder="Type Batch" required>
                 <input type="hidden" name="type" id="type" class="form-control" value="student"/>
                </div>
                <div class="form-group">
                  <input type="file" name="file" id="fileUpload" class="form-control" accept=".xlsx, .xls"
                    required/>
                </div>
                
                <div class="form-group">
                  <button class="btn btn-primary">Submit</button>
                </div>
              </form>
                
            </div>
          </div>
         
         

    <script src="../script/fileupload.js"> </script>         
   
    <!-- Bootstrap JS -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>

    <script src="../Sidebar/Main.js"></script>
  </body>
</html>
