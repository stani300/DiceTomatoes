<?php include 'templates/header.php';?>

<script>

  user = "";
  uid = 0;
  jpage="rate";

// find the movies that have been rated by this user and display them
  $(document).ready(function () {
    $('#logtxt').fadeIn(100);
  })
</script>

<body>
	<?php include 'templates/navbar.php';?>

	<div id="rate">
		<div class="container">
			<div class="row">
			<div class="col-sm-12">
				<h1>Rate</h1>
        <p><span id="currUser">You are not logged in</span></p><br/>

        <div id="rateBlock" class="rhidden">

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

				<div class="form-group">
          <input type="text" id="mtrtext" class="myform-control" />
          <label class="mylabel-box">
          <button type="button" class="btn btn-primary" onClick="findMTR()">Search</button>
          </label>
        </div>
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
	</div>


</body>

<?php include 'templates/footer.php';?>
