function ajaxJCall ( func, jstr, cback ) {

	var request = new XMLHttpRequest();

	request.open( "POST", func, true );
	request.setRequestHeader("Content-type", "application/json")

	request.onreadystatechange = function () {
		if ( this.readyState == 4 ) {
			if (this.status == 200) {
				if ( this.responseText != null ) {
					cback ( this.responseText );
				}
				else
					// alert ( "Sorry - we seem to be having a problem right now. Please try again");
					alert("Ajax error: no data was received");
			}
			else
				// alert ( "Sorry - we seem to be having a problem right now. Please try again");
				alert ( "Ajax error: state = " + this.readyState + ", status = " + this.status +
				", stateText = " + this.statusText + ", response Text  = " + this.responseText +
				", response URL = " + this.responseURL );
		}
	}

	if ( globalDebug ) alert ( "sending string: " + jstr );

	request.send( jstr );
}

function setCookie(cname,cvalue) {
	var exdays = 90; // set expiration at 3 months
	var d = new Date();
	d.setTime(d.getTime()+(exdays*24*60*60*1000));
	var expires = "expires="+d.toGMTString();
	document.cookie = cname + "=" + cvalue + "; " + expires + "; path=/";
}

function setTempCookie(cname,cvalue) {
	// do not remember info past this session
	document.cookie = cname + "=" + cvalue + "; path=/";
}

function deleteCookie(cname) {
	document.cookie = cname + "=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/";
}

function getCookie(cname){
	var name = cname + "=";
	var ca = document.cookie.split(';');
	for(var i=0; i<ca.length; i++) {
	  var c = ca[i].trim();
	  if (c.indexOf(name)==0) return c.substring(name.length,c.length);
	}
	return "";
}
