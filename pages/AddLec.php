<?php
  
   $type = isset($_GET['type']) ? $_GET['type'] : null;
   $row = isset($_GET['data']) ? unserialize(urldecode($_GET['data'])) : null;
   $table=isset($_GET['table'])?$_GET['table']:NULL;
   $table1=isset($_GET['table1'])?$_GET['table1']:NULL;
  
    $lec_id = isset($row[0]) ? $row[0] : null;
    $lec_name = isset($row[1]) ? $row[1] : null;
    $faculty = isset($row[2]) ? $row[2] : null;
    $dep = isset($row[3]) ? $row[3] : null;
    $lec_type = isset($row[4]) ? $row[4] : null;
    $admin_id = isset($row[5]) ? $row[5] : null;
    $admin_type = isset($row[7]) ? $row[7] : null;
    $password = isset($row[8]) ? $row[8] : null;

    // Print values to check
    debug( $lec_id . $lec_name . $faculty . $dep . $lec_type . $admin_id . $admin_type . $password);

   
      
   
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
    <link rel="stylesheet" href="../Dashboard/Sider.css" />
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
            <h3>- <?php echo $type; ?> Lecturer -</h3>
          </div>

          <div class="container">
            <div class="form d-flex justify-content-center align-items-center">
              <form action="" method="post" enctype="multipart/form-data">

                <div class="form-group col-md-3" id="lec_id">
                  <input type="text" name="lec_id" id="lec_id" class="form-control" placeholder="Type Lecturer ID" value="<?php infill($lec_id); ?>" required/>
                </div>
                <div class="form-group col-md-3" id="lec_name">
                  <input type="text" name="lec_name" id="lec_name" class="form-control" placeholder="Type Lecturer Name" value="<?php infill($lec_name); ?>" required/>
                </div>
                <div class="form-group col-md-3" id="dep">
                      <select name="dep" id="dep" class="form-control">
                        <option value="" selected disabled>Select Department</option>
                        <?php
                          opfill($dep);
                          optiongen($conn, 'department', 'dep_id','dep_name'); 
                        ?>
                      </select>
                </div>
                <div class="form-group col-md-3" id="faculty">
                    <select name="faculty" id="faculty" class="form-control" required>
                      <option value="" selected disabled>Select Faculty</option>
                      <?php 
                          opfill($faculty);
                          optiongen($conn, 'faculty', 'f_id','f_name');
                      ?>
                    </select>
                </div>
                <div class="form-group col-md-3" id="lec_type">
                    <select name="lec_type" id="lec_type" class="form-control" required>
                      <option value="" selected disabled>Select Lecturer type</option>
                      <?php 
                          opfill($lec_type);
                          optiongen($conn, 'lecture_type', 'type_id','lec_type_name');
                      ?>
                    </select>
                </div>
                <div class="form-group col-md-3" id="admin_id">
                      <input type="text" name="admin_id" id="admin_id" class="form-control" placeholder="Type Admin ID" value="<?php infill($admin_id); ?>" required/>
                </div>
                <div class="form-group col-md-3" id="admin_type">
                  <select name="admin_type" id="admin_type" class="form-control">
                    <option value="" selected disabled>Select ADMIN Type</option>
                    <option value="lec" <?php if ($admin_type == 'lec') echo 'selected'; ?>>Lecture</option>
                    <option value="hod" <?php if ($admin_type == 'hod') echo 'selected'; ?>>HOD</option>
                  </select>
                </div>
                <div class="form-group col-md-3 " id="password">
                      <input type="password" name="password" id="password" class="form-control password" placeholder="Type Password" autocomplete="" value="<?php infill($password); ?>" required/>
                      <!-- <i class="far fa-eye" id="togglePassword"></i> -->
                      <!-- <div class="fa fa-eye icon"></div> -->
                </div>
                <!-- <div class="form-group col-md-3 " id="password">
                <div class="col-12">
                  <div class="input-group mb-3 ">
                      <input type="password" name="password" id="password" class="form-control password" aria-label="password" aria-describedby="basic-addon1" placeholder="Type Password" autocomplete="" value="<?php infill($password); ?>" required/>
                      <div class="input-group-append">
                          <span class="input-group-text" onclick="password_show_hide();">
                            <i class="fas fa-eye" id="show_eye"></i>
                            <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                          </span>
                      </div>
                  </div>
                </div>
                </div> -->
                
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
 if($_SERVER["REQUEST_METHOD"]=="POST"){
   $lec_id=(isset($_POST['lec_id']))?($_POST['lec_id']):null;
   $lec_name=(isset($_POST['lec_name']))?($_POST['lec_name']):null;
   $faculty=(isset($_POST['faculty']))?($_POST['faculty']):null;
   $dep=(isset($_POST['dep']))?($_POST['dep']):null;
   $lec_type=(isset($_POST['lec_type']))?($_POST['lec_type']):null;
   $admin_id=(isset($_POST['admin_id']))?($_POST['admin_id']):null;
   $admin_type=(isset($_POST['admin_type']))?($_POST['admin_type']):null;
   $password=(isset($_POST['password']))?($_POST['password']):null;
   $password=passwordhash($password);
   
  if($type=='Add'){
      query1InAll($conn,'lecture',$lec_id, $lec_name,$faculty,$dep,$lec_type,$admin_id);
      query1InAll($conn,'admin',$admin_id,$admin_type,$password);
      jsheader('../Dashboard/Sider.php?content=../pages/viewEdit.php&table=lecture&table1=admin&tcol=admin_id&t1col=admin_id');
      // Close the connection
      $conn->close();
  }
  if($type=='Update'){
    
      query1UpAll($conn, 'lecture', 'lec_id', $lec_id,
       ['lec_id', 'lec_name', 'f_id','dep_id','type_of_lecture','admin_id'], 
       $lec_id, $lec_name,$faculty,$dep,$lec_type,$admin_id);
      query1UpAll($conn, 'admin', 'admin_id', $admin_id,
       ['admin_id', 'admin_type', 'password'], 
       $admin_id, $admin_type,$password);
       jsheader('../Dashboard/Sider.php?content=../pages/viewEdit.php&table=lecture&table1=admin&tcol=admin_id&t1col=admin_id');

       // Close the connection
      $conn->close();
  }
 }
  
?>