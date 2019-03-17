<?php

	$str_json = file_get_contents('php://input');
	$params = json_decode ( $str_json );

	$action = $params->{'action'};
	$target = $params->{'target'};

	$servername = "127.0.0.1";
	$username = "root";
	$password = "database";
	$database = 'diced_tomatoes';

	$sdat[0]->action = $action;
	$sdat[0]->target = $target;
	$sdat[0]->err=1; // default - error

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $database);

	if (!$conn) {
    $sdat[0]->msg = "Error: Unable to connect to MySQL: errno = " . mysqli_connect_errno() . ", error text = " .  mysqli_connect_error();
		$sdat[0]->err = 1;
    $jrtn = json_encode($sdat);
    echo $jrtn;
	  exit;
	};

	switch ( $action ) {
		case "browse":

			// find movies that match the search string in target
			$query = "SELECT * FROM movies";
			$query_result = mysqli_query($conn, $query);

//			$sdat[1]->name = "Alien";
	//		$sdat[1]->year = "1976";
		//	$sdat[1]->rating = "8.4";
			//$sdat[2]->name = "Aliens";
			//$sdat[2]->year = "1986";
			//$sdat[2]->rating = "8.2";

			$cnt = 1;

			// burn first row because it's titles
			$row = $query_result->fetch_array(MYSQLI_ASSOC);

			while( ($row = $query_result->fetch_array(MYSQLI_ASSOC) && ( $cnt++ < 27)  ) {
//			   $sdat[$cnt]->name = $row['title'];
			   // $sdat[$cnt]->year = $row['year'];
//				 $sdat[$cnt]->year = 1999 ;
				 // $sdat[$cnt++]->rating = $row['rating'];
//			   $sdat[$cnt]->rating = 9;
			}

			break;
		default:
			$sdat[0]->msg = "unknown action";
			$sdat[0]->err = 1;
			break;
	}

mysqli_close($conn);

$sdat[0]->err=0;
$jrtn = json_encode($sdat);

echo $jrtn;

?>
