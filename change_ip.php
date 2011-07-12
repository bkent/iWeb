<?php
//Check if user is legitimately logged in

$loginfile = "/etc/login";

$fh = fopen($loginfile, 'r') or die("can't open file");

$login = fread($fh, filesize($loginfile));

fclose($fh);

if ($login == 0) {
echo "<br /><br /><div align='center'>You are not logged on. Please click <a href='/index.html' target='_top'>here</a></div>";
exit;
//echo "<meta http-equiv='refresh' content='0;URL=/index.html'>";
//echo "<meta http-equiv='refresh' content='0;URL=javascript:open('/index.html')'>";
}

$ip=@$_GET['ip'];
$sub=@$_GET['sub'];
$gw=@$_GET['gw'];

if ($ip == "") {
echo "You must enter a valid IP address. Go back to the settings page";
exit;
}

if ($sub == "") {
echo "You must enter a valid subnet mask. Go back to the settings page";
exit;
}

if ($gw == "") {
echo "You must enter a valid gateway. Go back to the settings page";
exit;
}

$ipfile = "/etc/ip";
$fh = fopen($ipfile, 'w') or die("can't open file");
fwrite($fh, $ip);
fclose($fh);

$subfile = "/etc/sub";
$fh = fopen($subfile, 'w') or die("can't open file");
fwrite($fh, $sub);
fclose($fh);

$gwfile = "/etc/gw";
$fh = fopen($gwfile, 'w') or die("can't open file");
fwrite($fh, $gw);
fclose($fh);

$rc = "hostname CS1070
hwclock -s
mount -t proc proc /proc
mount -o remount,rw /dev/root /
mount /sys
ifconfig lo 127.0.0.1
ifconfig eth0 $ip netmask $sub
route add default gw $gw
#dhcpcd eth0 &
route add -net 127.0.0.0 netmask 255.255.255.0 lo
chmod +x /disk/home/httpd/cgi-bin/php
chmod +x /disk/home/httpd/cgi-bin/emsrestart.cgi
chmod +x /disk/home/httpd/cgi-bin/settime.cgi
chmod +x /disk/home/httpd/cgi-bin/url.cgi
chmod +x /disk/home/httpd/cgi-bin/ls.cgi
ln -s /disk/lib* /lib/
/disk/bin/ems &
cat /etc/motd";

$rcfile = "/etc/rc";
$fh = fopen($rcfile, 'w') or die("can't open file");
fwrite($fh, $rc);
fclose($fh);

echo "IP settings changed sucessfully. The I-Net ACU will now reboot....";

echo "<meta http-equiv='refresh' content='3;URL=../settime.cgi'>";
?>