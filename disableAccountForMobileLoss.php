<?php
session_start();
//@mysql_connect("localhost", "root", "");
//mysql_select_db("masteraccount");
include("connect.php");
$email = $_SESSION['emailforotp'];
$master_id = $_SESSION['idTable'];

               // $strDelOTPSQL = "DELETE FROM `onetimepassword` ";
               // $strDelOTPSQL .="WHERE email = ".$email."";
        
               //  $strStoredNoteSQL = "DELETE FROM `storednote` ";
               //  $strStoredNoteSQL .="WHERE accountID = ".$id."";
        
               //  $strStoredPassSQL = "DELETE FROM `storedaccount` ";
               //  $strStoredPassSQL .="WHERE accountID = '".$id."' ";
        
               // $objDelOTPSQL = mysql_query($strDelOTPSQL);
               
               // $objQueryStoredNote = mysql_query($strStoredNoteSQL);
               // $objQueryStoredPass = mysql_query($strStoredPassSQL);
        
                // if ($objDelOTPSQL || $objQueryStoredNote || $objQueryStoredPass) {
                //     header("location:logout.php");
                // } else {
                // header("location:enterOTP.php");
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
    mysql_close();
?>