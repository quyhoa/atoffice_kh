({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminStatisticalInformation.tpl"})

({assign var="page_name" value="アカウント管理"})
({ext_include file="inc_tree_adminStatisticalInformation.tpl"})
</div>

({*ここまで:navi*})
({*権限チェック*})
({if $atoffice_auth_type==4})

({if $msg})<p class="actionMsg">({$msg})</p>({/if})
<h2>アカウント管理</h2>
<div class="contents">
<p class="info">管理用アカウントを設定します。</p>
<p class="add"><strong class="item"><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('insert_c_admin_user')})">アカウントを追加する</a></strong></p>

<table class="basicType2">
({capture name="table_header"})
<tr>
<th>ID</th>
<th>アカウント名</th>
<th>氏　名</th>
<th>権限</th>
<th>担当会場</th>
<th>操作</th>
<th>編集</th>
</tr>
({/capture})
<thead>
({$smarty.capture.table_header|smarty:nodefaults})
</thead>
<tbody>
({foreach from=$user_list item=item})
<tr id="userID({$item.c_admin_user_id})">
<td class="cell01">({$item.c_admin_user_id})</td>
<td>({$item.username})</td>
<td>({$item.name})</td>
<td>
({if $item.atoffice_auth_type=='1'})
初期設定担当者
({elseif $item.atoffice_auth_type=='2'})
予約受付担当者
({elseif $item.atoffice_auth_type=='3'})
準備担当者
({elseif $item.atoffice_auth_type=='4'})
管理者
({else})
不明な権限
({/if})
</td>
<td class="minth">
({if $item.hall_id})
({$item.hall_name})
({else})
--
({/if})

</td>
<td>({if $item.c_admin_user_id != 1})<a href="?m=({$module_name})&amp;a=do_({$hash_tbl->hash('delete_c_admin_user','do')})&amp;target_id=({$item.c_admin_user_id})&amp;sessid=({$PHPSESSID})">削除</a>({else})&nbsp;({/if})</td>
<td><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_c_admin_user')})&amp;target_id=({$item.c_admin_user_id})"><input type="button" style="padding: 3px;" value="変更"></a></td>
</tr>
({/foreach})
</tbody>
</table>


<p class="add">各担当メニューのみ、利用できます。</p>
<p class="add"><span style="color: #FF0033;">※　管理者はすべてのメニューが利用可能です。</span></p>

({else})
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
({/if})
<div>
({$inc_footer|smarty:nodefaults})
<style type="text/css">
.minth{
	width: 250px;
	word-break: break-all;
}
</style>