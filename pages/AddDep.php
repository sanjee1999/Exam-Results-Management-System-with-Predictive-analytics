<?php
  
   $type = isset($_GET['type']) ? $_GET['type'] : null;
   $row = isset($_GET['data']) ? unserialize(urldecode($_GET['data'])) : null;
  
      $dep=(isset($row[0]))?$row[0]:null;
      $dep_name=(isset($row[1]))?$row[1]:null;
      $faculty=(isset($row[2]))?$row[2]:null;
      echo $dep.$dep_name.$faculty;
      
   
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

    <link rel="stylesheet" href="../Sidebar/Sider.css" />
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
            <h3>- <?php echo $type; ?> Department -</h3>
          </div>

          <div class="container">
            <div class="form d-flex justify-content-center align-items-center">
              <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group col-md-3" id="dep">
                  <input type="text" name="dep" id="dep" class="form-control" placeholder="Type Department ID" value="<?php infill($dep); ?>" required/>
                </div>
                <div class="form-group col-md-3" id="dep_name">
                      <input type="text" name="dep_name" id="dep_name" class="form-control" placeholder="Type Department Name" value="<?php infill($dep_name); ?>" required/>
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
   $dep=(isset($_POST['dep']))?($_POST['dep']):null;
   $dep_name=(isset($_POST['dep_name']))?($_POST['dep_name']):null;
   $faculty=(isset($_POST['faculty']))?($_POST['faculty']):null;
   
  // if($type=='Add' && !is_null($course_id) && !is_null($course_name) && !is_null($dep) && !is_null($faculty) ){
  if($type=='Add'){
      queryInAll($conn,'department',$dep, $dep_name,$faculty);
  }
  if($type=='Update'){
      queryUpAll($conn, 'department', 'dep_id', $dep, ['dep_id', 'dep_name', 'f_id'], $dep_id, $dep_name, $faculty);
  }
 }
  
?>