<?php
require('connectToServer.php');
connect();

session_start();

$table='users';

$setup="Update $table SET target = 0, targetted = 0 WHERE alive = 1";
mysql_query($setup);
$i = 0;
for ($team=1; $team<14; $team++)
{
	echo ("<h1>Team: $team</h1>");
	$sql1 = "SELECT * FROM $table WHERE pin > 100 AND targetted = 0 AND alive = 1 AND team = $team ORDER BY RAND()";

	$randomUser = mysql_query($sql1);
	if (mysql_num_rows($randomUser) !=0)
	{
		$randomUserPin = mysql_result($randomUser,0,"pin");	
		$firstPin = -1;
	
		while ($firstPin!=$randomUserPin)
		{
			$i++;
			if ($firstPin == -1)
			{
				$firstPin = $randomUserPin;
			}
			$currentPin = $randomUserPin;
			$sql1 = "SELECT * FROM $table WHERE pin > 100 AND pin !=$currentPin AND pin != $firstPin AND targetted = 0 AND alive = 1 AND team = $team ORDER BY RAND() LIMIT 1";
			$randomUser = mysql_query($sql1);
	
			if (mysql_num_rows($randomUser) == 0)
				$randomUserPin = $firstPin;
			else
				$randomUserPin = mysql_result($randomUser,0,"pin");	
		
			$sql2 = "UPDATE $table SET target = $randomUserPin WHERE pin = $currentPin";
			$sql3 = "UPDATE $table SET targetted = 1 WHERE pin = $randomUserPin";
			mysql_query($sql2);
			mysql_query($sql3);
			$sql = mysql_query("SELECT * FROM $table WHERE pin > 100 AND alive = 1 AND targetted = 0");
			echo("$i<br />$sql1<br />$sql2<br />$sql3<br />");
			
		}
	}
}
$sql2 = "SELECT SUM(alive) FROM $table WHERE pin > 100";
$sql2 = mysql_query($sql2);
$numAlive = mysql_result($sql2,0,"SUM(alive)");
echo("Alive: ".$numAlive);
echo("<br />Properly given targets: ".$i);

?>