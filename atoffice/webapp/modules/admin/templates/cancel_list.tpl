({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminSiteMember.tpl"})
({assign var="page_name" value="キャンセル一覧"})
({ext_include file="inc_tree_adminSiteMember.tpl"})
</div>

({*ここまで:navi*})

({*権限チェック*})
({if $atoffice_auth_type==2 or $atoffice_auth_type==4})

<h2 id="ttl01">キャンセル一覧 (
({if $reserve_list})
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
<input type="hidden" name="a" value="page_({$hash_tbl->hash('cancel_list','page')})" />

<table border=1 width=800>
<tr>
<td colspan=4 bgcolor=#CDCDCD>検索オプション</td>
</tr>
<tr>
<th bgcolor=#FFD9DC>会場選択</th>
<th bgcolor=#FFD9DC>顧客ID</th>
<th bgcolor=#FFD9DC>予約時間</th>
<td rowspan=2 bgcolor=#FFD9DC>
<input type="submit" value="検索する">
</td>
</tr>
<tr>
<td>
<select name="hall_list">
<option value="0">すべての会場</option>
({foreach from=$hall_list item=item})
	<option value="({$item.hall_id})" ({if $item.hall_id == $hall_id})selected({/if})>({$item.hall_name})</option>
({/foreach})
</select>
</td>
<td>
<input type="text" name="u" value="({$c_member_id})">
</td>
<td>
<input type="text" name="begin_date" value="({$begin_date})" size="14"> ～
<input type="text" name="finish_date" value="({$finish_date})" size="14">
</td>
</tr>
</table>

</form>
<br>
({foreach from=$page_list item=item})
({if $item.select})
	({$item.page})
({else})
	<a href="./?m=admin&a=page_cancel_list&hall_list=({$hall_id})&u=({$c_member_id})&begin_date=({$begin_date})&finish_date=({$finish_date})&index=({$item.index})" >({$item.page})</a>
({/if})
|
({/foreach})
<hr>

({foreach from=$reserve_list key=key item=item})
	<table border=1 width=800>
	<tr>
	<td colspan=4 bgcolor=#CC1111>
	<b><span style="color: #FFFFFF;">□　予約ID : ({$item.reserve_id})　□</span></b>
	</td>
	</tr>

	<tr>
	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>キャンセル日</span></td>
	<td colspan=3>
	<b>({$item.cancel_datetime})</b>
	</td>
	</tr>

	<tr>
	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>予約日</span></td>
	<td><span style='margin:5px;'>({$item.tmp_reserve_datetime})</span></td>	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>承認日</span></td>
	<td><span style='margin:5px;'>
	({if $item.reserve_datetime})
		({$item.reserve_datetime})
	({else})
		-- --
	({/if})
	</span></td>


	</tr>

	<tr>
	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>入金日</span></td>
	<td><span style='margin:5px;'>
	({if $item.pay_checkdate})
		({$item.pay_checkdate})
	({else})
		-- --
	({/if})
	</span></td>
	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>入金状態</span></td>
	<td><span style='margin:5px;'>
	({if $item.tmp_flag == 0})
	({if $item.pay_flag ==0 and $item.pay_money==0})
		未入金
	({elseif $item.pay_flag == 0 and $item.pay_money>0})
		一部入金(({$item.pay_money})円)
	({elseif $item.pay_flag == 1 and $item.pay_money == $item.total_price})
		入金済み(({$item.pay_money})円)
	({elseif $item.pay_flag == 2 and $item.pay_money > $item.total_price})
		<span style="color:#FF0000;"><b>過剰入金(({$item.pay_money})円)</b></span>
	({/if})
	({else})
		仮予約
	({/if})

	</span></td>
	</tr>

	<tr>
	<td bgcolor=#FFD9DC><span style='margin:5px;'>予約者</span></td>
	<td width=300><span style='margin:5px;'>
		<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('c_member_detail')})&amp;target_c_member_id=({$item.c_member.c_member_id})">({$item.c_member.nickname})</a>
	</span></td>
	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>企業・個人名</span></td>
	<td width=300><span style='margin:5px;'>({$item.corp})</span></td>
	</tr>

	<tr>
	<td bgcolor=#FFD9DC><span style='margin:5px;'>施設名</span></td>
	<td width=300><span style='margin:5px;'>({$item.hall_data.hall_name})</span></td>
	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>部屋名</span></td>
	<td width=300><span style='margin:5px;'>({$item.room_data.room_name})</span></td>
	</tr>

	<tr>
	<td bgcolor=#FFD9DC rowspan=3><span style='margin:5px;'>予約時間</span></td>
	<td rowspan=3>({$item.datetime})<br>({$item.begin_datetime}) ～ ({$item.finish_datetime})</td>
	<td bgcolor=#FFD9DC><span style='margin:5px;'>利用人数/目的</span></td>
	<td><span style='margin:5px;'>({$item.people}) 人　/　

	({if $item.purpose==0})
		未選択
	({elseif $item.purpose==1})
		会議
	({elseif $item.purpose==2})
		セミナー
	({elseif $item.purpose==3})
		研修
	({elseif $item.purpose==4})
		面接・試験
	({elseif $item.purpose==5})
		懇談会・パーティ
	({elseif $item.purpose==6})
		その他
	({/if})

	</span></td>
	</tr>

	<tr>
	<td bgcolor=#FFD9DC><span style='margin:5px;'>ﾊﾞｰﾁｬﾙ口座</span></td>
	<td><span style='margin:5px;'>
	({if $item.virtual_code})
		({$item.virtual_code})
	({else})
		固定口座
	({/if})
	</span></td>
	</tr>
	<tr>
	<td bgcolor=#FFD9DC><span style='margin:5px;'>入金日</span></td>
	<td><span style='margin:5px;'>
	({if $item.pay_checkdate})
		({$item.pay_checkdate})
	({else})
		-- --
	({/if})

	</span></td>
	</tr>

	<tr>
	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>利用料金</span></td>
	<td colspan=3><span style='margin:5px;'>【部屋利用料：({$item.room_price})円】＋【備品利用料：({$item.vessel_price})円】＋【サービス利用料：({$item.service_price})円】＝【合計請求額：({$item.total_price})円】</span></td>
	</tr>

({if $item.reserve_v_list})
	<tr>
	<td bgcolor=#FFD9DC width=100 style='vertical-align:middle;'><span style='margin:5px;'>予約備品一覧</span></td>
	<td colspan=3><span style='margin:5px;'>
	<table style='border: 1px #000000 solid;' width=100%>
	<tr>
	<th style='border: 1px #000000 solid;' bgcolor=#EFEFEF>備品名</th>
	<th style='border: 1px #000000 solid;' bgcolor=#EFEFEF>予約時単価</th>
	<th style='border: 1px #000000 solid;' bgcolor=#EFEFEF>数量</th>
	<th style='border: 1px #000000 solid;' bgcolor=#EFEFEF>備品管理メモ</th>
	</tr>
	({foreach from=$item.reserve_v_list key=k item=i})
	<td style='border: 1px #000000 solid;'>({$i.vessel_name})</td>
	<td style='border: 1px #000000 solid;'>({$i.price})</td>
	<td style='border: 1px #000000 solid;'>({$i.num})</td>
	<td style='border: 1px #000000 solid;'>
		({$i.memo|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
	</td>
	</tr>
	({/foreach})
	</table>

	</span></td>
	</tr>
({/if})

({if $item.reserve_s_list})
	<tr>
	<td bgcolor=#FFD9DC width=100 style='vertical-align:middle;'><span style='margin:5px;'>予約ｻｰﾋﾞｽ一覧</span></td>
	<td colspan=3><span style='margin:5px;'>

	<table style='border: 1px #000000 solid;' width=100%>
	<tr>
	<th style='border: 1px #000000 solid;' bgcolor=#EFEFEF>サービス名</th>
	<th style='border: 1px #000000 solid;' bgcolor=#EFEFEF>予約時単価</th>
	<th style='border: 1px #000000 solid;' bgcolor=#EFEFEF>数量</th>
	<th style='border: 1px #000000 solid;' bgcolor=#EFEFEF>サービス管理メモ</th>
	</tr>
	({foreach from=$item.reserve_s_list key=k item=i})
	<td style='border: 1px #000000 solid;'>({$i.service_name})</td>
	<td style='border: 1px #000000 solid;'>({$i.price})</td>
	<td style='border: 1px #000000 solid;'>({$i.num})</td>
	<td style='border: 1px #000000 solid;'>
	({$i.memo|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
	</td>
	</tr>
	({/foreach})
	</table>

	</span></td>
	</tr>
({/if})

	<tr>
	<td bgcolor=#FFD9DC width=100 style='vertical-align:middle;'><span style='margin:5px;'>お客さま<br>メッセージ</span></td>
	<td colspan=3 align=left>
	({if $item.message})
		({$item.message|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
	({else})
		<center>--</center>
	({/if})
	</td>
	</tr>

	<tr>
	<td bgcolor=#FFD9DC width=100 style='vertical-align:middle;'><span style='margin:5px;'>社内メモ</span></td>
	<td colspan=3 align=left>
	({if $item.memo})
		({$item.memo|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
	({else})
		<center>--</center>
	({/if})
	</td>
	</tr>

	<tr>
	<td bgcolor=#FFD9DC width=100 style='vertical-align:middle;'><span style='margin:5px;'>キャンセル料</span></td>
	<td colspan=3>
	({if $item.tmp_flag == 0})
		({if $item.ab_data})
			キャンセル請求番号：【({$item.ab_data.bill_id})】
			キャンセル料：【({$item.cancel_price|round})円】
			入金状態：【
			({if $item.ab_data.pay_money > 0 && $item.ab_data.pay_money < $item.ab_data.total_billed_money })
				<span style="color:#0000FF;"><b>一部入金</b></span>
			({elseif $item.ab_data.pay_money >0 && $item.ab_data.pay_money == $item.ab_data.total_billed_money  })
				<span style="color:#0000FF;"><b>入金済</b></span>
			({elseif $item.ab_data.pay_money >0 && $item.ab_data.pay_money > $item.ab_data.total_billed_money  })
				<span style="color:#0000FF;"><b>過剰入金</b></span>	
			({else})
				<span style="color:#FF0000;"><b>未入金</b></span>
			({/if})
			】
			入金額：【({$item.ab_data.pay_money})円】<br>
			最終入金日：【({$item.ab_data.check_datetime})】
			バーチャル口座：【({$item.ab_data.virtual_code})】<br>
		({/if})

		({if $item.repay_data && $item.repay_data.repayment_money >0})
			返金ID：【({$item.repay_data.repayment_id})】
			返金額：【({$item.repay_data.repayment_money})円】
			入金状態：【
			({if $item.repay_data.flag==0})
				<span style="color:#FF0000;"><b>未返金</b></span>
			({else})
				<span style="color:#0000FF;"><b>返金済</b></span>
			({/if})
			】
			返金処理日：【({$item.repay_data.repayment_datetime})】
		({/if})
		({if !$item.ab_data and !$item.repay_data})
			入出金なし
		({/if})	
	({else})
		入出金なし
	({/if})
	</td>
	</tr>

	</table>
	<br>
({foreachelse})
	該当するデータはありませんでした。
({/foreach})

<hr>
({foreach from=$page_list item=item})
({if $item.select})
	({$item.page})
({else})
	<a href="./?m=admin&a=page_cancel_list&hall_list=({$hall_id})&u=({$c_member_id})&begin_date=({$begin_date})&finish_date=({$finish_date})&index=({$item.index})" >({$item.page})</a>
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
