<html>
<?php
$ScannerID = $_GET['scannerid'];

switch ($action)
{
case 'edit':
$connect = new PDO("sqlite:/home/ems/web.db");

$sql = "SELECT * FROM systemscanners WHERE ScannerID=$ScannerID";

foreach ($connect->query($sql) as $info) 
{
$ScannerID=$info['ScannerID'];
$Name=$info['Name'];
$controlsDoor=$info['DoorID'];
}
echo "<table border='1' align='center'><td><table border='0' align='center' bgcolor='white'>
<form name='form' action='update_reader.php' method='get'>
<tr><td>Name:<input type='hidden' name='doorid' value='$controlsDoor'/></td><td><input type='text' name='name' value='$Name'/></td></tr>


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