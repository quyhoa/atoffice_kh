({*権限チェック*})
({if $atoffice_auth_type==2 or $atoffice_auth_type==4})

<script language="javascript">
<!--
function new_win(reserve_id){
window.open("./?m=admin&a=page_mail_check&reserve_id="+reserve_id,"","width=350,height=300,scrollbars=yes");
}

function confirm1(){
	if(window.confirm('送信せずに閉じてもよろしいですか？')){
		window.close();
	}else{
		return false;
	}
}


//-->
</script>

<STYLE TYPE=text/css><!-- BODY{FILTER: progid:DXImageTransform.Microsoft.Gradient(startColorstr=#FFFFFF, endColorstr=#A9A9A9, gradienttype=0)}--></STYLE>

<h2 id="ttl01">承認メール確認 </h2>
<br>

<center>
({if $msg})
({$msg})<br><br>
<input type="button" value="閉じる" onClick="window.close();">
({else})
<form name="send_mail" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="do_({$hash_tbl->hash('a_send_mail','do')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />


<table border=1>
<tr>
<td bgcolor="#CCFFAA">件名</td>
<td bgcolor="#FFFFFF">
<input type="text" name="subject" value="({$subject})" size=80>
</td>
</tr>
<tr>
<td bgcolor="#CCFFAA">宛先</td>
<td bgcolor="#FFFFFF">
<input type="text" name="mail" value="({$mail}),({$ml})" size=80>
(カンマ区切り)
</td>
</tr>
<tr>
<td bgcolor="#CCFFAA">本文</td>
<td bgcolor="#FFFFFF">
<textarea id="mce_editor_textarea" name="body" rows="({$_rows|default:'35'})" cols="({$_cols|default:'85'})">({$body})</textarea>
</td>
</tr>
</table>

<br>

<input type="submit" value="　送　信　">

</from>

<input type="button" value="送信せずに閉じる" onClick="return confirm1();">
({/if})
</center>
({else})
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
({/if})
