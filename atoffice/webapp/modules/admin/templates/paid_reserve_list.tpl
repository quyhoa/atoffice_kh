({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminSiteMember.tpl"})
({assign var="page_name" value="入金済み予約一覧"})
({ext_include file="inc_tree_adminSiteMember.tpl"})
</div>

({*ここまで:navi*})

({*権限チェック*})
({if $atoffice_auth_type==2 or $atoffice_auth_type==4})

<script type="text/javascript">
function confirm1(){
	if(window.confirm('予約をキャンセルしますか？')){
		return;
	}else{
		return false;
	}
}
</script>

<h2 id="ttl01">入金済み予約一覧 (
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
<input type="hidden" name="a" value="page_({$hash_tbl->hash('paid_reserve_list','page')})" />

<table border=1 width=800>
<tr>
<td colspan=4 bgcolor=#CDCDCD>検索オプション</td>
</tr>
<tr>
<th bgcolor=#FFD9DC>会場選択</th>
<th bgcolor=#FFD9DC>顧客ID</th>
<th bgcolor=#FFD9DC>入金状態</th>
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
</td>
<td>
<input type="text" name="u" value="({$c_member_id})">
</td>
<td>
<input type="radio" name="pay_flag" value="0" 
({if $pay_flag==0})checked({/if})>すべて
<input type="radio" name="pay_flag" value="1" 
({if $pay_flag==1})checked({/if})>入金済み
<input type="radio" name="pay_flag" value="2" 
({if $pay_flag==2})checked({/if})>過剰入金
</td>
</tr>
</table>

</form>
<br>
({foreach from=$page_list item=item})
({if $item.select})
	({$item.page})
({else})
	<a href="./?m=admin&a=page_paid_reserve_list&hall_list=({$hall_id})&u=({$c_member_id})&pay_flag=({$pay_flag})&index=({$item.index})" >({$item.page})</a>
({/if})
|
({/foreach})
<hr>

({foreach from=$reserve_list key=key item=item})
	<table border=1 width=800>
	<tr>
	<td colspan=4 bgcolor=#CC1111>
	<b><span style="color: #FFFFFF;">□　予約ID : ({$item.reserve_id})　□ ({if $item.bill_id})(請求番号:({$item.bill_id}))({/if})</span></b>
	</td>
	</tr>

	<tr>
	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>予約日</span></td>
	<td><span style='margin:5px;'>({$item.tmp_reserve_datetime})</span></td>	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>承認日</span></td>
	<td><span style='margin:5px;'>({$item.reserve_datetime})</span></td>


	</tr>

	<tr>
	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>入金日</span></td>
	<td><span style='margin:5px;'>({$item.pay_checkdate})</span></td>	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>入金状態</span></td>
	<td><span style='margin:5px;'>
	({if $item.pay_money==$item.total_price})
		入金済み（({$item.pay_money})円）
	({elseif $item.pay_money > $item.total_price})
		<span style="color:#FF0000;"><b>過剰入金(({$item.pay_money})円)</b></span>
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
	<td bgcolor=#FFD9DC rowspan=2><span style='margin:5px;'>予約時間</span></td>
	<td rowspan=2>({$item.datetime})<br>({$item.begin_datetime}) ～ ({$item.finish_datetime})</td>
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
	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>利用料金</span></td>
	<td colspan=3><span style='margin:5px;'>【部屋利用料：({$item.room_price1})円】＋【備品利用料：({$item.vessel_price1})円】＋【サービス利用料：({$item.service_price1})円】＝【合計請求額：({$item.room_price1+$item.vessel_price1+$item.service_price1})円】</span></td>
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
	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>キャンセル料</span></td>
	<td colspan=3>

	({if $item.cancel_list.before>0})
	({$item.cancel_list.before})日前　({$item.cancel_list.percent})% 徴収<br>
	({/if})
	【キャンセルに含む総額：({$item.cancel_price1})円】=【部屋利用料：({$item.room_price1})円】＋【備品利用料：({$item.vessel_price1})円】＋【キャンセル料金に含まれるサービス料：({$item.service_price1})円】<br>
	【キャンセル料：({$item.cancel_price})円】=【キャンセルに含む総額：({$item.room_price1+$item.vessel_price1+$item.service_price1})円】-【キャンセル料率：({$item.cancel_list.percent})x0.01】<br><br>

	({if $item.pay_money > $item.cancel_price})
		【返金額：({$item.pay_money-$item.cancel_price})円】=【入金額】-【キャンセル料】
	({else})
		【請求額：({$item.cancel_price-$item.pay_money})】=【キャンセル料】-【入金額】
	({/if})

	</td>
	</tr>

	<tr>
	<td bgcolor=#FFD9DC>予約修正</td>
	<td>
<center>
	<form name="reserve_revision({$key})" method="POST" action="./">
	<input type="hidden" name="m" value="({$module_name})" />
	<input type="hidden" name="a" value="page_({$hash_tbl->hash('reserve_revision','page')})" />
	<input type="hidden" name="reserve_id" value="({$item.reserve_id})" />
	<input type="submit" value="　修　正　">
	</form>
</center>
	</td>
	<td bgcolor=#FFD9DC>予約キャンセル</td>
	<td>
<center>
	<table><tr><td>
	<form onSubmit="return confirm1();" name="cancel({$key})" method="POST" action="./">
	<input type="hidden" name="m" value="({$module_name})" />
	<input type="hidden" name="a" value="do_({$hash_tbl->hash('reserve_cancel','do')})" />
	<input type="hidden" name="sessid" value="({$PHPSESSID})" />
	<input type="hidden" name="reserve_id" value="({$item.reserve_id})" />
	<input type="hidden" name="page" value="paid_reserve_list">
	({if $item.pay_money > $item.cancel_price})
		<input type="hidden" name="mode" value="1">
		<input type="hidden" name="cancel_price" value="({$item.pay_money-$item.cancel_price})">
	({else})
		<input type="hidden" name="mode" value="2">
		<input type="hidden" name="cancel_price" value="({$item.cancel_price-$item.pay_money})">
	({/if})

	<input type="submit" value="　メールしないでキャンセル　">
	</form>
	</td><td>
	<form action="./" method="post" target="_blank">
	<input type="hidden" name="m" value="({$module_name})" />
	<input type="hidden" name="a" value="do_({$hash_tbl->hash('send_cancel_mail','do')})" />
	<input type="hidden" name="sessid" value="({$PHPSESSID})" />
	<input type="hidden" name="reserveid" value="({$item.reserve_id})" />
	<input type="hidden" name="page" value="paid_reserve_list">
	<input type="hidden" name="hall_list" value="({$hall_id})" />
	<input type="hidden" name="u" value="({$c_member_id})" />
	<input type="hidden" name="pay_flag" value="({$pay_flag})" />
	<input type="hidden" name="index" value="({$index})" />
	({if $item.pay_money > $item.cancel_price})
		<input type="hidden" name="mode" value="1">
		<input type="hidden" name="cancel_price" value="({$item.pay_money-$item.cancel_price})">
	({else})
		<input type="hidden" name="mode" value="2">
		<input type="hidden" name="cancel_price" value="({$item.cancel_price-$item.pay_money})">
	({/if})

	<input type="submit" value="　メールしてキャンセル　">
	</form>
	</td></tr></table>

</center>

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
	<a href="./?m=admin&a=page_paid_reserve_list&hall_list=({$hall_id})&u=({$c_member_id})&pay_flag=({$pay_flag})&index=({$item.index})" >({$item.page})</a>
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
