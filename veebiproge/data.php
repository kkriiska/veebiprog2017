<?php 
	
	require("functions.php");
	require("../../vpconfig.php");
	
	if(!isset ($_SESSION["userId"])) {
		header("Location: login.php");
		exit();
	}
	
	if (isset($_GET["logout"])) {
		
		session_destroy();
		
		header("Location: login.php");
		exit();
	}
	
	
	
	
	
?>

<h1>Data</h1>
<p>
	Tere tulemast <a href="user.php"><?=$_SESSION["userEmail"];?></a>!
	<a href="?logout=1">Logi välja</a>
	<br></br>
	<a href="userInfo.php">UserInfo</a>
	<a href="photoUpload.php">photoUpload</a>
</p>
