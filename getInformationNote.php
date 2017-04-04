<?php
// Connects to your Database
$noteID = $_GET['noteID'];
include("connect.php");

$data = mysql_query("SELECT * FROM `storednote` WHERE noteID = '"
                    . mysql_real_escape_string($noteID) . "'")
                      or die(mysql_error());
while ($info = mysql_fetch_array($data)) {
echo '<tr>';
echo '<td>'.$info['title'].'</td>';
echo '<td>'.$info['content'].'</td>';
echo '<td>'.$info['description'].'</td>';
echo '<td>'.$info['updateDate'].'</td>';
echo '</tr>';
}
?>