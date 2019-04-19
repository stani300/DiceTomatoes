// JavaScript Document

function setNavigation() {
  var path = window.location.pathname;
  // get the last part of the URL
  path = path.substr(path.lastIndexOf('/') + 1);
  console.log(path);

  $(".navbar-nav.mr-auto a").each(function() {
    var href = $(this).attr('href');
    console.log(href);
    if (path.substring(0, href.length) === href) {
      $(this).closest('li').addClass('active');
    }
  });
}

function openLogin() {
  lstate = $('#logtxt').text();
  if (lstate == "Login") {
    $('#myModal').fadeIn(500);
  } else {
    user = "";
    uid = "";
    $('#currUser').text("You are not logged in");
    $('#rateBlock').fadeOut(100);
    $('#logtxt').text("Login");
  }
}

function closeLogin() {
  $('#myModal').fadeOut(500);
}

function userLogin() {

  jstr = JSON.stringify({
    "action": "login",
    "acct": $('#facct').val(),
    "pwd": $('#fpwd').val()
  });
  closeLogin();
  // all packed up, let's go find it
  ajaxJCall("jlog.php", jstr, setUser);
}

function setUser(dat) {
  obj = JSON.parse(dat);
  if (typeof jpage !== 'undefined') {
    user = obj[0].uname;
    uid = obj[0].uid;
    if (user != "") {
      $('#currUser').text("You are logged in as : " + user);
      getMyRatings(user);
      $('#rateBlock').fadeIn(100);
      $('#logtxt').text("Logout");
    }
  }
}

function recSearch( avgYr, avgRun, mylang ) {
  // this is the function where we take a string from the browse screen and look for matching movies
  jstr = JSON.stringify({
    "action": "recommendation",
    "avgYr": avgYr,
    "avgRun": avgRun,
    "mylang": mylang
  });

  // all packed up, let's go find it
  ajaxJCall("dt.php", jstr, recListUpdate);
}

function recListUpdate(dat) {
  // and this is when we return a list of movies, if any, that match the search params

  // clear out any old messages
  $('#recMsg').text("");

  obj = JSON.parse(dat);

  var table = $('#recTable')[0];
  var len = table.rows.length;

  // if there is stuff in the table, empty it first

  while (len > 1) {
    table.deleteRow(--len);
  }
  // now display any new results

  var i;
  for (i = 1;
    (i < obj.length) && (i < 11); i++) {

    // Create an empty <tr> element and add it to the end of the table
    var row = table.insertRow(i);

    // Insert new cells (<td> elements) of the "new" <tr> element:
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);

    // Add some text to the new cells:
    cell1.innerHTML = obj[i].name;
    cell2.innerHTML = obj[i].year;
    cell3.innerHTML = obj[i].rating;
    cell4.innerHTML = obj[i].runtime;
    cell5.innerHTML = obj[i].lang;

  }

  if (obj.length > 10) {
    $('#recMsg').text("There are more than 10 results, these are the first 10");
  }

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

  while (len > 1) {
    table.deleteRow(--len);
  }
  // now display any new results

  var i;
  for (i = 1;
    (i < obj.length) && (i < 11); i++) {

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

  if (obj.length > 10) {
    $('#browseMsg').text("There are more than 10 results, these are the first 10");
  }

}

function analyticsSearch() {

  var show = $("input[name='show']:checked").val();
  var showby = $("input[name='showby']:checked").val();
  var minYr = $("#selMinYr option:selected").text();

  var jstr = JSON.stringify({
    "action": "analytics",
    "show": show,
    "showby": showby,
    "minYr": minYr
  });

  // all packed up, let's go find it
  ajaxJCall("dt.php", jstr, analyticsUpdate);

}

function analyticsUpdate(dat) {

  obj = JSON.parse(dat);
  var cdat = [];
  var ccat = [];

  var i;
  // remember obj[0] is the return meta stuff, the data array starts at obj[1]
  for (i = 1; i < obj.length; i++) {
    cdat.push(obj[i].ydat);
    ccat.push(obj[i].xdat);
  }
  // update kendoChart
  $("#chart").kendoChart({
    title: {
      text: obj[0].show
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

function getMyRatings() {

  var jstr = JSON.stringify({
    "action": "getRatings",
    "uid": uid
  });

  // all packed up, let's go find it
  ajaxJCall("dt.php", jstr, showMyRatings);

}

function showMyRatings(dat) {
  obj = JSON.parse(dat);
  var yrTotal = 0;
  var mCnt = 0;
  var runTotal = 0;

  var table = $('#myRatingsTable')[0];
  var len = table.rows.length;

  // if there is stuff in the table, empty it first

  while (len > 1) {
    table.deleteRow(--len);
  }
  // now display any new results

  var i;
  for (i = 1;
    (i < obj.length) && (i < 11); i++) {

    // Create an empty <tr> element and add it to the end of the table
    var row = table.insertRow(i);

    // Insert new cells (<td> elements) of the "new" <tr> element:
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    if ( jpage == "reco" ) {
      var cell5 = row.insertCell(4);
    }

    // Add some text to the new cells:
    cell1.innerHTML = obj[i].name;
    cell2.innerHTML = obj[i].year;
    yrTotal +=  parseInt(obj[i].year);
    ++mCnt;
    runTotal += parseInt(obj[i].runtime);

    if (jpage == "rate") {
      cell3.innerHTML = '<input type="text" id="ER' + i + '" value="' + obj[i].rating + '" "/>';
      cell4.innerHTML = '<button onClick="deleteRating(' + obj[i].rid + ')">Delete</button><button onClick="updateRating(' + i + ',' + obj[i].rid + ')">Update</button>';
    } else {
      cell3.innerHTML = obj[i].rating;
      cell4.innerHTML = obj[i].runtime;
      cell5.innerHTML = obj[i].language;
    }

  }

  if (obj.length > 10) {
    $('#rateMsg').text("There are more than 10 results, these are the first 10");
  }

  avgYr = Math.round(yrTotal/mCnt);
  avgRuntime = Math.round(runTotal/mCnt);

  if ( jpage == "reco" ) {
    $('#recoStats').text("For movies you have reviewed: average year = " + avgYr + ", average runtime = " + avgRuntime + ", language = " + mylang );
  }

  if ( jpage == "reco" ) {
    recSearch (  avgYr, avgRuntime, mylang );
  }

}

function updateRating(i, id) {
  newr = $('#ER' + i).val();
  var jstr = JSON.stringify({
    "action": "updateRating",
    "rid": id,
    "rating": newr
  });

  // all packed up, let's go find it
  ajaxJCall("dt.php", jstr, ratingUpdated);
}

function ratingUpdated() {
  getMyRatings(user);
}

function deleteRating(x) {

  var jstr = JSON.stringify({
    "action": "deleteRating",
    "rid": x,
  });

  // all packed up, let's go find it
  ajaxJCall("dt.php", jstr, ratingDeleted);

}

function ratingDeleted() {
  getMyRatings(user);
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

function updateMTR(dat) {
  // update MTR = update Movies to Rate
  // and this is when we return a list of movies, if any, that match the search string

  // clear out any old messages
  $('#MTRMsg').text("");

  obj = JSON.parse(dat);

  var table = $('#MTRTable')[0];
  var len = table.rows.length;

  // if there is stuff in the table, empty it first

  while (len > 1) {
    table.deleteRow(--len);
  }
  // now display any new results

  var i;
  for (i = 1;
    (i < obj.length) && (i < 11); i++) {

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
    cell4.innerHTML = '<button onClick="addRating(' + i + ',' + obj[i].id + ')">Add</button>';

  }

  if (obj.length > 10) {
    $('MTRMsg').text("There are more than 10 results, these are the first 10");
  }

}

function addRating(i, id) {
  newr = $('#NR' + i).val();

  var jstr = JSON.stringify({
    "action": "addRating",
    "uid": uid,
    "movie": id,
    "rating": newr
  });

  // all packed up, let's go find it
  ajaxJCall("dt.php", jstr, ratingAdded);
}

function ratingAdded(dat) {

  // clean up rating myTable

  var table = $('#MTRTable')[0];
  var len = table.rows.length;

  // empty the table of movies to rate

  while (len > 1) {
    table.deleteRow(--len);
  }

  // display new ratings myTable
  getMyRatings();
}
