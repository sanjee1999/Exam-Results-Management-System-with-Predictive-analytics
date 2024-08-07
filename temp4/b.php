<?php
// Process POST data
$labels = [];
$values = [];

// Populate data arrays
foreach ($_POST as $key => $value) {
    if (strpos($key, 'label') === 0) {
        $index = str_replace('label', '', $key);
        $labels[] = htmlspecialchars($value);
    } elseif (strpos($key, 'value') === 0) {
        $index = str_replace('value', '', $key);
        $values[] = (int)$value;
    }
}

// Check if chart or table should be returned
$responseType = isset($_POST['responseType']) ? $_POST['responseType'] : 'table';

// Generate HTML or JSON based on response type
if ($responseType === 'chart') {
    header('Content-Type: application/json');
    echo json_encode([
        'labels' => $labels,
        'values' => $values
    ]);
} else {
    header('Content-Type: text/html');
    $tableHtml = '<table border="1"><tr><th>Label</th><th>Value</th></tr>';
    for ($i = 0; $i < count($labels); $i++) {
        $tableHtml .= "<tr><td>{$labels[$i]}</td><td>{$values[$i]}</td></tr>";
    }
    $tableHtml .= '</table>';
    echo $tableHtml;
}
?>
