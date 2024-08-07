<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Chart and Table Example</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="fetch.js" defer></script>
</head>
<body>
    <div class="container">
        <!-- Checkbox to toggle between chart and table -->
        <input type="checkbox" id="showChart"> Show Chart
    </div>
   

    <!-- Hidden form for sending data -->
    <form id="dataForm" >
        <!-- Input fields for data -->
        <input type="text" name="label1" placeholder="Label 1">
        <input type="number" name="value1" placeholder="Value 1">
        <input type="text" name="label2" placeholder="Label 2">
        <input type="number" name="value2" placeholder="Value 2">
        <!-- You can add more fields as needed -->
    </form> 
    <div class="container" id="viewout"></div>
</body>
</html>
