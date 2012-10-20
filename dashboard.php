<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js" type="text/javascript"></script>

<?php

function printDashboard($pageid)
{
	
	$usertype = $_SESSION['usertype'];	
	echo('<div id="dashboard" class="dashboard">');
	
		echo('<a id="0" href="index.php">Target</a>');

		echo('<a id="1" href="myProfile.php">Profile</a>');

	if (false) //(($_SESSION['team']== -1  || $_SESSION['username'] == "sgiordano" || $_SESSION['username'] == "mgerstman") && $pageid!=4)
	{
		echo('<a href ="admin.php">Admin</a>');
	}
	else if ($usertype)
	{//only give access to the overall panel to overalls
		echo('<a id="2" href ="admin.php">Overall</a>');
/*		echo('<script type="text/javascript">
$("#dashboard").width(762);
</script>');*/
	}
	
		echo('<a id="3" href ="leaderboard.php">Scores</a>');
		echo('<a id="4" href ="rules.php">Rules</a>');
		echo('<a id="5" href ="waysYouCanDie.php">Tweets</a>');
	echo('<a href="logout.php">Logout</a>');
	
	echo('</div>');
	echo('<script type="text/javascript">
$("#'.$pageid.'").attr("class","selected");
</script>');
}

function printTwitterDashboard($pageid)
{

	echo('<div id="dashboard" class="dashboard">');
	
		echo('<a id="0" href="listOfWays.php">List</a>');

		echo('<a id="1" href="needsApproval.php">Pending</a>');
	
		echo('<a id="2" href ="waysYouCanDie.php">Submissions</a>');
		echo('<a id="3" href ="admin.php">Overall</a>');
	
	echo('</div>');
	echo('<script type="text/javascript">
$("#'.$pageid.'").attr("class","selected");
</script>');

}

?>




<!--?php echo $pageid; ?-->