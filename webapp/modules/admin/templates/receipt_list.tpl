({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminStatisticalInformation.tpl"})
({assign var="page_name" value="領収書印刷者リスト"})
({ext_include file="inc_tree_adminStatisticalInformation.tpl"})
</div>

({*ここまで:navi*})

({*権限チェック*})
({if $atoffice_auth_type==4})

<h2 id="ttl01">領収書印刷者リスト</h2>
<br>
<center>

({if $msg})<p class="actionMsg">({$msg})</p><br><br>({/if})

<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('receipt_list','page')})" />

<table border=1 width=800>
<tr>
<td colspan=4 bgcolor=#CDCDCD>検索オプション</td>
</tr>
<tr>
<th bgcolor=#FFD9DC>印刷期間（年-月-日）</th>
<td rowspan=2 bgcolor=#FFD9DC>
<input type="submit" value="検索する">
</td>
</tr>
<tr>
<td>
<input type="text" name="begin_date" value="({$begin_date})" size="8"> ～
<input type="text" name="finish_date" value="({$finish_date})" size="8">
</td>
</tr>
</table>

</form>
<br>

({if $reserve_data})
<table width=800 border=1>
<tr>
<th bgcolor=#CDCDCD>相手名</th>
<th bgcolor=#CDCDCD>発行日</th>
<th bgcolor=#CDCDCD>ご利用金額</th>
<th bgcolor=#CDCDCD>印紙額</th>
</tr>
({foreach from=$reserve_data key=key item=item})
<tr>
<td>({$item.corp})</td>
<td>({$item.date})</td>
<td>({$item.price})円</td>
<td>
({if $item.total_price<30000})
0円
({elseif $item.total_price>=30000 and $item.total_price<=1000000})
200円
({elseif $item.total_price>1000000})
400円
({/if})
</td>
</tr>
({/foreach})

({foreach from=$ab_data key=key item=item})
<tr>
<td>({$item.corp})</td>
<td>({$item.date})</td>
<td>({$item.price})円</td>
<td>
({if $item.total_price<30000})
0円
({elseif $item.total_price>=30000 and $item.total_price<=1000000})
200円
({elseif $item.total_price>1000000})
400円
({/if})
</td>
</tr>
({/foreach})

</table>
({/if})

</center>
({else})
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
({/if})
<div>
({$inc_footer|smarty:nodefaults})
