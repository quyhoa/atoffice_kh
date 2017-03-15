({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminDesign.tpl"})
({assign var="page_name" value="予約状況検索"})
({ext_include file="inc_tree_adminDesign.tpl"})
</div>

({*ここまで:navi*})

({*権限チェック*})
({if $atoffice_auth_type==3 or $atoffice_auth_type==4})


<script type="text/javascript">
function newwinprint(kanban){
	winprint=window.open("./atoffice/pages/sub/kanban.php?kanban="+kanban);
}
</script>

<style type="text/css">
<!--
HR {
	border-style:dotted;color:#3399FF

}
-->
</style>

<h2 id="ttl01">予約状況検索</h2>
<br>
<center>
({if $msg})<p class="actionMsg">({$msg})</p><br><br>({/if})

<br><br>

	<form name="change_hall_id" method="POST" action="./">
	<input type="hidden" name="m" value="({$module_name})" />
	<input type="hidden" name="a" value="page_({$hash_tbl->hash('tomorrow_reservation','page')})" />
	<table border=1 width=700>
	<tr>
	({if $atoffice_auth_type==4})
	<th>会場選択</th>
	({/if})
	({if $atoffice_auth_type==3})
	<th>会場選択</th>
	({/if})
	<th>日にち選択</th>
	<td rowspan=2>
	<input type="submit" value="　決定　">
	</td>
	</tr>

	<tr>
	({if $atoffice_auth_type==4})
	<td>
		<select name="hall_list">

			({foreach from=$hall_list item=item})
				<option value="({$item.hall_id})"({if $item.hall_id==$hall_id})selected({/if})>({$item.hall_name})</option>
			({/foreach})
		</select>
	</td>
	({/if})
	({if $atoffice_auth_type==3})
	<td>	
		<select name="hall_list">
			({foreach from=$hall_list item=label key=key})			
				({foreach from=$label item=item})
					<option value="({$item.hall_id})"({if $item.hall_id==$hall_id})selected({/if})>({$item.hall_name})</option>
				({/foreach})
			({/foreach})
		</select>
	</td>
	({/if})
	<td>
	<select name="year">
	({foreach from=$year_list item=item})
		<option value="({$item})" 
		({if $item==$year})selected({/if})
		>({$item})</option>
	({/foreach})
	</select> 年 
	<select name="month">
	({foreach from=$month_list item=item})
		<option value="({$item})" 
		({if $item==$month})selected({/if})
		>({$item})</option>
	({/foreach})
	</select> 月 
	<select name="day">
	({foreach from=$day_list key=key item=item})
		<option value="({$item})" 
		({if $item==$day})selected({/if})
		>({$item})（({$week_list.$key})）</option>
	({/foreach})
	</select> 日

	</td>
	</tr>
	</table>
	</form>
	<br>


<table width=100%>
<tr>
<td height=60px bgcolor=#CCCCFF style='border: 1px #000000 solid;text-align:center;vertical-align:middle;font-size:15px;'>
<center>
<table>
<tr>
<td width=100>
<form name="change_date1" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('tomorrow_reservation','page')})" />
<input type="hidden" name="hall_list" value="({$hall_id})">
<input type="hidden" name="year" value="({$year})">
<input type="hidden" name="month" value="({$month})">
<input type="hidden" name="day" value="({$day-1})">
<input type="submit" value="←前日">
</form>
</td>
<td width=450>
<b>({$hall_data.hall_name}) ({$year})年({$month})月({$day})日（({$week})）</b>
</td>
<td>
<form name="change_date1" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('tomorrow_reservation','page')})" />
<input type="hidden" name="hall_list" value="({$hall_id})">
<input type="hidden" name="year" value="({$year})">
<input type="hidden" name="month" value="({$month})">
<input type="hidden" name="day" value="({$day+1})">
<input type="submit" value="翌日→">
</form>
</td>
</tr>
</table>
</center>
</td>
</tr>
</table>
<table width=100%>

({assign var=line value=0})
({foreach from=$room_data key=key item=value})
	({if ($line%5)==0})
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
	({/if})
	({assign var=line value=$line+1})
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
({/if})
({if $v.reserve_data.complete_flag==0})
	(完了報告待ち)
({else})
	(完了報告済み)
({/if})
<br>
***利用目的***<br>
({if $v.reserve_data.purpose==1})
	会議
({elseif $v.reserve_data.purpose==2})
	セミナー
({elseif $v.reserve_data.purpose==3})
研修
({elseif $v.reserve_data.purpose==4})
面接・試験
({elseif $v.reserve_data.purpose==5})
懇談会・パーティ
({elseif $v.reserve_data.purpose==6})
その他
({else})
未選択
({/if})
<br>
*** 準備備品 ***<br>
({foreach from=$v.reserve_v_list item=item})
	({if $item==0})
		なし<br>
	({else})
		({$item.vessel_name})(({$item.num}))<br>
	({/if})
({/foreach})
*** 準備ｻｰﾋﾞｽ ***<br>
({foreach from=$v.reserve_s_list item=item})
	({if $item==0})
		なし<br>
	({else})
		({$item.service_name})(({$item.num}))<br>
	({/if})
({/foreach})

*** 社内メモ ***<br>
({if $v.reserve_data.memo})
({$v.reserve_data.memo|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
({else})
なし<br>
({/if})
<br>

({if $v.kanban})
<INPUT type='button' onclick=newwinprint('({$v.kanban})') value='　看板印刷　'>
({else})
看板入力なし<br>
({/if})
</b></span>

                ({elseif $v.stoped})
					bgcolor=#FFCCFF>貸し止め中<br>
					有効期限：({if $v.stoped.limit_datetime == "0000-00-00 00:00:00"})なし({else})({$v.stoped.limit_datetime})({/if})<br>
					担当者：({$v.stoped.admin_name})<br>
					({$v.stoped.memo})<br>

				({else})
					>
					-- --
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
({/if})
({if $v.reserve_data.complete_flag==0})
	(完了報告待ち)
({else})
	(完了報告済み)
({/if})
<br>
***利用目的***<br>
({if $v.reserve_data.purpose==1})
	会議
({elseif $v.reserve_data.purpose==2})
	セミナー
({elseif $v.reserve_data.purpose==3})
研修
({elseif $v.reserve_data.purpose==4})
面接・試験
({elseif $v.reserve_data.purpose==5})
懇談会・パーティ
({elseif $v.reserve_data.purpose==6})
その他
({else})
未選択
({/if})
<br>*** 準備備品 ***<br>
({foreach from=$v.reserve_v_list item=item})
	({if $item==0})
		なし<br>
	({else})
		({$item.vessel_name})(({$item.num}))<br>
	({/if})
({/foreach})
*** 準備ｻｰﾋﾞｽ ***<br>
({foreach from=$v.reserve_s_list item=item})
	({if $item==0})
		なし<br>
	({else})
		({$item.service_name})(({$item.num}))<br>
	({/if})
({/foreach})
*** 社内メモ ***<br>
({if $v.reserve_data.memo})
({$v.reserve_data.memo|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
({else})
なし<br>
({/if})
<br>
({if $v.kanban})
<INPUT type='button' onclick=newwinprint('({$v.kanban})') value='　看板印刷　'>
({else})
看板入力なし<br>
({/if})
</b></span>




</b></span>
                ({elseif $v.stoped})
					bgcolor=#FFCCFF>貸し止め中<br>
					有効期限：({if $v.stoped.limit_datetime == "0000-00-00 00:00:00"})なし({else})({$v.stoped.limit_datetime})({/if})<br>
					担当者：({$v.stoped.admin_name})<br>
					({$v.stoped.memo})<br>
				({elseif $v.rest})
					bgcolor=#CDCDCD>休憩
				({else})
					>
					-- --
				({/if})
				</td>
			({/foreach})
		({/if})({**type**})

	({/if})({**value.holiday**})
	</td>
	</tr>
({/foreach})
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

</table>

</center>
<h2 id="ttl01">({$year})年({$month})月({$day})日（({$week})）の予約一覧</h2>
<br>
<table border=1>
<tr>
<th width=200>部屋名</th>
<th width=200>予約時間</th>
<th width=200>法人/団体名</th>
<th width=400>看板</th>
</tr>

({foreach from=$room_data key=key item=value})
	({foreach from=$value.opentime key=k item=v})
		({if $v.reserve_data})
<tr>
			<td>({$value.room_name})</td><td>({$v.begin})～({$v.finish})</td><td>({$v.corp})</td><td>({$v.reserve_data.kanban|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})</td>
</tr>
		({/if})
	({/foreach})
	({foreach from=$value.komawari key=k item=v})
		({if $v.reserve_data})
<tr>
			<td>({$value.room_name})</td><td>({$v.begin})～({$v.finish})</td><td>({$v.corp})</td><td>({$v.reserve_data.kanban|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})</td>
</tr>
		({/if})
	({/foreach})
({/foreach})

</table>


({else})
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
({/if})
<div>
({$inc_footer|smarty:nodefaults})
