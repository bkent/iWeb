<?php

sleep(5);
    
	$firstname = $_POST['firstname'];
	$surname = $_POST['surname'];
	$tagid = $_POST['tagid'];
	$button = "<form action='people.php'><input type='submit' value='Back' /></form>";

	if (!isset($_POST['ajax'])) 
	{
		echo "Your Browser has Javascript disabled.";
	}
echo "Firstnames = $firstname <br/>
Surname = $surname <br/>
TagID = $tagid <br/>
$button";
?>