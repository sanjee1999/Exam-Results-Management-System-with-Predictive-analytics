html
Copy code
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Input Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        /* Hide the original file input */
        input[type="file"] {
            display: none;
        }

        /* Custom file input button */
        .custom-file-label {
            display: inline-block;
            cursor: pointer;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            margin-top: 5px;
        }

        /* Style for the displayed file name */
        .file-name {
            margin-top: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>File Input Form</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="file">Select File:</label>
                <label class="custom-file-label" for="file">Load File</label>
                <input type="file" name="file" id="file" class="form-control">
                <input type="hidden" name="file_name" id="file_name" value="<?php echo isset($_POST['file_name']) ? htmlspecialchars($_POST['file_name']) : ''; ?>">
                <p class="file-name" id="file-name-display"></p>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <!-- Display the selected file name if it exists -->
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
                $fileName = htmlspecialchars(basename($_FILES["file"]["name"]));
                echo "<p>Selected File: <strong>$fileName</strong></p>";
                echo "<script>document.getElementById('file_name').value = '$fileName';</script>";
                echo "<script>document.getElementById('file-name-display').innerText = '$fileName';</script>";
            } elseif (isset($_POST['file_name']) && $_POST['file_name'] != '') {
                $fileName = htmlspecialchars($_POST['file_name']);
                echo "<p>Previously Selected File: <strong>$fileName</strong></p>";
                echo "<script>document.getElementById('file-name-display').innerText = '$fileName';</script>";
            }
        }
        ?>
    </div>

    <script>
        document.getElementById('file').addEventListener('change', function() {
            var fileName = this.files[0].name;
            document.querySelector('.custom-file-label').innerText = 'File Loaded';
            document.getElementById('file-name-display').innerText = fileName;
            document.getElementById('file_name').value = fileName;
        });
    </script>
</body>
</html>


<!DOCTYPE html>
<html>
<head>
    <title>Change File Input Text</title>
    <style>
        /* Hide the default file input */
        input[type="file"] {
            display: none;
        }
        /* Style the custom button */
        .custom-file-upload {
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <form>
        <label for="file-upload" class="custom-file-upload">
            Select file
        </label>
        <input id="file-upload" type="file"/>
        <span id="file-name">No file chosen</span>
    </form>

    <script>
        document.getElementById('file-upload').addEventListener('change', function() {
            var fileName = this.files[0] ? this.files[0].name : 'No file chosen';
            document.getElementById('file-name').textContent = fileName;
        });
    </script>
</body>
</html>
