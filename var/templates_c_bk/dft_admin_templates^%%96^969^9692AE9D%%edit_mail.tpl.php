<?php /* Smarty version 2.6.18, created on 2010-08-26 19:46:56
         compiled from file:/var/www/atoffice_torioki20100712/webapp/modules/admin/templates/edit_mail.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/atoffice_torioki20100712/webapp/modules/admin/templates/edit_mail.tpl', 2, false),array('modifier', 't_escape', 'file:/var/www/atoffice_torioki20100712/webapp/modules/admin/templates/edit_mail.tpl', 25, false),array('modifier', 'default', 'file:/var/www/atoffice_torioki20100712/webapp/modules/admin/templates/edit_mail.tpl', 106, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminStatisticalInformation.tpl"), $this);?>


<?php $this->assign('page_name', "メール文言変更"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminStatisticalInformation.tpl"), $this);?>

</div>


<?php if ($this->_tpl_vars['atoffice_auth_type'] == 4): ?>

<h2>メール文言変更</h2>
<div class="contents">
<p class="caution" id="c01">※Smartyテンプレート形式で記述します。</p>
<p class="caution" id="c02">誤った形式で記述すると、メールを送信することができなくなってしまいます。<br />その場合は、「デフォルトに戻す」から元に戻してください。</p>

<table class="contents" cellpadding="0" cellspacing="0" border="0">
<tr>
<td class="menu">
<dl>
<dt><strong class="item">システムメール設定</strong></dt>
<dd>
<ul>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('edit_mail')); ?>
&amp;target=inc_signature">署名</a></li>
<?php $_from = $this->_tpl_vars['pc']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('edit_mail')); ?>
&amp;target=<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
</a></li>
<?php endforeach; endif; unset($_from); ?>
</ul>
</dd>

<dt><strong class="item">会議室予約メール設定</strong></dt>
<dd>
<ul>
<?php $_from = $this->_tpl_vars['atoffice']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<li><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('edit_mail')); ?>
&amp;target=<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
</a></li>
<?php endforeach; endif; unset($_from); ?>
</ul>
</dd>

</dl>
</td>
<td class="detail">
<h3><?php if ($this->_tpl_vars['requests']['target'] == 'inc_signature'): ?>
署名
<?php elseif ($this->_tpl_vars['requests']['target'] == 'm_atoffice_syounin2'): ?>
予約承認メール内追加説明文
（
<?php if ($this->_tpl_vars['hall_name']): ?>
	<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_name']); ?>

<?php else: ?>
	会場未選択
<?php endif; ?>
）
<?php elseif ($this->_tpl_vars['pc'][$this->_tpl_vars['requests']['target']]): ?>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['pc'][$this->_tpl_vars['requests']['target']]); ?>

<?php elseif ($this->_tpl_vars['ktai'][$this->_tpl_vars['requests']['target']]): ?>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['ktai'][$this->_tpl_vars['requests']['target']]); ?>

<?php elseif ($this->_tpl_vars['admin'][$this->_tpl_vars['requests']['target']]): ?>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['admin'][$this->_tpl_vars['requests']['target']]); ?>

<?php endif; ?></h3>

<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><?php endif; ?>

<?php if ($this->_tpl_vars['requests']['target'] == 'm_atoffice_syounin2'): ?>

<form action="./" method="post">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('edit_mail','page')); ?>
" />
<input type="hidden" name="target" value="m_atoffice_syounin2">
<p id="default">
会場選択
<select name="hall_id" valign=top>
<?php $_from = $this->_tpl_vars['hall_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_id']); ?>
" <?php if ($this->_tpl_vars['item']['hall_id'] == $this->_tpl_vars['hall_id']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>

<?php endforeach; endif; unset($_from); ?>
</select>

<input type="submit" value="選択"></p>


</form>
<?php else: ?>
<p id="default"><a href="./?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('delete_mail','do')); ?>
&amp;target=<?php echo smarty_modifier_t_escape($this->_tpl_vars['requests']['target']); ?>
&amp;sessid=<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
">デフォルトに戻す</a></p>
<?php endif; ?>


<form action="./" method="post">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('update_mail','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<input type="hidden" name="target" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['requests']['target']); ?>
" />

<?php if ($this->_tpl_vars['requests']['target'] == 'm_atoffice_syounin2'): ?>
<input type="hidden" name="hall_id" value=<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
>
<?php endif; ?>

<dl>
<?php if ($this->_tpl_vars['requests']['target'] != 'inc_signature' && $this->_tpl_vars['requests']['target'] != 'm_atoffice_syounin2'): ?>
<dt><strong class="item">件名</strong></dt>
<dd><input class="basic" type="text" name="subject" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['subject']); ?>
" size="72" /></dd>
<?php endif; ?>

<?php if ($this->_tpl_vars['requests']['target'] != 'm_atoffice_syounin2' || $this->_tpl_vars['hall_id']): ?>
<dt><strong class="item">本文</strong></dt>
<dd><textarea name="body" cols="<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['cols']))) ? $this->_run_mod_handler('default', true, $_tmp, 72) : smarty_modifier_default($_tmp, 72)); ?>
" rows="<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['rows']))) ? $this->_run_mod_handler('default', true, $_tmp, 30) : smarty_modifier_default($_tmp, 30)); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['body']); ?>
</textarea></dd>
</dl>
<p class="textBtn"><input type="submit" value="変更する"></p>
<?php endif; ?>
</form>
</td>
</tr>
</table>

<?php else: ?>
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
<?php endif; ?>
<div>
<?php echo $this->_tpl_vars['inc_footer']; ?>

