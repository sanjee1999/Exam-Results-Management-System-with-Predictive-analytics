<?php
//session_start();
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
    
   
   
    //$sql = "SELECT * FROM `attendance` WHERE 1";
    if(!empty($sql)){
        $queryResult = $conn->query($sql);
    }else{
        $queryResult = json_decode($_POST['result'], true);
    }
    
    // Check if $queryResult is an associative array
    if (is_array($queryResult) && count($queryResult) > 0) {
        $result=$queryResult;
    } elseif ($queryResult instanceof mysqli_result && $queryResult->num_rows > 0) {
        // Handle as a MySQLi result object
        $result = [];
        while ($row = $queryResult->fetch_assoc()) {
            $result[] = $row;
        }
    } else {
        die("No data found or invalid data format.");
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