<?php
  
   $type = isset($_GET['type']) ? $_GET['type'] : null;
   $row = isset($_GET['data']) ? unserialize(urldecode($_GET['data'])) : null;
  
      $faculty=(isset($row[0]))?$row[0]:null;
      $faculty_name=(isset($row[1]))?$row[1]:null;
      
      debug( $faculty_name.$faculty);
      
   
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
            <h3>- <?php echo $type; ?> Faculty -</h3>
          </div>

          <div class="container">
            <div class="form d-flex justify-content-center align-items-center">
              <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group col-md-3" id="faculty">
                  <input type="text" name="faculty" id="faculty" class="form-control" placeholder="Type Faculty ID" value="<?php infill($faculty); ?>" required/>
                </div>
                <div class="form-group col-md-3" id="faculty_name">
                      <input type="text" name="faculty_name" id="faculty_name" class="form-control" placeholder="Type Faculty Name" value="<?php infill($faculty_name); ?>" required/>
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

   $faculty=(isset($_POST['faculty']))?($_POST['faculty']):null;
   $faculty_name=(isset($_POST['faculty_name']))?($_POST['faculty_name']):null;
   
  if($type=='Add'){
      queryInAll($conn,'faculty',$faculty, $faculty_name);
  }
  if($type=='Update'){
      queryUpAll($conn, 'faculty', 'f_id', $faculty, ['f_id', 'f_name'], $faculty, $faculty_name);
  }
 }
  
?>