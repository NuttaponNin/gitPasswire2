<?php
session_start();
date_default_timezone_set('Asia/Bangkok');
//@mysql_connect("localhost", "root", "");
//mysql_select_db("masteraccount");
include("connect.php");
$email = $_POST['emailForLoss'];
$name;

$strSQL = "SELECT * FROM masteraccount WHERE email = '" . mysql_real_escape_string($email) . "'";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);
$otp = 'null';

$id_table_masteracc = mysql_query("SELECT name FROM `masteraccount` WHERE email = '" 
                      . mysql_real_escape_string($email) . "'") or die(mysql_error());

while ($info = mysql_fetch_array($id_table_masteracc)) {            
            $name = $info['name'];            
        }
$_SESSION['emailforotp'] = $email;

if (!$objResult) {
    $word="incorrect email!!!";
    ?>
    <script type="text/javascript">
          var strMessage = '<?=$word?>' ;// สร้างตัวแปรมารับก่อนนะครับ
          alert (strMessage + "\r\n Please Enter Email Again.");
     </script>
     <script language="JavaScript">window.location.href = "http://localhost/passwire/mobileLoss.html";</script>
<?php
} else {
    
    $strDelOTPSQL = "DELETE FROM `onetimepassword` ";
    $strDelOTPSQL .="WHERE email = '" . $email . "' ";
               
    mysql_query($strDelOTPSQL);
    
    $otp = strtoupper(bin2hex(openssl_random_pseudo_bytes(3)));
  
//    $_SESSION['emailforotp'] = $email;
    $insertOTP = "INSERT INTO `onetimepassword` (`email`, `otp`, `timeDate`) VALUES ('" . $email . "', '" . $otp . "', CURRENT_TIMESTAMP)";

     mysql_query($insertOTP);
    
    ?>
     
<html>
<head>
<title>sent OTP to email</title>    
</head>
<body>
    
<?php

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
        
        header("location:enterOTP.php");
                
        
    }  else {
        $word="Connection Error.";
        //echo ($word);
        ?>
            <script type="text/javascript">
                var strMessage = '<?=$word?>' ;// สร้างตัวแปรมารับก่อนนะครับ
                alert (strMessage + "\r\n SORRY! The system can't send OTP to you. \r\n");
            </script>
            <script language="JavaScript">window.location.href = "mobileLoss.html";</script>
        <?php
    }
?>
</body>
</html>

<?php
}
$_SESSION['otp'] = $otp;
mysql_close();
?>