<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>People</title>
	<script src="ao.js" type="text/javascript"></script>
	<script src="hijaxpeople.js" type="text/javascript"></script>
	<style type="text/css">
	body { font: normal 12px Georgia; }
	label { padding-right: 10px; }
	</style>
</head>

<body>

<div id="waiting" style="display: none;">
                Loading...<br />
                <img src="images/ajax-loader.gif" title="Loader" alt="Loader" />
            </div>
			
<div id="output">
<table border="0">
<form action="cgi-bin/php/postpeople.php" method="post">
<tr><td>First Names: </td><td><input type="text" name="firstname" id="firstname" /></td></tr>
<tr><td>Surname: </td><td><input type="text" name="surname" id="surname" /></td></tr>
<tr><td>TagID: </td><td><input type="text" name="tagid" id="tagid" /></td></tr>
<tr><td></td><td><input type="submit" /></td></tr>
</table>		
</form>
</div>

</body>
</html>