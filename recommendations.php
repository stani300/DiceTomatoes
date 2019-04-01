<?php include 'templates/header.php';?>

<script>
// any startup stuff

// this is a placeholder - fill in with the actual user name and id later
user = "JOHN SMITH";
uid = 1;

// find the movies that have been rated by this user and display them
  $(document).ready(function () {
    $('#currUser2').text(user+" : "+uid);
    recSearch ( uid );
  })
</script>

<body>
	<?php include 'templates/navbar.php';?>

		<div id="recommendations">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h1>Recommendations</h1>

					<?php
						if (!isset( $_SESSION['logged_in'])) {

							if (!isset( $_SESSION['logged_in'])) {
								echo "<p class='redtxt'>" . $_SESSION['err'] . "</p>";
								unset($_SESSION['err']);
							}
					?>

							<p>You must be logged in to view this page.</p>
							
							<form action="login.php" method="post">

							<input type="hidden" name="location" value="recommendations.php">

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
							<p>You are logged in as user: <strong><span id="currUser2"></span></strong>></p>
							<p><a href="logout.php">Log out</a></p>
							<br />
							<p>Based on your previous movie reviews, these are some movies that might appeal to you:</p>

							<table class="table table-striped table-hover" id="recTable">
								<tbody>
									<tr>
										<th>Movie Name</th>
										<th>Year</th>
										<th>Rating</th>
									</tr>
								</tbody>
							</table>

							<!-- this is where we show any messages - like more than 25 results found -->
							<div id="recMsg"></div>

							<br />
					<?php
						}
					?>
				</div>
			</div>
		</div>
	</div>

</body>

<?php include 'templates/footer.php';?>
