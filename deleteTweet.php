<?php 
include_once("connectToServer.php");
connect();


$pin = htmlspecialchars($_POST['pin']);
$table = htmlspecialchars($_POST['table']);

$sql0 = "INSERT deleted SELECT * FROM $table WHERE pin = $pin";
mysql_query($sql0);

echo $sql0 . "\n";
echo mysql_error();

$sql1 = "DELETE FROM $table WHERE pin = $pin";
mysql_query($sql1);

echo $sql1 . "\n";
echo mysql_error();
	
?>