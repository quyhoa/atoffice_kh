({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminImageKakikomi.tpl"})
({assign var="page_name" value="会場削除"})
({ext_include file="inc_tree_adminImageKakikomi.tpl"})
</div>

({*ここまで:navi*})

({*権限チェック*})
({if $atoffice_auth_type==1 or $atoffice_auth_type==4})

<h2 id="ttl01">会場削除</h2>
<br>

({if $msg})<p class="actionMsg">({$msg})</p>({/if})
<center>

<h3>削除対象のデータ一覧</h3><br>
部屋が設定されている場合は、関連する部屋の設定データも対象です。<br>
予約データが存在する場合は、関連する予約データも対象です。<br>
<br>
<table border=1 width=300>
<tr>
<td align=left>
対象会場名
</td>
<td>
({$hall_data.hall_name})
</td>
</tr>

<tr>
<td align=left>
設定部屋データ数
</td>
<td>
({$a_room})
</td>
</tr>

<tr>
<td align=left>
総予約データ数
</td>
<td>
({$a_reserve_list})
</td>
</tr>

<tr>
<td align=left>
設定備品数
</td>
<td>
({$a_vessel_data})
</td>
</tr>

<tr>
<td align=left>
設定サービス数
</td>
<td>
({$a_service_data})
</td>
</tr>

<tr>
<td align=left>
設定キャンセル料率数
</td>
<td>
({$cancel_charge})
</td>
</tr>

<tr>
<td align=left>
設定会場休日数
</td>
<td>
({$a_hall_holiday})
</td>
</tr>

<tr>
<td align=left>
設定会場定休日数
</td>
<td>
({$a_hall_regular_holiday})
</td>
</tr>

<tr>
<td align=left>
設定会場画像数
</td>
<td>
({$a_hall_image})
</td>
</tr>

<tr>
<td align=left>
設定会場貸し止め数
</td>
<td>
({$a_rental_stop})
</td>
</tr>

</table>
<br>
<form action="./" method="post">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="do_({$hash_tbl->hash('delete_hall_data','do')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
<input type="hidden" name="hall_id" value="({$hall_id})">
<input type="submit" value="削除する">
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
