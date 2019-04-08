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
						<p>Release after: <select id="selMinYr">
								<option value="1850">1850</option>
                <option value="1900">1900</option>
                <option value="1950">1950</option>
								<option value="2000">2000</option>
							</select></p>
					</ul>
					<br />
				</div>
				<div class="col-sm-5">
					<br />
					<p><strong>Parameter to chart:</strong></p>
					<input type="radio" name="show" value="length" checked="checked">Average Length<br>
          <input type="radio" name="show" value="revenue">Average Revenue<br>
					<br />
          <p><strong>Chart by:</strong></p>
          <input type="radio" name="showby" value="lang" checked="checked">Language<br>
          <input type="radio" name="showby" value="date">Year<br>
          <br />
					<button type="button" class="btn btn-primary" onClick="analyticsSearch()">Analyze</button>
				</div>

			</div>
		</div>
	</div>

</body>

<?php include 'templates/footer.php';?>
