<?php
while ($int<=$number) {
$reader = @$_GET[$int];
${r.$int}=$reader;
$int++;
}

if ($r1==1)
{
$AccompaniedType=1;
}

if ($r2==2)
{
$AccompaniedID=1;
}

if ($surname == "")
	{
	echo "<br /><br /><div align='center'>
	You must enter a surname.<br />
	Press the back button in your browser and enter a surname on the previous page.</div>";
	}
else
	{
	$connect = new PDO("sqlite:/home/ems/web.db");
	//$connect = iConnect();
	$sql = "INSERT INTO employee (FirstNames, Surname, TagID, TagRev, AccompaniedType, AccompaniedID, Enabled) VALUES ('$fname', '$surname', '$tagid', '3', '$AccompaniedType' ,'$AccompaniedID', '1')";
	$connect->exec($sql);
	echo "<meta http-equiv='refresh' content='0;URL=person.php'>"; 
	//echo "Success";
	//echo "$surname<br />$number <br /> 1=$r1 / 2=$r2 /3=$r3" /;
	}
?>