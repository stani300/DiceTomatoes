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
				<div class="col-sm-2">
					<img src="images/dt100.png">
				</div>
				<div class="col-sm-10">
					<h2>Find Movie Suggestions</h2>
					<br /><br />
					<br /><br />
					<p>You are logged in as user: <b><span id="currUser2"></span></b></p>
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
				</div>
			</div>
		</div>

</body>

<?php include 'templates/footer.php';?>
