({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminImageKakikomi.tpl"})
({assign var="page_name" value="キャンセル料率設定"})
({ext_include file="inc_tree_adminImageKakikomi.tpl"})
</div>

({*ここまで:navi*})

({*権限チェック*})
({if $atoffice_auth_type==1 or $atoffice_auth_type==4})


<h2 id="ttl01">キャンセル料率設定【({$hall_name})】</h2>
<br>
<center>
({if $msg})<p class="actionMsg">({$msg})</p><br><br>({/if})
<span style="font-size: 15pt;color: #FF0000;">
※ この会議室のキャンセル設定範囲は<b>({$cancel_days})日</b>以前までです。
</span>
<br><br>
<form name="add_bank_data" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="do_({$hash_tbl->hash('add_cancel_charge','do')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
<input type="hidden" name="hall_id" value="({$hall_id})" />
<table border=1>
<tr>
<td>
<table>
<tr>
<td bgcolor="#FFCCFF" width=350 align=center height=30 colspan=2>
<input type="checkbox" name="1_flag" value="1" ({if $cancel_data.0.flag})checked({/if})><b> 有効 / パターン１</b><span style="color: #FF0000;"><b>　（必須）</b></span></td>
</tr>
<tr>
<td>
<select name="1_day1">
<option value="">　--選択--　</option>
({foreach from=$day_list item=item})
<option value="({$item})" ({if $cancel_data.0.day1 == $item})selected({/if})>　({$item})　</option>
({/foreach})
</select>
日以前 <input type="text" name="1_percent1" value="({$cancel_data.0.percent1})" size=15> ％
</td>
</tr>
<tr>
<td>
<select name="1_day2">
<option value="">　--選択--　</option>
({foreach from=$day_list item=item})
<option value="({$item})" ({if $cancel_data.0.day2 == $item})selected({/if})>　({$item})　</option>
({/foreach})
</select>
日前まで <input type="text" name="1_percent2" value="({$cancel_data.0.percent2})" size=15> ％</td>
</tr>
<tr>
<td>
<select name="1_day3">
<option value="">　--選択--　</option>
({foreach from=$day_list item=item})
<option value="({$item})" ({if $cancel_data.0.day3 == $item})selected({/if})>　({$item})　</option>
({/foreach})
</select>
日前まで <input type="text" name="1_percent3" value="({$cancel_data.0.percent3})" size=15> ％</td>
</tr>
<tr>
<td>
<select name="1_day4">
<option value="">　--選択--　</option>
({foreach from=$day_list item=item})
<option value="({$item})" ({if $cancel_data.0.day4 == $item})selected({/if})>　({$item})　</option>
({/foreach})
</select>
日前まで <input type="text" name="1_percent4" value="({$cancel_data.0.percent4})" size=15> ％</td>
</tr>
<tr>
<td>
<select name="1_day5">
<option value="">　--選択--　</option>
({foreach from=$day_list item=item})
<option value="({$item})" ({if $cancel_data.0.day5 == $item})selected({/if})>　({$item})　</option>
({/foreach})
</select>
日前まで <input type="text" name="1_percent5" value="({$cancel_data.0.percent5})" size=15> ％</td>
</tr>
</table>
</td>
<td>
<table>
<tr>
<td bgcolor="#FFCCFF" width=350 align=center height=30>
<input type="checkbox" name="2_flag" value="1" ({if $cancel_data.1.flag})checked({/if})><b> 有効 / パターン２</b></td>
</tr>
<tr>
<td><select name="2_day1">
<option value="">　--選択--　</option>
({foreach from=$day_list item=item})
<option value="({$item})" ({if $cancel_data.1.day1 == $item})selected({/if})>　({$item})　</option>
({/foreach})
</select>
日以前 <input type="text" name="2_percent1" value="({$cancel_data.1.percent1})" size=15> ％</td>
</tr>
<tr>
<td><select name="2_day2">
<option value="">　--選択--　</option>
({foreach from=$day_list item=item})
<option value="({$item})" ({if $cancel_data.1.day2 == $item})selected({/if})>　({$item})　</option>
({/foreach})
</select>
日前まで <input type="text" name="2_percent2" value="({$cancel_data.1.percent2})" size=15> ％</td>
</tr>
<tr>
<td><select name="2_day3">
<option value="">　--選択--　</option>
({foreach from=$day_list item=item})
<option value="({$item})" ({if $cancel_data.1.day3 == $item})selected({/if})>　({$item})　</option>
({/foreach})
</select>
日前まで <input type="text" name="2_percent3" value="({$cancel_data.1.percent3})" size=15> ％</td>
</tr>
<tr>
<td><select name="2_day4">
<option value="">　--選択--　</option>
({foreach from=$day_list item=item})
<option value="({$item})" ({if $cancel_data.1.day4 == $item})selected({/if})>　({$item})　</option>
({/foreach})
</select>
日前まで <input type="text" name="2_percent4" value="({$cancel_data.1.percent4})" size=15> ％</td>
</tr>
<tr>
<td><select name="2_day5">
<option value="">　--選択--　</option>
({foreach from=$day_list item=item})
<option value="({$item})" ({if $cancel_data.1.day5 == $item})selected({/if})>　({$item})　</option>
({/foreach})
</select>
日前まで <input type="text" name="2_percent5" value="({$cancel_data.1.percent5})" size=15> ％</td>
</tr>
</table>
</td>
</tr>
<tr>
<td>
<table>
<tr>
<td bgcolor="#FFCCFF" width=350 align=center height=30>
<input type="checkbox" name="3_flag" value="1" ({if $cancel_data.2.flag})checked({/if})><b> 有効 / パターン３</b></td>
</tr>
<tr>
<td><select name="3_day1">
<option value="">　--選択--　</option>
({foreach from=$day_list item=item})
<option value="({$item})" ({if $cancel_data.2.day1 == $item})selected({/if})>　({$item})　</option>
({/foreach})
</select>
日以前 <input type="text" name="3_percent1" value="({$cancel_data.2.percent1})" size=15> ％</td>
</tr>
<tr>
<td><select name="3_day2">
<option value="">　--選択--　</option>
({foreach from=$day_list item=item})
<option value="({$item})" ({if $cancel_data.2.day2 == $item})selected({/if})>　({$item})　</option>
({/foreach})
</select>
日前まで <input type="text" name="3_percent2" value="({$cancel_data.2.percent2})" size=15> ％</td>
</tr>
<tr>
<td><select name="3_day3">
<option value="">　--選択--　</option>
({foreach from=$day_list item=item})
<option value="({$item})" ({if $cancel_data.2.day3 == $item})selected({/if})>　({$item})　</option>
({/foreach})
</select>
日前まで <input type="text" name="3_percent3" value="({$cancel_data.2.percent3})" size=15> ％</td>
</tr>
<tr>
<td><select name="3_day4">
<option value="">　--選択--　</option>
({foreach from=$day_list item=item})
<option value="({$item})" ({if $cancel_data.2.day4 == $item})selected({/if})>　({$item})　</option>
({/foreach})
</select>
日前まで <input type="text" name="3_percent4" value="({$cancel_data.2.percent4})" size=15> ％</td>
</tr>
<tr>
<td><select name="3_day5">
<option value="">　--選択--　</option>
({foreach from=$day_list item=item})
<option value="({$item})" ({if $cancel_data.2.day5 == $item})selected({/if})>　({$item})　</option>
({/foreach})
</select>
日前まで <input type="text" name="3_percent5" value="({$cancel_data.2.percent5})" size=15> ％</td>
</tr>
</table>
</td>
<td>
<table>
<tr>
<td bgcolor="#FFCCFF" width=350 align=center height=30>
<input type="checkbox" name="4_flag" value="1" ({if $cancel_data.3.flag})checked({/if})><b> 有効 / パターン４</b></td>
</tr>
<tr>
<td><select name="4_day1">
<option value="">　--選択--　</option>
({foreach from=$day_list item=item})
<option value="({$item})" ({if $cancel_data.3.day1 == $item})selected({/if})>　({$item})　</option>
({/foreach})
</select>
日以前 <input type="text" name="4_percent1" value="({$cancel_data.3.percent1})" size=15> ％</td>
</tr>
<tr>
<td><select name="4_day2">
<option value="">　--選択--　</option>
({foreach from=$day_list item=item})
<option value="({$item})" ({if $cancel_data.3.day2 == $item})selected({/if})>　({$item})　</option>
({/foreach})
</select>
日前まで <input type="text" name="4_percent2" value="({$cancel_data.3.percent2})" size=15> ％</td>
</tr>
<tr>
<td><select name="4_day3">
<option value="">　--選択--　</option>
({foreach from=$day_list item=item})
<option value="({$item})" ({if $cancel_data.3.day3 == $item})selected({/if})>　({$item})　</option>
({/foreach})
</select>
日前まで <input type="text" name="4_percent3" value="({$cancel_data.3.percent3})" size=15> ％</td>
</tr>
<tr>
<td><select name="4_day4">
<option value="">　--選択--　</option>
({foreach from=$day_list item=item})
<option value="({$item})" ({if $cancel_data.3.day4 == $item})selected({/if})>　({$item})　</option>
({/foreach})
</select>
日前まで <input type="text" name="4_percent4" value="({$cancel_data.3.percent4})" size=15> ％</td>
</tr>
<tr>
<td><select name="4_day5">
<option value="">　--選択--　</option>
({foreach from=$day_list item=item})
<option value="({$item})" ({if $cancel_data.3.day5 == $item})selected({/if})>　({$item})　</option>
({/foreach})
</select>
日前まで <input type="text" name="4_percent5" value="({$cancel_data.3.percent5})" size=15> ％</td>
</tr>
</table>
</td>
</tr>
<tr>
<td>
<table>
<tr>
<td bgcolor="#FFCCFF" width=350 align=center height=30>
<input type="checkbox" name="5_flag" value="1" ({if $cancel_data.4.flag})checked({/if})><b> 有効 / パターン５</b></td>
</tr>
<tr>
<td><select name="5_day1">
<option value="">　--選択--　</option>
({foreach from=$day_list item=item})
<option value="({$item})" ({if $cancel_data.4.day1 == $item})selected({/if})>　({$item})　</option>
({/foreach})
</select>
日以前 <input type="text" name="5_percent1" value="({$cancel_data.4.percent1})" size=15> ％</td>
</tr>
<tr>
<td><select name="5_day2">
<option value="">　--選択--　</option>
({foreach from=$day_list item=item})
<option value="({$item})" ({if $cancel_data.4.day2 == $item})selected({/if})>　({$item})　</option>
({/foreach})
</select>
日前まで <input type="text" name="5_percent2" value="({$cancel_data.4.percent2})" size=15> ％</td>
</tr>
<tr>
<td><select name="5_day3">
<option value="">　--選択--　</option>
({foreach from=$day_list item=item})
<option value="({$item})" ({if $cancel_data.4.day3 == $item})selected({/if})>　({$item})　</option>
({/foreach})
</select>
日前まで <input type="text" name="5_percent3" value="({$cancel_data.4.percent3})" size=15> ％</td>
</tr>
<tr>
<td><select name="5_day4">
<option value="">　--選択--　</option>
({foreach from=$day_list item=item})
<option value="({$item})" ({if $cancel_data.4.day4 == $item})selected({/if})>　({$item})　</option>
({/foreach})
</select>
日前まで <input type="text" name="5_percent4" value="({$cancel_data.4.percent4})" size=15> ％</td>
</tr>
<tr>
<td><select name="5_day5">
<option value="">　--選択--　</option>
({foreach from=$day_list item=item})
<option value="({$item})" ({if $cancel_data.4.day5 == $item})selected({/if})>　({$item})　</option>
({/foreach})
</select>
日前まで <input type="text" name="5_percent5" value="({$cancel_data.4.percent5})" size=15> ％</td>
</tr>
</table>
</td>
<td>
<table>
<tr>
<td bgcolor="#FFCCFF" width=350 align=center height=30>
<input type="checkbox" name="6_flag" value="1" ({if $cancel_data.5.flag})checked({/if})><b> 有効 / パターン６</b></td>
</tr>
<tr>
<td><select name="6_day1">
<option value="">　--選択--　</option>
({foreach from=$day_list item=item})
<option value="({$item})" ({if $cancel_data.5.day1 == $item})selected({/if})>　({$item})　</option>
({/foreach})
</select>
日以前 <input type="text" name="6_percent1" value="({$cancel_data.5.percent1})" size=15> ％</td>
</tr>
<tr>
<td><select name="6_day2">
<option value="">　--選択--　</option>
({foreach from=$day_list item=item})
<option value="({$item})" ({if $cancel_data.5.day2 == $item})selected({/if})>　({$item})　</option>
({/foreach})
</select>
日前まで <input type="text" name="6_percent2" value="({$cancel_data.5.percent2})" size=15> ％</td>
</tr>
<tr>
<td><select name="6_day3">
<option value="">　--選択--　</option>
({foreach from=$day_list item=item})
<option value="({$item})" ({if $cancel_data.5.day3 == $item})selected({/if})>　({$item})　</option>
({/foreach})
</select>
日前まで <input type="text" name="6_percent3" value="({$cancel_data.5.percent3})" size=15> ％</td>
</tr>
<tr>
<td><select name="6_day4">
<option value="">　--選択--　</option>
({foreach from=$day_list item=item})
<option value="({$item})" ({if $cancel_data.5.day4 == $item})selected({/if})>　({$item})　</option>
({/foreach})
</select>
日前まで <input type="text" name="6_percent4" value="({$cancel_data.5.percent4})" size=15> ％</td>
</tr>
<tr>
<td><select name="6_day5">
<option value="">　--選択--　</option>
({foreach from=$day_list item=item})
<option value="({$item})" ({if $cancel_data.5.day5 == $item})selected({/if})>　({$item})　</option>
({/foreach})
</select>
日前まで <input type="text" name="6_percent5" value="({$cancel_data.5.percent5})" size=15> ％</td>
</tr>
</table>
</td>
</tr>

</table>
<br>
<input type="submit" value="　登　録　">
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
