<?php
require "connect.php";

$value_masterID = 3;
include ("cryptographyinitforweb.php");
$key = makeKey($masterID);


$data = mysql_query("SELECT * FROM `storedaccount` WHERE masterID = '" . mysql_real_escape_string($value_masterID) . "'")
                                    or die(mysql_error());
$title;
$username;
$password;
while ($info = mysql_fetch_array($data)) {
	$title = $info['title'];
	$username = $info['username'];
	$password = $info['password'];
}
$title = openssl_decrypt($title , "AES-256-CBC" , $key, 0, $iv);
$username = openssl_decrypt($username , "AES-256-CBC" , $key, 0, $iv);
$password = openssl_decrypt($password , "AES-256-CBC" , $key, 0, $iv);
echo ($title);
echo "<br>";
echo ($username);
echo "<br>";
echo ($password);
echo "<br>";
?>