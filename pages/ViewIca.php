<?php
$sub_code=$date=$month=$year=$regno=$level=null;

  // if($_SERVER["REQUEST_METHOD"]=="POST"){
  //   $sub_code=(isset($_POST['sub_code']))?($_POST['sub_code']):null;
  //   $level=(isset($_POST['level']))?($_POST['level']):null;
  //   $date=(isset($_POST['date']))?($_POST['date']):null;
  //   $month=(isset($_POST['month']))?($_POST['month']):null;
  //   $year=(isset($_POST['year']))?($_POST['year']):null;
  //   $regno=(isset($_POST['regno']))?($_POST['regno']):null;
    
   
  //   echo "$sub_code $date $month $year $regno $level <br>";

  //   $_SESSION['sub_code']=isset($sub_code)?$sub_code:null;
  //   $_SESSION['level']=isset($level)?$level:null;
  //   $_SESSION['date']=isset($date)?$date:null;
  //   $_SESSION['month']=isset($month)?$month:null;
  //   $_SESSION['year']=isset($year)?$year:null;
  //   $_SESSION['regno']=isset($regno)?$regno:null;
  // }
?>    
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Slider</title>
    <!-- get icons -->
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />

    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <lord-icon trigger="hover" src="/my-icon.json"></lord-icon>

    <link rel="stylesheet" href="../Sidebar/Sider.css" />
    <link rel="stylesheet" href="../Style/ViewIca.css" />

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
            <h3>- View ICA Marks -</h3>
          </div>
      <div class="container">
          <div class="input-section py-5 mb-5">
            <div class="form d-flex justify-content-center align-items-center">
              <form action="#" method="post" class="row" oninput="submitForm()" id="searchForm">
              <div class="form-group col-md-3" id="sub_code">
                  <select name="sub_code" id="sub_code" class="form-control">
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
                <div class="form-group col-md-3" id="regno">
                  <input type="text" name="regno" id="regno" class="form-control" placeholder="Reg_No"/>
                  <input type="hidden" name="type" id="type" class="form-control" value="ica"/>
                </div>

                <div class="form-group col-md-3" id="ica">
                  <label><input type="checkbox" name="ica[]"  value="ica1"/> ICA 1</label>
                  <label><input type="checkbox" name="ica[]"  value="ica2"/> ICA 2</label>
                  <label><input type="checkbox" name="ica[]"  value="ica3"/> ICA 3</label>
                </div>

                <div class="form-group col-md-3" id="level">
                  <select name="level" id="level" class="form-control">
                    <option value="" selected disabled>Select Level</option>
                    <option value="1">1st Year</option>
                    <option value="2">2nd Year</option>
                    <option value="3">3rd Year</option>
                    <option value="4">4th Year</option>
                  </select>
                </div>

                <div class="form-group col-md-3" id="batch">
                  <input type="text" name="batch" id="batch" class="form-control" placeholder="Batch"/>
                </div>
                <div class="form-group col-md-3" id="dep">
                    <select name="dep" id="dep" class="form-control">
                      <option value="" selected disabled>Select Department</option>
                      <?php optiongen($conn, 'department', 'dep_id','dep_name') ?>
                    </select>
                </div>
                <div class="form-group col-md-3" id="course">
                    <select name="course" id="course" class="form-control">
                      <option value="" selected disabled>Select Course</option>
                      <?php optiongen($conn, 'course', 'course_id','course_name') ?>
                    </select>
                  </div>
                <div class="form-group col-md-3" id="sem">
                  <input type="text" name="sem" id="sem" class="form-control" placeholder="Semester"/>
                </div>
                <!-- <div class="form-group col-md-3">
                  <button class="btn btn-primary w-100">View</button>
                </div> -->
              </form>
            </div>
          </div>
          <div class="title text-center">
            <h3>- ICA Result of 
            <?php
                echo "$regno $sub_code";
              ?>
            -</h3>
          </div>
    <div class="container" id="viewout">
          <section class="p-5">
            <!-- <div class="table-responsive" id="table1">
            <?php 
                // if($_SERVER["REQUEST_METHOD"]=="POST"){  
                //   $query=queryica();
                //   outputQueryInTable($conn,$query);
                // }
              ?>
            </div>
          </section>       -->
        </div>
     

      
    <!-- Bootstrap JS -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    <script src="../script/filter.js"></script>
    <script src="../Sidebar/Main.js"></script>
  </body>
</html>
