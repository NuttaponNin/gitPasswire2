<?php
// Connects to your Database
$accountID = $_GET['accountID'];
include("connect.php");

$data = mysql_query("SELECT * FROM `storedaccount` WHERE accountID = '"
                    . mysql_real_escape_string($accountID) . "'")
                      or die(mysql_error());
while ($info = mysql_fetch_array($data)) {
echo '<tr>';
echo '<td>'.$info['title'].'</td>';
echo '<td>'.$info['username'].'</td>';
echo '<td>'.$info['password'].'</td>';
echo '<td>'.$info['description'].'</td>';
echo '<td>'.$info['updateDate'].'</td>';
echo '</tr>';
}
?>