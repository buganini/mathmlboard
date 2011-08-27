<?php
$head="Edit";
include_once("config.php");

//Variable filter
$message_id=(int) $_GET['message_id'];
$topic_id=(int) $_GET['topic_id'];
$text=$_POST['text'];
$subject=$_POST['subject'];
$author=$_POST['author'];

$r=mysql_query('select * from mathml_message where topic_id = '.$topic_id.' and message_id = '.$message_id.';');
$q=mysql_query('select * from mathml_topic where topic_id = '.$topic_id.';');
$e=mysql_fetch_object($r);
$k=mysql_fetch_object($q);

if(isset($_POST['act'])){
	if($message_id==1 && strlen($subject)==0){adderror('Subject cannot be null!!');}
	if(strlen($author)==0){adderror('Author cannot be null!!');}
	if(strlen($text)==0){adderror('Content cannot be null!!');}
	if(md5($_POST['pwd'])!=$e->message_pin && md5($_POST['pwd'])!=$rootpwd){adderror('Incorrect Password!!');}
	if($_POST['pw']!=$_POST['pw2']){adderror('Failed Verifying Password!!');}
}

$msg='<table><tr style="text-align:left;"><td><form method="post" action="edit.php?topic_id='.$topic_id.'&amp;message_id='.$message_id.'"><a>Password:</a><input type="password" size="20" name="pwd" /><br /><a>Author:</a><input type="text" size="50" name="author" value="'.(isset($_POST['act'])?$_POST['author']:$e->message_author).'" /><br />'.($message_id==1?'<a>Subject:</a><input type="text" size="50" name="subject" value="'.(isset($_POST['act'])?($subject):$k->topic_subject).'" /><br />':'').'<textarea cols="70" rows="20" name="text">'.(isset($_POST['act'])?($text):$e->message_text).'</textarea><br /><a>Password:</a><input type="password" size="20" name="pw" /><a>Keep blank for no change</a><br /><a>Verifying:</a><input type="password" size="20" name="pw2" /><input type="hidden" name="act" value="true" /><p style="text-align:center;"><input type="submit" /></p></form></td></tr></table>';

if(count($err)==0 && isset($_POST['act'])){
	$pwd=strlen($_POST['pw'])>0?md5($_POST['pw']):$e->message_pin;
	mysql_query("update mathml_message set message_text='".insql($text)."', message_pin='".$pwd."', message_author='".insql($author)."' where topic_id = ".$topic_id." and message_id = ".$message_id.";");
	if($message_id==1){mysql_query("update mathml_topic set topic_subject='".insql($subject)."' where topic_id = ".$topic_id.";");}
	header("location:read.php?topic_id=".$topic_id);
}else{
	head();
	error();
	echo $msg;
	tail();
}
?>