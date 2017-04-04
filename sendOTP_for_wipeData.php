<?php
session_start();

include("connect.php");


$password = $_GET['graphic'];

$strSQL = "SELECT * FROM masteraccount WHERE masterGraphicalPassword = '" . mysql_real_escape_string($password) . "'";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);

if ($objResult) {
        $email = $objResult['email'];
        //print($email);
        $otp = strtoupper(bin2hex(openssl_random_pseudo_bytes(3)));
        //print($otp);

        $strDelOTPSQL = "DELETE FROM `onetimepassword` ";
        $strDelOTPSQL .="WHERE email = '" . $email . "' ";
               
        mysql_query($strDelOTPSQL);

        $insertOTP = "INSERT INTO `onetimepassword` (`email`, `otp`, `timeDate`) VALUES ('" . $email . "', '" . $otp . "', CURRENT_TIMESTAMP)";

        mysql_query($insertOTP);

        require_once('PHPMailer_5.2.4/class.phpmailer.php');
        $mail = new PHPMailer();
        $mail->IsHTML(true);
        $mail->CharSet = "utf-8";
        $mail->SMTPDebug = 2;
        $mail->IsSMTP();
        $mail->SMTPAuth = true; // enable SMTP authentication
        $mail->SMTPSecure = "tls"; // sets the prefix to the servier
        $mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
        $mail->Port = 587; // set the SMTP port for the GMAIL server
        $mail->Username = "passwire.service@gmail.com"; // GMAIL username
        $mail->Password = 'Passwire2'; // GMAIL password
        $mail->From = "passwire.service@gmail.com"; // "name@yourdomain.com";
        //$mail->AddReplyTo = "support@thaicreate.com"; // Reply
        $mail->FromName = "To be Passwire Web Service";  // set from Name
        $mail->Subject = "OTP by Passwire Web Service."; 
        $mail->Body = "Hello " . $name . "<p> Your OTP is --> <b><font size='20px' color='red'>" . $otp . "</b></p>";

        // $mail->AddAddress("nuttapon.kmitl@gmail.com", "Mr.Nuttapon"); // to Address
        $mail->AddAddress($email, $name); // to Address user
        //$mail-->AddAddress("email user","user name")


        $mail->set('X-Priority', '1'); //Priority 1 = High, 3 = Normal, 5 = low

        if($mail->Send()){
        
            header("location:enterOTP_for_wipeData.php?accountId=".$_GET["accountId"]);
                
        }  else {
            $word="Connection Error.";
            //echo ($word);
        ?>
            <script type="text/javascript">
                var strMessage = '<?=$word?>' ;// สร้างตัวแปรมารับก่อนนะครับ
                alert (strMessage + "\r\n SORRY! The system can't send OTP to you. \r\n");
            </script>
            <script language="JavaScript">window.location.href = "wipeData.php";</script>
        <?php
    }      
}
else {   
    session_write_close();
    header("location:wipeData.php");    
}
mysql_close();
?>