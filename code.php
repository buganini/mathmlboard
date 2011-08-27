<?php
$head="View Code";
include_once("config.php");

//Variable filter
$topic_id=(int) $_GET['topic_id'];
$message_id=(int) $_GET['message_id'];

$r=mysql_query('select * from mathml_message where topic_id = '.$topic_id.' and message_id = '.$message_id.';');
$e=mysql_fetch_object($r);
head();
echo '<h2>View Code</h2><table><tr align="left"><td>';
echo '<textarea cols="70" rows="20">'.$e->message_text.'</textarea><br /><p align="center"><a href="read.php?topic_id='.$topic_id.'">Back</a></p></td></tr></table>';
tail();
?>