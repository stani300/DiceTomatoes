<?php include 'templates/header.php';?>

<body>
	<?php include 'templates/navbar.php';?>

	<div id="browse">

		<div class="container">
			<div class="row">
				<div class="col-sm-2">
					<img src="images/dt100.png">
				</div>
				<div class="col-sm-10">
					<h2>Find a movie and display its ratings</h2><br /><br />
					<p>To use wildcards - add a percent sign at the beginning or end or your search term to include any text</p>
					<p>For example: &quot;%alien&quot; will give you any movie that ends in &quot;alien&quot;. &quot;alien%&quot; will give you any movie that starts with &quot;alien&quot;.</p><br/>

					<div class="form-group">
						<label class="mylabel-box">
							<button onClick="browseSearch()">Search for:</button>
						</label>
						<input type="text" id="mname" class="myform-control" />
					</div>
					<br />

					<table id="browseTable">
						<tr>
							<th>Movie Name</th>
							<th>Year</th>
							<th>Rating</th>
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