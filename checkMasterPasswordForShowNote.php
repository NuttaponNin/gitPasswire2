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
		//$password_hash = passwordHash($password);
		if(password_verify($password ,$hashText)){
			header("location:showNoteInformation.php?passDataId=".$_POST['passDataId']);
		}
		else{
			header("location:viewNote.php");
		}
		 
} else {
		header("location:viewNote.php");
}

mysql_close();

// session_start();
// //mysql_connect("localhost", "root", "");
// //mysql_select_db("masteraccount");
// include("connect.php");
// $password = $_POST['password'];
// $strSQL = "SELECT * FROM masteraccount WHERE masterTextPassword = '" . mysql_real_escape_string($password) . "'";
// $objQuery = mysql_query($strSQL);
// $objResult = mysql_fetch_array($objQuery);
// if ($objResult) {
//     header("location:showNoteInformation.php?passDataId=".$_POST['passDataId']);
//     // echo ('ok');
// }else {
//    // $_SESSION["id"] = $objResult["id"];
// //    $_SESSION["Status"] = $objResult["Status"];
//     session_write_close();
//     header("location:viewNote.php");    
//      //echo ('fuck');
// }
// mysql_close();
?>