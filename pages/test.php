<!-- HTML form -->
<form method="post" action="../pages/unset.php">
    <button type="submit" name="submit_button">unsett</button>
</form>



<?php
require '../vendor/autoload.php'; // Include PHPSpreadsheet



#session_unset();
     #$reg_no=$_SESSION['reg_no'];
     $date=$_SESSION['date'];
     $time=$_SESSION['time'];
     $hour=$_SESSION['hour'];
     $sub_code=$_SESSION['sub_code'];
     $year=$_SESSION['year'];
     $firstRow=$_SESSION['firstRow'];
     $col1=$_SESSION['col1'];
     $col2=$_SESSION['col2'];
     $highestRow=$_SESSION['highestRow'];
     $type=$_SESSION['type'];
     $heading=$_SESSION['heading'];

     if(!empty($year) && !empty($sub_code) && !empty($date) ){
    } 
        print_r($col1);
        echo "<br>";
        print_r($col2);
        echo "<br>";
        echo $firstRow[2];
        echo "<br>";
        print_r($firstRow);
        echo "<br> $year $sub_code $date $time $hour $highestRow $type $heading";
        // for($row=0; $row<$highestRow-1; $row++){
        //     $query="INSERT INTO attendance VALUES ('$col1[$row]','$date','$time','$hour','$sub_code','$col2[$row]','$year')";
        //     $result=mysqli_query($conn,$query);
        //   }
        //upload($conn);
     
     // Assuming the array col1 is defined like this
     $col4 = array("value1", "value2", "value3");
     
     // To echo the first element (index 1)
     echo "<br>".$col1[4];
     
     

?>
