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

$user=@$_GET['user'];
$oldpass=@$_GET['oldpass'];
$curpass=@$_GET['curpass'];
$pass1=@$_GET['pass1'];
$pass2=@$_GET['pass2'];

if ($user=="" || $pass1=="" || $pass2=="" || $curpass=="") {
echo "<br /><br /><div align='center'>You must enter values into all the username and password fields to update your login details.<br /><br />
<form action='password.php'><input type='submit' value='Back'></form></div>";
}

elseif ($oldpass != $curpass) {
echo "<br /><br /><div align='center'>Incorrect current password.<br /><br />
<form action='password.php'><input type='submit' value='Back'></form></div>";
}

elseif ($pass1 != $pass2) {
echo "<br /><br /><div align='center'>New passwords given do not match.<br /><br />
<form action='password.php'><input type='submit' value='Back'></form></div>";
}

else {

$userfile = "/etc/user";

$fh = fopen($userfile, 'w') or die("can't open file");

fwrite($fh, $user);

fclose($fh);

$passfile = "/etc/pass";

$fh = fopen($passfile, 'w') or die("can't open file");

fwrite($fh, $pass1);

fclose($fh);

echo "<br /><br /><div align='center'>Login details sucessfully updated.<br /><br />
<form action='settings.php'><input type='submit' value='Back'></form></div>";

}
?>