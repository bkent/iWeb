<html><body background="/Images/bg.jpg" bgproperties="fixed" ><font face="arial">
<?php//Check if user is legitimately logged in$loginfile = "/etc/login";$fh = fopen($loginfile, 'r') or die("can't open file");$login = fread($fh, filesize($loginfile));fclose($fh);if ($login == 0) {echo "<br /><br /><div align='center'><font face='arial'>You are not logged on. Please click <a href='/index.html' target='_top'>here</a></font></div>";exit;//echo "<meta http-equiv='refresh' content='0;URL=/index.html'>";//echo "<meta http-equiv='refresh' content='0;URL=javascript:open('/index.html')'>";}$action = $_GET['action'];
$ScannerID = $_GET['scannerid'];

switch ($action)
{
case 'edit':
$connect = new PDO("sqlite:/home/ems/web.db");

$sql = "SELECT * FROM systemscanners WHERE ScannerID=$ScannerID";$sqld = "SELECT * FROM doors";

foreach ($connect->query($sql) as $info) 
{
$ScannerID=$info['ScannerID'];
$Name=$info['Name'];
$controlsDoor=$info['DoorID'];
}
echo "<table border='1' align='center'><td><table border='0' align='center' bgcolor='white'>
<form name='form' action='update_reader.php' method='get'><tr><td colspan='2' align='center'><b>Edit Reader</b></td></tr>
<tr><td>Name:<input type='hidden' name='doorid' value='$controlsDoor'/></td><td><input type='text' name='name' value='$Name'/></td></tr><tr><td colspan='2'>&nbsp;</td></tr><tr align='center'><td>&nbsp;<input type='hidden' name='scanid' value='$ScannerID'/></td><td><table border='0' align='center' bgcolor='white'><tr><td><input type='submit' name='Submit' value='  OK   ' /></form></td><form action='reader.php' method='get'><td><input type='submit' value='Cancel'></form></td></tr></td></table></tr></table></td></table>";


break;

case 'delete':

$connect = new PDO("sqlite:/home/ems/web.db");

$sql = "DELETE FROM employee WHERE EmployeeID=$EmployeeID";
$connect->exec($sql);
echo "<meta http-equiv='refresh' content='0;URL=reader.php'>";
break;

}
?>
</font></body>
</html>