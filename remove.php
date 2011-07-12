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

$connect = new PDO("sqlite:/home/ems/log.db");
$webconnect = new PDO("sqlite:/home/ems/web.db");
//$emsconnect = new PDO("sqlite:/home/ems/ems.db");

$sql = "DELETE FROM systemlog";

$connect->exec($sql);
$webconnect->exec($sql);
//$emsconnect->exec($sql);


echo "<meta http-equiv='refresh' content='0;URL=../emsrestart.cgi'>";
?>