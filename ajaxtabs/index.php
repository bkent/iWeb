<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml2/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<link rel="stylesheet" type="text/css" href="ajaxtabs/iweb.css" />

<script type="text/javascript">
var loadit=function(){
var f=document.getElementById('iwebdivcontainer'), l=document.getElementById('loading').style;
l.display='block';
if(f.onload==null){
f.onload=function(){l.display='none'};
if(window.attachEvent)
f.attachEvent('onload', f.onload);
}
return true;
}

</script>

<script type="text/javascript" src="ajaxtabs/ajaxtabs.js">

/***********************************************
* Ajax Tabs Content script v2.2- � Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/
</script>

</head>

<body>
<div id="frame">
<div id="iwebtabs" class="indentmenu">
<ul>
<li><a href="dashboard.html" rel="#iframe" class="selected">Dashboard</a></li>
<li><a href="people.html" rel="#iframe">People</a></li>
<li><a href="http://controlsoft.com" rel="#iframe">Doors</a></li>
<li><a href="http://google.co.uk" rel="#iframe">Logs</a></li>
<li><a href="test.php" rel="#iframe">Settings</a></li>
</ul>
<br style="clear: left" />
</div>

<div id="iwebdivcontainer" style="border:1px solid gray; width:100%; height: 560px; padding-top: 5px; background:white;">
</div>
<div id="bottom">Controlsoft iWeb
</div>

<script type="text/javascript">

var iweb=new ddajaxtabs("iwebtabs", "iwebdivcontainer")
iweb.setpersist(false)
iweb.setselectedClassTarget("link")
iweb.init()

</script>
<p><a href="index.php?iwebtabs=1">Reload page and select 2nd tab using URL parameter</a></p>
</div>
</body>
</html>