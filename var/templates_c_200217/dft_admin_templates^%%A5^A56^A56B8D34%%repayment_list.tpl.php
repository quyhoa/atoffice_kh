<?php /* Smarty version 2.6.18, created on 2016-12-15 03:46:03
         compiled from file:E:%5CA_project%5Catoffice/webapp/modules/admin/templates/repayment_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:E:\\A_project\\atoffice/webapp/modules/admin/templates/repayment_list.tpl', 2, false),array('modifier', 't_escape', 'file:E:\\A_project\\atoffice/webapp/modules/admin/templates/repayment_list.tpl', 88, false),array('modifier', 'nl2br', 'file:E:\\A_project\\atoffice/webapp/modules/admin/templates/repayment_list.tpl', 226, false),array('modifier', 't_url2cmd', 'file:E:\\A_project\\atoffice/webapp/modules/admin/templates/repayment_list.tpl', 226, false),array('modifier', 't_cmd', 'file:E:\\A_project\\atoffice/webapp/modules/admin/templates/repayment_list.tpl', 226, false),array('modifier', 't_decoration', 'file:E:\\A_project\\atoffice/webapp/modules/admin/templates/repayment_list.tpl', 226, false),array('modifier', 'default', 'file:E:\\A_project\\atoffice/webapp/modules/admin/templates/repayment_list.tpl', 267, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminStatisticalInformation.tpl"), $this);?>

<?php $this->assign('page_name', "未返金処理リスト"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminStatisticalInformation.tpl"), $this);?>

</div>



<?php if ($this->_tpl_vars['atoffice_auth_type'] == 4): ?>

<script type="text/javascript">
function repay_confirm(){

}

function showDialog(id)
{
    var mail_flagA=document.getElementById("mail_flagA"+id);
    if(mail_flagA.checked)
    {
        document.getElementById("dialog_id").value=id;
        var overlay = document.getElementById("overlay");
        overlay.style.display="block";
        var idDialog = "dialog_"+id;
        var dialog = document.getElementById(idDialog);
        dialog.style.display="block";
      
    }
    else
    {
        document.getElementById("dialog_id").value=id;
        var overlay = document.getElementById("overlay");
        overlay.style.display="block";
        var idDialog = "dialogA_"+id;
        var dialog = document.getElementById(idDialog);
        dialog.style.display="block";
    }
}

function closeDialog(id)
{
      
    var overlay = document.getElementById("overlay");
    overlay.style.display="none";
    var idDialog = "dialog_"+id;
    var dialog = document.getElementsByClassName("dialog");
    var diaogId= document.getElementById("dialog_id");
    var id = diaogId.innerHTML;
    var dialog = document.getElementById(idDialog);
    dialog.style.display="none";
   
   
}

function closeDialog1(id)
{
    var overlay = document.getElementById("overlay");
    overlay.style.display="none";
    var idDialog = "dialogA_"+id;
    var dialog = document.getElementsByClassName("dialog");
    var diaogId= document.getElementById("dialog_id");
    var id = diaogId.innerHTML;
    var dialog = document.getElementById(idDialog);
    dialog.style.display="none";
}
function closeAllDialog()
{
      
    var overlay = document.getElementById("overlay");
    overlay.style.display="none";
    var id =document.getElementById("dialog_id").value;
    var idDialog = "dialog_"+id;
    var dialog = document.getElementById(idDialog);
    dialog.style.display="none";
    var idDialogA= "dialogA_"+id;
    var dialogA = document.getElementById(idDialogA);
    dialogA.style.display="none";
    return false;
   
   
}
</script>

<h2 id="ttl01">未返金処理リスト　(
<?php if ($this->_tpl_vars['repayment_list']): ?>
	<?php echo smarty_modifier_t_escape($this->_tpl_vars['num']); ?>
件中　<?php echo smarty_modifier_t_escape($this->_tpl_vars['index']+1); ?>
件～
	<?php if ($this->_tpl_vars['index'] + 10 > $this->_tpl_vars['num']): ?>
		<?php echo smarty_modifier_t_escape($this->_tpl_vars['num']); ?>

	<?php else: ?>
		<?php echo smarty_modifier_t_escape($this->_tpl_vars['index']+10); ?>

	<?php endif; ?>
	件を表示
<?php else: ?>
	0件
<?php endif; ?>

)</h2>
<br>
<center>

<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><br><br><?php endif; ?>

<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('repayment_list','page')); ?>
" />

<table border="1" width="800">
<tr>
<td colspan=4 bgcolor=#CDCDCD>検索オプション</td>
</tr>
<tr>
<th bgcolor=#FFD9DC>返金額</th>
<th bgcolor=#FFD9DC>予約ID</th>
<th bgcolor=#FFD9DC>返金登録日時範囲指定(年-月-日)</th>
<td rowspan=2 bgcolor=#FFD9DC>
<input type="submit" value="検索する">
</td>
</tr>
<tr>
<td>
<input type="text" name="repayment_money" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['repayment_money']); ?>
" size=5 style="text-align:right;padding-right:5px;">円以上
</td>
<td>
<input type="text" name="reserve_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_id']); ?>
">
</td>
<td>
<input type="text" name="begin_date" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['begin_date']); ?>
" size="8"> ～
<input type="text" name="finish_date" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['finish_date']); ?>
" size="8">
</td>
</tr>
</table>

</form>
<br>
<?php $_from = $this->_tpl_vars['page_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<?php if ($this->_tpl_vars['item']['select']): ?>
	<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['page']); ?>

<?php else: ?>
	<a href="./?m=admin&a=page_repayment_list&repayment_money=<?php echo smarty_modifier_t_escape($this->_tpl_vars['repayment_money']); ?>
&reserve_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_id']); ?>
&begin_date=<?php echo smarty_modifier_t_escape($this->_tpl_vars['begin_date']); ?>
&finish_date=<?php echo smarty_modifier_t_escape($this->_tpl_vars['finish_date']); ?>
&index=<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['index']); ?>
" ><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['page']); ?>
</a>
<?php endif; ?>
|
<?php endforeach; endif; unset($_from); ?>
<hr>

<?php $_from = $this->_tpl_vars['repayment_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<table border="1" width="800" class="table_popup">
<tr>
<td colspan=4 bgcolor=#CCFFFF>
<center>
■ 予約ID <?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
 ■　返金登録日時<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['add_datetime']); ?>

</center>
</td>
</tr>
<tr>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>返金額</span></td>
<td><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['repayment_money']); ?>
 円</span></td>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>E-mail</span></td>
<td><span style='margin:5px;'>
<a href="mailto:<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['mail']); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['mail']); ?>
</a>
</span></td>
</td>
</tr>

<tr>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>氏名</span></td>
<td><span style='margin:5px;'>
<a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('c_member_detail')); ?>
&amp;target_c_member_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_member']['c_member_id']); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_member']['nickname']); ?>
</a>
</span></td>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>法人・個人名</span></td>
<td><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['corp']); ?>
</span></td>
</td>
</tr>

<tr>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>利用施設</span></td>
<td><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>
</span></td>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>部屋名</span></td>
<td><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_name']); ?>
</span></td>
</td>
</tr>

<tr>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>仮予約申込日</span></td>
<td><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_data']['tmp_reserve_datetime']); ?>
</span></td>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>予約承認日</span></td>
<td><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_data']['reserve_datetime']); ?>
</span></td>
</td>
</tr>

<tr>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>利用開始時間</span></td>
<td><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_data']['begin_datetime']); ?>
</span></td>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>利用終了時間</span></td>
<td><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_data']['finish_datetime']); ?>
</span></td>
</td>
</tr>

<tr>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>入金締切日</span></td>
<td><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_data']['pay_limitdate']); ?>
</span></td>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>キャンセル日</span></td>
<td><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_data']['cancel_datetime']); ?>
</span></td>
</td>
</tr>

<tr>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>利用金額</span></td>
<td><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_data']['total_price']); ?>
 円</span></td>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>入金済み金額</span></td>
<td><span style='margin:5px; float: left'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_data']['pay_money']); ?>
 円</span>
    <!-- <table style="border-collapse:collapse; height: 26px;">
        <tr>
            <td style="border-right:1px solid; border-left:1px solid" bgcolor=#FFD9DC width=100><span style='margin:5px;'>過剰入金</span></td>
            <td><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_data']['total']); ?>
 円</span></td>
        </tr>
    </table> -->
</td>
</td>
</tr>

<tr>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>理由</span></td>
<td colspan=3 align=left><span style='margin:5px;'>
<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['info']))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('t_url2cmd', true, $_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id'])) : smarty_modifier_t_url2cmd($_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id']))))) ? $this->_run_mod_handler('t_cmd', true, $_tmp, 'diary') : smarty_modifier_t_cmd($_tmp, 'diary')))) ? $this->_run_mod_handler('t_decoration', true, $_tmp) : smarty_modifier_t_decoration($_tmp)); ?>

</span></td>
</tr>

<tr>
<td colspan=4>

<center>
   
    <form id="form<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
">
        <input type='button' value='返金済みにする' onclick="showDialog(<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
);"> 
      	<input type="radio" name="mail_flag<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
" id="mail_flagA<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
" value="1" checked>メールする
    	<input type="radio" name="mail_flag<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
" id="mail_flagB<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
" value="0">メールしない
    </form>  
   <?php $_from = $this->_tpl_vars['arrayBody']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['mail_item']):
?>
   
   <?php if ($this->_tpl_vars['item']['reserve_id'] == $this->_tpl_vars['mail_item']['reserve_id']): ?>
    <form id="formA<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
" name="add_payment" method="POST" action="./">
        <div style="display: none;background:#fff;height:550px;width:700px;padding:10px;" class="dialog" id="dialog_<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
">
             <table align="center" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
    			<tbody>
    				<tr>
    					<td>
                            <input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
            	            <input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('repayment','do')); ?>
" />
            	            <input type="hidden" name="repayment_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['repayment_id']); ?>
">	
                            <input type="hidden" name="reserve_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
">
                            <input type="hidden" name="repayment_money" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['repayment_money']); ?>
" />
                        	<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
                           	<input id="txtEmail" type="hidden" name="txtEmail" value="1"/>
                        </td>
    				</tr>
    				<tr>
    					<td style="text-align: center;">&nbsp</td>
    				</tr>
    				<tr>
    					<td style="text-align: center;">
                           <dt>
                                 <strong class="item">本文</strong>
                           </dt>
                           <dd>
                                <textarea name="body" cols="<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['cols']))) ? $this->_run_mod_handler('default', true, $_tmp, 72) : smarty_modifier_default($_tmp, 72)); ?>
" rows="<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['rows']))) ? $this->_run_mod_handler('default', true, $_tmp, 30) : smarty_modifier_default($_tmp, 30)); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['mail_item']['body']); ?>
</textarea>
                           </dd>
                        </td>
    				</tr>
                    <tr>
    					<td style="text-align: center;">&nbsp</td>
    				</tr>
    				<tr>
    					<td style="text-align: center;">
    						<input name="OK" type="submit" value="送信"  onclick="return closeDialog(<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
);"/>&nbsp;
                            <input name="Cancel" type="button" value="戻る" onclick="return closeDialog(<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
);"/>
                        </td>
    				</tr>
    			</tbody>
    		</table>
        </div>
        </form>  
        <form id="formB<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
" name="add_payment" method="POST" action="./">
        <div style="display: none;background:#fff;height:100px;width:200px;padding:10px;" class="dialog1" id="dialogA_<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
">
             <table align="center" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
    			<tbody>
    				<tr>
    					<td>
                            <input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
            	            <input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('repayment','do')); ?>
" />
            	            <input type="hidden" name="repayment_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['repayment_id']); ?>
">	
                            <input type="hidden" name="reserve_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
">
                            <input type="hidden" name="repayment_money" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['repayment_money']); ?>
" />
                        	<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
                           	<input id="txtEmail" type="hidden" name="txtEmail" value="0" />
                        </td>
    				</tr>
    				<tr>
    					<td style="text-align: center;">&nbsp</td>
    				</tr>
    				<tr>
    					<td style="text-align: center;">
                        返金済みにしますか？
                        </td>
    				</tr>
                    <tr>
    					<td style="text-align: center;">&nbsp</td>
    				</tr>
    				<tr>
    					<td style="text-align: center;">
    						<input name="OK" type="submit" value="OK" onclick="return closeDialog1(<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
);"/>&nbsp;
                            <input name="Cancel" type="button" value="キャンセル" onclick="return closeDialog1(<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
);"/>
                        </td>
    				</tr>
    			</tbody>
    		</table>
        </div>
        </form> 
         <?php endif; ?>
   
     <?php endforeach; endif; unset($_from); ?>
     
</center>
</td>
</tr>
</table>
<br>
<?php endforeach; else: ?>
未返金データはありませんでした。
<?php endif; unset($_from); ?>
<hr>
<?php $_from = $this->_tpl_vars['page_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<?php if ($this->_tpl_vars['item']['select']): ?>
	<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['page']); ?>

<?php else: ?>
	<a href="./?m=admin&a=page_repayment_list&repayment_money=<?php echo smarty_modifier_t_escape($this->_tpl_vars['repayment_money']); ?>
&reserve_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_id']); ?>
&begin_date=<?php echo smarty_modifier_t_escape($this->_tpl_vars['begin_date']); ?>
&finish_date=<?php echo smarty_modifier_t_escape($this->_tpl_vars['finish_date']); ?>
&index=<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['index']); ?>
" ><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['page']); ?>
</a>
<?php endif; ?>
|
<?php endforeach; endif; unset($_from); ?>


</center>
<?php else: ?>
<br>
<center>
<span style="font-size: 16px; color: #FF0033;">
    <b>アクセス権がありません。</b>
</span>
</center>
<?php endif; ?>
<div>
<?php echo $this->_tpl_vars['inc_footer']; ?>

<div id="overlay" class="web_dialog_overlay" onclick="return closeAllDialog()">
    <input hidden="" value="" id="dialog_id">
</div>
<style>
table.table_popup{
    margin:0;
    position:relative;
}
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
    right: 100;
    top: 0;
    width: 100%;
    z-index: 101;
}
.dialog{
    position: absolute;
    width: 200px;
    z-index: 300;
    background:#FFFFFF;
    left:10%;
    top:0%;
    border: 2px solid #000;
    border-radius:5px;
}

.dialog1{
    position: absolute;
    width: 200px;
    z-index: 300;
    background:#FFFFFF;
    left:35%;
    top:60%;
    border: 2px solid #000;
    border-radius:5px;
}
</style>