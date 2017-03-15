({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminSiteMember.tpl"})
({assign var="page_name" value="予約修正"})
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

　<a href="./?m=admin&a=page_vessel_revision&reserve_id=({$reserve_data.reserve_id})">備品修正</a>｜<a href="./?m=admin&a=page_service_revision&reserve_id=({$reserve_data.reserve_id})">サービス修正</a>｜
({*****
<a href="./?m=admin&a=page_set_amount_billed&reserve_id=({$reserve_data.reserve_id})">請求金額設定</a>｜
*****})
<br>
<br>
<h2 id="ttl01">予約修正</h2>
<br>
<center>
({if $msg})<p class="actionMsg">({$msg})</p><br><br>({/if})

<br><br>

({foreach from=$log key=key item=item})

<table border=1 width=700>
<tr>
<th colspan=4 bgcolor=#CCCCFF>変更ログ({$key+1}) （予約ID：({$item.reserve_id})）<br>(変更日：({$item.change_datetime}) 変更者：({$item.staff_name}))</th>
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
<td>({$item.hall_name})</td>
<td width=100 bgcolor=#DEDEDE>部屋名</td>
<td>
({$item.room_name})
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>利用開始日時</td>
<td>({$item.begin_datetime})</td>
<td width=100 bgcolor=#DEDEDE>利用終了日時</td>
<td>
({$item.finish_datetime})
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>仮予約日</td>
<td>({$item.tmp_reserve_datetime})</td>
<td width=100 bgcolor=#DEDEDE>予約承認日</td>
<td>({$item.reserve_datetime})</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>仮予約フラグ</td>
<td>
({if $item.tmp_flag==1})
	仮予約
({else})
	予約承認済み
({/if})
</td>
<td width=100 bgcolor=#DEDEDE>キャンセルフラグ</td>
<td>
({if $item.cancel_flag==1})
	キャンセル済み
({else})
	未キャンセル
({/if})
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>予約変更フラグ</td>
<td>
({if $item.change_flag>0})
	変更済み
({else})
	未変更
({/if})
</td>
<td width=100 bgcolor=#DEDEDE>利用予定人数</td>
<td>
({$item.people})人
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>予約変更日</td>
<td>({$item.change_datetime})</td>
<td width=100 bgcolor=#DEDEDE>予約キャンセル日</td>
<td>({$item.cancel_datetime})</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>利用目的</td>
<td>
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
</td>
<td width=100 bgcolor=#DEDEDE>バーチャル口座</td>
<td>({$item.virtual_code})</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>入金期限日</td>
<td>({$item.pay_limitdate})</td>
<td width=100 bgcolor=#DEDEDE>最終入金日</td>
<td>({$item.pay_checkdate})</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>入金済みフラグ</td>
<td>
({if $item.pay_flag==1})
	入金済み
({else})
	未入金 or 一部入金
({/if})
</td>
<td width=100 bgcolor=#DEDEDE>入金済み金額</td>
<td>({$item.pay_money})円</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>完了フラグ</td>
<td>
({if $item.complete_flag==1})
	完了
({else})
	未完了
({/if})
</td>
<td width=100 bgcolor=#DEDEDE>看板</td>
<td align=left>
({$item.kanban|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>部屋利用料金</td>
<td>
({$item.room_price})円
</td>
<td width=100 bgcolor=#DEDEDE>備品利用料金</td>
<td>
({$item.vessel_price})円
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>サービス利用料金</td>
<td>
({$item.service_price})円
</td>
<td width=100 bgcolor=#DEDEDE>合計請求金額</td>
<td>
({$item.room_price+$item.vessel_price+$item.service_price})円
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>領収書印刷フラグ</td>
<td>
({if $item.receipt_flag==0})
未印刷
({else})
印刷済み
({/if})
</td>
<td width=100 bgcolor=#DEDEDE>領収書印刷日</td>
<td>
({$item.receipt_datetime})
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>請求番号</td>
<td colspan=3>

({$item.bill_id})
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>社内メモ</td>
<td colspan=3>
({$item.memo|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>お客様メッセージ</td>
<td colspan=3>
({$item.message|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
</td>
</tr>

</table>
<br>
<b>↓　↓　↓</b><br>
<br>
({/foreach})



<table border=1 width=700>
<tr>
<th colspan=4 bgcolor=#FFFF55>修正前/現在のデータ （予約ID：({$reserve_data.reserve_id})）<br>(最終変更日：({$reserve_data.change_datetime}))</th>
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
<td width=100 bgcolor=#DEDEDE>利用開始日時</td>
<td>({$reserve_data.begin_datetime})</td>
<td width=100 bgcolor=#DEDEDE>利用終了日時</td>
<td>
({$reserve_data.finish_datetime})
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>仮予約日</td>
<td>({$reserve_data.tmp_reserve_datetime})</td>
<td width=100 bgcolor=#DEDEDE>予約承認日</td>
<td>({$reserve_data.reserve_datetime})</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>仮予約フラグ</td>
<td>
({if $reserve_data.tmp_flag==1})
	仮予約
({else})
	予約承認済み
({/if})
</td>
<td width=100 bgcolor=#DEDEDE>キャンセルフラグ</td>
<td>
({if $reserve_data.cancel_flag==1})
	キャンセル済み
({else})
	未キャンセル
({/if})
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>予約変更フラグ</td>
<td>
({if $reserve_data.change_flag>0})
	変更済み
({else})
	未変更
({/if})
</td>
<td width=100 bgcolor=#DEDEDE>利用予定人数</td>
<td>
({$reserve_data.people})人
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>予約変更日</td>
<td>({$reserve_data.change_datetime})</td>
<td width=100 bgcolor=#DEDEDE>予約キャンセル日</td>
<td>({$reserve_data.cancel_datetime})</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>利用目的</td>
<td>
	({if $reserve_data.purpose==0})
		未選択
	({elseif $reserve_data.purpose==1})
		会議
	({elseif $reserve_data.purpose==2})
		セミナー
	({elseif $reserve_data.purpose==3})
		研修
	({elseif $reserve_data.purpose==4})
		面接・試験
	({elseif $reserve_data.purpose==5})
		懇談会・パーティ
	({elseif $reserve_data.purpose==6})
		その他
	({/if})
</td>
<td width=100 bgcolor=#DEDEDE>バーチャル口座</td>
<td>({$reserve_data.virtual_code})</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>入金期限日</td>
<td>({$reserve_data.pay_limitdate})</td>
<td width=100 bgcolor=#DEDEDE>最終入金日</td>
<td>({$reserve_data.pay_checkdate})</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>入金済みフラグ</td>
<td>
({if $reserve_data.pay_flag==1})
	入金済み
({elseif $reserve_data.pay_flag==0})
	未入金 or 一部入金
({else})
過剰入金
({/if})
</td>
<td width=100 bgcolor=#DEDEDE>入金済み金額</td>
<td>({$reserve_data.pay_money})円</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>完了フラグ</td>
<td>
({if $reserve_data.complete_flag==1})
	完了
({else})
	未完了
({/if})
</td>
<td width=100 bgcolor=#DEDEDE>看板</td>
<td align=left>
({$reserve_data.kanban|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>部屋利用料金</td>
<td>
({$reserve_data.room_price})円
</td>
<td width=100 bgcolor=#DEDEDE>備品利用料金</td>
<td>
({$reserve_data.vessel_price})円
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>サービス利用料金</td>
<td>
({$reserve_data.service_price})円
</td>
<td width=100 bgcolor=#DEDEDE>合計請求金額</td>
<td>
({$reserve_data.room_price+$reserve_data.vessel_price+$reserve_data.service_price})円
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>領収書印刷フラグ</td>
<td>
({if $reserve_data.receipt_flag==0})
未印刷
({else})
印刷済み
({/if})
</td>
<td width=100 bgcolor=#DEDEDE>領収書印刷日</td>
<td>
({$reserve_data.receipt_datetime})
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>請求番号</td>
<td colspan=3>
({$reserve_data.bill_id})
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>社内メモ</td>
<td colspan=3>
({$reserve_data.memo|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>お客様メッセージ</td>
<td colspan=3>
({$reserve_data.message|nl2br|t_url2cmd:'diary':$member.c_member_id|t_cmd:'diary'|t_decoration})
</td>
</tr>

</table>
<br>
<b>↓　↓　↓</b><br>
<br>

<form onSubmit="return confirm1();" name="do_change_reserve" method="POST" action="./">
<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('do_change_reserve','page')})" />
<input type="hidden" name="reserve_id" value="({$reserve_data.reserve_id})">

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
<select name="room_id">
({foreach from=$room_select item=item})
	<option value="({$item.room_id})" ({if $item.room_id==$reserve_data.room_id})selected({/if})>({$item.room_name})</option>
({/foreach})
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>利用開始日時</td>
<td>
<input type="text" name="begin_datetime" value="({$reserve_data.begin_datetime})">
</td>
<td width=100 bgcolor=#DEDEDE>利用終了日時</td>
<td>
<input type="text" name="finish_datetime" value="({$reserve_data.finish_datetime})">
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>仮予約日</td>
<td>
<input type="text" name="tmp_reserve_datetime" value="({$reserve_data.tmp_reserve_datetime})">
</td>
<td width=100 bgcolor=#DEDEDE>予約承認日</td>
<td>
<input type="text" name="reserve_datetime" value="({$reserve_data.reserve_datetime})">
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>仮予約フラグ</td>
<td>
<input type="radio" id="tmp_flag1" name="tmp_flag" value="1" ({if $reserve_data.tmp_flag==1})checked({/if})>仮予約
<input type="radio" id="tmp_flag0" name="tmp_flag" value="0" ({if $reserve_data.tmp_flag==0})checked({/if})>予約承認済み
</td>
<td width=100 bgcolor=#DEDEDE>キャンセルフラグ</td>
<td>
<input type="radio" name="cancel_flag" value="1" ({if $reserve_data.cancel_flag==1})checked({/if})>キャンセル済み
<input type="radio" name="cancel_flag" value="0" ({if $reserve_data.cancel_flag==0})checked({/if})>未キャンセル
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>予約変更フラグ</td>
<td>
<input type="radio" name="change_flag" id="change_flag1" value="1" ({if $reserve_data.change_flag==1})checked({/if})>変更済み
<input type="radio" id="change_flag0" name="change_flag" value="0" ({if $reserve_data.change_flag==0})checked({/if})>未変更
</td>
<td width=100 bgcolor=#DEDEDE>利用予定人数</td>
<td>
<input type="text" name="people" value="({$reserve_data.people})" style="text-align:right;padding-right:5px;">人
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>予約変更日</td>
<td>
<input type="text" name="change_datetime" value="({$reserve_data.change_datetime})">
</td>
<td width=100 bgcolor=#DEDEDE>予約キャンセル日</td>
<td>
<input type="text" name="cancel_datetime" value="({$reserve_data.cancel_datetime})">
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>利用目的</td>
<td>
<select name="purpose">
({foreach from=$purpose_list key=key item=item})
	<option value="({$key})" ({if $key==$reserve_data.purpose})selected({/if})>({$item})</option>
({/foreach})
</td>
<td width=100 bgcolor=#DEDEDE>バーチャル口座</td>
<td>
({$reserve_data.virtual_code})<br>
※ ゲストの顧客など口座が<br>
割当てられていない状態の顧客を<br>
一部入金などに修正した場合には、<br>
自動で空き番号を割り当てます。
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>入金期限日</td>
<td>
<input type="text" name="pay_limitdate" value="({$reserve_data.pay_limitdate})">
</td>
<td width=100 bgcolor=#DEDEDE>最終入金日</td>
<td>
<input type="text" name="pay_checkdate" value="({$reserve_data.pay_checkdate})">
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>入金済みフラグ</td>
<td>
<input type="radio" name="pay_flag" value="1" id="pay1" ({if $reserve_data.pay_flag==1})checked({/if})>入金済み
<input type="radio" name="pay_flag" value="0" id="pay0" ({if $reserve_data.pay_flag==0})checked({/if})>未入金 or 一部入金
<input type="radio" name="pay_flag" value="2" id="pay2" ({if $reserve_data.pay_flag==2})checked({/if})>過剰入金
</td>
<td width=100 bgcolor=#DEDEDE>入金済み金額</td>
<td>
<input type="text" name="pay_money" onchange="update_radio()" id="pay_money" value="({$reserve_data.pay_money})" style="text-align:right;padding-right:5px;">円
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>完了フラグ</td>
<td>
<input type="radio" name="complete" value="1" ({if $reserve_data.complete_flag==1})checked({/if})>完了
<input type="radio" name="complete" value="0" ({if $reserve_data.complete_flag==0})checked({/if})>未完了
</td>
<td width=100 bgcolor=#DEDEDE>看板</td>
<td>
<textarea id=kanban name=kanban rows="3" cols="40">({$reserve_data.kanban})</textarea>
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>部屋利用料金</td>
<td>
<input type="text" name="room_price" id="room_price" value="({$reserve_data.room_price})" style="text-align:right;padding-right:5px;" onkeyup="return changePrice()">円
</td>
<td width=100 bgcolor=#DEDEDE>備品利用料金</td>
<td>
<input type="text" name="vessel_price" id="vessel_price" value="({$reserve_data.vessel_price})" style="text-align:right;padding-right:5px;" onkeyup="return changePrice()">円
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>サービス利用料金</td>
<td>
<input type="text" name="service_price" id="service_price" value="({$reserve_data.service_price})" style="text-align:right;padding-right:5px;" onkeyup="return changePrice()">円
</td>
<td width=100 bgcolor=#DEDEDE>合計請求金額</td>
<td>
<input type="text" name="total_price" id="total_price" value="({$reserve_data.room_price+$reserve_data.service_price+$reserve_data.vessel_price})" style="text-align:right;padding-right:5px;">円
</td>
</tr>
<tr>
<td width=100 bgcolor=#DEDEDE>領収書印刷フラグ</td>
<td>
<input type="radio" name="receipt_flag" value="0" ({if $reserve_data.receipt_flag==0})checked({/if})>未印刷
<input type="radio" name="receipt_flag" value="1" ({if $reserve_data.receipt_flag==1})checked({/if})>印刷済み
</td>
<td width=100 bgcolor=#DEDEDE>領収書印刷日</td>
<td>
<input type="text" name="receipt_datetime" value="({$reserve_data.receipt_datetime})">
</td>
</tr>
<tr>
<td width=100 bgcolor=#DEDEDE>請求番号</td>
<td colspan=3>
<input type="text" name="bill_id" value="({$reserve_data.bill_id})" >　
<input type="radio" name="renew_bill_id" value="0" checked>テキスト入力　
<input type="radio" name="renew_bill_id" value="1">新規請求番号取得
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>社内メモ</td>
<td colspan=3>
<textarea id="mce_editor_textarea" name="memo" rows="({$_rows|default:'4'})" cols="({$_cols|default:'70'})">({$reserve_data.memo})</textarea>
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>お客さま<br>メッセージ</td>
<td colspan=3>
<textarea id="mce_editor_textarea" name="message" rows="({$_rows|default:'4'})" cols="({$_cols|default:'70'})">({$reserve_data.message})</textarea>
</td>
</tr>
<tr>
<td colspan=4>
<input type="submit" value="　変　更　">
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
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
	var JQry = jQuery.noConflict();
    function changePrice()
    {
        var room_price = document.getElementById('room_price').value;
        var ressel_price = document.getElementById('vessel_price').value;
        var service_price= document.getElementById('service_price').value;
		var pay_money= document.getElementById('pay_money').value;
        var total_price = document.getElementById('total_price');
        if(room_price == ''){
        	room_price = 0;
        }
        if(ressel_price == ''){
        	ressel_price = 0;
        }
        if(service_price == ''){
        	service_price = 0;
        }
        var total =parseFloat(room_price)+parseFloat(ressel_price)+parseFloat(service_price);
        total_price.value= total;
		if(pay_money<total){
			 document.getElementById("pay0").checked = true;
		}
		if(pay_money==total){
			 document.getElementById("pay1").checked = true;
		}
		if(pay_money>total){
			 document.getElementById("pay2").checked = true;
		}
    }
	function update_radio(){
		var room_price = document.getElementById('room_price').value;
        var ressel_price = document.getElementById('vessel_price').value;
        var pay_money= document.getElementById('pay_money').value;
        var service_price= document.getElementById('service_price').value;
        var total_price = document.getElementById('total_price');
        if(room_price == ''){
        	room_price = 0;
        }
        if(ressel_price == ''){
        	ressel_price = 0;
        }
        if(service_price == ''){
        	service_price = 0;
        }
        var total =parseFloat(room_price)+parseFloat(ressel_price)+parseFloat(service_price);
		if(pay_money<total){
			 document.getElementById("pay0").checked = true;			 
		}
		if(pay_money==total){
			 document.getElementById("pay1").checked = true;			 
		}
		if(pay_money>total){
			 document.getElementById("pay2").checked = true;			 
		}
	}
	JQry( document ).ready(function() {
		var pay_money= document.getElementById('pay_money').value;
		var total = document.getElementById('total_price').value;
		if(pay_money<total){
			 document.getElementById("pay0").checked = true;			 
			 
		}
		if(pay_money==total){
			 document.getElementById("pay1").checked = true;			 
			
		}
		if(pay_money>total){
			document.getElementById("pay2").checked = true;		
	
		}
    });
</script>
({$inc_footer|smarty:nodefaults})
