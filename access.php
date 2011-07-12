<?php
<a href="upload.php">
<img src="Images/up_arrow_32x32.png" alt="Upload logs from device" title="Upload logs from device" border="0" /></a>
<img src="Images/delete_32x32.png" alt="Remove all logs" title="Remove all logs - The I-Net ACU will reboot once the logs are removed - allow 60 seconds before trying to access these webpages again. YOUR DOORS WILL NOT FUNCTION DURING THIS TIME!" border="0" /></a>
<?php
$connect = new PDO("sqlite:/home/ems/log.db");
$sqlp = "SELECT * FROM employee";
foreach ($webconnect->query($sqlp) as $info)
{
$FirstNames=$info['FirstNames'];
$Surname=$info['Surname'];
$TagID=$info['TagID'];
${p.$TagID}=($FirstNames.'&nbsp;'.$Surname);
}

$sql = "SELECT STRFTIME('%d/%m/%Y %H:%M:%S',DateTimeEx), Data, Time, EventCode, LogID FROM systemlog ORDER BY LogID DESC LIMIT 7"; 
echo "<table align='center' border='0' bgcolor='white'>
<tr><th>&nbsp;</th>
<th>Date/Time</th>
<th>Name</th>
<th>Location</th>
<th>Result</th>
<th>Tag ID</th>
</tr>
foreach ($connect->query($sql) as $info) 
{ 
$DateTimeEx=$info["STRFTIME('%d/%m/%Y %H:%M:%S',DateTimeEx)"];
$Data=$info['Data'];//TagID
$Time=$info['Time'];//realtes to Scanner ID (Location)
$EventCode=$info['EventCode'];
if ($EventCode ==265)
{
echo "<td width='5%'><img src=Images/allowed.jpg /></td><td width='16%'>$DateTimeEx</td>";
$access='Access Allowed';
}
else if ($EventCode ==514)
{
echo "<td width='5%'><img src=Images/denied.jpg /></td><td width='16%'>$DateTimeEx</td>";
$access='Unknown ID card';
}
else
{
echo "<td width='5%'></td><td width='16%'>$DateTimeEx</td>";
$access='Undefined Event';
} 
} 
echo "</table>"; 