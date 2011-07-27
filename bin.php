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
include "functions.php";
$connect = new PDO("sqlite:/home/ems/web.db");

if (!(isset($pagenum))) 

{ 

$pagenum = 1; 

} 

$sql = "SELECT * FROM employee WHERE Enabled ='0' ORDER BY Surname"; 

$rows = 0;
foreach ($connect->query($sql) as $info) 
{ 
$EmployeeID=$info['EmployeeID'];
$rows ++;
}

//This is the number of results displayed per page 
$page_rows = 6;

//This tells us the page number of our last page 
$last = ceil($rows/$page_rows);

//this makes sure the page number isn't below one, or more than our maximum pages 
if ($pagenum < 1) 
{ 
$pagenum = 1; 
} 
elseif ($pagenum > $last) 
{ 
$pagenum = $last; 
} 

//This sets the range to display in our query 
$max = 'limit ' .($pagenum - 1) * $page_rows .',' .$page_rows;

//This is your query again, the same one... the only difference is we add $max into it
$sql_p = "SELECT * FROM employee WHERE Enabled ='0' ORDER BY Surname $max"; 

//while($info = sqlite_fetch_array( $sql )) 

//while ($info = $sql->fetch(PDO::FETCH_ASSOC))	
echo "<table align='center' border='0' bgcolor='white'>
<tr><td colspan='4'><hr></td></tr>
<tr><th>First Name</th>
<th>Surname</th>
<th>ID Card</th>
<th>&nbsp;</th></tr>
<tr><td colspan='4'><hr></td></tr>"; 

foreach ($connect->query($sql_p) as $info) 
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
<a href="edit_person.php?action=<?php echo"$action"; ?>&EmployeeID=<?php echo"$EmployeeID"; ?>" onClick="javascript:return confirm('Are you sure you wish to <?php echo"$action"; ?> the card for <?php echo"$FirstNames $Surname"; ?>?')"><?php echo"$CapAction"; ?></a></td>
<?php
echo "</tr><tr><td colspan='4'><hr></td></tr>"; 
} 
echo "</table>";

// This shows the user what page they are on, and the total number of pages
echo " --Page $pagenum of $last-- <p>";

// First we check if we are on page one. If we are then we don't need a link to the previous page or the first page so we do nothing. If we aren't then we generate links to the first page, and to the previous page.
if ($pagenum == 1) 
{
} 
else 
{
echo " <a href='{$_SERVER['PHP_SELF']}?pagenum=1'> <<-First</a> ";
echo " ";
$previous = $pagenum-1;
echo " <a href='{$_SERVER['PHP_SELF']}?pagenum=$previous'> <-Previous</a> ";
} 

//just a spacer
echo " ---- ";

//This does the same as above, only checking if we are on the last page, and then generating the Next and Last links
if ($pagenum == $last) 
{
} 
else {
$next = $pagenum+1;
echo " <a href='{$_SERVER['PHP_SELF']}?pagenum=$next'>Next -></a> ";
echo " ";
echo " <a href='{$_SERVER['PHP_SELF']}?pagenum=$last'>Last ->></a> ";
} 

//test();
?>
</font>
</div>
</div>
</div>
</body>
</html>