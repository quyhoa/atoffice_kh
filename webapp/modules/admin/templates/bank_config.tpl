({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminImageKakikomi.tpl"})
({assign var="page_name" value="銀行口座設定"})
({ext_include file="inc_tree_adminImageKakikomi.tpl"})
</div>

({*ここまで:navi*})

({*権限チェック*})
({if $atoffice_auth_type==1 or $atoffice_auth_type==4})


<h2 id="ttl01">銀行口座設定【({$hall_name})】</h2>
<br>
<center>
({if $msg})<p class="actionMsg">({$msg})</p>({/if})

<br><br>
<form name="add_bank_data" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="do_({$hash_tbl->hash('add_bank_data','do')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
<input type="hidden" name="hall_id" value="({$hall_id})" />
<table border=1 width=740 >
<tr>
<td bgcolor="#FFCCCC"><b>銀行名</b></td>
<td>
<input type="text" name="bank" value="({$bank_data.bank_name})" size="30">
</td>
<td bgcolor="#FFCCCC"><b>支店名</b></td>
<td>
<input type="text" name="branch" value="({$bank_data.branch})" size="30">
</td>
</tr>
<tr>
<td bgcolor="#FFCCCC"><b>口座種別</b></td>
<td><select name="account_type">
<option value="0" ({if $bank_data.account_type==0})selected({/if})>
　普通　</option>
<option value="1" ({if $bank_data.account_type==1})selected({/if})>
　当座　</option>
</select></td>
<td bgcolor="#FFCCCC"><b>口座番号</b></td>
<td>
<input type="text" name="account_number" value="({$bank_data.account_number})" size="30">
</td>
</tr>
<tr>
<td bgcolor="#FFCCCC"><b>口座名義人</b></td>
<td colspan=3><input type="text" name="account_name" value="({$bank_data.account_name})" size="80"></td>
</tr>
<tr>
<td bgcolor="#FFCCCC"><b>口座名義人（全角カナ）</b></td>
<td colspan=3><input type="text" name="account_kana" value="({$bank_data.account_kana})" size="80"></td>
</tr>
</table>
<br>
<input type="submit" value="　登　録　">
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
