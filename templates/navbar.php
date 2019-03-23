<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
		<a href="index.php" class="navbar-brand" id="navsplash">Diced Tomatoes</a>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">

				<li id="navbrowse" class="nav-item">
					<a href="browse.php" class="nav-link">Browse</a>
				</li>

				<li id="navanalytics" class="nav-item">
					<a href="analytics.php" class="nav-link">Analytics</a>
				</li>

				<li id="navrate" class="nav-item">
					<a href="rate.php" class="nav-link">Rate</a>
				</li>

				<li id="navrecommendations" class="nav-item">
					<a href="recommendations.php" class="nav-link">Recommendations</a>
				</li>

			</ul>

			<ul class="nav navbar-nav navbar-right">
				<li><a onClick="openLog()" style="cursor:pointer; cursor:hand;"><span id="logtxt">Login</span></a></li>
			</ul>
		</div>
	</nav>
	<br /><br />

		<div id="myModal" class="loginmodal">
		<div class="modal-content">

			<div class="LHead">Diced Tomatoes Login</div><br />

			<div class="form-group"><label class="mylabel-box">User:</label><input type="text" name="User:" id="user" class="myform-control" /></div>

			<div class="form-group"><label class="mylabel-box">Password:</label><input type="password" name="Password:" id="pwd" class="myform-control" /></div>

			<div class="mybtngrp">
				<button id="LEnter" class="btn btn-primary mybtn" onclick="checkLogin()">ENTER</button>
				<button id="LCancel" class="btn btn-danger mybtn" onclick="closeLogin()">CANCEL</button>
			</div>

			<div class="LLine" id="LReply"> </div>

		</div>
	</div>
	
	<!--<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
		<a class="navbar-brand" id="navsplash" onClick="changeScreen('splash')">Diced Tomatoes</a>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">

				<li id="navbrowse" class="nav-item">
					<a class="nav-link" onClick="changeScreen('browse')">Browse</a>
				</li>

				<li id="navanalytics" class="nav-item">
					<a class="nav-link" onClick="changeScreen('analytics')">Analytics</a>
				</li>

				<li id="navrate" class="nav-item">
					<a id="navrate2" class="nav-link" onClick="checkRate()">Rate</a>
				</li>

				<li id="navrecommendations" class="nav-item">
					<a class="nav-link" onClick="checkRecommendations()">Recommendations</a>
				</li>

			</ul>

			<ul class="nav navbar-nav navbar-right">
				<li><a onClick="openLog()" style="cursor:pointer; cursor:hand;"><span id="logtxt">Login</span></a></li>
			</ul>
		</div>
	</nav>
	<br /><br />-->