<?php $query=isset($query)?$query:null; ?>

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

    <!-- <div class="container mt-5">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exportModal">
            Export Data
        </button>
    </div> -->
    
    <!-- Modal for Export Customization -->
    <div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exportModalLabel">Customize Export Options</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="exportForm" action="../pages/export.php" method="post">
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
                            <!-- <input type="hidden" name="result" value="<?php //echo $data; ?>"> -->
                            <input type="hidden" name="result" value='<?php echo json_encode($data); ?>'>
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


