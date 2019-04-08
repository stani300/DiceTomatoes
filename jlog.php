<?php

	$str_json = file_get_contents('php://input');
	$params = json_decode ( $str_json );

	$action = $params->{'action'};
	$uacct = $params->{'acct'};
	$upwd = $params->{'pwd'};

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

	switch ( $action ) {
		case "login":
		$query = "SELECT * FROM critics WHERE username='" . $uacct . "' AND password='" . $upwd ."'";

		$query_result = mysqli_query($conn, $query);
		$rowcount = mysqli_num_rows($query_result);

		if ($rowcount > 0) {
			$_SESSION['logged_in'] = true;
			$row0 = $query_result->fetch_array(MYSQLI_ASSOC);
			$_SESSION['critic_id'] = $row0['critic_id'];
			$_SESSION['critic_name'] = $row0['critic_name'];
			$sdat[0]->uid = $row0['critic_id'];
			$sdat[0]->uname = $row0['critic_name'];
		}
		else {
			$sdat[0]->errmsg = "invalid uname/pwd";
			$_SESSION['err'] = "Sorry, that username or password was invalid.";
		}
			break;
		case "getuser":
			if (isset( $_SESSION['logged_in'])) {
				$sdat[0]->uid = $_SESSION['critic_id'];
				$sdat[0]->uname = $_SESSION['critic_name'];
			} else {
					$sdat[0]->uname = "";
					$sdat[0]->uid = "";
				};

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
