<?php

$str_json = file_get_contents('php://input');
$params = json_decode ( $str_json );

$action = $params->{'action'};
$target = $params->{'target'};

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

mysqli_close($conn);

$jrtn = json_encode($sdat);

echo $jrtn;

echo "test"; exit ("xyzzy");

?>
