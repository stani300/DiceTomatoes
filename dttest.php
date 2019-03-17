<?php

$servername = "127.0.0.1";
$username = "root";
$password = "database";
$database = 'diced_tomatoes';

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $database);

	if (!$conn) {
    echo ( "Error: Unable to connect to MySQL: errno = " . mysqli_connect_errno() . ", error text = " .  mysqli_connect_error() );
	  exit;
	};

	$query = "SELECT * FROM movies";
	$query_result = mysqli_query($conn, $query) or die ('query error';

	if ( $query_result == FALSE ) echo ( " result is false");

// burn the first row with is titles
	$row = $query_result->fetch_array(MYSQLI_ASSOC);

$count = 0;

	while ( ( $row = $query_result->fetch_array(MYSQLI_ASSOC) ) && ( $count++ < 10 ) ) {
			printf ( "name: %s\n ", $row['title'] );
	}



?>
