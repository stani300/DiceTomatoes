<?php
  session_start();
  //session_destroy();  //for clearing the session
 
  // quick hack to test locally
  if ($_POST['username'] === 'local') {
    $_SESSION['logged_in'] = true;
    header('location:' . $_POST['location']);
  }

  $servername = "127.0.0.1";
	$username = "root";
	$password = "database";
	$database = 'diced_tomatoes';

	$sdat[0]->err=0;

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $database);

	if (!$conn) {
    $sdat[0]->errmsg = "Error: Unable to connect to MySQL: errno = " . mysqli_connect_errno() . ", error text = " .  mysqli_connect_error();
		$sdat[0]->err = 1;
		$action = "fail";
  };
  
  $query = "SELECT * FROM critics WHERE username='" . $_POST['username'] . "' AND password='" . $_POST['password'] ."'";

  $query_result = mysqli_query($conn, $query);
  $rowcount = mysqli_num_rows($result);

  if ($rowcount > 0) {
    $_SESSION['logged_in'] = true;
  }

  header('location:' . $_POST['location']);
?>