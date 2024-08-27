<?php
$sub_code=$date=$month=$year=$regno=$level=$type=$batch=null;

if($_SERVER["REQUEST_METHOD"]=="POST"){
  $sub_code=(isset($_POST['sub_code']))?($_POST['sub_code']):null;
  $sub_type=(isset($_POST['sub_type']))?($_POST['sub_type']):null;
  $level=(isset($_POST['level']))?($_POST['level']):null;
  $date=(isset($_POST['date']))?($_POST['date']):null;
  $month=(isset($_POST['month']))?($_POST['month']):null;
  $year=(isset($_POST['year']))?($_POST['year']):null;
  $regno=(isset($_POST['regno']))?($_POST['regno']):null;
  $type=(isset($_POST['type']))?($_POST['type']):null;
  $attend=(isset($_POST['attend']))?($_POST['attend']):null;
  $batch = isset($_POST['batch']) ? $_POST['batch'] : null;
  $sem = isset($_POST['sem']) ? $_POST['sem'] : null;
  $dep = isset($_POST['dep']) ? $_POST['dep'] : null;
  $course = isset($_POST['course']) ? $_POST['course'] : null;
  $ica = isset($_POST['ica']) ? $_POST['ica'] : null;
  $index_no = isset($_POST['index_no']) ? $_POST['index_no'] : null;
  $detail = isset($_POST['detail']) ? $_POST['detail'] : null;
  $graph = isset($_POST['graph']) ? $_POST['graph'] : null;
 
  debug("$sub_code $date $month $year $regno $level $attend<br>") ;

  $_SESSION['sub_code']=isset($sub_code)?$sub_code:null;
  $_SESSION['sub_type']=isset($sub_type)?$sub_type:null;
  $_SESSION['level']=isset($level)?$level:null;
  $_SESSION['date']=isset($date)?$date:null;
  $_SESSION['month']=isset($month)?$month:null;
  $_SESSION['year']=isset($year)?$year:null;
  $_SESSION['regno']=isset($regno)?$regno:null;
  $_SESSION['type']=isset($type)?$type:null;
  $_SESSION['attend'] = isset($attend) ? $attend : null;
  $_SESSION['batch'] = isset($batch) ? $batch : null;
  $_SESSION['sem'] = isset($sem) ? $sem : null;
  $_SESSION['dep'] = isset($dep) ? $dep : null;
  $_SESSION['course'] = isset($course) ? $course : null;
  $_SESSION['ica'] = isset($ica) ? $ica : null;
  $_SESSION['index_no'] = isset($index_no) ? $index_no : null;
  $_SESSION['graph'] = isset($graph) ? $graph : null;
}
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

    <link rel="stylesheet" href="../Dashboard/Sider.css" />
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
            <h3>- View combosite Marks -</h3>
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
               

                <div class="form-group col-md-3" id="batch">
                  <input type="text" name="batch" id="batch" class="form-control" placeholder="Batch"/>
                  <input type="hidden" name="type" id="type" class="form-control" value="combo"/>
                </div>
                <div class="form-check form-switch form-group" id="detail">
                  <input class="form-check-input" type="checkbox" role="switch" name="detail" id="detail" value="full">
                  <label class="form-check-label" for="detail">Full Detailed View</label>
                </div>
                <div class="form-group col-md-3">
                  <button class="btn btn-primary w-100">View Graph</button>
                </div>
              </form>
            </div>
          </div>
          <div class="title text-center">
            <h3>- Combosite Marks of 
            <?php
                echo " $sub_code $batch";
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
        <?php 
             require '../pages/test.php';
        ?>

      
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
