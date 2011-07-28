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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html> 
<head> 
<title>Controlsoft iWeb Mobile</title> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
</head> 
<body>
<?php

$connect = new PDO("sqlite:/home/ems/log.db");
$webconnect = new PDO("sqlite:/home/ems/web.db");

$sql = "SELECT * FROM systemscanners";

foreach ($webconnect->query($sql) as $info) 
{ 
$ScannerID=$info['ScannerID'];

$Name=$info['Name'];

${d.$ScannerID}=($Name);
}

$sqlp = "SELECT * FROM employee";

foreach ($webconnect->query($sqlp) as $info)

{

$FirstNames=$info['FirstNames'];

$Surname=$info['Surname'];

$TagID=$info['TagID'];

${p.$TagID}=($FirstNames.'&nbsp;'.$Surname);

}



$sql = "SELECT STRFTIME('%d/%m/%Y %H:%M:%S',DateTimeEx), Data, Time, EventCode, LogID FROM systemlog ORDER BY LogID DESC LIMIT 7"; 


echo "<table align='center' border='0' bgcolor='white' width='100%'>

<tr><th colspan='6'>Controlsoft iWeb Mobile - Recent events</th></tr>

<tr><td colspan='6'><hr></td></tr>

<tr><th>&nbsp;</th>

<th>Date/Time</th>

<th>Name</th>

<th>Location</th>

<th>Result</th>

<th>Tag ID</th>

</tr>
<tr><td colspan='6'><hr></td></tr>"; 

foreach ($connect->query($sql) as $info) 

{ 

$DateTimeEx=$info["STRFTIME('%d/%m/%Y %H:%M:%S',DateTimeEx)"];

$Data=$info['Data'];//TagID

$Time=$info['Time'];//realtes to Scanner ID (Location)

$EventCode=$info['EventCode'];


if ($EventCode ==265)

{
echo "<tr align='center'>";

echo "<td width='5%'><img src=Images/allowed.jpg /></td><td width='16%'>$DateTimeEx</td>";

$access='Access Allowed';

echo "<td width='16%'>";

?><?php echo ${p.$Data}; ?><?php

echo "</td>";

echo "<td width='16%'>";?><?php echo ${d.$Time}; ?><?php 

echo "</td>";

echo "<td width='16%'> $access </td>";

echo "<td width='16%'> $Data </td>";

echo "</tr><tr><td colspan='6'><hr></td></tr>";

}

else if ($EventCode ==514)

{

echo "<tr align='center'>";
echo "<td width='5%'><img src=Images/denied.jpg /></td><td width='16%'>$DateTimeEx</td>";

$access='Unknown ID card';

echo "<td width='16%'>";

?><?php echo ${p.$Data}; ?><?php

echo "</td>";

echo "<td width='16%'>";?><?php echo ${d.$Time}; ?><?php 

echo "</td>";

echo "<td width='16%'> $access </td>";

echo "<td width='16%'> $Data </td>";

echo "</tr><tr><td colspan='6'><hr></td></tr>";

}

else if ($EventCode ==517)

{

echo "<tr align='center'>";
echo "<td width='5%'><img src=Images/denied.jpg /></td><td width='16%'>$DateTimeEx</td>";

$access='Access to reader not granted';

echo "<td width='16%'>";

?><?php echo ${p.$Data}; ?><?php

echo "</td>";

echo "<td width='16%'>";?><?php echo ${d.$Time}; ?><?php 

echo "</td>";

echo "<td width='16%'> $access </td>";

echo "<td width='16%'> $Data </td>";

echo "</tr><tr><td colspan='6'><hr></td></tr>";

}

else if ($EventCode ==515)

{

echo "<tr align='center'>";
echo "<td width='5%'><img src=Images/denied.jpg /></td><td width='16%'>$DateTimeEx</td>";

$access='Card disabled';

echo "<td width='16%'>";

?><?php echo ${p.$Data}; ?><?php

echo "</td>";

echo "<td width='16%'>";?><?php echo ${d.$Time}; ?><?php 

echo "</td>";

echo "<td width='16%'> $access </td>";

echo "<td width='16%'> $Data </td>";

echo "</tr><tr><td colspan='6'><hr></td></tr>";

}

else if ($EventCode ==273)

{

echo "<tr align='center'>";
echo "<td width='5%'><img src=Images/allowed.jpg /></td><td width='16%'>$DateTimeEx</td>";

$access='Push Button Pressed';

echo "<td width='16%'>";

echo "N/A";

echo "</td>";

echo "<td width='16%'>";?><?php echo ${d.$Time}; ?><?php

echo "</td>";

echo "<td width='16%'> $access </td>";

echo "<td width='16%'> N/A </td>";

echo "</tr><tr><td colspan='6'><hr></td></tr>";

}

else if ($EventCode ==1042)

{
}

else if ($EventCode ==1037)

{
}

else if ($EventCode ==100)

{

echo "<tr align='center'>";
echo "<td width='5%'><img src=Images/fdoor.jpg /></td><td width='16%'>$DateTimeEx</td>";

$access='Door Forced Open';

echo "<td width='16%'>";

echo "Web Access User";

echo "</td>";

echo "<td width='16%'>";?><?php echo ${d.$Time}; ?><?php

echo "</td>";

echo "<td width='16%'> $access </td>";

echo "<td width='16%'> N/A </td>";

echo "</tr><tr><td colspan='6'><hr></td></tr>";

}

else if ($EventCode ==101)

{

echo "<tr align='center'>";
echo "<td width='5%'><img src=Images/fdoor.jpg /></td><td width='16%'>$DateTimeEx</td>";

$access='Door Forced Closed';

echo "<td width='16%'>";

echo "Web Access User";

echo "</td>";

echo "<td width='16%'>";?><?php echo ${d.$Time}; ?><?php

echo "</td>";

echo "<td width='16%'> $access </td>";

echo "<td width='16%'> N/A </td>";

echo "</tr><tr><td colspan='6'><hr></td></tr>";

}

else

{
echo "<tr align='center'>";
echo "<td width='5%'></td><td width='16%'>$DateTimeEx</td>";

$access='Undefined Event';

echo "<td width='16%'>";

?><?php echo ${p.$Data}; ?><?php

echo "</td>";

echo "<td width='16%'> $Time </td>";

echo "<td width='16%'> $access </td>";

echo "<td width='16%'> $Data </td>";

echo "</tr><tr><td colspan='6'><hr></td></tr>";

} 
//echo "<tr><td colspan='6'><hr></td></tr>";
} 

echo "</table><br /><br />"; 

?>
<a href="logout.php"><img src="Images/delete_32x32.png"/>Logout</a>
</body>
</html>