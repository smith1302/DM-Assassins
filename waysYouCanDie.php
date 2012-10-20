<?php

session_start();
?>

<html>
<head>

<style>
form{
	width:500px;
	margin:0 auto;
	}

textarea{
	width:490px;
	height:60px;
	border:2px solid #ccc;
	padding:3px;
	color:#555;
	font:16px Arial, Helvetica, sans-serif;
	}
form div{position:relative;margin:1em 0;}
form .counter{
	position:absolute;
	right:5;
	top:-25;
	font-size:20px;
	font-weight:bold;
	color:#ccc;
	}
form .warning{color:#600;}	
form .exceeded{color:#e00;}	

</style>

<?php 	include_once('dashboard.php');?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles.css" rel="stylesheet" type="text/css" />
<title>Ways You Can Die</title>


<script src="charCount/charCount.js" type="text/javascript"></script>

</head>
<body>
<div class="container" align="center">
<?php 
	if  ($_SESSION['usertype'])
		printTwitterDashboard(2);
	else if ($_SESSION['username'])
		printDashboard(5);
?>
<h1>Twitter Submissions</h1>
Want to see your idea posted when a player dies? You're in the right place. <br />
<br />
All of the tweets need to include the persons name to be worth it. <br /> When you want to insert someone's name into the submission include the text: "THEIRNAME" in all caps.<br />
THEIRNAME was killed in a tragic segway accident.<br />
THEIRNAME died from video game withdrawal.<br />
King Kong threw THEIRNAME off of a building.<br />
<br />
Also here's some other things to keep in mind:<br />
<br />
1) All submissions need to be under 130 characters so we can include the player's name in the tweet.<br />
2) Keep it PG. This one should be obvious.<br />
3) Since these will be tweeted, feel free to use #hashtags and @'s where appropriate.<br />
4) Spell-check is your friend.<br />
<br /><br /><br />
<form action="processWaysYouCanDie.php" method="post" onsubmit="return validate(this);">

    	<div align="center">
            <textarea id="way" name="way" ></textarea>
        </div>	


<br /><input type="submit" value="Submit" />
<br />
<br />
<script type="text/javascript">

	$(document).ready(function(){	
		$("#way").charCount({
			allowed: 130,		
			warning: 20,
			counterText: 'Characters left: '	
		});
	});
</script>
<?php

echo($_SESSION['nope']);
unset($_SESSION['nope']);

?>

<!--P.S. The current list is available <a href="listOfWays.php">here.</a>-->

</div>

</form>
</body>
</html>