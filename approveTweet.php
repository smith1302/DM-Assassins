<?php 
include_once("connectToServer.php");
connect();


$pin = htmlspecialchars($_POST['pin']);

$sql0 = "INSERT tweets SET method = (SELECT method FROM tweetTest WHERE pin = $pin)";
mysql_query($sql0);

echo $sql0 . "\n";
echo mysql_error();

$sql1 = "DELETE FROM tweetTest WHERE pin = $pin";
mysql_query($sql1);

echo $sql1 . "\n";
echo mysql_error();
	
?>