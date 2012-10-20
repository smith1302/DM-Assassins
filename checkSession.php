<?php
function check()

{
	session_start();
	if(!(isset($_SESSION['username'])))
	{//checks if session is set, if not redirect to login
  		// Not logged in
  		header('Location: login.php');
  		exit;
	}
}

?>