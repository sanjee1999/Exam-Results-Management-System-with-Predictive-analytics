<!DOCTYPE html>
<html>
<head>
    <title>Upload Excel File</title>
</head>
<body>
    <form method="POST" enctype="multipart/form-data" action="upload.php">
        <div class="form-group">
            <label for="year1">Select Year 1:</label>
            <select name="year1" id="year1" class="form-control" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
        </div>

        <div class="form-group">
            <label for="year2">Select Year 2:</label>
            <select name="year2" id="year2" class="form-control" required>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
            </select>
        </div>

        <div class="form-group">
            <label for="excelFile">Select Excel File:</label>
            <input type="file" name="excelFile" id="excelFile" accept=".xls, .xlsx" required>
        </div>

        <div class="form-group">
            <label for="reg_no">Registration Number:</label>
            <select name="reg_no" id="reg_no" class="form-control" >
                <!-- Options will be populated dynamically from Excel headers -->
            </select>
        </div>

        <div class="form-group">
            <label for="attendent">Attendant:</label>
            <select name="attendent" id="attendent" class="form-control" >
                <!-- Options will be populated dynamically from Excel headers -->
            </select>
        </div>

        <input type="submit" name="submit" value="Submit">
    </form>

    <script>
        document.getElementById('excelFile').addEventListener('change', function (event) {
            const file = event.target.files[0];
            const formData = new FormData();
            formData.append('excelFile', file);

            fetch('upload.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                const regNoSelect = document.getElementById('reg_no');
                const attendentSelect = document.getElementById('attendent');

                // Clear existing options
                regNoSelect.innerHTML = '';
                attendentSelect.innerHTML = '';

                // Populate new options
                data.headers.forEach(header => {
                    const option1 = document.createElement('option');
                    option1.value = header;
                    option1.textContent = header;
                    regNoSelect.appendChild(option1);

                    const option2 = document.createElement('option');
                    option2.value = header;
                    option2.textContent = header;
                    attendentSelect.appendChild(option2);
                });
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
</body>
</html>
