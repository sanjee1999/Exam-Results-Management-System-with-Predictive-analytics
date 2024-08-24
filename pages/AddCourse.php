<?php
  
   $type = isset($_GET['type']) ? $_GET['type'] : null;
   $row = isset($_GET['data']) ? unserialize(urldecode($_GET['data'])) : null;
  
      $course_id=(isset($row[0]))?$row[0]:null;
      $course_name=(isset($row[1]))?$row[1]:null;
      $dep=(isset($row[2]))?$row[2]:null;
      $faculty=(isset($row[3]))?$row[3]:null;
      debug($course_id.$course_name.$dep.$faculty) ;
      
   
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

    <link rel="stylesheet" href="../Dashboard/Sider.css" />
    <link rel="stylesheet" href="../Style/AddIca.css" />

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
            <h3>- <?php echo $type; ?> Course -</h3>
          </div>

          <div class="container">
            <div class="form d-flex justify-content-center align-items-center">
              <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group col-md-3" id="course_id">
                  <input type="text" name="course_id" id="course_id" class="form-control" placeholder="Type Course ID" value="<?php infill($course_id); ?>" required/>
                </div>
                <div class="form-group col-md-3" id="course_name">
                      <input type="text" name="course_name" id="course_name" class="form-control" placeholder="Type Course Name" value="<?php infill($course_name); ?>" required/>
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

    <script src="../Sidebar/Main.js"></script>
  </body>
</html>
<?php
 if($_SERVER["REQUEST_METHOD"]=="POST"){
   $course_id=(isset($_POST['course_id']))?($_POST['course_id']):null;
   $course_name=(isset($_POST['course_name']))?($_POST['course_name']):null;
   $dep=(isset($_POST['dep']))?($_POST['dep']):null;
   $faculty=(isset($_POST['faculty']))?($_POST['faculty']):null;
   
  if($type=='Add'){
      queryInAll($conn,'course',$course_id, $course_name,$dep,$faculty);
  }
  if($type=='Update'){
      queryUpAll($conn, 'course', 'course_id', $course_id, ['course_id', 'course_name', 'dep_id', 'f_id'], $course_id, $course_name, $dep, $faculty);
  }
 }
  
?>