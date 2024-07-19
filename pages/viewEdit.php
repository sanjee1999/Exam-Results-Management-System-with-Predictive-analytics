<?php
 $table=isset($_GET['table'])?$_GET['table']:NULL;
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $button = $_POST['button'];
      $id=$_POST['id'];
      $idcol=$_POST['idcol'];
      $file=filehub($table);
      echo "Button value received: " . $button.$id;
      if($button=='delete' && isset($id)){
        deltablerow($conn,$table,$idcol,$id);
      }
      if($button=='update' && isset($id)){
        uptablerow($conn,$file,$table,$idcol,$id);
        
    
      }

}
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
            <h3>- View <?php echo $table; ?> -</h3>
          </div>

          <div class="container">
          <section class="p-5">
            <div class="table-responsive" id="table1">
              <?php 
                  $table=isset($_GET['table'])?$_GET['table']:NULL;
                  //echo $table;
                  if($table=='course'){ 
                    $query=queryGenTable($table);
                    tableViewEdit($conn,$query,'course_id');
                  }
                  if($table=='department'){ 
                    $query=queryGenTable($table);
                    tableViewEdit($conn,$query,'dep_id');
                  }
                  if($table=='faculty'){ 
                    $query=queryGenTable($table);
                    tableViewEdit($conn,$query,'f_id');
                  }
                  if($table=='subject'){ 
                    $query=queryGenTable($table);
                    tableViewEdit($conn,$query,'sub_code');
                  }
              
              ?>
           
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
