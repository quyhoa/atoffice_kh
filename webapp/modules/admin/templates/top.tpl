({$inc_header|smarty:nodefaults})
<div class="subNavi"></div>
</div>

({*ここまで:navi*})


({if $msg})
<p class="actionMsg">({$msg})</p>
({/if})

<br>
<table width=100%>
<tr>
<td width="10"></td>
<td>
<span style="font-size: 16px;"><span style="color: #336600;"><b>({$name})</b></span> さん、お疲れ様です。<br>
<br>
あなたのアクセス権限は、
<span style="color: #FF0000;"><b>
({if $atoffice_auth_type=="1"})
	初期設定担当者
({elseif $atoffice_auth_type=="2"})
	予約受付担当者
({elseif $atoffice_auth_type=="3"})
	準備担当者
({elseif $atoffice_auth_type=="4"})
	管理者
({else})
	不明な権限
({/if})
</b></span>
です。<br>

({if $atoffice_auth_type=="1"})

({elseif $atoffice_auth_type=="2"})

({elseif $atoffice_auth_type=="3"})

担当会場は、<b> ({$hall_name}) </b>です。

({elseif $atoffice_auth_type=="4"})

<br>
<hr>
<br>
<center>
<span style="color: #FF0000;font-size:30px"><b>アラート</b></span><br>
<br>
<table width=800 border=1>
<tr>
<td width=450 align=left>仮予約の承認待ち（２営業日以上経過数）</td>
<td align=right>({$tmp_alert}) 件</td>
</tr>

<tr>
<td width=450 align=left>返金処理待ち件数</td>
<td align=right>({$repay_alert}) 件</td>
</tr>

<tr>
<td width=450 align=left>バーチャル口座利用数（利用数/総数）</td>
<td align=right>({$kotei_vn}) / ({$all_vn}) 件</td>
</tr>

<tr>
<td width=450 align=left>完了報告漏れ数</td>
<td align=right>
({foreach from=$comp_alert item=item})
({$item.hall_name}) : ({$item.alert_num}) 件<br>
({foreachelse})
0 件
({/foreach})

</td>
</tr>

<tr>
<td width=450 align=left>予約入金予定日超過件数</td>
<td align=right>
({foreach from=$unpayment_alert item=item})
({$item.hall_name}) : ({$item.alert_num}) 件<br>
({foreachelse})
0 件
({/foreach})

</td>
</tr>

<tr>
<td width=450 align=left>ブラックリスト登録申請待ち</td>
<td align=right>({$blist_alert}) 件</td>
</tr>

</table>
</center>

({else})

({/if})

</span>

</td>
<td align=right valign=top>
({*********
({if $atoffice_auth_type=="1"})
<form>
<input type="button" value="　初期設定担当者用・操作ヘルプ　" onClick="window.open('./help/initial/index.php','','scrollbars=yes,width=350,height=400,');"/>
</form>
({elseif $atoffice_auth_type=="2"})
<form>
<input type="button" value="　予約担当者用・操作ヘルプ　" onClick="window.open('./help/reserve/index.php','','scrollbars=yes,width=350,height=400,');"/>
</form>
({elseif $atoffice_auth_type=="3"})
<form>
<input type="button" value="　準備担当者用・操作ヘルプ　" onClick="window.open('./help/preparation/index.php','','scrollbars=yes,width=350,height=400,');"/>
</form>
({elseif $atoffice_auth_type=="4"})
<form>
<input type="button" value="　管理者用・操作ヘルプ　" onClick="window.open('./help/admin/index.php','','scrollbars=yes,width=350,height=400,');"/>
</form>
({else})
	不明な権限
({/if})
**********})

</td>
</tr>
</table>

<div class="contents">
({***
({ext_include file="inc_dashboard.tpl"})
***})


({$inc_footer|smarty:nodefaults})
