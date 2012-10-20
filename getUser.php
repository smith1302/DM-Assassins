<?php 

require_once("connectToServer.php");
connect();

$userPin = $_POST['pin'];
echo $userPin;
$sql0 = mysql_query("Select * FROM users where pin = $userPin");
$user = mysql_fetch_assoc($sql0);

echo json_encode($user);

?>