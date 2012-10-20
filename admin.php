<?php

include('checkSuperAdmin.php');
checkSuperAdmin();


?>

<html>
<head>
<link href="styles.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Kameron:700,400' rel='stylesheet' type='text/css'>


<title>Admin Panel</title>


</head>

<body>

<div class="container">
<?php
	$username = $_SESSION['username'];
	$table = "users";

include("dashboard.php");
printDashboard(2);
include("getTeam.php");


echo($_SESSION['status']);
unset($_SESSION['status']);


//get list of all user's with the same team as the overall

echo("<h1>Team List</h1><div class='admin'>");

$i = -5;
	$outputTeam = getTeam($i);
	echo('<a href =overall.php?team='.$i.'>'.$outputTeam.'</a><br/>');

for($i=1; $i<14; $i++)
{
	$outputTeam = getTeam($i);
	echo('<a href =overall.php?team='.$i.'>'.$outputTeam.'</a><br/>');
}

?>

<h2>Twitter</h2>
<a href="needsApproval.php">Needs Approval</a><br />
<a href="listOfWays.php">Tweet List</a>
<h2>Overall List</h2>
</div>
<?php
	$result = mysql_query("SELECT * FROM $table where usertype = 1  ORDER BY name");
while ($row = mysql_fetch_array($result))
	{//loop through users

//get user info	
		$name = $row["name"];
		$username = $row["username"];
		$facebook = $row["facebook"];
		$twitter = $row["twitter"];
		$team = $row["team"];
		$email = $row["email"];
		$target = $row["target"];
		$pin = $row["pin"];
		
//print user info
		echo("<div id='whole$pin'>Name: ".$name);	
		echo('<br />Facebook: <a href="http://facebook.com/'.$facebook.'">http://facebook.com/'.$facebook.'</a>');
		echo('<br />Twitter: <a href="http://twitter.com/'.$twitter.'">http://twitter.com/'.$twitter.'</a>');
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