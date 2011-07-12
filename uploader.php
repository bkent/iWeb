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

// Where the file is going to be placed $target_path = "/home/ems/";/* Add the original filename to our target path.  Result is "uploads/filename.extension" */$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {    echo "The file ".  basename( $_FILES['uploadedfile']['name']).     " has been uploaded";} else{    echo "There was an error uploading the file, please try again!";}
?>