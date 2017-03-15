({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminStatisticalInformation.tpl"})
({assign var="page_name" value="ブラックリスト管理"})
({ext_include file="inc_tree_adminStatisticalInformation.tpl"})
</div>

({*ここまで:navi*})
({*権限チェック*})
({if $atoffice_auth_type==4})

({if $msg})<p class="actionMsg">({$msg})</p>({/if})
<h2>ブラックリスト管理</h2>
<div class="contents">


<table class="basicType2">
({capture name="table_header"})
<tr>
<th>ID</th>
<th>氏名</th>
<th>メールアドレス</th>
<th>備考</th>
<th>操作</th>
</tr>
({/capture})
<thead>
({$smarty.capture.table_header|smarty:nodefaults})
</thead>
<tbody>
({foreach from=$c_blacklist_list item=item})
({if $item})
<tr>
<td class="cell01">({$item.c_blacklist_id})</td>
<td>({$item.nickname})</td>
<td>
({$item.mail})
</td>
<td>({$item.info|nl2br})</td>
<td>
<ul>
<li><a href='?m=({$module_name})&amp;a=page_({$hash_tbl->hash('blacklist_edit','page')})&amp;target_c_blacklist_id=({$item.c_blacklist_id})'>編集</a></li>
<li><a href='?m=({$module_name})&amp;a=page_({$hash_tbl->hash('blacklist_delete_confirm','page')})&amp;target_c_blacklist_id=({$item.c_blacklist_id})'>ブラックリストから外す</a></li>
</ul>
</td>
</tr>
({/if})
({foreachelse})
<tr>
<td colspan="5">ブラックリストは登録されていません</td>
</tr>
({/foreach})
</table>

({if $c_blacklist_list})
<div class="listControl" id="pager02">
({$smarty.capture.pager|smarty:nodefaults})
</div>
({/if})

({else})
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
({/if})
<div>

({$inc_footer|smarty:nodefaults})
