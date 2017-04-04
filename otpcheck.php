<?php 
    session_start();
    $email = $_SESSION['emailforotp'];
//    echo ($email);
    $otp = $_POST['yourotp'];
    
//    @mysql_connect("localhost", "root", "");
//    mysql_select_db("masteraccount");
    include("connect.php");    
    
//    $strOTPSQL = "SELECT otp FROM `onetimepassword` WHERE email = '" . mysql_real_escape_string($email) . "'";
//    $objOTPQuery = mysql_query($strOTPSQL);
//    $objOTPResult = mysql_fetch_array($objOTPQuery);
    $data = mysql_query("SELECT otp FROM `onetimepassword` WHERE email = '" . mysql_real_escape_string($email) . "'")
                                    or die(mysql_error());
    $resultOTP = "";
    while ($info = mysql_fetch_array($data)) {
//            print_r($info['otp']);
//            print "<br>";
            $resultOTP = $info['otp'];                 
           }
    
    if ($otp != $resultOTP) {
        $word="OTP not complate.";
//        echo ($word);
//        header("location:enterOTP.php");
?>
        <script type="text/javascript">
            var strMessage = '<?=$word?>' ;// สร้างตัวแปรมารับก่อนนะครับ
            alert (strMessage + "\r\n Please Check Your OTP in Email Again.");
        </script>
        <script language="JavaScript">window.location.href = "enterOTP.php";</script>
<?php
    } else {
?>
        <script type="text/javascript">

            alert ("OTP Complate.\r\n We are Backup Data for you to Email.\r\n Then we will disable Your Account.");

        </script>
        <script language="JavaScript">window.location.href = "otpComplete.php";</script>
<?php        
        }
        mysql_close();
?>
                           
