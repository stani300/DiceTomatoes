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
		case "recommendation":
			$sdat[0]->action = "recommendation";
			$uid = $params->{'uid'};
			$gid = $params->{'gid'};

			// *** This is just a placeholder to show the screens - it just returns movies that include the string "cari"
			$query = "SELECT m.*, AVG(r.rating) AS avg_score FROM movies AS m JOIN ratings AS r ON r.movie_id=m.id WHERE title LIKE '%cari%' GROUP BY r.movie_id";

			$query_result = mysqli_query($conn, $query);

			$cnt = 0;

			// then for each row of data, extract the title and any other info we need
			while( ($row = $query_result->fetch_array(MYSQLI_ASSOC) ) && ( $cnt++ < 27)  ) {
				$sdat[$cnt] = new stdClass();
				$sdat[$cnt]->id = $row['id'];
				$sdat[$cnt]->name = $row['title'];
				$sdat[$cnt]->year = substr($row['release_date'], 0, 4);
				// this will need to be average of ratings from ratings
				$sdat[$cnt]->rating = $row['avg_score'];
			}
			break;
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
			while( ($row = $query_result->fetch_array(MYSQLI_ASSOC) ) && ( $cnt++ < 27)  ) {
				$sdat[$cnt]->id = $row['id'];
				$sdat[$cnt]->name = $row['title'];
				$sdat[$cnt]->year = substr($row['release_date'], 0, 4);
				// this will need to be average of ratings from ratings
				$sdat[$cnt]->rating = $row['avg_score'];
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
			$uid = $params->{'uid'};

			// now find all the movies and ratings that have that critic id
			$query = 'SELECT m.*, r.* FROM movies AS m JOIN ratings AS r WHERE critic_id=' . $uid . ' AND r.movie_id=m.id';

			$query_result = mysqli_query($conn, $query);

			$cnt = 0;

			// then for each row of data, extract the title and any other info we need
			while( ($row = $query_result->fetch_array(MYSQLI_ASSOC) ) && ( $cnt++ < 27)  ) {
				$sdat[$cnt]->id = $row['id']; // movie id
				$sdat[$cnt]->rid = $row['rating_id']; // rating id
				$sdat[$cnt]->name = $row['title'];
				$sdat[$cnt]->year = substr($row['release_date'], 0, 4);
				// this will need to be average of ratings from ratings
				$sdat[$cnt]->rating = $row['rating'];
			}
			break;
		case "addRating":
				$sdat[0]->action = "addRating";
				$uid = $params->{'uid'}; // critic id
				$movie = $params->{'movie'}; // movie id
				$rating = $params->{'rating'}; // rating to add

				// note we should really check to make sure that critica doesn't alreayd have a rating for that movie, not just add it o the rating table blindly
				// TODO

				// update the rating value for the rating rid
				$query = 'INSERT INTO ratings VALUES ( NULL, ' . $rating . ', ' . $movie . ', ' . $uid . ')';
				$query_result = mysqli_query($conn, $query);

				// and we should check the results
				// TODO

				$sdat[0]->query = $query;

				if ($conn->query($sql) === TRUE) {
					// New record created successfully
				} else {
					$sdat[0]->errmsg = $conn->error;
				}

				break;
		case "updateRating":
			$sdat[0]->action = "updateRatings";
			$rid = $params->{'rid'}; // movie id
			$rating = $params->{'rating'}; // new rating value for that rating

			// might not be bad to do some sanity checking on the data first
			// TODO

			// update the rating value for the rating rid
			$query = 'UPDATE ratings SET rating = ' . $rating . ' WHERE rating_id = ' . $rid;
			$query_result = mysqli_query($conn, $query);

			// we should check to see it if did it...
			// TODO

			$sdat[0]->query = $query;

			if ($conn->query($sql) === TRUE) {
    		// New record created successfully
			} else {
    		$sdat[0]->errmsg = $conn->error;
			}


			break;
		case "deleteRating":
			$sdat[0]->action = "deleteRatings";
			$target = $params->{'user'}; // critic name, not id
			$rid = $params->{'rid'}; // movie id

			// not a bad idea to sanity check the $rid
			// TODO:

			// delete the rating with id rid
			$query = 'DELETE FROM ratings WHERE rating_id = ' . $rid ;
			$query_result = mysqli_query($conn, $query);

			// and also to check the response
			// TODO

			$sdat[0]->query = $query;

			if ($conn->query($sql) === TRUE) {
				// New record created successfully
			} else {
				$sdat[0]->errmsg = $conn->error;
			}

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

?>
