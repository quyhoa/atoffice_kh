({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminStatisticalInformation.tpl"})

({assign var="page_name" value="予約削除"})
({ext_include file="inc_tree_adminStatisticalInformation.tpl"})
</div>

({*ここまで:navi*})
({*権限チェック*})
({if $atoffice_auth_type==4})

<script type="text/javascript">
function confirm1(){
	if(window.confirm('予約を削除しますか？')){
		return;
	}else{
		return false;
	}
}
</script>

({if $msg})<p class="actionMsg">({$msg})</p>({/if})
<h2>予約削除</h2>
<div class="contents">
<p class="info">予約データを削除します。</p>
<p class="info">カンマ区切りで複数予約を同時に削除できます。</p>
ハイフン（-）を入れて範囲を指定できます。<br>
<br>
以下は同じ動作です。<br>
<span style="font-size:20px;color:#FF0000;"><b>1,2,3,4,5</b></span>　　=　　
<span style="font-size:20px;color:#00AA00;"><b>1,2-4,5</b></span>　　=　　
<span style="font-size:20px;color:#0000FF;"><b>1-5</b><br></span>
<br>



<form action="./" onSubmit="Javascript:return confirm1();" method="post" enctype="multipart/form-data">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="do_({$hash_tbl->hash('delete_reserve','do')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />

<table class="basicType2">
({capture name="table_header"})
<tr>
<th>削除対象予約ID</th>
<th>操作</th>
</tr>
<tr>
<td>
<input type="text" name="delete_id" value="" size=80>
</td>
<td>
<p class="textBtn"><input type="submit" class="submit" value="　削　除　" /></p
</td>
</tr>
</table>
</form>

({else})
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
({/if})
<div>
({$inc_footer|smarty:nodefaults})