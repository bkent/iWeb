<?php

//Check if user is legitimately logged in

$loginfile = "/etc/login";

$fh = fopen($loginfile, 'r') or die("can't open file");

$login = fread($fh, filesize($loginfile));

fclose($fh);

if ($login == 0) {
echo "<br /><br /><div align='center'><font face='arial'>You are not logged on. Please click <a href='/index.html' target='_top'>here</a></font></div>";
exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html> 
<head> 
<title>Controlsoft iWeb</title> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<link href="tab.css" rel="stylesheet" type="text/css" />
</head> 
<body> 
<div id="contents"> 
	<p><br /><br /></p><br />
<table align='center'>
<tr><td><a href="home.html?iwebtabs=1"><img src="Images/user_32x32.png"/></a></td><td><a href="home.html?iwebtabs=1"><img src="Images/people.png"/></a></td><td></td></tr>
<tr><td><a href="home.html?iwebtabs=2"><img src="Images/door_32x32.png"/></a></td><td><a href="home.html?iwebtabs=2"><img src="Images/doors.png"/></a></td></tr>
<tr><td><a href="home.html?iwebtabs=3"><img src="Images/round_ok_32x32.png"/></a></td><td><a href="home.html?iwebtabs=3"><img src="Images/logs.png"/></a></td><td></td></tr>
<tr><td><a href="home.html?iwebtabs=4"><img src="Images/wrench_32x32.png"/></a></td><td><a href="home.html?iwebtabs=4"><img src="Images/settings.png"/></a></td></tr>
</table>
</div>
</body> 
</html> 