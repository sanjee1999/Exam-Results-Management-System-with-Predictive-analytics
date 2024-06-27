
<?php
require '../vendor/autoload.php'; // Include PHPSpreadsheet

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . basename($_FILES['file']['name']);

    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
        $spreadsheet = IOFactory::load($uploadFile);
        $worksheet = $spreadsheet->getActiveSheet();
        $firstRow = $worksheet->rangeToArray('A1:' . $worksheet->getHighestColumn() . '1')[0];

        echo '<h2>First Row Data:</h2>';
        echo '<table border="1">';
        echo '<tr>';
        foreach ($firstRow as $cell) {
            echo '<td>' . htmlspecialchars($cell) . '</td>';
        }
        echo '</tr>';
        echo '</table>';
    } else {
        echo 'Possible file upload attack!';
    }
} else {
    echo 'Invalid request';
}
?>