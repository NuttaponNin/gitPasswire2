<?php 
    session_start();
    $email = $_SESSION['emailforotp'];
    $accountId = $_POST["accountId"];
//    echo ($email);
    $otp = $_POST['yourotp'];
    $email_otp;
    
    include("connect.php");    
    
    $data = mysql_query("SELECT * FROM `onetimepassword` WHERE otp = '" . mysql_real_escape_string($otp) . "'")
                                    or die(mysql_error());
    $resultOTP = "";
    $master_id = "";
    while ($info = mysql_fetch_array($data)) {
            $resultOTP = $info['otp'];
            $email_otp = $info['email'];               
           }

    $data2 = mysql_query("SELECT * FROM `masteraccount` WHERE email = '" . mysql_real_escape_string($email_otp) . "'")
                                    or die(mysql_error());
    while ($info = mysql_fetch_array($data2)) {
            $master_id = $info['masterID'];               
           }
    
    if ($otp != $resultOTP) {
        $word="OTP not complate.";

?>
        <script type="text/javascript">
            var strMessage = '<?=$word?>' ;// สร้างตัวแปรมารับก่อนนะครับ
            alert (strMessage + "\r\n Please Check Your OTP in Email Again.");
        </script>
        <script language="JavaScript">window.location.href = "enterOTP_for_disAccount.php";</script>
<?php
        // header("location:161.enterOTP_for_disAccont.php");
    } else {
        // echo ($email_otp);
        // echo ($master_id);
?>
        <script type="text/javascript">

            alert ("OTP Complate.\r\n We are Backup Data for you to Email.\r\n Then we will delete Your Password.");

        </script>
<?php
        $strDelAccSQL = "DELETE FROM `storedaccount` ";
        $strDelAccSQL .="WHERE masterID = ".$master_id."";
        $objQueryStoredAcc = mysql_query($strDelAccSQL);

        $strDelNoteSQL = "DELETE FROM `storednote` ";
        $strDelNoteSQL .="WHERE masterID = ".$master_id."";
        $objQueryStoredNote = mysql_query($strDelNoteSQL);

        $strDelOTPSQL = "DELETE FROM `onetimepassword` ";
        $strDelOTPSQL .="WHERE email = '".$email_otp."'";
        $objQueryOTP = mysql_query($strDelOTPSQL);

        if ($objQueryStoredAcc || $objQueryStoredNote || $objQueryOTP) {
            header("location:logout.php");
        } else {
            ?>
            <script language="JavaScript">
                alert("Error Delete");
            </script>
        <?php
            header("location:home.php");     

        }
        // mysql_close($objConnect);
        //header("location:home.php");
    }
    mysql_close();
?>
                           
