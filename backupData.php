<?php
    session_start();
        

    $email = $_SESSION['emailforotp'];
    $accID_table_masteracc;            

    require "connect.php";
    include ("cryptographyinitforweb.php");
    $masterID;
    $masterID = $_SESSION['masterID'];
    $key = makeKey($masterID);

    $name;

    $data_masteraccount = mysql_query("SELECT * FROM `masteraccount` WHERE email = '"
        . mysql_real_escape_string($email) . "'")
          or die(mysql_error());

    $id_table_masteracc = mysql_query("SELECT masterID FROM `masteraccount` WHERE email = '" 
                      . mysql_real_escape_string($email) . "'") or die(mysql_error());
    
    while ($info = mysql_fetch_array($id_table_masteracc)) {            
            $accID_table_masteracc = $info['masterID'];            
        }
        
    $id_table_masteracc = mysql_query("SELECT name FROM `masteraccount` WHERE email = '" 
                      . mysql_real_escape_string($email) . "'") or die(mysql_error());

    while ($info = mysql_fetch_array($id_table_masteracc)) {            
            $name = $info['name'];            
        }
    $_SESSION['idTable'] = $accID_table_masteracc;
    $topic = "Passwire Data Backup<br><br>";
//    print_r("Passwire Data Backup");
//    echo ($topic);
    $content1 = "";
    while ($info = mysql_fetch_array($data_masteraccount)) {
        //$decrypted_email = openssl_decrypt($info['email'],"AES-256-CBC",$key, 0, $iv);
        //$decrypted_name = openssl_decrypt($info['name'],"AES-256-CBC",$key, 0, $iv);
        //$decrypted_masterUsername = openssl_decrypt($info['masterUsername'],"AES-256-CBC",$key, 0, $iv);
        //$decrypted_masterPassword = openssl_decrypt($info['masterPassword'],"AES-256-CBC",$key, 0, $iv);
//        print_r($accID_table_masteracc);
//        echo '<br>';
        $newPass = strtoupper(bin2hex(openssl_random_pseudo_bytes(4)));
        //hash
        $hash_newPass = passwordHash($newPass);

        $updatePass = "UPDATE masteraccount SET masterTextPassword = '" .$hash_newPass. "' WHERE email = '" . $email . "'";
        mysql_query($updatePass);

        $content1 = $content1 . "Email : " . $info['email'] . "<br>";
//        print_r("Email : " . $info['email']);
//        echo '<br>';
        $content1 = $content1 . "Name : " . $info['name'] . "<br>";
//        print_r("Name : " . $info['name']);
//        echo '<br>';
        $content1 = $content1 . "New Text Password : " . $newPass . "<br>";
//        print_r("Master Username : " . $info['masterUsername']);
//        echo '<br>';
        //$content1 = $content1 . "Master Password : " . $decrypted_masterPassword . "<br>";
//        print_r("Master Password : " . $info['masterPassword']);
//        echo '<br>';
        $content1 = $content1 . "-----------------------------------------------------------------------------------------------------------<br>";
//        print_r("-----------------------------------------------------------------------------------------------------------");
//        echo '<br>';
    }
//    echo ($content1);

    $data_storedpassword = mysql_query("SELECT * FROM `storedaccount` WHERE masterID = '"
        . mysql_real_escape_string($accID_table_masteracc) . "'")
            or die(mysql_error());
    $count_storepassword = 1;
    $content2 = "";
    while ($info = mysql_fetch_array($data_storedpassword)) {

        $decrypted_title = openssl_decrypt($info['title'],"AES-256-CBC",$key, 0, $iv);
        $decrypted_username = openssl_decrypt($info['username'],"AES-256-CBC",$key, 0, $iv);
        $decrypted_password = openssl_decrypt($info['password'],"AES-256-CBC",$key, 0, $iv);
        $decrypted_description = openssl_decrypt($info['description'],"AES-256-CBC",$key, 0, $iv);


        $content2 = $content2 . "<br>Stored Password_" . $count_storepassword . "<br>";
//        echo '<br>';
//        print_r("Stored Password_" . $count_storepassword);
//        echo '<br>';
        $content2 = $content2 . "Title : " . $decrypted_title . "<br>";
//        print_r("Title : " . $info['title']);
//        echo '<br>';
        $content2 = $content2 . "Username : " . $decrypted_username . "<br>";
//        print_r("Username : " . $info['username']);
//        echo '<br>';
        $content2 = $content2 . "Password : " . $decrypted_password . "<br>";
//        print_r("Password : " . $info['password']);
//        echo '<br>';
        $content2 = $content2 . "Dascription : " . $decrypted_description . "<br>";
//        print_r("Dascription : " . $info['description']);
//        echo '<br>';
        $content2 = $content2 . "Update : " . $info['updateDate'] . "<br>";
//        print_r("Update : " . $info['updateDate']);
//        echo '<br>';
        $count_storepassword = $count_storepassword+1;
//        echo '<br>';
//        print_r("-----------------------------------------------------------------------------------------------------------");                          
    }
    $countT = "-----------------------------------------------------------------------------------------------------------<br>";
//    print_r("-----------------------------------------------------------------------------------------------------------");
//    echo '<br>';
    $content2 = $content2.$countT;
//    echo ($content2);
    
    $data_storednote = mysql_query("SELECT * FROM `storednote` WHERE masterID = '"
        . mysql_real_escape_string($accID_table_masteracc) . "'")
            or die(mysql_error());
    $count_storenote = 1;
    $content3 = "";
    while ($info = mysql_fetch_array($data_storednote)) {
        $decrypted_title = openssl_decrypt($info['title'],"AES-256-CBC",$key, 0, $iv);
        $decrypted_description = openssl_decrypt($info['description'],"AES-256-CBC",$key, 0, $iv);
        $decrypted_content = openssl_decrypt($info['content'],"AES-256-CBC",$key, 0, $iv);

        $content3 = $content3 . "<br>Stored Note_" . $count_storenote . "<br>";
//        echo '<br>';
//        print_r("Stored Note_" . $count_storenote);
//        echo '<br>';
        $content3 = $content3 . "Title : " . $decrypted_title . "<br>";
//        print_r("Title : " . $info['title']);
//        echo '<br>';
        $content3 = $content3 . "Content : " . $decrypted_description . "<br>";
//        print_r("Content : " . $info['content']);
//        echo '<br>';
        $content3 = $content3 . "Dascription : " . $decrypted_content . "<br>";
//        print_r("Dascription : " . $info['description']);
//        echo '<br>';
        $content3 = $content3 . "Update : " . $info['updateDate'] . "<br>";
//        print_r("Update : " . $info['updateDate']);
//        echo '<br>';
        $count_storenote = $count_storenote+1;
//        echo '<br>';
//        print_r("-----------------------------------------------------------------------------------------------------------");                          
    }
//    print_r("-----------------------------------------------------------------------------------------------------------");
    $content3 = $content3.$countT;
    $fullContent = $content1.$content2.$content3;
//    echo ($fullContent);
            
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
    $mail->Subject = "Backup Data mail by Passwire Web Service."; 
    $mail->Body = $topic . "<p> Your Data Backup : <b><br>" . $fullContent . "</b></p>";

    // $mail->AddAddress("nuttapon.kmitl@gmail.com", "Mr.Nuttapon"); // to Address
    $mail->AddAddress($email, $name); // to Address user
    //$mail-->AddAddress("email user","user name")

    //$mail->AddAttachment("thaicreate/myfile.zip");
    //$mail->AddAttachment("thaicreate/myfile2.zip");

    //$mail->AddCC("member@thaicreate.com", "Mr.Member ShotDev"); //CC
    //$mail->AddBCC("member@thaicreate.com", "Mr.Member ShotDev"); //CC

    $mail->set('X-Priority', '1'); //Priority 1 = High, 3 = Normal, 5 = low

    if($mail->Send()){
        $word="send mail complate ";
        
            /*<script type="text/javascript">
                var strMessage = '<?=$word?>' ;// สร้างตัวแปรมารับก่อนนะครับ
                alert (strMessage + "\r\n Please Check Your Email. \r\n");
            </script>
            <script language="JavaScript">window.location.href = "disableAccountForMobileLoss.php";</script>*/
        header('Location: disableAccountForMobileLoss.php');
    }
    

mysql_close();
?>