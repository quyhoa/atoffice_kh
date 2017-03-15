({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminDesign.tpl"})
({assign var="page_name" value="貸し止め(準備担当)"})
({ext_include file="inc_tree_adminDesign.tpl"})
</div>

({*ここまで:navi*})

({*権限チェック*})
({if $atoffice_auth_type==2 or $atoffice_auth_type==3 or $atoffice_auth_type==4})

<style type="text/css">
<!--
HR {
	border-style:dotted;color:#3399FF

}
-->
</style>

<h2 id="ttl01">貸し止め(準備担当)</h2>
<br>
<center>
({if $msg})<p class="actionMsg">({$msg})</p><br><br>({/if})

<br><br>
<table border=1>
({if $atoffice_auth_type==4})

<form name="change_hall_id" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('rental_stop2','page')})" />

<tr>
<td>
会場選択</td>
<td>
<select name="hall_list">
({foreach from=$hall_list item=item})
	<option value="({$item.hall_id})" ({if $item.hall_id==$hall_id})selected({/if})>({$item.hall_name})</option>
({/foreach})
</select>
</td>
<td rowspan=2>
<input type="submit" value="　変更　">
</td>
</tr>

<tr>
<td>日付変更</td>
<td>
<select name="year">
	<option value="({$this_year})" ({if $this_year==$year})selected({/if})>({$this_year})</option>
	<option value="({$this_year+1})" ({if $this_year+1==$year})selected({/if})>({$this_year+1})</option>
</select> 年 
<select name="month">
({foreach from=$month_list item=item})
	<option value="({$item})" ({if $item==$month})selected({/if})>({$item})</option>
({/foreach})
</select> 月 
<select name="day">
({foreach from=$day_list key=key item=item})
	<option value="({$item})" ({if $item==$day})selected({/if})>({$item})（({$week_list.$key})）</option>
({/foreach})
</select> 日
</td>
</tr>
</form>

({else if $atoffice_auth_type==3})
<form name="change_hall_id" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('rental_stop2','page')})" />
<tr>
	<td>
	会場選択</td>
	<td colspan="2">
	<select name="hall_list">
		({foreach from=$hall_list item=label key=key})			
			({foreach from=$label item=item})
				<option value="({$item.hall_id})" ({if $item.hall_id==$hall_id})selected({/if})>({$item.hall_name})</option>
			({/foreach})
		({/foreach})
	</select>
	</td>
</tr>
<tr>
<td>日付変更</td>
<td>
<select name="year">
	<option value="({$this_year})" ({if $this_year==$year})selected({/if})>({$this_year})</option>
	<option value="({$this_year+1})" ({if $this_year+1==$year})selected({/if})>({$this_year+1})</option>
</select> 年 
<select name="month">
({foreach from=$month_list item=item})
	<option value="({$item})" ({if $item==$month})selected({/if})>({$item})</option>
({/foreach})
</select> 月 
<select name="day">
({foreach from=$day_list item=item})
	<option value="({$item})" ({if $item==$day})selected({/if})>({$item})</option>
({/foreach})
</select> 日 
</td>
<td>
<input type="submit" value="　変更　">
</td>
</tr>
</form>
({/if})

<tr>
<td>
メモ
</td>
<form name="rental_stop" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="do_({$hash_tbl->hash('set_rental_stop2','do')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
<td colspan=2><input type="text" name="memo" value="" size=50></td>
</tr>

</table>
<br>



<table width=100%>
<tr>
<td height=60px bgcolor=#CCCCFF style='border: 1px #000000 solid;text-align:center;vertical-align:middle;font-size:15px;'>
<b>({$hall_data.hall_name}) ({$year})年({$month})月({$day})日（({$week})）</b>
<input type="submit" value="貸し止め更新">
<input type="hidden" name="year" value="({$year})">
<input type="hidden" name="month" value="({$month})">
<input type="hidden" name="day" value="({$day})">
<input type="hidden" name="hid" value="({$hall_id})">
</td>
</tr>
</table>
<table width=100%>
<tr>
<th style='border: 1px #000000 solid;text-align: center;' width="150">
	部屋名
</th>
({foreach from=$open_time item=time})
	<th bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;' colspan=4><b>
		({$time}):00 ～ ({$time+1}):00
	</b></th>
({/foreach})
</tr>

({foreach from=$room_data key=key item=value})
	<tr>
	<td style='border: 1px #000000 solid;text-align: center;' >
		({$value.room_name})
	</td>
	({if $value.holiday})
		<td colspan=({$ct*4}) style='border: 1px #000000 solid;text-align: center;' bgcolor=#FF6666><b>休室日</b></td>
		</tr>
	({else})({**value.holiday**})

		({if $value.type==2})
			({foreach from=$value.opentime key=k item=v})
				<td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' colspan=({$v.cs}) 
				({if $v.reserved})
					bgcolor=#FFDCDC><span style='color:#FF0000;'><b>
予約ID:({$v.reserved})<br>
代表名：({$v.corp})<br>
予約者：({$v.c_member.nickname}) 様<br>
状態：
({if $v.reserve_data.tmp_flag==1})
	仮予約
({elseif $v.reserve_data.pay_flag==0 and $v.reserve_data.pay_money==0})
	未入金
({elseif $v.reserve_data.pay_flag==0 and $v.reserve_data.pay_money>0})
	一部入金
({elseif $v.reserve_data.pay_flag==1})
	入金済み
({elseif $v.reserve_data.pay_flag==2})
	過剰入金
({/if})
</b></span>
				({elseif $v.stoped})
					bgcolor=#FFCCFF>貸し止め中<br>
					有効期限：({$v.stoped.limit_datetime})<br>
					担当者：({$v.stoped.admin_name})<br>
					({$v.stoped.memo})<br>
					削除：<input type='checkbox' name='delete_data({$key})_({$k})' value='({$v.stoped.stop_id})'>

				({else})
					>
					<input type='checkbox' name='stop_data({$key})_({$k})' value='({$hall_data.hall_id}),({$value.room_id}),({$year})-({$month})-({$day}) ({$v.begin_time}),({$year})-({$month})-({$day}) ({if $v.finish_time=="24:00"})23:59:59({else})({$v.finish_time})({/if})'>
				({/if})
				</td>
			({/foreach})
		({else})({**type**})

			({foreach from=$value.komawari key=k item=v})
				<td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' colspan=({$v.cs}) 
				({if $v.reserved})
					bgcolor=#FFDCDC><span style='color:#FF0000;'><b>
予約ID:({$v.reserved})<br>
代表名：({$v.corp})<br>
予約者：({$v.c_member.nickname}) 様<br>
状態：
({if $v.reserve_data.tmp_flag==1})
	仮予約
({elseif $v.reserve_data.pay_flag==0 and $v.reserve_data.pay_money==0})
	未入金
({elseif $v.reserve_data.pay_flag==0 and $v.reserve_data.pay_money>0})
	一部入金
({elseif $v.reserve_data.pay_flag==1})
	入金済み
({elseif $v.reserve_data.pay_flag==2})
	過剰入金
({/if})
<br>


</b></span>
				({elseif $v.stoped})
					bgcolor=#FFCCFF>貸し止め中<br>
					有効期限：({$v.stoped.limit_datetime})<br>
					担当者：({$v.stoped.admin_name})<br>
					({$v.stoped.memo})<br>
					削除：<input type='checkbox' name='delete_data({$key})_({$k})' value='({$v.stoped.stop_id})'>
				({elseif $v.rest})
					bgcolor=#CDCDCD>休憩
				({else})
					>
					<input type='checkbox' name='stop_data({$key})_({$k})' value='({$hall_data.hall_id}),({$value.room_id}),({$year})-({$month})-({$day}) ({$v.begin_time}),({$year})-({$month})-({$day}) ({if $v.finish_time=="24:00"})23:59:59({else})({$v.finish_time})({/if})'>
				({/if})
				</td>
			({/foreach})
		({/if})({**type**})

	({/if})({**value.holiday**})
	</td>
	</tr>
({/foreach})

</table>

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
