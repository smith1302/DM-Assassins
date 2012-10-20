<?php

include_once('connectToServer.php');
connect();

$sql0 = "Select * From users where pin > 100 and target!=0";
$sql0 = mysql_query($sql0);
$firstPin = mysql_result($sql0, 0, 'pin');
$currentPin = 0;
echo $firstPin.'<br />';
$i=0;
while ($currentPin != $firstPin)
{
	if ($currentPin==0)
	{
		$currentPin = $firstPin;
	}
	
	$sql1 = "Select * From users WHERE target = $currentPin";
	$sql1 = mysql_query($sql1);
	$nextPin = mysql_result($sql1, 0, 'pin');	
	$i++;
	$sql2 = "$i) Update users Set target = $nextPin WHERE pin = $currentPin";
	echo($sql2.'<br />');
	$currentPin = $nextPin;
}



?>