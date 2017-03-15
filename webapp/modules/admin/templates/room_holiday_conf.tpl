({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminImageKakikomi.tpl"})
({assign var="page_name" value="部屋休日登録"})
({ext_include file="inc_tree_adminImageKakikomi.tpl"})
</div>

({*ここまで:navi*})

({*権限チェック*})
({if $atoffice_auth_type==1 or $atoffice_auth_type==4})

<STYLE TYPE="text/css">
<!--
.c1{
position:absolute; left:0px; top:0px; visibility:hidden;
font-size:9pt; color:#0099FF; 
background-color:#FFFFFF; layer-background-color:#FFFFFF;
border:1px solid #0099FF; padding:5px;
}
-->
</STYLE>

<SCRIPT LANGUAGE="JavaScript">
<!--
var IE = 0,NN = 0,N6 = 0;
if(document.all) IE = true;
else if(document.layers) NN = true;
else if(document.getElementById) N6 = true;
function OnLink(Msg,mX,mY,nX,nY){
var pX = 0,pY = 0;
var sX = -10,sY = 30;
if(IE){
MyMsg = document.all(Msg).style;
MyMsg.visibility = "visible";
}
if(NN){
MyMsg = document.layers[Msg];
MyMsg.visibility = "show";
}
if(N6){
MyMsg = document.getElementById(Msg).style;
MyMsg.visibility = "visible";
}
if(IE){
pX = document.body.scrollLeft;
pY = document.body.scrollTop;
MyMsg.left = mX + pX + sX;
MyMsg.top = mY + pY + sY;
}
if(NN || N6){
MyMsg.left = nX+ sX;
MyMsg.top = nY + sY;
}
}
function OffLink(Msg){
if(IE) document.all(Msg).style.visibility = "hidden";
if(NN) document.layers[Msg].visibility = "hide";
if(N6) document.getElementById(Msg).style.visibility = "hidden";
}
//-->
</SCRIPT>

<h2 id="ttl01">部屋休日登録【({$hall_name})】【({$room_name})】</h2>
<br>
<div align=right>
<form name="add_room" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('room_list','page')})" />
<input type="hidden" name="hall_id" value="({$hall_id})">
<input type="submit" value="部屋一覧へ戻る">
</form>
</div>
<br>
<center>
({if $msg})<p class="actionMsg">({$msg})</p><br><br>({/if})

<table>
<tr>
<td width=400 valign="top" align=left>

<table border=1 width=350>
<tr>
<th colspan=7 height=50 bgcolor=#FF0000>　
<span style="font-size: 16pt; color: #FFFFFF"><b>休日確認</b></span>
</th>
</tr>
<tr>
<td>

<form name="back" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('room_holiday_conf','page')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
<input type="hidden" name="hall_id" value="({$hall_id})" />
<input type="hidden" name="room_id" value="({$room_id})" />

<input type="hidden" name="target_month" value="({$month-1})" />
<input type="hidden" name="target_year" value="({$year})" />
<input type="submit" value="<<前月">
</form>
</td>
<td colspan=5 align=center><b>({$year})年({$month})月</b><br>

<form name="next" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('room_holiday_conf','page')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
<input type="hidden" name="hall_id" value="({$hall_id})" />
<input type="hidden" name="room_id" value="({$room_id})" />
<input type="hidden" name="target_month" value="" />
<input type="hidden" name="target_year" value="" />
<input type="submit" value="リセット">
</form>
</td>
<td>
<form name="next" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('room_holiday_conf','page')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
<input type="hidden" name="hall_id" value="({$hall_id})" />
<input type="hidden" name="room_id" value="({$room_id})" />
<input type="hidden" name="target_month" value="({$month+1})" />
<input type="hidden" name="target_year" value="({$year})" />
<input type="submit" value="次月>>">
</form>
</td>
</tr>
<tr>
<form name="bank" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="do_({$hash_tbl->hash('add_room_holiday','do')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
<input type="hidden" name="hall_id" value="({$hall_id})" />
<input type="hidden" name="room_id" value="({$room_id})" />
<input type="hidden" name="checkbox_flag" value="1" />
<input type="hidden" name="year({$key})" value="({$year})">
<input type="hidden" name="month({$key})" value="({$month})">


<td width=50 align=center>日</td>
<td width=50 align=center>月</td>
<td width=50 align=center>火</td>
<td width=50 align=center>水</td>
<td width=50 align=center>木</td>
<td width=50 align=center>金</td>
<td width=50 align=center>土</td>
</tr>

({if $wtop>0})
<td></td>
({/if})
({if $wtop>1})
<td></td>
({/if})
({if $wtop>2})
<td></td>
({/if})
({if $wtop>3})
<td></td>
({/if})
({if $wtop>4})
<td></td>
({/if})
({if $wtop>5})
<td></td>
({/if})

({foreach from=$day_list key=key item=item})
<span id="L({$key})" class="c1">― ({$item.holiday_jp.name}) ―</span>
<td 
({*** 過ぎた日 ***})
({if ($year==$this_year and $month==$this_month and $item.day<$today) or ($year==$this_year and $month<$this_month) or ($year<$this_year)})
bgcolor=#D0D0D0 
({else})

({*** 定休日 ***})
({if $item.hall_holiday})bgcolor=#FFDDDD 
({elseif $item.room_holiday})bgcolor=#FFCC00
({/if})


({/if})

({if $item.holiday_jp.day == $item.day}) onMouseOver="OnLink('L({$key})',event.x,event.y,event.pageX,event.pageY)" onMouseOut="OffLink('L({$key})')"({/if})
>
({*** 祝日文字色  ***})
({if $item.holiday_jp.day == $item.day})
<span style="color: #FF0000; margin:5px"><b>
({$item.day})</b>
</span>
({else})
<span style="margin:5px">
({$item.day})
</span>
({/if})

({if ($this_year<$year or ($this_year==$year and $this_month<$month) or ($this_year==$year and $this_month==$month and $item.day>=$today)) and (!$item.hall_holiday and !$item.room_holiday)})
<input type="checkbox" name="day({$key+1})" value="({$item.day})">
({/if})

</td>
({if $wtop==0 and ($key+1)%7==0})</tr><tr>({/if})
({if $wtop==1 and ($key+2)%7==0})</tr><tr>({/if})
({if $wtop==2 and ($key+3)%7==0})</tr><tr>({/if})
({if $wtop==3 and ($key+4)%7==0})</tr><tr>({/if})
({if $wtop==4 and ($key+5)%7==0})</tr><tr>({/if})
({if $wtop==5 and ($key+6)%7==0})</tr><tr>({/if})
({if $wtop==6 and ($key+7)%7==0})</tr><tr>({/if})
({/foreach})
</tr>
<tr>
<td colspan=7 align=center>
<input type="submit" value="　日付指定に登録する　">
</td>
</tr>
</table>
</form>
<br>
<span style="color: #FF0000;">赤字：</span>祝日　
<span style="color: #D0D0D0;">■</span> 過ぎた日にち　
<span style="color: #FFDDDD;">■</span> 会場の休日　
<span style="color: #FFCC00;">■</span> 部屋の休日<br>
<br>
<span style="color: #FF0000;">
※ 日付指定の登録は月を切り替えると選択が消えますので、<br>
　 月ごとに設定してください。
</span>

</td>
<td valign="top">

<form name="bank" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="do_({$hash_tbl->hash('add_room_regular_holiday','do')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
<input type="hidden" name="hall_id" value="({$hall_id})" />
<input type="hidden" name="room_id" value="({$room_id})" />

<table border=1 width=650>
<tr>
<th colspan=2 height=50 bgcolor=#FF0000>　
<span style="font-size: 16pt; color: #FFFFFF"><b>定休日　</b></span><input type="submit" value="　設　定　">
</th>
</tr>
<tr>
<td width=150 align=center bgcolor=#FFEEF4>-月(毎年)-</td>
<td width=500>

<table>
<tr>
<td>
({if $hall_regular_data.january})
✔
({else})
<input type="checkbox" name="january" value="1" ({if $room_regular_data.january})checked({/if})>
({/if}) 1月
</td><td>
({if $hall_regular_data.february})
✔
({else})
<input type="checkbox" name="february" value="1" ({if $room_regular_data.february})checked({/if})>
({/if}) 2月
</td><td>
({if $hall_regular_data.march})
✔
({else})
<input type="checkbox" name="march" value="1" ({if $room_regular_data.march})checked({/if})>
({/if}) 3月
</td><td>
({if $hall_regular_data.april})
✔
({else})
<input type="checkbox" name="april" value="1" ({if $room_regular_data.april})checked({/if})>
({/if}) 4月
</td><td>
({if $hall_regular_data.may})
✔
({else})
<input type="checkbox" name="may" value="1" ({if $room_regular_data.may})checked({/if})>
({/if}) 5月
</td><td>
({if $hall_regular_data.june})
✔
({else})
<input type="checkbox" name="june" value="1" ({if $room_regular_data.june})checked({/if})>
({/if}) 6月
</td></tr><tr><td>
({if $hall_regular_data.july})
✔
({else})
<input type="checkbox" name="july" value="1" ({if $room_regular_data.july})checked({/if})>
({/if}) 7月
</td><td>
({if $hall_regular_data.august})
✔
({else})
<input type="checkbox" name="august" value="1" ({if $room_regular_data.august})checked({/if})>
({/if}) 8月
</td><td>
({if $hall_regular_data.september})
✔
({else})
<input type="checkbox" name="september" value="1" ({if $room_regular_data.september})checked({/if})>
({/if}) 9月
</td><td>
({if $hall_regular_data.october})
✔
({else})
<input type="checkbox" name="october" value="1" ({if $room_regular_data.october})checked({/if})>
({/if}) 10月
</td><td>
({if $hall_regular_data.november})
✔
({else})
<input type="checkbox" name="november" value="1" ({if $room_regular_data.november})checked({/if})>
({/if}) 11月
</td><td>
({if $hall_regular_data.december})
✔
({else})
<input type="checkbox" name="december" value="1" ({if $room_regular_data.december})checked({/if})>
({/if}) 12月
</td>
</table>

</td>
</tr>
<tr>
<td  align=center bgcolor=#FFEEF4>-曜日(毎月)-</td>
<td>

<table>
<tr>
<td>
({if $hall_regular_data.sunday})
✔
({else})
<input type="checkbox" name="sunday" value="1" ({if $room_regular_data.sunday})checked({/if})>
({/if}) 日曜日
</td><td>
({if $hall_regular_data.monday})
✔
({else})
<input type="checkbox" name="monday" value="1" ({if $room_regular_data.monday})checked({/if})>
({/if}) 月曜日
</td><td>
({if $hall_regular_data.tuesday})
✔
({else})
<input type="checkbox" name="tuesday" value="1" ({if $room_regular_data.tuesday})checked({/if})>
({/if}) 火曜日
</td><td>
({if $hall_regular_data.wednesday})
✔
({else})
<input type="checkbox" name="wednesday" value="1" ({if $room_regular_data.wednesday})checked({/if})>
({/if}) 水曜日
</td><td>
({if $hall_regular_data.thursday})
✔
({else})
<input type="checkbox" name="thursday" value="1" ({if $room_regular_data.thursday})checked({/if})>
({/if}) 木曜日
</td><td>
({if $hall_regular_data.friday})
✔
({else})
<input type="checkbox" name="friday" value="1" ({if $room_regular_data.friday})checked({/if})>
({/if}) 金曜日
</td><td>
({if $hall_regular_data.saturday})
✔
({else})
<input type="checkbox" name="saturday" value="1" ({if $room_regular_data.saturday})checked({/if})>
({/if}) 土曜日
</td>
</tr>
</table>

</td>
</tr>
<tr>
<td  align=center bgcolor=#FFEEF4>-日(毎月)-</td>
<td>

<table border=1>
<tr>
<td>
({if $hall_regular_data.day1})
✔
({else})
<input type="checkbox" name="day1" value="1" ({if $room_regular_data.day1})checked({/if})>
({/if}) 1日
</td><td>
({if $hall_regular_data.day2})
✔
({else})
<input type="checkbox" name="day2" value="1" ({if $room_regular_data.day2})checked({/if})>
({/if}) 2日
</td><td>
({if $hall_regular_data.day3})
✔
({else})
<input type="checkbox" name="day3" value="1" ({if $room_regular_data.day3})checked({/if})>
({/if}) 3日
</td><td>
({if $hall_regular_data.day4})
✔
({else})
<input type="checkbox" name="day4" value="1" ({if $room_regular_data.day4})checked({/if})>
({/if}) 4日
</td><td>
({if $hall_regular_data.day5})
✔
({else})
<input type="checkbox" name="day5" value="1" ({if $room_regular_data.day5})checked({/if})>
({/if}) 5日
</td><td>
({if $hall_regular_data.day6})
✔
({else})
<input type="checkbox" name="day6" value="1" ({if $room_regular_data.day6})checked({/if})>
({/if}) 6日
</td><td>
({if $hall_regular_data.day7})
✔
({else})
<input type="checkbox" name="day7" value="1" ({if $room_regular_data.day7})checked({/if})>
({/if}) 7日
</td></tr><tr><td>
({if $hall_regular_data.day8})
✔
({else})
<input type="checkbox" name="day8" value="1" ({if $room_regular_data.day8})checked({/if})>
({/if}) 8日
</td><td>
({if $hall_regular_data.day9})
✔
({else})
<input type="checkbox" name="day9" value="1" ({if $room_regular_data.day9})checked({/if})>
({/if}) 9日
</td><td>
({if $hall_regular_data.day10})
✔
({else})
<input type="checkbox" name="day10" value="1" ({if $room_regular_data.day10})checked({/if})>
({/if}) 10日
</td><td>
({if $hall_regular_data.day11})
✔
({else})
<input type="checkbox" name="day11" value="1" ({if $room_regular_data.day11})checked({/if})>
({/if}) 11日
</td><td>
({if $hall_regular_data.day12})
✔
({else})
<input type="checkbox" name="day12" value="1" ({if $room_regular_data.day12})checked({/if})>
({/if}) 12日
</td><td>
({if $hall_regular_data.day13})
✔
({else})
<input type="checkbox" name="day13" value="1" ({if $room_regular_data.day13})checked({/if})>
({/if}) 13日
</td><td>
({if $hall_regular_data.day14})
✔
({else})
<input type="checkbox" name="day14" value="1" ({if $room_regular_data.day14})checked({/if})>
({/if}) 14日
</td></tr><tr><td>
({if $hall_regular_data.day15})
✔
({else})
<input type="checkbox" name="day15" value="1" ({if $room_regular_data.day15})checked({/if})>
({/if}) 15日
</td><td>
({if $hall_regular_data.day16})
✔
({else})
<input type="checkbox" name="day16" value="1" ({if $room_regular_data.day16})checked({/if})>
({/if}) 16日
</td><td>
({if $hall_regular_data.day17})
✔
({else})
<input type="checkbox" name="day17" value="1" ({if $room_regular_data.day17})checked({/if})>
({/if}) 17日
</td><td>
({if $hall_regular_data.day18})
✔
({else})
<input type="checkbox" name="day18" value="1" ({if $room_regular_data.day18})checked({/if})>
({/if}) 18日
</td><td>
({if $hall_regular_data.day19})
✔
({else})
<input type="checkbox" name="day19" value="1" ({if $room_regular_data.day19})checked({/if})>
({/if}) 19日
</td><td>
({if $hall_regular_data.day20})
✔
({else})
<input type="checkbox" name="day20" value="1" ({if $room_regular_data.day20})checked({/if})>
({/if}) 20日
</td><td>
({if $hall_regular_data.day21})
✔
({else})
<input type="checkbox" name="day21" value="1" ({if $room_regular_data.day21})checked({/if})>
({/if}) 21日
</td></tr><tr><td>
({if $hall_regular_data.day22})
✔
({else})
<input type="checkbox" name="day22" value="1" ({if $room_regular_data.day22})checked({/if})>
({/if}) 22日
</td><td>
({if $hall_regular_data.day23})
✔
({else})
<input type="checkbox" name="day23" value="1" ({if $room_regular_data.day23})checked({/if})>
({/if}) 23日
</td><td>
({if $hall_regular_data.day24})
✔
({else})
<input type="checkbox" name="day24" value="1" ({if $room_regular_data.day24})checked({/if})>
({/if}) 24日
</td><td>
({if $hall_regular_data.day25})
✔
({else})
<input type="checkbox" name="day25" value="1" ({if $room_regular_data.day25})checked({/if})>
({/if}) 25日
</td><td>
({if $hall_regular_data.day26})
✔
({else})
<input type="checkbox" name="day26" value="1" ({if $room_regular_data.day26})checked({/if})>
({/if}) 26日
</td><td>
({if $hall_regular_data.day27})
✔
({else})
<input type="checkbox" name="day27" value="1" ({if $room_regular_data.day27})checked({/if})>
({/if}) 27日
</td><td>
({if $hall_regular_data.day28})
✔
({else})
<input type="checkbox" name="day28" value="1" ({if $room_regular_data.day28})checked({/if})>
({/if}) 28日
</td></tr><tr><td>
({if $hall_regular_data.day29})
✔
({else})
<input type="checkbox" name="day29" value="1" ({if $room_regular_data.day29})checked({/if})>
({/if}) 29日
</td><td>
({if $hall_regular_data.day30})
✔
({else})
<input type="checkbox" name="day30" value="1" ({if $room_regular_data.day30})checked({/if})>
({/if}) 30日
</td><td>
({if $hall_regular_data.day31})
✔
({else})
<input type="checkbox" name="day31" value="1" ({if $room_regular_data.day31})checked({/if})>
({/if}) 31日
</td>
</tr>
</table>

</td>
</tr>

<tr>
<td bgcolor=#FFEEF4>
-祝日（毎年）-
</td>
<td align=left>
<span style="margin:5px">
({if $hall_regular_data.holiday})
✔ 祝日を一括で休日にする
({else})
<input type="checkbox" name="holiday" value="1" ({if $room_regular_data.holiday})checked({/if})> 祝日を一括で休日にする</span>
({/if})
</td>
</tr>

</table>
</form>
<br><br>

<form name="bank" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="do_({$hash_tbl->hash('add_room_holiday','do')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
<input type="hidden" name="hall_id" value="({$hall_id})" />
<input type="hidden" name="room_id" value="({$room_id})" />
<table border=1 width=650>
<tr>
<th colspan=3 height=50 bgcolor=#FF0000>　
<span style="font-size: 16pt; color: #FFFFFF"><b>日付指定　</b></span><input type="submit" value="　設　定　">
</th>
</tr>
({foreach from=$hall_holiday_list key=key item=item})
<tr>
<td width=150 align=center bgcolor=#FFEEF4>会場設定({$key+1})</td>
<td align=center>
({$item.year}) 年 
({$item.month}) 月 
({$item.day}) 日
</td>
<td>
</td>
</tr>
({/foreach})
({foreach from=$holiday_num_list key=key item=item})
<tr>
<td width=150 align=center bgcolor=#FFEEF4>設定({$item})</td>
<td align=center>
<input type="text" name="year({$item})" value="({$room_holiday_list.$key.year})" size=10> 年 
<input type="text" name="month({$item})" value="({$room_holiday_list.$key.month})" size=10> 月 
<input type="text" name="day({$item})" value="({$room_holiday_list.$key.day})" size=10> 日
</td>
<td>
<input type="checkbox" name="delete({$item})"> 削除
</td>
</tr>
({/foreach})
<tr>
<th colspan=3 height=50 bgcolor=#FF0000>　
<input type="submit" value="　設　定　">
</th>
</tr>
</table>
<br>
<span style="color: #FF0000;"><b>
※ 日付を指定して30日分の休日を設定できます。<br>
※ 日付の過ぎた指定休日のデータは、このページを開いたときに削除され、新たに設定できます。
</b></span>

</td>
</tr>
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
