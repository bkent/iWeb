<?php
$source_file = '/home/ems/ems.db';
$dest_file = '/home/ems/log.db';
copy($source_file,$dest_file);
chmod ($dest_file, 0777);
echo "<meta http-equiv='refresh' content='0;URL=access.php'>";
?>