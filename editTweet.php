<?php 
include_once("connectToServer.php");
connect();


$pin = mysql_escape_string($_POST['pin']);
$value = mysql_escape_string($_POST['value']);
$column = mysql_escape_string($_POST['column']);

$sql0 = "UPDATE $column SET method = '$value' WHERE pin = $pin";
mysql_query($sql0);
echo $sql0 . "\n";
echo mysql_error();
	
?>