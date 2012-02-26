<?php

sleep(5);
    
	$results = $_POST['username']." is from ".$_POST['country'];
	$button = "<form action='dashboard.html'><input type='submit' value='Back' /></form>";

	if (!isset($_POST['ajax'])) 
	{
		echo "Your Browser has Javascript disabled.";
	}
echo "Here is my post --";
echo "$results <br/> $button";
?>