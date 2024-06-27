<?php 
 function exhead($firstRow,$name){
 
        echo '<div class="form-group" id="head">';
                  echo '<select name="'.$name.'" id="year" class="form-control">';
                    echo '<option value="" selected disabled>Select Year</option>';
                            foreach ($firstRow as $cell) {
                              $head=$cell;
                                echo '<option value="'.$cell.'">'. htmlspecialchars($cell) . '</option>';
                                echo htmlspecialchars($cell) ;
                            }     
                  echo '</select>';
                echo '</div>';
                #echo $head;
               # return $head;
                
}

function unsetsession(){
  unset($_SESSION['date']);
  unset($_SESSION['time']);
  unset($_SESSION['hour']);
  unset($_SESSION['sub_code']);
  unset($_SESSION['year']);
  unset($_SESSION['firstRow']);
  unset($_SESSION['col1']);
  unset($_SESSION['col2']);
  unset($_SESSION['highestRow']);
  unset($_SESSION['type']);
  unset($_SESSION['heading']);
  
}
function verify($conn,$result){
  echo "<script type='text/javascript'>";
if ($result) {
    echo "alert('Input successfully');";
    echo "window.location.href = '../Dashboard/Sider.php?content=../pages/Home.php';";
} else {
    echo "alert('There was an error');";
    echo "window.location.href = '../Dashboard/Sider.php?content=../pages/Home.php';";
}
echo "</script>";
}
  // if($result){
  //   header('location:../Dashboard/Sider.php?content=../pages/Home.php');
  //   echo "<script type='text/javascript'>alert('Input successfully');</script>";
  //   unsetsession();
    
  // }
  // else{
  //   echo "<script type='text/javascript'>alert('There was an error');</script>";
  //   die("error".mysqli_error($conn));
  // }

function upload($conn){
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
  switch($type){
    
    case 'attendance':
      for($row=0; $row<$highestRow-1; $row++){
        $query="INSERT INTO attendance VALUES ('$col1[$row]','$date','$time','$hour','$sub_code','$col2[$row]','$year')";
        $result=mysqli_query($conn,$query);
      }
       verify($conn,$result) ;
      break;

    case 'ica1':
        
      break;
    case 'ica2':
        
        break;
    case 'ica3':
        
        break;
    case 'final':
        
        break;
    default:
      
      break;
  }

}
?>