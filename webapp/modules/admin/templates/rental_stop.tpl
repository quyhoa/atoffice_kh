({$inc_header|smarty:nodefaults})
({ext_include file="inc_subnavi_adminSiteMember.tpl"})
({assign var="page_name" value="貸し止め"})
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
.web_dialog_overlay {
        background: none repeat scroll 0 0 #000000;
        bottom: 0;
        display: none;
        height: 100%;
        left: 0;
        margin: 0;
        opacity: 0.15;
        padding: 0;
        position: fixed;
        right: 0;
        top: 0;
        width: 100%;
        z-index: 101;
    }
 #dialog{
        position: fixed;
        width: 490px;
        z-index: 3000;
        background:#FFFFFF;
        top:135px;
        border: 2px solid #000;
        border-radius:5px;
		left:29%;
    }
</style>

<h2 id="ttl01">貸し止め</h2>
<p id="error_ms"></p>
<form name="save_cus" method="POST" id="save_ctm" action="./">
<div style="position:relative">
	<table style="display:none;background:#fff;height:auto;padding:20px 30px;" id="dialog">
		<tr>
			<th colspan="2" id="th_error" style="vertical-align:top;color:red;text-align:left;padding-left:30%"></th>
		</tr>		
		<tr>
			<th></th>
			<th id="error_cs" style="display: none;color:red;width:100%; text-align:left;margin-bottom:5px;">	
				この顧客IDは存在しません		
			</th>
		</tr>
		<tr>			
			<th style="vertical-align:top">顧客ID</th>
			<td>
				<input type="text" id="customerId" name="customerId" value="({$rs_user.c_member_id})" style="width:120px" size=50>
				<input type="button"  onclick="search_id_customer()" value="検索">
				<p style="padding:3px 0;">※新規の場合は未入力</p>
			</td>
		</tr>
		<tr>	
			<th>氏名</th>
			<td><input type="text" name="customerName" id="customerName" value="({$rs_user.customer_name})" size=50></td>
		</tr>
		<tr>
			<th>氏名（カナ）</th>
			<td><input type="text" name="customerNameKana" id="customerNameKana" value="({$rs_user.customer_name_kana})" size=50></td>
		</tr>
		<tr>
			<th>法人/団体名</th>
			<td><input type="text" name="org" id="org" value="({$rs_user.corporation_name})" size=50></td>
		</tr>
		<tr>
			<th>郵便番号</th>
			<td><input type="text" name="postalCode" id="postalCode" value="({$rs_user.post_code})" size=50></td>
		</tr>
		<tr>
			<th>住所</th>
			<td><input type="text" name="streetAddress" id="streetAddress" value="({$rs_user.address})" size=50></td>
		</tr>
		<tr>
			<th>電話番号</th>
			<td><input type="text" name="phoneNumber" id="phoneNumber" value="({$rs_user.phone_number})" size=50></td>
		</tr>
		<tr>
			<th>FAX番号</th>
			<td><input type="text" name="faxNumber" id="faxNumber" value="({$rs_user.fax})" size=50></td>
		</tr>
		<tr>
			<th>PCメールアドレス</th>
			<td><input type="text" name="email" id="email" value="({$rs_user.email})" size=50></td>
		</tr>
		<tr>
			<th>メモ</th>
			<td><input type="text" name="memo2"  id="memo2" value="({$rs_user.memo})" size=50></td>
		</tr>
		<tr>
			<th></th>
			<td style="text-align:center;padding-top:5px;">
				<input style="padding:3px" type="button"  onclick="closeForm()" value="戻る">
				<input style="padding:3px" onclick="save_customer()" type="button" value="保存">
			</td>
		
		</tr>
	</table>

</div>
<div id="overlay" class="web_dialog_overlay" onclick="return closeForm()">
</div>
</form>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
var JQry = jQuery.noConflict();
var clear_flag=0;
function closeDialog(){
    var overlay = document.getElementById("overlay");
    overlay.style.display = "none";   
    var dialog = document.getElementById('dialog');
    dialog.style.display = "none";
    return false;
}
function show_details(){
    var nodeList = document.getElementsByTagName("input");
	for(var i=0; nodeList[i]; ++i){
		if(nodeList[i].type  == 'checkbox' && nodeList[i].checked){		
		   document.getElementById("error_ms").removeAttribute("style");		
	       var overlay = document.getElementById("overlay");
		   overlay.style.display = "block";
		   var dialog = document.getElementById('dialog');
		   dialog.style.display = "block";
		   break;		   
		}
		else{
			document.getElementById("error_ms").innerHTML='貸し止めする時間にチェックを入れて下さい';			
			document.getElementById("error_ms").style.display ='block';								
		}
	};
	if(document.getElementById("error_ms").style.display == 'block'){
		document.getElementById("mese").style.display ='none';
	}
}
function allcheck(targetForm,flag){
　for(n=0;n<=targetForm.length-1;n++){
　　if(targetForm.elements[n].type == "checkbox"){
　　　targetForm.elements[n].checked = flag;
　　}
　}
}

function linecheck(line){
  var mode=(document.getElementById('sd'+line+'_0').checked)?false:true;
  for(var i=0;i<100;i++){
	var a=document.getElementById('sd'+line+'_'+i);
	if(a==null) break;
	a.checked=mode;
  }
}	
function setRoomID(room_id) 
{
document.forms["rental_stop"].elements["room_id"].value = room_id;
document.forms["rental_stop"].elements["a"].value = "page_({$hash_tbl->hash('rental_stop','page')})";

return true;
}
function setYMD(y, m, d) {
      document.forms["rental_stop"].elements["year"].value = y;
      document.forms["rental_stop"].elements["month"].value = m;
      document.forms["rental_stop"].elements["day"].value = d;
      document.forms["rental_stop"].elements["a"].value = "page_({$hash_tbl->hash('rental_stop','page')})";
      document.forms["rental_stop"].elements["periodmode"].value = 0;
      document.forms["rental_stop"].elements["period"].value = 31;
      document.forms["change_hall_id"].elements["periodmode"].value = 0;
      document.forms["change_hall_id"].elements["period"].value = 31;
      return true;
  }
function closeForm(){
	closeDialog();
	if(clear_flag==0){
		clear_data();
	}
}
function search_id_customer(){
	var cusId=document.getElementById("customerId").value;
	var pregId=cusId.match(/^[0-9]+$/);
	if(pregId==null){
		document.getElementById("customerId").style.border="1px solid red";			
	}else{
		document.getElementById("customerId").style.border="1px solid grey";
		document.getElementById("customerName").style.border="1px solid grey";
		document.getElementById("customerNameKana").style.border="1px solid grey";
		document.getElementById("postalCode").style.border="1px solid grey";
		document.getElementById("streetAddress").style.border="1px solid grey";
		document.getElementById("org").style.border="1px solid grey";
		document.getElementById("phoneNumber").style.border="1px solid grey";
		document.getElementById("faxNumber").style.border="1px solid grey";
		document.getElementById("email").style.border="1px solid grey";
		document.getElementById("memo2").style.border="1px solid grey";
		document.getElementById("th_error").innerHTML='';
		var url="?m=admin&a=page_search_data_customer";
		var xmlHttp = new XMLHttpRequest();
		xmlHttp.open("POST", url, true);
		xmlHttp.setRequestHeader("Content-Type" , "application/x-www-form-urlencoded;charset=UTF-8");
		xmlHttp.send("customerId="+cusId);
		xmlHttp.onreadystatechange = function() {
			if(xmlHttp.readyState==4 && xmlHttp.status==200){
				var rs=JSON.parse(xmlHttp.responseText);			
				document.getElementById("customerName").value=rs['name'];
				document.getElementById("customerNameKana").value=rs['nameKana'];
				document.getElementById("org").value=rs['corporation'];
				document.getElementById("postalCode").value=rs['address_zip'];
				document.getElementById("streetAddress").value=rs['address_city'];
				document.getElementById("phoneNumber").value=rs['tel'];
				document.getElementById("faxNumber").value=rs['fax'];
				document.getElementById("email").value=rs['mail'];		
				if(rs['name']){
					document.getElementById("error_cs").style.display = 'none';

				}	
				else{
					document.getElementById("error_cs").style.display = 'block';
				}
			}
			
			
		}
		return ;
	}
}
function clear_data(){
	document.getElementById("customerName").value='';
	document.getElementById("customerNameKana").value='';
	document.getElementById("org").value='';
	document.getElementById("postalCode").value='';
	document.getElementById("streetAddress").value='';
	document.getElementById("phoneNumber").value='';
	document.getElementById("faxNumber").value='';
	document.getElementById("email").value='';
	document.getElementById("memo2").value='';
	document.getElementById("customerId").value='';
	document.getElementById("customerId").style.border="1px solid grey";
	document.getElementById("customerName").style.border="1px solid grey";
	document.getElementById("customerNameKana").style.border="1px solid grey";
	document.getElementById("postalCode").style.border="1px solid grey";
	document.getElementById("streetAddress").style.border="1px solid grey";
	document.getElementById("org").style.border="1px solid grey";
	document.getElementById("phoneNumber").style.border="1px solid grey";
	document.getElementById("faxNumber").style.border="1px solid grey";
	document.getElementById("email").style.border="1px solid grey";
	document.getElementById("memo2").style.border="1px solid grey";
	document.getElementById("th_error").innerHTML='';
}
function save_customer(){
	var post=document.getElementById('save_ctm').serialize();
	var url="?m=admin&a=page_save_data_customer";
	var cusId=document.getElementById("customerId").value;	
	var customerName=document.getElementById("customerName").value;
	var email=document.getElementById("email").value;
	var customerNameKana=document.getElementById("customerNameKana").value;
	var org=document.getElementById("org").value;
	var streetAddress=document.getElementById("streetAddress").value;
	var memo2=document.getElementById("memo2").value;
	var postalCode=document.getElementById("postalCode").value;
	var faxNumber=document.getElementById("faxNumber").value;
	var phoneNumber=document.getElementById("phoneNumber").value;
	var pregId=cusId.match(/^[0-9]+$/);
	var pregNamekana=customerNameKana.match(/^[\u30A0-\u30FF]+$/);
	var pregpostal=postalCode.match(/^\d{3}\-\d{4}$/);
	var pregphoneNumber=phoneNumber.match(/^\d{2,5}-\d{1,4}-\d{4}$/);
	var pregfaxNumber=faxNumber.match(/^\d{2,5}-\d{1,4}-\d{4}$/);
	var pregemail=email.match(/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/);
	var error="";
	if(cusId==''){
		if(customerName=='' && pregNamekana==null && org=='' && pregpostal==null && streetAddress=='' && pregphoneNumber==null && streetAddress=='' && pregphoneNumber==null && pregfaxNumber==null && pregemail==null){	
				error='';
		}else{
			document.getElementById("customerName").style.border="1px solid grey";
		}
		if(customerNameKana != '' && pregNamekana==null){
			document.getElementById("customerNameKana").style.border="1px solid red";
			error=error+'氏名（カナ）が正しくありません<br>';
			
		}else{
			document.getElementById("customerNameKana").style.border="1px solid grey";
		}		
		if(postalCode != '' && pregpostal==null){
			document.getElementById("postalCode").style.border="1px solid red";
			error=error+'郵便番号が正しくありません<br>';
			
		}else{
			document.getElementById("postalCode").style.border="1px solid grey";
		}		
		if(phoneNumber != '' && pregphoneNumber==null){
			document.getElementById("phoneNumber").style.border="1px solid red";
			error=error+'電話番号が正しくありません<br>';
			
		}else{
			document.getElementById("phoneNumber").style.border="1px solid grey";
		}
		if(pregfaxNumber==null){
			if(faxNumber!=''){
				document.getElementById("faxNumber").style.border="1px solid red";
				error=error+'FAX番号が正しくありません<br>';
			}
		}else{
			document.getElementById("faxNumber").style.border="1px solid grey";
		}
		if(pregemail==null){
			if(email !=''){
				document.getElementById("email").style.border="1px solid red";
				error=error+'メールアドレスが正しくありません<br>';
			}		
		}else{
			document.getElementById("email").style.border="1px solid grey";
		}
	}
	if(error!=""){
		document.getElementById("th_error").innerHTML=error;
	}else{
		document.getElementById("th_error").innerHTML='';
		document.getElementById("memo2").style.border="1px solid grey";

		//var post="service_price=1&vesel_price=2";
		var xmlHttp = new XMLHttpRequest();
		xmlHttp.open("POST", url, true);
		xmlHttp.setRequestHeader("Content-Type" , "application/x-www-form-urlencoded;charset=UTF-8");
		xmlHttp.send(post);
		xmlHttp.onreadystatechange = function() {
			if(xmlHttp.readyState==4 && xmlHttp.status==200){
				document.getElementById("st_user_id").value = xmlHttp.responseText;
				clear_flag=1;
				closeDialog();
			}
		}
		return ;
	}
}
JQry( document ).ready(function() {
    var isset_user_flag=document.getElementById("customerId").value;
    if(isset_user_flag!=''){
    	clear_flag=1;
    }
});
</script>


<br>
<center>
({if $msg})<p id="mese" class="actionMsg">({$msg})</p><br><br>({/if})
<br><br>

<table border=1>
<tr>
<form name="change_hall_id" method="POST" action="./">
<td>会場選択</td>
<td>

<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="page_({$hash_tbl->hash('rental_stop','page')})" />
<select name="hall_list">
({foreach from=$hall_list item=item})
	<option value="({$item.hall_id})" ({if $item.hall_id==$hall_id})selected({/if})>({$item.hall_name})</option>
({/foreach})
</select>
</td><td rowspan=3 style="vertical-align:middle">
<input type="submit" value="　変更　">
</td>
</tr>

<tr>
<td rowspan=2>日付変更</td>
<td>
<select name="year">
	<option value="({$this_year})" ({if $this_year==$year})selected({/if})>({$this_year})</option>
	<option value="({$this_year+1})" ({if $this_year+1==$year})selected({/if})>({$this_year+1})</option>
</select> 年 
<select name="month">
({foreach from=$month_list item=item})
	<option value="({$item})" ({if $item==$month})selected({/if})>({$item})</option>
({/foreach})
</select> 月 
<select name="day">
({foreach from=$day_list key=key item=item})
	<option value="({$item})" ({if $item==$day})selected({/if})>({$item})(({$week_list.$key}))</option>
({/foreach})
</select> 日 
</td>
</tr><tr>
<td>
<input type="submit" name="backward" value="　←前日　">
<input type="submit" name="forward" value="　翌日→　">
({if $periodmode})
<input type="hidden" name="period" value="({$period})">
<input type="hidden" name="periodmode" id="periodmode" value="({$periodmode})">
<input type="hidden" name="room_id" value="({$room_id})">
<input type="hidden" name="hid" value="({$hall_id})">
({/if})
</form>
</tr>
<tr>
<form name="rental_stop" method="POST" action="./">
<td>

<input type="hidden" name="m" value="({$module_name})" />
<input type="hidden" name="a" value="do_({$hash_tbl->hash('set_rental_stop','do')})" />
<input type="hidden" name="sessid" value="({$PHPSESSID})" />
<input type="hidden" name="stop_us_id" value="" />
種類
</td>
<td colspan=2>
<input type="radio" name="flag" value="0" checked>有効期限あり
<input type="radio" name="flag" value="1">有効期限なし
</td>
</tr>

<tr>
<td>
有効期限
</td>
<td><input type="text" name="limit_datetime" value=""></td>
<td>書式例：2009-12-31</td>
</tr>

<tr>
<td>
メモ
</td>
<td colspan=2><input type="text" name="memo" value="" size=50></td>
</tr>
({if !$periodmode})
                    <tr>
                        <td>表示日数</td>
                        <td colspan=2>
                            <select name="period">
                                ({section name=i start=1 loop=32 step=1})
                                <option value="({$smarty.section.i.index})"
                                        ({if $smarty.section.i.index==$period}) selected({/if})
                                        >({$smarty.section.i.index})</option>
                                ({/section})
                            </select> ※部屋の「日付範囲表示」で表示される日数

                        </td>
                    </tr>
({/if})
<tr>
	<td ><input style="width:100%" type="button"  onclick="show_details()" value="詳細"></td>

</tr>

</table>



<br>
<table width=100%>
        <tr>
            <td height=60px bgcolor=#CCCCFF style='border: 1px #000000 solid;text-align:center;vertical-align:middle;font-size:15px;'>
                <b>({$hall_data.hall_name}) 
                    ({if $periodmode})
                    ({$room_data.room_name}) (({$room_data.max})人)<br>
                    ({if $room_data.type==2})最低({$room_data.lowest_koma})コマ以上({/if})
                    ({else})
                    ({$year})年({$month})月({$day})日（({$week})）</b>
                ({/if})
            <input type="submit" value="貸し止め更新">
            <input type="hidden" name="year" value="({$year})">
            <input type="hidden" name="month" value="({$month})">
            <input type="hidden" name="stop_user_id" id="st_user_id" value="">
            <input type="hidden" name="day" value="({$day})">
            <input type="hidden" name="hid" value="({$hall_id})">
            <input type="hidden" name="period" value="({$period})">
            <input type="hidden" name="periodmode" value="({$periodmode})">
            </td>
        </tr>
    </table>

<table width=100%>

({assign var=line value=0})
({* ------------------ room mode ----------------------*})
({if !$periodmode})
<input type="hidden" name="room_id" value="0">
({foreach from=$room_data key=key item=value})
	({if ($line%5)==0})

<tr>
<th style='border: 1px #000000 solid;text-align: center;' width="150">
	部屋名
</th>
<th></th>
({foreach from=$open_time item=time})
	<th bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;' colspan=4><b>
		({$time}):00 ～ ({$time+1}):00
	</b></th>
({/foreach})
</tr>

	({/if})
	({assign var=line value=$line+1})
	({assign var=cb value=0})

	<tr>
	<td style='border: 1px #000000 solid;text-align: center;' >
		({$value.room_name}) (({$value.max})人)
                <input type="submit" name="periodmode" value="日付範囲表示" onClick="setRoomID(({$value.room_id}))">
                
	</td>
	<td><input type="button" value=">>" onClick="linecheck(({$key}))"></td>

	({if $value.holiday})
		<td colspan=({$ct*4}) style='border: 1px #000000 solid;text-align: center;' bgcolor=#FF6666><b>休室日</b></td>
		</tr>
	({else})({**value.holiday**})

		({if $value.type==2})
			({foreach from=$value.opentime key=k item=v})
				<td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' colspan=({$v.cs}) 
				({if $v.reserved})
					bgcolor=#FFDCDC><span style='color:#FF0000;'><b>
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('reserve_view')})&amp;reserve_id=({$v.reserved})">
予約ID:({$v.reserved})</a><br>
代表名：({$v.corp})<br>
予約者：({$v.c_member.nickname}) 様<br>
状態：
({if $v.reserve_data.tmp_flag==1})
	仮予約
({elseif $v.reserve_data.pay_flag==0 and $v.reserve_data.pay_money==0})
	未入金
({elseif $v.reserve_data.pay_flag==0 and $v.reserve_data.pay_money>0})
	一部入金
({elseif $v.reserve_data.pay_flag==1})
	入金済み
({elseif $v.reserve_data.pay_flag==2})
	過剰入金
({/if})
</b></span>
				({elseif $v.stoped})
					bgcolor=#FFCCFF>貸し止め中<br>
					有効期限：({$v.stoped.limit_datetime})<br>
					担当者：({$v.stoped.admin_name})<br>
					({$v.stoped.memo})<br>
					削除：<input type='checkbox' name='delete_data({$value.room_id})({$key})_({$k})' id='sd({$key})_({$cb})' value='({$v.stoped.stop_id})'>
					({assign var=cb value=$cb+1})
				({else})
					>
					
					<input type='checkbox' name='stop_data({$value.room_id})({$key})_({$k})' id='sd({$key})_({$cb})' value='({$hall_data.hall_id}),({$value.room_id}),({$year})-({$month})-({$day}) ({$v.begin_time}),({$year})-({$month})-({$day}) ({if $v.finish_time=="24:00"})23:59:59({else})({$v.finish_time})({/if})'>
				({assign var=cb value=$cb+1})
				({/if})
				</td>
			({/foreach})
		({else})({**type**})

			({foreach from=$value.komawari key=k item=v})
				<td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' colspan=({$v.cs}) 
				({if $v.reserved})
					bgcolor=#FFDCDC><span style='color:#FF0000;'><b>
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('reserve_view')})&amp;reserve_id=({$v.reserved})">
予約ID:({$v.reserved})</a><br>
代表名：({$v.corp})<br>
予約者：({$v.c_member.nickname}) 様<br>
状態：
({if $v.reserve_data.tmp_flag==1})
	仮予約
({elseif $v.reserve_data.pay_flag==0 and $v.reserve_data.pay_money==0})
	未入金
({elseif $v.reserve_data.pay_flag==0 and $v.reserve_data.pay_money>0})
	一部入金
({elseif $v.reserve_data.pay_flag==1})
	入金済み
({elseif $v.reserve_data.pay_flag==2})
	過剰入金
({/if})
<br>


</b></span>
				({elseif $v.stoped})
					bgcolor=#FFCCFF>貸し止め中<br>
					有効期限：({$v.stoped.limit_datetime})<br>
					担当者：({$v.stoped.admin_name})<br>
					({$v.stoped.memo})<br>
					削除：<input type='checkbox' name='delete_data({$key})_({$k})' id='sd({$key})_({$cb})' value='({$v.stoped.stop_id})'>
					({assign var=cb value=$cb+1})
				({elseif $v.rest})
					bgcolor=#CDCDCD>休憩
				({else})
					>
					<input type='checkbox' name='stop_data({$key})_({$k})' id='sd({$key})_({$cb})' value='({$hall_data.hall_id}),({$value.room_id}),({$year})-({$month})-({$day}) ({$v.begin_time}),({$year})-({$month})-({$day}) ({if $v.finish_time=="24:00"})23:59:59({else})({$v.finish_time})({/if})'>
				({assign var=cb value=$cb+1})
				({/if})
				</td>
			({/foreach})
		({/if})({**type**})

	({/if})({**value.holiday**})
	</td>
	</tr>
({/foreach})

<tr>
<th style='border: 1px #000000 solid;text-align: center;' width="150">
	部屋名
</th>
<th></th>
({foreach from=$open_time item=time})
	<th bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;' colspan=4><b>
		({$time}):00 ～ ({$time+1}):00
	</b></th>
({/foreach})
</tr>
 ({else})
 
 <!-- ----------------------------- -->
 
 <input type="hidden" name="room_id" value="({$room_id})">
        ({foreach from=$period_data key=key item=value})
            ({if ($line%5)==0})
            <tr>
                <th style='border: 1px #000000 solid;text-align: center;' width="150">
                    日付

                </th>
                <th></th>

                ({foreach from=$open_time item=time})

                <th bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;' colspan=4><b>
                        ({$time}):00 ～ ({$time+1}):00
                    </b></th>
                ({/foreach})
            </tr>
            ({/if})
        ({assign var=cb value=0})

        <tr>
            <td style='border: 1px #000000 solid;text-align: center;' >
                <b>({$value.year})年({$value.month})月({$value.day})日（({$value.week})）</b><br />
                ({if $room_data.type==2})最低({$room_data.lowest_koma})コマ以上({/if})<br />
                <input type="submit" value="この日を表示" onClick="setYMD(({$value.year}), ({$value.month}), ({$value.day}))">
            </td>
            <td><input type="button" value=">>" onClick="linecheck(({$line}))"></td>
            ({if $value.holiday})
            <td colspan=({$ct*4}) style='border: 1px #000000 solid;text-align: center;' bgcolor=#FF6666><b>休室日</b></td>
            </tr>
            ({else})
        

            ({if $room_data.type==2})
                ({foreach from=$value.opentime key=k item=v})

                <td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' colspan=({$v.cs}) 
                    ({if $v.reserved})
                    bgcolor=#FFDCDC><span style='color:#FF0000;'><b>
                            <a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('reserve_view')})&amp;reserve_id=({$v.reserved})">
                                予約ID:({$v.reserved})</a><br>
                            代表名：({$v.corp})<br>
                            予約者：({$v.c_member.nickname}) 様<br>
                            状態：
                            ({if $v.reserve_data.tmp_flag==1})
                            仮予約
                            ({elseif $v.reserve_data.pay_flag==0 and $v.reserve_data.pay_money==0})
                            未入金
                            ({elseif $v.reserve_data.pay_flag==0 and $v.reserve_data.pay_money>0})
                            一部入金
                            ({elseif $v.reserve_data.pay_flag==1})
                            入金済み
                            ({elseif $v.reserve_data.pay_flag==2})
                            過剰入金
                            ({/if})
                        </b></span>
                              ({elseif $v.stoped})
					bgcolor=#FFCCFF>貸し止め中<br>
					有効期限：({$v.stoped.limit_datetime})<br>
					担当者：({$v.stoped.admin_name})<br>
					({$v.stoped.memo})<br>
					削除：<input type='checkbox' name='delete_data({$key})_({$k})' id='sd({$key})_({$cb})' value='({$v.stoped.stop_id})'>
					({assign var=cb value=$cb+1})
				({elseif $v.rest})
					bgcolor=#CDCDCD>休憩
				({else})
					>
					<input type='checkbox' name='stop_data({$key})_({$k})' id='sd({$key})_({$cb})' value='({$hall_data.hall_id}),({$room_id}),({$value.year})-({$value.month})-({$value.day}) ({$v.begin_time}),({$value.year})-({$value.month})-({$value.day}) ({if $v.finish_time=="24:00"})23:59:59({else})({$v.finish_time})({/if})'>
				({assign var=cb value=$cb+1})
				({/if})
                </td>
                ({/foreach})
            ({else})({**type**})

                ({foreach from=$value.komawari key=k item=v})
                 <td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' colspan=({$v.cs}) 
                    ({if $v.reserved})
                    bgcolor=#FFDCDC><span style='color:#FF0000;'><b>
                            <a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('reserve_view')})&amp;reserve_id=({$v.reserved})">
                                予約ID:({$v.reserved})</a><br>
                            代表名：({$v.corp})<br>
                            予約者：({$v.c_member.nickname}) 様<br>
                            状態：
                            ({if $v.reserve_data.tmp_flag==1})
                            仮予約
                            ({elseif $v.reserve_data.pay_flag==0 and $v.reserve_data.pay_money==0})
                            未入金
                            ({elseif $v.reserve_data.pay_flag==0 and $v.reserve_data.pay_money>0})
                            一部入金
                            ({elseif $v.reserve_data.pay_flag==1})
                            入金済み
                            ({elseif $v.reserve_data.pay_flag==2})
                            過剰入金
                            ({/if})
                            <br>


                        </b></span>
                   ({elseif $v.stoped})
					bgcolor=#FFCCFF>貸し止め中<br>
					有効期限：({$v.stoped.limit_datetime})<br>
					担当者：({$v.stoped.admin_name})<br>
					({$v.stoped.memo})<br>
					削除：<input type='checkbox' name='delete_data({$key})_({$k})' id='sd({$key})_({$cb})' value='({$v.stoped.stop_id})'>
					({assign var=cb value=$cb+1})
				({elseif $v.rest})
					bgcolor=#CDCDCD>休憩
				({else})
					>
					<input type='checkbox' name='stop_data({$key})_({$k})' id='sd({$key})_({$cb})' value='({$hall_data.hall_id}),({$room_id}),({$value.year})-({$value.month})-({$value.day}) ({$v.begin_time}),({$value.year})-({$value.month})-({$value.day}) ({if $v.finish_time=="24:00"})23:59:59({else})({$v.finish_time})({/if})'>
				({assign var=cb value=$cb+1})
				({/if})
                </td>
                ({/foreach})
        ({/if})({**type**})

        ({/if})({**value.holiday**})
        </td>
        </tr>
        ({assign var=line value=$line+1})
        ({/foreach})
       <tr>
            <th style='border: 1px #000000 solid;text-align: center;' width="150">
                部屋名
            </th>
            <th></th>

            ({foreach from=$open_time item=time})

            <th bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;' colspan=4><b>
                    ({$time}):00 ～ ({$time+1}):00
                </b></th>
            ({/foreach})
        </tr>
       


({/if})
  
</table>
<input type="button" value=" 全選択 " onClick="allcheck(this.form,true)">
<input type="button" value=" 全解除 " onClick="allcheck(this.form,false)">

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
<style>
#details_rental{
	border:1px solid;
	width:508px;
	
}
#details_rental th{
	font-weight:normal;
	text-align:left;
	border:1px solid;
}
#details_rental td{
	border:1px solid;
	width:400px;
}
#details_rental td input{
	width:99%;
}
#error_ms{
	margin: 17px;
    margin-bottom: 10px;
    margin-top: 10px;
    padding: 10px;
    border: 2px #FFFFFF dashed;
    background-color: #F8B3C3;
    color: #F51000;
    font-weight: bold;
    display: none;
    text-align: center;
}
</style>