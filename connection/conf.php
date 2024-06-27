<?php
    define('host', 'localhost');
	define('user', 'root');
	define('pwd', '');
	define('db', 'exam_result_management');

	$conn=mysqli_connect(host,user,pwd,db);

	if($conn){
		echo "<div style='animation: blink 1s steps(1, end) infinite;'>Database Connected !</div>
				<style>@keyframes blink { 50% { opacity: 0; } }</style>";
	  }
	  else{
		die ("connection error : ".mysqli_connect_error());
	  }
?>