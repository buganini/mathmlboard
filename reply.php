<?php
$head="Reply";
include_once("config.php");

//Variable filter
$topic_id=(int) $_GET['topic_id'];
$text=$_POST['text'];
$author=$_POST['author'];

$msg='<table><tr style="text-align:left;"><td><form method="post" action="reply.php?topic_id='.$topic_id.'"><a>Author:</a><input type="text" size="50" name="author" value="'.$author.'" /><br /><textarea cols="70" rows="20" name="text">'.$text.'</textarea><br /><a>Password:</a><input type="password" size="20" name="pwd" /><br /><a>Verifying:</a><input type="password" size="20" name="pwd2" /><br /><input type="hidden" name="act" value="true" /><p style="text-align:center;"><input type="submit" /></p></form></td></tr></table>';

if(isset($_POST['act'])){
	if(strlen($author)==0){adderror('Author cannot be null!!');}
	if(strlen($text)==0){adderror('Content cannot be null!!');}
	if(strlen($_POST['pwd'])==0){adderror('Password cannot be null!!');}
	if($_POST['pwd']!=$_POST['pwd2']){adderror('Failed Verifying Password!!');}
}

$r=mysql_query('select * from mathml_message where topic_id = '.$topic_id.' order by message_id desc;');
$e=mysql_fetch_object($r);
$message_id=$e->message_id+1;
if(mysql_num_rows(mysql_query('select * from mathml_topic where topic_id = '.$topic_id.';'))==0){
	adderror('Critical error: The topic was deleted when you were replying.');
	adderror('You can create a new topic or quit.');
	include("new.php");	
}elseif(count($err)==0 && isset($_POST['act'])){
	$r=mysql_query('select * from mathml_message where topic_id = '.$topic_id.' order by message_id desc;');
	$e=mysql_fetch_object($r);
	$message_id=$e->message_id+1;
	mysql_query("insert into mathml_message (topic_id, message_id, message_text, message_pin, message_author, message_time) values (".$topic_id.", ".$message_id.", '".insql($text)."', '".md5($_POST['pwd'])."', '".insql($author)."', ".(time()-date("Z")).");");
	header("location:read.php?topic_id=".$topic_id);
}else{
	head();
	error();
	echo $msg;
	tail();
}
?>