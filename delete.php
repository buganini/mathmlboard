<?php
$head="Delete";
include_once("config.php");

//Variable filter
$topic_id=(int) $_GET['topic_id'];
$message_id=(int) $_GET['message_id'];

$r=mysql_query('select message_pin from mathml_message where topic_id = '.$topic_id.' and message_id = '.$message_id.';');
$e=mysql_fetch_object($r);

$msg='<form method="post" action="delete.php?topic_id='.$topic_id.'&amp;message_id='.$message_id.'"><a>Password required:</a><input type="password" name="pwd" /><input type="hidden" name="act" value="TRUE" /><input type="submit" /></form>';

if(md5($HTTP_POST_VARS['pwd'])!=$e->message_pin && md5($HTTP_POST_VARS['pwd'])!=$rootpwd){
	head();
	error();
	echo $msg;
	tail();
}else{
	mysql_query('delete from mathml_message where topic_id = '.$topic_id.' and message_id = '.$message_id.';');
	if(mysql_num_rows(mysql_query('select * from mathml_message where topic_id = '.$topic_id.';'))==0){mysql_query('delete from mathml_topic where topic_id = '.$topic_id.';');}
	header("location:view.php");
}
?>