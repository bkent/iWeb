<?php//Check if user is legitimately logged in$loginfile = "/etc/login";$fh = fopen($loginfile, 'r') or die("can't open file");$login = fread($fh, filesize($loginfile));fclose($fh);if ($login == 0) {echo "<br /><br /><div align='center'><font face='arial'>You are not logged on. Please click <a href='/index.html' target='_top'>here</a></font></div>";exit;}?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html> <head> <title>Controlsoft iWeb</title> <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> <link href="tab.css" rel="stylesheet" type="text/css" /></head> <body> <div id="contents"> 	<p><br /><br /></p><br /><table align='center' width="80%"><tr><td></td><td><a href="network.php"><img src="Images/network_32x32.png" border="0" /></a></td><td><a href="network.php">Network Settings</a></td><td></td><td><a href="backup.php" onClick="javascript:return confirm('Are you sure you wish to backup the database?')" ><img src="Images/downloads_folder_32x32.png" border="0" /></a></td><td><a href="backup.php" onClick="javascript:return confirm('Are you sure you wish to backup the database?')">Backup Database</a></td></tr><tr><td><br /></td><td></td><td></td><td></td><td></td><td></td></tr><tr><td></td><td><a href="password.php"><img src="Images/key_2_32x32.png" border="0" /></a></td><td><a href="password.php">Change Password</a></td><td></td><td><a href="date.php"><img src="Images/clock_32x32.png" border="0" /></a></td><td><a href="date.php">Date and Time</a></td></tr><tr><td><br /></td><td></td><td></td><td></td><td></td><td></td></tr><tr><td></td><td><a href="../ls.cgi"><img src="Images/gear_wheel_32x32.png" border="0" /></a></td><td><a href="../ls.cgi">Diagnostics</a></td><td></td><td></td><td></td></tr></table></div></body> </html> 