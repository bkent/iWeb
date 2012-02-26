<?php
 //Logout - update /etc/login file to 0
$login = "0";
$loginfile = "/etc/login";
$fh = fopen($loginfile, 'w') or die("can't open file");
fwrite($fh, $login);
fclose($fh);

echo "<br /><br /><div align='center'><font face='arial'><b>Logged out sucessfully</b><br /><br />You can safely close your browser window or tab. <br /> Alternatively, click <a href='/index.html' target='_top'>here</a> to log back in.</font></div>";

?>