
var getQuery = function(){
	
	var fname = document.getElementById("fname").value;
	var surname = document.getElementById("surname").value;
	var tagid = document.getElementById("tagid").value;
	var empid = document.getElementById("empid").value;
	var check1 = document.getElementById("check1").value;
	var check2 = document.getElementById("check2").value;
	
	return "ajax=true&fname=" + encodeURI(fname) + "&surname=" + encodeURI(surname) + "&tagid=" + encodeURI(tagid) + "&empid=" + encodeURI(empid)+ "&check1=" + encodeURI(check1)+ "&check2=" + encodeURI(check2); 
}

var setQuery = function()
{
	var frm = document.getElementsByTagName("form")[0];
	    frm.onsubmit = function(){
			var query = getQuery();
			myHijax(query);
			document.getElementById("waiting").style.display = "block";
			document.getElementById("contents").style.display = "none";
			return false;
		}
}

var myHijax = function(qs)
{
	var x = 	new AO("update_person.php",qs);
		x.onload = function()
		{
			if (x.init && x.status == "200")
				x.putHere("contents");
				document.getElementById("waiting").style.display = "none"; 
				document.getElementById("contents").style.display = "block";
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