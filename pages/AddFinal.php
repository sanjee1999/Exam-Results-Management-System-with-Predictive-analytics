<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add final marks</title>
    <!-- get icons -->
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />

    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <lord-icon trigger="hover" src="/my-icon.json"></lord-icon>

    <link rel="stylesheet" href="../Sidebar/Sider.css" />
    <link rel="stylesheet" href="../Style/AddFinal.css" />

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
            <h3>- Add Final Exam Marks -</h3>
          </div>

          <div class="container">
            <div class="form d-flex justify-content-center align-items-center">
              <form action="../Dashboard/Sider.php?content=../pages/upload.php&heading=final&type=final"
               method="post" enctype="multipart/form-data">
               <div class="form-group col-md-3" id="sub_code">
                  <select name="sub_code" id="sub_code" class="form-control" required>
                    <option value="" selected disabled>Select Sub_Code</option>
                    <option value="sub_1">Subject 01</option>
                    <option value="sub_2">Subject 02</option>
                    <option value="sub_3">Subject 03</option>
                    <option value="sub_4">Subject 04</option>
                  </select>
                </div>

                <!-- <div class="form-group" id="year">
                  <select name="Year" id="year" class="form-control">
                    <option value="" selected disabled>
                      Select Academic Year
                    </option>
                    <option value="2019/2020">2019/2020</option>
                    <option value="2020/2021">2020/2021</option>
                    <option value="2021/2022">2021/2022</option>
                    <option value="2022/2023">2022/2023</option>
                  </select>
                </div> -->

                

                <div class="form-group">
                  <input type="file" class="form-control" name="file" id="fileUpload" class="form-control" accept=".xlsx, .xls"
                  required/>
                </div>
                <div class="form-group">
                  <button class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
       

      <!--  -->

    <!-- Bootstrap JS -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>

    <script src="../Sidebar/Main.js"></script>
  </body>
</html>
