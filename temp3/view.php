<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "exam_result_management";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize filter variables
$date = isset($_POST['date']) ? $_POST['date'] : null;
$hour = isset($_POST['hour']) ? $_POST['hour'] : null;
$sub_code = isset($_POST['sub_code']) ? $_POST['sub_code'] : null;
$year = isset($_POST['year']) ? $_POST['year'] : null;
$reg_no = isset($_POST['reg_no']) ? $_POST['reg_no'] : null;

// Build the query dynamically based on filters
$query = "SELECT reg_no, date, sub_code FROM attendance WHERE 1=1";

if ($date) {
    $query .= " AND date = '$date'";
}
if ($hour) {
    $query .= " AND hour = $hour";
}
if ($sub_code) {
    $query .= " AND sub_code = '$sub_code'";
}
if ($year) {
    $query .= " AND year = $year";
}
if ($reg_no) {
    $query .= " AND reg_no = '$reg_no'";
}
echo "$query";
$result = $conn->query($query);

// Check for results
if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>Registration Number</th>
                <th>Date</th>
                <th>Subject Code</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['reg_no']}</td>
                <td>{$row['date']}</td>
                <td>{$row['sub_code']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No results found.";
}

$conn->close();
?>
