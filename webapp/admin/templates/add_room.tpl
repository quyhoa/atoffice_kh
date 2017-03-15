({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminImageKakikomi.tpl"})
({assign var="page_name" value="部屋登録"})
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
<script type="text/javascript">

function Sel(){
	var obj=document.forms['add_room'].elements['type'];
	if(obj[0].checked){
	document.getElementById('d1').style.display='block';
	document.getElementById('d2').style.display='none';
	}
	if(obj[1].checked){
	document.getElementById('d1').style.display='none';
	document.getElementById('d2').style.display='block';
	}
}

</script>


<h2 id="ttl01">部屋登録【({$hall_name})】【部屋({$room_id})】</h2>
<br>
<div align=right>
<form method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('room_list','page')})" />
<input type="hidden" name="hall_id" value="({$hall_id})">
<input type="submit" value="　部屋一覧へ戻る　">
</form>
</div>
<br>
<center>
({if $msg})<p class="actionMsg">({$msg})</p><br><br>({/if})

<br><br>

<form name="add_room" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('add_room_confrim','page')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
<input type="hidden" name="hall_id" value="({$hall_id})">
<input type="hidden" name="room_id" value="({$room_id})">


<table border=1 width=700>
<tr>
<th height=30 bgcolor=#FFFFCC><b>コマ設定タイプ</b></th>
</tr>
<tr>
<td align=center>
	<table>
	<td  width=300 height=20>
	<input type="radio" name="type" value="1" onclick="Sel()"
	({if $room_data.type==1})checked({/if})> 時間指定（池袋タイプ）
	</td>
	<td>
	<input type="radio" name="type" value="2" onclick="Sel()"
	({if $room_data.type==2})checked({/if})> 時間当たり（神田タイプ）
	</td>
	</table>


</td>
</tr>
</table>
<br>
<br>

<div id="d1" ({if $room_data.type==1})style="display:block;"({else})style="display:none;"({/if})>

<table border=1>
<tr>
<th colspan=3 align=center width=700 height=30 bgcolor=#F0FFF0>基本設定　-時間指定（池袋タイプ）-</th>
</tr>
<tr>
<td bgcolor=#F0F0F0 width=150><b>部屋名称</b></td>
<td colspan=2 align=left><input type="text" name="room_name1" value="({$room_data.room_name1})" size="30"></td>
</tr>
<tr>
<td bgcolor=#F0F0F0><b>収容人数</b></td>
<td colspan=2>
<table>
<td width=170>
スクール：<input type="text" name="num_school1" value="({$room_data.num_school1})" size="10">人
</td>
<td width=170>
口の字：<input type="text" name="num_mouth1" value="({$room_data.num_mouth1})" size="10">人
</td>
<td width=170>
シアター：<input type="text" name="num_theater1" value="({$room_data.num_theater1})" size="10">人
</td>
</table>
</td>
</tr>
<tr>
<td bgcolor=#F0F0F0 width=150><b>利用可能属性</b></td>
<td colspan=2>

<table>
<td width=80>
<input type="checkbox" name="corp1" value="1" ({if $room_data.corp1})checked({/if})> 法人
</td>
<td>
<input type="checkbox" name="individual1" value="1" ({if $room_data.individual1})checked({/if})> 個人
</td>

</table>

</td>
</tr>
<tr>
<td bgcolor=#F0F0F0 width=150><b>利用可能用途</b></td>
<td colspan=2>

<table>
<td width=60>
<input type="checkbox" name="conference1" value="1" ({if $room_data.conference1})checked({/if})> 会議
</td>
<td width=70>
<input type="checkbox" name="seminar1" value="1" ({if $room_data.seminar1})checked({/if})> セミナー
</td>
<td width=60>
<input type="checkbox" name="training1" value="1" ({if $room_data.training1})checked({/if})> 研修
</td>
<td width=100>
<input type="checkbox" name="interview1" value="1" ({if $room_data.interview1})checked({/if})> 面接・試験
</td>
<td width=130>
<input type="checkbox" name="party1" value="1" ({if $room_data.party1})checked({/if})> 懇談会・パーティ
</td>
<td>
<input type="checkbox" name="etc1" value="1" ({if $room_data.etc1})checked({/if})> その他
</td>
</table>
</td>
</tr>
<tr>
<th colspan=3 align=center width=700 height=30 bgcolor=#F0FFF0>コマ設定　※ この会場の運営時間は、({$begin})時～({$finish})時です。</th>
</tr>
<tr>
<td align=center bgcolor=#FE3568><span style="color: #FFFFFF;"><b>コマ</b></span></td>
<td align=center bgcolor=#FE3568><span style="color: #FFFFFF;"><b>開始時間～終了時間</b></span></td>
<td align=center bgcolor=#FE3568><span style="color: #FFFFFF;"><b>料金（税込）</b></span></td>
</tr>
({foreach from=$koma_list item=item})
<tr>
<td align=center bgcolor=#FFC6C0><b>({$item.num})コマ目</b></td>
<td align=center>
<input type="text" name="begin_time({$item.num})" value="({$item.begin_time})" size=10> 時　～　<input type="text" name="finish_time({$item.num})" value="({$item.finish_time})" size=10> 時
</td>
<td align=center bgcolor=#FFD9DC>
<input type="text" name="price({$item.num})" value="({$item.price})" size=15> 円
</td>
</tr>
({/foreach})


</table>

</div>

<div id="d2" ({if $room_data.type==2})style="display:block;"({else})style="display:none;"({/if})>


<table border=1>
<tr>
<th colspan=4 align=center width=700 height=30 bgcolor=#DCDCFF>基本設定　-時間当たり（神田タイプ）-</th>
</tr>
<tr>
<td bgcolor=#F0F0F0 width=150><b>部屋名称</b></td>
<td colspan=3 align=left><input type="text" name="room_name2" value="({$room_data.room_name2})" size="30"></td>
</tr>
<tr>
<td bgcolor=#F0F0F0><b>収容人数</b></td>
<td colspan=3>
<table>
<td width=170>
スクール：<input type="text" name="num_school2" value="({$room_data.num_school2})" size="10">人
</td>
<td width=170>
口の字：<input type="text" name="num_mouth2" value="({$room_data.num_mouth2})" size="10">人
</td>
<td width=170>
シアター：<input type="text" name="num_theater2" value="({$room_data.num_theater2})" size="10">人
</td>
</table>
</td>
</tr>
<tr>
<td bgcolor=#F0F0F0 width=150><b>利用可能属性</b></td>
<td colspan=3>

<table>
<td width=80>
<input type="checkbox" name="corp2" value="1" ({if $room_data.corp2})checked({/if})> 法人
</td>
<td>
<input type="checkbox" name="individual2" value="1" ({if $room_data.individual2})checked({/if})> 個人
</td>

</table>

</td>
</tr>
<tr>
<td bgcolor=#F0F0F0 width=150><b>利用可能用途</b></td>
<td colspan=3>

<table>
<td width=60>
<input type="checkbox" name="conference2" value="1" ({if $room_data.conference2})checked({/if})> 会議
</td>
<td width=70>
<input type="checkbox" name="seminar2" value="1" ({if $room_data.seminar2})checked({/if})> セミナー
</td>
<td width=60>
<input type="checkbox" name="training2" value="1" ({if $room_data.training2})checked({/if})> 研修
</td>
<td width=100>
<input type="checkbox" name="interview2" value="1" ({if $room_data.interview2})checked({/if})> 面接・試験
</td>
<td width=130>
<input type="checkbox" name="party2" value="1" ({if $room_data.party2})checked({/if})> 懇談会・パーティ
</td>
<td>
<input type="checkbox" name="etc2" value="1" ({if $room_data.etc2})checked({/if})> その他
</td>
</table>
</td>
</tr>
<tr>
<th colspan=4 align=center width=700 height=30 bgcolor=#DCDCFF>コマ設定　※ この会場の運営時間は、({$begin})時～({$finish})時です。</th>
</tr>
<tr>
<td bgcolor=#FFC6C0 width=150 align=center><b>1コマあたりの時間単位</b></td>
<td width=70>
<select name="koma">
<option value="0.25" ({if $room_data.koma==0.25})selected({/if})>　15分　</option>
<option value="0.5" ({if $room_data.koma==0.5})selected({/if})>　30分　</option>
<option value="1" ({if $room_data.koma==1})selected({/if})>　1時間　</option>
<option value="2" ({if $room_data.koma==2})selected({/if})>　2時間　</option>
<option value="3" ({if $room_data.koma==3})selected({/if})>　3時間　</option>
<option value="4" ({if $room_data.koma==4})selected({/if})>　4時間　</option>
<option value="5" ({if $room_data.koma==5})selected({/if})>　5時間　</option>
<option value="6" ({if $room_data.koma==6})selected({/if})>　6時間　</option>
</select>
</td>
<td bgcolor=#FFC6C0 width=150 align=center><b>最低予約コマ数<b></td>
<td>
<input type="text" name="lowest_koma" value="({$room_data.lowest_koma})"> コマから予約可能
</td>
</tr>
<tr>
<td bgcolor=#FFC6C0 width=150 align=center><b>1コマあたりの値段１</b></td>
<td colspan=3 align=left>
<input type="text" name="k_capa_lowest" value="({if $room_data.k_capa_lowest})({$room_data.k_capa_lowest})({/if})" size=10> 人　まで　
<input type="text" name="k_lowest_price" value="({if $room_data.k_lowest_price})({$room_data.k_lowest_price})({/if})" size=15> 円（税込）
</td>
</tr>
<tr>
<td bgcolor=#FFC6C0 width=150 align=center><b>1コマあたりの値段２</b></td>
<td colspan=3 align=left>
<input type="text" name="k_capa_low2" value="({if $room_data.k_capa_low2})({$room_data.k_capa_low2})({/if})" size=10> 人　～
<input type="text" name="k_capa_high2" value="({if $room_data.k_capa_high2})({$room_data.k_capa_high2})({/if})" size=10> 人　まで　
<input type="text" name="k_price2" value="({if $room_data.k_price2})({$room_data.k_price2})({/if})" size=15> 円（税込）
</td>
</tr>
<tr>
<td bgcolor=#FFC6C0 width=150 align=center><b>1コマあたりの値段３</b></td>
<td colspan=3 align=left>
<input type="text" name="k_capa_low3" value="({if $room_data.k_capa_low3})({$room_data.k_capa_low3})({/if})" size=10> 人　～
<input type="text" name="k_capa_high3" value="({if $room_data.k_capa_high3})({$room_data.k_capa_high3})({/if})" size=10> 人　まで　
<input type="text" name="k_price3" value="({if $room_data.k_price3})({$room_data.k_price3})({/if})" size=15> 円（税込）
</td>
</tr>
<tr>
<td bgcolor=#FFC6C0 width=150 align=center><b>1コマあたりの値段４</b></td>
<td colspan=3 align=left>
<input type="text" name="k_capa_highest" value="({if $room_data.k_capa_highest})({$room_data.k_capa_highest})({/if})" size=10> 人　以上　
<input type="text" name="k_highest_price" value="({if $room_data.k_highest_price})({$room_data.k_highest_price})({/if})" size=15> 円（税込）
</td>
</tr>

</table>

</div>


<br>
<hr width=800>
<br>
<table width=700>
<td>
<span style="font-size: 15pt;color: #FF3300;"><b>【キャンセル料率パターン】</b></span><br>
<br>
({if $cancel_charge})
<table>
({foreach from=$cancel_charge item=item})
<tr>
<td>
<input type="radio" name="cancel" value="({$item.pattern_id})" ({if $item.pattern_id == $room_data.cancel})checked({/if})>
</td><td width=80>
パターン({$item.pattern_id})： 
</td><td>
({if $item.percent1})
({$item.day1})日前まで ({$item.percent1})％</td><td>
({/if})
({if $item.percent2})
 ／ ({$item.day2})日前まで ({$item.percent2})％</td><td>
({/if})
({if $item.percent3})
 ／ ({$item.day3})日前まで ({$item.percent3})％</td><td>
({/if})
({if $item.percent4})
 ／ ({$item.day4})日前まで ({$item.percent4})％</td><td>
({/if})
({if $item.percent5})
 ／ ({$item.day5})日前まで ({$item.percent5})％
({/if})
</td></tr>
({/foreach})
</table>



({else})
会場のキャンセル料率パターンが設定されていません。<br>
先にキャンセル料率パターンを設定してください。<br>
<br>
</form>
<form name="cancel" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('cancel_config','page')})" />
<input type="hidden" name="hall_id" value="({$hall_id})" />
<input type="submit" style="color:#FF0000" value="　キャンセル料率パターン設定へ　">

({/if})
</td>
</table>
<br>
<hr width=800>
<br>
({if $cancel_charge})
<input type="submit" value="　確　認　">
({/if})

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
