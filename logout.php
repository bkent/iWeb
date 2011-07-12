<?php
 //Logout - update /etc/login file to 0
$login = "0";
$loginfile = "/etc/login";
$fh = fopen($loginfile, 'w') or die("can't open file");
fwrite($fh, $login);
fclose($fh);

echo "<meta http-equiv='refresh' content='0;URL=/index.html'>";

?>