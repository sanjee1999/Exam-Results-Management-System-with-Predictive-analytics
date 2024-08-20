<?php
  
   $type = isset($_GET['type']) ? $_GET['type'] : null;
   $row = isset($_GET['data']) ? unserialize(urldecode($_GET['data'])) : null;
  
   $sub_code = isset($row[0]) ? $row[0] : null;
   $sub_name = isset($row[1]) ? $row[1] : null;
   $total_credit = isset($row[2]) ? $row[2] : null;
   $p_credit = isset($row[3]) ? $row[3] : null;
   $t_credit = isset($row[4]) ? $row[4] : null;
   $pi_ratio = isset($row[5]) ? $row[5] : null;
   $ti_ratio = isset($row[6]) ? $row[6] : null;
   $course_id = isset($row[7]) ? $row[7] : null;
   $level = isset($row[8]) ? $row[8] : null;
   $sem = isset($row[9]) ? $row[9] : null;
   $lec_id = isset($row[10]) ? $row[10] : null;
   
   // Print values to check
   debug( $sub_code . $sub_name . $total_credit . $p_credit . $t_credit . $pi_ratio . $ti_ratio . $course_id . $level . $sem . $lec_id);
   
      
   
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

                <div class="form-group col-md-3" id="sub_code">
                  <input type="text" name="sub_code" id="sub_code" class="form-control" placeholder="Type Subject Code" value="<?php infill($sub_code); ?>" required/>
                </div>
                <div class="form-group col-md-3" id="sub_name">
                  <input type="text" name="sub_name" id="sub_name" class="form-control" placeholder="Type Subject Name" value="<?php infill($sub_name); ?>" required/>
                </div>
                <div class="form-group col-md-3" id="total_credit">
                      <input type="text" name="total_credit" id="total_credit" class="form-control" placeholder="Type Total_credit" value="<?php infill($total_credit); ?>" required/>
                </div>
                <div class="form-group col-md-3" id="p_credit">
                      <input type="text" name="p_credit" id="p_credit" class="form-control" placeholder="Type Practical_credit" value="<?php infill($p_credit); ?>" required/>
                </div>
                <div class="form-group col-md-3" id="t_credit">
                      <input type="text" name="t_credit" id="t_credit" class="form-control" placeholder="Type Theory_credit" value="<?php infill($t_credit); ?>" required/>
                </div>
                <div class="form-group col-md-3" id="pi_ratio">
                      <input type="text" name="pi_ratio" id="pi_ratio" class="form-control" placeholder="Type Theory ICA Ratio" value="<?php infill($pi_ratio); ?>" required/>
                </div>
                <div class="form-group col-md-3" id="ti_ratio">
                      <input type="text" name="ti_ratio" id="ti_ratio" class="form-control" placeholder="Type Practical ICA Ratio" value="<?php infill($ti_ratio); ?>" required/>
                </div>
                <div class="form-group col-md-3" id="course_id">
                      <input type="text" name="course_id" id="course_id" class="form-control" placeholder="Type Course ID" value="<?php infill($course_id); ?>" required/>
                </div>
                <div class="form-group col-md-3" id="level">
                  <select name="level" id="level" class="form-control">
                    <option value="" selected disabled>Select Level</option>
                    <option value="1" <?php if ($level == '1') echo 'selected'; ?>>1st Year</option>
                    <option value="2" <?php if ($level == '2') echo 'selected'; ?>>2nd Year</option>
                    <option value="3" <?php if ($level == '3') echo 'selected'; ?>>3rd Year</option>
                    <option value="4" <?php if ($level == '4') echo 'selected'; ?>>4th Year</option>
                  </select>
                </div>
                <div class="form-group col-md-3" id="sem">
                      <input type="text" name="sem" id="sem" class="form-control" placeholder="Type Semester" value="<?php infill($sem); ?>" required/>
                </div>
                <div class="form-group col-md-3" id="lec_id">
                      <input type="text" name="lec_id" id="lec_id" class="form-control" placeholder="Type Lecture ID" value="<?php infill($lec_id); ?>" required/>
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
   $sub_code=(isset($_POST['sub_code']))?($_POST['sub_code']):null;
   $sub_name=(isset($_POST['sub_name']))?($_POST['sub_name']):null;
   $total_credit=(isset($_POST['total_credit']))?($_POST['total_credit']):null;
   $p_credit=(isset($_POST['p_credit']))?($_POST['p_credit']):null;
   $t_credit=(isset($_POST['t_credit']))?($_POST['t_credit']):null;
   $pi_ratio=(isset($_POST['pi_ratio']))?($_POST['pi_ratio']):null;
   $ti_ratio=(isset($_POST['ti_ratio']))?($_POST['ti_ratio']):null;
   $course_id=(isset($_POST['course_id']))?($_POST['course_id']):null;
   $level=(isset($_POST['level']))?($_POST['level']):null;
   $sem=(isset($_POST['sem']))?($_POST['sem']):null;
   $lec_id=(isset($_POST['lec_id']))?($_POST['lec_id']):null;
   
  if($type=='Add'){
      queryInAll($conn,'subject',$sub_code, $sub_name,$total_credit,$p_credit,$t_credit,$pi_ratio,$ti_ratio,$course_id,$level,$sem,$lec_id);
  }
  if($type=='Update'){
      queryUpAll($conn, 'subject', 'sub_code', $sub_code,
       ['sub_code', 'sub_name', 'total_credit','practical_credit','theory_credit','pra_ica_ratio','theo_ica_ratio','course_id','level','semester','lec_id'], 
       $sub_code, $sub_name,$total_credit,$p_credit,$t_credit,$pi_ratio,$ti_ratio,$course_id,$level,$sem,$lec_id);
  }
 }
  
?>