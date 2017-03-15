<?php

	$kanban = stripslashes(trim($_REQUEST['kanban']));
	// エスケープしていたシングルクォートがあったら元に戻す
//	$kanban = ereg_replace("\\\'", '\'', $kanban);


?>

<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<TITLE>看板印刷</TITLE>

</HEAD>
<BODY>
<center>
<table width=990 height=700>
<tr>
<td>
<div  style='font-size:100px;text-align:left;vertical-align:middle;'>
<?php
//	echo "[$kanban]<br>";
	print nl2br($kanban);
?>
</div>
</td>
</tr>
</table>
</center>
</BODY>
</HTML>