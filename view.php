<?php
//Variable filter
$page=isset($_GET['page'])?(int) $_GET['page']:1;

$head="Index";
include_once("config.php");
head();
echo '<table>
<tr><td style="text-align:right; width:540px;" colspan="3"><form method="get" action="view.php" style="margin:0px"><input type="text" name="page" value="'.$page.'/'.ceil(mysql_num_rows(mysql_query('select topic_id from mathml_topic;'))/$tpp).'" style="width:50px;" /><input type="submit" value="Go" /></form></td></tr>';
echo '<tr style="background:#aabbff; text-align:center;"><td style="width:70px;">ID</td><td style="width:400px;">Subject</td><td style="width:70px;">Message</td></tr>';
$res=mysql_query('select * from mathml_topic order by topic_id asc limit '.($page-1)*$tpp.','.$tpp.';');
$msg='';
while($e=mysql_fetch_object($res)){
$msg='
<tr><td style="background:#ccddff; text-align:center;">'.$e->topic_id.'</td><td style="background:#ffffcc; text-align:left;"><a href="read.php?topic_id='.$e->topic_id.'">'.$e->topic_subject.'</a></td><td style="background:#ccddff; text-align:center;">'.mysql_num_rows(mysql_query('select message_id from mathml_message where topic_id = '.$e->topic_id.';')).'</td></tr>'.$msg;
}
echo $msg;
echo '</table>';
tail();
?>