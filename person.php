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
$pagenum = @$_GET['pagenum'];
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
<input type="text" name="q">
<input type="submit" value="Search" title="Search First name, Surname and Tag ID">
</td></tr></form>
</table>

<?php
/*
//Check if user is legitimately logged in

$loginfile = "/etc/login";

$fh = fopen($loginfile, 'r') or die("can't open file");

$login = fread($fh, filesize($loginfile));

fclose($fh);

if ($login == 0) {
echo "<a href='/index.html' target='_top'>Login</a>";
exit;
//echo "<meta http-equiv='refresh' content='0;URL=/index.html'>";
//echo "<meta http-equiv='refresh' content='0;URL=javascript:open('/index.html')'>";
}*/
//Full download button from above - code after </a></td> for the add new person
/*<td><a href="download.php">
<img src="Images/download.jpg" alt="Download changes to controller" title="Download changes to controller" border="0" />
</a></td>*/

//$connect = sqlite_open("C:/Documents and Settings/BKent/Desktop/ems.db"); 
//$connect = new PDO("sqlite:C:/Documents and Settings/Ben Kent/Desktop/ems.db");
include "functions.php";
$connect = new PDO("sqlite:/home/ems/web.db");

if (!(isset($pagenum))) 

{ 

$pagenum = 1; 

} 

$sql = "SELECT * FROM employee WHERE Enabled ='1' ORDER BY Surname"; 

$rows = 0;
foreach ($connect->query($sql) as $info) 
{ 
$EmployeeID=$info['EmployeeID'];
$rows ++;
}

//echo "Number of rows = $rows";

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
$sql_p = "SELECT * FROM employee WHERE Enabled ='1' ORDER BY Surname $max"; 

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
<a href="edit_person.php?action=<?php echo"$action"; ?>&EmployeeID=<?php echo"$EmployeeID"; ?>" onClick="javascript:return confirm('Are you sure you wish to move the card for <?php echo"$FirstNames $Surname"; ?> to the recycle bin?')"><?php echo"$CapAction"; ?></a></td>
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
</div>
</body>
</html>