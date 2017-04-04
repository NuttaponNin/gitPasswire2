<?php 
    session_start();
    @mysql_connect("localhost", "root", "");
    mysql_select_db("masteraccount");
    $emailAddress = $_SESSION['emailforotp'];
//    $strSQL = "SELECT * FROM `onetimepassword` WHERE email = '" . mysql_real_escape_string($emailAddress) . "'";
//    $objQuery = mysql_query($strSQL);
//    $objResult = mysql_fetch_array($objQuery);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <meta http-equiv="refresh" content="210"/>

    <title>Passwire Service</title>    
    
  </head>

  <body>        
      <form method="POST" action="otpcheck.php">
            <table>
                <tr>
                    <td>OTP : </td>
                 <td><input type='text' name='yourotp' /></td>
                </tr>
                <tr>
                 <td></td>
                    <td><input type='submit' value='submit' /></td>
               </tr>               
        </table> 
      </form>
      <p>
          <?php
          $data = mysql_query("SELECT * FROM `onetimepassword` WHERE email = '" . mysql_real_escape_string($emailAddress) . "'")
                                    or die(mysql_error());
          $startTime;
          while ($info = mysql_fetch_array($data)) {
            print_r($info['otp']);
            print "<br>";
            $startTime = $info['timeDate'];
            print_r($startTime);                     
           }
           print "<br>";
//           print_r($startTime);
           
           $dateTime = date_create_from_format('H:i:s', '00.00.00');
           date_default_timezone_set('Asia/Bangkok');
           $dateNow = date("Y-m-d");
           $timeNow = date("H:i:s");
           $nowTime = $dateNow." ".$timeNow;
           
           print "<br>";
//           $inputDate = "2011-09-09 15:25:40";
           $strCurrDate = strtotime($startTime);
           $limitTime = date("Y-m-d H:i:s", mktime(date("H",$strCurrDate)+0, date("i",$strCurrDate)+10, date("s",$strCurrDate)+0, date("m",$strCurrDate)+0  , date("d",$strCurrDate)+0, date("Y",$strCurrDate)+0));
//           $TimeEnd = date_add('Y-m-d H:i:s',date_interval_create_from_date_string("30 minutes"));
          echo ($limitTime);
           
           print "<br>";
           //add delete otp in else
           if($nowTime<$limitTime){
               print_r('OTP is active');
           }  else {
               print_r('OTP was deleted');
               $strDelOTPSQL = "DELETE FROM `onetimepassword` ";
               $strDelOTPSQL .="WHERE email = '" . $emailAddress . "' ";
               
               $objDelOTPSQL = mysql_query($strDelOTPSQL);
           }
           print "<br>";
           echo ($nowTime);
           print "<br>";
           echo ($timeNow);

//           print_r($tim);
//           $dateTime = date_create_from_format('H:i', $tim);
//           print_r($dateTime);
//           $timEnd = date_add($dateTime, date_interval_create_from_date_string('30 minutes'));
//           print_r($timEnd);
                                
?>                
</p>
  </body>
</html>