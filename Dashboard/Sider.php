<?php  
ob_start();
session_start();
require_once '../connection/conf.php';
require_once '../function/fun.php';



if (!isAuthenticated()) {
  header('Location: ../pages/login.php');
  exit();
}
$user_type=$_SESSION['user_type'];
$user_name=isset($_SESSION['lec_name'])?$_SESSION['lec_name']:"";
?>

<?php
  colourGen()
    //header('location: ../Dashboard/colourGen.php');
    //exit;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welcome, <?php echo ucfirst($_SESSION['user_type']); ?></title>
    <!-- get icons -->
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />

    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="Sider.css" />

    <!-- get bootstrap -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
  </head>
  <body>
    <div class="wrapper">
      <aside id="sidebar">
        <div class="d-flex">
          <button id="toggle-btn">
            <i class="lni lni-grid-alt"></i>
          </button>
        </div>

        <ul class="sidebar-nav">
          <li class="sidebar-item">
            <a href="?content=../pages/profile.php" 
              class="sidebar-link">
              <i class="bx bx-user me-2"></i>
              <span><?php echo $user_name." ".strtoupper($user_type) ?></span>
            </a>
          </li>
          <br>
          <li class="sidebar-item">
            <a href="?content=../pages/Home.php" 
              class="sidebar-link">
              <i class="bx bx-home-alt me-2"></i>
              <span>Home</span>
            </a>
          </li>

          <!-- attendance start -->
          <?php if ($user_type == 'hod' || $user_type == 'lec'): ?>
          <li class="sidebar-item">
            <a
              href="#"
              class="sidebar-link has-dropdown collapsed"
              data-bs-toggle="collapse"
              data-bs-target="#attendance"
              aria-expanded="false"
              aria-controls="attendance"
            >
              <i class="bx bxs-calendar me-2"></i>
              <span>Attendance</span>
            </a>
            <ul
              id="attendance"
              class="sidebar-dropdown list-unstyled collapse"
              data-bs-parent="#sidebar"
            >
              <li class="sidebar-item">
                <a href="?content=../pages/AddDailyAttendance.php" 
                  class="sidebar-link"
                  >Add DailyAttendance</a
                >
              </li>

              <li class="sidebar-item">
                <a href="?content=../pages/ViewDailyAttendance.php" 
                  class="sidebar-link"
                  >View DailyAttendance</a
                >
              </li>
            </ul>
          </li>
        <?php endif; ?>
         <?php if ($user_type ==  false): ?> 
          <li class="sidebar-item">
            <a
              href=""
              class="sidebar-link has-dropdown collapsed"
              data-bs-toggle="collapse"
              data-bs-target="#multi"
              aria-expanded="false"
              aria-controls="multi"
            >
              <i class="bx bxs-calendar me-2"></i>
              <span>Attendance</span>
            </a>
            <ul
              id="multi"
              class="sidebar-dropdown list-unstyled collapse"
              data-bs-parent="#sidebar"
            >
              <li class="sidebar-item">
                <a
                  href=""
                  class="sidebar-link collapsed"
                  data-bs-toggle="collapse"
                  data-bs-target="#multi-one"
                  aria-expanded="false"
                  aria-controls="multi-one"
                >
                  Add Attendance
                </a>
                <ul
                  id="multi-one"
                  class="sidebar-dropdown list-unstyled collapse"
                >
                  <li class="sidebar-item">
                    <a
                      href="?content=../pages/AddDailyAttendance.php"
                      class="sidebar-link"
                      >Add Daily Attendance</a
                    >
                  </li>
                  <li class="sidebar-item">
                    <a
                      href="?content=../pages/AddMonthlyAttendance.php"
                      class="sidebar-link"
                      >Add Monthly Attendance</a
                    >
                  </li>
                </ul>
              </li>
              <li class="sidebar-item">
                <a
                  href=""
                  class="sidebar-link collapsed"
                  data-bs-toggle="collapse"
                  data-bs-target="#multi-two"
                  aria-expanded="false"
                  aria-controls="multi-two"
                >
                  View Attendance
                  <!-- New section title -->
                </a>
                <ul
                  id="multi-two"
                  class="sidebar-dropdown list-unstyled collapse"
                >
                  <li class="sidebar-item">
                    <a
                      href="?content=../pages/ViewDailyAttendance.php"
                      class="sidebar-link"
                      >View Daily Attendance</a
                    >
                  </li>
                  <!-- <li class="sidebar-item">
                    <a
                      href="?content=../pages/ViewMonthlyAttendance.php"
                      class="sidebar-link"
                      >View Monthly Attendance</a
                    >
                  </li> -->
                </ul>
              </li>
            </ul>
          </li> 
        <?php endif; ?>
          <!-- attendance end -->

          <!-- assesment start -->
        <?php if ($user_type == 'hod' || $user_type == 'lec'): ?>
          <li class="sidebar-item">
            <a
              href="#"
              class="sidebar-link has-dropdown collapsed"
              data-bs-toggle="collapse"
              data-bs-target="#assessment"
              aria-expanded="false"
              aria-controls="assessment"
            >
              <i class="bx bx-list-ol me-2"></i>
              <span>Assessment</span>
            </a>
            <ul
              id="assessment"
              class="sidebar-dropdown list-unstyled collapse"
              data-bs-parent="#sidebar"
            >
              <li class="sidebar-item">
                <a href="?content=../pages/AddIca.php" 
                  class="sidebar-link"
                  >Add Marks</a
                >
              </li>

              <li class="sidebar-item">
                <a href="?content=../pages/ViewIca.php" 
                  class="sidebar-link"
                  >View Marks</a
                >
              </li>
            </ul>
          </li>
        <?php endif; ?>
          <!-- assessment end -->

          <!-- Final start -->
        <?php if ($user_type == 'hod' || $user_type == 'lec'): ?>
          <li class="sidebar-item">
            <a
              href="#"
              class="sidebar-link has-dropdown collapsed"
              data-bs-toggle="collapse"
              data-bs-target="#final"
              aria-expanded="false"
              aria-controls="final"
            >
              <i class="bx bxs-objects-horizontal-left me-2"></i>
              <span>Final Exam</span>
            </a>
            <ul
              id="final"
              class="sidebar-dropdown list-unstyled collapse"
              data-bs-parent="#sidebar"
            >
              <li class="sidebar-item">
                <a
                  href="?content=../pages/AddFinal.php"
                  class="sidebar-link"
                  >Add Marks</a
                >
              </li>

              <li class="sidebar-item">
                <a
                  href="?content=../pages/ViewFinal.php"
                  class="sidebar-link"
                  >View Marks</a
                >
              </li>
              <!-- <li class="sidebar-item">
                <a
                  href="?content=../pages/PredictResult.php"
                  class="sidebar-link"
                  >Predict Result</a
                >
              </li> -->
            </ul>
          </li>
         <?php endif; ?>
          <!-- Final end -->

          <!-- combosite marks  start -->
        <?php if ($user_type == 'hod' || $user_type == 'lec'): ?>
          <li class="sidebar-item">
            <a href="?content=../pages/ComboMarks.php" 
              class="sidebar-link">
              <i class='bx bx-hive'></i>
              <span>Combosite Marks</span>
            </a>
          </li>
         <?php endif; ?>
          <!-- combosite marks end -->

          <!-- subject start -->
        <?php if ($user_type == 'hod'): ?>
          <li class="sidebar-item">
            <a
              href="#"
              class="sidebar-link has-dropdown collapsed"
              data-bs-toggle="collapse"
              data-bs-target="#subject"
              aria-expanded="false"
              aria-controls="subject"
            >
            <i class='bx bx-detail'></i>
              <span>Subject</span>
            </a>
            <ul
              id="subject"
              class="sidebar-dropdown list-unstyled collapse"
              data-bs-parent="#sidebar"
            >
              <li class="sidebar-item">
                <a
                  href="?content=../pages/AddSub.php&type=Add"
                  class="sidebar-link"
                  >Add Subject</a
                >
              </li>

              <li class="sidebar-item">
                <a
                  href="?content=../pages/viewEdit.php&table=subject"
                  class="sidebar-link"
                  >View / Edit Subject</a
                >
              </li>
            </ul>
          </li>
        <?php endif; ?>
          <!-- subject end -->

          <!-- faculty start -->
        <?php if ($user_type == 'superadmin'): ?>
           <li class="sidebar-item">
            <a
              href="#"
              class="sidebar-link has-dropdown collapsed"
              data-bs-toggle="collapse"
              data-bs-target="#faculty"
              aria-expanded="false"
              aria-controls="faculty"
            >
              <i class="bx bxs-school"></i>
              <span>Faculty</span>
            </a>
            <ul
              id="faculty"
              class="sidebar-dropdown list-unstyled collapse"
              data-bs-parent="#sidebar"
            >
              <li class="sidebar-item">
                <a
                  href="?content=../pages/AddFaculty.php&type=Add"
                  class="sidebar-link"
                  >Add Faculty</a
                >
              </li>

              <li class="sidebar-item">
                <a
                  href="?content=../pages/viewEdit.php&table=faculty"
                  class="sidebar-link"
                  >View / Edit Faculty</a
                >
              </li>
            </ul>
          </li>
         <?php endif; ?>
          <!-- faculty end -->

                    <!-- department start -->
        <?php if ($user_type == 'superadmin'): ?>
          <li class="sidebar-item">
            <a
              href="#"
              class="sidebar-link has-dropdown collapsed"
              data-bs-toggle="collapse"
              data-bs-target="#department"
              aria-expanded="false"
              aria-controls="department"
            >
            <i class='bx bxs-ruler'></i>
              <span>Deparment</span>
            </a>
            <ul
              id="department"
              class="sidebar-dropdown list-unstyled collapse"
              data-bs-parent="#sidebar"
            >
              <li class="sidebar-item">
                <a
                  href="?content=../pages/AddDep.php&type=Add"
                  class="sidebar-link"
                  >Add Department</a
                >
              </li>

              <li class="sidebar-item">
                <a
                  href="?content=../pages/viewEdit.php&table=department"
                  class="sidebar-link"
                  >View / Edit Department</a
                >
              </li>
            </ul>
          </li>
         <?php endif; ?>
          <!-- department end -->

          <!-- course start -->
        <?php if ($user_type == 'superadmin'): ?>
          <li class="sidebar-item">
            <a
              href="#"
              class="sidebar-link has-dropdown collapsed"
              data-bs-toggle="collapse"
              data-bs-target="#course"
              aria-expanded="false"
              aria-controls="course"
            >
            <i class='bx bxs-briefcase-alt-2'></i>
              <span>Course</span>
            </a>
            <ul
              id="course"
              class="sidebar-dropdown list-unstyled collapse"
              data-bs-parent="#sidebar"
            >
              <li class="sidebar-item">
                <a
                  href="?content=../pages/AddCourse.php&type=Add"
                  class="sidebar-link"
                  >Add Course</a
                >
              </li>

              <li class="sidebar-item">
                <a
                  href="?content=../pages/viewEdit.php&table=course"
                  class="sidebar-link"
                  >View / Edit Course</a
                >
              </li>
            </ul>
          </li>
         <?php endif; ?>
          <!-- course end -->

          <!-- Lecture start -->
        <?php if ($user_type == 'superadmin'): ?>
          <li class="sidebar-item">
            <a
              href="#"
              class="sidebar-link has-dropdown collapsed"
              data-bs-toggle="collapse"
              data-bs-target="#lecturer"
              aria-expanded="false"
              aria-controls="lecturer"
            >
            <i class="bx bx-male-female me-2"></i>
              <span>Lecturer</span>
            </a>
            <ul
              id="lecturer"
              class="sidebar-dropdown list-unstyled collapse"
              data-bs-parent="#sidebar"
            >
              <li class="sidebar-item">
                <a
                  href="?content=../pages/AddLec.php&type=Add"
                  class="sidebar-link"
                  >Add Lecturer</a
                >
              </li>

              <li class="sidebar-item">
                <a
                  href="?content=../pages/viewEdit.php&table=lecture&table1=admin&tcol=admin_id&t1col=admin_id"
                  class="sidebar-link"
                  >View / Edit Lecturer Details</a
                >
              </li>
            </ul>
          </li>
        <?php endif; ?>
          <!-- Lecture end -->
          
          <!-- Student start -->
        <?php if ($user_type == 'hod' || $user_type == 'superadmin'): ?>
          <li class="sidebar-item">
            <a
              href="#"
              class="sidebar-link has-dropdown collapsed"
              data-bs-toggle="collapse"
              data-bs-target="#student"
              aria-expanded="false"
              aria-controls="student"
            >
            <i class='bx bx-child'></i>
              <span>Student</span>
            </a>
            <ul
              id="student"
              class="sidebar-dropdown list-unstyled collapse"
              data-bs-parent="#sidebar"
            >
              <li class="sidebar-item">
                <a
                  href="?content=../pages/AddStudent.php"
                  class="sidebar-link"
                  >Add Student</a
                >
              </li>

              <li class="sidebar-item">
                <a
                  href="?content=../pages/viewEdit.php&table=student&table1=index_no&tcol=reg_no&t1col=reg_no"
                  class="sidebar-link"
                  >View / Edit student</a
                >
              </li>
            </ul>
          </li>
         <?php endif; ?>
        <!-- Student end -->


          <!-- <li class="sidebar-item">
            <a href="?content=../pages/Profile.php" 
              class="sidebar-link">
              <i class="bx bx-user me-2"></i>
              <span>Profile</span>
            </a>
          </li> -->
          <li class="sidebar-item">
            <a href="?content=../pages/login.php" 
              class="sidebar-link">
              <i class="bx bx-log-out-circle me-2"></i>
              <span>Logout</span>
            </a>
          </li>
        </ul>

        <!-- sidebar footer -->
        
      </aside>
      <div class="main p-3">
        <div class="top-bar text-center">
          <h2>EXAM RESULTS MANAGEMENT SYSTEM WITH PREDICTIVE ANALYTICS</h2>
          <hr />
        </div>
      <div class="content">
        <div class="container">
          <?php
                if(isset($_GET['content'])){
                    $contentPage=$_GET['content'];
                    if(file_exists($contentPage)){
                        include($contentPage);
                    }
                }else{
                  // $contentPage="../pages/home.php";
                  //   if(file_exists($contentPage)){
                  //       include($contentPage);
                  //   #echo '<img src="../logo.png" width=30%>';
                  //   }
                }
                
            ?>
        </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap JS -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>

    <script src="../Dashboard/Main.js"></script>
  </body>
</html>
<?php 

ob_end_flush();

?>