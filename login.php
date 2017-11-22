<?php
	require("../../vpconfig.php");
	
	$signupFirstname = "";
	$signupLastname = "";
	$gender = "";
	$signupEmail = "";
	$signupPassword = "";
	
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

	if (isset ($_POST["signupFirstName"])){
		if (empty ($_POST["signupFirstName"])){
			$signupFirstNameError ="NB! Väli on kohustuslik!";
		} else {
			$signupFirstName = $_POST["signupFirstName"];
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
			}
		}
	}

	if (isset($_POST["gender"]) && !empty($_POST["gender"])){ //kui on määratud ja pole tühi
			$gender = intval($_POST["gender"]);
		} else {
			//$signupGenderError = " (Palun vali sobiv!) Määramata!";
	}
	
	
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
		<input name="signupFirstname" type="text" value="firstname"><?php echo $signupFirstnameError ?>
		<br><br>
		<label>Perekonnanimi </label>
		<input name="signupLastname" type="text" value="lastname"><?php echo $signupLastnameError ?>
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
		
		