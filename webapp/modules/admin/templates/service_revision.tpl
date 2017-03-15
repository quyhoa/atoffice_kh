({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminSiteMember.tpl"})
({assign var="page_name" value="サービス修正"})
({ext_include file="inc_tree_adminSiteMember.tpl"})
</div>

({*ここまで:navi*})

({*権限チェック*})
({if $atoffice_auth_type==2 or $atoffice_auth_type==4})

<style type="text/css">
<!--
HR {
	border-style:dotted;color:#3399FF

}
-->
</style>

<script type="text/javascript">
function confirm1(){
	if(window.confirm('【最終確認】\nもう一度データをよく確認して、よろしければOKを押してください。')){
		return;
	}else{
		return false;
	}
}
</script>

　<a href="./?m=admin&a=page_reserve_revision&reserve_id=({$reserve_data.reserve_id})">予約修正</a>｜<a href="./?m=admin&a=page_vessel_revision&reserve_id=({$reserve_data.reserve_id})">備品修正</a>｜<br>
<br>
<h2 id="ttl01">サービス修正</h2>
<br>
　※ 予約データの料金とは連動されませんので、サービス修正後に予約修正にて、サービス料金と請求金額を修正してください。<br>
<center>
({if $msg})<p class="actionMsg">({$msg})</p>({/if})

<br><br>

({foreach from=$log key=key item=item})
<table border=1 width=700>
<tr>
<th colspan=4 bgcolor=#CCCCFF>ログデータ({$key+1}) （予約ID：({$reserve_data.reserve_id})）<br>(変更日：({$item.change_datetime})変更者：({$item.staff_name}))</th>
</tr>

<tr>
<td colspan=4>
<table width=100% border=1>
<tr>
<th>選択</th>
<th>名称</th>
<th>価格</th>
<th>数量</th>
<th>キャンセル</th>
</tr>

({foreach from=$item.list key=k item=i})
<tr>
<td>
({if $i.num>0})
✔
({else})
--
({/if})
</td>
<td>({$i.service_name})</td>
<td>({$i.price})</td>
<td>
({if $i.num})
	({$i.num})
({else})
	--
({/if})
</td>
<td>
({if $i.num>0})
	({if $i.cancel_flag==1})
		キャンセル
	({else})
		未キャンセル
	({/if})
({else})
	-- --
({/if})
</td>
</tr>
({/foreach})
</table>

</td>
</tr>


</table>
<br>
<b>↓　↓　↓</b><br>
<br>
({/foreach})




<table border=1 width=700>
<tr>
<th colspan=4 bgcolor=#FFFF55>修正前データ （予約ID：({$reserve_data.reserve_id})）<br>※ 修正は上書きの為、旧データが表示されるのはここが最後です。</th>
</tr>
<tr>
<td width=100 bgcolor=#DEDEDE>顧客ID</td>
<td>({$c_member.c_member_id})</td>
<td width=100 bgcolor=#DEDEDE>氏名</td>
<td>
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('c_member_detail')})&amp;target_c_member_id=({$c_member.c_member_id})">({$c_member.nickname})</a>
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>会場名</td>
<td>({$reserve_data.hall_name})</td>
<td width=100 bgcolor=#DEDEDE>部屋名</td>
<td>
({$reserve_data.room_name})
</td>
</tr>

<tr>
<td colspan=4>
({if $service_list})
<table width=100% border=1>
<tr>
<th>選択</th>
<th>名称</th>
<th>価格</th>
<th>数量</th>
<th>キャンセル区分</th>
<th>キャンセル</th>
</tr>

({foreach from=$service_list key=key item=item})
<tr>
<td>
({if $item.num>0})
✔
({else})
--
({/if})
</td>
<td>({$item.service_name})</td>
<td>({$item.price})</td>
<td>
({if $item.num})
	({$item.num})
({else})
	--
({/if})
</td>
<td>
({if $item.charge_devision==1})
	含む
({else})
	含まない
({/if})
</td>
<td>
({if $item.num>0})
	({if $item.cancel_flag==1})
		キャンセル
	({else})
		未キャンセル
	({/if})
({else})
	-- --
({/if})
</td>
</tr>
({/foreach})
({else})
この部屋に登録されているサービスはありません。
({/if})
</table>

</td>
</tr>


</table>
<br>
<b>↓　↓　↓</b><br>
<br>

<form onSubmit="return confirm1();" name="do_change_reserve" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="do_({$hash_tbl->hash('change_service','do')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
<input type="hidden" name="reserve_id" value="({$reserve_data.reserve_id})">
<input type="hidden" name="service_list_num" value="({$service_list_num})">

<table border=1 width=700>
<tr>
<th colspan=4 bgcolor=#55FFFF>修正</th>
</tr>
<tr>
<td width=100 bgcolor=#DEDEDE>顧客ID</td>
<td>({$c_member.c_member_id})</td>
<td width=100 bgcolor=#DEDEDE>氏名</td>
<td>
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('c_member_detail')})&amp;target_c_member_id=({$c_member.c_member_id})">({$c_member.nickname})</a>
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>会場名</td>
<td>({$reserve_data.hall_name})</td>
<td width=100 bgcolor=#DEDEDE>部屋名</td>
<td>
({$reserve_data.room_name})
</td>
</tr>

<tr>
<td colspan=4>
({if $service_list})
<table width=100% border=1>
<tr>
<th>選択</th>
<th>名称</th>
<th>価格</th>
<th>数量</th>
<th>区分</th>
<th>キャンセル</th>
</tr>

({foreach from=$service_list key=key item=item})
<tr>
<td>
({if $item.num>0})
✔
<input type="hidden" name="service_id({$key})" value="({$item.service_id})">
({else})
<input type="checkbox" name="service_id({$key})" value="({$item.service_id})">
({/if})
</td>
<td>({$item.service_name})</td>
<td>({$item.price})</td>
<td>
({if $item.num})
	<input type="text" name="num({$key})" value="({$item.num})" size=3>
({else})
	<input type="text" name="num({$key})" value="({$item.minimum_orders})" size=3>
({/if})
最低予約数：({$item.minimum_orders})
</td>
<td>
({if $item.charge_devision==1})
	予約毎
({else})
	時間毎
({/if})
</td>
<td>
<input type="checkbox" name="cancel_flag({$key})" value="1" ({if $item.cancel_flag==1})checked({/if})>
</td>
</tr>
({/foreach})
</table>

</td>
</tr>

<tr>
<td colspan=4>
<input type="submit" value="　変　更　">
({else})
この部屋に登録されているサービスはありません。
({/if})
</td>
</tr>

</table>

</center>

({else})
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
({/if})
<div>
({$inc_footer|smarty:nodefaults})
