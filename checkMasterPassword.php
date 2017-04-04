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
		$hashText = $objResult["masterTextPassword"];
		// $hashGraphical = $objResult["masterGraphicalPassword"];
		if(password_verify($password ,$hashText)){
			header("location:home.php");
		}
		else{
			header("location:masterPassword.html"); 
		}
		 
} else {
		header("location:masterPassword.html");
}

mysql_close();
?>