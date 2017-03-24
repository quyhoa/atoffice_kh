({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminStatisticalInformation.tpl"})
({assign var="page_name" value="代理店値引き管理"})
({ext_include file="inc_tree_adminStatisticalInformation.tpl"})
</div>
<style>
	.txt_center{
		text-align: center;
	}
	.clss_p{
		padding-bottom: 3px !important;
	}
</style>
({*ここまで:navi*})
({*権限チェック*})
({if $atoffice_auth_type==4})

({if $msg})<p class="actionMsg">({$msg})</p>({/if})
<h2>代理店値引き管理</h2>
<div class="contents">


<table class="basicType2">
({capture name="table_header"})
<tr>
<th>ID</th>
<th>氏名</th>
<th>法人/団体名</th>
<th>会場指定</th>
<th>会場</th>
<th>値引き率</th>
<th>備考</th>
<th>操作</th>
</tr>
({/capture})
<thead>
({$smarty.capture.table_header|smarty:nodefaults})
</thead>
<tbody>
({foreach from=$c_agencylist_list item=item})
({if $item})
<tr>
<td class="cell01">({$item.c_member_id})</td>
<td>({$item.nickname})</td>
<td>({$item.corporation})</td>
<td class="txt_center">({if $item.type}) あり ({else}) なし ({/if})</td>
<td class="txt_center">
({if $item.hall_list_name !== null})
({foreach from=$item.hall_list_name item=hall_name})
<p class="clss_p">({$hall_name})</p>
({/foreach})
({/if})
</td>
<td>
({if $item.type == 0})
({$item.percent})%引き
({else})

({if $item.hall_list_percent !== null})
({foreach from=$item.hall_list_percent item=hall_pecent})
<p class="clss_p">({$hall_pecent})%引き</p>
({/foreach})
({/if})

({/if})
</td>
<td>({$item.info|nl2br})</td>
<td>
<ul>
<li><a href='?m=({$module_name})&amp;a=page_({$hash_tbl->hash('agencylist_edit','page')})&amp;target_c_agencylist_id=({$item.agency_id})'>編集</a></li>
<li><a href='?m=({$module_name})&amp;a=page_({$hash_tbl->hash('agencylist_delete_confirm','page')})&amp;target_c_agencylist_id=({$item.agency_id})'>代理店値引きから外す</a></li>
</ul>
</td>
</tr>
({/if})
({foreachelse})
<tr>
<td colspan="5">代理店値引きは登録されていません</td>
</tr>
({/foreach})
</table>

({if $c_agencylist_list})
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
