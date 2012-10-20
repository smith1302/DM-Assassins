<?php
	include_once("connectToServer.php");
	connect();
	include_once("assignPin.php");
	
	echo exec('pwd');
	$command = "/home/mattgerstman/Python-2.7.3/python /home/mattgerstman/mattgerstman.com/assassins/users.py /home/mattgerstman/mattgerstman.com/assassins/namesList.txt";
	echo '<br />'.$command.'<br /><br />';
	$json = exec($command, $output);
	echo $json;
	$names = json_decode($json, true);
#	$file = "output.json";
#	$names = json_decode(file_get_contents($file), true);
	echo "<pre>";
	print_r($names);
	
	foreach ($names as $list => $user)
	{
		
		$name = mysql_escape_string($user['name']);
		$username = mysql_escape_string($user['username']);
		$email = mysql_escape_string($user['email']);
		$team = mysql_escape_string($user['team']);
		$pin = assignPin();		
		$sql0 = "INSERT INTO users SET name = '$name', username = $username, email='$email', pin=$pin, team=$team";
		mysql_query($sql0);
		echo mysql_error();
	}	
	
?>