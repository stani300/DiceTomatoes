// JavaScript Document

// any startup stuff
  $(document).ready(function () {
    initChart();
    uname = "";
  })

function changeScreen (newpage) {
  newnav = "nav" + newpage;

  // I could go find the current page, but this is simpler
  // just remove active from everything then put it back on the new screen
  $('#navbrowse')[0].classList.remove("active");
  $('#navrecommendations')[0].classList.remove("active");
  $('#navanalytics')[0].classList.remove("active");
  $('#navrate')[0].classList.remove("active");
  $('#'+newnav)[0].classList.add("active");

  // and then hide all screens and then unhide the new screen b
  $('#splash')[0].classList.add("blockHidden");
  $('#splash')[0].classList.remove("blockShow");
  $('#browse')[0].classList.add("blockHidden");
  $('#browse')[0].classList.remove("blockShow");
  $('#recommendations')[0].classList.add("blockHidden");
  $('#recommendations')[0].classList.remove("blockShow");
  $('#analytics')[0].classList.add("blockHidden");
  $('#analytics')[0].classList.remove("blockShow");
  $('#rate')[0].classList.add("blockHidden");
  $('#rate')[0].classList.remove("blockShow");
  $('#'+newpage)[0].classList.add("blockShow");
  $('#'+newpage)[0].classList.remove("blockHidden");

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
  logt = $('#logtxt')[0].innerHTML;
  if (logt == "Login") {
alert ( "You must be logged in to rate a movie" );
  } else
    changeScreen ("rate");
}

function openLog() {
  // When the user clicks on the button, open the modal
  logt = $('#logtxt')[0].innerHTML;
  if (logt == "logout") {
    $('#logtxt')[0].innerHTML = "login";
    $('#navrate2')[0].classList.add("disabled");
    changeScreen("splash");
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
  var table = $('#existing')[0];
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
  $('#logtxt')[0].innerHTML = "logout";
  $('#navrate2')[0].classList.remove("disabled");
  uname = "john";
  // unhook the others
  // now log in with new User



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
  uname = $('#muser').val();

}

function rejectLogin(errTxt) {

  $('#LReply').text(errTxt);
  $('#LReply').css("color", "red");
}

function browseSearch() {
// this is the function where we take a string from the browse screen and look for matching movies
  jstr = JSON.stringify({
    "action": "browse",
    "target": $('#mname').val()
  });
  // all packed up, let's go find it
  ajaxJCall("dt.php", jstr, browseListUpdate);
}

function browseListUpdate(dat) {
// and this is when we return a list of movies, if any, that match the search stringify
// first let's show the returned string for debug

  // clear out any old messages
  $('#browseMsg').text("");

  obj = JSON.parse(dat);

  var table = $('#browseTable')[0];
  var len = table.rows.length;

  // if there is stuff in the table, empty it first

  while ( len > 1 ) {
    table.deleteRow(--len);
  }
  // now display any new results

  var i;
  for (i = 1; ( i < obj.length ) && ( i <  11 ); i++) {

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

  if ( obj.length > 10 ) {
    $('#browseMsg').text("There are more than 10 results, these are the first 10");
  }

}

function analyticsSearch () {

  var radioValue = $("input[name='show']:checked").val();

  var budget =  $("#selBudget option:selected").text();
  var length =  $("#selLength option:selected").text();
  var language =  $("#selLanguage option:selected").text();
  var genre =  $("#selGenre option:selected").text();
  var jstr = JSON.stringify({
    "action": "analytics",
    "radio": radioValue,
    "budget": budget,
    "length": length,
    "language": language,
    "genre": genre
  });

  // all packed up, let's go find it
  ajaxJCall("dt.php", jstr, analyticsUpdate);

}

function analyticsUpdate ( dat ) {

    obj = JSON.parse(dat);
    var cdat = [];
    var ccat = [];

    var i;
    // remember obj[0] is the return meta stuff, the data array starts at obj[1]
    for (i = 1; i < obj.length; i++) {
      cdat.push(obj[i].val);
      ccat.push(obj[i].name);
    }
    // update kendoChart
      $("#chart").kendoChart({
        title: {
          text: obj[0].radio
        },
        legend: {
          position: "bottom"
        },
        seriesDefaults: {
          type: "line"
        },
        series: [{
          data: cdat
        }],
        valueAxis: {
          labels: {
            format: "{0}"
          }
        },
        categoryAxis: {
          categories: ccat
        }
      });

}

function getRatings ( user ) {

  var jstr = JSON.stringify({
    "action": "getRatings",
    "user": uname;
  });

  // all packed up, let's go find it
  ajaxJCall("dt.php", jstr, analyticsUpdate);

}

function updateRatings ( dat )
 {

   obj = JSON.parse(dat);

   var table = $('#rateTable')[0];
   var len = table.rows.length;

   // if there is stuff in the table, empty it first

   while ( len > 1 ) {
     table.deleteRow(--len);
   }
   // now display any new results

   var i;
   for (i = 1; ( i < obj.length ) && ( i <  11 ); i++) {

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

   if ( obj.length > 10 ) {
     $('rateMsg').text("There are more than 10 results, these are the first 10");
   }

 }
