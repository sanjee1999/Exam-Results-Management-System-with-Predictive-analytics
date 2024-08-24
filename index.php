<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="index.css" />
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
            <img src="logo.png" alt="" class="w-25" />
          </div>

          <h4
            class="card-title d-flex justify-content-center pb-3 pt-3 text-center"
          >
            Exam Results Management System with Predictive Analytics
          </h4>
          <h5 class="card-title d-flex justify-content-center pb-3 pt-1">
            -Log in-
          </h5>

          <form
            class="w-90"
            method="post"
            action="Dashboard/Sider.php"
          >
            <div class="form-group">
              <input
                type="email"
                class="form-control"
                id="Email1"
                aria-describedby="emailHelp"
                placeholder="Enter email or Reg.No"
                required
              />
            </div>
            <div class="form-group">
              <input
                type="password"
                class="form-control"
                id="Password1"
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
<!-- m,nknmnm -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
