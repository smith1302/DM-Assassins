<?php

include('checkAdmin.php');
checkAdmin();

include_once("connectToServer.php");
connect();



?>

<html>
<head>

<link href="styles.css" rel="stylesheet" type="text/css" />
<div class="container">
<?php
include("getTeam.php");
include("dashboard.php");
printDashboard(2);

$myTeam = $_SESSION['team'];
$teamNum = $_GET['team'];
if ($teamNum == NULL)
{//if overall link is wrong default to team from session
	$teamNum = $myTeam;
}
	
$outputTeam=getTeam($teamNum);
echo("<title>Overall Panel: $outputTeam</title>");
?>

<meta name = "viewport" content = "width = device-width">

</head>

<body>
<?php
	$username = $_SESSION['username'];
	$table = "users";



echo($_SESSION['status']);
unset($_SESSION['status']);


	echo('<h1>'.getTeam($teamNum).' Team</h1>');

	$result = mysql_query("SELECT * FROM $table where team = $teamNum ORDER BY name");
	
//get list of all user's with the same team as the overall
while ($row = mysql_fetch_array($result))
	{//loop through users

//get user info	
		$name = $row["name"];
		$username = $row["username"];
		$facebook = $row["facebook"];
		$twitter = $row["twitter"];
		$email = $row["email"];
		$target = $row["target"];
		$alive = $row["alive"];
		$img = $row["img"];		
		$pin = $row["pin"];		
//print user info
		echo("<div id='whole$pin'>Name: ".$name);	
		echo('<br />Facebook: <a href="http://facebook.com/'.$facebook.'">'.$facebook.'</a>');
		echo('<br />Twitter: <a href="http://twitter.com/'.$twitter.'">'.$twitter.'</a>');
		echo('<br />Email: <a href="mailto:'.$email.'">'.$email.'</a>');
		echo('<br /><a href="editUser.php?username='.$username.'"> Edit</a> ');
		
?>		
		
		<a pin="<?php echo $pin; ?>" id="kill<?php echo $pin;?>" class="killUser" <?php if (!$target){echo "style='display:none';";} ?>>Kill</a>

		<a pin="<?php echo $pin; ?>" id="revive<?php echo $pin;?>" class="reviveUser" <?php if ($target){echo "style='display:none';";} ?>>Revive</a>
		
		<a pin="<?php echo $pin;?>" class="deleteUser">Delete</a><br />

<?php			if ($img)
			echo('<img src="uploads/'.$img.'" class="overall_img" /><br />');

?>
</div>
<br />
<?php
} ?><br /><br />


<script type="text/javascript">

$('.deleteUser').click(function(){
	
	var sure = confirm('Are you sure you want to delete this user?');
	var pin = $(this).attr('pin');
	if (sure)
	{
		var data = {
			"pin" : pin,			
		}
		
		$.post('deleteUser.php', data, function(output) {  });
		$('#whole'+pin).fadeOut(2000);				
	}
	
});

$('.killUser').click(function(){
	
	var sure = confirm('Are you sure you want to kill this user?');
	var pin = $(this).attr('pin');
	if (sure)
	{
		var data = {
			"pin" : pin,			
		}
		
		$.post('killUser.php', data, function(output) {  });
		$('#kill'+pin).fadeOut(1000);				
		$('#revive'+pin).delay(1001).fadeIn(500);
	}
	
});

$('.reviveUser').click(function(){
	
	var sure = confirm('Are you sure you want to revive this user?');
	var pin = $(this).attr('pin');
	if (sure)
	{
		var data = {
			"pin" : pin,			
		}
		
		$.post('reviveUser.php', data, function(output) {  });
		$('#revive'+pin).fadeOut(1000);				
		$('#kill'+pin).delay(1001).fadeIn(500);
	}
	
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