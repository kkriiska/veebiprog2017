<?php
	require("../../vpconfig.php");
	require("functions.php");
	
	$signupFirstname = "";
	$signupLastname = "";
	$gender = "";
	$signupEmail = "";
	$signupPassword = "";
	$deleted = 0;
	
	$loginEmail = "";
	$loginPassword = "";
	
	$signupFirstnameError = "*";
	$signupLastnameError = "*";
	$genderError = "*";
	$signupEmailError = "*";
	$signupPasswordError = "*";
	
	$loginEmailError = "*";
	$loginPasswordError = "*";
	
	if(isset ($_POST["loginEmail"])){
		if(empty ($_POST["loginEmail"])){
			$loginEmailError = "Error";
		}else{
			$loginEmail = $_POST["loginEmail"];
		}
	}
	
	if(isset ($_POST["loginPassword"])){
		if(empty ($_POST["loginPassword"])){
			$loginPasswordError = "Error";
		}else{
			$loginPassword = $_POST["loginPassword"];
		}
	}

	if (isset ($_POST["signupFirstname"])){
		if (empty ($_POST["signupFirstname"])){
			$signupFirstnameError ="NB! Väli on kohustuslik!";
		} else {
			$signupFirstname = $_POST["signupFirstname"];
		}
	}

	if (isset ($_POST["signupLastname"])){
		if (empty ($_POST["signupLastname"])){
			$signupLastnameError ="NB! Väli on kohustuslik!";
		} else {
			$signupLastname = $_POST["signupLastname"];
		}
	}
	
	if (isset ($_POST["signupEmail"])){
		if (empty ($_POST["signupEmail"])){
			//$signupEmailError ="NB! Väli on kohustuslik!";
		} else {
			$signupEmail = $_POST["signupEmail"];
		}
	}
	
	if (isset ($_POST["signupPassword"])){
		if (empty ($_POST["signupPassword"])){
			//$signupPasswordError = "NB! Väli on kohustuslik!";
		} else {
			//polnud tühi
			if (strlen($_POST["signupPassword"]) < 8){
				//$signupPasswordError = "NB! Liiga lühike salasõna, vaja vähemalt 8 tähemärki!";
			}else{
				
				$signupPassword=hash("sha512", $_POST["signupPassword"]);
				
			}
		}	
	}

	if (isset($_POST["gender"]) && !empty($_POST["gender"])){ //kui on määratud ja pole tühi
			$gender = intval($_POST["gender"]);
		} else {
			//$signupGenderError = " (Palun vali sobiv!) Määramata!";
	}
	
	if (isset($_POST["signupFirstname"])&& isset($_POST["signupLastname"])&& isset($_POST["gender"]) && isset($_POST["signupEmail"]) && isset($_POST["signupPassword"])
		&& $signupFirstnameError=="*" && $signupLastnameError=="*" && $genderError=="*" && $signupEmailError=="*" && $signupPasswordError=="*"){
		signUp($signupFirstname, $signupLastname, $gender, $signupEmail, $signupPassword, $deleted);}
		//header("Location: success.php");
		
	if (isset($_POST["loginEmail"]) && isset($_POST["loginPassword"])
		&& $loginEmailError=="*" && $loginPasswordError=="*"){
		logIn($loginEmail, $loginPassword);
		$loginEmailError=logIn($loginEmail, $loginPassword);}
	
?>


<!DOCTYPE html>
<html lang="et">
<head>
		<meta charset ="utf-8">
		<title>Sisselogimine ja kasutaja loomine</title>
</head>
<body>
	<h1>Logi sisse!</h1>
	<form method="POST">
		<label>Kasutajanimi (Email)</label>
		<input name="loginEmail" type="email" placeholder= "Email@mail.ee" value="<?php echo $loginEmail; ?>"><?php echo $loginEmailError ?>
		<br><br>
		<input name ="loginPassword" type="password" placeholder ="Parool"><?php echo $loginPasswordError ?>
		<br><br>
		<input type ="submit" value"Logi sisse">
	</form>
	
	<h1>Loo kasutaja</h1>
	<form method="POST">
		<label>Eesnimi </label>
		<input name="signupFirstname" type="text" ><?php echo $signupFirstnameError ?>
		<br><br>
		<label>Perekonnanimi </label>
		<input name="signupLastname" type="text" ><?php echo $signupLastnameError ?>
		<br><br>
		<label>Sugu</label><?php echo $genderError ?>
		<br><br>
		<input type="radio" name="gender" value="1" ><label>Mees</label>
		<input type="radio" name="gender" value="2" ><label>Naine</label>
		<input type="radio" name="gender" value="0" checked="checked" ><label>Muu</label>
		<br><br>
		<label>Kasutajanimi (E-post)</label>
		<input name="signupEmail" type="email"><?php echo $signupEmailError ?>
		<br><br>
		<input name="signupPassword" placeholder="Salasõna" type="password"><?php echo $signupPasswordError ?>
		<br><br>	

		<input type= "submit" value"Loo kasutaja">
	</form>
</body>
</html>
		
		