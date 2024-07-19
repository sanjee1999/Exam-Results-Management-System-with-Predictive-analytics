<?php  
ob_start();
session_start();
require_once '../connection/conf.php';
require_once '../function/fun.php';

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
            <a href="?content=../pages/Home.php" 
              class="sidebar-link">
              <i class="bx bx-home-alt me-2"></i>
              <span>Home</span>
            </a>
          </li>

          <!-- attendance start -->
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
                  <li class="sidebar-item">
                    <a
                      href="?content=../pages/ViewMonthlyAttendance.php"
                      class="sidebar-link"
                      >View Monthly Attendance</a
                    >
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          <!-- attendance end -->

          <!-- assesment start -->
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
          <!-- assessment end -->

          <!-- Final start -->

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
              <li class="sidebar-item">
                <a
                  href="?content=../pages/PredictResult.php"
                  class="sidebar-link"
                  >Predict Result</a
                >
              </li>
            </ul>
          </li>
          <!-- Final end -->

          <!-- combosite marks  start -->

          <li class="sidebar-item">
            <a href="?content=../pages/combo.php" 
              class="sidebar-link">
              <i class='bx bx-hive'></i>
              <span>Combosite Marks</span>
            </a>
          </li>
          <!-- combosite marks end -->

          <!-- subject start -->

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
          <!-- subject end -->

          <!-- faculty start -->

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
          <!-- faculty end -->

          <!-- course start -->

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
          <!-- course end -->

          <!-- department start -->

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
          <!-- department end -->

          <li class="sidebar-item">
            <a href="?content=../pages/Student.php" 
              class="sidebar-link">
              <i class="bx bx-male-female me-2"></i>
              <span>Lecture</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a href="?content=../pages/Student.php" 
              class="sidebar-link">
              <i class='bx bx-child'></i>
              <span>Student</span>
            </a>
          </li>

          <li class="sidebar-item">
            <a href="?content=../pages/Profile.php" 
              class="sidebar-link">
              <i class="bx bx-user me-2"></i>
              <span>Profile</span>
            </a>
          </li>
        </ul>

        <!-- sidebar footer -->
        <div class="sidebar-footer">
          <a href="../index.html" class="sidebar-link">
            <i class="bx bx-log-out-circle me-2"></i>
            <span>Logout</span>
          </a>
        </div>
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

      <!--  -->
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