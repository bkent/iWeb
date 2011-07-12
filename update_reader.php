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

$ScannerID = @$_GET['scanid'];
$Name = @$_GET['name'];
$DoorID = @$_GET['doorid'];

if ($Name == "")
	{
	echo "<br /><br /><div align='center'>
	You must enter a name for your reader.<br />
	Press the back button in your browser and enter a name on the previous page.";
	}
else
	{
	$connect = new PDO("sqlite:/home/ems/web.db");
	//$connect = iConnect();
	$sql = "UPDATE systemscanners SET DoorID='$DoorID', Name='$Name' WHERE ScannerID='$ScannerID'";
	$connect->exec($sql);
	echo "<meta http-equiv='refresh' content='0;URL=reader.php'>";
	}
?>