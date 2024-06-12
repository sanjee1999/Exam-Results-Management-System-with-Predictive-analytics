<?php
    define('host', 'localhost');
	define('user', 'root');
	define('pwd', '');
	define('db', 'exam_result_management');

	$conn=mysqli_connect(host,user,pwd,db);

	if($conn){
		#echo "Database Connected !";
	  }
	  else{
		die ("connection error : ".mysqli_connect_error());
	  }
?>