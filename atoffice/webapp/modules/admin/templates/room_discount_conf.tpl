({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminImageKakikomi.tpl"})
({assign var="page_name" value="部屋別割引設定"})
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

<h2 id="ttl01">部屋別割引設定【({$hall_name})】【({$room_data.room_name})】</h2>
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

<br><br>
この部屋の標準価格一覧
({if $room_data.type==1})
<table border=1>
({foreach from=$i_koma_list item=item})
<tr>
<td width=80 bgcolor=#CDCDCD>
({$item.num})コマ目
</td>
<td width=120>
({$item.begin})時～({$item.finish})時
</td>
<td width=120>
({$item.price})円
</td>
({if $item.1})
<td align=left>
パターン1: <span style="color: #FF0000;">({$item.1})</span>円
</td>
({/if})
({if $item.2})
<td align=left>
パターン2: <span style="color: #FF0000;">({$item.2})</span>円
</td>
({/if})
({if $item.3})
<td align=left>
パターン3: <span style="color: #FF0000;">({$item.3})</span>円
</td>
({/if})
({if $item.4})
<td align=left>
パターン4: <span style="color: #FF0000;">({$item.4})</span>円
</td>
({/if})
({if $item.5})
<td align=left>
パターン5: <span style="color: #FF0000;">({$item.5})</span>円
</td>
({/if})
({if $item.6})
<td align=left>
パターン6: <span style="color: #FF0000;">({$item.6})</span>円
</td>
({/if})
</tr>
({/foreach})
</table>
({else})
<table border=1>
({if $room_data.k_lowest_price})
<tr>
<td bgcolor=#CDCDCD>
({$room_data.k_capa_lowest}) 人 まで
</td>
<td width=80>
({$room_data.k_lowest_price})円
</td>
({if $room_data.k_lowest_discount.1})
<td>
パターン1: <span style="color: #FF0000;">({$room_data.k_lowest_discount.1})</span>円
</td>
({/if})
({if $room_data.k_lowest_discount.2})
<td>
パターン2: <span style="color: #FF0000;">({$room_data.k_lowest_discount.2})</span>円
</td>
({/if})
({if $room_data.k_lowest_discount.3})
<td>
パターン3: <span style="color: #FF0000;">({$room_data.k_lowest_discount.3})</span>円
</td>
({/if})
({if $room_data.k_lowest_discount.4})
<td>
パターン4: <span style="color: #FF0000;">({$room_data.k_lowest_discount.4})</span>円
</td>
({/if})
({if $room_data.k_lowest_discount.5})
<td>
パターン5: <span style="color: #FF0000;">({$room_data.k_lowest_discount.5})</span>円
</td>
({/if})
({if $room_data.k_lowest_discount.6})
<td>
パターン6 <span style="color: #FF0000;">({$room_data.k_lowest_discount.6})</span>円
</td>
({/if})

</tr>
({/if})
({if $room_data.k_price2})
<tr>
<td bgcolor=#CDCDCD>
({$room_data.k_capa_low2}) 人 ～ ({$room_data.k_capa_high2}) 人 まで
</td>
<td width=80>
({$room_data.k_price2})円
</td>

({if $room_data.k_price2_discount.1})
<td>
パターン1: <span style="color: #FF0000;">({$room_data.k_price2_discount.1})</span>円
</td>
({/if})
({if $room_data.k_price2_discount.2})
<td>
パターン2: <span style="color: #FF0000;">({$room_data.k_price2_discount.2})</span>円
</td>
({/if})
({if $room_data.k_price2_discount.3})
<td>
パターン3: <span style="color: #FF0000;">({$room_data.k_price2_discount.3})</span>円
</td>
({/if})
({if $room_data.k_price2_discount.4})
<td>
パターン4: <span style="color: #FF0000;">({$room_data.k_price2_discount.4})</span>円
</td>
({/if})
({if $room_data.k_price2_discount.5})
<td>
パターン5: <span style="color: #FF0000;">({$room_data.k_price2_discount.5})</span>円
</td>
({/if})
({if $room_data.k_price2_discount.6})
<td>
パターン6 <span style="color: #FF0000;">({$room_data.k_price2_discount.6})</span>円
</td>
({/if})

</tr>
({/if})
({if $room_data.k_price3})
<tr>
<td bgcolor=#CDCDCD>
({$room_data.k_capa_low3}) 人 ～ ({$room_data.k_capa_high3}) 人 まで
</td>
<td width=80>
({$room_data.k_price3})円
</td>

({if $room_data.k_price3_discount.1})
<td>
パターン1: <span style="color: #FF0000;">({$room_data.k_price3_discount.1})</span>円
</td>
({/if})
({if $room_data.k_price3_discount.2})
<td>
パターン2: <span style="color: #FF0000;">({$room_data.k_price3_discount.2})</span>円
</td>
({/if})
({if $room_data.k_price3_discount.3})
<td>
パターン3: <span style="color: #FF0000;">({$room_data.k_price3_discount.3})</span>円
</td>
({/if})
({if $room_data.k_price3_discount.4})
<td>
パターン4: <span style="color: #FF0000;">({$room_data.k_price3_discount.4})</span>円
</td>
({/if})
({if $room_data.k_price3_discount.5})
<td>
パターン5: <span style="color: #FF0000;">({$room_data.k_price3_discount.5})</span>円
</td>
({/if})
({if $room_data.k_price3_discount.6})
<td>
パターン6 <span style="color: #FF0000;">({$room_data.k_price3_discount.6})</span>円
</td>
({/if})

</tr>
({/if})
({if $room_data.k_highest_price})
<tr>
<td bgcolor=#CDCDCD>
({$room_data.k_capa_highest}) 人 以上
</td>
<td width=80>
({$room_data.k_highest_price})円
</td>

({if $room_data.k_highest_discount.1})
<td>
パターン1: <span style="color: #FF0000;">({$room_data.k_highest_discount.1})</span>円
</td>
({/if})
({if $room_data.k_highest_discount.2})
<td>
パターン2: <span style="color: #FF0000;">({$room_data.k_highest_discount.2})</span>円
</td>
({/if})
({if $room_data.k_highest_discount.3})
<td>
パターン3: <span style="color: #FF0000;">({$room_data.k_highest_discount.3})</span>円
</td>
({/if})
({if $room_data.k_highest_discount.4})
<td>
パターン4: <span style="color: #FF0000;">({$room_data.k_highest_discount.4})</span>円
</td>
({/if})
({if $room_data.k_highest_discount.5})
<td>
パターン5: <span style="color: #FF0000;">({$room_data.k_highest_discount.5})</span>円
</td>
({/if})
({if $room_data.k_highest_discount.6})
<td>
パターン6 <span style="color: #FF0000;">({$room_data.k_highest_discount.6})</span>円
</td>
({/if})

</tr>
({/if})
</table>
({/if})
<br><br>

<table>
<tr>
<td valign=top>


<form name="discount" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="do_({$hash_tbl->hash('add_room_discount','do')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
<input type="hidden" name="hall_id" value="({$hall_id})" />
<input type="hidden" name="room_id" value="({$room_id})" />
<input type="hidden" name="mode" value="0">
<table border=1>


({foreach from=$discount key=key item=item})
({if $item.num<4})
({if $item.num==1})
<tr>
<th colspan=8 height=30 bgcolor="#FE3568"><span style="color:#FFFFFF">【割引設定1】※日付・期間での割引設定</span>
</th>
</tr>
<tr>
<td bgcolor="#FFC6C0"><b>有効</b></td>
<td bgcolor="#FFC6C0"><b>パターンID</b></td>
<td bgcolor="#FFC6C0"><b>開始期間</b></td>
<td></td>
<td bgcolor="#FFC6C0"><b>終了期間</b></td>
<td bgcolor="#FFC6C0"><b>割引率</b></td>
<td></td>
</tr>
({/if})
<tr>
<td>
<input type="radio" name="pattern" value="({$key})" ({if $item.list.flag})checked({/if})>
</td>
<td>
パターン({$item.num})
</td>
<td>
<select name="begin_year({$item.num})">
<option value="">選択</option>
({foreach from=$year_list item=year})
<option value="({$year})" ({if $year==$item.list.begin_year})selected({/if})>({$year})</option>
({/foreach})
</select>
年
<select name="begin_month({$item.num})">
({foreach from=$month_list item=month})
<option value="({$month})" ({if $month==$item.list.begin_month})selected({/if})>({$month})</option>
({/foreach})
</select>
月
<select name="begin_day({$item.num})">
({foreach from=$day_list item=day})
<option value="({$day})" ({if $day==$item.list.begin_day})selected({/if})>({$day})</option>
({/foreach})
</select>
日
</td>
<td width=40>
から
</td>
<td>
<select name="finish_year({$item.num})">
<option value="">選択</option>
({foreach from=$year_list item=year})
<option value="({$year})" ({if $year==$item.list.finish_year})selected({/if})>({$year})</option>
({/foreach})
</select>
年
<select name="finish_month({$item.num})">
({foreach from=$month_list item=month})
<option value="({$month})" ({if $month==$item.list.finish_month})selected({/if})>({$month})</option>
({/foreach})
</select>
月
<select name="finish_day({$item.num})">
({foreach from=$day_list key=key item=day})
<option value="({$day})" ({if $day==$item.list.finish_day})selected({/if})>({$day})</option>
({/foreach})
</select>
日
</td>
<td>
<input type="text" name="percent({$item.num})" value="({$item.list.percent})" size=5>
</td>
<td width=40>
%割引
</td>
</tr>
({else})
({if $item.num==4})
<tr>
<th colspan=8 height=30 bgcolor="#FE3568"><span style="color:#FFFFFF">【割引設定2】※継続的な割引設定</span></th>
</tr>
<tr>
<td bgcolor="#FFC6C0"><b>有効</b></td>
<td bgcolor="#FFC6C0"><b>パターンID</b></td>
<td bgcolor="#FFC6C0"><b>対象 / 割引率</b></td>
</tr>
({/if})
<tr>
<td>
<input type="radio" name="pattern" value="({$key})" ({if $item.list.flag})checked({/if})>
</td>
<td>
パターン({$item.num})
</td>
<td>
<select name="continuance({$item.num})">
({foreach from=$continuance key=key item=continue})
<option value="({$key})" ({if $key==$item.list.continuance})selected({/if})>({$continue})</option>
({/foreach})
</select>
<input type="text" name="percent({$item.num})" value="({$item.list.percent})" size=5>
</td>
<td>
%割引
</td>
</tr>
({/if})
({/foreach})
<tr>
<td colspan=8>

<table>
<tr>
<td>
<input type="submit" value="　割　引　登　録　">
</form>
</td>
<td>
<form name="discount" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="do_({$hash_tbl->hash('add_room_discount','do')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
<input type="hidden" name="hall_id" value="({$hall_id})" />
<input type="hidden" name="room_id" value="({$room_id})" />
<input type="hidden" name="mode" value="1">
<input type="submit" value=" 設　定　解　除　">
</form>
</td>
</tr>
</table>

</td>
</tr>
</table>

</td>
<td valign=top>

({*** パック ***})

({if $room_data.type==1})

<form name="pack" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="do_({$hash_tbl->hash('add_room_pack','do')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
<input type="hidden" name="hall_id" value="({$hall_id})" />
<input type="hidden" name="room_id" value="({$room_id})" />

<table>
<tr>
({foreach from=$pack_list key=key item=item})
<td valign=top width=5></td>
<td>

<table border=1>
<tr>
<td colspan=2 height=30 bgcolor="#FE3568">
<input type="checkbox" name="pack_flag({$item.num})" value="1" ({if $item.data.pack_flag})checked({/if})>
<span style="color:#FFFFFF"><b>パック料金設定({$item.num})</b></span></td>
</tr>
<tr>
<td bgcolor="#FFC6C0"><b>名称</b></td>
<td><input type="text" name="pack_name({$item.num})" value="({$item.data.pack_name})" size=15></td>
</tr>
({if $room_data.type==1})
<tr>
<td bgcolor="#FFC6C0"><b>適用時間</b></td>
<td>
<select name="begin_time({$item.num})">
({foreach from=$open_time item=open})
<option value="({$open})" ({if $open==$item.data.begin_time})selected({/if})>({$open})時</option>
({/foreach})
</select>
～
<select name="finish_time({$item.num})">
({foreach from=$open_time item=open})
<option value="({$open})" ({if $open==$item.data.finish_time})selected({/if})>({$open})時</option>
({/foreach})
</select>
</td>
</tr>
({else})
<tr>
<td bgcolor="#FFC6C0"><b>連続コマ数</b></td>
<td>

<select name="koma({$item.num})">
({foreach from=$koma_list item=koma})
<option value="({$koma})" ({if $koma==$item.data.koma})selected({/if})>({$koma})</option>
({/foreach})
</select>
 コマ<br>
最低予約コマ数：({$room_data.lowest_koma})
</td>
</tr>
({/if})
<tr>
<td bgcolor="#FFC6C0"><b>Pack料金</b></td>
<td><input type="text" name="price({$item.num})" value="({$item.data.price})" size=10> ({if $room_data.type==1})円({else})%割引({/if})</td>
</tr>
</table>
</td>
({if $key%2==0})</tr><tr>({/if})
({/foreach})
</tr>
</table>

<input type="submit" value="　Pack 登　録　">
</form>

({/if})({***type***})

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
