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

switch ( $action ) {
  case "browse":
    $sdat[0]->action = "browse";
    $target = $params->{'target'};

    // find movies that match the search string in target
    $query = "SELECT m.*, AVG(r.rating) AS avg_score FROM movies AS m JOIN ratings AS r ON r.movie_id=m.id WHERE title LIKE '" . $target . "' GROUP BY r.movie_id";
    //$query = "SELECT m.*, AVG(r.rating) AS avg_score FROM movies AS m JOIN ratings AS r ON r.movie_id=m.id GROUP BY r.movie_id";

    //$query = "SELECT * FROM movies WHERE title LIKE '".$target."' ";

    $query_result = mysqli_query($conn, $query);

    $cnt = 0;

    // then for each row of data, extract the title and any other info we need
//    while( ($row = $query_result->fetch_array(MYSQLI_ASSOC) && ( $cnt++ < 27  ) ) {
//    }

    break;
  case "fail";
    break;
  default:
    $sdat[0]->errmsg = "unknown action";
    break;
}

mysqli_close($conn);

$jrtn = json_encode($sdat);

echo $jrtn;

echo "test"; exit ("xyzzy");

?>
