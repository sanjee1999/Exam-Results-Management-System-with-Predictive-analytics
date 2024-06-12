<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>View dail attendance</title>
    <!-- get icons -->
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />

    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <lord-icon trigger="hover" src="/my-icon.json"></lord-icon>

    <link rel="stylesheet" href="../Sidebar/Sider.css" />
    <link rel="stylesheet" href="../Style/ViewDailyAttendance.css" />

    <!-- get bootstrap -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />

    <link rel="stylesheet" href="Slider.css" />
  </head>
  <body>
    
          <div class="title text-center">
            <h3>- View Daily Attendance -</h3>
          </div>

          <div class="input-section py-5 mb-5">
            <div class="form d-flex justify-content-center align-items-center">
              <form action="#" method="post" class="row">
                <div class="form-group col-md-3" id="subject">
                  <select name="subject" id="subject" class="form-control">
                    <option value="" selected disabled>Select Subject</option>
                    <option value="Subject-01">Subject 01</option>
                    <option value="Subject-02">Subject 02</option>
                    <option value="Subject-03">Subject 03</option>
                    <option value="Subject-04">Subject 04</option>
                  </select>
                </div>

                <div class="form-group col-md-3" id="year">
                  <select name="Year" id="year" class="form-control">
                    <option value="" selected disabled>Select Year</option>
                    <option value="2019/2020">1st Year</option>
                    <option value="2020/2021">2nd Year</option>
                    <option value="2021/2022">3rd Year</option>
                    <option value="2022/2023">4th Year</option>
                  </select>
                </div>
                <div class="form-group col-md-3" id="year">
                  <input
                    type="date"
                    name="date"
                    id="date"
                    class="form-control"
                  />
                </div>

                <div class="form-group col-md-3">
                  <button class="btn btn-primary w-100">View</button>
                </div>
              </form>
            </div>
          </div>
          <div class="title text-center">
            <h3>- 2024.11.05 attendance for CSC2113 -</h3>
          </div>

          <section class="p-5">
            <div class="table-responsive" id="table1">
              <table class="table bg-white">
                <thead class="bg-dark text-light">
                  <tr>
                    <th>Reg.no</th>
                    <th>Name</th>
                    <th>Present</th>
                    <th>Absent</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td data-title="Reg.no">2019/ASP/01</td>
                    <td data-title="Name">Name 01</td>
                    <td data-title="Present">Yes</td>
                    <td data-title="Absent">-</td>
                  </tr>
                  <tr>
                    <td data-title="Reg.no">2019/ASP/01</td>
                    <td data-title="Name">Name 01</td>
                    <td data-title="Present">Yes</td>
                    <td data-title="Absent">-</td>
                  </tr>
                  <tr>
                    <td data-title="Reg.no">2019/ASP/01</td>
                    <td data-title="Name">Name 01</td>
                    <td data-title="Present">Yes</td>
                    <td data-title="Absent">-</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </section>
        

    <!-- Bootstrap JS -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>

    <script src="../Sidebar/Main.js"></script>
  </body>
</html>
