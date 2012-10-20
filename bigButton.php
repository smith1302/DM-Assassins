<?php

require_once("connectToServer.php");
connect();

$pin = $_POST['pin'];

$sql0 = mysql_query("Select * from users where pin = $pin");
echo mysql_result($sql0,0,'name');

$sql1 = mysql_query("Select assassin.pin, assassin.team, target.team, target.name from users target join users as assassin on assassin.target = target.pin where assassin.pin=target.pin ORDER BY rand() limit 1");
$sql1 = mysql_result($sql1,0);
print_r($sql1);
echo mysql_error();


?>