<?php

session_start();
include("dashboard.php");

?>

<html>
<head>
<link href="styles.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Kameron:700,400' rel='stylesheet' type='text/css'>

<meta name="google-site-verification" content="v0pIot6t4p0pPG5I0uVma5Mu4uWXql0Trp5hKtNTk60" />
<title>Assassins Rules</title>
</head>

<body>

<div class="container">

<?php



//get user info from cookies
	$username = $_SESSION['username'];
		
if ($username)
{
	printDashboard(4);
}


?>
<div class="donorfaqs">
<h2>Killing</h2>
<div>
<p>To assassinate your target you must shoot them with silly string.</p>

<p>Once you have shot them, they will be required to give you their assigned PIN.<br />With this you will be able to enter it in on the website and you will promptly receive a new target.</p>

<p>If you are shot, you are eliminated from the game and you must give up your PIN.</p>

<p>You are only allowed to kill the person who is your target on the website. No hoarding pins!</p>

</div>



<h2>Defense</h2>

<div><p>To defend your self from assassination, you may shoot your assassin with silly string.<br />This will grant you 30 minutes of immunity.</p></div>



<h2 id="safe">Safe Zones</h2>

<div><p>The 3rd floor of the Reitz, live classrooms, and any official DM meetings are safe zones. Also anywhere on a Shands campus is considered safe.</p>

<p>Immediately before/after meetings and classes however are fair game. </p>

<p>Officially sponsored DM events are also safe zones. This includes all marketing, hospitality, and other events.</p>

<p>Captains working spirit point check-ins are also off limits, however they also cannot kill while working the check-in.</p>

<p>Any participants or staff at any public performances, elections, competitions, and pageants are completely off limits. Not only are they considered safe zones, but you will be completely removed from the game should you violate this rule. This includes but is not limited to: the upcoming speech and debate tournament, soulfest, the homecoming pageant, and gator growl. <b>This rule is all encompassing and the usual allowances for immediately before/after the event do not apply. No ambushing.</b></p>
</div>


<h2>Winners</h2>

<div><p>The winners will be the last player standing and the player with the most kills.</p><p>In the event of a draw or multiple winners, the distribution of prizes will be determined by the overall team. </p></div>


<h2>Pauses</h2>

<div><p>The game may be paused at the overall team's discretion. You will be notified of these by email.</p></div>



<h2>Plot Twists</h2>

<div><p>There will be several plot twists that will change the game dynamic. You will be notified of these by email. </p></div>


<h2>Cheating</h2>

<div><p>If a player is caught cheating they will be completely removed from the game.<br />If someone refuses to give up their pin, you can contact their overall.</p></div>


<h2>Golden Rule</h2>

<div><p>Most importantly, don't be a jerk.<br />Upload a real photo, use your common name, and don't make all your accounts super private. </p></div>
</div>
<script type="text/javascript">

$(document).ready(function() {
  $('.donorfaqs h2').each(function() {
    var tis = $(this), state = false, answer = tis.next('div').slideUp();
    tis.click(function() {
      state = !state;
      answer.slideToggle(state);
      tis.toggleClass('active',state);
    });
  });
});

</script>

<?php
echo('<br/>');
echo('<br/>');
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