// JavaScript Document

// When the user clicks on the button, open the modal
function openLog() {
  logt = document.getElementById("logtxt").innerHTML;
  if ( logt == "logout" ) {
    document.getElementById("logtxt").innerHTML = "login";
    document.getElementById("navrate2").classList.add("disabled");
    changePage ( "home" );
  }
  else
	 $('#myModal').fadeIn (500);
}

function closeLogin () {
	$('#myModal').fadeOut(500);
	$('#LReply').text("");
	$('#user').val("");
	$('#pwd').val("");
}

// When the user clicks on the button, open the modal
function openmpick() {
	 $('#mpick').fadeIn (500);
}

function addrating ( moviename ) {

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

function closempick () {
	$('#mpick').fadeOut(500);
}

function checkLogin () {

		var user = $('#user').val();
		var pwd = $('#pwd').val();

		$('#LReply').text("");

//		if ( user && ( user.length > 0 ) && pwd && ( pwd.length > 0 ) )	{

//			if ( ( user == "demo" ) && ( pwd == "demo" ) ) {
        document.getElementById("logtxt").innerHTML = "logout";
        document.getElementById("navrate2").classList.remove("disabled");
        closeLogin ();
//			}
//			else
//				rejectLogin ( "Invalid user/password" );
//		}
//		else
//			rejectLogin ( "Please fill out all fields" );

}

function handleLoginResp () {

	// set user
}

function rejectLogin ( errTxt) {

	$('#LReply').text(errTxt);
	$('#LReply').css("color", "red");
}

function msearch ( mtext ) {
alert( "search for " + $('#mname').val() );
jstr = mtext; // needs to be json but for now...
  function ajaxJCall ( "dt.php", jstr, mlistupdate ) {

}

function mlistupdate ( dat ) {

alert ( "dat is " + dat );
tname = "maintable";
// Find a <table> element with id="myTable":

var table = document.getElementById( tname );
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
cell3.innerHTML = "9.5" ;

}

function rmlistupdate ( dat ) {

tname = "maintable";
// Find a <table> element with id="myTable":

var table = document.getElementById( tname );
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
cell3.innerHTML = "9.5" ;

}
