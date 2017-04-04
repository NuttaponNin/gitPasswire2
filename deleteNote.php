<html>
    <head>
    </head>
    
        <?php
//        $objConnect = mysql_connect("localhost", "root", "") or die("Error Connect to Database");
//        $objDB = mysql_select_db("masteraccount");
        include("connect.php");
        $strSQL = "DELETE FROM `storednote` ";
        $strSQL .="WHERE noteID = '" . $_GET['noteID'] . "' ";
        $objQuery = mysql_query($strSQL);
        if ($objQuery) {
            header("location:wipeNote.php");
        } else {
            header("location:wipeNote.php");
        ?>
        <script language="JavaScript">
            alert("Error Delete");
        </script>
        <?php
        }
        mysql_close($objConnect);
        ?>
    
</html>