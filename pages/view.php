<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<section class="p-5">
            <div class="table-responsive" id="table1">
              <table class="table bg-white">
                <thead class="bg-dark text-light">
                  <tr>
                    <th>Reg.no</th>
                    <th>Name</th>
                    <th>Present</th>
                    <th>Absent</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td data-title="Reg.no">2019/ASP/01</td>
                    <td data-title="Name">Name 01</td>
                    <td data-title="Present">Yes</td>
                    <td data-title="Absent">-</td>
                  </tr>
                  <tr>
                    <td data-title="Reg.no">2019/ASP/01</td>
                    <td data-title="Name">Name 01</td>
                    <td data-title="Present">Yes</td>
                    <td data-title="Absent">-</td>
                  </tr>
                  <tr>
                    <td data-title="Reg.no">2019/ASP/01</td>
                    <td data-title="Name">Name 01</td>
                    <td data-title="Present">Yes</td>
                    <td data-title="Absent">-</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </section>
        
</body>
</html>
<?php
function outputQueryInTable($conn,$query) {
   
    // Execute query
    $result = $conn->query($query);

    // Check if query was successful
    if ($result === FALSE) {
        echo "Error: " . $conn->error;
    } else {
        // Start table
        echo '<table class="table bg-white">';
        
        // Output table headers
        echo '<thead class="bg-dark text-light">';
        echo '<tr>';
        while ($field = $result->fetch_field()) {
            echo '<th>' . htmlspecialchars($field->name) . '</th>';
        }
        echo '</tr>';
        echo '</thead>';

        // Output table rows
        echo '<tbody>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            foreach ($row as $cell) {
                echo '<td>' . htmlspecialchars($cell) . '</td>';
            }
            echo '</tr>';
        }
        echo '</tbody>';
        // End table
        echo '</table>';
    }

    // Close connection
    $conn->close();
}

?>