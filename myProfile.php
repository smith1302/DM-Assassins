<?php

include('checkSession.php');
check();

include('getTeam.php');

?>

<html>
<head>
<link href="styles.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Kameron:700,400' rel='stylesheet' type='text/css'>

<title>My Profile</title>
</head>
<script language="Javascript">//check if password and confirmation are equal

	function validate(form) {
		  var elem = form.elements;

		  if(elem.new.value != elem.confirm.value) {
		    alert('Please check your password; the confirmation entry does not match.');
		    return false;
		  }
		  return true;
		}
</script>
<body>

<div class="container">

<?php

include("dashboard.php");
printDashboard(1);

	$username = $_SESSION['username'];
	$_SESSION['workingUser'] = $username;	
	$usertype = $_SESSION['usertype'];	
	$table = "users";


//standard dashboard output


include_once("connectToServer.php");
connect();
	
//get personal info
	$result = mysql_query("SELECT * FROM $table where username = '$username'");
	$pin = mysql_result($result,0,"pin");
	$name = mysql_result($result,0,"name");
	$facebook = mysql_result($result,0,"facebook");
	$twitter = mysql_result($result,0,"twitter");
	$email = mysql_result($result,0,"email");
	$team = mysql_result($result,0,"team");
	$kills = mysql_result($result,0,"killed");	
	$img = mysql_result($result,0,"img");	
	$outputTeam = getTeam($team);
	
	
//output personal info	


?>

<h1>Your Profile</h1>
<p>Pin Number: <?php echo $pin; ?><br />
Kills: <?php echo $kills; ?> </p>

<img src="editprofile.png" class="editPen" /><p class="item" id="name">Name: <span id="nameSpan"><?php echo $name; ?></span></p><input type="text" id="nameInput" class="profileEdit" category="name" value="<?php echo $name; ?>"/><br /><img src="editprofile.png" class="editPen" /><p class="item" id="facebook">Facebook: http://facebook.com/<span id="facebookSpan"><?php echo $facebook?></span></p><input type="text" id="facebookInput" class="profileEdit" category="facebook" value="<?php echo $facebook; ?>"/><br />
<img src="editprofile.png" class="editPen" /><p class="item" id="twitter">Twitter: http://twitter.com/<span id="twitterSpan"><?php echo $twitter?></span></p><input type="text" id="twitterInput" class="profileEdit" category="twitter" value="<?php echo $twitter; ?>"/><br />
<img src="editprofile.png" class="editPen" /><p class="item" id="email">Email: <span id="emailSpan"><?php echo $email?></span></p><input type="text" id="emailInput" class="profileEdit" category="email" value="<?php echo $email; ?>"/><br />
<img src="editprofile.png" class="editPen" /><p class="item" id="team">Team: <span id="teamSpan"><?php echo $outputTeam;?></span></p>

<select id="teamInput" category="team" class="profileEdit">
<option value=-5>No Team</option>
<option value=1>Art/Layout</option>
<option value=2>Community Events</option>
<option value=3>Dancer Relations</option>
<option value=4>Entertainment</option>
<option value=5>Family Relations</option>
<option value=6>Finance</option>
<option value=7>Hospitality</option>
<option value=8>Marketing</option>
<option value=9>Morale</option>
<option value=10>Operations</option>
<option value=11>Public Relations</option>
<option value=12>Recruitment</option>
<option value=13>Technology</option>
</select><br /><br />

<!--br ><br />To prevent cheating, we have disabled profile editing<br />
 If any of the information above is incorrect, please contact your overall.</p><br /-->


<div id="dropbox">
			<span class="message"><img class="overall_img" src="<?php if ($img) {echo "uploads/".$img;} else {echo "drophere.png";} ?>" /></i></span>
		</div>
        
        <!-- Including The jQuery Library -->
		<script src="http://code.jquery.com/jquery-1.6.3.min.js"></script>
		
		<!-- Including the HTML5 Uploader plugin -->
		<script src="assets/js/jquery.filedrop.js"></script>
		
		<!-- The main script file -->
        <script src="assets/js/script.js"></script>


	<?php
	if ($img)
	{
	?><br /><h2>Drag an image on top of the old one to replace it</h2><?php
	}
	else
	{?>
		<br /><h2>if you have any issues uploading your image, email your overall and they can do it for you.</h2>	
	
	<?php } ?>



<br />

</div>

<script type="text/javascript">

$('.item').live('mouseenter',
	function(){
		$(this).prev('.editPen').css("display","inline");
		$(this).css('margin-left', '0px');
	});

$('.item').live('mouseleave',
	function(){
		$(this).prev('.editPen').css("display","none");
		$(this).css('margin-left', '17px');		
	});

$('.item').click(
	function(){
		
		var myId = $(this).attr('id');;
		var spanType = $('#'+myId+'Span').is();
		var value = $('#'+myId+'Span').text();
				
		$('#'+myId+'Input').css("display", "inline").focus();
		$('#'+myId+'Span').css("display", "none");
	
	})
	
$('.profileEdit').keypress(function (e) {
  if (e.which == 13) {
    $(this).blur();
  }
});
	
$('#teamInput').val(<?php echo $team; ?>);
	
$('.profileEdit').blur(function(){
	console.log($(this));
	var value = $(this).val();
	var category = $(this).attr("category");
	var text = $("#"+category+ "Input :selected").text();
	$(this).css("display", "none");
	if ($(this).is(':text'))
		$("#"+category+"Span").text(value).css("display", "inline");
	else
		$("#"+category+"Span").text(text).css("display", "inline");
		
	var data = {
		"pin" : <?php echo $pin; ?>,
		"column" : category,
		"value" : value,				
	}
	
	$.post('editField.php', data, function(output) {  });
	
})

</script>

<?php

echo($_SESSION['status']);
unset($_SESSION['status']);
?>


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