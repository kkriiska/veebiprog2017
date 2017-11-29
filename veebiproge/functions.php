<?php
	$database ="if17_karokrii";
	
	
	session_start();
	
	function signUp($firstname, $lastname, $gender, $email, $password, $deleted){
		$notice="";
		$mysqli = new mysqli ($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("INSERT INTO user_sample(eesnimi, perkonnanimi, sugu, email, parool, deleted) VALUES(?, ?, ?, ?, ?, ?)");
		echo $mysqli->error;
		$stmt->bind_param("ssissi", $firstname, $lastname, $gender, $email, $password, $deleted);
		if ($stmt->execute()){
			echo "\n Õnnestus!";
		} else {
			echo "\n Tekkis viga : " .$stmt->error;
		}
		$stmt->close();
		$mysqli->close();
	}
	
	function logIn($email, $password){
		$notice="";
		$mysqli = new mysqli ($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt=$mysqli->prepare("SELECT id, email, parool FROM user_sample WHERE email=?");
		echo $mysqli->error;
		$stmt->bind_param("s", $email);
		$stmt->bind_result($id, $emailfromDb, $passwordfromDb);
		$stmt->execute();
		if($stmt->fetch()){
			$hash=hash("sha512", $password);
			if ($hash==$passwordfromDb){
				echo "kasutaja $id logis sisse";
				$_SESSION ["userId"]=$id;
				$_SESSION ["userEmail"]=$emailfromDb;
				header ("Location: data.php");
				exit();
			}else{
				$notice="parool on vale";
			}
			
		}else{
			$notice="Sellise emailiga kasutajat pole olemas";
		}
		$stmt->close();
		return $notice;
	}
	
	function GetAllUsers($find) {
		$notice="";
		$mysqli = new mysqli ($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		echo $mysqli->error;
		$stmt = $mysqli->prepare("SELECT email, eesnimi, perkonnanimi, sugu FROM user_sample WHERE deleted = ?");
		$stmt->bind_param("i", $find);
		$stmt->bind_result($email, $eesnimi, $perkonnanimi, $sugu);
		$stmt->execute();
		
		$results = array();
		
		while ($stmt->fetch()){
			if($sugu == 1){
				$sugu = "Mees";
			}
			if($sugu == 2){
				$sugu = "Naine";
			}
			if($sugu == 3){
				$sugu = "Muu";
			}
			$info = new StdClass();
			$info->email = $email;
			$info->eesnimi = $eesnimi;
			$info->perkonnanimi = $perkonnanimi;
			$info->sugu = $sugu;
			
			array_push($results, $info);
		}
		$stmt->close();
		return $results;
	}

?>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

