<?php 
include_once("connectToServer.php");
connect();


$pin = htmlspecialchars($_POST['pin']);
$column = htmlspecialchars($_POST['column']);
$value = htmlspecialchars($_POST['value']);

$sql0 = "UPDATE users SET $column = '$value' WHERE pin = $pin";
mysql_query($sql0);
echo $sql0 . "\n";
echo mysql_error();
	
?>