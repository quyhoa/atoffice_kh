({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminSiteMember.tpl"})
({assign var="page_name" value="顧客利用状況"})
({ext_include file="inc_tree_adminSiteMember.tpl"})
</div>

({*ここまで:navi*})

({*権限チェック*})
({if $atoffice_auth_type==2 or $atoffice_auth_type==4})

<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('customer_use_state','page')})" />

顧客特定<br>
顧客ID
<input type="text" name="c_member_id" value="({$c_member_id})"><br>
予約者
<input type="text" name="nickname" value="({$nickname})"><br>
法人/団体名
<input type="text" name="corp" value="({$corp})"><br>
利用範囲
<input type="text" name="year1" value="({$year1})" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month1" value="({$month1})" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day1" value="({$day1})" size=2 style="text-align:right;padding-right:5px;">日 ～ 
<input type="text" name="year2" value="({$year2})" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month2" value="({$month2})" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day2" value="({$day2})" size=2 style="text-align:right;padding-right:5px;">日
<input type="submit" value="出力">
</form>
<br>
<hr>
<h3>({$title})</h3>
({if $c_member})

法人/団体名：({$c_member.corp})<br>
予約者：({$c_member.nickname})<br>
顧客ID：({$c_member.c_member_id})<br>
電話：({$c_member.tel})<br>
FAX：({$c_member.fax})<br>
住所：({$c_member.address})<br>
<br>
({if $year1 and $month1 and $day1 and $year2 and $month2 and $day2})
利用範囲：({$year1})年({$month1})月({$day1})日 ～ ({$year2})年({$month2})月({$day2})日<br>
<br>
({/if})

<table border=1>
<tr>
<td>予約ID</td> <!-- Title Booking ID -->
<td>利用日</td>
<td>会場</td>
<td>部屋</td>
<td>利用時間帯</td>
<td>金額</td><!-- money -->

<!-- <td>利用時間</td>
<td>用途</td> -->
</tr>
({foreach from=$reserve_data item=item})
<td>({$item.reserve_id})</td> <!-- Add Booking ID -->
<td>({$item.date})</td>
<td>({$item.hall_name})</td>
<td>({$item.room_name})</td>
<td>({$item.time})</td>
<td>({$item.total_price|number_format:0})円</td>
<!-- <td>({$item.between_time|round})時間</td>
<td>({$item.purpose})</td> -->
</tr>
({/foreach})
<!-- <td></td>
<td></td>
<td></td>
<td>総利用時間</td>
<td>({$total_time})時間</td>
<td></td>
</tr> -->
<td></td>
<td></td>
<td></td>
<td></td>
<td>合計金額</td>
<td>({$total_money|number_format:0})円</td>
</tr>
({else})
顧客が特定できません。
({/if})
({**************************************************************})

</td>
</tr>
</table>

</center>
({else})
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
({/if})
<div>
({$inc_footer|smarty:nodefaults})
