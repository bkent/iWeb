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
<script src="ao.js" type="text/javascript"></script>
<script src="personadd.js" type="text/javascript"></script>
<link href="tab.css" rel="stylesheet" type="text/css" />
</head> 
<body> 
<div id="waiting" style="display: none;" align="center">
                <br /><br />Loading...<br />
                <img src="images/ajax-loader.gif" title="Loader" alt="Loader" />
            </div>
<div id="contents">
<?php
$i=1;
$connect = new PDO("sqlite:/home/ems/web.db");

$sql = "SELECT * FROM systemscanners";
  
echo "<table border='0' align='center'><td><table border='0' align='center' bgcolor ='white'>
<form name='form' action='add_person.php' method='post'>
<tr><td colspan='2' align='center'><b>Add New Person</b></td></tr>
<tr><td>First Name: </td><td><input type='text' name='fname' id='fname' /></td></tr>
<tr><td>Surname: </td><td><input type='text' name='surname' id='surname' /></td></tr>
<tr><td>ID Card: </td><td><input type='text' name='tagid' id='tagid' /></td></tr>
<tr><td colspan='2' align='center'>Allow access at:</td></tr>";
foreach ($connect->query($sql) as $info)
{
$ScannerID=$info['ScannerID'];
$Name=$info['Name'];
$inputname = 'check' . $i;
echo "<tr><td colspan='2' align='center'><input type='checkbox' name='$inputname' id='$inputname' value='$ScannerID' /> &nbsp; $Name</td></tr>";
$i++;
}
echo "<input type='hidden' name='number' id='number' value='$i' />
<tr><td>&nbsp;</td><td></td></tr><tr align='center'><td>&nbsp;</td><td><table border='0' align='center' bgcolor='white'><tr><td><input type='submit' name='Submit' value='  OK   ' /></form></td>

<form action='person.php' name='form1' method='get'><td><input type='submit' value='Cancel'></form></td></tr></td></table></tr>

</table></td></table>";

?>
</div>
</body>
</html>