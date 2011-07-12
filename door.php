<html>
<body background="/Images/bg.jpg" bgproperties="fixed" >
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
<div align="center">
<a href="download.php">
<img src="Images/download.jpg" alt="Download changes to controller" title="Download changes to controller" border="0" />
</a>
</div>

<?php
$connect = new PDO("sqlite:/home/ems/web.db");

$sql = "SELECT * FROM doors ORDER BY Name";

echo "<table align='center' border='1' bgcolor='white' width='60%'>
<tr><th width='33%'>Door ID</th>
<th width='33%'>Name</th>
<th width='33%'>&nbsp;</th></tr>"; 

foreach ($connect->query($sql) as $info) 
{
$DoorID=$info['DoorID'];
$Name=$info['Name'];

echo "<tr align='center'>"; 
echo "<td width='16%'> $DoorID </td>";
echo "<td width='16%'> $Name </td>";
echo "<td width='5%'> <a href='edit_door.php?action=edit&doorID=$DoorID'>Edit</a><br />";

$sqld = "SELECT * FROM doornormal WHERE DoorID=$DoorID";

foreach ($connect->query($sqld) as $info) 
{ 
$elLevel=$info['elLevel'];

if ($elLevel ==1)
{
echo "<a href='edit_door.php?action=open&doorID=$DoorID' title='Note: it will be several seconds before the door opens'>Force Open</a><br />";
}

if ($elLevel ==0)
{
echo "<a href='edit_door.php?action=close&doorID=$DoorID' title='Note: it will be several seconds before the door closes'>Force Closed</a></td>";
}

}

echo "</tr>"; 
} 
echo "</table>"; 
?>
</body>
</html>