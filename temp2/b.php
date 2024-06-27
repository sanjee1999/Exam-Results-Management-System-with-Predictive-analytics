html
Copy code
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Validation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .container {
            display: none;
        }
    </style>
</head>
<body>
    <div class="form-group">
        <form id="mainForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="reg_no">Reg. No:</label>
            <input type="text" name="reg_no" id="reg_no" class="form-control" required>
            <button type="button" class="btn btn-primary" onclick="validateForm()">Submit</button>
        </form>
    </div>

    <div id="container" class="container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            reg.no: <?php if(!empty($_POST['reg_no'])){ echo htmlspecialchars($_POST['reg_no']); } ?>
        </form>
    </div>

    <script>
        function validateForm() {
            var regNo = document.getElementById('reg_no').value;
            if (regNo.trim() !== "") {
                document.getElementById('mainForm').submit();
            } else {
                alert('Input box cannot be empty.');
            }
        }

        // Show the container div if the PHP condition is met
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['reg_no'])): ?>
            document.getElementById('container').style.display = 'block';
        <?php endif; ?>
    </script>
</body>
</html>