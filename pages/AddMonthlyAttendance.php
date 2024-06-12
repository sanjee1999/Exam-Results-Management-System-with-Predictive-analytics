<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add monthy attendance</title>
    <!-- get icons -->
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />

    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <lord-icon trigger="hover" src="/my-icon.json"></lord-icon>

    <link rel="stylesheet" href="./Sider.css" />

    <link rel="stylesheet" href="../Style/AddMonthlyAttendance.css" />

    <!-- get bootstrap -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />

    <link rel="stylesheet" href="../Sidebar/Sider.css" />
  </head>
  <body>
   
          <div class="title text-center">
            <h3>- Add Monthly Attendance -</h3>
          </div>

          <div class="container">
            <div class="form d-flex justify-content-center align-items-center">
              <form action="#" method="post">
                <div class="form-group" id="subject">
                  <select name="subject" id="subject" class="form-control">
                    <option value="" selected disabled>Select Subject</option>
                    <option value="2022">Subject 01</option>
                    <option value="2023">Subject 02</option>
                    <option value="2024">Subject 03</option>
                    <option value="2025">Subject 04</option>
                  </select>
                </div>

                <div class="form-group" id="year">
                  <select name="Year" id="year" class="form-control">
                    <option value="" selected disabled>Select Year</option>
                    <option value="2022">1 st Year</option>
                    <option value="2023">2 nd Year</option>
                    <option value="2024">3 rd Year</option>
                    <option value="2025">4 th Year</option>
                  </select>
                </div>

                <div class="form-group" id="date">
                  <select name="Year" id="year" class="form-control">
                    <option value="" selected disabled>Select Month</option>
                    <option value="2022">January</option>
                    <option value="2023">February</option>
                    <option value="2024">March</option>
                    <option value="2025">April</option>
                  </select>
                </div>

                <div class="form-group">
                  <input type="file" class="form-control" />
                </div>

                <div class="form-group">
                  <button class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>

    <!-- Bootstrap JS -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>

    <script src="../Sidebar/Main.js"></script>
  </body>
</html>
