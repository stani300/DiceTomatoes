// JavaScript Document


function openLogin() {
    $('#myModal').fadeIn(500);
}

function closeLogin() {
  $('#myModal').fadeOut(500);
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

function getMyRatings ( user ) {

  var jstr = JSON.stringify({
    "action": "getRatings",
    "user": user
  });

  // all packed up, let's go find it
  ajaxJCall("dt.php", jstr, showMyRatings);

}

function showMyRatings ( dat )
 {

   obj = JSON.parse(dat);

   var table = $('#myRatingsTable')[0];
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
     var cell4 = row.insertCell(3);

     // Add some text to the new cells:
     cell1.innerHTML = obj[i].name;
     cell2.innerHTML = obj[i].year;
     cell3.innerHTML = '<input type="text" id="ER' + i + '" value="' + obj[i].rating + '" "/>';
     cell4.innerHTML = '<button onClick="deleteRating(' + i + ')">Delete</button><button onClick="updateRating(' + i + ')">Update</button>'

   }

   if ( obj.length > 10 ) {
     $('#rateMsg').text("There are more than 10 results, these are the first 10");
   }

 }

 function updateRating ( x ) {
   alert ( "Update rating " + x );
   getMyRatings (user );
 }

 function deleteRating ( x ) {
   alert ( "delete rating " + x );
   getMyRatings ( user );
 }

 function findMTR() {
   // findMTR = find Movies to Rate - find the movies that match the search string
 // this is the function where we take a string from the browse screen and look for matching movies
   jstr = JSON.stringify({
     "action": "browse",
     "target": $('#mtrtext').val()
   });
   // all packed up, let's go find it

   ajaxJCall("dt.php", jstr, updateMTR);
 }

 function updateMTR (dat) {
   // update MTR = update Movies to Rate
 // and this is when we return a list of movies, if any, that match the search string

   // clear out any old messages
   $('#MTRMsg').text("");

   obj = JSON.parse(dat);

   var table = $('#MTRTable')[0];
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
     var cell4 = row.insertCell(3);

     // Add some text to the new cells:
     cell1.innerHTML = obj[i].name;
     cell2.innerHTML = obj[i].year;
     // right not this is foirced to just the first entry
     cell3.innerHTML = '<input type="text" id="NR' + i + '" />';
     cell4.innerHTML = '<button onClick="addRating(' + i + ')">Add</button>';

   }

   if ( obj.length > 10 ) {
     $('MTRMsg').text("There are more than 10 results, these are the first 10");
   }

 }

function addRating ( i ) {
  alert ( "add rating " + $('#NR'+i ).val() + " for movie on line " + i );
  var jstr = JSON.stringify({
    "action": "addRating",
    "user": user,
    "movie": "alien",
    "rating": "5"
  });

  // all packed up, let's go find it
  ajaxJCall("dt.php", jstr, ratingAdded);
}

function ratingAdded () {
  // clean up rating myTable
  // display new ratings myTable
  alert ( "rating added" );
}
