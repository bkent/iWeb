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

$cururl=@$_GET['cururl'];
$newurl=@$_GET['newurl'];

$urlfile = "/etc/rand";
$fh = fopen($urlfile, 'w') or die("can't open file");
fwrite($fh, $newurl);
fclose($fh);

echo "<meta http-equiv='refresh' content='0;URL=../url.cgi?cururl=$cururl&newurl=$newurl'>";
?>