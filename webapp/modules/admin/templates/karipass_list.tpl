({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminStatisticalInformation.tpl"})
({assign var="page_name" value="仮パスリスト"})
({ext_include file="inc_tree_adminStatisticalInformation.tpl"})
</div>

({*ここまで:navi*})

({*権限チェック*})
({if $atoffice_auth_type==4})

<h2 id="ttl01">仮パスリスト (
({if $data})
	({$num})件
({else})
	0件
({/if})

)</h2>
<br>
<center>

({if $msg})<p class="actionMsg">({$msg})</p><br><br>({/if})



<br>

<br>
パスワードが <b>"karipass123"</b> の顧客を表示します。<br><br>

({if $data})

<table width=800 border=1>
<tr>
	<td bgcolor=#CC1111><b><span style="color: #FFFFFF;margin:5px;">顧客ID</span></b></td>
	<td bgcolor=#CC1111><b><span style="color: #FFFFFF;margin:5px;">顧客名</span></b></td>
	<td bgcolor=#CC1111><b><span style="color: #FFFFFF;margin:5px;">法人/団体名</span></b></td>
	<td bgcolor=#CC1111><b><span style="color: #FFFFFF;margin:5px;">メールアドレス</span></b></td>
</tr>

({foreach from=$data item=item})

	<tr>
		<td>
			<span style="margin:5px;">
				({$item.c_member_id})
			</span>
		</td>
		<td>
			<span style="margin:5px;">
				<a href="./?m=admin&a=page_c_member_detail&target_c_member_id=({$item.c_member_id})">
				({$item.c_member.nickname})
				</a>
			</span>
		</td>
		<td>
			<span style="margin:5px;">
				({$item.corp})
			</span>
		</td>
		<td>
			<span style="margin:5px;">
				<a href="mailto:({$item.mail})">
				({$item.mail})
				</a>
			</span>
		</td>
	</tr>

({/foreach})

</table>

({else})
該当するデータはありませんでした。<br>
({/if})

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
