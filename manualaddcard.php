<html>
<head>
</head>
<body>
<?php
//Don't timeout
set_time_limit(0);

//Socket connection info
$host="10.0.1.230";
$port = 5556;

// open a client connection
$fp = fsockopen ($host, $port, $errno, $errstr);
if (!$fp)
{
$result = "Error: could not open socket connection";
}
echo "Logon Command Sent<br />";
$message = ">1D003003000001000107D0119435";
$message .= chr(13);
// write the string contained in $message to the socket
fputs ($fp, $message);
sleep(1);
// get the result
//$result = fgets ($fp, 64);
//echo "The controller says: $result <br /><br />";

echo "Keepalive message sent<br />";
$message1 = ">0B00300748";
$message1 .= chr(13);
fputs ($fp, $message1);
sleep(1);
//$result1 = fgets ($fp, 64);
//echo "The controller says: $result1 <br /><br />";


echo "Sending card data<br />";
$message2 = ">2E00300D16714711";
$message2 .= chr(0);
$message2 .= "000300000000010000000000003E";
$message2 .= chr(13);
fputs ($fp, $message2);
sleep(1);
//$result2 = fgets ($fp, 64);
//echo "The controller says: $result2";

// close the connection
fclose ($fp);
?>
</body>
</html>