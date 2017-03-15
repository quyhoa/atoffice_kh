({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminSiteMember.tpl"})
({assign var="page_name" value="備品修正"})
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

　<a href="./?m=admin&a=page_reserve_revision&reserve_id=({$reserve_data.reserve_id})">予約修正</a>｜<a href="./?m=admin&a=page_service_revision&reserve_id=({$reserve_data.reserve_id})">サービス修正</a>｜<br>
<br>
<h2 id="ttl01">備品修正</h2>
<br>
　※ 予約データの料金とは連動されませんので、備品修正後に予約修正にて、備品料金と請求金額を修正してください。<br>
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
<th>区分</th>
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
<td>({$i.vessel_name})</td>
<td>({$i.price})</td>
<td>
({if $i.num})
	({$i.num})
({else})
	--
({/if})
</td>
<td>
({if $i.charge_devision==1})
	予約毎
({else})
	時間毎
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
<th colspan=4 bgcolor=#FFFF55>修正前/現在のデータ （予約ID：({$reserve_data.reserve_id})）</th>
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
({if $vessel_list})
<table width=100% border=1>
<tr>
<th>選択</th>
<th>名称</th>
<th>価格</th>
<th>数量</th>
<th>区分</th>
<th>キャンセル</th>
</tr>

({foreach from=$vessel_list key=key item=item})
<tr>
<td>
({if $item.num>0})
✔
({else})
--
({/if})
</td>
<td>({$item.vessel_name})</td>
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
	予約毎
({else})
	時間毎
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
この部屋に登録されている備品はありません。
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
<input type="hidden" name="a" value="do_({$hash_tbl->hash('change_vessel','do')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
<input type="hidden" name="reserve_id" value="({$reserve_data.reserve_id})">
<input type="hidden" name="vessel_list_num" value="({$vessel_list_num})">

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
({if $vessel_list})
<table width=100% border=1>
<tr>
<th>選択</th>
<th>名称</th>
<th>価格</th>
<th>数量</th>
<th>区分</th>
<th>キャンセル</th>
</tr>

({foreach from=$vessel_list key=key item=item})
<tr>
<td>
({if $item.num>0})
✔
<input type="hidden" name="vessel_id({$key})" value="({$item.vessel_id})">
({else})
<input type="checkbox" name="vessel_id({$key})" value="({$item.vessel_id})">
({/if})
</td>
<td>({$item.vessel_name})</td>
<td>({$item.price})</td>
<td>
	<select name="num({$key})">
	({foreach from=$item.num_list item=v})
		<option value=({$v}) ({if $v==$item.num})selected({/if})>({$v})</option>
	({/foreach})
	</select>
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
