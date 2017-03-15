({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminDesign.tpl"})
({assign var="page_name" value="完了報告"})
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

<h2 id="ttl01">完了報告</h2>
<br>
<center>
({if $msg})<p class="actionMsg">({$msg})</p><br><br>({/if})

<br><br>

<table width=700>
<tr>
<th colspan=4 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FF6666>申込者情報</th>
</tr>
<tr>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD>登録番号</td>
<td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'>({$c_member_data.c_member_id})</td>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD>({*メールアドレス*})</td>
<td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'>({*({$mail})*})
</td>
</tr>

({*
<tr>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD>利用者名</td>
<td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'>({$c_member_data.nickname})</td>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD>利用者名（カナ）</td>
<td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'>({$kana})</td>
</tr>
*})
<tr>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD>法人・個人名</td>
<td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'>({$corp})</td>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD>部署名</td>
<td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'>({if $busho})
	({$busho})
({else})
	-- --
({/if})
</td>
</tr>

<tr>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD>電話番号</td>
<td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'>({$tel})</td>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD>FAX番号</td>
<td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'>({if $fax})
	({$fax})
({else})
	-- --
({/if})
</td>
</tr>
</table>

<br>

<form method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="reporter" value="({$reporter})" />
<input type="hidden" name="page" value="today_reservation" />
<input type="hidden" name="reserve_id" value="({$reserve_data.reserve_id})" />
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

</center>

({else})
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
({/if})
<div>
({$inc_footer|smarty:nodefaults})
