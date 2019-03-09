<?php

//$str_json = file_get_contents('php://input');
//$params = json_decode ( $str_json );

//$action = $params->{'action'};

//Variables for connecting to the database.
//$hostname = "";
//$username = "";
//$dbname = "";

//secret stuff
//$password = "";
//$usertable = "";
//$yourfield = "";

//$lfile = fopen ( "dt.log", "a" );
//fputs ( $lfile, $action . " - " . $data . "\n" );

// Connect to the database
//$con = mysqli_connect($hostname, $username, $password, $dbname );

//$stmt = $con->prepare ( "sql_statement" );
//$stmt->execute();
//$stmt->bind_result( result );

$sdat[0]->rev = "0.0";

$jrtn = json_encode($sdat);

echo $jrtn;

?>
