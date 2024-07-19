<?php
function check_access($cc){
    if($cc=='Viewer'){
        return true;
    }
    
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
   
    <h2>Dashboard</h2>

    <?php if (check_access('Admin')): ?>
        <div class="admin-section">
            <h3>Admin Section</h3>
            <p>Only accessible by Admins.</p>
        </div>
    <?php endif; ?>

    <?php if (check_access('Editor')): ?>
        <div class="editor-section">
            <h3>Editor Section</h3>
            <p>Accessible by Admins and Editors.</p>
        </div>
    <?php endif; ?>

    <?php if (check_access('Viewer')): ?>
        <div class="viewer-section">
            <h3>Viewer Section</h3>
            <p>Accessible by all user levels.</p>
        </div>
    <?php endif; ?>


</body>
</html>
