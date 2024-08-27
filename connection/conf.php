<?php
require_once '../function/fun.php';
    // define('host', 'sql203.ezyro.com');
	// define('user', 'ezyro_36972460');
	// define('pwd', 'TcgEsdt8zP');
	// define('db', 'ezyro_36972460_exam');

	define('host', 'localhost');
	define('user', 'root');
	define('pwd', '');
	//define('db', '086exam_result_management');
	define('db', 'exam');

	$_SESSION['debug']=false;
	$conn=mysqli_connect(host,user,pwd,db);


	if($conn){
		debug( "<div style='animation: blink 1s steps(1, end) infinite;'>Database Connected !</div>
				<style>@keyframes blink { 50% { opacity: 0; } }</style>");
	  }
	  else{
		die ("connection error : ".mysqli_connect_error());
	  }
?>