<html>
<head>
<title>Display Data into DB</title>
style type="text/css">
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

$servername = "localhost";
$username = "root";
$password = "database";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

#include('connect -mysql.php');

$query = "SELECT *  FROM mydata";
$query_result = mysqli_query($dbcon, $query) or die ('error getting');

echo "<table>";
echo "<tr><th>ID</th><th>FIRST NAME</th><th>LAST NAME</th></tr>";

while($row = mysqli_fetch_array($query_result, MYSQL_ASSOC)) {
	echo "<tr><td>";
	echo $row ['peopleid'];
	echo "</td><td>";
	echo $row ['firstname'];
	echo "</td><td>";
	echo $row ['lastname'];
	echo "</td><tr>";
}
echo "<\table>"


?>

</body>
</html>