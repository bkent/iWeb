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

$connect = new PDO("sqlite:/home/ems/ems.db");

$sql = "DELETE FROM systemlog";

$connect->exec($sql);

//$source_file = '/home/ems/web.db';
//$dest_file = '/home/ems/ems.db';
//copy($source_file,$dest_file);
//chmod ($dest_file, 0777);

//echo "Data download to device sucessful!";echo "<meta http-equiv='refresh' content='0;URL=../settime.cgi'>";
?>