<?php include 'templates/header.php';?>

<script>
// any startup stuff

// this is a placeholder - fill in with the actual user name and id later
user = "JOHN SMITH";
uid = 1;

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
			<div class="col-sm-12">
				<h1>Rate</h1>

				<?php
						if (!isset( $_SESSION['logged_in'])) {

							if (!isset( $_SESSION['logged_in'])) {
								echo "<p class='redtxt'>" . $_SESSION['err'] . "</p>";
								unset($_SESSION['err']);
							}
					?>
					
							<p>You must be logged in to view this page.</p>
							
							<form action="login.php" method="post">

							<input type="hidden" name="location" value="rate.php">

							<div class="form-group">
								<label class="mylabel-box">Username:</label>
								<input type="text" name="username" required id="user" class="myform-control" />
							</div>

							<div class="form-group">
								<label class="mylabel-box">Password:</label>
								<input type="password" name="password" required id="pwd" class="myform-control" />
							</div>

							<div class="form-group">
								<input type="submit" id="LEnter" class="btn btn-primary" value="Submit">
							</div>
							</form>

					<?php
						}

						else {
					?>

				<p>You are logged in as user: <strong><span id="currUser"></span></strong></p>
				<p><a href="logout.php">Log out</a></p>
				<br />

				<p><strong>Your existing ratings:</strong></p>

				<table class="table table-striped table-hover" id="myRatingsTable">
					<tr>
						<th>Movie</th>
						<th>Year</th>
						<th>Rating</th>
						<th>Action</th>
					</tr>
				</table>

				<div id="rateMsg"></div>

				<br><br>
				<p><strong>Add a new rating</strong><br>
				First, search for the movie you wish to rate:</p>

				<div class="form-group"><input type="text" id="mtrtext" class="myform-control" /> <label class="mylabel-box"><button type="button" class="btn btn-primary" onClick="findMTR()">Search</button></label></div>
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
				<?php
						}
					?>
				</div>
			</div>
		</div>
	</div>

</body>

<?php include 'templates/footer.php';?>
