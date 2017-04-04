<?php
include 'sendMail.php';
$new_password = $_POST['new_password'];
$comfirm_new_password = $_POST['comfirm_new_password'];
//$masterID = $_SESSION['masterID']; // --> pass by checkLogin.php
//receive pk(masterID) for link to email --> change password
$email = $_POST['emailForgotPass'];
$link = "http://localhost:88/Passwire/resetMasterPassword.html";
$subject = "Passwire Service : Change Password"

if ($new_password == $comfirm_new_password) {
	//sendMail($masterID,$email);
	echo "This is Email and New Password.<br>";
	sendMail($email,$new_password,$link,$subject);
	//link + quryString
} else{

	?>

		<script type="text/javascript"> 
			alert("Password is not same.");
			/*input get pk in link sent to user email*/
			window.location.href = "http://localhost:88/Passwire/resetMasterPassword.html";
		</script>

	<?php

}

?>	