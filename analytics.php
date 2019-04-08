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
      // data: [15.7, 16.7, 20, 23.5, 26.6]
      data: []
    }],
    valueAxis: {
      labels: {
        format: "{0}"
      }
    },
    categoryAxis: {
//      categories: [2014, 2015, 2016, 2017, 2018]
      categories: []
    }
  });
}
</script>

<body>
	<?php include 'templates/navbar.php';?>

	<div id="analytics">
		<div class="container">
			<div class="row">
			<div class="col-sm-12">
				<h1>Analytics</h1>

					<p><strong>This is the visualization feature</strong></p>

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
					<p><strong>Filter by:</strong></p>
					<ul>
						<p>Length: <select id="selLength">
								<option value="any">Any</option>
							</select></p>
						<p>Genre: <select id="selGenre">
								<option value="any">Any</option>
							</select></p>
					</ul>
					<br />
				</div>
				<div class="col-sm-5">
					<br />
					<p><strong>Parameter to chart:</strong></p>
					<input type="radio" name="show" value="length" checked="checked">Average Length<br>
					<br />
					<button type="button" class="btn btn-primary" onClick="analyticsSearch()">Update</button>
				</div>

			</div>
		</div>
	</div>

</body>

<?php include 'templates/footer.php';?>
