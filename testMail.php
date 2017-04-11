<?php
$email = "lygarz@gmail.com";
$name = "NUT";
$masterID = "08";
$link = $link = "https://161.246.60.91/Passwire/resetMasterPassword.html?mst=".$masterID;

	require('PHPMailer_5.2.4/class.phpmailer.php');
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
    $mail->Body = "Hello " . $name . "<p>You can Change Password by Link --> ".$link."<br>
                        Your Master ID : ".$masterID."</p>";

    // $mail->AddAddress("nuttapon.kmitl@gmail.com", "Mr.Nuttapon"); // to Address
    $mail->AddAddress($email, $name); // to Address user
    //$mail-->AddAddress("email user","user name")

    $mail->set('X-Priority', '1'); //Priority 1 = High, 3 = Normal, 5 = low

    if($mail->Send()){
       //header("location:enterOTP.php");
    	echo "complete send mail";
   }else {
        echo "ERROR send mail";
    }
 ?>