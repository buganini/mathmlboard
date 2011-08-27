<?php
$head="New Topic";
include_once("config.php");

$text=$_POST['text'];
$subject=$_POST['subject'];
$author=$_POST['author'];

$msg='<table><tr align="left"><td><form method="post" action="new.php"><a>Author:</a><input type="text" size="50" name="author" value="'.$_POST['author'].'" /><br /><a>Subject:</a><input type="text" size="50" name="subject" value="'.$subject.'" /><br /><textarea cols="70" rows="20" name="text">'.$text.'</textarea><br /><a>Password:</a><input type="password" size="20" name="pwd" /><br /><a>Verifying:</a><input type="password" size="20" name="pwd2" /><br /><input type="hidden" name="act" value="true" /><p style="text-align:center;"><input type="submit" /></p></form></td></tr></table>';

if(isset($_POST['act'])){
	if(strlen($subject)==0){adderror('Subject cannot be null!!');}
	if(strlen($author)==0){adderror('Author cannot be null!!');}
	if(strlen($text)==0){adderror('Content cannot be null!!');}
	if(strlen($_POST['pwd'])==0){adderror('Password cannot be null!!');}
	if($_POST['pwd']!=$_POST['pwd2']){adderror('Failed Verifying Password!!');}
}

if(count($err)==0 && isset($_POST['act'])){
	$r=mysql_query('select * from mathml_topic order by topic_id desc;');
	$e=mysql_fetch_object($r);
	$topic_id=$e->topic_id+1;
	mysql_query("insert into mathml_topic (topic_id, topic_subject) values ($topic_id, '".insql($subject)."');");
	mysql_query("insert into mathml_message (topic_id, message_id, message_text, message_pin, message_author, message_time) values (".$topic_id.", 1, '".insql($text)."', '".md5($_POST['pwd'])."', '".insql($author)."', ".(time()-date("Z")).");");
	header("location:view.php");
}else{
	head();
	error();
	echo $msg;
	tail();
}
?>