<?php

//**************************************
//**************************************
//**************************************
//**************************************

//**************THIS FILE***************
//***************NOT USED***************

//**************************************
//**************************************
//**************************************
//**************************************

?>
<?php session_start(); 
    if(!isset($_SESSION['username'])) {
        header('Location: index.html');
        die();
    }   
?>
<html>
    <head>
    </head>
    
        <?php
        $masterID = $_SESSION['masterID'];
//        $objConnect = mysql_connect("localhost", "root", "") or die("Error Connect to Database");
//        $objDB = mysql_select_db("masteraccount");
        include("connect.php");
        
        // $strMasterAccSQL = "DELETE FROM `masteraccount` ";
        // $strMasterAccSQL .="WHERE masterID = '" . $masterID . "' ";
        
        $strStoredNoteSQL = "DELETE FROM `storednote` ";
        $strStoredNoteSQL .="WHERE masterID = '" . $masterID . "' ";
        
        $strStoredPassSQL = "DELETE FROM `storedaccount` ";
        $strStoredPassSQL .="WHERE masterID = '" . $masterID . "' ";
        
        // $objQueryMasterAcc = mysql_query($strMasterAccSQL);
        $objQueryStoredNote = mysql_query($strStoredNoteSQL);
        $objQueryStoredPass = mysql_query($strStoredPassSQL);
        
        if ($objQueryMasterAcc || $objQueryStoredNote || $objQueryStoredPass) {
            header("location:logout.php");
        } else {
            header("location:home.php");
        ?>
        <script language="JavaScript">
            alert("Error Delete");
        </script>
        <?php
        }
        // mysql_close($objConnect);
        ?>
    
</html>