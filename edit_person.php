<?php
<?php
$checked1="";
$checked2="";
$action = $_GET['action'];
$TagID = $_GET['TagID'];
switch ($action)
{
case 'edit':
$i=1;
$connect = new PDO("sqlite:/home/ems/web.db");

$sql = "SELECT * FROM employee WHERE EmployeeID=$EmployeeID";

$sqlr = "SELECT * FROM systemscanners";

//This is where you display your query results

foreach ($connect->query($sql) as $info) 
{ 
$FirstNames=$info['FirstNames'];
$Surname=$info['Surname'];
$EmployeeID=$info['EmployeeID'];
$TagID=$info['TagID'];
$AccompaniedType=$info['AccompaniedType'];
$AccompaniedID=$info['AccompaniedID'];
echo "<table border='0' align='center'><td><table border='0' align='center' bgcolor='white'>
foreach ($connect->query($sqlr) as $info) 
{
$ScannerID=$info['ScannerID'];
$Name=$info['Name'];
${r.$i}=$Name;
$i++;
}

//if ($AccompaniedType==1 && $r1!="" )
{
$checked1="checked";
}
//if ($AccompaniedID==1 && $r2!="" )
{
$checked2="checked";
}
break;
case 'disable':
$connect = new PDO("sqlite:/home/ems/web.db");
//$sql = "DELETE FROM employee WHERE EmployeeID=$EmployeeID";
$connect->exec($sql);
echo "<meta http-equiv='refresh' content='0;URL=person.php'>"; 
//echo $message2;
break;
case 'add':
}
?>
</font>