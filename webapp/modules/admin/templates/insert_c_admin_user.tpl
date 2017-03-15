({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminAdminConfig.tpl"})

({assign var="parent_page_name" value="アカウント管理"})
({capture name=parent_page_url})?m=({$module_name})&amp;a=page_({$hash_tbl->hash('list_c_admin_user')})({/capture})

({assign var="page_name" value="アカウント追加"})
({ext_include file="inc_tree_adminAdminConfig.tpl"})
</div>

({*ここまで:navi*})

<script type="text/javascript">
function Sel(){
	var obj=document.forms['admin_user'].elements['atoffice_auth_type'];
	if(obj[0].checked){
		document.getElementById('d1').style.display='none';
	}
	if(obj[1].checked){
		document.getElementById('d1').style.display='none';
	}
	if(obj[2].checked){
		document.getElementById('d1').style.display='block';
	}
	if(obj[3].checked){
		document.getElementById('d1').style.display='none';
	}
}
</script>


({if $msg})<p class="actionMsg">({$msg})</p>({/if})
<h2>アカウント追加</h2>
<div class="contents">

<p>管理用アカウントを追加することができます。</p>
<p class="caution" id="c01">※パスワードは6～12文字の半角英数で入力してください</p>
<form action="./" method="post" name="admin_user">
<table class="basicType1">
<tr>
<th>
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="do_({$hash_tbl->hash('insert_c_admin_user','do')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
アカウント名(メールアドレス)</th>
<td>
<input class="basic" type="hidden" name="username" value="foo_var" size="20" />
<input class="basic" type="text" name="mail_address" value="" size="20" />
</td>
</tr>
<tr>
<th>氏　名</th>
<td><input class="basic" type="text" name="full_name" value=""></td>
<tr>
<th>パスワード</th>
<td><input class="basic" type="password" name="password" value="" size="15" /></td>
</tr>
<tr>
<th>パスワード(確認)</th>
<td><input class="basic" type="password" name="password2" value="" size="15" /></td>
</tr>
<tr>
<th>権　限</th>
<td>
<input class="basic" type="hidden" name="auth_type" value="all">
<input class="basic" type="radio" name="atoffice_auth_type" value="1" onclick="Sel()" checked>初期設定担当者　
<input class="basic" type="radio" name="atoffice_auth_type" onclick="Sel()" value="2">予約受付担当者　
<input class="basic" type="radio" name="atoffice_auth_type" onclick="Sel()" value="3">準備担当者　
<input class="basic" type="radio" name="atoffice_auth_type" onclick="Sel()" value="4">管理者　
</td>
</tr>

</table>


<div id="d1" style="display:none;">
<table class="basicType1">
	<tr>
		<th rowspan="2" width=150>準備担当会場</th>		
	</tr>
	<tr>
		<td>【閲覧可能会場】</td>
		<td colspan="2">
			<ul class="address_add">
				({foreach from=$hall_list item=item})
					<li><label><input type="checkbox"  name="ad[]" value="({$item.hall_id})">({$item.hall_name})</label></li>
				({/foreach})
			</ul>
		</td>
	</tr>
</table>
</div>

<p class="textBtn"><input type="submit" value="追加する"></p>
</form>
<p class="groupLing"><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('list_c_admin_user')})">アカウント管理へ戻る</a></p>
({$inc_footer|smarty:nodefaults})

<style>
.address_add{
	margin-bottom: 10px;
}
.address_add li input[type="checkbox"]{
    display:inline-block;
    width:19px;
    height:19px;
    margin:-1px 4px 5px 0;
    vertical-align:middle;
    cursor:pointer;
}
.contents table.basicType1 td{
	border: 1px solid #A3A3A6;
}
</style>
