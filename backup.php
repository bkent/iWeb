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

 
$file="/home/ems/web.db";

header("Pragma: public"); 
      header("Expires: 0"); 
      header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
      header("Cache-Control: private",false); 
      header("Content-Type: application/octet-stream"); 
      header("Content-Disposition: attachment; filename=web.db"); 
      header("Content-Transfer-Encoding:  binary"); 
      //header("Content-Length: ".$filesize); 
  readfile($file);

//echo "Backup Sucessful!";

//echo "<meta http-equiv='refresh' content='0;URL=settings.php'>"; 

?>