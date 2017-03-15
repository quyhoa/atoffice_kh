({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminStatisticalInformation.tpl"})
({assign var="page_name" value="キャンセル請求一覧"})
({ext_include file="inc_tree_adminStatisticalInformation.tpl"})
</div>

({*ここまで:navi*})

({*権限チェック*})
({if $atoffice_auth_type==4})

<h2 id="ttl01">キャンセル請求一覧　(
({if $ab_list})
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
<input type="hidden" name="a" value="page_({$hash_tbl->hash('amount_billed','page')})" />

<table border=1 width=800>
<tr>
<td colspan=4 bgcolor=#CDCDCD>検索オプション</td>
</tr>
<tr>
<th bgcolor=#FFD9DC>入金状態</th>
<th bgcolor=#FFD9DC>予約ID</th>
<th bgcolor=#FFD9DC>入金期日</th>
<td rowspan=2 bgcolor=#FFD9DC>
<input type="submit" value="検索する">
</td>
</tr>
<tr>
<td>
<input type="radio" name="pay_flag" value="0" ({if $pay_flag==0})checked({/if})>すべて
<input type="radio" name="pay_flag" value="1" ({if $pay_flag==1})checked({/if})>未入金or一部
<input type="radio" name="pay_flag" value="2" ({if $pay_flag==2})checked({/if})>入金済み
</td>
<td>
<input type="text" name="reserve_id" value="({$reserve_id})">
</td>
<td>
<input type="text" name="begin_date" value="({$begin_date})" size="16"> ～
<input type="text" name="finish_date" value="({$finish_date})" size="16">
</td>
</tr>
</table>

</form>
<br>
({foreach from=$page_list item=item})
({if $item.select})
	({$item.page})
({else})
	<a href="./?m=admin&a=page_amount_billed&pay_flag=({$pay_flag})&reserve_id=({$reserve_id})&begin_date=({$begin_date})&finish_date=({$finish_date})&index=({$item.index})" >({$item.page})</a>
({/if})
|
({/foreach})
<hr>

({foreach from=$ab_list item=item})
<table border=1 width=800>

<tr>
<td colspan=4 bgcolor=#CCFFFF>■ 予約ID ({$item.reserve_id}) ■　最終入金日(({$item.check_datetime}))</td>
</tr>

<tr>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'><b>請求番号</b></span></td>
<td><span style='margin:5px;'><b>({$item.bill_id})</b></span></td>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'><b>仮想口座番号</b></span></td>
<td><span style='margin:5px;'><b>({$item.virtual_code})</b></span></td>
</td>
</tr>


<tr>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'><b>請求額</b></span></td>
<td><span style='margin:5px;'><b>({$item.total_billed_money}) 円</b></span></td>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'><b>現在入金額</b></span></td>
<td><span style='margin:5px;'><b>({$item.pay_money}) 円</b></span></td>
</td>
</tr>

<tr>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>氏名</span></td>
<td><span style='margin:5px;'><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('c_member_detail')})&amp;target_c_member_id=({$item.c_member.c_member_id})">({$item.c_member.nickname})</a></span></td>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>法人・個人名</span></td>
<td><span style='margin:5px;'>({$item.corp})</span></td>
</td>
</tr>


<tr>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>E-mail</span></td>
<td><span style='margin:5px;'>
<a href="mailto:({$item.mail})">({$item.mail})</a>
</span></td>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>入金期日</span></td>
<td><span style='margin:5px;'>({$item.pay_limitdate})</span></td>
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
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>予約入金期日</span></td>
<td><span style='margin:5px;'>({$item.reserve_data.pay_limitdate})</span></td>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>キャンセル日</span></td>
<td><span style='margin:5px;'>({$item.reserve_data.cancel_datetime})</span></td>
</td>
</tr>

<tr>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>予約利用金額</span></td>
<td><span style='margin:5px;'>({$item.reserve_data.total_price}) 円</span></td>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>予約入金金額</span></td>
<td><span style='margin:5px;'>({$item.reserve_data.pay_money}) 円</span></td>
</td>
</tr>
<tr>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>理由</span></td>
<td colspan=3><span style='margin:5px;'>
({$item.info|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
</span></td>
</tr>
</table>
<br>
({foreachelse})
該当する請求データはありませんでした。
({/foreach})
<hr>
({foreach from=$page_list item=item})
({if $item.select})
	({$item.page})
({else})
	<a href="./?m=admin&a=page_amount_billed&pay_flag=({$pay_flag})&reserve_id=({$reserve_id})&begin_date=({$begin_date})&finish_date=({$finish_date})&index=({$item.index})" >({$item.page})</a>
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
