<?php
require "connect.php";
$data = "test_encrypting_naja";

$iv = "iviviviviviviviv";
$key = "I want to see you so bad :/";

function makeKey($masterID){
	//$_POST["masterID"] = "3"; // for Sample

	$key = "I want to see you so bad :/";
	$keyElement1 = "";
	$keyElement2 = "";
	$keyElement3 = "";
	$hash = "";

	$strSQL = "SELECT * FROM masteraccount WHERE 1 
				AND masterID = '".$masterID."'  
			  ";
	
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);
	if($objResult) {
		$keyElement1 = $objResult["masterTextPassword"];
		$keyElement2 = $objResult["masterGraphicalPassword"];

		//echo "element2 : ".$keyElement2."<br>";

		$keyElement3 = $objResult["email"];
		$cost = 11;
		$salt = mcrypt_create_iv(22, MCRYPT_DEV_URANDOM);
		
		//make key -> Hash(Hash(text)+Hash(graphical))+Hash(email)
		$keyElement1 = hash("sha256",$keyElement1, false);
		$keyElement2 = hash("sha256",$keyElement2, false);
		$key = $keyElement1.$keyElement2 ;

		//echo "key ele1+2 : ".$key."<br>";

		$key = hash("sha256",$key, false);

		//echo "hashed key ele1+2 : ".$key."<br>";

		$keyElement3 = hash("sha256",$keyElement3, false);
		$key = $key.$keyElement3 ;
		$key = hash("sha256",$key, false);

		//echo "FinalKey : ".$key."<br><br>";
	}
	return $key;
}

function passwordHash($password){
	$cost = 11;
	$salt = mcrypt_create_iv(22, MCRYPT_DEV_URANDOM);

	$options = [
	    'cost' => $cost,
	    'salt' => $salt,
	];

	$hash = password_hash($password, PASSWORD_BCRYPT, $options);
	return $hash;
}

?>