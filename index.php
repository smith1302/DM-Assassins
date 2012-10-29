<?php

include('checkSession.php');
check();
include('getTeam.php');
include("dashboard.php");
include('Mobile_Detect.php');



?>

<html>
<head>

<link href="styles.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Kameron:700,400' rel='stylesheet' type='text/css'>

<meta name="google-site-verification" content="v0pIot6t4p0pPG5I0uVma5Mu4uWXql0Trp5hKtNTk60" />
<title>Target Information</title>
</head>

<body>

<div class="container">

<?php
printDashboard(0);
//get user info from cookies
	$username = $_SESSION['username'];
	$table = "users";
		
//display dashboard links




include_once("connectToServer.php");
connect();

//get user's target	

	$result = mysql_query("SELECT * FROM $table where username =$username");	
	$alive = mysql_result($result,0, "alive");	
	$target = mysql_result($result,0, "target");
	$myPin = mysql_result($result,0, "pin");
	$showButton = mysql_result($result,0, "showbutton");

	if ($target)
	{

		$targetInfo = mysql_query("SELECT target FROM $table where pin=$target");
		$targetTarget = mysql_result($targetInfo,0,"target");
	}
	else
	{
		$targetTarget = 0;
	}
	
	if (($target) && ($targetTarget != $myPin))
	{

		echo("<h1>Target Information</h1>");
?>

	<p style="margin:0 5px"><b>New Rule:</b> Any participants or staff at any public performances, elections, competitions, and pageants are completely off limits. Not only are they considered safe zones, but you will be <b>completely removed</b> from the game should you violate this rule. This includes but is not limited to: the upcoming speech and debate tournament, soulfest, the homecoming pageant, and gator growl.<br /><b>This rule is all encompassing and the usual allowances for immediately before/after the event do not apply. No ambushing.</b></p>
<?php
		//get's target info from server
		
		$result = mysql_query("SELECT * FROM $table where pin = $target");

		$targetName = mysql_result($result,0,"name");
		$targetFacebook = mysql_result($result,0,"facebook");
		$targetEmail = mysql_result($result,0,"email");
		$targetTwitter = mysql_result($result,0,"twitter");
		$team = mysql_result($result,0,"team");
		$img =  mysql_result($result,0,"img");
		$outputTeam = getTeam($team);

		//prints target info

		echo("<div id='info'><p>Name: ".$targetName);
		echo('<br />Facebook: <a href="http://facebook.com/'.$targetFacebook.'">http://facebook.com/'.$targetFacebook.'</a>');
		if (strlen($targetTwitter))
			echo('<br />Twitter: <a href="http://twitter.com/'.$targetTwitter.'">http://twitter.com/'.$targetTwitter.'</a>');
		echo('<br />Email: <a href="mailto:'.$targetEmail.'">'.$targetEmail.'</a>');
		echo('<br />Team: '.$outputTeam.'</p>');

		$overallResult = mysql_query("Select * FROM users where usertype=1 and team=$team");
		if (mysql_num_rows($overallResult))
			$overallEmail = mysql_result($overallResult,0,"email");
		else
			$overallEmail = "sanchezj@floridadm.org";


		$detect = new Mobile_Detect();		
		if (($showButton) && ! ($detect->isMobile()))
		{
			echo('<div style="margin:10px 0 -15px 0"><div id="bigbutton" class="round">Big Red<br />Button</div></div><br />');
		}


		if ($img)
			echo('<br /><img src ="uploads/'.$img.'" class="overall_img" />');
		else
			echo('<br />Your target has not uploaded a picture yet.');
		

		echo('</div><p>
		If you have killed your target<br />
		please enter their pin here:</p>
		<form action="killTarget.php" method="post">
		<input type="text" name="targetPin" /><br />
		<input type="submit" value="Kill Target" /></form><br /><br />');
		
		
		$result = mysql_query("SELECT * FROM $table where team=$team AND usertype = 1");

		
		echo("If your target's Facebook is inaccessible you can email<br /> their overall at: <a href='mailto:$overallEmail'>$overallEmail</a>");
	}
	else if ($targetTarget == $myPin)
	{
		echo("<p style='margin: 10 20px'>You and your target are the last two standing from your team. As such, you have been quarantined until the final round stay tuned for more</p>");
	}
	else if ($alive)
	{//if user has no target they are dead, let them know this.
//		echo("<br />The game will begin on Monday, November 28, 2011.<br /> You will receive an email when your target has been assigned.");
		echo("<h1>The game has been paused</h1>");
	}
	else
	{
		echo("<h1>You have been killed.</h1><p>If you believe this is an error,<br /> please contact your overall</p>");
	}

?>


<?php
echo('<br/>');
echo('<br/>');
echo($_SESSION['status']);
unset($_SESSION['status']);
?>

<script type="text/javascript">

$('#bigbutton').click(function(){
	
	var data = {
		'pin' : <?php echo $myPin; ?>
	}
	
	$.post('bigButton.php', data, function(output) {
	
		if (output != 0)
		{
			data = {
				'pin' : output
				}
			$.post('getUser.php', data, function(newUser){
		
				$('#info').fadeOut(0);
				console.log(newUser);
				newUser = $.parseJSON(newUser);
				var twitterInfo = '';
				if (newUser['twitter'])
				{
					twitterInfo = '<br />Twitter: <a href="http://twitter.com/'+ newUser['twitter'] + '">http://twitter.com/'+newUser['twitter']+'</a>';
				}
				$('#info').html('<p>Name: '+newUser['name'] + '<br />Facebook: <a href="http://facebook.com/' + newUser['facebook'] +'">http://facebook.com/'+ newUser['facebook'] + '</a>'+ twitterInfo + ' <br />Email: <a href="mailto:'+ newUser['email'] + '">'+ newUser['email'] + '</a><br />Team: '+newUser['team']+'</p><br /><img src ="uploads/'+newUser['img']+'" class="overall_img" />');
				$('#info').fadeIn(1000);
			});
		}
	});	
	$(this).fadeOut(1000);
});


</script>


</div>
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


</body>
</html>
