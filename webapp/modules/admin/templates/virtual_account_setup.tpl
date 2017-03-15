({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminStatisticalInformation.tpl"})
({assign var="page_name" value="バーチャル口座設定"})
({ext_include file="inc_tree_adminStatisticalInformation.tpl"})
</div>

({*ここまで:navi*})

({*権限チェック*})
({if $atoffice_auth_type==4})

<h2 id="ttl01">バーチャル口座設定</h2>
<br>
<center>
({if $msg})<p class="actionMsg">({$msg})</p><br><br>({/if})



<table border=1>
<tr>
<th bgcolor=#cdcdcd><span style='margin:5px;'>銀行名</span></th>
<th bgcolor=#cdcdcd><span style='margin:5px;'>支店名</span></th>
<th bgcolor=#cdcdcd><span style='margin:5px;'>名義人</span></th>
<th bgcolor=#cdcdcd><span style='margin:5px;'>仮想支店番号</span></th>
<th bgcolor=#cdcdcd><span style='margin:5px;'>操作</span></th>
</tr>
({foreach from=$virtual_ac key=key item=item})
<tr>
<td>({$item.bank})</td>
<td>({$item.branch})</td>
<td>({$item.account})</td>
<td>({$item.branch_id})</td>
<td>
<form name="approval({$key})" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="do_({$hash_tbl->hash('delete_virtual_account_conf','do')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
<input type="hidden" name="branch_id" value="({$item.branch_id})">
<input type="submit" value="　削除　">

</form>
</td>
</tr>
({/foreach})
<tr>
<td>
<form name="approval" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="do_({$hash_tbl->hash('set_virtual_account','do')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
<span style='margin:5px;'>
<input type="text" name="bank" value="({$virtual_ac.bank})">
</span></td>
<td><span style='margin:5px;'>
<input type="text" name="branch" value="({$virtual_ac.branch})" size=25>
</span></td>
<td><span style='margin:5px;'>
<input type="text" name="account" value="({$virtual_ac.account})" size=25>
</span></td>
<td><span style='margin:5px;'>
3桁：<input type="text" name="branch_id" value="({$virtual_ac.branch_id})">
</span></td>
<td>
<input type="submit" value="　登録　">
</td>
</tr>
</table>
</form>
</center>
<br>

<br>
<h2 id="ttl01">ゲスト未使用固定口座解放</h2>
<br>
<center>
<table border=1 bgcolor=#DDFFFF>
<tr>
<td style="text-align:center;" width=600>
<form name="delete_gva_confirm" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('delete_gva_confirm','page')})" />
ゲスト顧客で、
<input type="text" name="delete_month" value="3" size=8 style="text-align:right;padding-right:5px;">
ヵ月以内に予約のなかった固定口座を解除する。<br>
<input type="submit" value="　確認画面へ　">
</form>
</td>
</tr>
</table>
</center>

<br>
<h2 id="ttl01">バーチャル口座利用状況一覧(
({if $kouza_list})
	({$num})件中　({$index+1})件～
	({if $index+100 > $num})
		({$num})
	({else})
		({$index+100})
	({/if})
	件を表示
({else})
	0件
({/if})
)</h2>
<br>
<center>
<span style="font-size:16px;">
<span style="color:#FFCC00;">■</span>
固定利用客用ID(<b>({$kotei})</b>件)</span>　
<span style="font-size:16px;">
<span style="color:#FF0000;">■</span>
利用中ID(<b>({$using})</b>件)</span>
<br><br>
({foreach from=$page_list item=item})
({if $item.select})
	({$item.page})
({else})
	<a href="./?m=admin&a=page_virtual_account_setup&index=({$item.index})" >({$item.page})</a>
({/if})
|
({/foreach})
<hr>

<table border=1>
<tr>
<th bgcolor=#cdcdcd>SEQ番号</th><th bgcolor=#cdcdcd>口座番号</th><th bgcolor=#cdcdcd>状態</th><th bgcolor=#cdcdcd>利用者</th>
<th bgcolor=#cdcdcd>SEQ番号</th><th bgcolor=#cdcdcd>口座番号</th><th bgcolor=#cdcdcd>状態</th><th bgcolor=#cdcdcd>利用者</th>
<th bgcolor=#cdcdcd>SEQ番号</th><th bgcolor=#cdcdcd>口座番号</th><th bgcolor=#cdcdcd>状態</th><th bgcolor=#cdcdcd>利用者</th>
<th bgcolor=#cdcdcd>SEQ番号</th><th bgcolor=#cdcdcd>口座番号</th><th bgcolor=#cdcdcd>状態</th><th bgcolor=#cdcdcd>利用者</th>
</tr>
<tr>
({foreach from=$kouza_list key=key item=item })
<td><span style='margin:5px;'>
({$item.seq_number})
</span></td>
<td><span style='margin:5px;'>
({if $item.nickname})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('reserve_view')})&amp;virtual_number=({$item.virtual_number})">({$item.virtual_number})</a>
({else})
({$item.virtual_number})
({/if})
</span></td>
<td width=15 style='border: 1px #000000 solid;' ({if $item.flag})bgcolor=#FF0000({elseif $item.kotei})bgcolor=#FFCC00({else})bgcolor=#CCFFCC({/if})></td>
<td width=100><span style='margin:5px;'>
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('c_member_detail')})&amp;target_c_member_id=({$item.c_member_id})">({$item.nickname})</a>
</span></td>


({if $key%4==3})
</tr><tr>
({/if})
({/foreach})
</tr>
</table>
<hr>
({foreach from=$page_list item=item})
({if $item.select})
	({$item.page})
({else})
	<a href="./?m=admin&a=page_virtual_account_setup&index=({$item.index})" >({$item.page})</a>
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
