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

$connect = new PDO("sqlite:/home/ems/web.db");
$logconnect = new PDO("sqlite:/home/ems/log.db");

$sql = "SELECT * FROM systemscanners";

foreach ($connect->query($sql) as $info) 
{ 
$ScannerID=$info['ScannerID'];

$Name=$info['Name'];

${d.$ScannerID}=($Name);
}

$sqlp = "SELECT * FROM employee";

foreach ($connect->query($sqlp) as $info)

{

$FirstNames=$info['FirstNames'];

$Surname=$info['Surname'];

$TagID=$info['TagID'];

${p.$TagID}=($FirstNames.' '.$Surname);

}



$sql = "SELECT STRFTIME('%d/%m/%Y %H:%M:%S',DateTimeEx), Data, Time, EventCode, LogID FROM systemlog ORDER BY LogID DESC"; 


ob_start();

echo "DateTime,Name,Location,Result,TagID\n";

foreach ($logconnect->query($sql) as $info) 

{ 

$DateTimeEx=$info["STRFTIME('%d/%m/%Y %H:%M:%S',DateTimeEx)"];

$Data=$info['Data'];

$Time=$info['Time'];//realtes to Scanner ID (Location)

$EventCode=$info['EventCode'];


if ($EventCode ==265)

{

echo "$DateTimeEx,";

$access='Access Allowed';

?><?php echo ${p.$Data}; ?><?php

echo ",";

?><?php echo ${d.$Time}; ?><?php 

echo ",";

echo "$access,";

echo "$Data\n";

}

else if ($EventCode ==514)

{

echo "$DateTimeEx,";

$access='Access Denied';

?><?php echo ${p.$Data}; ?><?php

echo ",";?><?php echo ${d.$Time}; ?><?php 

echo ",";

echo "$access,";

echo "$Data\n";

}

else if ($EventCode ==273)

{

echo "$DateTimeEx,";

$access='Push Button Pressed';

echo "N/A,";

?><?php echo ${d.$Time}; ?><?php

echo ",";

echo "$access,";

echo "N/A\n";

}

else if ($EventCode ==1042)

{
}

else if ($EventCode ==1037)

{
}

else

{
echo "$DateTimeEx";

$access='Undefined Event';

?><?php echo ${p.$Data}; ?><?php

echo ",";

echo "$Time,";

echo "$access,";

echo "$Data\n";

} 

}

$output = ob_get_clean();

$date=date('dmY');

$accessfile = "/etc/access.csv";
$fh = fopen($accessfile, 'w') or die("can't open file");
fwrite($fh, $output);
fclose($fh);

header("Pragma: public"); 
      header("Expires: 0"); 
      header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
      header("Cache-Control: private",false); 
      header("Content-Type: application/octet-stream"); 
      header("Content-Disposition: attachment; filename=access$date.csv"); 
      header("Content-Transfer-Encoding:  binary"); 
      //header("Content-Length: ".$filesize); 
  readfile($accessfile);
  
$accessfile = "/etc/access.csv";
$fh = fopen($accessfile, 'w') or die("can't open file");
fwrite($fh, '');
fclose($fh);

//$output = $_GET['output'];
//$date = date('dmY');

//echo "$output";

//$file = "/etc/acclog";
//$fh = fopen($file, 'w') or die("can't open file");
//fwrite($fh, $output);
//fclose($fh);

//header("Pragma: public"); 
//      header("Expires: 0"); 
//      header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
//      header("Cache-Control: private",false); 
//      header ( "Content-Type: text/html" ); 
//      header("Content-Disposition: attachment; filename=acclogs$date.html"); 
//      header("Content-Transfer-Encoding:  binary"); 
//      header("Content-Length: ".$filesize); 
//  readfile($file);

//fwrite($fh, 'No data');
//fclose($fh);
?>