<?php

function assignPin()
{
	$table = "users";	
	$randNum = rand(100,999);
	$pin = $randNum;  // randomly pick a pin number
	$result = mysql_query("SELECT * FROM $table where pin = $pin"); // check if pin number is in use
	
	while (mysql_num_rows($result)!=0)
	{//count from the random number until a free pin number is found
		$pin++;
		$result = mysql_query("SELECT * FROM $table where pin = $pin ");
		if ($pin==999)
		{//loop around
			$pin = 0;
		}
		if ($pin == $randNum)
		{//if we've filled the table (doubtful) return an error
			return -1;
		}
	}

	return $pin;
}



?>