({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminStatisticalInformation.tpl"})
({assign var="page_name" value="ゲスト未使用固定口座解放"})
({ext_include file="inc_tree_adminStatisticalInformation.tpl"})
</div>

({*ここまで:navi*})

({*権限チェック*})
({if $atoffice_auth_type==4})

<h2 id="ttl01">ゲスト未使用固定口座解放</h2>
<br>
<center>
({if $msg})<p class="actionMsg">({$msg})</p><br><br>({/if})

<br>
<center>
<table border=1 bgcolor=#DDFFFF>
<tr>
<td style="text-align:center;" width=600>
<h2 id="ttl01">CSVダウンロード</h2>
<form name="delete_gva_csv" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="do_({$hash_tbl->hash('delete_gva_csv','do')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
<input type="hidden" name="delete_month" value="({$dm})">
<input type="({if $c_member|@count>0})submit({else})button({/if})" value="　ダウンロード　">
</form>
</td>
</tr>
</table>
</center>

<br>


({$dm})ヵ月以内に利用していないゲストで、固定口座を持っている顧客<br>

<table width=700 border=1>
<tr>
<th bgcolor=#CDCDCD>顧客名</th>
<th bgcolor=#CDCDCD>法人/団体名</th>
<th bgcolor=#CDCDCD>最終仮予約登録日</th>
<th bgcolor=#CDCDCD>バーチャル口座番号</th>
</tr>
({foreach from=$c_member item=item})
<tr>
<td><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('c_member_detail')})&amp;target_c_member_id=({$item.c_member_id})">({$item.nickname})</a></td>
<td>({$item.corp})</td>
<td>({$item.tmp_reserve_datetime})</td>
<td>({$item.virtual_number})</td>
</tr>
({/foreach})
</table>
<br>
<form name="delete_gva" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="do_({$hash_tbl->hash('delete_gva','do')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
<input type="hidden" name="delete_month" value="({$dm})">
<input type="submit" value="　解放する　">
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
