({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminImageKakikomi.tpl"})
({assign var="page_name" value="部屋登録（確認）"})
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


<h2 id="ttl01">部屋登録（確認）【({$hall_name})】【部屋({$room_id})】</h2>
<br>
<center>
({if $errors})
<table border=1 bgcolor=#000000 width=600>
<tr>
<td style="color:#FF0000">
<b>以下の入力項目にエラーがあります。修正してください。</b>
</td>
</tr>
({foreach from=$errors item=item})
	<tr><td style="color:#FFFF00">
	・ ({$item})
	</td></tr>
({/foreach})
</table>
({else})
<span style="font-size: 16pt;">
({$hall_name})の部屋({$room_id})データを以下の内容で登録します。よろしいですか？</span>
({/if})

<br><br>


<table border=1 width=700>
<tr>
<th height=30 bgcolor=#FFFFCC><b>コマ設定タイプ</b></th>
</tr>
<tr>
<td align=center>
	({if $post_data.type==1})
	<span style="color: #FF0000;"><b>時間指定（池袋タイプ）</b></span>
	({elseif $post_data.type==2})
	<span style="color: #FF0000;"><b>時間当たり（神田タイプ）</b></span>
	({/if})
</td>
</tr>
</table>
<br>
<br>

<table border=1>
<tr>
<th colspan=4 align=center width=700 height=30 
({if $post_data.type==1})
bgcolor=#F0FFF0>基本設定　-時間指定（池袋タイプ）-
({elseif $post_data.type==2})
bgcolor=#DCDCFF>基本設定　-時間当たり（神田タイプ）-
({/if})
</th>
</tr>
<tr>
<td bgcolor=#F0F0F0 width=150 align=left><b><span style="margin:5px">部屋名称</span></b></td>
<td colspan=3 align=left>
({if $post_data.type==1})
<span style="color: #FF0000;"><b>　({$post_data.room_name1})</b></span>
({elseif $post_data.type==2})
<span style="color: #FF0000;"><b>　({$post_data.room_name2})</b></span>
({/if})
</td>
</tr>
<tr>
<td bgcolor=#F0F0F0 align=left><b><span style="margin:5px">収容人数</span></b></td>
<td colspan=3>
<table>
<td width=170>
スクール：
({if $post_data.type==1})
<span style="color: #FF0000;"><b>({$post_data.num_school1})</b></span>
({elseif $post_data.type==2})
<span style="color: #FF0000;"><b>({$post_data.num_school2})</b></span>
({/if})
人
</td>
<td width=170>
口の字：
({if $post_data.type==1})
<span style="color: #FF0000;"><b>({$post_data.num_mouth1})</b></span>
({elseif $post_data.type==2})
<span style="color: #FF0000;"><b>({$post_data.num_mouth2})</b></span>
({/if})
人
</td>
<td width=170>
シアター：
({if $post_data.type==1})
<span style="color: #FF0000;"><b>({$post_data.num_theater1})</b></span>
({elseif $post_data.type==2})
<span style="color: #FF0000;"><b>({$post_data.num_theater2})</b></span>
({/if})
人
</td>
</table>
</td>
</tr>
<tr>
<td bgcolor=#F0F0F0 width=150 align=left><b><span style="margin:5px">利用可能属性</span></b></td>
<td colspan=3>

<table>
<td width=80>
({if ($post_data.type==1 and $post_data.corp1==1) or ($post_data.type==2 and $post_data.corp2==1)})
 <span style="color: #FF0000;"><b>○</b></span>
({else})
 <span style="color: #FF0000;"><b>×</b></span>
({/if})法人
</td>
<td>
({if ($post_data.type==1 and $post_data.individual1==1) or ($post_data.type==2 and $post_data.individual2==1)})
 <span style="color: #FF0000;"><b>○</b></span>
({else})
 <span style="color: #FF0000;"><b>×</b></span>
({/if})個人
</td>

</table>

</td>
</tr>
<tr>
<td bgcolor=#F0F0F0 width=150 align=left><b><span style="margin:5px">利用可能用途</span></b></td>
<td colspan=3>

<table>
<td width=60>
({if ($post_data.type==1 and $post_data.conference1==1) or ($post_data.type==2 and $post_data.conference2==1)})
 <span style="color: #FF0000;"><b>○</b></span>
({else})
 <span style="color: #FF0000;"><b>×</b></span>
({/if})会議
</td>
<td width=70>
({if ($post_data.type==1 and $post_data.seminar1==1) or ($post_data.type==2 and $post_data.seminar2==1)})
 <span style="color: #FF0000;"><b>○</b></span>
({else})
 <span style="color: #FF0000;"><b>×</b></span>
({/if})セミナー
</td>
<td width=60>
({if ($post_data.type==1 and $post_data.training1==1) or ($post_data.type==2 and $post_data.training2==1)})
 <span style="color: #FF0000;"><b>○</b></span>
({else})
 <span style="color: #FF0000;"><b>×</b></span>
({/if})研修
</td>
<td width=100>
({if ($post_data.type==1 and $post_data.interview1==1) or ($post_data.type==2 and $post_data.interview2==1)})
 <span style="color: #FF0000;"><b>○</b></span>
({else})
 <span style="color: #FF0000;"><b>×</b></span>
({/if})面接・試験
</td>
<td width=130>
({if ($post_data.type==1 and $post_data.party1==1) or ($post_data.type==2 and $post_data.party2==1)})
 <span style="color: #FF0000;"><b>○</b></span>
({else})
 <span style="color: #FF0000;"><b>×</b></span>
({/if})懇談会・パーティ
</td>
<td>
({if ($post_data.type==1 and $post_data.etc1==1) or ($post_data.type==2 and $post_data.etc2==1)})
 <span style="color: #FF0000;"><b>○</b></span>
({else})
 <span style="color: #FF0000;"><b>×</b></span>
({/if})その他
</td>
</table>
</td>
</tr>
<tr>
({if $post_data.type==1})
<th colspan=4 align=center width=700 height=30 bgcolor=#F0FFF0>コマ設定　※ この会場の運営時間は、({$begin})時～({$finish})時です。</th>
</tr>
<tr>
<td align=center bgcolor=#FE3568><span style="color: #FFFFFF;"><b>コマ</b></span></td>
<td align=center bgcolor=#FE3568><span style="color: #FFFFFF;"><b>開始時間～終了時間</b></span></td>
<td align=center bgcolor=#FE3568><span style="color: #FFFFFF;"><b>料金（税込）</b></span></td>
</tr>
({foreach from=$koma_list item=item})
({if $item.begin_time!=""})
<tr>
<td align=center bgcolor=#FFC6C0><b>({$item.num})コマ目</b></td>
<td align=center>
<span style="color: #FF0000;"><b>({$item.begin_time})</b></span> 時　～　
<span style="color: #FF0000;"><b>({$item.finish_time})</b></span> 時
</td>
<td align=center bgcolor=#FFD9DC>
<span style="color: #FF0000;"><b>({$item.price})</b></span> 円
</td>
</tr>
({/if})
({/foreach})


</table>

({elseif $post_data.type==2})

<th colspan=4 align=center width=700 height=30 bgcolor=#DCDCFF>コマ設定　※ この会場の運営時間は、({$begin})時～({$finish})時です。</th>
</tr>
<tr>
<td bgcolor=#FFC6C0 width=200 align=left><b><span style="margin:5px">1コマあたりの時間単位</span></b></td>
<td width=70 align=center>
({if $post_data.koma<1})
<span style="color: #FF0000;"><b>
({if $post_data.koma==0.25})
15
({else})
30
({/if})
</b></span>分
({else})
<span style="color: #FF0000;"><b>({$post_data.koma})</b></span>時間
({/if})
<td bgcolor=#FFC6C0 width=150 align=left><b><span style="margin:5px">最低予約コマ数</span><b></td>
<td>
　<span style="color: #FF0000;"><b>({$post_data.lowest_koma})</b></span>
 コマから予約可能
</td>
</tr>
({if $post_data.k_capa_lowest or $post_data.k_lowest_price})
<tr>
<td bgcolor=#FFC6C0 width=150 align=left><b><span style="margin:5px">1コマあたりの値段１</span></b></td>
<td colspan=3 align=left>
<span style="margin:5px">
<span style="color: #FF0000;"><b>({$post_data.k_capa_lowest})</b></span> 人　まで　
<span style="color: #FF0000;"><b>({$post_data.k_lowest_price})</b></span> 円（税込）
</span>
</td>
</tr>
({/if})
({if $post_data.k_capa_low2 or $post_data.k_capa_high2 or $post_data.k_price2})
<tr>
<td bgcolor=#FFC6C0 width=150 align=left><b><span style="margin:5px">1コマあたりの値段２</span></b></td>
<td colspan=3 align=left>
<span style="margin:5px">
<span style="color: #FF0000;"><b>({$post_data.k_capa_low2})</b></span> 人　～　
<span style="color: #FF0000;"><b>({$post_data.k_capa_high2})</b></span> 人　まで　
<span style="color: #FF0000;"><b>({$post_data.k_price2})</b></span> 円（税込）
</span>
</td>
</tr>
({/if})

({if $post_data.k_capa_low3 or $post_data.k_capa_high3 or $post_data.k_price3})
<tr>
<td bgcolor=#FFC6C0 width=150 align=left><b><span style="margin:5px">1コマあたりの値段３</span></b></td>
<td colspan=3 align=left>
<span style="margin:5px">
<span style="color: #FF0000;"><b>({$post_data.k_capa_low3})</b></span> 人　～　
<span style="color: #FF0000;"><b>({$post_data.k_capa_high3})</b></span> 人　まで　
<span style="color: #FF0000;"><b>({$post_data.k_price3})</b></span> 円（税込）
</span>
</td>
</tr>
({/if})

({if $post_data.k_capa_highest or $post_data.k_highest_price})
<tr>
<td bgcolor=#FFC6C0 width=150 align=left><b><span style="margin:5px">1コマあたりの値段４</span></b></td>
<td colspan=3 align=left>
<span style="margin:5px">
<span style="color: #FF0000;"><b>({$post_data.k_capa_highest})</b></span> 人　以上　
<span style="color: #FF0000;"><b>({$post_data.k_highest_price})</b></span> 円（税込）
</span>
</td>
</tr>
({/if})

</table>

({/if})


<br>
<hr width=800>
<br>
<table width=700>
<td>
<span style="font-size: 15pt;color: #FF3300;"><b>【キャンセル料率パターン】</b></span><br>
<br>

<table>

<tr>
<td>

</td><td width=100>
<span style="color: #FF0000;"><b>
パターン({$post_data.cancel})： 
</b></span>
</td><td>
({if $cancel_charge.percent1})
<span style="color: #FF0000;"><b>({$cancel_charge.day1})日前まで ({$cancel_charge.percent1})％</b></span></td><td>
({/if})
({if $cancel_charge.percent2})
<span style="color: #FF0000;"><b> ／ ({$cancel_charge.day2})日前まで ({$cancel_charge.percent2})％</b></span></td><td>
({/if})
({if $cancel_charge.percent3})
<span style="color: #FF0000;"><b> ／ ({$cancel_charge.day3})日前まで ({$cancel_charge.percent3})％</b></span></td><td>
({/if})
({if $cancel_charge.percent4})
<span style="color: #FF0000;"><b> ／ ({$cancel_charge.day4})日前まで ({$cancel_charge.percent4})％</b></span></td><td>
({/if})
({if $cancel_charge.percent5})
<span style="color: #FF0000;"><b> ／ ({$cancel_charge.day5})日前まで ({$cancel_charge.percent5})％</b></span>
({/if})

</td></tr>

</table>


</td>
</table>
<br>
<hr width=800>
<br>

<table>
<td width=100>

({if !$errors})

<form name="add_room" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="do_({$hash_tbl->hash('add_room_data','do')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
<input type="hidden" name="hall_id" value="({$hall_id})">
<input type="hidden" name="room_id" value="({$room_id})">


({if $post_data.type==1})

<input type="hidden" name="type" value=1>
<input type="hidden" name="room_name" value="({$post_data.room_name1})">
<input type="hidden" name="num_school" value="({$post_data.num_school1})">
<input type="hidden" name="num_mouth" value="({$post_data.num_mouth1})">
<input type="hidden" name="num_theater" value="({$post_data.num_theater1})">
({if $post_data.corp1==1})
<input type="hidden" name="corp" value="1">
({/if})
({if $post_data.individual1==1})
<input type="hidden" name="individual" value="1">
({/if})
({if $post_data.conference1==1})
<input type="hidden" name="conference" value="1">
({/if})
({if $post_data.seminar1==1})
<input type="hidden" name="seminar" value="1">
({/if})
({if $post_data.training1==1})
<input type="hidden" name="training" value="1">
({/if})
({if $post_data.interview1==1})
<input type="hidden" name="interview" value="1">
({/if})
({if $post_data.party1==1})
<input type="hidden" name="party" value="1">
({/if})
({if $post_data.etc1==1})
<input type="hidden" name="etc" value="1">
({/if})

({foreach from=$koma_list item=item})
<input type="hidden" name="begin_time({$item.num})" value="({$item.begin_time})">
<input type="hidden" name="finish_time({$item.num})" value="({$item.finish_time})">
<input type="hidden" name="price({$item.num})" value="({$item.price})">
({/foreach})

({elseif $post_data.type==2})

<input type="hidden" name="type" value=2>
<input type="hidden" name="room_name" value="({$post_data.room_name2})">
<input type="hidden" name="num_school" value="({$post_data.num_school2})">
<input type="hidden" name="num_mouth" value="({$post_data.num_mouth2})">
<input type="hidden" name="num_theater" value="({$post_data.num_theater2})">
({if $post_data.corp2==1})
<input type="hidden" name="corp" value="1">
({/if})
({if $post_data.individual2==1})
<input type="hidden" name="individual" value="1">
({/if})
({if $post_data.conference2==1})
<input type="hidden" name="conference" value="1">
({/if})
({if $post_data.seminar2==1})
<input type="hidden" name="seminar" value="1">
({/if})
({if $post_data.training2==1})
<input type="hidden" name="training" value="1">
({/if})
({if $post_data.interview2==1})
<input type="hidden" name="interview" value="1">
({/if})
({if $post_data.party2==1})
<input type="hidden" name="party" value="1">
({/if})
({if $post_data.etc2==1})
<input type="hidden" name="etc" value="1">
({/if})

<input type="hidden" name="koma" value="({$post_data.koma})">

<input type="hidden" name="k_capa_lowest" value="({$post_data.k_capa_lowest})">
<input type="hidden" name="k_lowest_price" value="({$post_data.k_lowest_price})">

<input type="hidden" name="k_capa_low2" value="({$post_data.k_capa_low2})">
<input type="hidden" name="k_capa_high2" value="({$post_data.k_capa_high2})">
<input type="hidden" name="k_price2" value="({$post_data.k_price2})">

<input type="hidden" name="k_capa_low3" value="({$post_data.k_capa_low3})">
<input type="hidden" name="k_capa_high3" value="({$post_data.k_capa_high3})">
<input type="hidden" name="k_price3" value="({$post_data.k_price3})">

<input type="hidden" name="k_capa_highest" value="({$post_data.k_capa_highest})">
<input type="hidden" name="k_highest_price" value="({$post_data.k_highest_price})">

<input type="hidden" name="lowest_koma" value="({$post_data.lowest_koma})">


({/if})


<input type="hidden" name="cancel" value="({$post_data.cancel})">


<input type="submit" value="　登　録　">
</form>

({/if})

</td>
<td>
<form name="add_room" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('add_room','page')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
<input type="hidden" name="hall_id" value="({$hall_id})">
<input type="hidden" name="room_id" value="({$room_id})">


({if $post_data.type==1})

<input type="hidden" name="type" value=1>
<input type="hidden" name="room_name1" value="({$post_data.room_name1})">
<input type="hidden" name="num_school1" value="({$post_data.num_school1})">
<input type="hidden" name="num_mouth1" value="({$post_data.num_mouth1})">
<input type="hidden" name="num_theater1" value="({$post_data.num_theater1})">
({if $post_data.corp1==1})
<input type="hidden" name="corp1" value="1">
({/if})
({if $post_data.individual1==1})
<input type="hidden" name="individual1" value="1">
({/if})
({if $post_data.conference1==1})
<input type="hidden" name="conference1" value="1">
({/if})
({if $post_data.seminar1==1})
<input type="hidden" name="seminar1" value="1">
({/if})
({if $post_data.training1==1})
<input type="hidden" name="training1" value="1">
({/if})
({if $post_data.interview1==1})
<input type="hidden" name="interview1" value="1">
({/if})
({if $post_data.party1==1})
<input type="hidden" name="party1" value="1">
({/if})
({if $post_data.etc1==1})
<input type="hidden" name="etc1" value="1">
({/if})

({foreach from=$koma_list item=item})
<input type="hidden" name="begin_time({$item.num})" value="({$item.begin_time})">
<input type="hidden" name="finish_time({$item.num})" value="({$item.finish_time})">
<input type="hidden" name="price({$item.num})" value="({$item.price})">
({/foreach})

({elseif $post_data.type==2})

<input type="hidden" name="type" value=2>
<input type="hidden" name="room_name2" value="({$post_data.room_name2})">
<input type="hidden" name="num_school2" value="({$post_data.num_school2})">
<input type="hidden" name="num_mouth2" value="({$post_data.num_mouth2})">
<input type="hidden" name="num_theater2" value="({$post_data.num_theater2})">
({if $post_data.corp2==1})
<input type="hidden" name="corp2" value="1">
({/if})
({if $post_data.individual2==1})
<input type="hidden" name="individual2" value="1">
({/if})
({if $post_data.conference2==1})
<input type="hidden" name="conference2" value="1">
({/if})
({if $post_data.seminar2==1})
<input type="hidden" name="seminar2" value="1">
({/if})
({if $post_data.training2==1})
<input type="hidden" name="training2" value="1">
({/if})
({if $post_data.interview2==1})
<input type="hidden" name="interview2" value="1">
({/if})
({if $post_data.party2==1})
<input type="hidden" name="party2" value="1">
({/if})
({if $post_data.etc2==1})
<input type="hidden" name="etc2" value="1">
({/if})

<input type="hidden" name="koma" value="({$post_data.koma})">

<input type="hidden" name="k_capa_lowest" value="({$post_data.k_capa_lowest})">
<input type="hidden" name="k_lowest_price" value="({$post_data.k_lowest_price})">

<input type="hidden" name="k_capa_low2" value="({$post_data.k_capa_low2})">
<input type="hidden" name="k_capa_high2" value="({$post_data.k_capa_high2})">
<input type="hidden" name="k_price2" value="({$post_data.k_price2})">

<input type="hidden" name="k_capa_low3" value="({$post_data.k_capa_low3})">
<input type="hidden" name="k_capa_high3" value="({$post_data.k_capa_high3})">
<input type="hidden" name="k_price3" value="({$post_data.k_price3})">

<input type="hidden" name="k_capa_highest" value="({$post_data.k_capa_highest})">
<input type="hidden" name="k_highest_price" value="({$post_data.k_highest_price})">

<input type="hidden" name="lowest_koma" value="({$post_data.lowest_koma})">


({/if})


<input type="hidden" name="cancel" value="({$post_data.cancel})">
<input type="hidden" name="confrim" value="100">


<input type="submit" value="　修　正　">
</form>
</td>
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
