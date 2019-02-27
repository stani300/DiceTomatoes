<html>
<head>
	<title>Display Data into DB</title>
	<style type="text/css">
	table {
		border: 2px solid blue;
		background-color: #FFc;
	}
	th {
		border-bottom: 5px solid #000;
	}

	td {
	   forder-bottom: 2px solid #666;
	}
	</style>
</head>
<body>
	<h1>Display Data from DB</h1>

	<?php

	$servername = "127.0.0.1";
	$username = "root";
	$password = "database";
	$database = 'mydata';

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $database);

	if (!$conn) {
	    echo "Error: Unable to connect to MySQL." . PHP_EOL;
	    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
	    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
	    exit;
	}


	// Check connection
	echo "Connected successfully";

	#include('connect -mysql.php');
 
	$query = "SELECT * FROM mydata";
	$query_result = mysqli_query($conn, $query) or die ('error getting');

	echo "<table>";
	echo "<tr><th>ID</th><th>FIRST NAME</th><th>LAST NAME</th></tr>";

	while($row = mysqli_fetch_array($query_result, MYSQL_ASSOC)) {
		echo "<tr><td>";
		echo $row['ID'];
		echo "</td><td>";
		echo $row['FIRSTNAME'];
		echo "</td><td>";
		echo $row['LASTNAME'];
		echo "</td><tr>";
	}
	echo "</table>";

	?>

	</body>
</html>