<?php

function sendMail($subject,$masterID,$email,$name,$link){
	// echo ($email);
 //    echo "<br>";
 //    echo ($link);
 //    echo "<br>";
 //    echo ($subject);
 //    echo "<br>";
 //    echo ($masterID);
   // $link = "http://localhost:88/Passwire/resetMasterPassword.html?mst=".$masterID;

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
        $mail->Subject = $subject; 
        $mail->Body = "Hello " . $name . "<p>
                        <font size='10px'> You can Change Password by Link --> ".$link."</p>";

        // $mail->AddAddress("nuttapon.kmitl@gmail.com", "Mr.Nuttapon"); // to Address
        $mail->AddAddress($email, $name); // to Address user
        //$mail-->AddAddress("email user","user name") username in database

        $mail->set('X-Priority', '1'); //Priority 1 = High, 3 = Normal, 5 = low

        if($mail->Send()){
        	//echo "complete send mail";
            header("location:completeMail_for_resetMasterPassword.php");
                
        }  else {
            $word="Connection Error.";
            //echo ($word);
        ?>
            <script type="text/javascript">
                var strMessage = '<?=$word?>' ;// สร้างตัวแปรมารับก่อนนะครับ
                alert (strMessage + "\r\n SORRY! The system can't send OTP to you. \r\n");
            </script>
            <script language="JavaScript">window.location.href = "forgotPassword.html";</script>
        <?php

    	}
}

?>