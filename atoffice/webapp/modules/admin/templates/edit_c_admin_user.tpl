({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminAdminConfig.tpl"})

({assign var="parent_page_name" value="アカウント管理"})
({capture name=parent_page_url})?m=({$module_name})&amp;a=page_({$hash_tbl->hash('list_c_admin_user')})({/capture})

	({assign var="page_name" value="アカウント追加"})
	({ext_include file="inc_tree_adminAdminConfig.tpl"})
</div>
<script type="text/javascript">
function Sel(){
	var obj=document.forms['admin_user'].elements['atoffice_auth_type'];
	if(obj[0].checked){
		document.getElementById('d1').style.display='none';
		document.getElementById('d2').style.display='none';
	}
	if(obj[1].checked){
		document.getElementById('d1').style.display='none';
		document.getElementById('d2').style.display='none';
	}
	if(obj[2].checked){
		var check = document.getElementById('d2');
		if(check === null){	
			document.getElementById('d1').style.display = 'block';
		}
		document.getElementById('d2').style.display = 'block';
	}
	if(obj[3].checked){
		document.getElementById('d1').style.display='none';
		document.getElementById('d2').style.display='none';
	}
}	
</script>
({*ここまで:navi*})
({if $msg})<p class="actionMsg">({$msg})</p>({/if})
<h2>編集</h2>
<div class="contents">
({foreach from=$info_admin item=item})
<form action="./" method="post" id="admin_user" name="admin_user">
	<table class="basicType1">
		<tr>
			<th>アカウント名
				<input type="hidden" name="m" value="({$module_name})" />
				<input type="hidden" name="a" value="do_({$hash_tbl->hash('edit_c_admin_user','do')})" />
				<input type="hidden" name="sessid" value="({$PHPSESSID})" />				
			</th>
			<td>
				<input type="text" name="username_acc" value="({$item.username})">
			</td>
		</tr>
		<tr>
			<th>氏　名</th>
			<td><input type="text" name="name_acc" value="({$item.name})"></td>
		</tr>
		<tr>
			<th>権限</th>
			<td>
			<input type = "hidden" name="check_type" value=({$item.atoffice_auth_type})>
			<input class="basic" type="hidden" name="auth_type" value="all">
			<input class="basic" type="radio" name="atoffice_auth_type" ({if $item.atoffice_auth_type=='1'}) checked ({/if}) onclick="Sel()" value="1">初期設定担当者　
			<input class="basic" type="radio" name="atoffice_auth_type" ({if $item.atoffice_auth_type=='2'}) checked ({/if}) onclick="Sel()" value="2">予約受付担当者　
			<input class="basic" type="radio" id ="check" name="atoffice_auth_type" ({if $item.atoffice_auth_type=='3'}) checked ({/if}) onclick="Sel()" value="3">準備担当者　
			<input class="basic" type="radio" name="atoffice_auth_type" ({if $item.atoffice_auth_type=='4'}) checked ({/if}) onclick="Sel()" value="4">管理者
			</td>
		</tr>
		<input type ="hidden" name ="hall_id" value="({$hall_id})"/>
		<input type ="hidden" name ="c_admin_user_id" value="({$item.c_admin_user_id})"/>
		({/foreach})
	</table>
({if $item.atoffice_auth_type =='3'})
<div id = "d2" style="display: block">
<table class="basicType1">
	<tr>
		<th rowspan="2" width=150>準備担当会場</th>
		<td>
			【閲覧可能会場】
		</td>
		<td>
			<ul class="address_add">				
				({foreach from=$hall_list item=item})									
					<li>							
						<label>
							<input  type="checkbox" name="ad1[]" ({foreach from=$list_hall_id item=foo}) id="t({$item.hall_id})" onclick="checkChecked(({$item.hall_id}))" ({if $foo == $item.hall_id})checked({/if}) ({/foreach}) value="({$item.hall_id})">({$item.hall_name})
						</label>
					</li>						
				({/foreach})
			</ul>
		</td>
	</tr>
</table>
</div>
({/if})
<div id="d1" style="display: none">
<table class="basicType1">
	<tr>
		<th rowspan="2" width=150>準備担当会場</th>
		<td>
			【閲覧可能会場】
		</td>
		<td>
			<ul class="address_add">				
				({foreach from=$hall_list item=item})									
					<li>							
						<label>
							<input type="checkbox" name="ad[]" ({foreach from=$list_hall_id item=foo}) ({if $foo == $item.hall_id})checked({/if}) ({/foreach}) value="({$item.hall_id})">({$item.hall_name})
						</label>
					</li>						
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
<script type="text/javascript">
	function checkChecked(id){
		if(document.getElementById("t"+id).hasAttribute('checked')) {
			document.getElementById("t"+id).removeAttribute('checked');
		}
	}
</script>
