<?php
session_start();
date_default_timezone_set('Asia/Bangkok');
@mysql_connect("localhost", "root", "");
mysql_select_db("masteraccount");
$email = $_POST['emailForLoss'];
//$_SESSION['email'] = $email;
//$otp = $_GET['otpPass'];

$strSQL = "SELECT * FROM masteraccount WHERE email = '" . mysql_real_escape_string($email) . "'";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);
$otp = 'null';

//$id_table_masteracc = mysql_query("SELECT name FROM `masteraccount` WHERE email = '" 
//                      . mysql_real_escape_string($email) . "'") or die(mysql_error());
//
//while ($info = mysql_fetch_array($id_table_masteracc)) {            
//            $name = $info['name'];            
//        }
$_SESSION['emailforotp'] = $email;

if (!$objResult) {
    $word="incorrect email!!!";
    ?>
    <script type="text/javascript">
          var strMessage = '<?=$word?>' ;// สร้างตัวแปรมารับก่อนนะครับ
          alert (strMessage + "\r\n Please Enter Email Again.");
     </script>
     <script language="JavaScript">window.location.href = "http://localhost/passwire3.7/mobileLoss.html";</script>
<?php
} else {
    
    $otp = strtoupper(bin2hex(openssl_random_pseudo_bytes(3)));
    $result_otp = $otp;
//    $_SESSION['emailforotp'] = $email;
    $insertOTP = "INSERT INTO `onetimepassword` (`email`, `otp`, `timeDate`) VALUES ('" . $email . "', '" . $otp . "', CURRENT_TIMESTAMP)";
    mysql_query($insertOTP);
    
    $dateTime = date_create_from_format('H:i:s', '00.00.00');
    $dateNow = date("Y-m-d");
    $timeNow = date("H:i:s");
    $timeInsert = $dateNow." ".$timeNow;
    $TimeEnd = date_add($timeInsert,date_interval_create_from_date_string("10 minutes"));
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
    $mail->IsSMTP();
    $mail->SMTPAuth = true; // enable SMTP authentication
    $mail->SMTPSecure = "ssl"; // sets the prefix to the servier
    $mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
    $mail->Port = 465; // set the SMTP port for the GMAIL server
    $mail->Username = "Passwire.service@gmail.com"; // GMAIL username
    $mail->Password = 'Passwire2'; // GMAIL password
    $mail->From = "Passwire.service@gmail.com"; // "name@yourdomain.com";
    //$mail->AddReplyTo = "support@thaicreate.com"; // Reply
    $mail->FromName = "To be Passwire Web Service";  // set from Name
    $mail->Subject = "Test sending OTP mail. ทดสอบการส่งอีเมล ครั้งที่ 2"; 
    $mail->Body = "Hello " . $name . "<p> Your OTP is --> <b><font size='20px' color='red'>" . $otp . "</b></p>";

    // $mail->AddAddress("nuttapon.kmitl@gmail.com", "Mr.Nuttapon"); // to Address
    $mail->AddAddress($email, $name); // to Address user
    //$mail-->AddAddress("email user","user name")

    //$mail->AddAttachment("thaicreate/myfile.zip");
    //$mail->AddAttachment("thaicreate/myfile2.zip");

    //$mail->AddCC("member@thaicreate.com", "Mr.Member ShotDev"); //CC
    //$mail->AddBCC("member@thaicreate.com", "Mr.Member ShotDev"); //CC

    $mail->set('X-Priority', '1'); //Priority 1 = High, 3 = Normal, 5 = low

    if($mail->Send()){
        $word="send otp complate " . $timeInsert;
        ?>
            <script type="text/javascript">
                var strMessage = '<?=$word?>' ;// สร้างตัวแปรมารับก่อนนะครับ
                alert (strMessage + "\r\n Please Check Your Email. \r\n");
            </script>
            <script language="JavaScript">window.location.href = "enterOTP.php";</script>
        <?php
    }
?>
</body>
</html>

<?php
}
mysql_close();
?>