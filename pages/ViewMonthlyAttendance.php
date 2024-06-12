<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>View monthly attendace</title>
    <!-- get icons -->
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />

    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <lord-icon trigger="hover" src="/my-icon.json"></lord-icon>

    <!-- get bootstrap -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="../Sidebar/Sider.css" />
    <link rel="stylesheet" href="../Style/ViewMonthlyAttendance.css" />
  </head>
  <body>
    
          <div class="title text-center">
            <h3>- View Monthly Attendance -</h3>
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
                  <select name="Year" id="year" class="form-control">
                    <option value="" selected disabled>Select Month</option>
                    <option value="2019/2020">January</option>
                    <option value="2020/2021">February</option>
                    <option value="2021/2022">March</option>
                    <option value="2022/2023">April</option>
                    <option value="2022/2023">May</option>
                    <option value="2022/2023">June</option>
                    <option value="2022/2023">July</option>
                    <option value="2022/2023">August</option>
                    <option value="2022/2023">September</option>
                    <option value="2022/2023">October</option>
                    <option value="2022/2023">November</option>
                    <option value="2022/2023">December</option>
                  </select>
                </div>

                <div class="form-group col-md-3">
                  <button class="btn btn-primary w-100">View</button>
                </div>
              </form>
            </div>
          </div>
          <div class="title text-center">
            <h3>- January attendance for CSC2113 -</h3>
          </div>
          <div class="chart">
            <canvas id="myChart"></canvas>
          </div>
        

    <!-- Bootstrap JS -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>

    <script src="../Sidebar/Main.js"></script>

    <!-- Chart JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
      const ctx = document.getElementById("myChart");

      new Chart(ctx, {
        type: "bar",
        data: {
          labels: [
            "2019/ASP/01",
            "2019/ASP/02",
            "2019/ASP/03",
            "2019/ASP/04",
            "2019/ASP/05",
            "2019/ASP/06",
            "2019/ASP/07",
            "2019/ASP/08",
            "2019/ASP/09",
            "2019/ASP/10",
            "2019/ASP/11",
            "2019/ASP/12",
            "2019/ASP/13",
            "2019/ASP/14",
            "2019/ASP/15",
            "2019/ASP/16",
            "2019/ASP/17",
            "2019/ASP/18",
          ],
          datasets: [
            {
              label: "Attendence percentage",
              barThickness: 20,
              barGap: 0,
              borderRadius: 5,

              data: [
                65, 59, 80, 81, 56, 55, 65, 59, 80, 81, 56, 55, 65, 59, 80, 81,
                56, 55,
              ],
              fill: false,
              backgroundColor: ["rgb(176, 139, 241)"],
            },
          ],
        },
        options: {
          indexAxis: "x",
        },
      });
    </script>
  </body>
</html>
