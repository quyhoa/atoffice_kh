<?php

function db_get_all($sql, $db){
	$result = mysql_query($sql, $db);
	while($item = mysql_fetch_assoc($result)){
		$rows[]=$item;
	}
	return $rows;

}
	require_once("../../at_office_config.php");

	global $mysql_addr;
	global $port;
	global $user;
	global $pass;

	$db = mysql_connect("$mysql_addr:$port", $user, $pass);
	if ($db == false)
	{
		print "sql connect error";
		exit(1);
	}

	mysql_query("SET NAMES 'utf8'");

	//var_dump($_REQUEST);

	session_start();
	$u = $_SESSION['u'];
	if(!$u){
		print "ログインしてください。";
		exit();
	}

	if($_REQUEST['sort1']){
		$sort1 = $_REQUEST['sort1'];
	}elseif($_REQUEST['amp;sort1']){
		$sort1 = $_REQUEST['amp;sort1'];
	}else{
		$sort1 = 0;
	}
	if($_REQUEST['sort2']){
		$sort2 = $_REQUEST['sort2'];
	}elseif($_REQUEST['amp;sort2']){
		$sort2 = $_REQUEST['amp;sort2'];
	}else{
		$sort2 = 1;
	}
	if($_REQUEST['sort3']){
		$sort3 = $_REQUEST['sort3'];
	}elseif($_REQUEST['amp;sort3']){
		$sort3 = $_REQUEST['amp;sort3'];
	}else{
		$sort3 = 0;
	}


?>

<body>





<form name="reserved_side" id="reserved_side">
<center>
<h2><center>検索オプション</center></h2>
<input type='radio' name="sort2" id='sort2' value=0 onClick="form_reserved(<?php print $u; ?>)" <?php if($sort2==0) print checked; ?>> 昇順　
<input type='radio' name="sort2" id='sort2' value=1 onClick='form_reserved(<?php print $u; ?>)' <?php if($sort2==1) print checked; ?>> 降順
<hr>
<input type='radio' name="sort1" id='sort1' value=0 onClick='form_reserved(<?php print $u; ?>)' <?php if($sort1==0) print checked; ?>> 申込日時順　
<input type='radio' name="sort1" id='sort1' value=1 onClick='form_reserved(<?php print $u; ?>)' <?php if($sort1==1) print checked; ?>> 利用日時順
<hr>

【予約状態】<br>
<table>
<tr>
<td>
<input type='radio' name="sort3" id='sort3' value=0 onClick='form_reserved(<?php print $u; ?>)' <?php if($sort3==0) print checked; ?>> すべて
</td><td>
<input type='radio' name="sort3" id='sort3' value=1 onClick='form_reserved(<?php print $u; ?>)' <?php if($sort3==1) print checked; ?>> 予約承認前
</td></tr>
<tr><td>
<input type='radio' name="sort3" id='sort3' value=2 onClick='form_reserved(<?php print $u; ?>)' <?php if($sort3==2) print checked; ?>> 未入金
</td><td>
<input type='radio' name="sort3" id='sort3' value=3 onClick='form_reserved(<?php print $u; ?>)' <?php if($sort3==3) print checked; ?>> 一部入金
</td></tr>
<tr><td>
<input type='radio' name="sort3" id='sort3' value=4 onClick='form_reserved(<?php print $u; ?>)' <?php if($sort3==4) print checked; ?>> 入金済み
</td><td>
<input type='radio' name="sort3" id='sort3' value=5 onClick='form_reserved(<?php print $u; ?>)' <?php if($sort3==5) print checked; ?>> 完了
</td></tr>
<tr><td>
<input type='radio' name="sort3" id='sort3' value=6 onClick='form_reserved(<?php print $u; ?>)' <?php if($sort3==6) print checked; ?>> キャンセル
</td></tr>
</table>
<hr>

</center>
</form>


</body>
