<?php 
    session_start();
    $email = $_SESSION['emailforotp'];
    $accountId = $_POST["accountId"];
//    echo ($email);
    $otp = $_POST['yourotp'];
    
    include("connect.php");    
    
    $data = mysql_query("SELECT otp FROM `onetimepassword` WHERE otp = '" . mysql_real_escape_string($otp) . "'")
                                    or die(mysql_error());
    $resultOTP = "";
    while ($info = mysql_fetch_array($data)) {
            $resultOTP = $info['otp'];                 
           }
    
    if ($otp != $resultOTP) {
        $word="OTP not complate.";

?>
        <script type="text/javascript">
            var strMessage = '<?=$word?>' ;// สร้างตัวแปรมารับก่อนนะครับ
            alert (strMessage + "\r\n Please Check Your OTP in Email Again.");
        </script>
        <script language="JavaScript">window.location.href = "enterOTP_for_wipeData.php";</script>
<?php
    } else {
?>
        <script type="text/javascript">

            alert ("OTP Complate.\r\n We are Backup Data for you to Email.\r\n Then we will delete Your Password.");

        </script>
<?php
        $strDelDataSQL = "DELETE FROM `storedaccount` ";
        $strDelDataSQL .="WHERE accountID = '" . $accountId . "' "; 
        mysql_query($strDelDataSQL);

        header("location:wipePassword.php");

    }
    mysql_close();
?>
                           
