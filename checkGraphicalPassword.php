<?php
session_start();

require "connect.php";
include ("cryptographyinitforweb.php");

$password = $_POST['password'];
$masterID = $_SESSION['masterID'];

$strSQL = "SELECT * FROM masteraccount WHERE 1 
		AND masterID = '".$masterID."'";

$objQuery = mysql_query($strSQL) or die(mysql_error());
$objResult = mysql_fetch_array($objQuery);
$intNumRows = mysql_num_rows($objQuery);

if($objResult) {
		// $hashText = $objResult["masterTextPassword"];
		$hashGraphical = $objResult["masterGraphicalPassword"];
		// $password_hash = passwordHash($password);
		if(password_verify($password ,$hashGraphical)){
			// header("location:home.php");
			//    $_SESSION["Status"] = $objResult["Status"];
    		session_write_close();
    		// header("location:home.php");
    		echo true;
		}
		else{
			//header("masterPassword.html");
			http_response_code(400);
		}
		 
} else {
	http_response_code(400);
		//header("masterPassword.html");
}

mysql_close();

?>