<?php

$str_json = file_get_contents('php://input');
$params = json_decode ( $str_json );

$action = $params->{'action'};

//Variables for connecting to the database.
$hostname = "jobtrackerdb.db.9148241.hostedresource.com";
$username = "jobtrackerdb";
$dbname = "jobtrackerdb";

//secret stuff
$password = "NitPicker@12";
$usertable = "jobs";
$yourfield = "Company";


// Connect to the database
$con = mysqli_connect($hostname, $username, $password, $dbname );

$stmt = $con->prepare ( "SELECT JobID, Company, Title, URL, Email, Phone, Live, Applied FROM $usertable ORDER BY Company DESC" );
$stmt->execute();
$stmt->bind_result( $jid, $company, $title, $url, $email, $phone, $live, $applied );

$x = 0;

while ( $stmt->fetch() ) {
	$jobj[$x]->jid = $jid;
	$jobj[$x]->company = $company;
	$jobj[$x]->title = $title;
	$jobj[$x]->url = $url;
	$jobj[$x]->email = $email;
	$jobj[$x]->phone = $phone;
	$jobj[$x]->live = $live;
	$jobj[$x]->applied = $applied;
	$x++;
}

$jrtn = json_encode($jobj);

echo $jrtn;

?>
