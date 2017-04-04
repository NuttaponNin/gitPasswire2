<?php
session_start();

include("connect.php");
$username = $_POST['txtUsername'];
$accID_table_masteracc;
$masterUsrname_table;
$_SESSION['username'] = $username;
$strSQL = "SELECT * FROM masteraccount WHERE email = '" . mysql_real_escape_string($username) . "'";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);

$id_table_masteracc = mysql_query("SELECT masterID FROM `masteraccount` WHERE email = '" 
                      . mysql_real_escape_string($username) . "'") or die(mysql_error());
while ($info = mysql_fetch_array($id_table_masteracc)) {            
            $accID_table_masteracc = $info['masterID'];            
        }
        
$sql_masterUsername = mysql_query("SELECT masterUsername FROM `masteraccount` WHERE email = '" 
                      . mysql_real_escape_string($username) . "'") or die(mysql_error());
while ($info = mysql_fetch_array($sql_masterUsername)) {            
            $masterUsrname_table = $info['masterUsername'];            
        }
        
$_SESSION['masterID'] = $accID_table_masteracc;
$_SESSION['masterUsername'] = $masterUsrname_table;

if (!$objResult) {
    header("location:index.html");
} else {
    $_SESSION["id"] = $objResult["id"];
//    $_SESSION["Status"] = $objResult["Status"];
    header("location:masterPassword.html");
    // session_write_close();   
}
mysql_close();
?>