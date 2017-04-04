<?php 
    session_start();
    $email = $_SESSION['emailforotp'];
    echo ($email);
    $otp = $_POST['yourotp'];
    
    @mysql_connect("localhost", "root", "");
    mysql_select_db("masteraccount");
    
    $strOTPSQL = "SELECT otp FROM `onetimepassword` WHERE email = '" . mysql_real_escape_string($email) . "'";
    $objOTPQuery = mysql_query($strOTPSQL);
    $objOTPResult = mysql_fetch_array($objOTPQuery);
    
    if (!$objOTPResult) {
        $word="OTP not complate.";
//        header("location:enterOTP.php");
?>
        <script type="text/javascript">
            var strMessage = '<?=$word?>' ;// สร้างตัวแปรมารับก่อนนะครับ
            alert (strMessage + "\r\n Please Check Your OTP in Email Again.");
        </script>
        <script language="JavaScript">window.location.href = "enterOTP.php";</script>
<?php
    } else {
        $word2="OTP complate.";
//        header("location:disableAccount.php");
?>
        <script type="text/javascript">
            var strMessage2 = '<?=$word2?>' ;// สร้างตัวแปรมารับก่อนนะครับ
            alert (strMessage2 + "\r\n You want to back up data in application?.");
//            if(true){
//                alert ("go to back up");
//            }
        </script>
        <script language="JavaScript">window.location.href = "enterOTP.php";</script>
<?php
    }
mysql_close();
?>
                           
