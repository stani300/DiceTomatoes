<?php

	$str_json = file_get_contents('php://input');
	$params = json_decode ( $str_json );

	$action = $params->{'action'};
	$target = $params->{'target'};

	$servername = "127.0.0.1";
	$username = "root";
	$password = "database";
	$database = 'diced_tomatoes';

	$sdat[0]->err=1; // default - error

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $database);

	if (!$conn) {
    $sdat[0]->msg = "Error: Unable to connect to MySQL: errno = " . mysqli_connect_errno() . ", error text = " .  mysqli_connect_error();
		$sdat[0]->err = 1;
    $jrtn = json_encode($sdat);
    echo $jrtn;
	  exit;
	};

	switch ( $action ) {
		case "browse":
			$sdat[0]->action = "browse";
			$target = $params->{'target'};

			// replace a star at the froint or back with a percent pcnt_sign

			// find movies that match the search string in target
			$query = "SELECT m.*, AVG(r.rating) AS rating FROM movies AS m JOIN ratings AS r ON r.movie_id=m.id WHERE title LIKE '".$target."' GROUP BY r.movie_id";
			$query_result = mysqli_query($conn, $query);

			$cnt = 0;

			// burn first row because it's titles
			$row = $query_result->fetch_array(MYSQLI_ASSOC);

			// then for each row of data, extract the title and any other info we need
			while( ($row = $query_result->fetch_array(MYSQLI_ASSOC) ) && ( $cnt++ < 27)  ) {
				$sdat[$cnt]->name = $row['title'];

				$sdat[$cnt]->year = substr($row['release_date'], 4);
			 	//$sdat[$cnt]->year = 1950+rand(0,69) ;
				
				// this will need to be average of ratings from ratings				
				$sdat[$cnt++]->rating = $row['rating'];
		   	//$sdat[$cnt]->rating = rand(1,10);
			}
			break;
		case "analytics":
			$sdat[0]->action = "analytics";
			$radio = $params->{'radio'}; // what data are we charting?
			// the rest of these are individual constraints on the search
			$budget = $params->{'budget'};
			$length = $params->{'length'};
			$language = $params->{'language'};
			$genre = $params->{'genre'};

			// pass back the search parameters just for testing
			$sdat[0]->radio = $radio;
			$sdat[0]->budget = $budget;
			$sdat[0]->length = $length;
			$sdat[0]->language = $language;
			$sdat[0]->genre = $genre;

			// now go to the db and find the data

			$startyear = rand(1970,2000);
			$dcnt = rand(5,10);
			// or fake it for now with random values
			for ( $i=1; $i<$dcnt; $i++ ) {
				$sdat[$i]->val = rand(5,20);
				$sdat[$i]->name = $startyear + $i;
			}

			break;
		case "getRatings":
				$sdat[0]->action = "getRatings";
				$user = $params->{'user'};

				// replace a star at the froint or back with a percent pcnt_sign

				// find movies that match the search string in target
				$query = "SELECT * FROM movies WHERE title LIKE 'aliens'";
				$query_result = mysqli_query($conn, $query);

				$cnt = 0;

				// burn first row because it's titles
				$row = $query_result->fetch_array(MYSQLI_ASSOC);

				// then for each row of data, extract the title and any other info we need
				while( ($row = $query_result->fetch_array(MYSQLI_ASSOC) ) && ( $cnt++ < 27)  ) {
					$sdat[$cnt]->name = $row['title'];
					 // $sdat[$cnt]->year = $row['year'];
					$sdat[$cnt]->year = 1950+rand(0,69) ;
					 // $sdat[$cnt++]->rating = $row['rating'];
					$sdat[$cnt]->rating = rand(1,10);
				}
				break;
		default:
			$sdat[0]->msg = "unknown action";
			$sdat[0]->err = 1;
			break;
	}

mysqli_close($conn);

$sdat[0]->err=0;
$jrtn = json_encode($sdat);

echo $jrtn;

?>
