({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminSiteMember.tpl"})
({assign var="page_name" value="仮予約一覧"})
({ext_include file="inc_tree_adminSiteMember.tpl"})
</div>

({*ここまで:navi*})

({*権限チェック*})
({if $atoffice_auth_type==2 or $atoffice_auth_type==4})

<script language="javascript">
<!--
function new_win(reserve_id){
window.open("./?m=admin&a=page_mail_check&reserve_id="+reserve_id,"","width=800, height=800, scrollbars=yes");
}
//-->
</script>


<h2 id="ttl01">仮予約一覧 (
({if $reserve_list})
	({$num})件中　({$index+1})件～
	({if $index+10 > $num})
		({$num})
	({else})
		({$index+10})
	({/if})
	件を表示
({else})
	0件
({/if})
)</h2>
<br>

<center>

<form name="search" method="POST" action="./">
<div id="blanket" style="display:none;"></div>
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('tmp_reserve_list','page')})" />

<table border=1 width=800>
<tr>
<td colspan=2 bgcolor=#CDCDCD>検索オプション</td>
</tr>
<tr>
<th bgcolor=#FFD9DC>会場選択</th><th bgcolor=#FFD9DC>操作</th>
</tr>
<tr>
<td>
<select name="hall_list">
<option value="0">すべての会場</option>
({foreach from=$hall_list item=item})
	<option value="({$item.hall_id})" ({if $item.hall_id == $hall_id})selected({/if})>({$item.hall_name})</option>
({/foreach})
</td>
<td>
<input type="submit" value="検索する">
</td>
</tr>
</table>

</form>


<br>
({foreach from=$page_list item=item})
({if $item.select})
	({$item.page})
({else})
	<a href="./?m=admin&a=page_tmp_reserve_list&hall_list=({$hall_id})&index=({$item.index})" >({$item.page})</a>
({/if})
|
({/foreach})
<hr>

({if $msg})<p class="actionMsg">({$msg})</p><br><br>({/if})

({foreach from=$reserve_list key=key item=item})
	<table border=1 width=800>
	<tr>
	<td colspan=4 bgcolor=#CC1111>
	<b><span style="color: #FFFFFF;">□　予約ID : ({$item.reserve_id})　□</span></b>
	</td>
	</tr>

	<tr>
	<td bgcolor=#FFD9DC width=100>
        <span style='margin:5px;'>予約日</span>
    </td>
	<td colspan=3>
        <span style='margin:5px;'>({$item.tmp_reserve_datetime})</span>
    </td>
	</tr>
    </
    >    
   	<tr>
	<td bgcolor=#FFD9DC>
        <span style='margin:5px;'>看板</span>
    </td>
	<td colspan="3" width=700>
        <span style='margin:5px;'>
	       ({$item.kanban})
	   </span>
    </td>
	</td>
	</tr>

	<tr>
	<td bgcolor=#FFD9DC><span style='margin:5px;'>予約者</span></td>
	<td width=300><span style='margin:5px;'>
		<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('c_member_detail')})&amp;target_c_member_id=({$item.c_member.c_member_id})">({$item.c_member.nickname})</a>
	</span>
    </td>
	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>企業・個人名</span></td>
	<td width=300><span style='margin:5px;'>({$item.corp})</span></td>
	</tr>

	<tr>
	<td bgcolor=#FFD9DC><span style='margin:5px;'>施設名</span></td>
	<td width=300><span style='margin:5px;'>({$item.hall_data.hall_name})</span></td>
	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>部屋名</span></td>
	<td width=300><span style='margin:5px;'>({$item.room_data.room_name})</span></td>
	</tr>

	<tr>
	<td bgcolor=#FFD9DC rowspan=2><span style='margin:5px;'>予約時間</span></td>
	<td rowspan=2>({$item.datetime})<br>({$item.begin_datetime}) ～ ({$item.finish_datetime})</td>
	<td bgcolor=#FFD9DC><span style='margin:5px;'>利用目的</span></td>
	<td><span style='margin:5px;'>

	({if $item.purpose==0})
		未選択
	({elseif $item.purpose==1})
		会議
	({elseif $item.purpose==2})
		セミナー
	({elseif $item.purpose==3})
		研修
	({elseif $item.purpose==4})
		面接・試験
	({elseif $item.purpose==5})
		懇談会・パーティ
	({elseif $item.purpose==6})
		その他
	({/if})

	</span></td>
	</tr>

	<tr>
	<td bgcolor=#FFD9DC><span style='margin:5px;'>利用人数</span></td>
	<td><span style='margin:5px;'>({$item.people}) 人</span></td>
	</tr>

	<tr>
	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>利用料金</span></td>
	<td colspan=3><span style='margin:5px;'>【部屋利用料：({$item.room_price})円】＋【備品利用料：({$item.vessel_price})円】＋【サービス利用料：({$item.service_price})円】＝【合計請求額：({$item.total_price})円】</span></td>
	</tr>

({if $item.reserve_v_list})
	<tr>
	<td bgcolor=#FFD9DC width=100 style='vertical-align:middle;'><span style='margin:5px;'>予約備品一覧</span></td>
	<td colspan=3><span style='margin:5px;'>

	<table style='border: 1px #000000 solid;' width=100%>
	<tr>
	<th style='border: 1px #000000 solid;' bgcolor=#EFEFEF>備品名</th>
	<th style='border: 1px #000000 solid;' bgcolor=#EFEFEF>予約時単価</th>
	<th style='border: 1px #000000 solid;' bgcolor=#EFEFEF>数量</th>
	<th style='border: 1px #000000 solid;' bgcolor=#EFEFEF>備品管理メモ</th>
	</tr>
	({foreach from=$item.reserve_v_list key=k item=i})
	<td style='border: 1px #000000 solid;'>({$i.vessel_name})</td>
	<td style='border: 1px #000000 solid;'>({$i.price})</td>
	<td style='border: 1px #000000 solid;'>({$i.num})</td>
	<td style='border: 1px #000000 solid;'>
	({$i.memo|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
	</td>
	</tr>
	({/foreach})
	</table>

	</span></td>
	</tr>
({/if})

({if $item.reserve_s_list})
	<tr>
	<td bgcolor=#FFD9DC width=100 style='vertical-align:middle;'><span style='margin:5px;'>予約ｻｰﾋﾞｽ一覧</span></td>
	<td colspan=3><span style='margin:5px;'>

	<table style='border: 1px #000000 solid;' width=100%>
	<tr>
	<th style='border: 1px #000000 solid;' bgcolor=#EFEFEF>サービス名</th>
	<th style='border: 1px #000000 solid;' bgcolor=#EFEFEF>予約時単価</th>
	<th style='border: 1px #000000 solid;' bgcolor=#EFEFEF>数量</th>
	<th style='border: 1px #000000 solid;' bgcolor=#EFEFEF>サービス管理メモ</th>
	</tr>
	({foreach from=$item.reserve_s_list key=k item=i})
	<td style='border: 1px #000000 solid;'>({$i.service_name})</td>
	<td style='border: 1px #000000 solid;'>({$i.price})</td>
	<td style='border: 1px #000000 solid;'>({$i.num})</td>
	<td style='border: 1px #000000 solid;'>
	({$i.memo|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
	</td>
	</tr>
	({/foreach})
	</table>

	</span></td>
	</tr>
({/if})

	<tr>
	<td bgcolor=#FFD9DC width=100 style='vertical-align:middle;'><span style='margin:5px;'>お客さま<br>メッセージ</span></td>
	<td colspan=3 align=left>
	({if $item.message})
		({$item.message|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
	({else})
		<center>--</center>
	({/if})
	</td>
	</tr>

	<tr>
	<td bgcolor=#FFD9DC width=100 style='vertical-align:middle;'><span style='margin:5px;'>社内メモ</span></td>
	<td colspan=3 align=left>
	({if $item.memo})
		({$item.memo|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
	({else})
		<center>--</center>
	({/if})
	</td>
	</tr>

	<tr>
	<td bgcolor=#FFD9DC width=100 style='vertical-align:middle;'><span style='margin:5px;'>修正/取消</span></td>
	<td>
<center>
<table>
<tr>
<td>
	<form name="reserve_revision({$key})" method="POST" action="./">
	<input type="hidden" name="m" value="({$module_name})" />
	<input type="hidden" name="a" value="page_({$hash_tbl->hash('reserve_revision','page')})" />
	<input type="hidden" name="reserve_id" value="({$item.reserve_id})" />
	<input type="submit" value="修正">
	</form>

</td><td> / </td><td>

({if $item.complete_flag})
    <span style="color:#FF0000"><b>完了済み、取り消し不可</b></span>
({else})
<script type="text/javascript">
function confirm({$key})(){
	if(window.confirm('予約を取り消しますか？【仮予約無料】')){
		return;
	}else{
		return false;
	}
}
function app({$key})(reserve_id){
	if(window.confirm('予約を承認しますか？')){
		new_win(reserve_id);
		return;
	}else{
		return false;
	}
}
function refusal({$key})(){
	if(window.confirm('予約を拒否しますか？')){
		return;
	}else{
		return false;
	}
}

</script>
	<form onSubmit="return confirm({$key})();" name="tmp_cancel({$key})" method="POST" action="./">
	<input type="hidden" name="m" value="({$module_name})" />
	<input type="hidden" name="a" value="do_({$hash_tbl->hash('tmp_cancel','do')})" />
	<input type="hidden" name="sessid" value="({$PHPSESSID})" />
	<input type="hidden" name="reserve_id" value="({$item.reserve_id})" />
	<input type="submit" value="取消">

	<input type="radio" name="mail_flag" value="1" checked>メールする
	<input type="radio" name="mail_flag" value="0">メールしない

	</form>
({/if})

</td>
</tr>
</table>
</center>
	</td>

	<td bgcolor=#FFD9DC width=100 style='vertical-align:middle;'><span style='margin:5px;'>承認</span></td>
	<td>
<center>
<table>
<tr>
<td>
	<form name="approval" onClick="Javascript:return app({$key})(({$item.reserve_id}));" method="POST" action="./">
	<input type="hidden" name="m" value="({$module_name})" />
	<input type="hidden" name="a" value="do_({$hash_tbl->hash('change_reserve_tmp','do')})" />
	<input type="hidden" name="sessid" value="({$PHPSESSID})" />
	<input type="hidden" name="reserve_id" value="({$item.reserve_id})" />
	<input type="hidden" name="hall_id" value="({$item.hall_data.hall_id})" />
	<input type="hidden" name="bank_flag" value="({$item.hall_data.bank_flag})" />
	<input type="hidden" name="c_member_id" value="({$item.c_member.c_member_id})" />
	<input type="hidden" name="room_id" value="({$item.room_data.room_id})" />
	<input type="hidden" name="hall_list" value="({$hall_id})" />
	<input type="hidden" name="index" value="({$index})" />

	<input type="hidden" name="approval({$item.reserve_id})" value="1"> 　
	<input type="submit" value="　承　認　">
	</form>
</td>
<td>
 / 
</td>
<td>
	<form onSubmit="return refusal({$key})();" name="approval2" method="POST" action="./">
	<input type="hidden" name="m" value="({$module_name})" />
	<input type="hidden" name="a" value="do_({$hash_tbl->hash('change_reserve_tmp','do')})" />
	<input type="hidden" name="sessid" value="({$PHPSESSID})" />
	<input type="hidden" name="reserve_id" value="({$item.reserve_id})" />
	<input type="hidden" name="hall_id" value="({$item.hall_data.hall_id})" />
	<input type="hidden" name="bank_flag" value="({$item.hall_data.bank_flag})" />
	<input type="hidden" name="c_member_id" value="({$item.c_member.c_member_id})" />
	<input type="hidden" name="room_id" value="({$item.room_data.room_id})" />
	<input type="hidden" name="hall_list" value="({$hall_id})" />
	<input type="hidden" name="index" value="({$index})" />
	<input type="hidden" name="approval({$item.reserve_id})" value="2"> 　
	<input type="submit" value="　拒　否　">
	</form>
</td>
</tr>
</table>
</center>
	</td>

	</tr>

	</table>
	<br>
({foreachelse})
該当するデータはありませんでした。
({/foreach})
<hr>
({foreach from=$page_list item=item})
({if $item.select})
	({$item.page})
({else})
	<a href="./?m=admin&a=page_tmp_reserve_list&hall_list=({$hall_id})&index=({$item.index})" >({$item.page})</a>
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
