<?php

//Check if user is legitimately logged in

$loginfile = "/etc/login";

$fh = fopen($loginfile, 'r') or die("can't open file");

$login = fread($fh, filesize($loginfile));

fclose($fh);

if ($login == 0) {
echo "<br /><br /><div align='center'>You are not logged on. Please click <a href='/index.html' target='_top'>here</a></div>";
exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html> 
<head> 
<title>Controlsoft iWeb</title> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<link href="tab.css" rel="stylesheet" type="text/css" />
</head> 
<body class="section-2"> 
<div id="frame"> 
<div id="left">
<div id="logo">
<img src="Images/cslogo.jpg"/>
<?php
echo date('d/m/Y <br /> H:i:s');
?>
</div>
<div id="logout">
<a href="logout.php"><img src="Images/delete_32x32.png"/>Logout</a>
</div>
</div>
<div id="main">
<ul id="menu"> 
  <li id="nav-1"><a href="access.php"><img src="Images/round_ok_32x32.png"/>Events</a></li> 
  <li id="nav-2"><a href="person.php"><img src="Images/user_32x32.png"/>People</a></li> 
  <li id="nav-3"><a href="reader.php"><img src="Images/door_32x32.png"/>Doors</a></li> 
  <li id="nav-4"><a href="settings.php"><img src="Images/wrench_32x32.png"/>Settings</a></li>
</ul> 
<div id="contents">
<?php
$i=1;
$connect = new PDO("sqlite:/home/ems/web.db");

$sql = "SELECT * FROM systemscanners";
  
echo "<table border='0' align='center'><td><table border='0' align='center' bgcolor ='white'>
<form name='form' action='add_person.php' method='get'>
<tr><td colspan='2' align='center'><b>Add New Person</b></td></tr>
<tr><td>First Name: </td><td><input type='text' name='fname' /></td></tr>
<tr><td>Surname: </td><td><input type='text' name='surname' /></td></tr>
<tr><td>ID Card: </td><td><input type='text' name='tagid' /></td></tr>
<tr><td colspan='2' align='center'>Allow access at:</td></tr>";
foreach ($connect->query($sql) as $info)
{
$ScannerID=$info['ScannerID'];
$Name=$info['Name'];
echo "<tr><td colspan='2' align='center'><input type='checkbox' name='$i' value='$ScannerID' /> &nbsp; $Name</td></tr>";
$i++;
}
echo "<input type='hidden' name='number' value='$i' />
<tr><td>&nbsp;</td><td></td></tr><tr align='center'><td>&nbsp;</td><td><table border='0' align='center' bgcolor='white'><tr><td><input type='submit' name='Submit' value='  OK   ' /></form></td>

<form action='person.php' method='get'><td><input type='submit' value='Cancel'></form></td></tr></td></table></tr>

</table></td></table>";

?>
</font>
</div>
</div>
</div>
</body>
</html>