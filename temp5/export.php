<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom animation for the popup */
        .modal.fade .modal-dialog {
            transform: translateY(-100%);
            transition: transform 0.3s ease-out;
        }
        .modal.show .modal-dialog {
            transform: translateY(0);
        }
    </style>
</head>

    <div class="container mt-5">
        <!-- Export Button -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exportModal">
            Export Data
        </button>
    </div>
    <?php $query="SELECT * FROM `attendance` WHERE 1"; ?>
    <!-- Modal for Export Customization -->
    <div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exportModalLabel">Customize Export Options</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="exportForm" action="" method="post">
                        <div class="mb-3">
                            <label for="format" class="form-label">Export Format</label>
                            <select class="form-select" id="format" name="format" required>
                                <option value="csv">CSV</option>
                                <option value="excel">Excel</option>
                                <option value="docx">DOCX</option>
                                <option value="pdf">PDF</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="fileSize" class="form-label">File Size</label>
                            <select class="form-select" id="fileSize" name="fileSize" required>
                                <option value="A4">A4</option>
                                <option value="A3">A3</option>
                                <option value="Letter">Letter</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="colorMode" class="form-label">Color Mode</label>
                            <select class="form-select" id="colorMode" name="colorMode" required>
                                <option value="Color">Color</option>
                                <option value="Monochrome">Monochrome</option>
                            </select>
                            <input type="hidden" name="query" value="<?php echo $query;?>">
                        </div>
                        <button type="submit" class="btn btn-success">Export</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
session_start();
require_once '../connection/conf.php';
require_once '../function/fun.php';


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

error_reporting(0);
// Include Composer autoload file
require '../vendor/autoload.php';

// Import necessary classes
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
//use TCPDF;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $format = $_POST['format'];
    $size = $_POST['fileSize'];
    $colorMode = $_POST['colorMode'];
    $sql=$_POST['query'];

    // Example query, replace with your actual query
    //$sql = "SELECT * FROM `attendance` WHERE 1";
    $queryResult = $conn->query($sql);

    if ($queryResult->num_rows > 0) {
        $result = [];
        while ($row = $queryResult->fetch_assoc()) {
            $result[] = $row;
        }
    } else {
        die("No data found.");
    }

    // Prevent any accidental output
    ob_clean();
    ob_start();

    switch ($format) {
        case 'csv':
            
            // Set the correct headers for CSV file download
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment;filename="data.csv"');
            header('Cache-Control: max-age=0');

            $output = fopen('php://output', 'w');
            // Write the header row
            fputcsv($output, array_keys($result[0]));
            // Write the data rows
            foreach ($result as $row) {
                fputcsv($output, $row);
            }

            fclose($output);

            // Clean up
            ob_end_flush();
            //exit();
            break;

        case 'excel':

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $sheet->getPageSetup()->setPaperSize(
                $size == 'A4' ? \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4 :
                ($size == 'A3' ? \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A3 :
                \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_LETTER)
            );

            // Write the header row
            $sheet->fromArray(array_keys($result[0]), NULL, 'A1');

            // Write the data rows
            $sheet->fromArray($result, NULL, 'A2');

            // Apply monochrome color mode if selected
            if ($colorMode == 'Monochrome') {
                $spreadsheet->getDefaultStyle()->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK));
            }

            $writer = new Xlsx($spreadsheet);

            // Set the correct headers for Excel file download
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="data.xlsx"');
            header('Cache-Control: max-age=0');
            
            // Save to output buffer
            $writer->save('php://output');

            // Clean up
            ob_end_flush();
            break;

            case 'docx':
                // Create a new PhpWord object
                $phpWord = new PhpWord();
    
                // Add a new section to the document
                $section = $phpWord->addSection();
    
                // Add content to the section (e.g., table with data)
                $table = $section->addTable();
                // Add header row
                $headerRow = array_keys($result[0]);
                $table->addRow();
                foreach ($headerRow as $headerCell) {
                    $table->addCell(2000)->addText($headerCell);
                }
                // Add data rows
                foreach ($result as $row) {
                    $table->addRow();
                    foreach ($row as $cell) {
                        $table->addCell(2000)->addText($cell);
                    }
                }
    
                // Apply monochrome color mode if selected
                if ($colorMode == 'Monochrome') {
                    foreach ($phpWord->getSections() as $section) {
                        foreach ($section->getElements() as $element) {
                            if (method_exists($element, 'getFontStyle')) {
                                $fontStyle = $element->getFontStyle();
                                $fontStyle->setColor('000000'); // Set to black
                            }
                        }
                    }
                }
    
                // Save the document to output
                header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
                header('Content-Disposition: attachment;filename="data.docx"');
                header('Cache-Control: max-age=0');
    
                $writer = IOFactory::createWriter($phpWord, 'Word2007');
                $writer->save('php://output');
    
                // Clean up
                ob_end_flush();
                //exit();
                break;
    
    
                case 'pdf':
                    // Create new PDF document
                    $pdf = new TCPDF();
        
                    // Set document information
                    $pdf->SetCreator(PDF_CREATOR);
                    $pdf->SetAuthor('Author Name');
                    $pdf->SetTitle('Exported Data');
                    $pdf->SetSubject('Exported Data');
        
                    // Set default header data
                    $pdf->SetHeaderData('', 0, 'Exported Data', '');
        
                    // Set margins
                    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
                    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
                    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        
                    // Set auto page breaks
                    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        
                    // Add a page with the specified page format
                    $pageFormat = ($size == 'A4') ? 'A4' : (($size == 'A3') ? 'A3' : 'LETTER');
                    $pdf->AddPage('P', $pageFormat);
        
                    // Set monochrome mode if selected
                    if ($colorMode == 'Monochrome') {
                        $pdf->SetTextColor(0, 0, 0); // Black
                    }
        
                    // Add content to PDF
                    $html = '<h1>Exported Data</h1><table border="1" cellspacing="3" cellpadding="4">';
                    $html .= '<tr>';
                    foreach (array_keys($result[0]) as $header) {
                        $html .= '<th>' . $header . '</th>';
                    }
                    $html .= '</tr>';
                    foreach ($result as $row) {
                        $html .= '<tr>';
                        foreach ($row as $column) {
                            $html .= '<td>' . $column . '</td>';
                        }
                        $html .= '</tr>';
                    }
                    $html .= '</table>';
        
                    $pdf->writeHTML($html, true, false, true, false, '');
        
                    // Close and output PDF document
                    $pdf->Output('data.pdf', 'D');
        
                    // Clean up
                    ob_end_flush();
                    //exit();
                    break;
                
    }
}
$conn->close();