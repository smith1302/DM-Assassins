<?php

session_start();
?>

<?php
include_once("connectToServer.php");
connect();

	$way = mysql_real_escape_string($_POST['way']);
	if (strlen($way) < 131)
	{
    	$sql1 = "INSERT INTO tweetTest SET method = '$way', used =0";
		mysql_query($sql1);	
		
		$randNum = rand(0,15);
		switch ($randNum) {
			case	0	: $name = "Alex Spratt"; break;
			case	1	: $name = "Patrick Spook"; break;
			case	2	: $name = "Meredith Chipman"; break;
			case	3	: $name = "Eden Joyner"; break;
			case	4	: $name = "Jorge Sanchez"; break;
			case	5	: $name = "Mackenzie Pape"; break;
			case	6	: $name = "Blake Oliver"; break;
			case	7	: $name = "Steve McLaughlin"; break;
			case	8	: $name = "Christina Stine"; break;
			case	9	: $name = "Natalie Hyman"; break;
			case	10	: $name = "Garrett Chappell"; break;
			case	11	: $name = "Sam Capone"; break;
			case	12	: $name = "Madison Hager"; break;
			case	13	: $name = "Octavio Casanova"; break;
			case	14	: $name = "Steven Giordano"; break;						
			case	15	: $name = "Matt Gerstman"; break;						
		}
		$fun = str_replace("THEIRNAME",$name, $way);
		
		
			$subject = 'Death Submission';
			$message = $fun;
			$email = "imatt711@me.com";
			$headers = 'From: assassins@floridadm.com' . "\r\n" .
			    'X-Mailer: PHP/' . phpversion();

		//	mail($email, $subject, $message, $headers);

		$_SESSION['nope']="Submission Successful! Once your submission has been approved, we'll add it to the database.<br />";
		
	}
	else
	{
		$_SESSION['nope']="Please make all submissions under 130 characters. Thank you.<br />";
	}

?>


<SCRIPT LANGUAGE="JavaScript">

redirURL = "waysYouCanDie.php";
self.location.href = redirURL;

</script>


</body>
</html>