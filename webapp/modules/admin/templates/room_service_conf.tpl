({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminImageKakikomi.tpl"})
({assign var="page_name" value="部屋別サービス設定"})
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


<h2 id="ttl01">部屋別サービス設定【({$hall_name})】【({$room_name})】</h2>
<br>
<div align=right>
<form name="add_room" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('room_list','page')})" />
<input type="hidden" name="hall_id" value="({$hall_id})">
<input type="submit" value="部屋一覧へ戻る">
</form>
</div>
<br>
<center>
({if $msg})<p class="actionMsg">({$msg})</p><br><br>({/if})

<br><br>
※ 公開中のサービスのみ表示されます。
<br><br>

({if $service_list})


<form name="room_service" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="do_({$hash_tbl->hash('add_room_service','do')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
<input type="hidden" name="hall_id" value="({$hall_id})" />
<input type="hidden" name="room_id" value="({$room_id})" />

<table border=1>
<tr>
<th bgcolor=#FF9900>選択</th>
<th bgcolor=#FF9900>サービス品ID</th>
<th height=30 bgcolor=#FF9900>サービス名</th>
<th bgcolor=#FF9900>最低予約数</th>
<th bgcolor=#FF9900>利用料金</th>
<th bgcolor=#FF9900>キャンセル料</th>
<th bgcolor=#FF9900>状態</th>
<th bgcolor=#FF9900>メモ１</th>
<th bgcolor=#FF9900>メモ２</th>


</tr>
({foreach from=$service_list key=key item=item})
<tr>
<td align=center ({if $key%2==0})bgcolor=#FFD9DC({else})bgcolor=#FFFFCC({/if})><span style="margin:5px">

<input type="checkbox" name="service_id[]" value="({$item.service_id})" 
({if $item.checked})checked({/if})>

</td>
<td align=left ({if $key%2==0})bgcolor=#FFD9DC({else})bgcolor=#FFFFCC({/if})><span style="margin:5px">({$item.service_id})</span></td>
<td align=left ({if $key%2==0})bgcolor=#FFD9DC({else})bgcolor=#FFFFCC({/if})><span style="margin:5px">({$item.service_name})</span></td>
<td align=center ({if $key%2==0})bgcolor=#FFD9DC({else})bgcolor=#FFFFCC({/if})>({$item.minimum_orders})</td>
<td align=right ({if $key%2==0})bgcolor=#FFD9DC({else})bgcolor=#FFFFCC({/if})><span style="margin:5px">({$item.price})円</span></td>
<td align=center ({if $key%2==0})bgcolor=#FFD9DC({else})bgcolor=#FFFFCC({/if})>
({if $item.cancel_mode==2})
<span style="color: #009900;"><b>含まない</b></span>
({else})
<span style="color: #3300FF;"><b>含む</b></span>
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
</tr>
({/foreach})
<tr>
<td colspan=8 align=center>

<input type="submit" value="　更　新　">

</td>
</tr>

</table>
</form>
({else})
<span style="font-size: 16pt;color: #FF3300;"><b>この会場のサービスはまだ登録されていません。<b></span>
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
