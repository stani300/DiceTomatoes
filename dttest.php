<?php

echo ( "start - " );

$servername = "127.0.0.1";
$username = "root";
$password = "database";
$database = 'diced_tomatoes';

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $database);

	echo ( "connection made - " );

	if (!$conn) {
    echo ( "Error: Unable to connect to MySQL: errno = " . mysqli_connect_errno() . ", error text = " .  mysqli_connect_error() );
	  exit;
	};

	$query = "SELECT * FROM movies";
	$query_result = mysqli_query($conn, $query) or die ('query error');

	echo ( "query made - " );

	$cnt = 0;

	if ( $query_result == FALSE ) echo ( " result is false");

	$row = $query_result->fetch_array(MYSQLI_ASSOC);

	echo ( "query result - " );

	echo ( $row['title'] );

	$row = $query_result->fetch_array(MYSQLI_ASSOC);

	echo ( "query result - " );

	echo ( $row['title'] );

	$row = $query_result->fetch_array(MYSQLI_ASSOC);

	echo ( "query result - " );

	echo ( $row['title'] );

//	while( ( $row = $query_result->fetch_array(MYSQLI_ASSOC) ) && ( cnt++ < 25 ) ){
	while( $row = $query_result->fetch_array(MYSQLI_ASSOC) ){
		echo ( "name " . $row['title'] . "\n " );
	}

?>
