<?php
session_start();
//mysql_connect("localhost", "root", "");
//mysql_select_db("masteraccount");
include("connect.php");
$password = $_POST['password'];
$strSQL = "SELECT * FROM masteraccount WHERE masterTextPassword = '" . mysql_real_escape_string($password) . "'";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);
if ($objResult) {
    header("location:showPassInformation.php");
}else {
   // $_SESSION["id"] = $objResult["id"];
//    $_SESSION["Status"] = $objResult["Status"];
    session_write_close();
    header("location:viewPassword.php");    
     //echo ('fuck');
}
mysql_close();
?>