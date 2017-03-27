<?php /* Smarty version 2.6.18, created on 2017-03-02 19:19:46
         compiled from file:/var/www/html/atoffice/webapp/modules/admin/templates/mail_check.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 't_escape', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/mail_check.tpl', 29, false),array('modifier', 'default', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/mail_check.tpl', 55, false),)), $this); ?>
<?php if ($this->_tpl_vars['atoffice_auth_type'] == 2 || $this->_tpl_vars['atoffice_auth_type'] == 4): ?>

<script language="javascript">
<!--
function new_win(reserve_id){
window.open("./?m=admin&a=page_mail_check&reserve_id="+reserve_id,"","width=350,height=300,scrollbars=yes");
}

function confirm1(){
	if(window.confirm('送信せずに閉じてもよろしいですか？')){
		window.close();
	}else{
		return false;
	}
}


//-->
</script>

<STYLE TYPE=text/css><!-- BODY{FILTER: progid:DXImageTransform.Microsoft.Gradient(startColorstr=#FFFFFF, endColorstr=#A9A9A9, gradienttype=0)}--></STYLE>

<h2 id="ttl01">承認メール確認 </h2>
<br>

<center>
<?php if ($this->_tpl_vars['msg']): ?>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
<br><br>
<input type="button" value="閉じる" onClick="window.close();">
<?php else: ?>
<form name="send_mail" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('a_send_mail','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />


<table border=1>
<tr>
<td bgcolor="#CCFFAA">件名</td>
<td bgcolor="#FFFFFF">
<input type="text" name="subject" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['subject']); ?>
" size=80>
</td>
</tr>
<tr>
<td bgcolor="#CCFFAA">宛先</td>
<td bgcolor="#FFFFFF">
<input type="text" name="mail" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['mail']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['ml']); ?>
" size=80>
(カンマ区切り)
</td>
</tr>
<tr>
<td bgcolor="#CCFFAA">本文</td>
<td bgcolor="#FFFFFF">
<textarea id="mce_editor_textarea" name="body" rows="<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['_rows']))) ? $this->_run_mod_handler('default', true, $_tmp, '35') : smarty_modifier_default($_tmp, '35')); ?>
" cols="<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['_cols']))) ? $this->_run_mod_handler('default', true, $_tmp, '85') : smarty_modifier_default($_tmp, '85')); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['body']); ?>
</textarea>
</td>
</tr>
</table>

<br>

<input type="submit" value="　送　信　">

</from>

<input type="button" value="送信せずに閉じる" onClick="return confirm1();">
<?php endif; ?>
</center>
<?php else: ?>
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
<?php endif; ?>