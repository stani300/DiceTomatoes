<?php

echo ( "start" );
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $database);

	echo ( "connection made" );

	if (!$conn) {
    echo ( "Error: Unable to connect to MySQL: errno = " . mysqli_connect_errno() . ", error text = " .  mysqli_connect_error() );
	  exit;
	};

	$query = "SELECT * FROM movies";
	$query_result = mysqli_query($conn, $query);

	while($row = $query_result->fetch_array(MYSQLI_ASSOC) {
		echo ( "name " . $row['title']);
	}

?>
