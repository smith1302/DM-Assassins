<?php
/*Dance Marathon Assassins
    Copyright 2012 Dance Marathon at the University of Florida

This product includes software developed by the Dance Marathon at the University of Florida 2013 Technology Team.
The following developers contributed to this project:
	Matthew Gerstman

Dance Marathon at the University of Florida is a year-long effort that culminates in a 26.2-hour event where over 800 students stay awake and on their feet to symbolize the obstacles faced by children with serious illnesses or injuries. The event raises money for Shands Hospital for Children, your local Children’s Miracle Network Hospital, in Gainesville, FL. Our contributions are used where they are needed the most, including, but not limited to, purchasing life-saving medial equipment, funding pediatric research, and purchasing diversionary activities for the kids.

For more information you can visit http://floridadm.org
   
This software includes the following open source plugins listed below:
	Title:		HTML5 Image Uploader
	Link:		http://tutorialzine.com/2011/09/html5-file-upload-jquery-php/
	Copyright: 	None, but we're nice and want to give credit.

	Title:		Character Count Plugin - jQuery plugin
	Link:		http://cssglobe.com/post/7161/jquery-plugin-simplest-twitterlike-dynamic-character-count-for-textareas
	Copyright:	Copyright (c) 2009 Alen Grakalic (http://cssglobe.com)
	License:	MIT License (http://www.opensource.org/licenses/mit-license.php)

	Title:		Mobile Detect
	Link:		http://mobiledetect.net
	License:	http://www.opensource.org/licenses/mit-license.php

	Title:		PHPMailer - PHP email class
	Link:		https://code.google.com/a/apache-extras.org/p/phpmailer/
	Copyright:	Copyright (c) 2010-2012, Jim Jagielski. All Rights Reserved.
	License:	LGPL http://www.gnu.org/copyleft/lesser.html
	
	Title:		TableSorter 2.0 - Client-side table sorting with ease!
	Link:		http://tablesorter.com
	Copyright:	Copyright (c) 2007 Christian Bach
	License:	http://www.opensource.org/licenses/mit-license.php
	
	Title:		twitteroauth
	Link:		https://github.com/abraham/twitteroauth
	Copyright:	Copyright (c) 2009 Abraham Williams
	License:	http://www.opensource.org/licenses/mit-license.php*/
		

include('checkSession.php');
check();

include("dashboard.php");


include_once("connectToServer.php");
connect();

include("getTeam.php");
?>

<html>
<head>

<link href="styles.css" rel="stylesheet" type="text/css" />
<link href="tablesorter/themes/blue/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="tablesorter/jquery.tablesorter.js"></script> 
<meta name = "viewport" content = "width = device-width">
<title>Leaderboard</title>
</head>

<body>

<div class="container">
<?php
	$username = $_SESSION['username'];
	$table = "users";

printDashboard(3);

echo($_SESSION['status']);
unset($_SESSION['status']);

echo('<h1>Leaderboard</h1>');

$result = mysql_query("SELECT * FROM $table WHERE pin > 100 ORDER BY killed DESC, alive desc LIMIT 5");	

	echo('<h2>Top 5 Players Overall</h2>');
	echo('<table id="top5" class="tablesorter">
	<thead><tr>
	<th>Name</th>
	<th>Team</th>
	<th>Alive</th>	
	<th>Kills</th></tr></thead><tbody>');
	
while ($row = mysql_fetch_array($result))
	{//loop through users

//get user info	
		$name = $row["name"];
		$kills = $row["killed"];
		$team = $row["team"];
		$alive = $row["alive"];		
		$outputTeam = getTeam($team);
		
		if ($alive)
			$aliveText = "Yes";
		else
			$aliveText = "No";

//print user info
		echo('<tr><td>'.$name);
		echo('</td><td>'.$outputTeam);		
		echo('</td><td>'.$aliveText);		
		echo('</td><td>'.$kills.'</td></tr>');		
		
	}
	
	echo('</tbody></table>');

			
	$result = mysql_query("SELECT team, SUM(alive), SUM(killed), COUNT(name) FROM $table WHERE pin >100 GROUP BY team ");
	echo('<h2>Team Stats</h2>');
	echo('<table id="teamStats" class="tablesorter">
	<thead>
	<tr>
	<th>Team</th>
	<th>Players</th>	
	<th>Alive</th>
	<th>% Alive</th>
	<th>Kills</th>
	<th>Kill Ratio</th></tr></thead><tbody>');

	while ($row = mysql_fetch_array($result))
	{//loop through teams

//get team
		$team = $row["team"];
		$players = $row ["COUNT(name)"];
		$totalPlayers = $totalPlayers + $players;
		$alive = $row["SUM(alive)"];
		$totalAlive = $totalAlive + $alive;
		$percentAlive = $alive/$players * 100;
		$kills = $row["SUM(killed)"];
		$dead = $dead + $kills;
		$outputTeam = getTeam($team);
		if ($kills)
			$killsPerPlayer=$kills/$players;
		else
			$killsPerPlayer=0;


//print user info
		echo('<tr><td>'.$outputTeam);
		echo('</td><td>'.$players);		
		echo('</td><td>'.$alive);
		echo('</td><td>'.round($percentAlive,1).'%');
		echo('</td><td>'.$kills);
		echo('</td><td>'.round($killsPerPlayer,3).'</td></tr>');		
	}
	$percentAlive = $totalAlive/$totalPlayers * 100;
	if ($dead)
		$killsPerPlayer=$dead/$totalPlayers;
	else
		$killsPerPlayer=0;
	
	echo('</tbody>');
	
	echo('</tr><tr><td> Total');
	echo('</td><td>'.$totalPlayers);		
	echo('</td><td>'.$totalAlive);
	echo('</td><td>'.round($percentAlive,1).'%');
	echo('</td><td>'.$dead);		
	echo('</td><td>'.round($killsPerPlayer,3));
	
	echo('</td></tr></table>');

//get list of all user's who are alive

	$result = mysql_query("SELECT * FROM $table where alive!=0 AND pin >100");
	echo('<h2>Players Standing</h2>');
	echo('<table id="playersStanding" class="tablesorter">
	<thead>
	<tr>
	<th>Name</th>
	<th>Team</th>
	<th>Kills</th></tr></thead><tbody>');
	while ($row = mysql_fetch_array($result))
	{//loop through users

//get user info	
		$name = $row["name"];
		$kills = $row["killed"];
		$team = $row["team"];
		$outputTeam = getTeam($team);

//print user info
		echo('<tr><td>'.$name);
		echo('</td><td>'.$outputTeam);		
		echo('</td><td>'.$kills);	
	}
		echo('</td></tr></tbody></table>');
	
	
	

?>


<div class="footer">
	<div class="footer_content">
		A COPY OF THE OFFICIAL REGISTRATION AND FINANCIAL INFORMATION MAY BE OBTAINED FROM THE DIVISION OF CONSUMER SERVICES BY CALLING TOLL FREE 1-800-435-7352 WITHIN THE STATE. REGISTRATION DOES NOT IMPLY ENDORSEMENT, APPROVAL, OR RECOMMENDATION BY THE STATE. SHANDS TEACHING HOSPITAL AND CLINICS REGISTRATION NUMBER WITH THE STATE OF FLORIDA: SC01801<br />
		<div class="footer_spacing">
			<a href="http://www.health.ufl.edu/disclaimer.shtml">Disclaimer & Permitted Use</a>&nbsp;&nbsp;|&nbsp;&nbsp;
			<a href="http://www.ufl.edu/disability/">Disability Services</a>&nbsp;&nbsp;|&nbsp;&nbsp;
			<a href="https://security.health.ufl.edu">Security Policies</a>&nbsp;&nbsp;|&nbsp;&nbsp;
			<a href="http://privacy.ufl.edu/privacystatement.html">UF Privacy Policy</a>&nbsp;&nbsp;|&nbsp;&nbsp;
			<a href="http://www.shands.org/terms.asp">Shands Privacy Policy</a>
		</div>
	</div>
</div>

</div>

<script type="text/javascript">
$(document).ready(function() 
    { 
        $("#top5").tablesorter({
	        
   	        sortList: [[3,1]]
	        
        }); 
        
        $("#teamStats").tablesorter({
	        
   	        sortList: [[2,1]]
	        
        }); 
        
        $("#playersStanding").tablesorter({
	        
   	        sortList: [[0,0]]
	        
        }); 
    } 
); 
    
</script>

</body>
</html>