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
<body class="section-3"> 
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

$connect = new PDO("sqlite:/home/ems/web.db");

$sqld = "SELECT * FROM doors ORDER BY Name"; 

foreach ($connect->query($sqld) as $info) 
{ 
$DoorID=$info['DoorID'];
$Name=$info['Name'];
${d.$DoorID}=($Name);
}

$sql = "SELECT * FROM systemscanners ORDER BY Name"; 

echo "<table align='center' border='0' bgcolor='white'>
<tr><td colspan='2'><hr></td></tr>
<tr><th>Name</th>
<th>&nbsp;</th></tr>
<tr><td colspan='2'><hr></td></tr>"; 

foreach ($connect->query($sql) as $info) 
{ 
$ScannerID=$info['ScannerID'];
$Name=$info['Name'];
$DoorID=$info['DoorID'];

echo "<tr align='center'>";
echo "<td width='16%'> $Name </td>";
echo "<td width='5%'> <a href='edit_reader.php?action=edit&scannerid=$ScannerID'>Edit</a></td>"; 
echo "</tr><tr><td colspan='2'><hr></td></tr>"; 
} 
echo "</table>"; 
?>
</font></body>
</html>