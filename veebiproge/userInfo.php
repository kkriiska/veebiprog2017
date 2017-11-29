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
	<a href="data.php">Data</a>
</p>


<?php
$find = 0;
$view = GetAllUsers($find);
	$html = "<table class='table table-bordered'>";
		$html.="<tr>";
			$html.="<th>email</th>";
			$html.="<th>eesnimi</th>";
			$html.="<th>perekonnanimi</th>";
			$html.="<th>sugu</th>";
		$html.="</tr>";
		
		foreach ($view as $v){
			$html.="<tr>";
				$html.="<td>".$v->email."</td>";
				$html.="<td>".$v->eesnimi."</td>";
				$html.="<td>".$v->perkonnanimi."</td>";
				$html.="<td>".$v->sugu."</td>";
			$html.="</tr>";	
		}
	$html .="</table>";
	
	echo $html


?>