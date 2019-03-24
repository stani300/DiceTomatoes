<?php include 'templates/header.php';?>

<script>
// any startup stuff

// this is a placeholder - fill in with the actual user name and id later
user = "MARY SMITH";
uid = 2;

// find the movies that have been rated by this user and display them
  $(document).ready(function () {
    $('#currUser').text(user+" : "+uid);
    getMyRatings( user );
  })
</script>

<body>
	<?php include 'templates/navbar.php';?>

	<div id="rate">
		<div class="container">
			<div class="row">
				<div class="col-sm-2">
					<img src="images/dt100.png">
				</div>
				<div class="col-sm-10">
					<h2>Rate A Movie</h2>
					<br /><br />
					<p>You are logged in as user: <b><span id="currUser"></span></b></p>
					<br />

					<p><b>Your existing ratings:</b></p>

					<table class="table table-striped table-hover" id="myRatingsTable">
						<tr>
							<th>Movie</th>
							<th>Year</th>
							<th>Rating</th>
							<th>Action</th>
						</tr>
					</table>

					<div id="rateMsg"></div>

					<b>Add a new rating</b>
						<div class="form-group"><label class="mylabel-box"><button onClick="findMTR()">Search for a movie to rate:</button></label><input type="text" id="mtrtext" class="myform-control" /></div>
						<br /><br />

						<table class="table table-striped table-hover" id="MTRTable">
							<tr>
								<th>Movie</th>
								<th>Year</th>
								<th>Rating</th>
								<th>Action</th>
							</tr>
						</table>

						<div id="MTRMsg"></div>

				</div>
			</div>
		</div>
	</div>

</body>

<?php include 'templates/footer.php';?>
