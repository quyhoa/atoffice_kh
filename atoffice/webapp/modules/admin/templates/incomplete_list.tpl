({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminDesign.tpl"})
({assign var="page_name" value="未完了報告リスト"})
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

<h2 id="ttl01">【({$hall_name})】未完了報告リスト (
({if $reserve_data})
	({$num})件中　({$index+1})件～
	({if $index+10 > $num})
		({$num})
	({else})
		({$index+10})
	({/if})
	件を表示
({else})
	0件
({/if})
)</h2>
<br>
<center>
({if $msg})<p class="actionMsg">({$msg})</p><br><br>({/if})

<br><br>

({if $atoffice_auth_type==2 or $atoffice_auth_type==4})
	<form name="change_hall_id" method="POST" action="./">
	<input type="hidden" name="m" value="({$module_name})" />
	<input type="hidden" name="a" value="page_({$hash_tbl->hash('incomplete_list','page')})" />
	<select name="hall_list">
	({foreach from=$hall_list item=item})
		<option value="({$item.hall_id})" ({if $item.hall_id==$hall_id})selected({/if})>({$item.hall_name})</option>
	({/foreach})
	</select>
	<input type="submit" value="　決定　">
	</form>
	<br>
({/if})
({if $atoffice_auth_type==3})
	<form name="change_hall_id" method="POST" action="./">
	<input type="hidden" name="m" value="({$module_name})" />
	<input type="hidden" name="a" value="page_({$hash_tbl->hash('incomplete_list','page')})" />
	<select name="hall_list">
			({foreach from=$hall_list item=label key=key})			
				({foreach from=$label item=item})
					<option value="({$item.hall_id})" ({if $item.hall_id==$hall_id})selected({/if})>({$item.hall_name})</option>
				({/foreach})
			({/foreach})
		</select>
	<input type="submit" value="　決定　">
	</form>
	<br>
({/if})
({foreach from=$page_list item=item})
({if $item.select})
	({$item.page})
({else})
	<a href="./?m=admin&a=page_incomplete_list&hall_list=({$hall_id})&index=({$item.index})" >({$item.page})</a>
({/if})
|
({/foreach})
<hr>
<br>
({foreach from=$reserve_data item=item})

<table width=700>

<tr>
<th colspan=4 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FF6666>予約情報</th>
</tr>
<tr>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD>予約ID</td>
<td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'>({$item.reserve_id})</td>
<td width=100 rowspan=2 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD>利用日</td>
<td rowspan=2 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'>({$item.begin_datetime})<br>～<br>({$item.finish_datetime})</td>
</tr>
<tr>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD>予約状態</td>
<td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'>({if $item.tmp_flag==1})
	仮予約
({elseif $item.pay_flag==0 and $pay_money==0})
	未入金
({elseif $item.pay_flag==0 and $pay_money>0})
	一部入金
({elseif $item.pay_flag==1})
	入金済み
({else})
	???
({/if})

</td>
</tr>

<tr>
<th colspan=4 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FF6666>申込者情報</th>
</tr>
<tr>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD>登録番号</td>
<td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'>({$item.c_member_data.c_member_id})</td>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD>({*メールアドレス*})</td>
<td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'>({*({$item.mail})*})
</td>
</tr>

({*
<tr>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD>利用者名</td>
<td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'>({$item.c_member_data.nickname})</td>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD>利用者名（カナ）</td>
<td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'>({$item.kana})</td>
</tr>
*})
<tr>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD>法人・個人名</td>
<td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'>({$item.corp})</td>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD>部署名</td>
<td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'>({if $busho})
	({$item.busho})
({else})
	-- --
({/if})
</td>
</tr>
({*
<tr>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD>電話番号</td>
<td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'>({$item.tel})</td>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD>FAX番号</td>
<td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'>({if $fax})
	({$item.fax})
({else})
	-- --
({/if})
</td>
</tr>
*})
</table>
<form method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="reporter" value="({$reporter})" />
<input type="hidden" name="page" value="incomplete_list" />
<input type="hidden" name="reserve_id" value="({$item.reserve_id})" />
<input type="hidden" name="tail" value="hall_list=({$hall_id})&index=({$index})" />
<input type="hidden" name="a" value="do_({$hash_tbl->hash('add_report','do')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />

<table width=700>
<tr>
<th colspan=2 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FF6666>完了報告</th>
</tr>
<tr>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD>報告担当者</td>
<td style='border: 1px #000000 solid;text-align: left;vertical-align:middle;'>
<span style="margin:5px">({$name})</span>
</td>
</tr>

<tr>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD>チェック事項</td>
<td style='border: 1px #000000 solid;text-align: left;vertical-align:middle;'>

<table>
<tr>
<td>①原状復帰されたか？</td>
<td>
<input type="radio" name="original_state" value="0" checked> はい
<input type="radio" name="original_state" value="1"> いいえ
</td>
<td></td>
</tr>
<tr>
<td>②貸出備品は回収したか？</td>
<td>
<input type="radio" name="vessel_collect" value="0" checked> はい
<input type="radio" name="vessel_collect" value="1"> いいえ
</td>
<td></td>
</tr>
<tr>
<td>③利用者はごみを持ち帰ったか？</td>
<td>
<input type="radio" name="garbage" value="0" checked> はい
<input type="radio" name="garbage" value="1"> いいえ
</td>
<td></td>
</tr>
<tr>
<td>④室内の汚れ、破損はないか？</td>
<td>
<input type="radio" name="room_check" value="0" checked> はい
<input type="radio" name="room_check" value="1"> いいえ
</td>
<td>
<span style="margin:5px">報告：<input type="text" name="room_check_info" size=30></span>
</td>
</tr>
<tr>
<td>⑤忘れ物はないか？</td>
<td>
<input type="radio" name="thing_left" value="0" checked> はい
<input type="radio" name="thing_left" value="1"> いいえ
</td>
<td>
<span style="margin:5px">報告：<input type="text" name="thing_left_info" size=30></span>
</td>
</tr>
</table>

</td>
</tr>

<tr>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD>ブラックリスト<br>追加依頼</td>
<td style='border: 1px #000000 solid;text-align: left;vertical-align:middle;'>
<input type="radio" name="blacklist_request" value="1"> 追加依頼
<input type="radio" name="blacklist_request" value="0" checked> なし
<span style="margin:5px">理由：<input type="text" name="blacklist_request_info" size=60></span>
</td>
</tr>

<tr>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD>その他問題事項</td>
<td style='border: 1px #000000 solid;text-align: left;vertical-align:middle;'>
<textarea id="mce_editor_textarea" name="report" rows="({$_rows|default:'6'})" cols="({$_cols|default:'70'})">({$post_data.agreement})</textarea>
</td>
</tr>

<tr>
<td colspan=2 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'>
<input type="submit" value="　報　告　">
</td>
</tr>
</table>
</form>
<br>


({foreachelse})
未報告な予約データはありません。
({/foreach})

<br>
<hr>
({foreach from=$page_list item=item})
({if $item.select})
	({$item.page})
({else})
	<a href="./?m=admin&a=page_incomplete_list&hall_list=({$hall_id})&index=({$item.index})" >({$item.page})</a>
({/if})
|
({/foreach})
<br>

</center>

({else})
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
({/if})
<div>
({$inc_footer|smarty:nodefaults})
