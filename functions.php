<?php
function test() 
{
echo "This is a test";
}

function hextocaps($length)
{
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
}

function checksum()
{
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
}
?>