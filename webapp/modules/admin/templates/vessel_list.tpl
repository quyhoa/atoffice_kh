({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminImageKakikomi.tpl"})
({assign var="page_name" value="備品一覧"})
({ext_include file="inc_tree_adminImageKakikomi.tpl"})
</div>

({*ここまで:navi*})

({*権限チェック*})
({if $atoffice_auth_type==1 or $atoffice_auth_type==4})

<style type="text/css">
<!--
HR {
	border-style:dotted;color:#3399FF

}
-->
</style>


<h2 id="ttl01">備品一覧【({$hall_name})】</h2>
<br>
<center>
({if $msg})<p class="actionMsg">({$msg})</p><br><br>({/if})

<br><br>
<form name="add_vessel" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('add_vessel','page')})" />
<input type="hidden" name="hall_id" value="({$hall_id})" />
<input type="submit" value="　新規備品登録　">
</form>
<br>
({if $vessel_list})

<table border=1>
<tr>
<th bgcolor=#FF9900>備品ID</th>
<th height=30 bgcolor=#FF9900>備品名</th>
<th bgcolor=#FF9900>在庫数</th>
<th bgcolor=#FF9900>利用料金</th>
<th bgcolor=#FF9900>並び順値</th>
<th bgcolor=#FF9900>料金区分</th>
<th bgcolor=#FF9900>状態</th>
<th bgcolor=#FF9900>メモ１</th>
<th bgcolor=#FF9900>メモ２</th>
<th bgcolor=#FF9900>編集</th>
<th bgcolor=#FF9900>削除</th>
</tr>
({foreach from=$vessel_list key=key item=item})
<tr>
<td align=left ({if $key%2==0})bgcolor=#FFD9DC({else})bgcolor=#FFFFCC({/if})><span style="margin:5px">({$item.vessel_id})</span></td>
<td align=left ({if $key%2==0})bgcolor=#FFD9DC({else})bgcolor=#FFFFCC({/if})><span style="margin:5px">({$item.vessel_name})</span></td>
<td align=center ({if $key%2==0})bgcolor=#FFD9DC({else})bgcolor=#FFFFCC({/if})>({$item.num})</td>
<td align=right ({if $key%2==0})bgcolor=#FFD9DC({else})bgcolor=#FFFFCC({/if})><span style="margin:5px">({$item.price})円</span></td>
<td align=right ({if $key%2==0})bgcolor=#FFD9DC({else})bgcolor=#FFFFCC({/if})><span style="margin:5px">({$item.weight})</span></td>
<td align=center ({if $key%2==0})bgcolor=#FFD9DC({else})bgcolor=#FFFFCC({/if})>
({if $item.charge_devision==1})
<span style="color: #3300FF;"><b>予約毎</b></span>
({else})
<span style="color: #009900;"><b>時間毎</b></span>
({/if})
</td>
<td align=center ({if $key%2==0})bgcolor=#FFD9DC({else})bgcolor=#FFFFCC({/if})>
<span style="margin:5px">
({if $item.flag==1})
<span style="color: #FF0000;"><b>公開</b></span>
({else})
非公開
({/if})
</span>
</td>
<td align=left ({if $key%2==0})bgcolor=#FFD9DC({else})bgcolor=#FFFFCC({/if})>
({$item.memo1|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
</td>
<td align=left ({if $key%2==0})bgcolor=#FFD9DC({else})bgcolor=#FFFFCC({/if})>
({$item.memo2|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
</td>
<td valign=middle ({if $key%2==0})bgcolor=#FFD9DC({else})bgcolor=#FFFFCC({/if})>
<form name="change_vessel" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('add_vessel','page')})" />
<input type="hidden" name="hall_id" value="({$hall_id})" />
<input type="hidden" name="vessel_id" value="({$item.vessel_id})" />
<input type="hidden" name="delete_flag" value="1" />
<input type="submit" value="　編集　">
</form>

</td>
<td valign=middle ({if $key%2==0})bgcolor=#FFD9DC({else})bgcolor=#FFFFCC({/if})>
<form name="delete_vessel" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('add_vessel','page')})" />
<input type="hidden" name="hall_id" value="({$hall_id})" />
<input type="hidden" name="vessel_id" value="({$item.vessel_id})" />
<input type="hidden" name="delete_flag" value="2" />
<input type="submit" value="　削除　">
</form>

</td>
</tr>
({/foreach})
</table>

({else})
<span style="font-size: 16pt;color: #FF3300;"><b>この会場の備品はまだ登録されていません。<b></span>
({/if})

</center>

({else})
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
({/if})
<div>
({$inc_footer|smarty:nodefaults})
