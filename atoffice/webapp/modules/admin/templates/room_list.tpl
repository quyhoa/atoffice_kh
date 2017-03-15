({$inc_header|smarty:nodefaults})
<a name="top">
({ext_include file="inc_subnavi_adminImageKakikomi.tpl"})
({assign var="page_name" value="部屋一覧"})
({ext_include file="inc_tree_adminImageKakikomi.tpl"})
</div>

({*ここまで:navi*})

({*権限チェック*})
({if $atoffice_auth_type==1 or $atoffice_auth_type==4})

<style type="text/css">
<!--
HR {
	border-style:dotted;color:#3399FF

}
-->
</style>


<h2 id="ttl01">部屋一覧【({$hall_name})】</h2>
<br>
<center>
({if $msg})<p class="actionMsg">({$msg})</p><br><br>({/if})

<br><br>
({foreach from=$rooms item=item})
<a href="./#room({$item+1})">|部屋({$item+1})|</a>
({/foreach})
<br><br>

<table border=1 width=750>

({foreach from=$rooms item=item})

({if $room_data.$item.room_name})

<tr>
({if $room_data.$item.flag})
<td width=100 height=50 bgcolor=#FFCC00>
<span style="font-size: 16pt;"><b>部屋({$item+1})</b></span><br><br>
<span style="font-size: 16pt;color:#FF0000;"><b>有効</b></span><br><br>
<form name="flag_off" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('room_list','page')})" />
<input type="hidden" name="hall_id" value="({$hall_id})" />
<input type="hidden" name="room_id" value="({$item+1})" />
<input type="hidden" name="flag_change" value="100">
<input type="submit" value="　無効にする　">
</form>

({else})
<td width=100 height=50 bgcolor=#000000>
<span style="font-size: 16pt;color:#FFFFFF;"><b>部屋({$item+1})</b></span><br><br>
<span style="font-size: 16pt;color:#FFFF00;"><b>無効</b></span><br><br>
<form name="flag_on" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('room_list','page')})" />
<input type="hidden" name="hall_id" value="({$hall_id})" />
<input type="hidden" name="room_id" value="({$item+1})" />
<input type="hidden" name="flag_change" value="200">
<input type="submit" value="　有効にする　">
</form>


({/if})
<br>
<a href="#top">Topへ戻る</a>
</td>
<td align=center>

<table width=600>
<tr><td align=left>
<a name="room({$item+1})">
<span style="color: #6633FF;"><b>部屋名称：</b></span>({$room_data.$item.room_name})<br>
<span style="color: #6633FF;"><b>コマ設定タイプ：</b></span>
({if $room_data.$item.type==1})
時間指定（池袋タイプ）
({else})
時間当たり（神田タイプ）
({/if})
<br>
<span style="color: #6633FF;"><b>使用人数：</b></span>
スクール<b>({$room_data.$item.num_school})</b>人／
口の字<b>({$room_data.$item.num_mouth})</b>人／
シアター<b>({$room_data.$item.num_theater})</b>人
<br>
<span style="color: #6633FF;"><b>利用可能属性：</b></span>
({if $room_data.$item.corp})
<b>○</b>
({else})
<b>×</b>
({/if})法人　
({if $room_data.$item.individual})
<b>○</b>
({else})
<b>×</b>
({/if})個人　
<br>
<span style="color: #6633FF;"><b>利用可能用途：</b></span>
({if $room_data.$item.conference})
<b>○</b>
({else})
<b>×</b>
({/if})会議　
({if $room_data.$item.seminar})
<b>○</b>
({else})
<b>×</b>
({/if})セミナー　
({if $room_data.$item.training})
<b>○</b>
({else})
<b>×</b>
({/if})研修　
({if $room_data.$item.interview})
<b>○</b>
({else})
<b>×</b>
({/if})面接・試験　
({if $room_data.$item.party})
<b>○</b>
({else})
<b>×</b>
({/if})懇談会・パーティ　
({if $room_data.$item.etc})
<b>○</b>
({else})
<b>×</b>
({/if})その他
<br>
<hr>
<br>
<span style="color: #6633FF;"><b>コマ設定プレビュー</b></span><br>
<br>

({foreach from=$room_data.$item.ikebukuro item=value})
<span style="color: #6633FF;"><b>({$value.koma})コマ目：</b></span>
<b>({$value.begin_time})</b>時　～　<b>({$value.finish_time})</b>時　<b>({$value.price})</b>円<br>
({/foreach})

({if $room_data.$item.type==1})

<br>
({elseif $room_data.$item.type==2})
<span style="color: #6633FF;"><b>１コマあたりの時間単位：</b></span>
({if $room_data.$item.koma<1})
<b>
({if $room_data.$item.koma==0.25})
15
({else})
30
({/if})
</b>分<br>
({else})
<b>({$room_data.$item.koma})</b>時間<br>
({/if})
<span style="color: #6633FF;"><b>１コマあたりの人数と値段：</b></span><br>
<table>
({if $room_data.$item.k_lowest_price})
<tr>
<td width=200><b>({$room_data.$item.k_capa_lowest})</b> 人　まで　</td>
<td align=right>
<b>({$room_data.$item.k_lowest_price})</b>円<br>
</td>
</tr>
({/if})
({if $room_data.$item.k_price2})
<tr>
<td width=200><b>({$room_data.$item.k_capa_low2})</b> 人　～　
<b>({$room_data.$item.k_capa_high2})</b> 人　まで　</td>
<td align=right>
<b>({$room_data.$item.k_price2})</b>円<br>
</td>
</tr>
({/if})
({if $room_data.$item.k_price3})
<tr>
<td width=200><b>({$room_data.$item.k_capa_low3})</b> 人　～　
<b>({$room_data.$item.k_capa_high3})</b> 人　まで　</td>
<td align=right>
<b>({$room_data.$item.k_price3})</b>円<br>
</td>
</tr>
({/if})
({if $room_data.$item.k_highest_price})
<tr>
<td width=200><b>({$room_data.$item.k_capa_highest})</b> 人　以上　</td>
<td align=right>
<b>({$room_data.$item.k_highest_price})</b>円<br>
</td>
</tr>
({/if})
</table>

<span style="color: #6633FF;"><b>最低予約コマ数：</b></span>
<b>({$room_data.$item.lowest_koma})</b>コマから予約可能<br>
<br>
({/if})
■　会場営業時間外　
<span style="color: #66CC00;">■</span>　予約可能な１コマ　
<span style="color: #FF6600;">■</span>　休憩時間又は余りのコマ（予約不可）
({if $room_data.$item.type==1 or ($room_data.$item.type==2 and $room_data.$item.koma>=1)})
<table border=1>
<tr>
<th width=20>00</th>
<th width=20>01</th>
<th width=20>02</th>
<th width=20>03</th>
<th width=20>04</th>
<th width=20>05</th>
<th width=20>06</th>
<th width=20>07</th>
<th width=20>08</th>
<th width=20>09</th>
<th width=20>10</th>
<th width=20>11</th>
<th width=20>12</th>
<th width=20>13</th>
<th width=20>14</th>
<th width=20>15</th>
<th width=20>16</th>
<th width=20>17</th>
<th width=20>18</th>
<th width=20>19</th>
<th width=20>20</th>
<th width=20>21</th>
<th width=20>22</th>
<th width=20>23</th>
</tr>
<tr>
({if $room_data.$item.type==1})
({if $hall_begin})
<td height=20 colspan=({$hall_begin}) align=center bgcolor=#000000>
</td>
({/if})

({foreach from=$room_data.$item.span_list item=item2})

({if $item2.span})
<td colspan=({$item2.span}) bgcolor=({if $item2.rest})#FF6600({else})#66CC00({/if})></td>
({/if})

({/foreach})

<td height=20 colspan=({$day_time-$hall_finish}) align=center bgcolor=#000000></td>


({elseif $room_data.$item.type==2})

<td height=20 colspan=({$hall_begin}) align=center bgcolor=#000000>
</td>
({foreach from=$room_data.$item.loop_list item=item2})
<td colspan=({$room_data.$item.koma}) bgcolor=#66CC00></td>
({/foreach})
({foreach from=$room_data.$item.etc_list item=item2})
<td bgcolor=#FF6600></td>
({/foreach})
({if $day_time-$hall_finish+1})
<td height=20 colspan=({$day_time-$hall_finish+1}) align=center bgcolor=#000000></td>
({/if})
({/if})

</tr>
</table>
({else})
<br>

<table border=1>
<tr>
<th width=20 colspan=({$room_data.$item.th_span})>00</th>
<th width=20 colspan=({$room_data.$item.th_span})>01</th>
<th width=20 colspan=({$room_data.$item.th_span})>02</th>
<th width=20 colspan=({$room_data.$item.th_span})>03</th>
<th width=20 colspan=({$room_data.$item.th_span})>04</th>
<th width=20 colspan=({$room_data.$item.th_span})>05</th>
<th width=20 colspan=({$room_data.$item.th_span})>06</th>
<th width=20 colspan=({$room_data.$item.th_span})>07</th>
<th width=20 colspan=({$room_data.$item.th_span})>08</th>
<th width=20 colspan=({$room_data.$item.th_span})>09</th>
<th width=20 colspan=({$room_data.$item.th_span})>10</th>
<th width=20 colspan=({$room_data.$item.th_span})>11</th>
<th width=20 colspan=({$room_data.$item.th_span})>12</th>
<th width=20 colspan=({$room_data.$item.th_span})>13</th>
<th width=20 colspan=({$room_data.$item.th_span})>14</th>
<th width=20 colspan=({$room_data.$item.th_span})>15</th>
<th width=20 colspan=({$room_data.$item.th_span})>16</th>
<th width=20 colspan=({$room_data.$item.th_span})>17</th>
<th width=20 colspan=({$room_data.$item.th_span})>18</th>
<th width=20 colspan=({$room_data.$item.th_span})>19</th>
<th width=20 colspan=({$room_data.$item.th_span})>20</th>
<th width=20 colspan=({$room_data.$item.th_span})>21</th>
<th width=20 colspan=({$room_data.$item.th_span})>22</th>
<th width=20 colspan=({$room_data.$item.th_span})>23</th>
</tr>
<tr>

<td colspan=({$hall_begin*$room_data.$item.th_span}) bgcolor=#000000></td>

({foreach from=$room_data.$item.minutes item=min})

({if $min>$hall_begin and $min<=$hall_finish})

<td bgcolor=#66CC00 height=20 width=2></td>
<td bgcolor=#66CC00 height=20 width=2></td>
({if $room_data.$item.th_span==4})
<td bgcolor=#66CC00 height=20 width=2></td>
<td bgcolor=#66CC00 height=20 width=2></td>
({/if})
({/if})
({/foreach})

<td colspan=23-({$hall_finish}) bgcolor=#000000></td>

</tr>


</table>

<br>
({/if})

<hr>

<span style="color: #6633FF;"><b>選択キャンセル料率：</b></span>パターン({$room_data.$item.cancel})<br>
({if $room_data.$item.cancel_pattern.day1!=""})
({$room_data.$item.cancel_pattern.day1})日前まで ({$room_data.$item.cancel_pattern.percent1})％ 
({/if})
({if $room_data.$item.cancel_pattern.day2!=""})
 ／ ({$room_data.$item.cancel_pattern.day2})日前まで ({$room_data.$item.cancel_pattern.percent2})％ 
({/if})
({if $room_data.$item.cancel_pattern.day3!=""})
 ／ ({$room_data.$item.cancel_pattern.day3})日前まで ({$room_data.$item.cancel_pattern.percent3})％ 
({/if})
({if $room_data.$item.cancel_pattern.day4!=""})
 ／ ({$room_data.$item.cancel_pattern.day4})日前まで ({$room_data.$item.cancel_pattern.percent4})％ 
({/if})
({if $room_data.$item.cancel_pattern.day5!=""})
 ／ ({$room_data.$item.cancel_pattern.day5})日前まで ({$room_data.$item.cancel_pattern.percent5})％ 
({/if})

<hr>

<form name="hall_conf" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('room_discount_conf','page')})" />
<input type="hidden" name="hall_id" value="({$hall_id})" />
<input type="hidden" name="room_id" value="({$item+1})" />
<span style="color: #6633FF;"><b>部屋別割引設定：</b></span><input type="submit" value="　割引・パック料金を設定する　">
</form>
<br>
<table>
({foreach from=$room_data.$item.discount key=d_key item=d_item})
<tr>
<td>({if $d_key==0})有効割引：({/if})</td>
({if $d_item.pattern_id < 4})
<td>パターン({$d_item.pattern_id})：　({$d_item.begin_year})年({$d_item.begin_month})月({$d_item.begin_day})日　～　({$d_item.finish_year})年({$d_item.finish_month})月({$d_item.finish_day})日　({$d_item.percent})%割引</td>
({else})
<td>パターン({$d_item.pattern_id})：
({if $d_item.continuance==1})
全ての平日営業日
({elseif $d_item.continuance==2})
全ての土曜営業日
({elseif $d_item.continuance==3})
全ての日祭日営業日
({elseif $d_item.continuance==4})
全ての営業日
({/if})
　({$d_item.percent})%割引</td>
({/if})
</tr>
({foreachelse})
<tr>
<td>
有効割引：　<b>未設定</b>
</td>
</tr>
({/foreach})
</table>

<table>
({foreach from=$room_data.$item.pack key=p_key item=p_item})
<tr>
<td>({if $p_key==0})有効Pack：({/if})</td>
<td>パック料金設定({$p_item.pack_id})：　({$p_item.pack_name})　
({if $p_item.begin_time or $p_item.finish_time})
({$p_item.begin_time})時　～　({$p_item.finish_time})時　
({elseif $p_item.koma})
({$p_item.koma})コマ予約で、ひとコマあたり　
({/if})
({$p_item.price})円
</td>
</tr>
({foreachelse})
<tr>
<td>
有効割引2：　<b>未設定</b>
</td>
</tr>
({/foreach})
</table>

<hr>

<form name="hall_conf" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('room_holiday_conf','page')})" />
<input type="hidden" name="hall_id" value="({$hall_id})" />
<input type="hidden" name="room_id" value="({$item+1})" />
<span style="color: #6633FF;"><b>部屋別休日設定：</b></span><input type="submit" value="　休日設定をする　">
</form>


<hr>

<form name="hall_conf" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('room_vessel_conf','page')})" />
<input type="hidden" name="hall_id" value="({$hall_id})" />
<input type="hidden" name="room_id" value="({$item+1})" />
<span style="color: #6633FF;"><b>部屋別備品設定：</b></span><input type="submit" value="　備品設定をする　">
</form>
選択備品一覧：
({if $room_data.$item.vessel_list})
<b>({$room_data.$item.vessel_list})</b>
({else})
<b>未選択</b>
({/if})
<br>
<hr>

<form name="hall_conf" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('room_service_conf','page')})" />
<input type="hidden" name="hall_id" value="({$hall_id})" />
<input type="hidden" name="room_id" value="({$item+1})" />
<span style="color: #6633FF;"><b>部屋別サービス設定：</b></span><input type="submit" value="　サービス設定をする　">
</form>
選択サービス一覧：
({if $room_data.$item.service_list})
<b>({$room_data.$item.service_list})</b>
({else})
<b>未選択</b>
({/if})


({else})

<tr>

<td width=100 height=50 bgcolor=#CCFFCC>
<span style="font-size: 16pt;"><b>部屋({$item+1})</b></span>
<br>
<a href="#top">Topへ戻る</a>
</td>
<td align=center>

<table width=600>
<tr><td align=left>
<a name="room({$item+1})">
<span style="color: #FF0000;"><b>未設定</b></span>
({/if})
<hr>
<form name="hall_conf" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('add_room','page')})" />
<input type="hidden" name="hall_id" value="({$hall_id})" />
<input type="hidden" name="room_id" value="({$item+1})" />
<input type="submit" value="　この部屋の設定をする　">
</form>
</td></tr>
</table>

</td>
</tr>
({/foreach})

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
