<?php
  
   $type = isset($_GET['type']) ? $_GET['type'] : null;
   $row = isset($_GET['data']) ? unserialize(urldecode($_GET['data'])) : null;
   $table=isset($_GET['table'])?$_GET['table']:NULL;
   $table1=isset($_GET['table1'])?$_GET['table1']:NULL;
  
    $reg_no = isset($row[0]) ? $row[0] : null;
    $stu_name = isset($row[1]) ? $row[1] : null;
    $nic_no = isset($row[2]) ? $row[2] : null;
    $dob = isset($row[3]) ? $row[3] : null;
    $doa = isset($row[4]) ? $row[4] : null;
    $course = isset($row[5]) ? $row[5] : null;
    $batch = isset($row[6]) ? $row[6] : null;
    $index_no = isset($row[7]) ? $row[7] : null;

    // Print values to check
    debug($reg_no . $stu_name . $nic_no . $dob . $doa . $course . $batch . $index_no);

   
      
   
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add</title>
    <!-- get icons -->
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />

    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="../Sidebar/Sider.css" />
    <link rel="stylesheet" href="../Style/AddIca.css" />

    <!-- get bootstrap -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- <style>
        /* Style for the eye icon */
        .fa-eye {
            cursor: pointer;
        }
    </style> -->
  </head>
  <body>
          <div class="title text-center">
            <h3>- <?php echo $type; ?> Student -</h3>
          </div>

          <div class="container">
            <div class="form d-flex justify-content-center align-items-center">
              <form action="" method="post" enctype="multipart/form-data">

                <div class="form-group col-md-3" id="reg_no">
                  <input type="text" name="reg_no" id="reg_no" class="form-control" placeholder="Enter the Reg_no" value="<?php infill($reg_no); ?>" required/>
                </div>
                <div class="form-group col-md-3" id="stu_name">
                  <input type="text" name="stu_name" id="stu_name" class="form-control" placeholder="Enter the Student Name" value="<?php infill($stu_name); ?>" required/>
                </div>
                <div class="form-group col-md-3" id="stu_name">
                  <input type="text" name="stu_name" id="stu_name" class="form-control" placeholder="Enter the Student Name" value="<?php infill($stu_name); ?>" required/>
                </div>
                <div class="form-group col-md-3" id="nic_no">
                  <input type="text" name="nic_no" id="nic_no" class="form-control" placeholder="Enter the Student NIC No" value="<?php infill($nic_no); ?>" required/>
                </div>
                <div class="form-group col-md-3" id="dob">
                  <input type="date" name="dob" id="dob" class="form-control" placeholder="Enter the DOB" value="<?php infill($dob); ?>" required/>
                </div>
                <div class="form-group col-md-3" id="doa">
                  <input type="date" name="doa" id="doa" class="form-control" placeholder="Enter the Date of admission" value="<?php infill($doa); ?>" required/>
                </div>
                
                <div class="form-group col-md-3" id="course">
                      <select name="course" id="course" class="form-control">
                        <option value="" selected disabled>Select course</option>
                        <?php
                          opfill($course);
                          optiongen($conn, 'course', 'course_id','course_name'); 
                        ?>
                      </select>
                </div>
                <div class="form-group col-md-3" id="batch">
                  <input type="text" name="batch" id="batch" class="form-control" placeholder="Enter the Batch" value="<?php infill($batch); ?>" required/>
                </div>
                <div class="form-group col-md-3" id="index_no">
                      <input type="text" name="index_no" id="index_no" class="form-control" placeholder="Enter the Index_no" value="<?php infill($index_no); ?>" required/>
                </div>
                
                
                <div class="form-group">
                  <button class="btn btn-primary"><?php echo $type; ?></button>
                </div>
              </form>
            </div>
          </div>
    <!-- <script src="../script/fileupload.js">
    </script>     -->
    <!-- Bootstrap JS -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    

    <script src="../script/pass.js"></script>
    <script src="../Sidebar/Main.js"></script>
  </body>
</html>
<?php
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $reg_no = isset($_POST['reg_no']) ? $_POST['reg_no'] : null;
  $stu_name = isset($_POST['stu_name']) ? $_POST['stu_name'] : null;
  $nic_no = isset($_POST['nic_no']) ? $_POST['nic_no'] : null;
  $dob = isset($_POST['dob']) ? $_POST['dob'] : null;
  $doa = isset($_POST['doa']) ? $_POST['doa'] : null;
  $course = isset($_POST['course']) ? $_POST['course'] : null;
  $batch = isset($_POST['batch']) ? $_POST['batch'] : null;
  $index_no = isset($_POST['index_no']) ? $_POST['index_no'] : null;
   
  if($type=='Add'){
      query1InAll($conn, 'student', $reg_no, $stu_name, $nic_no, $dob, $doa, $course, $batch, $index_no);
      query1InAll($conn,'index_no',$index_no,$reg_no);
      jsheader('../Dashboard/Sider.php?content=../pages/viewEdit.php&table=student&table1=index_no&tcol=reg_no&t1col=reg_no');
      // Close the connection
      $conn->close();
  }
  if($type=='Update'){
    
      query1UpAll($conn, 'student', 'reg_no', $reg_no,
          [ 'reg_no', 'name', 'nic_no', 'dob', 'date_of_admission', 'course_id', 'batch'], 
          $reg_no, $stu_name, $nic_no, $dob, $doa, $course, $batch);
      query1UpAll($conn, 'index_no', 'index_no', $index_no,
          ['reg_no', 'index_no'], 
          $reg_no, $index_no);
      jsheader('../Dashboard/Sider.php?content=../pages/viewEdit.php&table=student&table1=index_no&tcol=reg_no&t1col=reg_no');

       // Close the connection
      $conn->close();
  }
 }
  
?>