<?php
 $table=isset($_GET['table'])?$_GET['table']:NULL;
 $table1=isset($_GET['table1'])?$_GET['table1']:NULL;
 $tcol=isset($_GET['tcol'])?$_GET['tcol']:NULL;
 $t1col=isset($_GET['t1col'])?$_GET['t1col']:NULL;

  debug($tcol." ".$t1col) ;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $button = $_POST['action'];
      $id=$_POST['id'];
      $idcol=$_POST['idcol'];
      $file=filehub($table);
      debug("Button value received: " . $button.$id) ;

        if(!empty($table) && empty($table1)){
          if($button=='delete' && isset($id)){
            deltablerow($conn,$table,$idcol,$id);
          }
          if($button=='update' && isset($id)){
            uptablerow($conn,$file,$table,$idcol,$id);
          }
        }elseif(!empty($table) && !empty($table1)){
          if($button=='delete' && isset($id)){
            del2tablerow($conn,$table,$table1,$idcol,$id);
          }
          if($button=='update' && isset($id)){
            up2tablerow($conn,$file,$table,$table1,$tcol,$t1col,$idcol,$id);
          }
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

    <style>
        .btn-custom-delete {
            background-color: #dc3545; /* Red background */
            border-color: #dc3545; /* Red border */
            color: white; /* White text */
        }
        .btn-custom-delete:hover {
            background-color: #c82333; /* Darker red on hover */
            border-color: #bd2130; /* Darker red border on hover */
        }
    </style>


    <link rel="stylesheet" href="../Dashboard/Sider.css" />
    <link rel="stylesheet" href="../Style/AddIca.css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
            <div class="table-responsive" id="table">
              <?php 
                  // $table=isset($_GET['table'])?$_GET['table']:NULL;
                  // $table1=isset($_GET['table1'])?$_GET['table1']:NULL;
                  debug( $table." ". $table1."<br>");
                  if($table=='course'){ 
                    $query=queryGenTable($table);
                    tableViewEdit($conn,$query,'course_id','0');
                  }
                  if($table=='department'){ 
                    $query=queryGenTable($table);
                    tableViewEdit($conn,$query,'dep_id','0');
                  }
                  if($table=='faculty'){ 
                    $query=queryGenTable($table);
                    tableViewEdit($conn,$query,'f_id','0');
                  }
                  if($table=='subject'){ 
                    $query=queryGenTable($table);
                    tableViewEdit($conn,$query,'sub_code','0');
                  }
                  if($table=='lecture'){
                    $query=queryjoin($conn,$table,$table1,'admin_id','admin_id');
                    tableViewEdit($conn,$query,'admin_id','5');
                  }
                  if($table=='student'){
                    $query=queryjoin($conn,$table,$table1,'reg_no','reg_no');
                    tableViewEdit($conn,$query,'reg_no','0');
                  }
              
              ?>
           
          </div>
    <script src="../script/confirm.js"></script>   
     
    <!-- Bootstrap JS -->

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="../Sidebar/Main.js"></script>
  </body>
</html>
