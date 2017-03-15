({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminSiteMember.tpl"})
({assign var="page_name" value="入金処理"})
({ext_include file="inc_tree_adminSiteMember.tpl"})
</div>

({*ここまで:navi*})

({*権限チェック*})
({if $atoffice_auth_type==2 or $atoffice_auth_type==4})

<h2 id="ttl01">入金処理</h2>
<br>
<center>

({if $msg})<p class="actionMsg">({$msg})</p><br><br>({/if})

<table border=1 width=800>
<tr>
<td colspan=4 bgcolor=#CC1111>
<b><span style="color: #FFFFFF;">□　予約ID : ({$reserve_data.reserve_id})　□</span></b>
</td>
</tr>

<tr>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>予約日</span></td>
<td><span style='margin:5px;'>({$reserve_data.tmp_reserve_datetime})</span></td>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>承認日</span></td>
<td><span style='margin:5px;'>({$reserve_data.reserve_datetime})</span></td>

</tr>
<tr>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>入金期日</span></td>
<td ({if $reserve_data.pay_limit <= 1})bgcolor=#FF9999({/if})><span style='margin:5px;'>({$reserve_data.pay_limitdate})　（残り({$reserve_data.pay_limit})日）</span></td>	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>入金状態</span></td>
	<td><span style='margin:5px;'>
	({if $reserve_data.pay_money})
		一部入金済み（({$reserve_data.pay_money})円）
	({else})
		未入金
	({/if})

	</span></td>
	</tr>

	<tr>
	<td bgcolor=#FFD9DC><span style='margin:5px;'>予約者</span></td>
	<td width=300><span style='margin:5px;'>({$reserve_data.c_member.nickname}) (ID:({$reserve_data.c_member.c_member_id}))</span></td>
	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>企業・個人名</span></td>
	<td width=300><span style='margin:5px;'>({$reserve_data.corp})</span></td>
	</tr>

	<tr>
	<td bgcolor=#FFD9DC><span style='margin:5px;'>施設名</span></td>
	<td width=300><span style='margin:5px;'>({$reserve_data.hall_data.hall_name})</span></td>
	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>部屋名</span></td>
	<td width=300><span style='margin:5px;'>({$reserve_data.room_data.room_name})</span></td>
	</tr>


	<tr>
	<td bgcolor=#FFD9DC rowspan=3><span style='margin:5px;'>予約時間</span></td>
	<td rowspan=3>({$reserve_data.begin_datetime})<br> ～ <br>({$reserve_data.finish_datetime})</td>
	<td bgcolor=#FFD9DC><span style='margin:5px;'>利用人数/目的</span></td>
	<td><span style='margin:5px;'>({$reserve_data.people}) 人　/　

	({if $reserve_data.purpose==0})
		会議
	({elseif $reserve_data.purpose==1})
		セミナー
	({elseif $reserve_data.purpose==2})
		研修
	({elseif $reserve_data.purpose==3})
		面接・試験
	({elseif $reserve_data.purpose==4})
		懇談会・パーティ
	({elseif $reserve_data.purpose==5})
		その他
	({/if})

	</span></td>
	</tr>

	<tr>
	<td bgcolor=#FFD9DC><span style='margin:5px;'>口座番号</span></td>
	<td><span style='margin:5px;'>
	({$reserve_data.account_number})
	</td>
	</tr>
	<tr>
	<td bgcolor=#FFD9DC><span style='margin:5px;'>入金日</span></td>
	<td><span style='margin:5px;'>
	({if $reserve_data.pay_checkdate})
		({$reserve_data.pay_checkdate})
	({else})
		-- --
	({/if})
	</span></td>
	</tr>



	<tr>
	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>利用料金</span></td>
	<td colspan=3><span style='margin:5px;'>【部屋利用料：({$reserve_data.room_price})円】＋【備品利用料：({$reserve_data.vessel_price})円】＋【サービス利用料：({$reserve_data.service_price})円】＝【合計請求額：({$reserve_data.total_price})円】</span></td>
	</tr>


	<tr>
	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>入金処理</span></td>
	<td colspan=3>

	( 残金：({$reserve_data.total_price-$reserve_data.pay_money})円 )<br>
	<form name="add_payment" method="POST" action="./">
	<input type="hidden" name="m" value="({$module_name})" />
	<input type="hidden" name="a" value="do_({$hash_tbl->hash('add_payment','do')})" />
	<input type="hidden" name="total_price" value="({$reserve_data.total_price})">
	<input type="hidden" name="pay_money" value="({$reserve_data.pay_money})">
	<input type="hidden" name="reserve_id" value="({$reserve_data.reserve_id})">
	<input type="hidden" name="sessid" value="({$PHPSESSID})" />
	今回入金額：<input type="text" name="money" value="0" style="text-align:right;"> 円

	<input type="submit" value="入金">
	</form>
	</td>
	</tr>


	</table>
	<br>

</center>
({else})
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
({/if})
<div>
({$inc_footer|smarty:nodefaults})
