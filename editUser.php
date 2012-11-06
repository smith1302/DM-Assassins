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
	
include('checkAdmin.php');
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
printDashboard(2);

	$username = $_GET['username'];
	$_SESSION['workingUser'] = $username;
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

<h1>Edit User Profile</h1>
<p>Pin Number: <?php echo $pin; ?><br />
Kills: <?php echo $kills; ?> </p>

<img src="editprofile.png" class="editPen" /><p class="item" id="name">Name: <span id="nameSpan"><?php echo $name; ?></span></p><input type="text" id="nameInput" class="profileEdit" category="name" value="<?php echo $name; ?>"/><br />
<img src="editprofile.png" class="editPen" /><p class="item" id="facebook">Facebook: http://facebook.com/<span id="facebookSpan"><?php echo $facebook?></span></p><input type="text" id="facebookInput" class="profileEdit" category="facebook" value="<?php echo $facebook; ?>"/><br />
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
	} ?>



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