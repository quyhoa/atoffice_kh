<?php /* Smarty version 2.6.18, created on 2016-12-15 08:18:36
         compiled from file:E:%5CA_project%5Catoffice/webapp/modules/admin/templates/send_cancel_mail_confirm.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:E:\\A_project\\atoffice/webapp/modules/admin/templates/send_cancel_mail_confirm.tpl', 2, false),array('modifier', 't_escape', 'file:E:\\A_project\\atoffice/webapp/modules/admin/templates/send_cancel_mail_confirm.tpl', 19, false),array('modifier', 'explode', 'file:E:\\A_project\\atoffice/webapp/modules/admin/templates/send_cancel_mail_confirm.tpl', 34, false),array('modifier', 'trim', 'file:E:\\A_project\\atoffice/webapp/modules/admin/templates/send_cancel_mail_confirm.tpl', 37, false),array('modifier', 'nl2br', 'file:E:\\A_project\\atoffice/webapp/modules/admin/templates/send_cancel_mail_confirm.tpl', 43, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminSiteMember.tpl"), $this);?>

<?php $this->assign('page_name', "招待メール送信"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminSiteMember.tpl"), $this);?>

</div>

<?php if ($this->_tpl_vars['atoffice_auth_type'] == 2 || $this->_tpl_vars['atoffice_auth_type'] == 4): ?>

<h2>キャンセルメール送信確認</h2>
<div class="contents">



<p class="info">【キャンセルメール】</p>

<form action="./" method="post">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('send_cancel_mail','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<input type="hidden" name="resderveid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_list']['reserve_id']); ?>
" />
<input type="hidden" name="page" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['page']); ?>
" />
<input type="hidden" name="hall_list" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_list']); ?>
" />
<input type="hidden" name="u" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member_id']); ?>
" />
<input type="hidden" name="pay_flag" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['pay_flag']); ?>
" />
<input type="hidden" name="index" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['index']); ?>
" />
<input type="hidden" name="mails" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['mails']); ?>
" />
<input type="hidden" name="subject" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['subject']); ?>
" />
<input type="hidden" name="message" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['message']); ?>
" />
<input type="hidden" name="reserveid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_id']); ?>
" />
<dl>
<dt class="mails"><strong>送信先</strong></dt>
<?php $this->assign('mail', ((is_array($_tmp=";")) ? $this->_run_mod_handler('explode', true, $_tmp, smarty_modifier_t_escape($this->_tpl_vars['mails'])) : explode($_tmp, smarty_modifier_t_escape($this->_tpl_vars['mails'])))); ?>
<dd class="mails">
<?php $_from = $this->_tpl_vars['mail']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['addr']):
?>
<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['addr']))) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)); ?>
<br />
<?php endforeach; endif; unset($_from); ?></dd>

<dt class="subject"><strong>表題</strong></dt>
<dd class="subject"><?php echo smarty_modifier_t_escape($this->_tpl_vars['subject']); ?>
</dd>
<dt class="message"><strong>本文</strong></dt>
<dd class="message"><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['message']))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</dd>
</dl>
<table><tbody><tr><td>
<p class="textBtn">
<input type="submit" name="cancel2" value="内容を修正する">
</p>
</td><td width="32"></td><td>
<p class="textBtn">
<input type="submit" name="submit2" value="この内容で送信">
</p>
</td></tbody></table>
</form>

<br class="clear" />
<?php else: ?>
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
<?php endif; ?>

<?php echo $this->_tpl_vars['inc_footer']; ?>
