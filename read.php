<?php
include_once("config.php");

//Variable filter
$topic_id=(int) $_GET['topic_id'];
$page=isset($_GET['page'])?(int) $_GET['page']:1;

if(empty($_GET['safe_mode'])){header("Content-type:text/xml; charset=utf-8");}
$r=mysql_query('select * from mathml_topic where topic_id = '.$topic_id.';');
$e=mysql_fetch_object($r);
$head=$e->topic_subject;
head();

echo '<table><tr><td style="text-align:left; width:70px;"><a href="reply.php?topic_id='.$topic_id.'">[Reply]</a></td><td colspan="2" style="text-align:right; width:670px;"><form method="get" action="read.php" style="margin:0px"><input type="text" name="page" value="'.$page.'/'.ceil(mysql_num_rows(mysql_query('select message_id from mathml_message where topic_id = '.$topic_id.';'))/$mpp).'" style="width:50px;" /><input type="hidden" name="topic_id" value="'.$topic_id.'" /><input type="submit" value="Go" /></form></td></tr></table><table style="background:#7788aa"><tr bgcolor="#aabbff"><td style="text-align:center; width:70px;">ID</td><td style="text-align:center; width:600px;">Content</td><td style="text-align:center; width:70px;">Process</td></tr>';

$msg='';

$r=mysql_query('select * from mathml_message where topic_id = '.$topic_id.' order by message_id asc limit '.($page-1)*$mpp.','.$mpp.';');
while($e=mysql_fetch_object($r)){
$msg='
<tr><td style="text-align:center; width:70px; background:#ccddff;">'.$e->message_id.'</td><td style="text-align:left; background:#ffffcc;"><a name="m'.$e->message_id.'"></a>Author: '.$e->message_author.'&nbsp;&nbsp;&nbsp;at&nbsp;&nbsp;&nbsp;'.strftime("%H:%M:%S&nbsp;%m/%d/%Y&nbsp;".$zone,$e->message_time+$diff).'<hr />'.tran($e->message_text).'<br /><p align="right"><a href="code.php?topic_id='.$e->topic_id.'&amp;message_id='.$e->message_id.'">[view code]</a></p></td><td align="center" width="70" bgcolor="#ccddff"><a href="edit.php?topic_id='.$e->topic_id.'&amp;message_id='.$e->message_id.'">Edit</a><br /><a href="delete.php?topic_id='.$e->topic_id.'&amp;message_id='.$e->message_id.'">Delete</a><br /></td></tr>'.$msg;
}
echo $msg;
echo '</table>';
tail();
?>