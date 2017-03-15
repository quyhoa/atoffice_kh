({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminImageKakikomi.tpl"})
({assign var="page_name" value="会場一覧"})
({ext_include file="inc_tree_adminImageKakikomi.tpl"})
</div>

({*ここまで:navi*})

({*権限チェック*})
({if $atoffice_auth_type==1 or $atoffice_auth_type==4})

<h2 id="ttl01">会場一覧(
({if $hall_list})
	({$num})件中　({$index+1})件～
	({if $index+50 > $num})
		({$num})
	({else})
		({$index+50})
	({/if})
	件を表示
({else})
	0件
({/if})
)</h2>
<br>

({if $msg})<p class="actionMsg">({$msg})</p>({/if})
<center>

<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('hall_list','page')})" />

<table border=1 width=800>
<tr>
<td colspan=4 bgcolor=#CDCDCD>検索オプション</td>
</tr>
<tr>
<th bgcolor=#FFD9DC>運営状態</th>
<th bgcolor=#FFD9DC>属性</th>
<th bgcolor=#FFD9DC>場所</th>
<td rowspan=2 bgcolor=#FFD9DC>
<input type="submit" value="検索する">
</td>
</tr>
<tr>
<td>
<input type="radio" name="flag" value="0" 
({if $flag==0})checked({/if})>すべて
<input type="radio" name="flag" value="1" 
({if $flag==1})checked({/if})>運営中
<input type="radio" name="flag" value="2" 
({if $flag==2})checked({/if})>メンテ中
<input type="radio" name="flag" value="3" 
({if $flag==3})checked({/if})>停止中
</td>
<td>
<input type="radio" name="attribute" value="0" 
({if $attribute==0})checked({/if})>すべて
<input type="radio" name="attribute" value="1" 
({if $attribute==1})checked({/if})>AO管理
<input type="radio" name="attribute" value="2" 
({if $attribute==2})checked({/if})>シェア
</td>
<td>
<select name="prefecture">
<option value="0">全国</option>
({foreach from=$profile_list.options item=item})
		<option value="({$item.c_profile_option_id})" ({if $item.c_profile_option_id==$prefecture})selected({/if})>({$item.value|default:"--"})</option>
({/foreach})
</td>
</tr>
</table>

</form>
<br>
({foreach from=$page_list item=item})
({if $item.select})
	({$item.page})
({else})
	<a href="./?m=admin&a=page_hall_list&flag=({$flag})&attribute=({$attribute})&prefecture=({$prefecture})&index=({$item.index})" >({$item.page})</a>
({/if})
|
({/foreach})
<hr>


<table border=1 cellpadding="5" cellspacing="5">
<tr>
<th bgcolor=#CCFFCC>会場番号</th>
<th bgcolor=#CCFFCC>会場名</th>
<th bgcolor=#CCFFCC width=100>属性</th>
<th bgcolor=#CCFFCC width=80>運営状態</th>
<th bgcolor=#CCFFCC>会場編集</th>
<th bgcolor=#CCFFCC>部屋設定</th>
<th bgcolor=#CCFFCC>画像設定</th>
<th bgcolor=#CCFFCC width=100>休日設定</th>
<th bgcolor=#CCFFCC>備品設定</th>
<th bgcolor=#CCFFCC>サービス設定</th>
<th bgcolor=#CCFFCC>口座設定</th>
<th bgcolor=#CCFFCC>キャンセル料率<br>パターン設定</th>
({*<th bgcolor=#CCFFCC>プレビュー</th>*})
<th bgcolor=#CCFFCC>削除</th>
</tr>
({foreach from=$hall_list item=item})
<tr>
<td bgcolor=#DCDCDC>
<b>({$item.hall_id})</b>
</td>
<td bgcolor=#DCDCDC>
<b>({$item.hall_name})</b>
</td>
({if $item.hall_attribute==0})
<td bgcolor=#FFCCFF align=center>
AO管理会議室
</td>
({else})
<td bgcolor=#FFFF99 align=center>
シェア会議室
({/if})
</td>
({if $item.flag==0})
<td bgcolor=#66CC33 align=center>
<b>運営中
({elseif $item.flag==1})
<td bgcolor=#FFCC66 align=center>
<b>ﾒﾝﾃﾅﾝｽ中
({else})
<td bgcolor=#FF3300 align=center>
<b>停止中
({/if})
</b>
<br>
<form name="hall_conf" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('hall_status','page')})" />
<input type="hidden" name="hall_id" value="({$item.hall_id})" />
<input type="submit" value="変　更">
</form>
</td>
<td align=center>
({*** 会場編集 ***})
<form name="hall_conf" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('add_hall','page')})" />
<input type="hidden" name="hall_id" value="({$item.hall_id})" />
<input type="submit" value="編　集">
</form>
</td>
<td align=center>
({*** 部屋設定 ***})
({$item.config_rooms}) / ({$item.rooms})<br>
<form name="bank" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('room_list','page')})" />
<input type="hidden" name="hall_id" value="({$item.hall_id})" />
<input type="submit" value="設　定">
</form>
</td>
<td align=center>
({*** 画像設定 ***})
({if $item.image})
({$item.image})枚
({else})
<span style="color: #FF0000;"><b>未設定</b></span>
({/if})
<form name="bank" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('hall_image','page')})" />
<input type="hidden" name="hall_id" value="({$item.hall_id})" />
<input type="submit" value="設　定">
</form>
</td>
<td align=center>
({*** 休日設定  ***})
({if $item.holiday})
休日あり
({else})
<span style="color: #FF0000;"><b>毎日営業</b></span>
({/if})
<form name="bank" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('hall_holiday_conf','page')})" />
<input type="hidden" name="hall_id" value="({$item.hall_id})" />
<input type="submit" value="設　定">
</form>
</td>
<td align=center>
({*** 備品設定  ***})
登録数:({$item.vessel})
<form name="bank" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('vessel_list','page')})" />
<input type="hidden" name="hall_id" value="({$item.hall_id})" />
<input type="submit" value="設　定">
</form>
</td>
<td align=center>
({*** サービス設定 ***})
登録数:({$item.service})
<form name="bank" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('service_list','page')})" />
<input type="hidden" name="hall_id" value="({$item.hall_id})" />
<input type="submit" value="設　定">
</form>
</td>
<td align=center>
({*** 口座設定 ***})
({if $item.bank_flag})
({if $item.bank})
<form name="bank" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('bank_config','page')})" />
<input type="hidden" name="hall_id" value="({$item.hall_id})" />
<input type="submit" value="編　集">
</form>
({else})
<form name="bank" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('bank_config','page')})" />
<input type="hidden" name="hall_id" value="({$item.hall_id})" />
<input type="submit" style="color:#FF0000" value="未設定">
</form>
({/if})
({else})
バーチャル
({/if})
</td>
<td align=center>
({if $item.cancel})
<form name="cancel" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('cancel_config','page')})" />
<input type="hidden" name="hall_id" value="({$item.hall_id})" />
<input type="submit" value="編　集">
</form>
({else})
<form name="cancel" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('cancel_config','page')})" />
<input type="hidden" name="hall_id" value="({$item.hall_id})" />
<input type="submit" style="color:#FF0000" value="未設定">
</form>
({/if})
</td>
({* プレビュー
<td align=center>

<form name="preview" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('hall_preview','page')})" />
<input type="hidden" name="hall_id" value="({$item.hall_id})" />
<input type="submit" value="確認">
</form>
</td>
*})
<td align=center>
<form name="preview" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('hall_delete','page')})" />
<input type="hidden" name="hall_id" value="({$item.hall_id})" />
<input type="submit" value="削除">
</form>
</td>

</tr>
({/foreach})
</table>

<hr>
({foreach from=$page_list item=item})
({if $item.select})
	({$item.page})
({else})
	<a href="./?m=admin&a=page_hall_list&flag=({$flag})&attribute=({$attribute})&prefecture=({$prefecture})&index=({$item.index})" >({$item.page})</a>
({/if})
|
({/foreach})


</center>
({else})
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
({/if})
<div>
({$inc_footer|smarty:nodefaults})
