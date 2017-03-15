({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminStatisticalInformation.tpl"})
({assign var="page_name" value="バーチャル口座設定"})
({ext_include file="inc_tree_adminStatisticalInformation.tpl"})
</div>

({*ここまで:navi*})

({*権限チェック*})
({if $atoffice_auth_type==4})

<h2 id="ttl01">消費税率設定</h2>
<br>
<center>
({if $msg})<p class="actionMsg">({$msg})</p><br><br>({/if})

<form name="approval" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="do_({$hash_tbl->hash('consumption_tax_rate','do')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />

<!-- 2013.12.18 消費税率改定対応 begin -->

<table border=1>
	<tr align=center>
		<th>消費税率</th>
		<th>適用開始日</th>
	</tr>

({section name="row" start=0 loop=$rows step=1})
 	<tr>
		<td>
			<input type="text" name="rate({$smarty.section.row.index})"
				value="({$rate[$smarty.section.row.index]})"
				size=4 style='text-align:right;border-style:none;'>
			%&nbsp;
		</td>
		<td>
			<input type="text" name="stadate({$smarty.section.row.index})"
				value="({$stadate[$smarty.section.row.index]})"
				size=12 style='text-align:center;border-style:none;'>
		</td>
	</tr>
({/section})

</table>

<input type="hidden" name="rows" value="({$rows})">

<br>

<input type="submit" value="　　決　定　　">

<br>
<br>
消費税率を空白にした行は削除されます。
<br>

<!-- 2013.12.18 消費税率改定対応 end -->

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
