<?php

$str_json = file_get_contents('php://input');
$params = json_decode ( $str_json );

$action = $params->{'action'};

	$servername = "127.0.0.1";
	$username = "root";
	$password = "database";
	$database = 'mydata';

  $rmsg = "normal";

  $sdat[0]->action = $action;
  $sdat[1]->name = "Alien";
  $sdat[1]->year = "1976";
  $sdat[1]->rating = "8.4";
  $sdat[2]->name = "Aliens";
  $sdat[2]->year = "1986";
  $sdat[2]->rating = "8.2";

  $jrtn = json_encode($sdat);

  echo $jrtn;

  exit;




	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $database);

	if (!$conn) {
    $sdat[0]->msg = "Error: Unable to connect to MySQL: errno = " . mysqli_connect_errno() . ", error text = " .  mysqli_connect_error();
    $jrtn = json_encode($sdat);
    echo $jrtn;
	  exit;
	};

	$query = "SELECT * FROM mydata";
	$query_result = mysqli_query($conn, $query);

$cnt = 0;

	while($row = $query_result->fetch_array(MYSQLI_ASSOC)){
    $sdat[$cnt]->fname = $row['FIRSTNAME'];
    $sdat[$cnt]->id = $row['ID'];
    $sdat[$cnt++]->lname = $row['LASTNAME'];
	}

if ( cnt == 0 ) {
    $sdat[0]->msg = "error";
  }
  else {
    $sdat[0]->msg = "normal"; 
  };

$jrtn = json_encode($sdat);

echo $jrtn;

?>
