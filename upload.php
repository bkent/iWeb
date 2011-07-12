<?php//Check if user is legitimately logged in$loginfile = "/etc/login";$fh = fopen($loginfile, 'r') or die("can't open file");$login = fread($fh, filesize($loginfile));fclose($fh);if ($login == 0) {echo "<br /><br /><div align='center'>You are not logged on. Please click <a href='/index.html' target='_top'>here</a></div>";exit;}
$source_file = '/home/ems/ems.db';
$dest_file = '/home/ems/log.db';
copy($source_file,$dest_file);
chmod ($dest_file, 0777);
echo "<meta http-equiv='refresh' content='0;URL=access.php'>";
?>