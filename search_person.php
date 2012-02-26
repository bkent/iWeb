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
<table align="center" border="0"><tr><td width="33%">&nbsp;</td>
<td width="33%" align="center"><table align="center" border="0">
<tr><td><a href="new_person.php">
<img src="/Images/add_32x32.png" alt="Add a new person" title="Add a new person" border="0" />
</a></td>
<td><a href="bin.php">
<img src="/Images/trash_32x32.png" alt="View Recycle Bin" title="View Recycle Bin" border="0" />
</a></td>
</tr></table></td>
<td align="right" width="33%" ><form action="search_person.php" method="get">
<input type="text" name="q" value="
<?php $var = @$_GET['q'];
$trimmed = trim($var);
echo "$trimmed";
?>">
<input type="submit" value="Search" title="Search First name, Surname and Tag ID">
</td></tr></form>
</table>

<?php
	
if ($trimmed=="")
	{
	echo "<meta http-equiv='refresh' content='0;URL=person.php'>";
	}

//Edit $data to be your query

$connect = new PDO("sqlite:/home/ems/web.db");

$sql = "SELECT * FROM employee WHERE Surname LIKE '%$trimmed%' OR FirstNames LIKE '%$trimmed%' OR TagID LIKE '%$trimmed%' ORDER BY Surname"; 

$i=0;

foreach ($connect->query($sql) as $info) 
{ 
$TagID=$info['TagID'];
$i++;
}

if ($i==0)
{
echo "Sorry, your search '$trimmed' returned no results";
}

else
{

echo "<table align='center' border='0' bgcolor='white'>
<tr><td colspan='4'><hr></td></tr>
<tr><th>First Name</th>
<th>Surname</th>
<th>Tag ID</th>
<th>&nbsp;</th></tr>
<tr><td colspan='4'><hr></td></tr>"; 

foreach ($connect->query($sql) as $info) 
{ 
$FirstNames=$info['FirstNames'];
$Surname=$info['Surname'];
$EmployeeID=$info['EmployeeID'];
$TagID=$info['TagID'];
$Enabled=$info['Enabled'];

$color = "";
$action = "disable";
$CapAction = "Disable";

if ($Enabled == '0'){
$color = "bgcolor='C0C0C0'";
$action = "enable";
$CapAction = "Enable";
}


echo "<tr align='center' $color >"; 
echo "<td width='16%'> $FirstNames </td>";
echo "<td width='16%'> $Surname </td>";
echo "<td width='16%'> $TagID </td>";
echo "<td width='5%'> <a href='edit_person.php?action=edit&EmployeeID=$EmployeeID'>Edit</a><br />";?>
<a href="edit_person.php?action=<?php echo"$action"; ?>&EmployeeID=<?php echo"$EmployeeID"; ?>" onClick="javascript:return confirm('Are you sure you wish to move <?php echo"$FirstNames $Surname"; ?> to the recycle bin?')"><?php echo"$CapAction"; ?></a></td>
<?php
echo "</tr><tr><td colspan='4'><hr></td></tr>"; 
} 
echo "</table>";
}
?>
</div>
</body>
</html>