<?php
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["excelFile"])) {
    $file = $_FILES['excelFile']['tmp_name'];
    $spreadsheet = IOFactory::load($file);
    $sheet = $spreadsheet->getActiveSheet();
    $header = $sheet->rangeToArray('A1:' . $sheet->getHighestColumn() . '1')[0];

    echo json_encode(['headers' => $header]);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $year1 = $_POST['year1'];
    $year2 = $_POST['year2'];
    $reg_no_column = $_POST['reg_no'];
    $attendent_column = $_POST['attendent'];

    // Handle file upload
    $file = $_FILES['excelFile']['tmp_name'];
    $spreadsheet = IOFactory::load($file);
    $sheet = $spreadsheet->getActiveSheet();
    $header = $sheet->rangeToArray('A1:' . $sheet->getHighestColumn() . '1')[0];

    // Store data in MySQL
    $servername = "localhost";
    $username = "root";
    $password = " ";
    $dbname = "exam_result_management";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $data = $sheet->toArray();
    foreach ($data as $row) {
        if ($row[0] == $reg_no_column) {
            continue; // Skip header row
        }
        $reg_no = $row[array_search($reg_no_column, $header)];
        $attendent = $row[array_search($attendent_column, $header)];

        $sql = "INSERT INTO attendance (reg_no, attendent, year1, year2)
                VALUES ('$reg_no', '$attendent', '$year1', '$year2','$year1')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>
