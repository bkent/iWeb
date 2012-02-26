
var getQuery = function(){
	var firstname = document.getElementById("firstname").value;
	var surname = document.getElementById("surname").value;
	var tagid = document.getElementById("tagid").value;
	
	return "ajax=true&firstname=" + encodeURI(firstname) + "&surname=" + encodeURI(surname) + "&tagid=" + encodeURI(tagid); 
}

var setQuery = function()
{
	var frm = document.getElementsByTagName("form")[0];
	    frm.onsubmit = function(){
			var query = getQuery();
			myHijax(query);
			document.getElementById("waiting").style.display = "block";
			document.getElementById("output").style.display = "none";
			return false;
		}
}

var myHijax = function(qs)
{
	var x = 	new AO("cgi-bin/php/postpeople.php",qs);
		x.onload = function()
		{
			if (x.init && x.status == "200")
				x.putHere("output");
				document.getElementById("waiting").style.display = "none"; 
				document.getElementById("output").style.display = "block";
		}
		x.post();
	return false;
}

window.onload = function(){
	var bSupport = new AO();
	if (bSupport.init) { // test for support of Ajax
		setQuery();
		bSupport = null;
	}
	else return false;
}