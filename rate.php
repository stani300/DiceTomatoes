<?php include 'templates/header.php';?>

<script>
// any startup stuff
  $(document).ready(function () {
    getMyRatings( "alien%" );
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
					<p>You are logged in as user: <b>Test</b></p>
					<br />
//					<b>Add a new rating</b>
//					<div class="form-group"><label class="mylabel-box"><button onClick="openmpick()">Search for:</button></label><input type="text" id="mptext" class="myform-control" /></div>
//					<br /><br />


					<p><b>Your existing ratings:</b></p>

					<table id="myRatingsTable">
						<tr>
							<th>Movie</th>
							<th>Year</th>
							<th>Rating</th>
							<th>Action</th>
						</tr>
					</table>

					<!-- this is where we show any messages - like more than 25 results found -->
					<div id="browseMsg"></div>

				</div>
			</div>
		</div>
	</div>

</body>

<?php include 'templates/footer.php';?>
