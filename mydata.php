

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


	while($row = $query_result->fetch_array(MYSQLI_ASSOC)){
		echo "<tr>";
		echo "	<td>";
		echo 		$row['ID'];
		echo "	</td>";
		echo "	<td>";
		echo 		$row['FIRSTNAME'];
		echo "	</td>";
		echo "	<td>";
		echo 		$row['LASTNAME'];
		echo "	</td>";
		echo "</tr>";
	}
	echo "</table>";

	?>

	</body>
</html>
