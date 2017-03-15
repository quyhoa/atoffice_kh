({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminStatisticalInformation.tpl"})
({assign var="page_name" value="返金処理済みリスト"})
({ext_include file="inc_tree_adminStatisticalInformation.tpl"})
</div>

({*ここまで:navi*})

({*権限チェック*})
({if $atoffice_auth_type==4})

<h2 id="ttl01">返金処理済みリスト　(
({if $repayment_list})
	({$num})件中　({$index+1})件～
	({if $index+10 > $num})
		({$num})
	({else})
		({$index+10})
	({/if})
	件を表示
({else})
	0件
({/if})

)</h2>
<br>
<center>

({if $msg})<p class="actionMsg">({$msg})</p><br><br>({/if})


<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('repaid_list','page')})" />

<table border=1 width=800>
<tr>
<td colspan=4 bgcolor=#CDCDCD>検索オプション</td>
</tr>
<tr>
<th bgcolor=#FFD9DC>返金額</th>
<th bgcolor=#FFD9DC>予約ID</th>
<th bgcolor=#FFD9DC>返金処理日時範囲指定(年-月-日)</th>
<td rowspan=2 bgcolor=#FFD9DC>
<input type="submit" value="検索する">
</td>
</tr>
<tr>
<td>
<input type="text" name="repayment_money" value="({$repayment_money})" size=5 style="text-align:right;padding-right:5px;">円以上
</td>
<td>
<input type="text" name="reserve_id" value="({$reserve_id})">
</td>
<td>
<input type="text" name="begin_date" value="({$begin_date})" size="8"> ～
<input type="text" name="finish_date" value="({$finish_date})" size="8">
</td>
</tr>
</table>

</form>
<br>
({foreach from=$page_list item=item})
({if $item.select})
	({$item.page})
({else})
	<a href="./?m=admin&a=page_repaid_list&repayment_money=({$repayment_money})&reserve_id=({$reserve_id})&begin_date=({$begin_date})&finish_date=({$finish_date})&index=({$item.index})" >({$item.page})</a>
({/if})
|
({/foreach})
<hr>


({foreach from=$repayment_list item=item})
<table border=1 width=800>
<tr>
<td colspan=4 bgcolor=#CCFFFF>■ 予約ID ({$item.reserve_id}) ■　返金処理日(({$item.repayment_datetime}))</td>
</tr>
<tr>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>返金額</span></td>
<td><span style='margin:5px;'>({$item.repayment_money}) 円</span></td>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>E-mail</span></td>
<td><span style='margin:5px;'>
<a href="mailto:({$item.mail})">({$item.mail})</a>
</span></td>
</td>
</tr>

<tr>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>氏名</span></td>
<td><span style='margin:5px;'>({$item.c_member.nickname})</span></td>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>法人・個人名</span></td>
<td><span style='margin:5px;'>({$item.corp})</span></td>
</td>
</tr>

<tr>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>利用施設</span></td>
<td><span style='margin:5px;'>({$item.hall_name})</span></td>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>部屋名</span></td>
<td><span style='margin:5px;'>({$item.room_name})</span></td>
</td>
</tr>

<tr>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>仮予約申込日</span></td>
<td><span style='margin:5px;'>({$item.reserve_data.tmp_reserve_datetime})</span></td>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>予約承認日</span></td>
<td><span style='margin:5px;'>({$item.reserve_data.reserve_datetime})</span></td>
</td>
</tr>

<tr>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>利用開始時間</span></td>
<td><span style='margin:5px;'>({$item.reserve_data.begin_datetime})</span></td>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>利用終了時間</span></td>
<td><span style='margin:5px;'>({$item.reserve_data.finish_datetime})</span></td>
</td>
</tr>

<tr>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>入金締切日</span></td>
<td><span style='margin:5px;'>({$item.reserve_data.pay_limitdate})</span></td>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>キャンセル日</span></td>
<td><span style='margin:5px;'>({$item.reserve_data.cancel_datetime})</span></td>
</td>
</tr>

<tr>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>利用金額</span></td>
<td><span style='margin:5px;'>({$item.reserve_data.total_price}) 円</span></td>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>入金済み金額</span></td>
<td><span style='margin:5px;'>({$item.reserve_data.pay_money}) 円</span></td>
</td>
</tr>

<tr>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>理由</span></td>
<td colspan=3 align=left><span style='margin:5px;'>
({$item.info|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
</span></td>
</tr>

</table>
<br>
({foreachelse})
該当する返金処理済みデータはありませんでした。
({/foreach})
<hr>
({foreach from=$page_list item=item})
({if $item.select})
	({$item.page})
({else})
	<a href="./?m=admin&a=page_repaid_list&repayment_money=({$repayment_money})&reserve_id=({$reserve_id})&begin_date=({$begin_date})&finish_date=({$finish_date})&index=({$item.index})" >({$item.page})</a>
({/if})
|
({/foreach})


</center>
({else})
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
({/if})
<div>
({$inc_footer|smarty:nodefaults})
