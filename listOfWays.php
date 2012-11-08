<html>
<head>
<link href="styles.css" rel="stylesheet" type="text/css" />
<title>Ways to Die</title>
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
if (($_SESSION['username'] != "mgerstman") && $_SESSION['usertype']!=-1 && $_SESSION['usertype']!=1)
{
	header("Location: index.php");
}
include_once("dashboard.php");
printTwitterDashboard(0);
echo('<div><h1>Tweet List</h1>');

include_once("connectToServer.php");
connect();
$result = mysql_query("SELECT COUNT(method), SUM(used) FROM tweets");
$total = mysql_result($result,0,'COUNT(method)');
$used =  mysql_result($result,0,'SUM(used)');
$unused = $total - $used;
$users = mysql_query("SELECT COUNT(pin), SUM(alive) FROM users");
$alive = mysql_result($users,0, "SUM(alive)");
if ($alive > $unused)
	$needed = $alive - $unused;
else
	$needed = 0;

echo("Total Tweets: $total<br/>Used Tweets: $used<br />Unused Tweets: $unused<br />Needed: $needed<br /><br />");

$result = mysql_query("SELECT * FROM tweets ORDER BY time DESC");
$j=0;
while ($row = mysql_fetch_array($result))
{
	$method = $row["method"];
	$pin = $row['pin'];
	$team = $row['team'];
		
	for ($i=-1; $i<12; $i++)
	{
		$selectVal[$i]='"' . $i. '"';
		if ($i == $team)
		{
			$selectVal[$i] = $i . ' selected';
		}
	}
	
	$j++;
	
?>
	<div id="entire<?php echo $pin; ?>">
	<img src="editprofile.png" class="editPen" /><p class="item" id="<?php echo $pin; ?>"><span id="<?php echo $pin; ?>Span"><?php echo $method; ?></span></p>
	<input type="text" id="tweet<?php echo $pin; ?>" class="profileEdit" tweet="<?php echo $pin; ?>" value="<?php echo $method;?>" style="width:500px"/>
	<img src="delete.png" class="deleteButton" tweet="<?php echo $pin; ?>" id="delete<?php echo $pin;?>" /><br /><br /></div>
<?php	
	
/*	 <form action="processEditTweet.php" method="post">
		<input type="hidden" name="pin" value ='.$pin.' />
		<input type="hidden" name="pw" value ="3a49792c07a3c48c735b73b4a1ecb569"/>
		<input type="input" name="way" value ="'.$method.'"/>
	&nbsp;Delete:<input type="checkbox" name="delete" value="1" /> 
	<input type="submit" value="Submit" /></form>');*/

}

?>

<script type="text/javascript">

$('.deleteButton').click(function(){
	var tweet = $(this).attr("tweet");
	var data = {
		"pin" : tweet,
		"table" : "tweets"
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
		"column" : "tweets"
	}
	
	$.post('editTweet.php', data, function(output) {  });
	
})

</script>


</div>

</body>
</html>