<?php

//Check if user is legitimately logged in

$loginfile = "/etc/login";

$fh = fopen($loginfile, 'r') or die("can't open file");

$login = fread($fh, filesize($loginfile));

fclose($fh);

if ($login == 0) {
echo "<br /><br /><div align='center'><font face='arial'>You are not logged on. Please click <a href='/index.html' target='_top'>here</a></font></div>";
exit;
}

$fname = @$_POST['fname'];
$surname = @$_POST['surname'];
$tagid = @$_POST['tagid'];
$EmployeeID = @$_POST['empid'];
$AccompaniedType = @$_POST['check1'];
$AccompaniedID = @$_POST['check2'];
$scan1perm = $AccompaniedType;
$scan2perm = $AccompaniedID;

if ($scan1perm == "") {
$scan1perm = "0";
}

if ($scan2perm == "") {
$scan2perm = "0";
}

if ($surname == "")
	{
	echo "<br /><br /><div align='center'>
	You must enter a surname.<br />
	Press the back button in your browser and enter a surname on the previous page.";
	}
else
	{
	$connect = new PDO("sqlite:/home/ems/web.db");
	//$connect = iConnect();
	$sql = "UPDATE employee SET FirstNames='$fname', Surname='$surname', TagID='$tagid', AccompaniedType='$AccompaniedType', AccompaniedID='$AccompaniedID', Enabled='1' WHERE EmployeeID='$EmployeeID'";
	$connect->exec($sql);
	 
	//echo "Success";
	
	//*******************New code to update the person to the reader without having to stop and start ems.****************
	
$part3 = $tagid;
//The first part of the message 0030 session, 0F update tag (15)
$message = '00300F';
$part2 = $message;
//Add the card string
$message .= $tagid;
//Add the rest of the message
//$part4 = '00030000000001000000000000';
//$message .= '00030000000001000000000000';


$part4 = '03000' . $scan1perm;
$message .= $part4;

//Determine the total length of the message, + the >, hex byte length, ASCII null character and hex byte checksum
$length = (strlen($message))+6;
//Convert the value to hex
$length = dechex ( $length );
//Convert lowercase hex letters to uppercase so the XOR checksum calculations are correct.
//First inialise $caps_length variable
$caps_length = '';
for ($i = 0, $j = strlen($length); $i < $j; $i++) {
    if ('0' == $length[$i]) {$caps_length .='0';}
	elseif ('1' == $length[$i]) {$caps_length .='1';}
	elseif ('2' == $length[$i]) {$caps_length .='2';}
	elseif ('3' == $length[$i]) {$caps_length .='3';}
	elseif ('4' == $length[$i]) {$caps_length .='4';}
	elseif ('5' == $length[$i]) {$caps_length .='5';}
	elseif ('6' == $length[$i]) {$caps_length .='6';}
	elseif ('7' == $length[$i]) {$caps_length .='7';}
	elseif ('8' == $length[$i]) {$caps_length .='8';}
	elseif ('9' == $length[$i]) {$caps_length .='9';}
	elseif ('a' == $length[$i]) {$caps_length .='A';}
	elseif ('b' == $length[$i]) {$caps_length .='B';}
	elseif ('c' == $length[$i]) {$caps_length .='C';}
	elseif ('d' == $length[$i]) {$caps_length .='D';}
	elseif ('e' == $length[$i]) {$caps_length .='E';}
	elseif ('f' == $length[$i]) {$caps_length .='F';}
}
//Assemble the string to be sent (note the ASCII null character will not affect the checksum calculation so is not included here)
$string = '>';
$string .= $caps_length;
$part1 = $string;
$string .= $message;
//Calculate the checksum
$x = 0;
$conversion = '';
for ($i = 0, $j = strlen($string); $i < $j; $i++) {
    if ('0' == $string[$i]) {$conversion .='48^';}
	elseif ('1' == $string[$i]) {$conversion .='49^';}
	elseif ('2' == $string[$i]) {$conversion .='50^';}
	elseif ('3' == $string[$i]) {$conversion .='51^';}
	elseif ('4' == $string[$i]) {$conversion .='52^';}
	elseif ('5' == $string[$i]) {$conversion .='53^';}
	elseif ('6' == $string[$i]) {$conversion .='54^';}
	elseif ('7' == $string[$i]) {$conversion .='55^';}
	elseif ('8' == $string[$i]) {$conversion .='56^';}
	elseif ('9' == $string[$i]) {$conversion .='57^';}
	elseif ('>' == $string[$i]) {$conversion .='62^';}
	elseif ('A' == $string[$i]) {$conversion .='65^';}
	elseif ('B' == $string[$i]) {$conversion .='66^';}
	elseif ('C' == $string[$i]) {$conversion .='67^';}
	elseif ('D' == $string[$i]) {$conversion .='68^';}
	elseif ('E' == $string[$i]) {$conversion .='69^';}
	elseif ('F' == $string[$i]) {$conversion .='70^';}
}
//Add on an extra 0. Makes no difference to the final value, but in necessary so as not to end the expression with ^.
$conversion .='0';
eval("\$checksum = " . $conversion . ";");
$checksum = dechex ( $checksum );
//Convert lowercase hex letters to uppercase
$final_checksum = '';
for ($i = 0, $j = strlen($checksum); $i < $j; $i++) {
    if ('0' == $checksum[$i]) {$final_checksum .='0';}
	elseif ('1' == $checksum[$i]) {$final_checksum .='1';}
	elseif ('2' == $checksum[$i]) {$final_checksum .='2';}
	elseif ('3' == $checksum[$i]) {$final_checksum .='3';}
	elseif ('4' == $checksum[$i]) {$final_checksum .='4';}
	elseif ('5' == $checksum[$i]) {$final_checksum .='5';}
	elseif ('6' == $checksum[$i]) {$final_checksum .='6';}
	elseif ('7' == $checksum[$i]) {$final_checksum .='7';}
	elseif ('8' == $checksum[$i]) {$final_checksum .='8';}
	elseif ('9' == $checksum[$i]) {$final_checksum .='9';}
	elseif ('a' == $checksum[$i]) {$final_checksum .='A';}
	elseif ('b' == $checksum[$i]) {$final_checksum .='B';}
	elseif ('c' == $checksum[$i]) {$final_checksum .='C';}
	elseif ('d' == $checksum[$i]) {$final_checksum .='D';}
	elseif ('e' == $checksum[$i]) {$final_checksum .='E';}
	elseif ('f' == $checksum[$i]) {$final_checksum .='F';}
}
//If the checksum is only one character, then make it 2. Eg. make 8 into 08 or A into 0A
if (strlen($final_checksum)==1) {
$new_final_checksum = '0';
$new_final_checksum .= $final_checksum;
$new_final_checksum = $final_checksum;
}
//The final string to be sent to the controller must now be assembled and sent:
$string .=$final_checksum;
$part5 = $final_checksum;
$final_string = $part1 . $part2 . $part3 . chr(0) . $part4 . $part5 . chr(13);

//Don't timeout
set_time_limit(0);

//Socket connection info
$host="10.0.1.230";  // ****REMEMBER read the IP file in case the host IP is not default
$port = 5556;

// open a client connection
$fp = fsockopen ($host, $port, $errno, $errstr);
if (!$fp)
{
$result = "Error: could not open socket connection";
}
//Logon message
$message = ">1D003003000001000107D0119435";
$message .= chr(13);
// write the string contained in $message to the socket
fputs ($fp, $message);
sleep(1);
// get the result
//$result = fgets ($fp, 64);
//echo "The controller says: $result <br /><br />";
//Keepalive message
$message1 = ">0B00300748";
$message1 .= chr(13);
fputs ($fp, $message1);
sleep(1);
//$result1 = fgets ($fp, 64);
//echo "The controller says: $result1 <br /><br />";


//Send updated card data
$message2 = $final_string;
fputs ($fp, $message2);
sleep(1);
//$result2 = fgets ($fp, 64);
//echo "The controller says: $result2";

// close the connection
fclose ($fp);

//Reader 2

$part3 = $tagid;
//The first part of the message 0030 session, 0F update tag (15)
$message = '00300F';
$part2 = $message;
//Add the card string
$message .= $tagid;
//Add the rest of the message
//$part4 = '00030000000001000000000000';
//$message .= '00030000000001000000000000';


$part4 = '04000' . $scan2perm;
$message .= $part4;

//Determine the total length of the message, + the >, hex byte length, ASCII null character and hex byte checksum
$length = (strlen($message))+6;
//Convert the value to hex
$length = dechex ( $length );
//Convert lowercase hex letters to uppercase so the XOR checksum calculations are correct.
//First inialise $caps_length variable
$caps_length = '';
for ($i = 0, $j = strlen($length); $i < $j; $i++) {
    if ('0' == $length[$i]) {$caps_length .='0';}
	elseif ('1' == $length[$i]) {$caps_length .='1';}
	elseif ('2' == $length[$i]) {$caps_length .='2';}
	elseif ('3' == $length[$i]) {$caps_length .='3';}
	elseif ('4' == $length[$i]) {$caps_length .='4';}
	elseif ('5' == $length[$i]) {$caps_length .='5';}
	elseif ('6' == $length[$i]) {$caps_length .='6';}
	elseif ('7' == $length[$i]) {$caps_length .='7';}
	elseif ('8' == $length[$i]) {$caps_length .='8';}
	elseif ('9' == $length[$i]) {$caps_length .='9';}
	elseif ('a' == $length[$i]) {$caps_length .='A';}
	elseif ('b' == $length[$i]) {$caps_length .='B';}
	elseif ('c' == $length[$i]) {$caps_length .='C';}
	elseif ('d' == $length[$i]) {$caps_length .='D';}
	elseif ('e' == $length[$i]) {$caps_length .='E';}
	elseif ('f' == $length[$i]) {$caps_length .='F';}
}
//Assemble the string to be sent (note the ASCII null character will not affect the checksum calculation so is not included here)
$string = '>';
$string .= $caps_length;
$part1 = $string;
$string .= $message;
//Calculate the checksum
$x = 0;
$conversion = '';
for ($i = 0, $j = strlen($string); $i < $j; $i++) {
    if ('0' == $string[$i]) {$conversion .='48^';}
	elseif ('1' == $string[$i]) {$conversion .='49^';}
	elseif ('2' == $string[$i]) {$conversion .='50^';}
	elseif ('3' == $string[$i]) {$conversion .='51^';}
	elseif ('4' == $string[$i]) {$conversion .='52^';}
	elseif ('5' == $string[$i]) {$conversion .='53^';}
	elseif ('6' == $string[$i]) {$conversion .='54^';}
	elseif ('7' == $string[$i]) {$conversion .='55^';}
	elseif ('8' == $string[$i]) {$conversion .='56^';}
	elseif ('9' == $string[$i]) {$conversion .='57^';}
	elseif ('>' == $string[$i]) {$conversion .='62^';}
	elseif ('A' == $string[$i]) {$conversion .='65^';}
	elseif ('B' == $string[$i]) {$conversion .='66^';}
	elseif ('C' == $string[$i]) {$conversion .='67^';}
	elseif ('D' == $string[$i]) {$conversion .='68^';}
	elseif ('E' == $string[$i]) {$conversion .='69^';}
	elseif ('F' == $string[$i]) {$conversion .='70^';}
}
//Add on an extra 0. Makes no difference to the final value, but in necessary so as not to end the expression with ^.
$conversion .='0';
eval("\$checksum = " . $conversion . ";");
$checksum = dechex ( $checksum );
//Convert lowercase hex letters to uppercase
$final_checksum = '';
for ($i = 0, $j = strlen($checksum); $i < $j; $i++) {
    if ('0' == $checksum[$i]) {$final_checksum .='0';}
	elseif ('1' == $checksum[$i]) {$final_checksum .='1';}
	elseif ('2' == $checksum[$i]) {$final_checksum .='2';}
	elseif ('3' == $checksum[$i]) {$final_checksum .='3';}
	elseif ('4' == $checksum[$i]) {$final_checksum .='4';}
	elseif ('5' == $checksum[$i]) {$final_checksum .='5';}
	elseif ('6' == $checksum[$i]) {$final_checksum .='6';}
	elseif ('7' == $checksum[$i]) {$final_checksum .='7';}
	elseif ('8' == $checksum[$i]) {$final_checksum .='8';}
	elseif ('9' == $checksum[$i]) {$final_checksum .='9';}
	elseif ('a' == $checksum[$i]) {$final_checksum .='A';}
	elseif ('b' == $checksum[$i]) {$final_checksum .='B';}
	elseif ('c' == $checksum[$i]) {$final_checksum .='C';}
	elseif ('d' == $checksum[$i]) {$final_checksum .='D';}
	elseif ('e' == $checksum[$i]) {$final_checksum .='E';}
	elseif ('f' == $checksum[$i]) {$final_checksum .='F';}
}
//If the checksum is only one character, then make it 2. Eg. make 8 into 08 or A into 0A
if (strlen($final_checksum)==1) {
$new_final_checksum = '0';
$new_final_checksum .= $final_checksum;
$new_final_checksum = $final_checksum;
}
//The final string to be sent to the controller must now be assembled and sent:
$string .=$final_checksum;
$part5 = $final_checksum;
$final_string = $part1 . $part2 . $part3 . chr(0) . $part4 . $part5 . chr(13);

//Don't timeout
set_time_limit(0);

//Socket connection info
$host="10.0.1.230";  // ****REMEMBER read the IP file in case the host IP is not default
$port = 5556;

// open a client connection
$fp = fsockopen ($host, $port, $errno, $errstr);
if (!$fp)
{
$result = "Error: could not open socket connection";
}
//Logon message
$message = ">1D003003000001000107D0119435";
$message .= chr(13);
// write the string contained in $message to the socket
fputs ($fp, $message);
sleep(1);
// get the result
//$result = fgets ($fp, 64);
//echo "The controller says: $result <br /><br />";
//Keepalive message
$message1 = ">0B00300748";
$message1 .= chr(13);
fputs ($fp, $message1);
sleep(1);
//$result1 = fgets ($fp, 64);
//echo "The controller says: $result1 <br /><br />";


//Send updated card data
$message2 = $final_string;
fputs ($fp, $message2);
sleep(1);
//$result2 = fgets ($fp, 64);
//echo "The controller says: $result2";

// close the connection
fclose ($fp);

echo "<meta http-equiv='refresh' content='0;URL=person.php'>";

//echo "$message2 <br />";
//echo "The controller says: $result2";
}
?>