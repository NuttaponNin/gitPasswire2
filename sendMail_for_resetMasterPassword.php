<?php
//include "connect.php";
include "sendMail.php";
date_default_timezone_set('Asia/Bangkok');
$con = mysqli_connect("localhost", "root", "", "project_passwire")
or die(mysqli_error("error connecting to database"));
// $new_password = $_POST['new_password'];
// $comfirm_new_password = $_POST['comfirm_new_password'];
//$masterID = $_SESSION['masterID']; 
// --> pass by checkLogin.php
//receive pk(masterID) for link to email --> change password
$email = $_POST['email'];
$subject = "Passwire Service : Change Password";

$masterID;
$name;

$stSQL = "SELECT * FROM masteraccount WHERE email = '" . mysqli_real_escape_string($con,$email) . "'";
$objQuery = mysqli_query($con,$stSQL);
$objResult = mysqli_fetch_array($objQuery);

$strSQL = mysqli_query($con,"SELECT * FROM `masteraccount` WHERE email = '" 
                      . mysqli_real_escape_string($con,$email) . "'") or die(mysql_close_connect_error());
while ($info = mysqli_fetch_array($strSQL)) {            
            $masterID = $info['masterID'];
            $name = $info['masterUsername'];            
        }
if (!$objResult) {
    $word="Email Incorrect!";
    ?>
            <script type="text/javascript">
                var strMessage = '<?=$word?>' ;// สร้างตัวแปรมารับก่อนนะครับ
                alert (strMessage + "\r\n Please try again. \r\n");
            </script>
            <script language="JavaScript">window.location.href = "forgotPassword.html";</script>
    <?php
}else{
    $link = $link = "https://161.246.60.91/Passwire/resetMasterPassword.php?mst=".$masterID;
    sendMail($subject,$masterID,$email,$name,$link);
//echo ($masterID."||".$email."||".$link."||".$subject);
// echo ($masterID);
// echo ($name);
}


    
?>	