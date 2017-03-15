({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminSiteMember.tpl"})
({assign var="page_name" value="予約確認"})
({ext_include file="inc_tree_adminSiteMember.tpl"})
</div>

({*ここまで:navi*})

({*権限チェック*})
({if $atoffice_auth_type==2 or $atoffice_auth_type==4})

<style type="text/css">
<!--
HR {
	border-style:dotted;color:#3399FF

}
-->
</style>

<h2 id="ttl01">予約確認</h2>
<br>
<center>
({if $msg})<p class="actionMsg">({$msg})</p><br><br>({/if})

<br>
<table>
<tr>
<td style="text-align:left;">
金額を手入力で、調整できます。<br>
金額を調整した場合は、登録担当者と理由をメモに必ず記入してください。<br>
</td>
</tr>
</table>
<br>


<form name="do_set_reserve" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('do_set_reserve','page')})" />

({foreach from=$post_data key=key item=item})
	<input type="hidden" name="({$key})" value="({$item})">
({/foreach})



<table border=1 width=700>
<tr>
<td width=100 bgcolor=#AACCFF>利用施設名</td>
<td width=250>({$post_data.hall_name})</td>
<td width=100 bgcolor=#AACCFF>部屋名</td>
<td width=250>
({$post_data.room_name})
</td>
</tr>
<tr>
<td bgcolor=#AACCFF>利用日時</td>
<td colspan=3>({$post_data.begin_datetime}) ～ ({$post_data.finish_datetime})</td>
</tr>

<tr>
<td width=100 bgcolor=#AACCFF>利用目的</td>
<td>
({if $post_data.purpose==0})
	未選択
({elseif $post_data.purpose==1})
	会議
({elseif $post_data.purpose==2})
	セミナー
({elseif $post_data.purpose==3})
	研修
({elseif $post_data.purpose==4})
	面接・試験
({elseif $post_data.purpose==5})
	懇談会・パーティ
({elseif $post_data.purpose==6})
	その他
({/if})
</td>
<td width=100 bgcolor=#AACCFF>利用人数</td><td>({$post_data.people}) 人</td>
</tr>

<tr>
<td bgcolor=#AACCFF>利用料金</td>
<td colspan=3>
<input type="text" name="room_price" value="({$room_price})" style="text-align:right;padding-right:5px;"> 円
</td>
</tr>

<tr>
<td bgcolor=#AACCFF>看板</td>
<td colspan=3 align=left>
({$post_data.kanban|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
</td>
</tr>

<tr>
<td bgcolor=#AACCFF>顧客ID</td>
<td>
({if $post_data.c_member_id})
	({$post_data.c_member_id})
({else})
	-- --
({/if})
</td>
<td bgcolor=#AACCFF>顧客氏名</td>
<td>
({if $post_data.c_member_id})
	<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('c_member_detail')})&amp;target_c_member_id=({$post_data.c_member_id})">({$post_data.c_member.nickname})</a>
({else})
	新規契約者
({/if})
</td>
</tr>

<tr>
<td bgcolor=#AACCFF>予約備品</td>
<td colspan=3>
({foreach from=$vessel_list item=value})
	({$value.vessel_data.vessel_name})：　({$value.vessel_data.price})円ｘ({$value.num})<br>
({foreachelse})
	なし<br>
({/foreach})
<span style="color:#FF0000;font-size:15px;"><b>備品料金合計：
<input type="text" name="vessel_price" value="({$vessel_price})" style="text-align:right;padding-right:5px;">
円</b></span>
</td>
</tr>

<tr>
<td bgcolor=#AACCFF>予約サービス</td>
<td colspan=3>
({foreach from=$service_list item=value})
	({$value.service_data.service_name})：　({$value.service_data.price})円ｘ({$value.num})<br>
({foreachelse})
	なし<br>
({/foreach})
<span style="color:#FF0000;font-size:15px;"><b>サービス料金合計：
<input type="text" name="service_price" value="({$service_price})" style="text-align:right;padding-right:5px;">
円</b></span>
</td>
</tr>

<tr>
<td bgcolor=#AACCFF>合計金額</td>
<td colspan=3>
<span style="color:#FF0000;font-size:15px;"><b>合計請求額：
<input type="text" name="total_price" value="({$total_price})" style="text-align:right;padding-right:5px;">
 円</b></span>
</td>
</tr>

<tr>
<td width=100 bgcolor=#AACCFF>メモ</td>
<td colspan=3>
<textarea id="mce_editor_textarea" name="memo" rows="({$_rows|default:'4'})" cols="({$_cols|default:'70'})"></textarea>
</td>
</tr>
<tr>
<td width=100 bgcolor=#FFAACC><b>長期フラグ</b></td>
<td colspan=3>
<input type="radio" name="long_term" value="0" checked> 通常予約
<input type="radio" name="long_term" value="1"> 長期予約
</td>
</tr>
<tr>
<td width=100 bgcolor=#FFAACC><b>通知メール</b></td>
<td colspan=3>
<input type="radio" name="mail_flag" value="1" checked> 通知メールを送信する
<input type="radio" name="mail_flag" value="0"> 通知メールを送信しない
</td>
</tr>

</table>


({if $post_data.c_member_id==0})

<br>
<table border=1 width=700>
<tr>
<th colspan=4 bgcolor=#FFCCDD>ゲスト申請<span style="color:#FF0000">(※ 必須)</span></th>
</tr>
<tr>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">氏名<span style="color:#FF0000;">(※)</span></td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<input tyep="text" name="shimei" size=20 value="">
</td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">フリガナ(全角カタカナ)<span style="color:#FF0000">(※)</span></td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<input tyep="text" name="kana" size=30 value="">
</td>
</tr>
({**************************
<tr>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">生年月日<span style="color:#FF0000;">(※)</span></td>
<td colspan=3 style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">

<input type="text" name="birth_year" size=15 value=""> 年 
<select name="birth_month">
({foreach from=$birth_month_list item=value})
	<option value=({$value})>({$value})</option>
({/foreach})
</select> 月 
<select name="birth_day">
({foreach from=$birth_day_list item=value})
	<option value=({$value})>({$value})</option>
({/foreach})
</select> 日

</td>
</tr>
*******************************})

<tr>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">利用形態<span style="color:#FF0000;">(※)</span></td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<input type="radio" name="riyo" value="106"> 法人　
<input type="radio" name="riyo" value="107"> 個人
</td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">法人名・代表者名<span style="color:#FF0000;">(※)</span></td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<input tyep="text" name="daihyou" size=20 value="">
</td>
</tr>
<tr>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">部署名</td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<input tyep="text" name="busho" size=20 value="">
</td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">メールアドレス<span style="color:#FF0000;">(※)</span></td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<input type="text" name="mail" size=30 value="">
</td>
</tr>
<tr>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">都道府県<span style="color:#FF0000;">(※)</span></td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<select name="ken">
({foreach from=$ken_list item=value})
<option value="({$value.c_profile_option_id})">({$value.value})</option>
({/foreach})
</select>

</td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">郵便番号<br>(ハイフン有り)</td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<input type="text" name="zip" size=20 value="">
</td>
</tr>
<tr>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">市区町村<span style="color:#FF0000;">(※)</span></td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<input type="text" name="address_city" size=20 value="">
</td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">番地<span style="color:#FF0000;">(※)</span></td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<input type="text" name="address_banchi" size=30 value="">
</td>
</tr>
<tr>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">建物名</td>
<td colspan=3 style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<input type="text" name="address_build" size=60 value="">
</td>
</tr>
<tr>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">電話番号<span style="color:#FF0000;">(※)</span><br>(ハイフン有り)</td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<input type="text" name="tel" size=20 value="">
</td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">FAX番号<br>ハイフン有り</td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<input type="text" name="fax" size=20 value="">
</td>
</tr>
</table>

({/if})

<br>
<INPUT TYPE=button VALUE="　戻る　" style="width:250px;font:20px;border:3px ridge;background:#090;color:#fff; padding:3px; font-weight:bold;" onClick="self.history.back()">
<INPUT TYPE="submit" VALUE="　仮予約登録　" style="width:250px;font:20px;border:3px ridge;background:#090;color:#fff; padding:3px; font-weight:bold;">

</form>

</center>

({else})
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
({/if})
<div>
({$inc_footer|smarty:nodefaults})
