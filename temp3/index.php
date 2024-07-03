<!DOCTYPE html>
<html>
<head>
    <title>Filter Search</title>
    <script src="script.js"></script>
</head>
<body>
    <form id="searchForm" oninput="submitForm()">
        <label for="date">Date:</label>
        <input type="date" id="date" name="date"><br>

        <label for="hour">Hour:</label>
        <input type="number" id="hour" name="hour"><br>

        <label for="sub_code">Subject Code:</label>
        <input type="text" id="sub_code" name="sub_code"><br>

        <label for="year">Year:</label>
        <input type="number" id="year" name="year"><br>

        <label for="reg_no">Registration Number:</label>
        <input type="text" id="reg_no" name="reg_no"><br>

        <!-- <input type="button" value="Search" onclick="submitForm()"> -->
    </form>

    <h3>Generated SQL Query:</h3>
    <p id="query">SELECT reg_no, date, sub_code FROM attendance WHERE 1=1</p>

    <div id="results"></div>
</body>
</html>
