<?php
 if (!$_POST['id'] || !$_POST['pass'])
 	{
 	die("<meta http-equiv='refresh' content='0;URL=/index.html'>");
 	}
 
 $username=$_POST['id'];
 $password=$_POST['pass'];
 
$userfile = "/etc/user";

$fh = fopen($userfile, 'r') or die("can't open file");

$user = fread($fh, filesize($userfile));

fclose($fh);

$passfile = "/etc/pass";

$fh = fopen($passfile, 'r') or die("can't open file");

$pass = fread($fh, filesize($passfile));

fclose($fh);

 if ( $username==$user && $password==$pass )
 	{

//Login sucessful - update /etc/login file
$login = "1";
$loginfile = "/etc/login";
$fh = fopen($loginfile, 'w') or die("can't open file");
fwrite($fh, $login);
fclose($fh);
 	// Redirect to member page
 	//Header("Location: /$rand.html");
$useragent=strtolower($_SERVER['HTTP_USER_AGENT']);
//if($useragent == 'blackberry'){
//header('Location: logout.php');

//$pos = strpos($useragent,'/android|avantgo|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i');

$mobile_browser = array('android','avantgo','blackberry','blazer','compal','elaine','fennec','hiptop','iemobile','iphone','ipod','iris','kindle','lge ','maemo','midp','mmp','opera mobi','opera mini','palm os?','phone','pixi','pre','plucker','pocket','psp','symbian','treo','vodafone','wap','windows ce','windows phone','xda','xiino/i');

$i=0;

foreach($mobile_browser as $val) {
    $pos = strpos($useragent, $val);
	if($pos === false) {
 // string needle NOT found in haystack
	}
	else {
	$i++;
	}
}

//$pos = strpos($useragent,'blackberry');

if ($i == 0) {
//if($pos === false) {
 // string needle NOT found in haystack
 echo "<meta http-equiv='refresh' content='0;URL=/home.html'>";
 //echo $useragent;
}
else {
 echo "<meta http-equiv='REFRESH' content='0;url=/cgi-bin/php/mobile.php'>";
 //echo $useragent;
 }
	
 	}
 else
 	{
 	// Login not successful
 	echo "<meta http-equiv='refresh' content='0;URL=/index.html'>";
 	}
	
	
?>