<?php include 'templates/header.php';?>

<script>

  user = "";
  uid = 0;
  jpage="reco";

// find the movies that have been rated by this user and display them
  $(document).ready(function () {
    $('#logtxt').fadeIn(100);
  })
</script>
<body>
	<?php include 'templates/navbar.php';?>

		<div id="recommendations">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h1>Recommendations</h1>


					<p><span id="currUser">You are not logged in</span></p><br/>

	        <div id="rateBlock" class="rhidden">

					<p><strong>Your existing ratings:</strong></p>

					<table class="table table-striped table-hover" id="myRatingsTable">
						<tr>
							<th>Movie</th>
							<th>Year</th>
							<th>Rating</th>
							<th>Runtime</th>
							<th>Language</th>
						</tr>
					</table>

					<div id="rateMsg"></div>
					<div id="recoStats"></div>

					<p><strong>Your suggested movies are:</strong></p>

					<table class="table table-striped table-hover" id="recTable">
						<tr>
							<th>Movie</th>
							<th>Year</th>
							<th>Rating</th>
							<th>Runtime</th>
							<th>Language</th>
						</tr>
					</table>

					<div id="rateMsg"></div>
					<div id="recoStats"></div>

				</div>
			</div>
		</div>
	</div>

</body>

<?php include 'templates/footer.php';?>
