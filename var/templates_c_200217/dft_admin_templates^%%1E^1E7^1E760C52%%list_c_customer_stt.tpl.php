<?php /* Smarty version 2.6.18, created on 2016-10-26 18:43:47
         compiled from file:/var/www/atoffice/webapp/modules/admin/templates/list_c_customer_stt.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/atoffice/webapp/modules/admin/templates/list_c_customer_stt.tpl', 5, false),array('modifier', 't_escape', 'file:/var/www/atoffice/webapp/modules/admin/templates/list_c_customer_stt.tpl', 119, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>



<?php $this->assign('page_name', "貸し止め一覧"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminStatisticalInformation.tpl"), $this);?>

</div>

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
        width: 380px;
        z-index: 3000;
        background:#FFFFFF;
        top:120px;
        border: 2px solid #000;
        border-radius:5px;
		left:37%;
		text-align:center;
    }
</style>
<div style="position:relative">
	<div style="display:none;background:#fff;height:auto;padding:20px 30px;" id="dialog">				
		<form id="myForm" method="POST">
			<p id="success" value=""></p>
			<input type="hidden" value="" id="stop_user_id">
			<input type="hidden" value="" id="stop_id">
			<p id="th_error" style="vertical-align:top;color:red;text-align:left;padding-left:30%"></p>
			<p id="error_cs" style="display: none;color:red;width:100%; text-align:center;font-weight: bold;margin-bottom:5px;">
					この顧客IDは存在しません		
			</p>
			<table class="form_dit">
				<tr>
					<th>顧客ID</th>
					<td>
						<input type="text" id="user_id" name="user_id" value="" style="width:120px" size=50>
						<input type="button"  onclick="search_id_customer()" value="検索">
						<p style="padding:3px 0;">※新規の場合は未入力</p>
					</td>
				<tr>
				<tr>
					<th>氏名</th>
					<td><input type="text" class="iptext" id="customerName" value="" ></td>
				</tr>
				<tr>
					<th>氏名（カナ）</th>
					<td><input type="text" class="iptext" id="customerNameKana" value="" ></td>
				</tr>
				<tr>
					<th>法人/団体名</th>
					<td><input type="text" class="iptext" id="org" value="" ></td>
				</tr>
				<tr>
					<th>郵便番号</th>
					<td><input type="text" class="iptext" id="postalCode" value="" ></td>
				</tr>
				<tr>
					<th>住所</th>
					<td><input type="text" class="iptext" id="streetAddress" value="" ></td>
				</tr>
				<tr>
					<th>電話番号</th>
					<td><input type="text" class="iptext" id="phoneNumber" value=""></td>
				</tr>
				<tr>
					<th>FAX番号</th>
					<td><input type="text" class="iptext" id="faxNumber" value="" ></td>
				</tr>
				<tr>
					<th>PCメールアドレス</th>
					<td><input type="text" class="iptext" id="email" value=""></td>
				</tr>
				<tr>
					<th>メモ</th>
					<td><input type="text" class="iptext" id="memo" value=""></td>
				</tr>
			</table>
			<div style="width:100px; margin:auto">
				<input style="float:right" type="button" value="更新" name="ok" onclick="update_rental_stop()">
				<input style="float:left" type="button" value="キャンセル" onclick="closeDialog()">
			</div>
		</form>		
	</div>
</div>
<div id="overlay" class="web_dialog_overlay" onclick="return closeDialog()">

</div>
<h2>貸し止め一覧</h2>
<div class="contents">
<?php if ($this->_tpl_vars['error']): ?>
<table border="1" bgcolor="#000000" width="500" style="margin:0px auto 30px">
	<tbody>
		<tr>
			<td style="color:#FF0000"><b>以下の入力項目にエラーがあります。修正してください。</b></td>
		</tr>
		<tr>
			<td style="color:#FFFF00">・ <?php echo smarty_modifier_t_escape($this->_tpl_vars['error']); ?>
</td></tr>
	</tbody>
</table>
<?php endif; ?>
<form id="rental_form" class="form_custom" name="search" method="POST" action="./">
	<input type="hidden" name="m" value="admin">	
	<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('list_c_customer_stt','page')); ?>
"/>
	<input type="hidden" value="0" name="page_num" id="page_num"/>
			
	<ul class="list_check_custom">
		<li><label><input type="checkbox" <?php if ($this->_tpl_vars['check']): ?> checked=checked <?php endif; ?> name ="c1" value="0"/>有効期限なし（無期限）</label></li>
		<li>				
			<input type="checkbox" <?php if ($this->_tpl_vars['dBeginRequests']): ?> checked=checked <?php endif; ?> class="checkbox" name ="c2" value ="1" />
			<label>有効期限： 
				<input name="date1" id="demo1" <?php if ($this->_tpl_vars['ok']): ?> value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['begin_limit']); ?>
" <?php else: ?> value ="<?php echo smarty_modifier_t_escape($this->_tpl_vars['date_current']); ?>
" <?php endif; ?> type="text" style="width: 85px; padding: 0px 5px">		

				<a <?php if ($this->_tpl_vars['ok']): ?>style="cursor: pointer; pointer-events: auto;"<?php endif; ?> class="none_decoration disable" href="javascript:NewCal('demo1','YYYYMMDD')">
					<img src="./img/cal.gif" style ="margin: -3px 5px;" width="16" height="16" border="0" alt="Pick a date">
				</a>
			～ 
			    <input name="date2" id="demo2" <?php if ($this->_tpl_vars['ok']): ?> value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['end_limit']); ?>
" <?php else: ?> value ="<?php echo smarty_modifier_t_escape($this->_tpl_vars['date_current']); ?>
" <?php endif; ?>  type="text" style="width: 85px; padding: 0px 5px">
			    <a  <?php if ($this->_tpl_vars['ok']): ?>style="cursor: pointer; pointer-events: auto;"<?php endif; ?> class="none_decoration disable" href="javascript:NewCal('demo2','YYYYMMDD')">
			   		<img src="./img/cal.gif" style ="margin: -3px 5px;" width="16" height="16" border="0" alt="Pick a date">
			   	</a>
			</label>
		</li>
		<li>
			<input type="checkbox" <?php if ($this->_tpl_vars['dBeginDefault']): ?> checked=checked <?php endif; ?> class="checkbox1" name ="c3" value ="2"/>
			<label>希望利用日：
				<input name="date3" id="demo3" <?php if ($this->_tpl_vars['ok']): ?> value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['begin_time']); ?>
" <?php else: ?> value ="<?php echo smarty_modifier_t_escape($this->_tpl_vars['date_current']); ?>
" <?php endif; ?>  type="text" style="width: 85px; padding: 0px 5px">
				<a <?php if ($this->_tpl_vars['ok']): ?>style="cursor: pointer; pointer-events: auto;"<?php endif; ?> class="none_decoration disable1" href="javascript:NewCal('demo3','YYYYMMDD')">
					<img src="./img/cal.gif" style ="margin: -3px 5px;" width="16" height="16" border="0" alt="Pick a date">
				</a>
				～ 
				<input name="date4" id="demo4" <?php if ($this->_tpl_vars['ok']): ?> value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['finish_time']); ?>
" <?php else: ?> value ="<?php echo smarty_modifier_t_escape($this->_tpl_vars['date_year_ago']); ?>
" <?php endif; ?>  type="text" style="width: 85px; padding: 0px 5px">
				<a <?php if ($this->_tpl_vars['ok']): ?>style="cursor: pointer; pointer-events: auto;"<?php endif; ?> class="none_decoration disable1" href="javascript:NewCal('demo4','YYYYMMDD')">
					<img src="./img/cal.gif" style ="margin: -3px 5px;" width="16" height="16" border="0" alt="Pick a date">
				</a>
			</label>
			<input type="submit" name = "ok" value="出力"></li>
	</ul>
</form>
<?php if (! $this->_tpl_vars['result']): ?>	
	結果が出ない
<?php else: ?>
<?php if ($this->_tpl_vars['dBeginDefault']): ?> 希望利用日: <?php echo smarty_modifier_t_escape($this->_tpl_vars['dBeginDefault']); ?>
 ～ <?php endif; ?> <?php if ($this->_tpl_vars['dFinishDefault']): ?> <?php echo smarty_modifier_t_escape($this->_tpl_vars['dFinishDefault']); ?>
 <?php endif; ?><br>
<?php if ($this->_tpl_vars['dBeginRequests']): ?> 有効期限: <?php echo smarty_modifier_t_escape($this->_tpl_vars['dBeginRequests']); ?>
 ～ <?php endif; ?>  <?php if ($this->_tpl_vars['dFinishRequest']): ?> <?php echo smarty_modifier_t_escape($this->_tpl_vars['dFinishRequest']); ?>
 <?php endif; ?><br>
<?php if ($this->_tpl_vars['check']): ?>有効期限なし<?php endif; ?>
<table border=1 width=100%; margin: auto; class="listresult">
<tr>
	<th>状態</th>
	<th style="width:75px;">有効期限</th>
	<th style="width:75px;">利用日</th>
	<th style="width:200px;">会場名</th>
	<th style="width:75px;">部屋名</th>
	<th style="width:100px;">利用時間帯</th>
	<th style="width:75px;">メモ</th>
	<th style="width:75px;">受付日</th>
	<th >貸し止め担当者</th>
	<th></th>
</tr>
<?php $_from = $this->_tpl_vars['result']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
	<tr>
		<td align=center><?php if ($this->_tpl_vars['item']['flag'] == 1): ?>有効期限なし<?php else: ?>有効期限あり<?php endif; ?></td>
		<td align=center><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['limit_datetime']); ?>
</td>
		<td align=center><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['begin_datetime']); ?>
</td>
		<td align=center><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>
</td>
		<td align=center><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_name']); ?>
</td>
		<td align=center><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['time_stop']); ?>
</td>
		<td align=center><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['memo']); ?>
</td>
		<td align=center><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['created_date']); ?>
</td>
		<td align=center><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['admin_name']); ?>
</td>
		<td align=center><button onclick="view_rental_stop('<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['stop_user_id']); ?>
','<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['stop_id']); ?>
')">貸し止め情報</button></td>
	</tr>
<?php endforeach; endif; unset($_from); ?>
</table>
<?php if ($this->_tpl_vars['page_num'] > 1): ?>
<br>
<div style="text-align:center;">
<?php $_from = $this->_tpl_vars['page_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<?php if ($this->_tpl_vars['item']['select']): ?>
	<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['page']); ?>

<?php else: ?>
	<a href="javascript:return false" onclick="paginate('<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['index']); ?>
');" ><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['page']); ?>
</a>
<?php endif; ?>
|
<?php endforeach; endif; unset($_from); ?>
</div>
<?php endif; ?>
<?php endif; ?>
<?php echo $this->_tpl_vars['inc_footer']; ?>

<style type="text/css">
.none_decoration{
	text-decoration: none; 
	display: inline-block; 
}
.listresult{
	border-collapse: collapse;
	margin-top: 20px;
}
.listresult td, .listresult th{
	padding: 5px 7px;	
}
.resuft{
	overflow: hidden;
	width: 100%;
	text-align: center;
}
.minth{
	width: 250px;
	word-break: break-all;
}
.list_check_custom{
	float: left;
	overflow: hidden;
}
.list_check_custom li{
	list-style: none;	
}
.list_check_custom li input[type="checkbox"]{
  display: inline-block;
  width: 19px;
  height: 19px;
  margin: 1px 4px 5px 0;
  vertical-align: middle;
  cursor: pointer;
}
.list_check_custom li input[type="submit"]{
	margin-left: 20px;	
	padding: 3px;
}
.footer{
	clear: both;
}
.form_custom{
	overflow: hidden;
	margin-bottom: 20px;
}

input:focus{
    outline: 0;
}
.form_dit{
	margin-top:10px;
	margin-bottom: 10px;
}
.form_dit th{
	text-align: center;
	width: 100px;
	margin-bottom: 13px;
	vertical-align: top;
}
.form_dit td{
	text-align: left;	
	margin-bottom: 10px;
	width: 271px;
}
.form_dit td input.iptext{
	width: 100%;
}
#success{
	color: red;
	text-align: center;
	margin: 10px 0px;
}
</style>
<script type="text/javascript" src="./js/datetimepicker.js"></script>
<script type="text/javascript" src="./js/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
var id_stop='';	
function closeDialog(){
    var overlay = document.getElementById("overlay");
    overlay.style.display = "none";   
    var dialog = document.getElementById('dialog');
    dialog.style.display = "none";
    return false;
    }

function show_dialog(){
	var overlay = document.getElementById("overlay");
    overlay.style.display = "block";
    var dialog = document.getElementById('dialog');
    dialog.style.display = "block";
}
function view_rental_stop(stop_user_id, stop_id){
	document.getElementById("myForm").reset();
	document.getElementById("success").innerHTML = '';
	document.getElementById("th_error").innerHTML='';
	document.getElementById("error_cs").style.display = 'none';
	document.getElementById("stop_user_id").value=stop_user_id;	
	document.getElementById("stop_id").value=stop_id;	
	show_dialog();	
	var url="?m=admin&a=page_view_detail_rental_stop";
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.open("POST", url, true);
	xmlHttp.setRequestHeader("Content-Type" , "application/x-www-form-urlencoded;charset=UTF-8");
	xmlHttp.send('stop_user_id='+stop_user_id);
	xmlHttp.onreadystatechange = function() {
		if(xmlHttp.readyState==4 && xmlHttp.status==200){
			var rs=JSON.parse(xmlHttp.responseText);	
			document.getElementById("user_id").value=rs['c_member_id'];			
			document.getElementById("customerName").value=rs['customerName'];
			document.getElementById("customerNameKana").value=rs['customerNameKana'];
			document.getElementById("org").value=rs['org'];
			document.getElementById("postalCode").value=rs['postalCode'];
			document.getElementById("streetAddress").value=rs['streetAddress'];
			document.getElementById("phoneNumber").value=rs['phoneNumber'];
			document.getElementById("faxNumber").value=rs['faxNumber'];
			document.getElementById("email").value=rs['email'];								
			document.getElementById("memo").value=rs['memo'];								
		}		
	}
	return ;
}
function search_id_customer(){
	var stop_user_id = document.getElementById("user_id").value;
	var pregId=stop_user_id.match(/^[0-9]+$/);
	if(pregId==null){
		document.getElementById("user_id").style.border="1px solid red";			
	}
	else{
		document.getElementById("user_id").style.border="1px solid gray";
		var url="?m=admin&a=page_view_rental_stop";
		var xmlHttp = new XMLHttpRequest();
		xmlHttp.open("POST", url, true);
		xmlHttp.setRequestHeader("Content-Type" , "application/x-www-form-urlencoded;charset=UTF-8");
		xmlHttp.send('stop_user_id='+stop_user_id);
		xmlHttp.onreadystatechange = function() {
			if(xmlHttp.readyState==4 && xmlHttp.status==200){
				var rs=JSON.parse(xmlHttp.responseText);				
				document.getElementById("customerName").value=rs['customerName'];
				document.getElementById("customerNameKana").value=rs['customerNameKana'];
				document.getElementById("org").value=rs['org'];
				document.getElementById("postalCode").value=rs['postalCode'];
				document.getElementById("streetAddress").value=rs['streetAddress'];
				document.getElementById("phoneNumber").value=rs['phoneNumber'];
				document.getElementById("faxNumber").value=rs['faxNumber'];
				document.getElementById("email").value=rs['email'];	
				if(rs['customerName']){
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
function update_rental_stop(){	
	var error="";
	var customerName = document.getElementById("customerName").value;
	var customerNameKana = document.getElementById("customerNameKana").value;
	var org = document.getElementById("org").value;
	var postalCode = document.getElementById("postalCode").value;
	var streetAddress = document.getElementById("streetAddress").value;
	var phoneNumber = document.getElementById("phoneNumber").value;
	var faxNumber = document.getElementById("faxNumber").value;
	var email = document.getElementById("email").value;
	var memo = document.getElementById("memo").value;
	var user_id = document.getElementById("user_id").value;
	var stop_user_id = document.getElementById("stop_user_id").value;
	var stop_id = document.getElementById("stop_id").value;
	var pregId=user_id.match(/^[0-9]+$/);
	var pregNamekana=customerNameKana.match(/^[\u30A0-\u30FF \u0032 \u3000]+$/);
	var pregpostal=postalCode.match(/^\d{3}\-\d{4}$/);
	var pregphoneNumber=phoneNumber.match(/^\d{2,5}-\d{1,4}-\d{4}$/);
	var pregfaxNumber=faxNumber.match(/^\d{2,5}-\d{1,4}-\d{4}$/);
	var pregemail=email.match(/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/);		
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
	if(error!=""){
		document.getElementById("success").innerHTML = '';
		document.getElementById("th_error").innerHTML=error;
	}
	else
	{
		if(stop_user_id == '' || stop_user_id == 0){
			var url="?m=admin&a=page_insert_rental_stop";
			var xmlHttp = new XMLHttpRequest();
			xmlHttp.open("POST", url, true);
			xmlHttp.setRequestHeader("Content-Type" , "application/x-www-form-urlencoded;charset=UTF-8");
			xmlHttp.send('customerName='+customerName+'&customerNameKana='+customerNameKana+'&org='+org+'&postalCode='+postalCode+'&streetAddress='+streetAddress+'&phoneNumber='+phoneNumber+'&faxNumber='+faxNumber+'&email='+email+'&memo='+memo+'&user_id='+user_id+'&stop_id='+stop_id);
				xmlHttp.onreadystatechange = function() {
				if(xmlHttp.readyState==4 && xmlHttp.status==200){				
					closeDialog();
					location.reload();
				}
			}
		}	
		else
		{
			document.getElementById("th_error").innerHTML='';
			var url="?m=admin&a=page_update_rental_stop";
			var xmlHttp = new XMLHttpRequest();
			xmlHttp.open("POST", url, true);
			xmlHttp.setRequestHeader("Content-Type" , "application/x-www-form-urlencoded;charset=UTF-8");
			xmlHttp.send('stop_user_id='+stop_user_id+'&customerName='+customerName+'&customerNameKana='+customerNameKana+'&org='+org+'&postalCode='+postalCode+'&streetAddress='+streetAddress+'&phoneNumber='+phoneNumber+'&faxNumber='+faxNumber+'&email='+email+'&memo='+memo+'&user_id='+user_id);
				xmlHttp.onreadystatechange = function() {
				if(xmlHttp.readyState==4 && xmlHttp.status==200){				
					closeDialog();
					location.reload();
				}
			}
		}
	}
}
function paginate(page)
{
	$("#page_num").val(page);
	$("#rental_form").submit();
}
</script>