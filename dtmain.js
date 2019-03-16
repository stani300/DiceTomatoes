// JavaScript Document

// any startup stuff
  $(document).ready(function () {
    initChart();
  })

function changePage(newpage) {
  newnav = "nav" + newpage;

  // I could go find the current page, but this is simpler
  // just remove active from everything then put it back on the new screen
  document.getElementById("navbrowse").classList.remove("active");
  document.getElementById("navrecommendations").classList.remove("active");
  document.getElementById("navanalytics").classList.remove("active");
  document.getElementById("navrate").classList.remove("active");
  document.getElementById(newnav).classList.add("active");

  // and then hide all screens and then unhide the new screen b
  document.getElementById("splash").classList.add("blockHidden");
  document.getElementById("splash").classList.remove("blockShow");
  document.getElementById("browse").classList.add("blockHidden");
  document.getElementById("browse").classList.remove("blockShow");
  document.getElementById("recommendations").classList.add("blockHidden");
  document.getElementById("recommendations").classList.remove("blockShow");
  document.getElementById("analytics").classList.add("blockHidden");
  document.getElementById("analytics").classList.remove("blockShow");
  document.getElementById("rate").classList.add("blockHidden");
  document.getElementById("rate").classList.remove("blockShow");
  document.getElementById(newpage).classList.add("blockShow");
  document.getElementById(newpage).classList.remove("blockHidden");

}

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

function checkRate ( ) {
  // are we logged in?
  logt = document.getElementById("logtxt").innerHTML;
  if (logt == "Login") {
alert ( "You must be logged in to rate a movie" );
  } else
    changePage ("rate");
}

// When the user clicks on the button, open the modal
function openLog() {
  logt = document.getElementById("logtxt").innerHTML;
  if (logt == "logout") {
    document.getElementById("logtxt").innerHTML = "login";
    document.getElementById("navrate2").classList.add("disabled");
    changePage("splash");
  } else
    $('#myModal').fadeIn(500);
}

function closeLogin() {
  $('#myModal').fadeOut(500);
  $('#LReply').text("");
  $('#user').val("");
  $('#pwd').val("");
}

// When the user clicks on the button, open the modal
function openmpick() {
  $('#mpick').fadeIn(500);
}

function addrating(moviename) {

  // Find a <table> element with id="myTable":
  var table = document.getElementById("existing");
  var len = table.rows.length;

  // Create an empty <tr> element and add it to the end of the table
  var row = table.insertRow(len);

  // Insert new cells (<td> elements) of the "new" <tr> element:
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  var cell3 = row.insertCell(2);
  var cell4 = row.insertCell(3);

  // Add some text to the new cells:
  cell1.innerHTML = moviename;
  cell2.innerHTML = "1990";
  cell3.innerHTML = "<input type='text' value='-'><//input>";
  cell4.innerHTML = "<button>update</button> <button>delete<//button>";

  closempick();
}

function closempick() {
  $('#mpick').fadeOut(500);
}

function checkLogin() {

  var user = $('#user').val();
  var pwd = $('#pwd').val();

  $('#LReply').text("");

  //		if ( user && ( user.length > 0 ) && pwd && ( pwd.length > 0 ) )	{

  //			if ( ( user == "demo" ) && ( pwd == "demo" ) ) {
  document.getElementById("logtxt").innerHTML = "logout";
  document.getElementById("navrate2").classList.remove("disabled");
  closeLogin();
  //			}
  //			else
  //				rejectLogin ( "Invalid user/password" );
  //		}
  //		else
  //			rejectLogin ( "Please fill out all fields" );

}

function handleLoginResp() {

  // set user
}

function rejectLogin(errTxt) {

  $('#LReply').text(errTxt);
  $('#LReply').css("color", "red");
}

function mmsearch() {

  jstr = JSON.stringify({
    "action": "search",
    "target": $('#mname').val()
  });
  alert("sending: " + jstr);
  ajaxJCall("dt.php", jstr, mlistupdate);
}

function mlistupdate(dat) {

  alert("received: " + dat);
  obj = JSON.parse(dat);

  tname = "maintable";
  // Find a <table> element with id="myTable":

  var table = document.getElementById(tname);
  var len = table.rows.length;

  var i;
  for (i = 1; i < obj.length; i++) {

    // Create an empty <tr> element and add it to the end of the table
    var row = table.insertRow(i);

    // Insert new cells (<td> elements) of the "new" <tr> element:
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);

    // Add some text to the new cells:
    cell1.innerHTML = obj[i].name;
    cell2.innerHTML = obj[i].year;
    cell3.innerHTML = obj[i].rating;

  }

}

function rmlistupdate(dat) {

  tname = "maintable";
  // Find a <table> element with id="myTable":

  var table = document.getElementById(tname);
  var len = table.rows.length;

  // Create an empty <tr> element and add it to the end of the table
  var row = table.insertRow(1);

  // Insert new cells (<td> elements) of the "new" <tr> element:
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  var cell3 = row.insertCell(2);

  // Add some text to the new cells:
  cell1.innerHTML = "alien";
  cell2.innerHTML = "1989";
  cell3.innerHTML = "9.1";

  // Create an empty <tr> element and add it to the end of the table
  var row = table.insertRow(2);

  // Insert new cells (<td> elements) of the "new" <tr> element:
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  var cell3 = row.insertCell(2);

  // Add some text to the new cells:
  cell1.innerHTML = "Aliens";
  cell2.innerHTML = "1990";
  cell3.innerHTML = "9.5";

}
