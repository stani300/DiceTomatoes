<?php include 'templates/header.php';?>

<script>
// any startup stuff
  $(document).ready(function () {
    initChart();
  })

function initChart() {
  $("#chart").kendoChart({
    title: {
      text: "Movie Sales"
    },
    legend: {
      position: "bottom"
    },
    seriesDefaults: {
      type: "line"
    },
    series: [{
      data: [15.7, 16.7, 20, 23.5, 26.6]
    }],
    valueAxis: {
      labels: {
        format: "{0}"
      }
    },
    categoryAxis: {
      categories: [2014, 2015, 2016, 2017, 2018]
    }
  });
}
</script>

<body>
	<?php include 'templates/navbar.php';?>

	<div id="analytics">
		<div class="container">
			<div class="row">
				<div class="col-sm-2">
					<img src="images/dt100.png">
				</div>
				<div class="col-sm-10">
					<h2>Analyze Movie DB Parameters</h2>
					<br /><br />
					<p><b>This is the visualization feature</b></p>

					<!-- placeholder for the chart to be created -->
					<div id="chart"></div>

				</div>
			</div>
		</div>

		<!-- the next section has two parts: the left which is filters (dropdowns) and the right which is chart parameters (radio buttons) -->
		<div class="container">
			<div class="row">
				<div class="col-sm-2"></div>
				<div class="col-sm-5">
					<br />
					<p><b>Filter by:</b></p>
					<ul>
						<p>Budget: <select id="selBudget">
								<option value="any">Any</option>
								<option value="micro">Micro <$1M </option> <option value="small">Small >$1M, <$100M</option> <option value="large">Large >$100M </option>
							</select></p>

						<p>Length: <select id="selLength">
								<option value="any">Any</option>
								<option value="short">Short</option>
								<option value="long">Long</option>
							</select></p>
						<p>Language: <select id="selLanguage">
								<option value="any">Any</option>
								<option value="english">English</option>
								<option value="french">French</option>
							</select></p>
						<p>Genre: <select id="selGenre">
								<option value="any">Any</option>
								<option value="horror">Horror</option>
								<option value="comedy">Comedy</option>
							</select></p>
					</ul>
					<br />
				</div>
				<div class="col-sm-5">
					<br />
					<p><b>Parameter to chart:</b></p>
					<input type="radio" name="show" value="sales" checked="checked">Sales<br>
					<input type="radio" name="show" value="budget">Budget <br>
					<input type="radio" name="show" value="length">Length <br>
					<input type="radio" name="show" value="rating">Average Rating<br>
					<br />
					<button type="button" class="btn btn-primary" onClick="analyticsSearch()">Update</button>
				</div>

			</div>
		</div>
	</div>

</body>

<?php include 'templates/footer.php';?>
