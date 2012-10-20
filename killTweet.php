<?

include("tweet.php");

function killTweet($pin)
{

$table = "users";
$fun = "blankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblankblank";
while (strlen($fun)>139)	
{	
	$result = mysql_query("SELECT * FROM $table where pin = $pin");
	$name = mysql_result($result,0,"name");
	$twitter = mysql_result($result,0,"twitter"); 
	
	
	$result = mysql_query("SELECT * FROM tweets WHERE used = 0 ORDER BY RAND() LIMIT 1");
	$method = mysql_result($result,0,"method");
	$twitterPin = mysql_result($result,0,"pin");
	
	if (strlen($twitter))
		$fun = str_replace("THEIRNAME",'.@'.$twitter, $method);	
	else
		$fun = str_replace("THEIRNAME",$name, $method);	
			

}

	mysql_query('UPDATE tweets set used = 1 where pin = '.$twitterPin);
	tweet($fun);
}


?>