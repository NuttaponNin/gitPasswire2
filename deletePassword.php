<html>
    <head>
    </head>
    
        <?php

        include("connect.php");
        $strSQL = "DELETE FROM `storedaccount` ";
        $strSQL .="WHERE accountID = '" . $_GET['passDataId'] . "' ";
        $objQuery = mysql_query($strSQL);
        if ($objQuery) {
            header("location:wipePassword.php");
        } else {
            header("location:wipePassword.php");
        ?>
        <script language="JavaScript">
            alert("Error Delete");
        </script>
        <?php
        }
        mysql_close($objConnect);
        ?>
    
</html>

