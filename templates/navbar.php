<nav class="navbar navbar-expand-lg navbar-dark">
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
				<li><a onClick="openLogin()" style="cursor:pointer; cursor:hand;" class="nav-link"><span id="logtxt">Login</span></a></li>
			</ul>
		</div>
	</nav>
	<br /><br />

		<div id="myModal" class="loginmodal">
		<div class="modal-content">

			<div class="LHead"><strong>Diced Tomatoes Login</strong></div><br />

			<div class="form-group">
				<label class="mylabel-box">Account:</label>
				<input type="text" name="account" id="facct" value="johnw6@illinois.edu"/>
			</div>

			<div class="form-group">
				<label class="mylabel-box">Password:</label>
				<input type="password" name="password" id="fpwd" value="johnw6"/>
			</div>

			<div class="mybtngrp">
				<button style="width: 100%;" class="btn btn-primary" onclick="userLogin()">Submit</button>
				<button style="width: 100%;" class="btn btn-danger" onclick="closeLogin()">Cancel</button>
			</div>


			<div class="LLine" id="LReply"> </div>

		</div>
	</div>
