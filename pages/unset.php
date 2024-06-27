<?php
session_start();
// PHP code to handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Call your function here
    myFunction();
}

// Example function
function myFunction() {
    session_unset();
    header('location:../Dashboard/Sider.php?content=../pages/test.php');
}
?>