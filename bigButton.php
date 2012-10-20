<?php

require_once("connectToServer.php");
connect();

$pin = $_POST['pin'];

$sql0 = mysql_query("Select * from users where pin = $pin");
$myTeam = mysql_result($sql0,0,'team');
echo mysql_result($sql0,0,'name');

$sql1 = mysql_query("Select assassin.pin, assassin.team, target.pin, target.team from users target join users as assassin on assassin.target = target.pin where assassin.team=target.team AND assassin.team != $myTeam ORDER BY rand() limit 1");

if (mysql_num_rows($sql1) == 0)
{
	$sql1 = mysql_query("Select assassin.pin, assassin.team, target.pin, target.team from users target join users as assassin on assassin.target = target.pin ORDER BY rand() limit 1");
}
	$sql1 = mysql_fetch_row($sql1);
print_r($sql1);
echo mysql_error();


?>