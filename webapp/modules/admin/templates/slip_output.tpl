({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminStatisticalInformation.tpl"})
({assign var="page_name" value="帳票出力"})
({ext_include file="inc_tree_adminStatisticalInformation.tpl"})
</div>

({*ここまで:navi*})

({*権限チェック*})
({if $atoffice_auth_type==4})

<h2 id="ttl01">帳票出力</h2>
<br>
<center>

({if $msg})<p class="actionMsg">({$msg})</p><br><br>({/if})

<table width = 1100>
<tr>
<td align=left width=198 valign=top>

<h3>管理系</h3>
({if $menu=="sales_expectation"})
<span style="color:#FF0000;"><b>⇒売上見込表</b></span>
({else})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('slip_output')})&menu=sales_expectation">
売上見込表
</a>
({/if})
<br>
({if $menu=="news_flash"})
<span style="color:#FF0000;"><b>⇒予約・売上速報</b></span>
({else})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('slip_output')})&menu=news_flash">
予約・売上速報
</a>
({/if})
<br>

({if $menu=="sales_report"})
<span style="color:#FF0000;"><b>⇒売上報告書（社内）</b></span>
({else})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('slip_output')})&menu=sales_report">
売上報告書（社内）
</a>
({/if})
<br>

({if $menu=="business_report"})
<span style="color:#FF0000;"><b>⇒業務報告（委託者用）</b></span>
({else})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('slip_output')})&menu=business_report">
業務報告（委託者用）
</a>
({/if})
<br>

({if $menu=="unpayment_list"})
<span style="color:#FF0000;"><b>⇒未入金リスト</b></span>
({else})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('slip_output')})&menu=unpayment_list">
未入金リスト
</a>
({/if})
<br>
<!-- add cancel payment-->
({if $menu=="cancelpayment_list"})
<span style="color:#FF0000;"><b>=>キャンセル料未入金リスト</b></span>
({else})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('slip_output')})&menu=cancelpayment_list">
キャンセル料未入金リスト
</a>
({/if})
<br>
<!-- end -->

({if $menu=="payment_record"})
<span style="color:#FF0000;"><b>⇒入金記録</b></span>
({else})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('slip_output')})&menu=payment_record">
入金記録
</a>
({/if})
<br>

({if $menu=="management_analysis"})
<span style="color:#FF0000;"><b>⇒会場運営分析</b></span>
({else})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('slip_output')})&menu=management_analysis">
会場運営分析
</a>
({/if})
<br>

({if $menu=="use_schedule_list"})
<span style="color:#FF0000;"><b>⇒利用予定一覧</b></span>
({else})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('slip_output')})&menu=use_schedule_list">
利用予定一覧
</a>
({/if})
<br>

<br>
<h3>分析系</h3>

({if $menu=="utilization_rates"})
<span style="color:#FF0000;"><b>⇒稼働率一覧</b></span>
({else})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('slip_output')})&menu=utilization_rates">
稼働率一覧
</a>
({/if})
<br>

({if $menu=="money_utilization_rates"})
<span style="color:#FF0000;"><b>⇒金額稼働率推移</b></span>
({else})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('slip_output')})&menu=money_utilization_rates">
金額稼働率推移
</a>
({/if})
<br>

({if $menu=="time_utilization_rates"})
<span style="color:#FF0000;"><b>⇒時間稼働率推移</b></span>
({else})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('slip_output')})&menu=time_utilization_rates">
時間稼働率推移
</a>
({/if})
<br>
({if $menu=="repetition_rate"})
<span style="color:#FF0000;"><b>⇒リピート率分析</b></span>
({else})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('slip_output')})&menu=repetition_rate">
リピート率分析
</a>
({/if})
<br>

({if $menu=="user_analysis"})
<span style="color:#FF0000;"><b>⇒利用者分析（用途）</b></span>
({else})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('slip_output')})&menu=user_analysis">
利用者分析（用途）
</a>
({/if})
<br>

({if $menu=="utilization_rates_order"})
<span style="color:#FF0000;"><b>⇒会場稼働率順位</b></span>
({else})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('slip_output')})&menu=utilization_rates_order">
会場稼働率順位
</a>
({/if})
<br>

({if $menu=="room_utilization_rates_order"})
<span style="color:#FF0000;"><b>⇒部屋稼働率順位</b></span>
({else})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('slip_output')})&menu=room_utilization_rates_order">
部屋稼働率順位
</a>
({/if})
<br>


({if $menu=="repetition_order"})
<span style="color:#FF0000;"><b>⇒リピート率順位</b></span>
({else})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('slip_output')})&menu=repetition_order">
リピート率順位
</a>
({/if})
<br>

({if $menu=="cancellation_analysis"})
<span style="color:#FF0000;"><b>⇒キャンセル分析</b></span>
({else})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('slip_output')})&menu=cancellation_analysis">
キャンセル分析
</a>
({/if})
<br>

({if $menu=="analysis_at_reservation_period"})
<span style="color:#FF0000;"><b>⇒予約期間分析</b></span>
({else})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('slip_output')})&menu=analysis_at_reservation_period">
予約期間分析
</a>
({/if})
<br>

<br>
<h3>顧客管理系</h3>

({if $menu=="customer_use_state"})
<span style="color:#FF0000;"><b>⇒顧客利用状況</b></span>
({else})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('slip_output')})&menu=customer_use_state">
顧客利用状況
</a>
({/if})
<br>

({if $menu=="long_term_use"})
<span style="color:#FF0000;"><b>⇒長期利用顧客一覧</b></span>
({else})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('slip_output')})&menu=long_term_use">
長期利用顧客一覧
</a>
({/if})
<br>

({if $menu=="repeat_customer_list"})
<span style="color:#FF0000;"><b>⇒リピート顧客リスト</b></span>
({else})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('slip_output')})&menu=repeat_customer_list">
リピート顧客リスト
</a>
({/if})
<br>


</td>
<td width=2 bgcolor=#CDCDCD>
</td>
<td width=900 valign=top align=left>
<h2 id="ttl01">({$title})</h2>
<br>

({************************************************************************})
({if $menu=="business_report"})

<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('slip_output','page')})" />
<input type="hidden" name="menu" value="business_report">

<select name="hall_id" size=5 valign=top>
({foreach from=$hall_list item=item})
<option value="({$item.hall_id})" ({if $item.hall_id == $hall_id})selected({/if})>({$item.hall_name})
({/foreach})
</select>

<input type="text" name="year" value="({$year})" size=8 style="text-align:right;padding-right:5px;">年 
<input type="text" name="month" value="({$month})" size=2 style="text-align:right;padding-right:5px;">月度
<input type="submit" value="出力">
</form>
<br>
<hr>
<h3>({$title})</h3>
<br>

({if $reserve_data})

<div style='width:900px;overflow-x:scroll;'>

【お支払表】({$hall_data.hall_name})　({$year})年({$month})月度<br>
<br>
１．({$month})月度入金明細（対象期間に利用且つ入金済）<br>
<table border=1 width=1000>
<tr>
<th>予約ID</th>
<th>利用日</th>
<th>部屋</th>
<th>利用時間</th>
<th>部屋利用入金</th>
<th>キャンセル料</th>
<th>配分比</th>
<th>お支払い</th>
<th>備品利用入金(税込)</th>
<th>配分比</th>
<th>お支払い(税込)</th>
<th>お支払い総額(税込)</th>
<th>備品明細</th>
<th>入金期日</th>
<th>入金日</th>
<th>紹介代理店</th>
<th>キャンセル</th>
({*<th>備考</th>*})
<th>AO収益</th>
</tr>
({assign var="total_vessel_aomops" value="0"})
({assign var="total_room_aomops" value="0"})
({foreach from=$reserve_data item=item})
({if $item.pay_date })
<tr>
<td align=right>({$item.reserve_id})</td>
<td align=center>({$item.date})</td>
<td align=center>({$item.room_name})</td>
<td align=center>({$item.time})</td>
<td align=right>
({if $item.cancel_price<0})
({$item.room_price|number_format})
({else})
0
({/if})
</td>
<td align=right>
({if $item.cancel_price>=0})
({$item.cancel_price|number_format})
({else})
0
({/if})
</td>
<td align=right>({$hall_data.owner_room})%</td>
<td align=right>({$item.room_aomop|number_format})</td>
<td align=right>({$item.vessel_price|number_format})</td>
<td align=right>({$hall_data.owner_vessel})%</td>
<td align=right>({$item.vessel_aomop|number_format})</td>
<td align=right>({$item.total_aomop|number_format})</td>
<td>
({foreach from=$item.vessel_data item=i})
({$i.vessel_name})/
({/foreach})
</td>
<td align=center>
({if $item.pay_limitdate=="0000-00-00 00:00:00"})
<span style="color:#FF0000">未設定</span>
({else})
({$item.limit_date})
({/if})
</td>
<td align=center>({$item.pay_date})</td>

<td align=center>({if $agency_list[$item.c_member_id]})紹介({/if})</td>
<td align=center>({if $item.cancel_price>=0})({$item.cancel_date})({/if})</td>
<td align=right>({$item.earnings|number_format})</td>
</tr>
({assign var="total_room_aomops" value="$total_room_aomops+$item.room_aomop"})
({assign var="total_vessel_aomops" value="$total_vessel_aomops+$item.vessel_aomop"})
({/if})
({/foreach})

<tr>
<td>合計</td>
<td></td>
<td></td>
<td></td>
<td align=right>({$total_room_price|number_format})</td>
<td align=right>({$total_cancel_price|number_format})</td>
<td></td>
<td align=right>({$total_room_aomop|number_format})</td>
<td align=right>({$total_vessel_price|number_format})</td>
<td></td>
<td align=right>({$total_vessel_aomops|number_format})</td>
<td align=right>({$total_total_aomop|number_format})</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td align=right>({$total_earnings|number_format})</td>
</tr>
</table>
<br>
<br>
２、過去利用者入金明細（過去に利用且つ対象期間に入金済）<br>
<table border=1 width=1000>
<tr>
<th>予約ID</th>
<th>利用日</th>
<th>部屋</th>
<th>利用時間</th>
<th>部屋利用入金(税込)</th>
<th>キャンセル料(税込)</th>
<th>配分比</th>
<th>お支払い(税込)</th>
<th>備品利用入金(税込)</th>
<th>配分比</th>
<th>お支払い(税込)</th>
<th>お支払い総額(税込)</th>
<th>備品明細</th>
<th>入金期日</th>
<th>入金日</th>
<th>紹介代理店</th>
<th>キャンセル</th>
({*<th>備考</th>*})
<th>AO収益</th>
</tr>
({foreach from=$paid_data item=item})
<tr>
<td align=right>({$item.reserve_id})</td>
<td align=center>({$item.date})</td>
<td align=center>({$item.room_name})</td>
<td align=center>({$item.time})</td>
<td align=right>
({if $item.cancel_price<0})
({$item.room_price|number_format})
({else})
0
({/if})
</td>
<td align=right>
({if $item.cancel_price>=0})
({$item.cancel_price|number_format})
({else})
0
({/if})
</td>
<td align=right>({$hall_data.owner_room})%</td>
<td align=right>({$item.room_aomop|number_format})</td>
<td align=right>({$item.vessel_price|number_format})</td>
<td align=right>({$hall_data.owner_vessel})%</td>
<td align=right>({$item.vessel_aomop|number_format})</td>
<td align=right>({$item.total_aomop|number_format})</td>
<td>
({foreach from=$item.vessel_data item=i})
({$i.vessel_name})/
({/foreach})
</td>
<td align=center>
({if $item.pay_limitdate=="0000-00-00 00:00:00"})
<span style="color:#FF0000">未設定</span>
({else})
({$item.limit_date})
({/if})
</td>
<td align=center>({$item.pay_date})</td>
<td align=center>({if $agency_list[$item.c_member_id]})紹介({/if})</td>
<td align=center>({if $item.cancel_price>=0})({$item.cancel_date})({/if})</td>
<td align=right>({$item.earnings|number_format})</td>
</tr>
({/foreach})
<tr>
<td>合計</td>
<td></td>
<td></td>
<td></td>
<td align=right>({$total_room_price_before|number_format})</td>
<td align=right>({$total_cancel_price_before|number_format})</td>
<td></td>
<td align=right>({$total_room_aomop_before|number_format})</td>
<td align=right>({$total_vessel_price_before|number_format})</td>
<td></td>
<td align=right>({$total_vessel_aomop_before|number_format})</td>
<td align=right>({$total_total_aomop_before|number_format})</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td align=right>({$total_earnings_before|number_format})</td>
</tr>
</table>
<br>
<br>
３、利用済み入金待ち一覧（対象期間及び以前含む）<br>
<table border=1 width=1000>
<tr>
<th>予約ID</th>
<th>利用日</th>
<th>部屋</th>
<th>利用時間</th>
<th>部屋利用入金(税込)</th>
<th>キャンセル料(税込)</th>
<th>配分比</th>
<th>お支払い(税込)</th>
<th>備品利用入金(税込)</th>
<th>配分比</th>
<th>お支払い(税込)</th>
<th>お支払い総額(税込)</th>
<th>備品明細</th>
<th>入金期日</th>
<th>入金日</th>
<th>紹介代理店</th>
<th>キャンセル</th>
({*<th>備考</th>*})
<th>AO収益</th>
</tr>
({foreach from=$unpayment_data item=item})
<tr>
<td align=right>({$item.reserve_id})</td>
<td align=center>({$item.date})</td>
<td align=center>({$item.room_name})</td>
<td align=center>({$item.time})</td>
<td align=right>
({if $item.cancel_price<0})
({$item.room_price|number_format})
({else})
0
({/if})
</td>
<td align=right>
({if $item.cancel_price>=0})
({$item.cancel_price|number_format})
({else})
0
({/if})
</td>
<td align=right>({$hall_data.owner_room})%</td>
<td align=right>({$item.room_aomop|number_format})</td>
<td align=right>({$item.vessel_price|number_format})</td>
<td align=right>({$hall_data.owner_vessel})%</td>
<td align=right>({$item.vessel_aomop|number_format})</td>
<td align=right>({$item.total_aomop|number_format})</td>
<td>
({foreach from=$item.vessel_data item=i})
({$i.vessel_name})/
({/foreach})
</td>
<td>
({if $item.pay_limitdate=="0000-00-00 00:00:00" || $item.pay_limitdate==''})
<span style="color:#FF0000">未設定</span>
({else})
({$item.limit_date})
({/if})
</td><td></td>

<td align=center>({if $agency_list[$item.c_member_id]})紹介({/if})</td>
<td align=center>({if $item.cancel_price>=0})
	({if $item.cancel_date !='' && $item.cancel_date !='0000-00-00 00:00:00'})
		({$item.cancel_date})
	({/if})	
({/if})
</td>
<td align=right>({$item.earnings|number_format})</td>
</tr>
({/foreach})
<tr>
<td>合計</td>
<td></td>
<td></td>
<td></td>
<td align=right>({$total_room_price_before_unpayment|number_format})</td>
<td align=right>({$total_cancel_price_before_unpayment|number_format})</td>
<td></td>
<td align=right>({$total_room_aomop_before_unpayment|number_format})</td>
<td align=right>({$total_vessel_price_before_unpayment|number_format})</td>
<td></td>
<td align=right>({$total_vessel_aomop_before_unpayment|number_format})</td>
<td align=right>({$total_total_aomop_before_unpayment|number_format})</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td align=right>({$total_earnings_before_unpayment|number_format})</td>
</tr>
</table>
<br>
<br>
４、当月お支払い金額<br>
利用入金済配分総額　({$price})円（税込）<br>
その他清算費用<br>
当月お支払い金額<br>
<br>
振り込み予定日<br>
お振込先口座<br>

</div>
({else})
対象データはありません。
({/if})

({******************** repetition_rate **********************************})
({elseif $menu=="repetition_rate"})
<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('slip_output','page')})" />
<input type="hidden" name="menu" value="repetition_rate">

<select name="hall_id" size=5 valign=top>
({foreach from=$hall_list item=item})
<option value="({$item.hall_id})" ({if $item.hall_id == $hall_id})selected({/if})>({$item.hall_name})
({/foreach})
</select>

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
<br>
表示日時 : ({$smarty.now|date_format:"%Y-%m-%d %H:%M:%S"})<br><br>
({if isset($rate)})

会場名：　({$hall_name})<br>
<table border=1 width=400>
<tr>
<td style='border: 1px #646464 solid;text-align: center;vertical-align:middle;'>予約期間</td>
<td style='border: 1px #646464 solid;text-align: center;vertical-align:middle;'>({$year1})年({$month1})月({$day1})日</td>
<td style='border: 1px #646464 solid;text-align: center;vertical-align:middle;'>～</td>
<td style='border: 1px #646464 solid;text-align: center;vertical-align:middle;'>({$year2})年({$month2})月({$day2})日</td>
</tr>
</table>
<br>
<table border=1>
<tr>
<td width=150></td>
<td norap style='border: 1px #646464 solid;text-align: center;vertical-align:middle;'>利用数</td>
<td norap style='border: 1px #646464 solid;text-align: center;vertical-align:middle;'>内リピート数</td>
<td norap style='border: 1px #646464 solid;text-align: center;vertical-align:middle;'>リピート率</td>
</tr>
<tr>
<td width=150></td>
<td style='border: 1px #646464 solid;text-align: center;vertical-align:middle;'>({$rate_total|number_format})
</td>
<td style='border: 1px #646464 solid;text-align: center;vertical-align:middle;'>({$rate_count|number_format})
</td>
<td style='border: 1px #646464 solid;text-align: center;vertical-align:middle;'>({$rate})%
</td>
</tr>
</table>
({*<br>四捨五入( ( ({$repeat_count}) / ({$total}) )x100 )<br>*})
<br>
リピート率推移<br>
<table border=1>
<tr>
<td rowspan="2" width="150"></td>
<td colspan="3" style='border: 1px #646464 solid;text-align: center;vertical-align:middle;'>会場全体</td>
</tr>
<tr>
<td norap style='border: 1px #646464 solid;text-align: center;vertical-align:middle;'>利用数</td>
<td norap style='border: 1px #646464 solid;text-align: center;vertical-align:middle;'>内リピート数</td>
<td norap style='border: 1px #646464 solid;text-align: center;vertical-align:middle;'>リピート率</td>
</tr>

({foreach from=$repeat_list item=item})
<tr>
<td style='border: 1px #646464 solid;text-align: center;vertical-align:middle;'>({$item.date})</td>
<td style='border: 1px #646464 solid;text-align: center;vertical-align:middle;'>({$item.rate_total})
</td>
<td style='border: 1px #646464 solid;text-align: center;vertical-align:middle;'>({$item.repeat_count})
</td>
<td style='border: 1px #646464 solid;text-align: center;vertical-align:middle;'>({$item.rate})%
</td>
</tr>
({/foreach})

</table>
<br>

({php})


({/php})

({/if})
({****************************************************************})

({******************** utilization_rates **********************************})
({elseif $menu=="utilization_rates"})
<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('slip_output','page')})" />
<input type="hidden" name="menu" value="utilization_rates">

<select name="hall_id" size=5 valign=top>
({foreach from=$hall_list item=item})
<option value="({$item.hall_id})" ({if $item.hall_id == $hall_id})selected({/if})>({$item.hall_name})
({/foreach})
</select>

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
<br>

({if isset($hall_name)})
会場名：({$hall_name})<br>
利用期間：({$date_s}) ～ ({$date_e})<br>
<br>
<table border=1>
<tr>
<td></td>
<td colspan=2>金額稼働率</td>
<td>時間稼働率</td>
</tr>
<tr>
<td></td>
<td>利用のみ</td>
<td>OP含む</td>
<td></td>
</tr>
<tr>
<td>会場全体</td>
<td align=right>({$all_rate_a})％</td>
<td align=right>({$all_rate_b})％</td>
<td align=right>({$all_rate_c})％</td>
</tr>
({foreach from=$room_data item=item})
<tr>
<td>
({$item.room_name})
</td>
<td align=right>({$item.rate_a})％</td>
<td align=right>({$item.rate_b})％</td>
<td align=right>({$item.rate_c})％</td>
</tr>
({/foreach})
</table>



({/if})
({*************************************************************})

({elseif $menu=="money_utilization_rates"})
<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('slip_output','page')})" />
<input type="hidden" name="menu" value="money_utilization_rates">

<select name="hall_id" size=5 valign=top>
({foreach from=$hall_list item=item})
<option value="({$item.hall_id})" ({if $item.hall_id == $hall_id})selected({/if})>({$item.hall_name})
({/foreach})
</select>

<input type="text" name="year1" value="({$year1})" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month1" value="({$month1})" size=2 style="text-align:right;padding-right:5px;">月 ～ 
<input type="text" name="year2" value="({$year2})" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month2" value="({$month2})" size=2 style="text-align:right;padding-right:5px;">月

<input type="submit" value="出力">
</form>
<br>
<hr>
<h3>({$title})</h3>
<br>

({if isset($room_data)})
会場名：({$hall_name})<br>
利用期間：({$date_s}) ～ ({$date_e})<br>
<br>
金額稼働率　利用のみ
<table border=1>
<tr>
<td></td>
<td align=center>会場全体</td>
({foreach from=$room_data item=item})
<td align=center>({$item.room_name})</td>
({/foreach})
</tr>
({foreach from=$reserved_room_list item=item})
<tr>
<td align=right>
({$item.date})
</td>
<td align=right>({$item.all_rate_a})％</td>
({foreach from=$item.room_data item=i})
<td align=right>({$i.rate_a})％</td>
({/foreach})
</tr>
({/foreach})
</table>
<br>
金額稼働率　OP含む
<table border=1>
<tr>
<td></td>
<td align=center>会場全体</td>
({foreach from=$room_data item=item})
<td align=center>({$item.room_name})</td>
({/foreach})
</tr>
({foreach from=$reserved_room_list item=item})
<tr>
<td align=right>
({$item.date})
</td>
<td align=right>({$item.all_rate_b})％</td>
({foreach from=$item.room_data item=i})
<td align=right>({$i.rate_b})％</td>
({/foreach})
</tr>
({/foreach})
</table>
<br>
({php})

({/php})

({/if})
({*************************************************************})

({elseif $menu=="time_utilization_rates"})
<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('slip_output','page')})" />
<input type="hidden" name="menu" value="time_utilization_rates">

<select name="hall_id" size=5 valign=top>
({foreach from=$hall_list item=item})
<option value="({$item.hall_id})" ({if $item.hall_id == $hall_id})selected({/if})>({$item.hall_name})
({/foreach})
</select>

<input type="text" name="year1" value="({$year1})" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month1" value="({$month1})" size=2 style="text-align:right;padding-right:5px;">月 ～ 
<input type="text" name="year2" value="({$year2})" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month2" value="({$month2})" size=2 style="text-align:right;padding-right:5px;">月

<input type="submit" value="出力">
</form>
<br>
<hr>
<h3>({$title})</h3>
<br>

({if isset($room_data)})
会場名：({$hall_name})<br>
利用期間：({$date_s}) ～ ({$date_e})<br>
<br>
時間稼働率
<table border=1>
<tr>
<td></td>
<td align=center>会場全体</td>
({foreach from=$room_data item=item})
<td align=center>({$item.room_name})</td>
({/foreach})
</tr>
({foreach from=$reserved_room_list item=item})
<tr>
<td align=right>
({$item.date})
</td>
<td align=right>({$item.all_rate_c})％</td>
({foreach from=$item.room_data item=i})
<td align=right>({$i.rate_c})％</td>
({/foreach})
</tr>
({/foreach})
</table>


({/if})
({*************************************************************})

({*************** analysis_at_reservation_period *************************})
({elseif $menu=="analysis_at_reservation_period"})
<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('slip_output','page')})" />
<input type="hidden" name="menu" value="analysis_at_reservation_period">

<select name="hall_id" size=5 valign=top>
({foreach from=$hall_list item=item})
<option value="({$item.hall_id})" ({if $item.hall_id == $hall_id})selected({/if})>({$item.hall_name})
({/foreach})
</select>

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
<br>
({if $room_data})

会場名：({$hall_name})<br>
該当予約期間：({$year1})年({$month1})月({$day1})日 ～ ({$year2})年({$month2})月({$day2})日<br>
<br>
<table border=1>
<tr>
<td></td>
<td align=center>予約数</td>
<td align=center>最短期間（日）</td>
<td align=center>最長期間（日）</td>
<td align=center>平均期間</td>
</tr>
({foreach from=$room_data item=item})
<tr>
<td>({$item.room_name})</td>
<td align=right>({$item.reserve})</td>
<td align=right>({$item.min})日</td>
<td align=right>({$item.max})日</td>
<td align=right>({$item.average})日</td>
</tr>
({/foreach})
</table>


({/if})
({************************ user_analysis **************************})

({elseif $menu=="user_analysis"})
<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('slip_output','page')})" />
<input type="hidden" name="menu" value="user_analysis">

<select name="hall_id" size=5 valign=top>
({foreach from=$hall_list item=item})
<option value="({$item.hall_id})" ({if $item.hall_id == $hall_id})selected({/if})>({$item.hall_name})
({/foreach})
</select>

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
<br>
({if $room_data})

会場名：({$hall_name})<br>
利用期間：({$year1})年({$month1})月({$day1})日 ～ ({$year2})年({$month2})月({$day2})日<br>
<br>
<table border=1>
<tr>
<td></td>
<td></td>
<td colspan=7 align=center>用途</td>
</tr>
<tr>
<td></td>
<td align=center>利用数</td>
<td align=center>会議</td>
<td align=center>セミナー</td>
<td align=center>研修</td>
<td align=center>面接・試験</td>
<td align=center>懇談会・パーティ</td>
<td align=center>その他</td>
<td align=center>未選択</td>
</tr>
({foreach from=$room_data item=item})
<tr>
<td>({$item.room_name})</td>
<td align=right>({$item.reserve})</td>
<td align=right>({$item.conference})</td>
<td align=right>({$item.seminar})</td>
<td align=right>({$item.training})</td>
<td align=right>({$item.interview})</td>
<td align=right>({$item.party})</td>
<td align=right>({$item.etc})</td>
<td align=right>({$item.no_data})</td>
</tr>
({/foreach})
</table>

({/if})
({**********************************************************************})

({elseif $menu=="repetition_order"})
<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('slip_output','page')})" />
<input type="hidden" name="menu" value="repetition_order">

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
<br>
表示日時 : ({$smarty.now|date_format:"%Y-%m-%d %H:%M:%S"})<br><br>

({if isset($order_list)})

申し込み期間：({$year1})年({$month1})月({$day1})日 ～ ({$year2})年({$month2})月({$day2})日<br>
<br>
<table border=1>
<tr>
<td align="center">順位</td>
<td align="center">会場名</td>
<td align="center">利用数</td>
<td align="center">内リピート数</td>
<td align="center"><b>リピート率</b></td>
</tr>
({foreach from=$order_list key=key item=item})
<tr>
<td align="right">
({$key+1})
</td>
<td>
({$item.hall_name})
</td>
<td align="right">
({$item.total})
</td>
<td align="right">
({$item.count})
</td>
<td align="right">
<b>({$item.repeat_rate})%</b>
</td>
</tr>
({/foreach})
</table>
({/if})
({***************************** repetition_order ****************************})

({elseif $menu=="utilization_rates_order"})
<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('slip_output','page')})" />
<input type="hidden" name="menu" value="utilization_rates_order">

<input type="radio" name="mode" value="0" ({if $mode==0})checked({/if})>利用料
<input type="radio" name="mode" value="1" ({if $mode==1})checked({/if})>利用料+OP
<input type="radio" name="mode" value="2" ({if $mode==2})checked({/if})>時間稼働率
<br>
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
<br>

({if isset($order_list)})

該当利用期間：({$year1})年({$month1})月({$day1})日 ～ ({$year2})年({$month2})月({$day2})日<br>
<br>

<table border=1>
<tr>
<td></td>
<td></td>
<td colspan=2 align=right>金額稼働率</td>
<td rowspan=2 align=right>時間稼働率</td>
</tr>
<tr>
<td align=right>順位</td>
<td align=right>会場名</td>
<td align=right>利用料</td>
<td align=right>利用料+OP</td>
</tr>
({foreach from=$order_list key=key item=item})
<tr>
<td align=right>({$key+1})位</td>
<td>({$item.hall_name})</td>
<td align=right>({$item.rate_a})％</td>
<td align=right>({$item.rate_b})％</td>
<td align=right>({$item.rate_c})％</td>
</tr>
({/foreach})
</table>

({/if})
({********************** utilization_rates_order ****************************})

({elseif $menu=="room_utilization_rates_order"})
<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('slip_output','page')})" />
<input type="hidden" name="menu" value="room_utilization_rates_order">

<input type="radio" name="mode" value="0" ({if $mode==0})checked({/if})>利用料
<input type="radio" name="mode" value="1" ({if $mode==1})checked({/if})>利用料+OP
<input type="radio" name="mode" value="2" ({if $mode==2})checked({/if})>時間稼働率
<br>
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
<br>

({if isset($order_list)})

該当利用期間：({$year1})年({$month1})月({$day1})日 ～ ({$year2})年({$month2})月({$day2})日<br>
<br>

<table border=1>
<tr>
<td></td>
<td></td>
<td></td>
<td colspan=2 align=center>金額稼働率</td>
<td rowspan=2 align=center>時間稼働率</td>
</tr>
<tr>
<td align=center>順位</td>
<td align=center>会場名</td>
<td align=center>部屋名</td>
<td align=center>利用料</td>
<td align=center>利用料+OP</td>
</tr>
({foreach from=$order_list key=key item=item})
<tr>
<td align=right>({$key+1})位</td>
<td>({$item.hall_name})</td>
<td>({$item.room_name})</td>
<td align=right>({$item.rate_a})％</td>
<td align=right>({$item.rate_b})％</td>
<td align=right>({$item.rate_c})％</td>
</tr>
({/foreach})
</table>

({/if})
({******************** room_utilization_rates_order ************************})

({elseif $menu=="unpayment_list"})
<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('slip_output','page')})" />
<input type="hidden" name="menu" value="unpayment_list">

<select name="hall_id" size=5 valign=top>
<option value="0" ({if $item.hall_id == 0})selected({/if})>全会場
({foreach from=$hall_list item=item})
<option value="({$item.hall_id})" ({if $item.hall_id == $hall_id})selected({/if})>({$item.hall_name})
({/foreach})
</select>
<br>
期日指定：（入金予定日）
<input type="text" name="year" value="({$year})" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month" value="({$month})" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day" value="({$day})" size=2 style="text-align:right;padding-right:5px;">日
<input type="submit" value="出力">
</form>
<br>
<hr>
<h3>({$title})</h3>
<br>

({$hall_name})<br>
({if $year and $month and $day})
({$year})年({$month})月({$day})日(以前の入金予定 未入金)<br>
({/if})
<br>
<table border=1>
<tr>
<td>入金予定日</td>
<td>利用日</td>
<td>会場名</td>
<td>予約ID</td>
<td>法人名/団体名</td>
<td>入金予定金額</td>
<td>内部屋利用料金</td>
<td>内ＯＰ利用料</td>
<td>内サービス利用料</td>
<td>入金済み</td>
<td>未入金額</td>
<td>経過日数</td>
<td>備考</td>
</tr>
({foreach from=$reserve_data item=item})
<tr>
<td align=right>
({if $item.pay_limitdate == "-0001年11月30日"})
<span style="color:#FF0000">未設定</span>
({else})
({$item.pay_limitdate})
({/if})
</td>
<td>({$item.begin_datetime|date_format:"%Y年%m月%d日"})</td>
<td>({$hall_names[$item.hall_id]})</td>
<td aligh=right>({$item.reserve_id})</td>
<td>({$item.corp})</td>
<td align=right>({$item.total_price})</td>
({if $item.cancel_flag==1})
<td colspan="3" align="center">キャンセル</td>
({else})
<td align=right>({$item.room_price|number_format})</td>
<td align=right>({$item.vessel_price|number_format})</td>
<td align=right>({$item.service_price|number_format})</td>
({/if})
<td align=right>({$item.pay_money})</td>
<td align=right>({$item.unpayment})</td>
<td align=right>
({if $item.pay_limitdate == "-0001年11月30日"})
<span style="color:#FF0000">--</span>
({else})
({$item.over_days})日
({/if})
</td>
<td>

({* ({$item.memo|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration}) *})
({$item.memo|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})

</td>
</tr>
({/foreach})
</table>
({***************************************************************})


<!-- add cancel pay ment-->
({elseif $menu=="cancelpayment_list"})
<form id="rental_form" name="search" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('slip_output','page')})"/>
<input type="hidden" name="menu" value="cancelpayment_list">
<input type="hidden" value="0" name="page_num" id="page_num"/>
<select name="hall_id" size=5 valign=top>
<option value="0" ({if $item.hall_id == 0})selected({/if})>全会場
({foreach from=$hall_list item=item})
<option value="({$item.hall_id})" ({if $item.hall_id == $hall_id})selected({/if})>({$item.hall_name})
({/foreach})
</select>
<br>
利用日: 
<input type="text" name="yearto" value="({if isset($yearto)})({$yearto})({/if})" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="monthto" value="({if isset($monthto)})({$monthto})({/if})" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="dayto" value="({if isset($dayto)})({$dayto})({/if})" size=2 style="text-align:right;padding-right:5px;">日
<span style="margin: 0px 10px;">～</span>
<input type="text" name="yearfrom" value="({if isset($yearfrom)})({$yearfrom})({/if})" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="monthfrom" value="({if isset($monthfrom)})({$monthfrom})({/if})" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="dayfrom" value="({if isset($dayfrom)})({$dayfrom})({/if})" size=2 style="text-align:right;padding-right:5px;">日
<input type="submit" value="出力" name="ok">
</form>
<br>
<hr>
<h3>({$title})</h3>
<br>
({$hall_name})<br>
({if $yearto and $monthto and $dayto and $yearfrom and $monthfrom and $dayfrom})
({$yearto})年({$monthto})月({$dayto})日<span style="margin: 0px 10px;">～</span>({$yearfrom})年({$monthfrom})月({$dayfrom})日(以前の入金予定 未入金)<br>
({/if})
({if $reserve_data})
<br>
<table border=1>
<tr>
<td style="width:70px;">入金予定日</td>
<td style="width:70px;">利用日</td>
<td style="width:70px;">会場名</td>
<td style="width:70px;">予約ID</td>
<td style="width:70px;">法人名/団体名</td>
<td style="width:70px;">入金予定金額</td>
<td style="width:20px;">内部屋利用料金</td>
<td style="width:20px;">内ＯＰ利用料</td>
<td style="width:20px;">内サービス利用料</td>
<td style="width:30px;">入金済み</td>
<td style="width:30px;">未入金額</td>
<td style="width:30px;">経過日数</td>
<td style="width:150px;">備考</td>
</tr>
({/if})
({foreach from=$reserve_data item=item})
({if  $item.cash_balance >0 })
<tr>
<td align=right>
({$item.pay_limitdate})
</td>
<td>({$item.begin_datetime|date_format:"%Y年%m月%d日"})</td>
<td>({$hall_names[$item.hall_id]})</td>
<td aligh=right>({$item.reserve_id})</td>
<td>({$item.corp})</td>
<td align=right>({$item.cancel_price})</td>
({if $item.cancel_flag==1})
<td colspan="3" align="center">キャンセル</td>
({else})
<td align=right>({$item.room_price|number_format})</td>
<td align=right>({$item.vessel_price|number_format})</td>
<td align=right>({$item.service_price|number_format})</td>
({/if})
<td align=right>
({if $item.ab_data})
	({$item.ab_data.pay_money})
({else})

({$item.pay_money})
({/if})
</td>
<td align=right>({$item.cash_balance})</td>
<td align=right>
({if $item.over_days})
({$item.over_days})日
({/if})
</td>
<td>

({* ({$item.memo|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration}) *})
({$item.memo|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})

</td>
</tr>
({/if})
({/foreach})
</table>
({***************************************************************})
<br>
<div style="text-align:center;">
({foreach from=$page_list item=item})
({if $item.select})
	({$item.page})
({else})
	<a href="javascript:return false" onclick="paginate('({$item.index})');" >({$item.page})</a>
({/if})
({/foreach})
</div>
<!-- end -->


({elseif $menu=="sales_expectation"})
<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('slip_output','page')})" />
<input type="hidden" name="menu" value="sales_expectation">

売上見込月：
<input type="text" name="year" value="({$year})" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month" value="({$month})" size=2 style="text-align:right;padding-right:5px;">月
<br>
売上確認日：
<input type="text" name="check_year" value="({$check_year})" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="check_month" value="({$check_month})" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="check_day" value="({$check_day})" size=2 style="text-align:right;padding-right:5px;">日
<input type="submit" value="出力">
</form>
<br>
<hr>
<h3>({$title})</h3>
<br>
({if $hall_list})
売上見込月：({$year})年({$month})月<br>
売上確認日：({$check_year})年({$check_month})月({$check_day})日<br>
<br>
<br>
(税抜き)
<div style='width:900px;overflow-x:scroll;'>
<table border=1 width=1400>
<tr>
<td></td>
<td colspan=2>当月利用済み金額</td>
<td colspan=2>当月利用予定金額</td>
<td colspan=2>({$month_2})月利用予定金額</td>
<td colspan=2>({$month_3})月利用予定金額</td>
<td colspan=2>({$month_4})月利用予定金額</td>
</tr>
<tr>
<td>会場名</td>
<td>利用料</td>
<td>OP料</td>
<td>利用料</td>
<td>OP料</td>
<td>利用料</td>
<td>OP料</td>
<td>利用料</td>
<td>OP料</td>
<td>利用料</td>
<td>OP料</td>
</tr>
({foreach from=$hall_list item=item})
<tr>
<td>({$item.hall_name})</td>
<td align=right>({$item.total_room_price1})</td>
<td align=right>({$item.total_vessel_price1})</td>
<td align=right>({$item.total_room_price2})</td>
<td align=right>({$item.total_vessel_price2})</td>
<td align=right>({$item.total_room_price3})</td>
<td align=right>({$item.total_vessel_price3})</td>
<td align=right>({$item.total_room_price4})</td>
<td align=right>({$item.total_vessel_price4})</td>
<td align=right>({$item.total_room_price5})</td>
<td align=right>({$item.total_vessel_price5})</td>
</tr>
({/foreach})
</table>
</div>

({/if})
({************************************************************})

({elseif $menu=="customer_use_state"})
<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('slip_output','page')})" />
<input type="hidden" name="menu" value="customer_use_state">

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
<td>利用日</td>
<td>会場</td>
<td>部屋</td>
<td>利用時間帯</td>
<td>利用時間</td>
<td>用途</td>
</tr>
({foreach from=$reserve_data item=item})
<td>({$item.date})</td>
<td>({$item.hall_name})</td>
<td>({$item.room_name})</td>
<td>({$item.time})</td>
<td>({$item.between_time|round})時間</td>
<td>({$item.purpose})</td>
</tr>
({/foreach})
<td></td>
<td></td>
<td></td>
<td>総利用時間</td>
<td>({$total_time})時間</td>
<td></td>
</tr>
({else})
顧客が特定できません。
({/if})
({**************************************************************})

({elseif $menu=="news_flash"})
<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('slip_output','page')})" />
<input type="hidden" name="menu" value="news_flash">

売上見込月：
<input type="text" name="year" value="({$year})" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month" value="({$month})" size=2 style="text-align:right;padding-right:5px;">月
<br>
予約確認日：
<input type="text" name="check_year" value="({$check_year})" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="check_month" value="({$check_month})" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="check_day" value="({$check_day})" size=2 style="text-align:right;padding-right:5px;">日
<input type="submit" value="出力">
</form>
<br>
<hr>
<h3>({$title})</h3>
<br>
({if $hall_list})
売上見込月：({$year})年({$month})月<br>
予約確認日：({$check_year})年({$check_month})月({$check_day})日<br>
<br>
<br>
(税抜き)
<div style='width:900px;overflow-x:scroll;'>
<table border=1 width=900>
<tr>
<td></td>
<td colspan=2>昨日予約</td>
<td colspan=2>当月予約</td>
<td colspan=2>当月キャンセル</td>
</tr>
<tr>
<td>会場名</td>
<td>金額</td>
<td>({$yesterday_reserve_count})件</td>
<td>予約累計</td>
<td>({$reserve_count})件</td>
<td>キャンセル差額</td>
<td>({$reserve_cancel_count})件</td>
</tr>
({foreach from=$hall_list item=item})
<tr>
<td>({$item.hall_name})</td>
<td align=right>({$item.total_room_price1})</td>
<td align=right>({$item.total_vessel_price1})</td>
<td align=right>({$item.total_room_price2})</td>
<td align=right>({$item.total_vessel_price2})</td>
<td align=right>({$item.total_room_price3})</td>
<td align=right>({$item.total_vessel_price3})</td>
</tr>
({/foreach})
</table>
</div>

({/if})
({************************************************************})

({elseif $menu=="cancellation_analysis"})
<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('slip_output','page')})" />
<input type="hidden" name="menu" value="cancellation_analysis">

会場選択：
<select name="hall_id" size=5 valign=top>
<option value="0" ({if $item.hall_id == $hall_id})selected({/if})>全会場</option>
({foreach from=$hall_list item=item})
<option value="({$item.hall_id})" ({if $item.hall_id == $hall_id})selected({/if})>({$item.hall_name})
({/foreach})
</select>
({if $room_list})
部屋選択：
<select name="room_id" size=5 valign=top>
<option value="0" ({if $item.room_id == $room_id})selected({/if})>全部屋</option>
({foreach from=$room_list item=item})
<option value="({$item.room_id})" ({if $item.room_id == $room_id})selected({/if})>({$item.room_name})
({/foreach})
</select>
({/if})
<br>
キャンセル日対象期間：
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

({if $list})
<div style='width:900px;overflow-x:scroll;'>
<table border=1 width=1500>
<tr>
<td align=center>予約ID</td>
<td align=center>会場名</td>
<td align=center>部屋名</td>
<td align=center>理由（メモ）</td>
<td align=center>キャンセル料率</td>
<td align=center>キャンセル料(税抜)</td>
<td align=center>キャンセル日</td>
<td align=center>仮予約からの経過日数</td>
<td align=center>承認日からの経過日数</td>
<td align=center>利用日までの日数</td>
</tr>
({foreach from=$list item=item})
<tr>
<td align=right>({$item.reserve_id})</td>
<td>({$item.hall_name})</td>
<td>({$item.room_name})</td>
<td>
({if $item.memo})
	({$item.memo|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
({else})
	特になし
({/if})
</td>
<td align=right>({$item.cancel_rate})％</td>
<td align=right>({$item.cancel_price})</td>
<td align=right>({$item.cancel_date})</td>
<td align=right>({$item.tmp_to_cancel_days})</td>
<td align=right>({$item.reserve_to_cancel_days})</td>
<td align=right>({$item.cancel_to_begin_days})</td>
</tr>
({/foreach})
</table>
</div>

({else})
対象のデータはありません。
({/if})
({**************************************************************})

({elseif $menu=="long_term_use"})
<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('slip_output','page')})" />
<input type="hidden" name="menu" value="long_term_use">

会場選択：
<select name="hall_id" size=5 valign=top>
<option value="0" ({if $item.hall_id == $hall_id})selected({/if})>全会場</option>
({foreach from=$hall_list item=item})
<option value="({$item.hall_id})" ({if $item.hall_id == $hall_id})selected({/if})>({$item.hall_name})
({/foreach})
</select>
<br>
利用日期間：
<input type="text" name="year1" value="({$year1})" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month1" value="({$month1})" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day1" value="({$day1})" size=2 style="text-align:right;padding-right:5px;">日 ～ 
<input type="text" name="year2" value="({$year2})" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month2" value="({$month2})" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day2" value="({$day2})" size=2 style="text-align:right;padding-right:5px;">日<br>
仮予約期間：
<input type="text" name="year3" value="({$year3})" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month3" value="({$month3})" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day3" value="({$day3})" size=2 style="text-align:right;padding-right:5px;">日 ～ 
<input type="text" name="year4" value="({$year4})" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month4" value="({$month4})" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day4" value="({$day4})" size=2 style="text-align:right;padding-right:5px;">日
<input type="submit" value="出力">
</form>
<br>
<hr>
<h3>({$title})</h3>
({if $list})

会場：({$hall_name})<br>
利用日期間：
({if $year1 and $month1 and $day1 and $year2 and $month2 and $day2})
({$year1})年({$month1})月({$day1})日 ～ ({$year2})年({$month2})月({$day2})日<br>({else})
特定せず<br>
({/if})
仮予約期間：
({if $year3 and $month3 and $day3 and $year4 and $month4 and $day4})
({$year3})年({$month3})月({$day3})日 ～ ({$year4})年({$month4})月({$day4})日<br>({else})
特定せず<br>
({/if})
<br>
<div style='width:900px;overflow-x:scroll;'>
<table border=1 width=1600>
<tr>
<td>長期利用客</td>
<td>予約者</td>
<td>利用会場</td>
<td>利用人数</td>
<td>用途</td>
<td>過去利用回数</td>
<td>顧客ID</td>
<td>メールアドレス</td>
<td>電話</td>
<td>FAX</td>
<td>住所</td>
</tr>
({foreach from=$list item=item})
<tr>
<td>({$item.corp})</td>
<td>({$item.name})</td>
<td>
({foreach from=$item.reserve_data item=i})
({$i.hall_name})<br>
({/foreach})
</td>
<td>
({foreach from=$item.reserve_data item=i})
({$i.people})<br>
({/foreach})
</td>
<td>
({foreach from=$item.reserve_data item=i})
({$i.purpose})<br>
({/foreach})
</td>
<td>({$item.count})</td>
<td>({$item.c_member_id})</td>
<td>({$item.mail})</td>
<td>({$item.tel})</td>
<td>({$item.fax})</td>
<td>({$item.address})</td>
</tr>
({/foreach})
</table>
</div>
({else})
対象のデータはありません。
({/if})
({*******************************************************************})
({elseif $menu=="use_schedule_list"})
<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('slip_output','page')})" />
<input type="hidden" name="menu" value="use_schedule_list">

<select name="hall_id" size=5 valign=top>
<option value="0" ({if $item.hall_id == $hall_id})selected({/if})>全会場</option>
({foreach from=$hall_list item=item})
<option value="({$item.hall_id})" ({if $item.hall_id == $hall_id})selected({/if})>({$item.hall_name})
({/foreach})
</select>

<input type="text" name="year" value="({$year})" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month" value="({$month})" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day" value="({$day})" size=2 style="text-align:right;padding-right:5px;">日 ～ 
<input type="text" name="year2" value="({$year2})" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month2" value="({$month2})" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day2" value="({$day2})" size=2 style="text-align:right;padding-right:5px;">日
<input type="submit" value="出力">
</form>
<br>
<hr>
<h3>({$title})</h3>
<br>
({if $reserve_data})

対象日：({$year})年({$month})月({$day})日<br>
会場：({$hall_name})<br>
<br>

<div style='width:900px;overflow-x:scroll;'>
<table border=1 width=1600>
<tr>
<td>利用日</td>
<td>会場名</td>
<td>部屋名</td>
<td>法人/団体名</td>
<td>利用者</td>
<td>顧客ID</td>
<td>用途</td>
<td>メール</td>
<td>電話</td>
<td>メッセージ</td>
<td>問題点</td>
</tr>
({foreach from=$reserve_data item=item})
<tr>
<td>({$item.begin_datetime})</td>
<td>({$item.hall_name})</td>
<td>({$item.room_name})</td>
<td>({$item.corp})</td>
<td>({$item.name})</td>
<td>({$item.c_member_id})</td>
<td>({$item.purpose})</td>
<td>({$item.mail})</td>
<td>({$item.tel})</td>
<td>
({$item.message|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
</td>
<td>
({$item.report.report|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
</td>
</tr>
({/foreach})
</table>
</div>
({else})
対象のデータはありません。
({/if})
({*********************************************************************})

({elseif $menu=="payment_record"})
<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('slip_output','page')})" />
<input type="hidden" name="menu" value="payment_record">

<select name="hall_id" size=5 valign=top>
<option value="0" ({if $item.hall_id == $hall_id})selected({/if})>全会場</option>
({foreach from=$hall_list item=item})
<option value="({$item.hall_id})" ({if $item.hall_id == $hall_id})selected({/if})>({$item.hall_name})
({/foreach})
</select>

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
<br>
({if $reserve_data or $ab_data})

対象日：({$year1})年({$month1})月({$day1})日 ～ ({$year2})年({$month2})月({$day2})日<br>
会場：({$hall_name})<br>
<br>
(税込)
<table border=1>
<tr>
<td align=center>入金日</td>
<td align=center>利用日</td>
<td align=center>会場名</td>
<td align=center>口座番号</td>
<td align=center>入金額</td>
<td align=center>法人/団体名</td>
<td align=center>利用者</td>
<td align=center>予約ID</td>
<td align=center>請求総額</td>
<td align=center>利用内容</td>
</tr>
({foreach from=$reserve_data item=item})
<tr>
<td align=right>({$item.date})</td>
<td>({$item.begin_datetime|date_format:"%Y年%m月%d日"})</td>
<td>({$item.hall_name})</td>
<td align=right>({$item.virtual_code})</td>
<td align=right>({$item.pay_money})</td>
<td>({$item.corp})</td>
<td>({$item.name})</td>
<td align=right>({$item.reserve_id})</td>
<td align=right>({$item.total_price})</td>
<td align=center>予約</td>
</tr>
({/foreach})
({foreach from=$ab_data item=item})
({if $hall_id == 0 or $hall_id == $item.hall_id})
<tr>
<td align=right>({$item.date})</td>
<td></td>
<td>({$item.hall_name})</td>
<td align=right>({$item.virtual_code})</td>
<td align=right>({$item.pay_money})</td>
<td>({$item.corp})</td>
<td>({$item.name})</td>
<td align=right>({$item.reserve_id})</td>
<td align=center>({$item.total_price})</td>
<td align=center>キャンセル</td>
</tr>
({/if})
({/foreach})
</table>

({else})
対象のデータはありません。
({/if})
({****************************************************************})

({elseif $menu=="repeat_customer_list"})
<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('slip_output','page')})" />
<input type="hidden" name="menu" value="repeat_customer_list">

会場選択：
<select name="hall_id" size=5 valign=top>
({foreach from=$hall_list item=item})
<option value="({$item.hall_id})" ({if $item.hall_id == $hall_id})selected({/if})>({$item.hall_name})
({/foreach})
</select>
<br>
利用日期間：
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
({if $list})

会場：({$hall_name})<br>
利用日期間：
({if $year1 and $month1 and $day1 and $year2 and $month2 and $day2})
({$year1})年({$month1})月({$day1})日 ～ ({$year2})年({$month2})月({$day2})日<br>({else})
特定せず<br>
({/if})

<br>
<div style='width:900px;overflow-x:scroll;'>
<table border=1 width=1600>
<tr>
<td align=center>リピート利用者</td>
<td align=center>予約者</td>
<td align=center>利用会場</td>
<td align=center>利用人数</td>
<td align=center>用途</td>
<td align=center>過去利用回数</td>
<td align=center>顧客ID</td>
<td align=center>メールアドレス</td>
<td align=center>電話</td>
<td align=center>FAX</td>
<td align=center>住所</td>
</tr>
({foreach from=$list item=item})
<tr>
<td>({$item.corp})</td>
<td>({$item.name})</td>
<td>({$hall_name})</td>
<td align=right>
({foreach from=$item.reserve_data item=i})
({$i.people})<br>
({/foreach})
</td>
<td align=center>
({foreach from=$item.reserve_data item=i})
({$i.purpose})<br>
({/foreach})
</td>
<td align=right>({$item.count})</td>
<td align=right>({$item.c_member_id})</td>
<td>({$item.mail})</td>
<td>({$item.tel})</td>
<td>({$item.fax})</td>
<td>({$item.address})</td>
</tr>
({/foreach})
</table>
</div>
({else})
対象のデータはありません。
({/if})
({*******************************************************************})

({elseif $menu=="sales_report"})
<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('slip_output','page')})" />
<input type="hidden" name="menu" value="sales_report">

<select name="hall_id" size=5 valign=top>
<option value="0" ({if $item.hall_id == $hall_id})selected({/if})>全会場</option>
({foreach from=$hall_list item=item})
<option value="({$item.hall_id})" ({if $item.hall_id == $hall_id})selected({/if})>({$item.hall_name})
({/foreach})
</select>

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
<br>

({if $hall_id==0 and $hall_data})
({*** 会場全体 ***})
対象期間：({$year1})年({$month1})月({$day1})日 ～ ({$year2})年({$month2})月({$day2})日<br>
会場：全会場<br>
<br>
利用料(税込) ※キャンセル料含む<br>
<table border=1>
<tr>
<td>会場名</td>
<td>利用済　全額</td>
<td>利用済　入金済</td>
<td>利用済　未入金</td>
<td>以前利用の入金額</td>
<td>当社収益配分</td>
<td>売上（利用ベース）</td>
<td>売上（入金ベース）</td>
</tr>
({foreach from=$hall_data item=item})
<tr>
<td>({$item.hall_name})</td>
<td align=right>({$item.all_room_price|number_format})</td>
<td align=right>({$item.all_room_price_paid|number_format})</td>
<td align=right>({$item.all_room_price_unpayment|number_format})</td>
<td align=right>({$item.room_use_before|number_format})</td>
<td align=right>({$item.ao_room|number_format})</td>
<td align=right>({$item.room_sales_use_base|number_format})</td>
<td align=right>({$item.room_sales_paid_base|number_format})</td>
</tr>
({/foreach})
<tr>
<td>合計</td>
<td align=right>({$total_room_price|number_format})</td>
<td align=right>({$total_room_price_paid|number_format})</td>
<td align=right>({$total_room_price_unpayment|number_format})</td>
<td align=right>({$total_room_use_before|number_format})</td>
<td align=right></td>
<td align=right>({$total_room_sales_use|number_format})</td>
<td align=right>({$total_room_sales_paid|number_format})</td>
</tr>
</table>
<br>
OP料金（備品のみ）（税込）  ※キャンセル料無し
<table border=1>
<tr>
<td>会場名</td>
<td>利用済　全額</td>
<td>利用済　入金済</td>
<td>利用済　未入金</td>
<td>以前利用の入金額</td>
<td>当社収益配分</td>
<td>売上（利用ベース）</td>
<td>売上（入金ベース）</td>
</tr>
({foreach from=$hall_data item=item})
<tr>
<td>({$item.hall_name})</td>
<td align=right>({$item.all_vessel_price|number_format})</td>
<td align=right>({$item.all_vessel_price_paid|number_format})</td>
<td align=right>({$item.all_vessel_price_unpayment|number_format})</td>
<td align=right>({$item.vessel_use_before|number_format})</td>
<td align=right>({$item.ao_vessel|number_format})</td>
<td align=right>({$item.vessel_sales_use_base|number_format})</td>
<td align=right>({$item.vessel_sales_paid_base|number_format})</td>
</tr>
({/foreach})
<tr>
<td>合計</td>
<td align=right>({$total_vessel_price|number_format})</td>
<td align=right>({$total_vessel_price_paid|number_format})</td>
<td align=right>({$total_vessel_price_unpayment|number_format})</td>
<td align=right>({$total_vessel_use_before|number_format})</td>
<td align=right></td>
<td align=right>({$total_vessel_sales_use|number_format})</td>
<td align=right>({$total_vessel_sales_paid|number_format})</td>
</tr>
</table>
<br>
サービス料金（備品含まず）（税込）  ※キャンセル料無し
<table border=1>
<tr>
<td>会場名</td>
<td>利用済　全額</td>
<td>利用済　入金済</td>
<td>利用済　未入金</td>
<td>以前利用の入金額</td>
<td>当社収益配分</td>
<td>売上（利用ベース）</td>
<td>売上（入金ベース）</td>
</tr>
({foreach from=$hall_data item=item})
<tr>
<td>({$item.hall_name})</td>
<td align=right>({$item.all_service_price|number_format})</td>
<td align=right>({$item.all_service_price_paid|number_format})</td>
<td align=right>({$item.all_service_price_unpayment|number_format})</td>
<td align=right>({$item.service_use_before|number_format})</td>
<td align=right>({$item.ao_service|number_format})</td>
<td align=right>({$item.service_sales_use_base|number_format})</td>
<td align=right>({$item.service_sales_paid_base|number_format})</td>
</tr>
({/foreach})
<tr>
<td>合計</td>
<td align=right>({$total_service_price|number_format})</td>
<td align=right>({$total_service_price_paid|number_format})</td>
<td align=right>({$total_service_price_unpayment|number_format})</td>
<td align=right>({$total_service_use_before|number_format})</td>
<td align=right></td>
<td align=right>({$total_service_sales_use|number_format})</td>
<td align=right>({$total_service_sales_paid|number_format})</td>
</tr>
</table>

({elseif $hall_id > 0 and $hall_data})
({*** 会場ごと ***})
対象期間：({$year1})年({$month1})月({$day1})日 ～ ({$year2})年({$month2})月({$day2})日<br>
会場：({$hall_name})<br>
<br>
<table border=1>
<tr>
<td>利用料当社収益配分</td>
<td align=right>({$hall_data.ao_room})%</td>
</tr>
<tr>
<td>OP料当社収益配分</td>
<td align=right>({$hall_data.ao_vessel})%</td>
</tr>
</table>
<br>
（税込）<br>
<table border=1>
<tr>
<td>利用料　合計</td>
<td align=right>({$total_room_price|number_format})</td>
</tr>
<tr>
<td>利用売上（利用ベース）</td>
<td align=right>({$total_room_sales_use|number_format})</td>
</tr>
<tr>
<td>利用売上（入金ベース）</td>
<td align=right>({$total_room_sales_paid|number_format})</td>
</tr>
<tr>
<td>OP備品料　合計</td>
<td align=right>({$total_vessel_price|number_format})</td>
</tr>
<tr>
<td>OP売上（利用ベース）</td>
<td align=right>({$total_vessel_sales_use|number_format})</td>
</tr>
<tr>
<td>OP売上（入金ベース）</td>
<td align=right>({$total_vessel_sales_paid|number_format})</td>
</tr>
<tr>
<td>利用＋OP総額</td>
<td align=right>({$total_price|number_format})</td>
</tr>
<tr>
<td>利用＋OP売上（利用ベース）</td>
<td align=right>({$total_sales_use|number_format})</td>
</tr>
<tr>
<td>利用＋OP売上（入金ベース）</td>
<td align=right>({$total_sales_paid|number_format})</td>
</tr>

</table>
<br>
サービス料<br>
<table border=1>
<tr>
<td>サービス利用料（利用ベース）</td>
<td align=right>({$total_service_price_paid|number_format})</td>
</tr>
<tr>
<td>サービス利用料（入金ベース）</td>
<td align=right>({$total_service_sales_paid|number_format})</td>
</tr>
</table>
<br>
<br>
<span style="font-size: 20px;color: #3333FF;"><b>部屋利用料</b></span><br>
<table border=1>
<tr>
<td>利用日</td>
<td>予約番号</td>
<td>部屋</td>
<td>利用時間</td>
<td>部屋利用料</td>
<td>入金額(部屋)</td>
<td>未入金（利用+OP+サ総額）</td>
<td>キャンセル料</td>
</tr>
({foreach from=$reserve_data item=item})
({if $item.date != ''})
	<tr>
	<td>({$item.date})</td>
	<td align=right>({$item.reserve_id})</td>
	<td>({$item.room_name})</td>
	<td>({$item.time})</td>
	<td align=right>
	({if $item.cancel_flag==0})
		({$item.room_price|number_format})
	({*
	({elseif $item.ab_data.total_billed_money})
		(({$item.ab_data.total_billed_money|number_format}))
	*})
	({else})
	0
	({/if})
	</td>
	<td align=right>
	({if $item.unpayment_flag==1})
	※
	({else})
	({if $item.cancel_flag==0})
		({if $item.pay_money > 0})
			({if $item.pay_flag==0})
				0
			({else})
				({if $item.room_price > $item.pay_money})
				({$item.pay_money|number_format})
				({else})
				({$item.room_price|number_format})
				({/if})
			({/if})
		({else})
		0
		({/if})
	({else})
		({if $item.ab_data.pay_money > 0})
			({if $item.ab_data.flag==0})
				0
			({else})
			    ({$item.ab_data.pay_money|number_format})
			({/if})	
		({else})
		0
		({/if})
	
	({/if})
	({/if})
	</td>
	<td align=right>
	({if $item.unpayment>0})
		({$item.unpayment|number_format})
		({if $item.unpayment_flag==1})
			(一部)
		({/if})
	({else})
	0
	({/if})
	</td>
	<td align=right>
	({if $item.cancel_flag==1})
	({*キャンセル*})
	({$item.cancel|number_format})
	({else})
	0
	({/if})
	</td>
	</tr>
({/if})
({/foreach})
<tr>
<td>合計</td>
<td></td>
<td></td>
<td></td>
<td align=right>({$total_room_price|number_format})</td>
<td align=right>({$total_room_price_paid|number_format})</td>
<td align=right>({$total_unpayment_price|number_format})</td>
<td align=right>({$total_cancel_price|number_format})</td>
</tr>

</table>
<br>
<span style="font-size: 16px;color: #FF3333;"><b>部屋利用料未入金(当月利用)</b></span><br>
<table border=1>
<tr>
<td>利用日</td>
<td>予約番号</td>
<td>部屋</td>
<td>利用時間</td>
<td>部屋利用料</td>
<td>入金額(部屋)</td>
<td>未入金（利用+OP+サ総額）</td>
<td>キャンセル料</td>

</tr>
({foreach from=$reserve_data item=item})
({if $item.unpayment > 0})
<tr>
<td>({$item.date})</td>
<td align=right>({$item.reserve_id})</td>
<td>({$item.room_name})</td>
<td>({$item.time})</td>
<td align=right>

({$item.room_price|number_format})

</td>
<td align=right>
({if $item.unpayment_flag==1})
※
({else})
({if $item.pay_flag==0})
	({if $item.pay_money > 0})
		({$item.pay_money|number_format})
	({else})
	0
	({/if})
({elseif $item.ab_data.pay_money})
	({if $item.ab_data.pay_money > 0})
		({if $item.ab_data.flag==0})
			0
		({else})
			({$item.ab_data.pay_money|number_format})
		({/if})	
	({else})
	0
	({/if})
({else})
0
({/if})
({/if})
</td>
<td align=right>
({$item.unpayment|number_format})
({if $item.unpayment_flag==1})
	(一部)
({/if})
</td>
<td align=right>
({if $item.cancel_flag==1})
({*キャンセル*})
({$item.cancel|number_format})
({else})
0
({/if})
</td>
</tr>
({/if})
({/foreach})
<tr>
<td>合計</td>
<td></td>
<td></td>
<td></td>
<td align=right>({$total_price_unpaid|number_format})</td>
<td align=right></td>
<td align=right>({$total_unpayment_price|number_format})</td>
<td align=right>({$total_cancel_price_unpayment|number_format})</td>
</tr>

</table>

<br>
<span style="font-size: 16px;color: #FF3333;"><b>部屋利用料入金（以前利用分）</b></span><br>
<table border=1>
<tr>
<td>利用日</td>
<td>予約番号</td>
<td>部屋</td>
<td>利用時間</td>
<td>部屋利用料</td>
<td>入金額(部屋)</td>
<td>未入金（利用+OP+サ総額）</td>
<td>キャンセル料</td>
</tr>
({foreach from=$before_paid_data item=item})
<tr>
<td>({$item.date})</td>
<td align=right>({$item.reserve_id})</td>
<td>({$item.room_name})</td>
<td>({$item.time})</td>
<td align=right>
({if $item.cancel_flag==0})
	({$item.room_price|number_format})
({else})
0
({/if})
</td>
<td align=right>
({if $item.cancel_flag==0})
	({if $item.pay_money > 0})
		({if $item.pay_flag==0})
			※
		({else})
			({$item.room_price|number_format})
		({/if})
	({else})
	0
	({/if})
({elseif $item.ab_data.pay_money})
	({if $item.ab_data.pay_money > 0})
		({if $item.ab_data.flag==0})
			※
		({/if})
		({$item.ab_data.pay_money|number_format})
	({else})
	0
	({/if})
({else})
0
({/if})
</td>
<td align=right>
0
</td>
</tr>
({/foreach})
({foreach from=$before_paid_data2 item=item})
<tr>
<td>({$item.date})</td>
<td align=right>({$item.reserve_id})</td>
<td>({$item.room_name})</td>
<td>({$item.time})</td>
<td align=right>
({$item.cancel_price|number_format})
</td>
<td align=right>
({$item.cancel_price|number_format})
</td>
<td align=right>
0
</td>
<td>
({if $item.cancel_flag==1})
({if $item.ab_data.total_billed_money})
	({$item.ab_data.total_billed_money|number_format})
({*キャンセル*})
({else})
0
({/if})
({else})
0
({/if})
</td>
</tr>
({/foreach})
<tr>
<td>合計</td>
<td></td>
<td></td>
<td></td>
<td align=right>({$total_room_use_before|number_format})</td>
<td align=right>({$total_room_use_before|number_format})</td>
<td align=right>0</td>
<td align=right>({$total_cancel_before|number_format})</td>
</tr>

</table>

<br>
<span style="font-size: 16px;color: #FF3333;"><b>未入金（以前利用分）</b></span><br>
<table border=1>
<tr>
<td>利用日</td>
<td>予約番号</td>
<td>部屋</td>
<td>利用時間</td>
<td>部屋利用料</td>
<td>入金額(部屋)</td>
<td>未入金（利用+OP+サ総額）</td>
<td>キャンセル料</td>
</tr>
({foreach from=$before_unpayment_data item=item})
<tr>
<td>({$item.date})</td>
<td align=right>({$item.reserve_id})</td>
<td>({$item.room_name})</td>
<td>({$item.time})</td>
<td align=right>
({if $item.cancel_flag==0})
	({$item.room_price|number_format})
({else})
0
({/if})
</td>
<td align=right>
({if $item.cancel_flag==0})
	({if $item.pay_money > 0})
		({if $item.pay_flag==0})
			※
		({else})
			({$item.room_price|number_format})
		({/if})
	({else})
	0
	({/if})
({elseif $item.ab_data.pay_money})
	({if $item.ab_data.pay_money > 0})
		({if $item.ab_data.flag==0})
			※
		({/if})
		({$item.ab_data.pay_money|number_format})
	({else})
	0
	({/if})
({else})
0
({/if})
</td>
<td align=right>
({$item.unpayment_price|number_format})
</td>
<td>
({if $item.cancel_flag==1})
({if $item.ab_data.total_billed_money})
	({$item.ab_data.total_billed_money|number_format})
({else})
0
({/if})
({else})
0
({/if})
</td>
</tr>
({/foreach})
({foreach from=$before_unpayment_data2 item=item})
<tr>
<td>({$item.date})</td>
<td align=right>({$item.reserve_id})</td>
<td>({$item.room_name})</td>
<td>({$item.time})</td>
<td align=right>
0
</td>
<td align=right>
({if $item.pay_money > 0})
※
({else})
0
({/if})
</td>
<td align=right>
({$item.unpayment_price|number_format})
</td>
<td>
({$item.cancel_price|number_format})
({*キャンセル*})
</td>
</tr>
({/foreach})
<tr>
<td>合計</td>
<td></td>
<td></td>
<td></td>
<td align=right>({$total_room_use_before_unpayment|number_format})</td>
<td align=right></td>
<td align=right>({$total_before_unpayment_price|number_format})</td>
<td align=right>({$total_cancel_before_unpayment|number_format})</td>
</tr>

</table>

<br>
<br>
<span style="font-size: 20px;color: #3333FF;"><b>OP利用料</b></span><br>
<table border=1>
<tr>
<td>利用日</td>
<td>予約番号</td>
<td>部屋</td>
<td>利用時間</td>
<td>OP利用料</td>
<td>入金額(OP)</td>
<td>未入金（利用+OP+サ総額）</td>
<td>備考</td>
</tr>
({foreach from=$reserve_data item=item})
({if $item.vessel_price})
<tr>
<td>({$item.date})</td>
<td align=right>({$item.reserve_id})</td>
<td>({$item.room_name})</td>
<td>({$item.time})</td>
<td align=right>
({if $item.cancel_flag==0})
({$item.vessel_price|number_format})
({else})
0
({/if})
</td>
<td align=right>
 ({if $item.unpayment_flag==1})
 ※
 ({else})
    ({if $item.cancel_flag==0})
            ({if $item.pay_money > 0})
                    ({if $item.pay_flag==0})
                            ※
                    ({else})
                            ({$item.vessel_price|number_format})
                    ({/if})
            ({else})
            0
            ({/if})
    ({else})
	   0
           
    ({/if})
	
	
  ({/if})  
</td>
<td align=right>
({$item.unpayment|number_format})
({if $item.unpayment_flag==1})
	(一部)
({/if})
</td>
<td>
({if $item.cancel_flag==1})
キャンセル
({/if})
</td>
</tr>
({/if})
({/foreach})
<tr>
<td>合計</td>
<td></td>
<td></td>
<td></td>
<td align=right>({$total_vessel_price|number_format})</td>
<td align=right>({$total_vessel_price_paid|number_format})</td>
<td align=right>({$total_unpayment_price|number_format})</td>
<td align=right></td>
</tr>
</table>
<br>
<span style="font-size: 16px;color: #FF3333;"><b>OP利用済未入金</b></span><br>
<table border=1>
<tr>
<td>利用日</td>
<td>予約番号</td>
<td>部屋</td>
<td>利用時間</td>
<td>OP利用料</td>
<td>入金額(OP)</td>
<td>未入金（利用+OP+サ総額）</td>

</tr>
({foreach from=$reserve_data item=item})
({if $item.vessel_price})
({if $item.unpayment > 0})
<tr>
<td>({$item.date})</td>
<td align=right>({$item.reserve_id})</td>
<td>({$item.room_name})</td>
<td>({$item.time})</td>
<td align=right>
({$item.vessel_price|number_format})
</td>
<td align=right>
({if $item.unpayment_flag==1})
※
({else})
    ({if $item.cancel_flag==0})
            ({if $item.pay_money > 0})
                    ({if $item.pay_flag==0})
                            ※
                    ({else})
                            ({$item.vessel_price|number_format})
                    ({/if})
            ({else})
            0
            ({/if})
   
    ({else})
		({if $item.pay_flag==0})
			0
		({else})
				({$item.vessel_price|number_format})
		({/if})
    ({/if})
({/if})    
</td>
<td align=right>
({$item.unpayment|number_format})
({if $item.unpayment_flag==1})
	(一部)
({/if})
</td>
</tr>
({/if})
({/if})
({/foreach})
<tr>
<td>合計</td>
<td></td>
<td></td>
<td></td>
<td align=right>({$total_versel_unpaid|number_format})</td>
<td align=right></td>
<td align=right>({$total_unpayment_price|number_format})</td>
</tr>

</table>

<br>
<span style="font-size: 16px;color: #FF3333;"><b>OP利用料入金（以前利用分）</b></span><br>
<table border=1>
<tr>
<td>利用日</td>
<td>予約番号</td>
<td>部屋</td>
<td>利用時間</td>
<td>OP利用料</td>
<td>入金額(OP)</td>
<td>未入金（利用+OP+サ総額）</td>
</tr>
({foreach from=$before_paid_data item=item})
({if $item.vessel_price})
<tr>
<td>({$item.date})</td>
<td align=right>({$item.reserve_id})</td>
<td>({$item.room_name})</td>
<td>({$item.time})</td>
<td align=right>
({if $item.cancel_flag==0})
	({$item.vessel_price|number_format})
({elseif $item.ab_data.total_billed_money})
	({$item.ab_data.total_billed_money|number_format})
({else})
({$item.vessel_price|number_format})
({/if})
</td>
<td align=right>
({if $item.cancel_flag==0})
	({if $item.pay_money > 0})
		({if $item.pay_flag==0})
			※
		({else})
			({$item.vessel_price|number_format})
		({/if})
	({else})
	0
	({/if})
({elseif $item.ab_data.pay_money})
	({if $item.ab_data.pay_money > 0})
		({if $item.ab_data.flag==0})
			※
		({/if})
		({$item.ab_data.pay_money|number_format})
	({else})
	0
	({/if})
({else})
({$item.vessel_price|number_format})
({/if})
</td>
<td align=right>
0
</td>
</tr>
({/if})
({/foreach})
<tr>
<td>合計</td>
<td></td>
<td></td>
<td></td>
<td align=right>({$total_vessel_use_before|number_format})</td>
<td align=right>({$total_vessel_use_before|number_format})</td>
<td align=right>0</td>
</tr>

</table>

<br>
<span style="font-size: 16px;color: #FF3333;"><b>OP未入金（以前利用分）</b></span><br>
<table border=1>
<tr>
<td>利用日</td>
<td>予約番号</td>
<td>部屋</td>
<td>利用時間</td>
<td>OP利用料</td>
<td>入金額(OP)</td>
<td>未入金（利用+OP+サ総額）</td>
</tr>
({foreach from=$before_unpayment_data item=item})
({if $item.vessel_price})
<tr>
<td>({$item.date})</td>
<td align=right>({$item.reserve_id})</td>
<td>({$item.room_name})</td>
<td>({$item.time})</td>
<td align=right>
({if $item.cancel_flag==0})
	({$item.vessel_price|number_format})
({elseif $item.ab_data.total_billed_money})
	({$item.ab_data.total_billed_money|number_format})
({else})
({$item.vessel_price|number_format})
({/if})
</td>
<td align=right>
({if $item.cancel_flag==0})
	({if $item.pay_money > 0})
		({if $item.pay_flag==0})
			※
		({else})
			({$item.vessel_price|number_format})
		({/if})
	({else})
	0
	({/if})
({elseif $item.ab_data.pay_money})
	({if $item.ab_data.pay_money > 0})
		({if $item.ab_data.flag==0})
			※
		({/if})
		({$item.ab_data.pay_money|number_format})
	({else})
	0
	({/if})
({else})
({$item.vessel_price|number_format})
({/if})
</td>
<td align=right>
({$item.unpayment_price|number_format})
</td>
</tr>
({/if})
({/foreach})
<tr>
<td>合計</td>
<td></td>
<td></td>
<td></td>
<td align=right>({$total_vessel_use_before_unpayment|number_format})</td>
<td align=right></td>
<td align=right>({$total_before_vessel_unpayment_price|number_format})</td>
</tr>

</table>

<br>
<br>

<span style="font-size: 20px;color: #3333FF;"><b>サービス利用料</b></span><br>
<table border=1>
<tr>
<td>利用日</td>
<td>予約番号</td>
<td>部屋</td>
<td>利用時間</td>
<td>サービス利用料</td>
<td>入金額(サービス)</td>
<td>未入金（利用+OP+サ総額）</td>
<td>&nbsp;</td>
</tr>
({foreach from=$reserve_data item=item})
({if $item.service_price})
<tr>
<td>({$item.date})</td>
<td align=right>({$item.reserve_id})</td>
<td>({$item.room_name})</td>
<td>({$item.time})</td>
<td align=right>
({$item.service_price|number_format})
</td>
<td align=right>
({if $item.cancel_flag==0})
	({if $item.pay_money > 0})
		({if $item.pay_flag==0})
			※
		({else})
			({$item.service_price|number_format})
		({/if})
	({else})
	0
	({/if})
({else})
({$item.service_price|number_format})
({/if})
</td>
<td align=right>
({$item.unpayment|number_format})
({if $item.unpayment_flag==1})
	(一部)
({/if})
</td>
<td>
({if $item.list_service})
({foreach from=$item.list_service item=service})
	({$service.service_name}):({$service.price|number_format})(x({$service.num}))<br/>
({/foreach})
({/if})
</td>
</tr>
({/if})
({/foreach})
<tr>
<td>合計</td>
<td></td>
<td></td>
<td></td>
<td align=right>({$total_service_price|number_format})</td>
<td align=right>({$total_service_price_paid|number_format})</td>
<td align=right>({$total_unpayment_price|number_format})</td>
</tr>
</table>
<br>
<span style="font-size: 16px;color: #FF3333;"><b>サービス利用済未入金</b></span><br>
<table border=1>
<tr>
<td>利用日</td>
<td>予約番号</td>
<td>部屋</td>
<td>利用時間</td>
<td>サービス利用料</td>
<td>入金額(サービス)</td>
<td>未入金（利用+OP+サ総額）</td>

</tr>
({foreach from=$reserve_data item=item})
({if $item.service_price})
({if $item.unpayment > 0})
<tr>
<td>({$item.date})</td>
<td align=right>({$item.reserve_id})</td>
<td>({$item.room_name})</td>
<td>({$item.time})</td>
<td align=right>
({if $item.cancel_flag==0})
	({$item.service_price|number_format})
({elseif $item.ab_data.total_billed_money})
	({$item.ab_data.total_billed_money|number_format})
({else})
({$item.service_price|number_format})
({/if})
</td>
<td align=right>
({if $item.cancel_flag==0})
	({if $item.pay_money > 0})
		({if $item.pay_flag==0})
			※
		({else})
			({$item.service_price|number_format})
		({/if})
	({else})
	0
	({/if})
({elseif $item.ab_data.pay_money})
	({if $item.ab_data.pay_money > 0})
		({if $item.ab_data.flag==0})
			※
		({/if})
		({$item.ab_data.pay_money|number_format})
	({else})
	0
	({/if})
({else})
({$item.service_price|number_format})
({/if})
</td>
<td align=right>
({$item.unpayment|number_format})
({if $item.unpayment_flag==1})
	(一部)
({/if})
</td>
</tr>
({/if})
({/if})
({/foreach})
<tr>
<td>合計</td>
<td></td>
<td></td>
<td></td>
<td align=right>({$total_service_price_unpayment|number_format})</td>
<td align=right></td>
<td align=right>({$total_unpayment_price|number_format})</td>
</tr>

</table>

<br>
<span style="font-size: 16px;color: #FF3333;"><b>サービス利用料入金（以前利用分）</b></span><br>
<table border=1>
<tr>
<td>利用日</td>
<td>予約番号</td>
<td>部屋</td>
<td>利用時間</td>
<td>サービス利用料</td>
<td>入金額(サービス)</td>
<td>未入金（利用+OP+サ総額）</td>
<td>&nbsp;</td>
</tr>
({foreach from=$before_paid_data item=item})
({if $item.service_price})
<tr>
<td>({$item.date})</td>
<td align=right>({$item.reserve_id})</td>
<td>({$item.room_name})</td>
<td>({$item.time})</td>
<td align=right>
({if $item.cancel_flag==0})
	({$item.service_price|number_format})
({elseif $item.ab_data.total_billed_money})
	({$item.ab_data.total_billed_money|number_format})
({else})
({$item.service_price|number_format})
({/if})
</td>
<td align=right>
({if $item.cancel_flag==0})
	({if $item.pay_money > 0})
		({if $item.pay_flag==0})
			※
		({else})
			({$item.service_price|number_format})
		({/if})
	({else})
	0
	({/if})
({elseif $item.ab_data.pay_money})
	({if $item.ab_data.pay_money > 0})
		({if $item.ab_data.flag==0})
			※
		({/if})
		({$item.ab_data.pay_money|number_format})
	({else})
	0
	({/if})
({else})
({$item.service_price|number_format})
({/if})
</td>
<td align=right>
0
</td>
<td>
({if $item.list_service})
({foreach from=$item.list_service item=service})
	({$service.service_name}):({$service.price|number_format})(x({$service.num}))<br/>
({/foreach})
({/if})
</td>
</tr>
({/if})
({/foreach})
<tr>
<td>合計</td>
<td></td>
<td></td>
<td></td>
<td align=right>({$total_service_use_before|number_format})</td>
<td align=right>({$total_service_use_before|number_format})</td>
<td align=right>0</td>
</tr>

</table>

<br>
<span style="font-size: 16px;color: #FF3333;"><b>サービス未入金（以前利用分）</b></span><br>
<table border=1>
<tr>
<td>利用日</td>
<td>予約番号</td>
<td>部屋</td>
<td>利用時間</td>
<td>サービス利用料</td>
<td>入金額(サービス)</td>
<td>未入金（利用+OP+サ総額）</td>
</tr>
({foreach from=$before_unpayment_data item=item})
({if $item.service_price})
<tr>
<td>({$item.date})</td>
<td align=right>({$item.reserve_id})</td>
<td>({$item.room_name})</td>
<td>({$item.time})</td>
<td align=right>
({if $item.cancel_flag==0})
	({$item.service_price|number_format})
({elseif $item.ab_data.total_billed_money})
	({$item.ab_data.total_billed_money|number_format})
({else})
({$item.service_price|number_format})
({/if})
</td>
<td align=right>
({if $item.cancel_flag==0})
	({if $item.pay_money > 0})
		({if $item.pay_flag==0})
			※
		({else})
			({$item.service_price|number_format})
		({/if})
	({else})
	0
	({/if})
({elseif $item.ab_data.pay_money})
	({if $item.ab_data.pay_money > 0})
		({if $item.ab_data.flag==0})
			※
		({/if})
		({$item.ab_data.pay_money|number_format})
	({else})
	0
	({/if})
({else})
({$item.service_price|number_format})
({/if})
</td>
<td align=right>
({$item.unpayment_price|number_format})
</td>
</tr>
({/if})
({/foreach})
<tr>
<td>合計</td>
<td></td>
<td></td>
<td></td>
<td align=right>({$total_service_use_before_unpayment|number_format})</td>
<td align=right></td>
<td align=right>({$total_before_vessel_unpayment_price|number_format})</td>
</tr>

</table>

<br>
<br>


({/if})
({************************************************************})

({elseif $menu=="management_analysis"})
<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('slip_output','page')})" />
<input type="hidden" name="menu" value="management_analysis">

<select name="hall_id" size=5 valign=top>
({foreach from=$hall_list item=item})
<option value="({$item.hall_id})" ({if $item.hall_id == $hall_id})selected({/if})>({$item.hall_name})
({/foreach})
</select>

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
<br>

({if $room_data})
会場：({$hall_name})<br>
対象期間：({$year1})年({$month1})月({$day1})日 ～ ({$year2})年({$month2})月({$day2})日<br>
<br>
（税抜き）(四捨五入計算)
<div style='width:900px;overflow-x:scroll;'>
<table border=1 width=2500>
<tr>
<th>会場名</th>
<th>部屋名</th>
<th>予約件数</th>
<th>予約金額利用</th>
<th>予約OP含む</th>
<th>予約OP含・昨年同期差額</th>
<th>予約OP含・昨年同期比</th>
<th>利用金額</th>
<th>利用OP含む</th>
<th>利用OP含・昨年同期差額</th>
<th>利用OP含・昨年同期比</th>
<th>未入金事故</th>
<th>金額稼働率OP除く</th>
<th>金額稼働率・昨年同期差</th>
<th>時間稼働率</th>
<th>リピート率</th>
<th>リピート率・昨年同期差</th>
<th>会場の累計利用数</th>
<th>累計来場者数</th>
</tr>
<tr>
<td>({$hall_name})</td>
<td>全体</td>
<td align=right>({$hall_data.reserve_count|number_format})</td>
<td align=right>({$hall_data.total_room_price|number_format})</td>
<td align=right>({$hall_data.total_rv_price|number_format})</td>
<td align=right>({$hall_data.total_rv_last_year|number_format})</td>
<td></td>
<td align=right>({$hall_data.total_use_room_price|number_format})</td>
<td align=right>({$hall_data.total_use_rv_price|number_format})</td>
<td align=right>({$hall_data.total_use_rv_last_year|number_format})</td>
<td></td>
<td align=right>({$hall_data.accident|number_format})</td>
<td align=right>({$hall_data.room_price_rate})%</td>
<td align=right>({$hall_data.room_rate_difference|number_format})</td>
<td align=right>({$hall_data.time_rate})%</td>
<td align=right>({$hall_data.rate})%</td>
<td align=right>({$hall_data.rate_difference|number_format})</td>
<td align=right>({$hall_data.all_reserved|number_format})</td>
<td align=right>({$hall_data.total_people|number_format})</td>
</tr>
({foreach from=$room_data item=item})
<tr>
<td></td>
<td>({$item.room_name})</td>
<td align=right>({$item.reserve_count|number_format})</td>
<td align=right>({$item.total_room_price|number_format})</td>
<td align=right>({$item.total_rv_price|number_format})</td>
<td align=right>({$item.total_rv_last_year|number_format})</td>
<td></td>
<td align=right>({$item.total_use_room_price|number_format})</td>
<td align=right>({$item.total_use_rv_price|number_format})</td>
<td align=right>({$item.total_use_rv_last_year|number_format})</td>
<td></td>
<td align=right>({$item.accident|number_format})</td>
<td align=right>({$item.room_price_rate})%</td>
<td align=right>({$item.room_rate_difference|number_format})</td>
<td align=right>({$item.time_rate})%</td>
<td align=right>--</td>
<td align=right>--</td>
<td align=right>({$item.all_reserved|number_format})</td>
<td align=right>({$item.total_people|number_format})</td>
</tr>
({/foreach})
</table>
</div>
({/if})
({********************************************************************})

({/if})

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
<script type="text/javascript">
	function paginate(page)
	{
		$("#page_num").val(page);
		$("#rental_form").submit();
	}
</script>