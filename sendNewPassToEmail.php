<?php
session_start();
//@mysql_connect("localhost", "root", "");
//mysql_select_db("masteraccount");
include("connect.php");
$email = $_POST['emailForgotPass'];
$name;

$strSQL = "SELECT * FROM masteraccount WHERE email = '" . mysql_real_escape_string($email) . "'";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);
$newPass;

$id_table_masteracc = mysql_query("SELECT name FROM `masteraccount` WHERE email = '" 
                      . mysql_real_escape_string($email) . "'") or die(mysql_error());

while ($info = mysql_fetch_array($id_table_masteracc)) {            
            $name = $info['name'];            
        }
        
$_SESSION['emailForgot'] = $email;

if (!$objResult) {
    $word="incorrect email!!!";
    ?>
    <script type="text/javascript">
          var strMessage = '<?=$word?>' ;// สร้างตัวแปรมารับก่อนนะครับ
          alert (strMessage + "\r\n Please Enter Email Again.");
     </script>
     <script language="JavaScript">window.location.href = "http://localhost/passwire/forgotPassword.html";</script>
<?php
} else {
    // We don't sent new password to user email
    //    but sent link http://localhost:88/Passwire/resetMasterPassword.html to user email
    //    for users to set a new password.  
    $newPass = strtoupper(bin2hex(openssl_random_pseudo_bytes(4)));
    //hash
    include 'cryptographyinitforweb.php';
    $hash_newPass = passwordHash($newPass);

    $updatePass = "UPDATE masteraccount SET masterTextPassword = '" .$hash_newPass. "' WHERE email = '" . $email . "'";
   // mysql_query($updatePass);
    
    ?>
     
<html>
<head>
<title>sent New Password to email</title>    
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
    $mail->Subject = "Forgot Password by Passwire Web Service."; 
    $mail->Body = "Hello " . $name . "<p> Your New Password is --> <b><font size='20px' color='green'>" . $newPass . "</b></p>";

    // $mail->AddAddress("nuttapon.kmitl@gmail.com", "Mr.Nuttapon"); // to Address
    $mail->AddAddress($email, $name); // to Address user
    //$mail-->AddAddress("email user","user name")

    //$mail->AddAttachment("thaicreate/myfile.zip");
    //$mail->AddAttachment("thaicreate/myfile2.zip");

    //$mail->AddCC("member@thaicreate.com", "Mr.Member ShotDev"); //CC
    //$mail->AddBCC("member@thaicreate.com", "Mr.Member ShotDev"); //CC

    $mail->set('X-Priority', '1'); //Priority 1 = High, 3 = Normal, 5 = low
    
// $updatePass = "UPDATE masteraccount SET masterTextPassword = '" .$newPass. "' WHERE email = '" . $email . "'";
//    mysql_query($updatePass);

    if($mail->Send()){
        $word="send New Password complate ";
        //echo ($word);
        mysql_query($updatePass);
        ?>
            <script type="text/javascript">
                var strMessage = '<?=$word?>' ;// สร้างตัวแปรมารับก่อนนะครับ
                alert (strMessage + "\r\n Please Check Your Email. \r\n");
            </script>
            <!-- <script language="JavaScript">window.location.href = "index.html";</script> -->
        <?php
        header("location:forgotComplete.php");
    }  else {
        $word="Connection Error.";
        //echo ($word);
        ?>
            <script type="text/javascript">
                var strMessage = '<?=$word?>' ;// สร้างตัวแปรมารับก่อนนะครับ
                alert (strMessage + "\r\n SORRY! We can't send to New Password for YOU. \r\n");
            </script>
            <script language="JavaScript">window.location.href = "index.html";</script>
        <?php
    }
?>
</body>
</html>

<?php
}
mysql_close();
?>