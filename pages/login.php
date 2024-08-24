<?php
session_start();
include '../connection/conf.php';
include_once '../function/fun.php';


if (isAuthenticated()) {
    logout();
    exit();
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['user'];
    $password = $_POST['password'];

    // Ensure the database connection is properly initialized
    //$conn = dbConnect(); // Ensure this function is correctly implemented

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT admin.password, admin.admin_type ,lecture.lec_name
                            FROM lecture 
                            RIGHT JOIN admin ON admin.admin_id = lecture.admin_id 
                            WHERE admin.admin_id = ? OR lecture.lec_id = ?");
    
    // Bind both parameters
    $stmt->bind_param("ss", $username, $username);

    // Execute the statement
    $stmt->execute();
    
    // Bind the results
    $stmt->bind_result($password_hash, $user_type,$lec_name);
    $stmt->fetch();

    // Close the statement and connection
    $stmt->close();
    $conn->close();

    // Verify the password and handle the result
    if ($password_hash !== null && password_verify($password, $password_hash)) {
        session_start(); // Ensure the session is started
        $_SESSION['user'] = $username;
        $_SESSION['user_type'] = $user_type;
        $_SESSION['lec_name'] = $lec_name;
        header('Location: ../Dashboard/Sider.php?content=../pages/Home.php');
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="../Style/login.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
  </head>
  <body>
    <div
      class="container justify-content-center d-flex align-items-center mt-5 min-vh-100"
    >
      <!-- card  -->
      <div class="card custom-card" style="width: 25rem">
        <div class="card-body">
          <div class="img1 d-flex justify-content-center mt-5">
            <img src="../logo.png" alt="" class="w-25" />
          </div>

          <h4
            class="card-title d-flex justify-content-center pb-3 pt-3 text-center"
          >
            Exam Results Management System WITH PREDICTIVE ANALYTICS
          </h4>
          <h5 class="card-title d-flex justify-content-center pb-3 pt-1">
            -Log in-
          </h5>

          <form
            class="w-90"
            method="post"
            action=""
          >
          <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
            <div class="form-group">
              <input
                type="text"
                class="form-control"
                id="user"
                name="user"
                
                placeholder="Enter the Admin ID"
                required
              />
            </div>
            <div class="form-group">
              <input
                type="password"
                class="form-control"
                id="Password"
                name="password"
                placeholder="Password"
                required
              />
            </div>

            <div class="d-flex justify-content-center">
              <!-- Center align button -->
              <button type="submit" class="btn mt-5 w-100">Login</button>
            </div>
            <div
              class="forgot d-flex justify-content-center align-items-center"
            >
              <p class="m-0">Forgot password</p>
              <a
                href="#"
                class="ms-1"
                data-bs-toggle="modal"
                data-bs-target="#forgot-m1"
                >Click here</a
              >
            </div>
          </form>
        </div>
      </div>
    </div>

    <!--=============================== Pop-up (forgot password)===================================== -->
    <div class="modal" id="forgot-m1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Change Password</h5>
            <button
              class="btn-close"
              type="button"
              data-bs-dismiss="modal"
            ></button>
          </div>
          <!-- ======== modal body ========= -->
          <div
            class="modal-body2 my-5 d-flex justify-content-center align-items-center flex-column"
          >
            <form
              class="mform text-center"
              action="../Attendance/ViewDaily.html"
              method="post"
              onsubmit="return validateForm()"
            >
              <div class="form-group">
                <input
                  type="text"
                  class="form-control"
                  id="regno"
                  placeholder="Enter Reg.No or Email"
                  required
                />
              </div>

              <div class="form-group" class="form-control" id="newPass">
                <input
                  type="text"
                  class="form-control"
                  id="password"
                  placeholder="Enter new password"
                  required
                />
              </div>
              <div class="form-group" class="form-control" id="cnewPass">
                <input
                  type="text"
                  class="form-control"
                  id="password"
                  placeholder="Confirm password"
                  required
                />
              </div>

              <div
                class="modal-footer d-flex justify-content-center align-items-center"
              >
                <div class="error-message" id="error-message"></div>

                <button type="submit" class="btn btn-primary mb-3">
                  Change Password
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
