<?php /* Smarty version 2.6.18, created on 2016-10-26 18:42:31
         compiled from file:/var/www/atoffice/webapp/modules/admin/templates/rental_stop.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/atoffice/webapp/modules/admin/templates/rental_stop.tpl', 2, false),array('modifier', 't_escape', 'file:/var/www/atoffice/webapp/modules/admin/templates/rental_stop.tpl', 63, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminSiteMember.tpl"), $this);?>

<?php $this->assign('page_name', "貸し止め"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminSiteMember.tpl"), $this);?>

</div>


<?php if ($this->_tpl_vars['atoffice_auth_type'] == 2 || $this->_tpl_vars['atoffice_auth_type'] == 4): ?>

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
				<input type="text" id="customerId" name="customerId" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['rs_user']['c_member_id']); ?>
" style="width:120px" size=50>
				<input type="button"  onclick="search_id_customer()" value="検索">
				<p style="padding:3px 0;">※新規の場合は未入力</p>
			</td>
		</tr>
		<tr>	
			<th>氏名</th>
			<td><input type="text" name="customerName" id="customerName" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['rs_user']['customer_name']); ?>
" size=50></td>
		</tr>
		<tr>
			<th>氏名（カナ）</th>
			<td><input type="text" name="customerNameKana" id="customerNameKana" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['rs_user']['customer_name_kana']); ?>
" size=50></td>
		</tr>
		<tr>
			<th>法人/団体名</th>
			<td><input type="text" name="org" id="org" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['rs_user']['corporation_name']); ?>
" size=50></td>
		</tr>
		<tr>
			<th>郵便番号</th>
			<td><input type="text" name="postalCode" id="postalCode" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['rs_user']['post_code']); ?>
" size=50></td>
		</tr>
		<tr>
			<th>住所</th>
			<td><input type="text" name="streetAddress" id="streetAddress" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['rs_user']['address']); ?>
" size=50></td>
		</tr>
		<tr>
			<th>電話番号</th>
			<td><input type="text" name="phoneNumber" id="phoneNumber" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['rs_user']['phone_number']); ?>
" size=50></td>
		</tr>
		<tr>
			<th>FAX番号</th>
			<td><input type="text" name="faxNumber" id="faxNumber" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['rs_user']['fax']); ?>
" size=50></td>
		</tr>
		<tr>
			<th>PCメールアドレス</th>
			<td><input type="text" name="email" id="email" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['rs_user']['email']); ?>
" size=50></td>
		</tr>
		<tr>
			<th>メモ</th>
			<td><input type="text" name="memo2"  id="memo2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['rs_user']['memo']); ?>
" size=50></td>
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
document.forms["rental_stop"].elements["a"].value = "page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('rental_stop','page')); ?>
";

return true;
}
function setYMD(y, m, d) {
      document.forms["rental_stop"].elements["year"].value = y;
      document.forms["rental_stop"].elements["month"].value = m;
      document.forms["rental_stop"].elements["day"].value = d;
      document.forms["rental_stop"].elements["a"].value = "page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('rental_stop','page')); ?>
";
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
<?php if ($this->_tpl_vars['msg']): ?><p id="mese" class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><br><br><?php endif; ?>
<br><br>

<table border=1>
<tr>
<form name="change_hall_id" method="POST" action="./">
<td>会場選択</td>
<td>

<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('rental_stop','page')); ?>
" />
<select name="hall_list">
<?php $_from = $this->_tpl_vars['hall_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
	<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_id']); ?>
" <?php if ($this->_tpl_vars['item']['hall_id'] == $this->_tpl_vars['hall_id']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
</td><td rowspan=3 style="vertical-align:middle">
<input type="submit" value="　変更　">
</td>
</tr>

<tr>
<td rowspan=2>日付変更</td>
<td>
<select name="year">
	<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['this_year']); ?>
" <?php if ($this->_tpl_vars['this_year'] == $this->_tpl_vars['year']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['this_year']); ?>
</option>
	<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['this_year']+1); ?>
" <?php if ($this->_tpl_vars['this_year'] + 1 == $this->_tpl_vars['year']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['this_year']+1); ?>
</option>
</select> 年 
<select name="month">
<?php $_from = $this->_tpl_vars['month_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
	<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" <?php if ($this->_tpl_vars['item'] == $this->_tpl_vars['month']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select> 月 
<select name="day">
<?php $_from = $this->_tpl_vars['day_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
	<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" <?php if ($this->_tpl_vars['item'] == $this->_tpl_vars['day']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
(<?php echo smarty_modifier_t_escape($this->_tpl_vars['week_list'][$this->_tpl_vars['key']]); ?>
)</option>
<?php endforeach; endif; unset($_from); ?>
</select> 日 
</td>
</tr><tr>
<td>
<input type="submit" name="backward" value="　←前日　">
<input type="submit" name="forward" value="　翌日→　">
<?php if ($this->_tpl_vars['periodmode']): ?>
<input type="hidden" name="period" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['period']); ?>
">
<input type="hidden" name="periodmode" id="periodmode" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['periodmode']); ?>
">
<input type="hidden" name="room_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_id']); ?>
">
<input type="hidden" name="hid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
">
<?php endif; ?>
</form>
</tr>
<tr>
<form name="rental_stop" method="POST" action="./">
<td>

<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('set_rental_stop','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
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
<?php if (! $this->_tpl_vars['periodmode']): ?>
                    <tr>
                        <td>表示日数</td>
                        <td colspan=2>
                            <select name="period">
                                <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['start'] = (int)1;
$this->_sections['i']['loop'] = is_array($_loop=32) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
if ($this->_sections['i']['start'] < 0)
    $this->_sections['i']['start'] = max($this->_sections['i']['step'] > 0 ? 0 : -1, $this->_sections['i']['loop'] + $this->_sections['i']['start']);
else
    $this->_sections['i']['start'] = min($this->_sections['i']['start'], $this->_sections['i']['step'] > 0 ? $this->_sections['i']['loop'] : $this->_sections['i']['loop']-1);
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = min(ceil(($this->_sections['i']['step'] > 0 ? $this->_sections['i']['loop'] - $this->_sections['i']['start'] : $this->_sections['i']['start']+1)/abs($this->_sections['i']['step'])), $this->_sections['i']['max']);
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
                                <option value="<?php echo smarty_modifier_t_escape($this->_sections['i']['index']); ?>
"
                                        <?php if ($this->_sections['i']['index'] == $this->_tpl_vars['period']): ?> selected<?php endif; ?>
                                        ><?php echo smarty_modifier_t_escape($this->_sections['i']['index']); ?>
</option>
                                <?php endfor; endif; ?>
                            </select> ※部屋の「日付範囲表示」で表示される日数

                        </td>
                    </tr>
<?php endif; ?>
<tr>
	<td ><input style="width:100%" type="button"  onclick="show_details()" value="詳細"></td>

</tr>

</table>



<br>
<table width=100%>
        <tr>
            <td height=60px bgcolor=#CCCCFF style='border: 1px #000000 solid;text-align:center;vertical-align:middle;font-size:15px;'>
                <b><?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_data']['hall_name']); ?>
 
                    <?php if ($this->_tpl_vars['periodmode']): ?>
                    <?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['room_name']); ?>
 (<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['max']); ?>
人)<br>
                    <?php if ($this->_tpl_vars['room_data']['type'] == 2): ?>最低<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['lowest_koma']); ?>
コマ以上<?php endif; ?>
                    <?php else: ?>
                    <?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']); ?>
日（<?php echo smarty_modifier_t_escape($this->_tpl_vars['week']); ?>
）</b>
                <?php endif; ?>
            <input type="submit" value="貸し止め更新">
            <input type="hidden" name="year" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
">
            <input type="hidden" name="month" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
">
            <input type="hidden" name="stop_user_id" id="st_user_id" value="">
            <input type="hidden" name="day" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']); ?>
">
            <input type="hidden" name="hid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
">
            <input type="hidden" name="period" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['period']); ?>
">
            <input type="hidden" name="periodmode" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['periodmode']); ?>
">
            </td>
        </tr>
    </table>

<table width=100%>

<?php $this->assign('line', 0); ?>
<?php if (! $this->_tpl_vars['periodmode']): ?>
<input type="hidden" name="room_id" value="0">
<?php $_from = $this->_tpl_vars['room_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
	<?php if (( $this->_tpl_vars['line'] % 5 ) == 0): ?>

<tr>
<th style='border: 1px #000000 solid;text-align: center;' width="150">
	部屋名
</th>
<th></th>
<?php $_from = $this->_tpl_vars['open_time']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['time']):
?>
	<th bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;' colspan=4><b>
		<?php echo smarty_modifier_t_escape($this->_tpl_vars['time']); ?>
:00 ～ <?php echo smarty_modifier_t_escape($this->_tpl_vars['time']+1); ?>
:00
	</b></th>
<?php endforeach; endif; unset($_from); ?>
</tr>

	<?php endif; ?>
	<?php $this->assign('line', smarty_modifier_t_escape($this->_tpl_vars['line']+1)); ?>
	<?php $this->assign('cb', 0); ?>

	<tr>
	<td style='border: 1px #000000 solid;text-align: center;' >
		<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['room_name']); ?>
 (<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['max']); ?>
人)
                <input type="submit" name="periodmode" value="日付範囲表示" onClick="setRoomID(<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['room_id']); ?>
)">
                
	</td>
	<td><input type="button" value=">>" onClick="linecheck(<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
)"></td>

	<?php if ($this->_tpl_vars['value']['holiday']): ?>
		<td colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['ct']*4); ?>
 style='border: 1px #000000 solid;text-align: center;' bgcolor=#FF6666><b>休室日</b></td>
		</tr>
	<?php else: ?>
		<?php if ($this->_tpl_vars['value']['type'] == 2): ?>
			<?php $_from = $this->_tpl_vars['value']['opentime']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				<td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['cs']); ?>
 
				<?php if ($this->_tpl_vars['v']['reserved']): ?>
					bgcolor=#FFDCDC><span style='color:#FF0000;'><b>
<a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('reserve_view')); ?>
&amp;reserve_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['reserved']); ?>
">
予約ID:<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['reserved']); ?>
</a><br>
代表名：<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['corp']); ?>
<br>
予約者：<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['c_member']['nickname']); ?>
 様<br>
状態：
<?php if ($this->_tpl_vars['v']['reserve_data']['tmp_flag'] == 1): ?>
	仮予約
<?php elseif ($this->_tpl_vars['v']['reserve_data']['pay_flag'] == 0 && $this->_tpl_vars['v']['reserve_data']['pay_money'] == 0): ?>
	未入金
<?php elseif ($this->_tpl_vars['v']['reserve_data']['pay_flag'] == 0 && $this->_tpl_vars['v']['reserve_data']['pay_money'] > 0): ?>
	一部入金
<?php elseif ($this->_tpl_vars['v']['reserve_data']['pay_flag'] == 1): ?>
	入金済み
<?php elseif ($this->_tpl_vars['v']['reserve_data']['pay_flag'] == 2): ?>
	過剰入金
<?php endif; ?>
</b></span>
				<?php elseif ($this->_tpl_vars['v']['stoped']): ?>
					bgcolor=#FFCCFF>貸し止め中<br>
					有効期限：<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['stoped']['limit_datetime']); ?>
<br>
					担当者：<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['stoped']['admin_name']); ?>
<br>
					<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['stoped']['memo']); ?>
<br>
					削除：<input type='checkbox' name='delete_data<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['room_id']); ?>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
_<?php echo smarty_modifier_t_escape($this->_tpl_vars['k']); ?>
' id='sd<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
_<?php echo smarty_modifier_t_escape($this->_tpl_vars['cb']); ?>
' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['stoped']['stop_id']); ?>
'>
					<?php $this->assign('cb', smarty_modifier_t_escape($this->_tpl_vars['cb']+1)); ?>
				<?php else: ?>
					>
					
					<input type='checkbox' name='stop_data<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['room_id']); ?>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
_<?php echo smarty_modifier_t_escape($this->_tpl_vars['k']); ?>
' id='sd<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
_<?php echo smarty_modifier_t_escape($this->_tpl_vars['cb']); ?>
' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_data']['hall_id']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['room_id']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']); ?>
 <?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['begin_time']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']); ?>
 <?php if ($this->_tpl_vars['v']['finish_time'] == "24:00"): ?>23:59:59<?php else: ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['finish_time']); ?>
<?php endif; ?>'>
				<?php $this->assign('cb', smarty_modifier_t_escape($this->_tpl_vars['cb']+1)); ?>
				<?php endif; ?>
				</td>
			<?php endforeach; endif; unset($_from); ?>
		<?php else: ?>
			<?php $_from = $this->_tpl_vars['value']['komawari']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				<td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['cs']); ?>
 
				<?php if ($this->_tpl_vars['v']['reserved']): ?>
					bgcolor=#FFDCDC><span style='color:#FF0000;'><b>
<a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('reserve_view')); ?>
&amp;reserve_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['reserved']); ?>
">
予約ID:<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['reserved']); ?>
</a><br>
代表名：<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['corp']); ?>
<br>
予約者：<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['c_member']['nickname']); ?>
 様<br>
状態：
<?php if ($this->_tpl_vars['v']['reserve_data']['tmp_flag'] == 1): ?>
	仮予約
<?php elseif ($this->_tpl_vars['v']['reserve_data']['pay_flag'] == 0 && $this->_tpl_vars['v']['reserve_data']['pay_money'] == 0): ?>
	未入金
<?php elseif ($this->_tpl_vars['v']['reserve_data']['pay_flag'] == 0 && $this->_tpl_vars['v']['reserve_data']['pay_money'] > 0): ?>
	一部入金
<?php elseif ($this->_tpl_vars['v']['reserve_data']['pay_flag'] == 1): ?>
	入金済み
<?php elseif ($this->_tpl_vars['v']['reserve_data']['pay_flag'] == 2): ?>
	過剰入金
<?php endif; ?>
<br>


</b></span>
				<?php elseif ($this->_tpl_vars['v']['stoped']): ?>
					bgcolor=#FFCCFF>貸し止め中<br>
					有効期限：<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['stoped']['limit_datetime']); ?>
<br>
					担当者：<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['stoped']['admin_name']); ?>
<br>
					<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['stoped']['memo']); ?>
<br>
					削除：<input type='checkbox' name='delete_data<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
_<?php echo smarty_modifier_t_escape($this->_tpl_vars['k']); ?>
' id='sd<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
_<?php echo smarty_modifier_t_escape($this->_tpl_vars['cb']); ?>
' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['stoped']['stop_id']); ?>
'>
					<?php $this->assign('cb', smarty_modifier_t_escape($this->_tpl_vars['cb']+1)); ?>
				<?php elseif ($this->_tpl_vars['v']['rest']): ?>
					bgcolor=#CDCDCD>休憩
				<?php else: ?>
					>
					<input type='checkbox' name='stop_data<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
_<?php echo smarty_modifier_t_escape($this->_tpl_vars['k']); ?>
' id='sd<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
_<?php echo smarty_modifier_t_escape($this->_tpl_vars['cb']); ?>
' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_data']['hall_id']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['room_id']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']); ?>
 <?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['begin_time']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']); ?>
 <?php if ($this->_tpl_vars['v']['finish_time'] == "24:00"): ?>23:59:59<?php else: ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['finish_time']); ?>
<?php endif; ?>'>
				<?php $this->assign('cb', smarty_modifier_t_escape($this->_tpl_vars['cb']+1)); ?>
				<?php endif; ?>
				</td>
			<?php endforeach; endif; unset($_from); ?>
		<?php endif; ?>
	<?php endif; ?>	</td>
	</tr>
<?php endforeach; endif; unset($_from); ?>

<tr>
<th style='border: 1px #000000 solid;text-align: center;' width="150">
	部屋名
</th>
<th></th>
<?php $_from = $this->_tpl_vars['open_time']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['time']):
?>
	<th bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;' colspan=4><b>
		<?php echo smarty_modifier_t_escape($this->_tpl_vars['time']); ?>
:00 ～ <?php echo smarty_modifier_t_escape($this->_tpl_vars['time']+1); ?>
:00
	</b></th>
<?php endforeach; endif; unset($_from); ?>
</tr>
 <?php else: ?>
 
 <!-- ----------------------------- -->
 
 <input type="hidden" name="room_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_id']); ?>
">
        <?php $_from = $this->_tpl_vars['period_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
            <?php if (( $this->_tpl_vars['line'] % 5 ) == 0): ?>
            <tr>
                <th style='border: 1px #000000 solid;text-align: center;' width="150">
                    日付

                </th>
                <th></th>

                <?php $_from = $this->_tpl_vars['open_time']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['time']):
?>

                <th bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;' colspan=4><b>
                        <?php echo smarty_modifier_t_escape($this->_tpl_vars['time']); ?>
:00 ～ <?php echo smarty_modifier_t_escape($this->_tpl_vars['time']+1); ?>
:00
                    </b></th>
                <?php endforeach; endif; unset($_from); ?>
            </tr>
            <?php endif; ?>
        <?php $this->assign('cb', 0); ?>

        <tr>
            <td style='border: 1px #000000 solid;text-align: center;' >
                <b><?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['year']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['month']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['day']); ?>
日（<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['week']); ?>
）</b><br />
                <?php if ($this->_tpl_vars['room_data']['type'] == 2): ?>最低<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['lowest_koma']); ?>
コマ以上<?php endif; ?><br />
                <input type="submit" value="この日を表示" onClick="setYMD(<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['year']); ?>
, <?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['month']); ?>
, <?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['day']); ?>
)">
            </td>
            <td><input type="button" value=">>" onClick="linecheck(<?php echo smarty_modifier_t_escape($this->_tpl_vars['line']); ?>
)"></td>
            <?php if ($this->_tpl_vars['value']['holiday']): ?>
            <td colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['ct']*4); ?>
 style='border: 1px #000000 solid;text-align: center;' bgcolor=#FF6666><b>休室日</b></td>
            </tr>
            <?php else: ?>
        

            <?php if ($this->_tpl_vars['room_data']['type'] == 2): ?>
                <?php $_from = $this->_tpl_vars['value']['opentime']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>

                <td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['cs']); ?>
 
                    <?php if ($this->_tpl_vars['v']['reserved']): ?>
                    bgcolor=#FFDCDC><span style='color:#FF0000;'><b>
                            <a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('reserve_view')); ?>
&amp;reserve_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['reserved']); ?>
">
                                予約ID:<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['reserved']); ?>
</a><br>
                            代表名：<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['corp']); ?>
<br>
                            予約者：<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['c_member']['nickname']); ?>
 様<br>
                            状態：
                            <?php if ($this->_tpl_vars['v']['reserve_data']['tmp_flag'] == 1): ?>
                            仮予約
                            <?php elseif ($this->_tpl_vars['v']['reserve_data']['pay_flag'] == 0 && $this->_tpl_vars['v']['reserve_data']['pay_money'] == 0): ?>
                            未入金
                            <?php elseif ($this->_tpl_vars['v']['reserve_data']['pay_flag'] == 0 && $this->_tpl_vars['v']['reserve_data']['pay_money'] > 0): ?>
                            一部入金
                            <?php elseif ($this->_tpl_vars['v']['reserve_data']['pay_flag'] == 1): ?>
                            入金済み
                            <?php elseif ($this->_tpl_vars['v']['reserve_data']['pay_flag'] == 2): ?>
                            過剰入金
                            <?php endif; ?>
                        </b></span>
                              <?php elseif ($this->_tpl_vars['v']['stoped']): ?>
					bgcolor=#FFCCFF>貸し止め中<br>
					有効期限：<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['stoped']['limit_datetime']); ?>
<br>
					担当者：<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['stoped']['admin_name']); ?>
<br>
					<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['stoped']['memo']); ?>
<br>
					削除：<input type='checkbox' name='delete_data<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
_<?php echo smarty_modifier_t_escape($this->_tpl_vars['k']); ?>
' id='sd<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
_<?php echo smarty_modifier_t_escape($this->_tpl_vars['cb']); ?>
' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['stoped']['stop_id']); ?>
'>
					<?php $this->assign('cb', smarty_modifier_t_escape($this->_tpl_vars['cb']+1)); ?>
				<?php elseif ($this->_tpl_vars['v']['rest']): ?>
					bgcolor=#CDCDCD>休憩
				<?php else: ?>
					>
					<input type='checkbox' name='stop_data<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
_<?php echo smarty_modifier_t_escape($this->_tpl_vars['k']); ?>
' id='sd<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
_<?php echo smarty_modifier_t_escape($this->_tpl_vars['cb']); ?>
' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_data']['hall_id']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_id']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['year']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['month']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['day']); ?>
 <?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['begin_time']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['year']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['month']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['day']); ?>
 <?php if ($this->_tpl_vars['v']['finish_time'] == "24:00"): ?>23:59:59<?php else: ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['finish_time']); ?>
<?php endif; ?>'>
				<?php $this->assign('cb', smarty_modifier_t_escape($this->_tpl_vars['cb']+1)); ?>
				<?php endif; ?>
                </td>
                <?php endforeach; endif; unset($_from); ?>
            <?php else: ?>
                <?php $_from = $this->_tpl_vars['value']['komawari']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                 <td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['cs']); ?>
 
                    <?php if ($this->_tpl_vars['v']['reserved']): ?>
                    bgcolor=#FFDCDC><span style='color:#FF0000;'><b>
                            <a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('reserve_view')); ?>
&amp;reserve_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['reserved']); ?>
">
                                予約ID:<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['reserved']); ?>
</a><br>
                            代表名：<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['corp']); ?>
<br>
                            予約者：<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['c_member']['nickname']); ?>
 様<br>
                            状態：
                            <?php if ($this->_tpl_vars['v']['reserve_data']['tmp_flag'] == 1): ?>
                            仮予約
                            <?php elseif ($this->_tpl_vars['v']['reserve_data']['pay_flag'] == 0 && $this->_tpl_vars['v']['reserve_data']['pay_money'] == 0): ?>
                            未入金
                            <?php elseif ($this->_tpl_vars['v']['reserve_data']['pay_flag'] == 0 && $this->_tpl_vars['v']['reserve_data']['pay_money'] > 0): ?>
                            一部入金
                            <?php elseif ($this->_tpl_vars['v']['reserve_data']['pay_flag'] == 1): ?>
                            入金済み
                            <?php elseif ($this->_tpl_vars['v']['reserve_data']['pay_flag'] == 2): ?>
                            過剰入金
                            <?php endif; ?>
                            <br>


                        </b></span>
                   <?php elseif ($this->_tpl_vars['v']['stoped']): ?>
					bgcolor=#FFCCFF>貸し止め中<br>
					有効期限：<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['stoped']['limit_datetime']); ?>
<br>
					担当者：<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['stoped']['admin_name']); ?>
<br>
					<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['stoped']['memo']); ?>
<br>
					削除：<input type='checkbox' name='delete_data<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
_<?php echo smarty_modifier_t_escape($this->_tpl_vars['k']); ?>
' id='sd<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
_<?php echo smarty_modifier_t_escape($this->_tpl_vars['cb']); ?>
' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['stoped']['stop_id']); ?>
'>
					<?php $this->assign('cb', smarty_modifier_t_escape($this->_tpl_vars['cb']+1)); ?>
				<?php elseif ($this->_tpl_vars['v']['rest']): ?>
					bgcolor=#CDCDCD>休憩
				<?php else: ?>
					>
					<input type='checkbox' name='stop_data<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
_<?php echo smarty_modifier_t_escape($this->_tpl_vars['k']); ?>
' id='sd<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
_<?php echo smarty_modifier_t_escape($this->_tpl_vars['cb']); ?>
' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_data']['hall_id']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_id']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['year']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['month']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['day']); ?>
 <?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['begin_time']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['year']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['month']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['day']); ?>
 <?php if ($this->_tpl_vars['v']['finish_time'] == "24:00"): ?>23:59:59<?php else: ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['finish_time']); ?>
<?php endif; ?>'>
				<?php $this->assign('cb', smarty_modifier_t_escape($this->_tpl_vars['cb']+1)); ?>
				<?php endif; ?>
                </td>
                <?php endforeach; endif; unset($_from); ?>
        <?php endif; ?>
        <?php endif; ?>        </td>
        </tr>
        <?php $this->assign('line', smarty_modifier_t_escape($this->_tpl_vars['line']+1)); ?>
        <?php endforeach; endif; unset($_from); ?>
       <tr>
            <th style='border: 1px #000000 solid;text-align: center;' width="150">
                部屋名
            </th>
            <th></th>

            <?php $_from = $this->_tpl_vars['open_time']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['time']):
?>

            <th bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;' colspan=4><b>
                    <?php echo smarty_modifier_t_escape($this->_tpl_vars['time']); ?>
:00 ～ <?php echo smarty_modifier_t_escape($this->_tpl_vars['time']+1); ?>
:00
                </b></th>
            <?php endforeach; endif; unset($_from); ?>
        </tr>
       


<?php endif; ?>
  
</table>
<input type="button" value=" 全選択 " onClick="allcheck(this.form,true)">
<input type="button" value=" 全解除 " onClick="allcheck(this.form,false)">

</form>

</center>

<?php else: ?>
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
<?php endif; ?>

<div>

<?php echo $this->_tpl_vars['inc_footer']; ?>

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