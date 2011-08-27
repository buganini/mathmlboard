<?php
//system core
	#Database
	$dbhost="localhost";
	$dbuser="mathml";
	$dbpwd="password";
	$dbname="mathml";

	#Administrator
	$rootpwd="cc03e747a6afbbcbf8be7668acfebee5";	//default: "test123" encrypted by md5()

	#Time zone
	$zone="CST";	//Time zone
	$diff=28800;	//Time difference
	
//display setting
	#topic per page
	$tpp=10;

	#message per page
	$mpp=15;

//apppearence
	#page title
	$title="Bug's MathML Board";
	#CSS
	$css='body{background:url(back.gif); background-attachment:fixed;}
	a{text-decoration:none;}
	a:hover{text-decoration:underline;}
	img{border:0}
	';

//MySQL connection
	$dbconn=mysql_connect($dbhost,$dbuser,$dbpwd);
	mysql_select_db($dbname);

function head(){
	global $title,$css,$head;
	echo '<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1 plus MathML 2.0//EN"  "http://www.w3.org/Math/DTD/mathml2/xhtml-math11-f.dtd">
<?xml-stylesheet type="text/xsl" href="mathml.xsl"?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/xml; charset=UTF-8" />
<title>'.$title.'</title>
<style type="text/css">
'.$css.'
</style>
</head>
<body>
<div style="text-align:center;">
<h1>'.$title.'</h1>
<h2>'.$head.'</h2>';
}

function tail(){
	global $dbconn;
	echo '
</div><hr />
<p style="text-align:center;"><a href="view.php">Index</a>&nbsp;&nbsp;<a href="new.php">New Topic</a>&nbsp;&nbsp;<a href="help.php">Help</a></p>
<hr />
<p style="text-align:center;"><a href="http://www.mysql.com" target="_blank"><img src="mysql.png" alt="Powered by MySQL" /></a> &nbsp; &nbsp; <a href="http://www.apache.org/" target="_blank"><img src="apache.png" alt="Powered by Apache 2.0" /></a> &nbsp; &nbsp; <a href="http://www.freebsd.org" target="_blank"><img src="freebsd.png" alt="Powered by FreeBSD" /></a></p>
<hr />
<p style="text-align:right;">Designed by <a href="mailto:gmobug@gmobug.twbbs.org">G.M.O. Bug</a></p>
</body>
</html>';
	mysql_close($dbconn);
}

function adderror($error){
	global $err;
	$err[count($err)]=$error;
}

function error(){
	global $err;
	for($i=0;$i<count($err);$i++){
		echo '<p style="text-align:center; color:#ff0000;">'.$err[$i].'</p>';
	}
}

function insql($text){
	return str_replace('<_BR_>',"\n",mysql_real_escape_string(stripslashes(str_replace("\n",'<_BR_>',str_replace("\r","",$text)))));
}

function striptag($text,$stag){
	for($i=0;$i<count($stag);$i++){
		$text=ereg_replace("<".$stag[$i]."[^<]*>[^<>]*</".$stag[$i].">",'',$text);
		$text=ereg_replace("<".$stag[$i]."[^<]*>",'',$text);
		$text=ereg_replace("</".$stag[$i].">",'',$text);
	}
	return $text;
}

function tran($text){
	$text=ereg_replace("<[^<> /]+:([^>]+)","<\\1",$text);
	$text=ereg_replace("</[^<> ]+:([^>]+)","</\\1",$text);
	$text=ereg_replace("<!\-\-[^<>]*\-\->",'',$text);
	$text=striptag($text,array("semantics","annotation"));
	$text=ereg_replace("<math[^<>]*>",'<math>',$text);
	preg_match_all("/<math>.*?<\/math>/is",$text,$tmp);
	for($i=0;$i<count($tmp[0]);$i++){
		$text=str_replace($tmp[0][$i],"[#_".$i."_#]",$text);
	}
	$text=str_replace('<','&lt;',$text);
	$text=str_replace('>','&gt;',$text);
	$text=str_replace("\n","<br />",$text);
	for($i=0;$i<count($tmp[0]);$i++){
		$text=str_replace("[#_".$i."_#]",$tmp[0][$i],$text);
	}
	preg_match_all("/\[img\].*?\[\/img\]/is",$text,$tmp);
	for($i=0;$i<count($tmp[0]);$i++){
		$text=str_replace($tmp[0][$i],str_replace('<br />','',$tmp[0][$i]),$text);
	}
	preg_match_all("/\[link\].*?\[\/link\]/is",$text,$tmp);
	for($i=0;$i<count($tmp[0]);$i++){
		$text=str_replace($tmp[0][$i],str_replace('<br />','',$tmp[0][$i]),$text);
	}
	$text=str_replace('<math>','<math xmlns="http://www.w3.org/1998/Math/MathML">',$text);
	$text=str_replace('[padding]','<p></p>',$text);
	$text=ereg_replace("\[img\](.*)\[/img\]","<img src=\"\\1\" />",$text);
	$text=ereg_replace("\[link\](.*)\[/link\]","<a href=\"\\1\" target=\"_blank\">\\1</a>",$text);
	return $text;
}
?>