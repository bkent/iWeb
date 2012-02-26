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
<tr><th>Reader Name</th>
<th>Action</th></tr>
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
</body>
</html>