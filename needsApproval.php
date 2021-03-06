<html>
<head>
<link href="styles.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Kameron:700,400' rel='stylesheet' type='text/css'>
<title>Pending Tweets</title>
</head>
<body>
<div class="container">
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
	
session_start();
$pw = md5($_GET['pw']);
if ($_SESSION['usertype']!=1)
{
	header("Location: index.php");
}

include_once("connectToServer.php");
connect();
include_once("dashboard.php");
printTwitterDashboard(1);
echo('<div><h1>Pending Tweets</h1>');

$result = mysql_query("SELECT * FROM tweetTest");

if (mysql_num_rows($result)==0)
{
	echo('There are no submissions waiting approval.<br />');
}

while ($row = mysql_fetch_array($result))
{
	
	$method = $row["method"];
	$pin = $row["pin"];

	
?>
<div id="entire<?php echo $pin; ?>">
<img src="editprofile.png" class="editPen" /><p class="item" id="<?php echo $pin; ?>"><span id="<?php echo $pin; ?>Span"><?php echo $method; ?></span></p>
	<input type="text" id="tweet<?php echo $pin; ?>" class="profileEdit" tweet="<?php echo $pin; ?>" value="<?php echo $method;?>" style="width:500px"/>
	<img src="approve.png" class="approveButton" tweet="<?php echo $pin; ?>" id="delete<?php echo $pin;?>" />
	<img src="delete.png" class="deleteButton" tweet="<?php echo $pin; ?>" id="delete<?php echo $pin;?>" /><br /><br /></div>


<?php	
}

echo($_SESSION['approve']);

?>

<script type="text/javascript">

$('.approveButton').click(function(){
	var tweet = $(this).attr("tweet");
	var data = {
		"pin" : tweet
	}
	$('#entire'+tweet).fadeOut(1000);
	$.post('approveTweet.php', data, function(output) {  });
});

$('.deleteButton').click(function(){
	var tweet = $(this).attr("tweet");
	var data = {
		"pin" : tweet,
		"table" : "tweetTest"
	}
	$('#entire'+tweet).fadeOut(1000);
	$.post('deleteTweet.php', data, function(output) {  });
});

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
		var value = $('#tweet'+myId).text();
				
		$('#tweet'+myId).css("display", "inline").focus();
		$('#'+myId+'Span').css("display", "none");
	
	})



$('.profileEdit').keypress(function (e) {
  if (e.which == 13) {
    $(this).blur();
  }
});
	
	
$('.profileEdit').blur(function(){
	console.log($(this));
	var value = $(this).val();
	var tweet = $(this).attr("tweet");
	$(this).css("display", "none");
	$("#"+tweet+"Span").text(value).css("display", "inline");

	var data = {
		"pin" : tweet,
		"value" : value,
		"column" : "tweetTest"
	}
	
	$.post('editTweet.php', data, function(output) {  });
	
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