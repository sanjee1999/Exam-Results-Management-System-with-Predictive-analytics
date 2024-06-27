<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Ica</title>
    <!-- get icons -->
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />

    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="../Sidebar/Sider.css" />
    <link rel="stylesheet" href="../Style/AddIca.css" />

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
            <h3>- Add ICA Marks -</h3>
          </div>

          <div class="container">
            <div class="form d-flex justify-content-center align-items-center">
              <form action="../Dashboard/Sider.php?content=../pages/upload.php&heading=ica&type=ica"
               method="post" enctype="multipart/form-data">
                <div class="form-group" id="subject">
                  <select name="sub_code" id="sub_code" class="form-control" required>
                    <option value="" selected disabled>Select Subject</option>
                    <option value="Subject-01">Subject 01</option>
                    <option value="Subject-02">Subject 02</option>
                    <option value="Subject-03">Subject 03</option>
                    <option value="Subject-04">Subject 04</option>
                  </select>
                </div>

                <div class="form-group" id="year">
                  <select name="year" id="year" class="form-control" required>
                    <option value="" selected disabled>Select Year</option>
                    <option value="1">1 st Year</option>
                    <option value="2">2 nd Year</option>
                    <option value="3">3 rd Year</option>
                    <option value="4">4 th Year</option>
                  </select>
                </div>

                <div class="form-group" id="ica">
                  <select name="ica" id="ica" class="form-control" required>
                    <option value="" selected disabled>Select ICA No</option>
                    <option value="ica1">ICA 01</option>
                    <option value="ica2">ICA 02</option>
                    <option value="ica3">ICA 03</option>
                    <option value="ica4">ICA 04</option>
                  </select>
                </div>

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
    <!-- <script src="../script/fileupload.js">
    </script>     -->
    <!-- Bootstrap JS -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>

    <script src="../Sidebar/Main.js"></script>
  </body>
</html>
