<?php

	$str_json = file_get_contents('php://input');
	$params = json_decode ( $str_json );

	$action = $params->{'action'};
	$uname = $params->{'uname'};
	$pwd = $params->{'pwd'};

	$servername = "127.0.0.1";
	$username = "root";
	$password = "UIUC411";
	$database = 'diced_tomatoes';

	$sdat[0] = new stdClass();
	$sdat[0]->err=0;

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $database);

	if (!$conn) {
    $sdat[0]->errmsg = "Error: Unable to connect to MySQL: errno = " . mysqli_connect_errno() . ", error text = " .  mysqli_connect_error();
		$sdat[0]->err = 1;
		$action = "fail";
	};

		$sdat[0]->uname = "JOHN WILLOUGHBY";
		$sdat[0]->uid = 675;

	switch ( $action ) {
		case "login":
			break;
		case "getuser":
			$sdat[0]->uname = "John Willoughby";
			$sdat[0]->uid = 675;
			break;
		case "logout":
			break;
		case "fail";
			break;
		default:
			$sdat[0]->errmsg = "unknown action";
			break;
	}

mysqli_close($conn);

$jrtn = json_encode($sdat);

echo $jrtn;

?>
