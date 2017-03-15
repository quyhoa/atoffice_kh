({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminSiteMember.tpl"})
({assign var="page_name" value="キャンセルメール送信"})
({ext_include file="inc_tree_adminSiteMember.tpl"})
</div>

({*ここまで:navi*})
({*権限チェック*})
({if $atoffice_auth_type==2 or $atoffice_auth_type==4})

<h2>キャンセルメール送信</h2>
<div class="contents">
この予約をキャンセルし、キャンセルメールを送信します。
	<table border=1 width=800>
	<tr>
	<td colspan=4 bgcolor=#CC1111>
	<b><span style="color: #FFFFFF;">□　予約ID : ({$reserve_list.reserve_id})　□ ({if $reserve_list.bill_id})(請求番号:({$reserve_list.bill_id}))({/if})</span></b>
	</td>
	</tr>

	<tr>
	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>予約日</span></td>
	<td><span style='margin:5px;'>({$reserve_list.tmp_reserve_datetime})</span></td>	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>承認日</span></td>
	<td><span style='margin:5px;'>({$reserve_list.reserve_datetime})</span></td>


	</tr>

	<tr>
	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>入金日</span></td>
	<td><span style='margin:5px;'>({$reserve_list.pay_checkdate})</span></td>	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>入金状態</span></td>
	<td><span style='margin:5px;'>
	({if $reserve_list.pay_money==$reserve_list.total_price})
		入金済み（({$reserve_list.pay_money})円）
	({elseif $reserve_list.pay_money > $reserve_list.total_price})
		<span style="color:#FF0000;"><b>過剰入金(({$reserve_list.pay_money})円)</b></span>
	({/if})

	</span></td>
	</tr>

	<tr>
	<td bgcolor=#FFD9DC><span style='margin:5px;'>予約者</span></td>
	<td width=300><span style='margin:5px;'>
		<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('c_member_detail')})&amp;target_c_member_id=({$reserve_list.c_member.c_member_id})">({$reserve_list.c_member.nickname})</a>
	</span></td>
	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>企業・個人名</span></td>
	<td width=300><span style='margin:5px;'>({$reserve_list.corp})</span></td>
	</tr>

	<tr>
	<td bgcolor=#FFD9DC><span style='margin:5px;'>施設名</span></td>
	<td width=300><span style='margin:5px;'>({$reserve_list.hall_data.hall_name})</span></td>
	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>部屋名</span></td>
	<td width=300><span style='margin:5px;'>({$reserve_list.room_data.room_name})</span></td>
	</tr>

	<tr>
	<td bgcolor=#FFD9DC rowspan=2><span style='margin:5px;'>予約時間</span></td>
	<td rowspan=2>({$reserve_list.datetime})<br>({$reserve_list.begin_datetime}) ～ ({$reserve_list.finish_datetime})</td>
	<td bgcolor=#FFD9DC><span style='margin:5px;'>利用人数/目的</span></td>
	<td><span style='margin:5px;'>({$reserve_list.people}) 人　/　

	({if $reserve_list.purpose==0})
		未選択
	({elseif $reserve_list.purpose==1})
		会議
	({elseif $reserve_list.purpose==2})
		セミナー
	({elseif $reserve_list.purpose==3})
		研修
	({elseif $reserve_list.purpose==4})
		面接・試験
	({elseif $reserve_list.purpose==5})
		懇談会・パーティ
	({elseif $reserve_list.purpose==6})
		その他
	({/if})

	</span></td>
	</tr>

	<tr>
	<td bgcolor=#FFD9DC><span style='margin:5px;'>ﾊﾞｰﾁｬﾙ口座</span></td>
	<td><span style='margin:5px;'>
	({if $reserve_list.virtual_code})
		({$reserve_list.virtual_code})
	({else})
		固定口座
	({/if})
	</span></td>
	</tr>


	<tr>
	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>利用料金</span></td>
	<td colspan=3><span style='margin:5px;'>【部屋利用料：({$reserve_list.room_price})円】＋【備品利用料：({$reserve_list.vessel_price})円】＋【サービス利用料：({$reserve_list.service_price})円】＝【合計請求額：({$reserve_list.total_price})円】</span></td>
	</tr>

({if $reserve_list.reserve_v_list})
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
	({foreach from=$reserve_list.reserve_v_list key=k item=i})
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

({if $reserve_list.reserve_s_list})
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
	({foreach from=$reserve_list.reserve_s_list key=k item=i})
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
	<td bgcolor=#FFD9DC width=100 style='vertical-align:middle;'>
        <span style='margin:5px;'>お客さま<br>メッセージ</span>
    </td>
	<td colspan=3 align=left>
	({if $reserve_list.message})
		({$reserve_list.message|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
	({else})
		<center>--</center>
	({/if})
	</td>
	</tr>

	<tr>
	<td bgcolor=#FFD9DC width=100 style='vertical-align:middle;'><span style='margin:5px;'>社内メモ</span></td>
	<td colspan=3 align=left>
	({if $reserve_list.memo})
		({$reserve_list.memo|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
	({else})
		<center>--</center>
	({/if})
	</td>
	</tr>


	<tr>
	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>キャンセル料</span></td>
	<td colspan=3>

	({if $reserve_list.cancel_list.before>0})
	({$reserve_list.cancel_list.before})日前　({$reserve_list.cancel_list.percent})% 徴収<br>
	({/if})
	【キャンセルに含む総額：({$reserve_list.room_price+$reserve_list.cancel_service_price})円】=【部屋利用料：({$reserve_list.room_price})円】＋【備品利用料：({$reserve_list.cancel_vessel_price})円】＋【キャンセル料金に含まれるサービス料：({$reserve_list.cancel_service_price})円】<br>
	【キャンセル料：({$reserve_list.cancel_price})円】=【キャンセルに含む総額：({$reserve_list.room_price+$reserve_list.cancel_vessel_price+$reserve_list.cancel_service_price})円】-【キャンセル料率：({$reserve_list.cancel_list.percent})x0.01】<br><br>

	({if $reserve_list.pay_money > $reserve_list.cancel_price})
		【返金額：({$reserve_list.pay_money-$reserve_list.cancel_price})円】=【入金額】-【キャンセル料】
	({else})
		【請求額：({$reserve_list.cancel_price-$reserve_list.pay_money})】=【キャンセル料】-【入金額】
	({/if})

	</td>
	</tr>
	</table>
	<br>

<p class="info">【キャンセルメール】</p>

<form action="./" method="post">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="do_({$hash_tbl->hash('send_cancel_mail','do')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
<input type="hidden" name="resderveid" value="({$reserve_list.reserve_id})" />
<input type="hidden" name="page" value="({$page})" />
<input type="hidden" name="hall_list" value="({$hall_list})" />
<input type="hidden" name="u" value="({$c_member_id})" />
<input type="hidden" name="pay_flag" value="({$pay_flag})" />
<input type="hidden" name="index" value="({$index})" />
<input type="hidden" name="reserveid" value="({$reserve_list.reserve_id})" />
<dl>
<dt class="mails"><strong>送信先</strong></dt>
<dd class="mails"><input size='100' type='text' name='mails' value='({$requests.mails})'></dd>
<dd class="caution" id="c02">※複数のメールアドレス宛にメールを送信する場合は、; で区切って入力してください。</dd>
<dt class="subject"><strong>表題</strong></dt>
<dd class="subject"><input size='100' type='text' name='subject' value='({$requests.subject})'></dd>
<dt class="message"><strong>本文</strong></dt>
<dd class="message"><textarea cols="90" rows="30" name="message">({$requests.message})</textarea></dd>
</dl>
<table><tbody><tr><td>
<p class="textBtn">
<input type="submit" name="cancel" value="戻る(キャンセル中止)">
</p>
</td><td>
<p class="textBtn">
<input type="submit" name="submit" value="確認画面">
</p>
</td></tbody></table>
</form>

({else})
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
({/if})
<div>

({$inc_footer|smarty:nodefaults})
