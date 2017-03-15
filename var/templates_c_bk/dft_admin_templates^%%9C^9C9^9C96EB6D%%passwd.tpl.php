<?php /* Smarty version 2.6.18, created on 2015-11-30 10:34:32
         compiled from file:/var/www/atoffice/webapp/modules/admin/templates/passwd.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/atoffice/webapp/modules/admin/templates/passwd.tpl', 2, false),array('function', 't_url', 'file:/var/www/atoffice/webapp/modules/admin/templates/passwd.tpl', 18, false),array('modifier', 't_escape', 'file:/var/www/atoffice/webapp/modules/admin/templates/passwd.tpl', 5, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminSiteMember.tpl"), $this);?>


<?php $this->assign('parent_page_name', "メンバーリスト"); ?>
<?php ob_start(); ?>?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('list_c_member')); ?>
<?php $this->_smarty_vars['capture']['parent_page_url'] = ob_get_contents(); ob_end_clean(); ?>

<?php $this->assign('page_name', "パスワード再発行"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminSiteMember.tpl"), $this);?>

</div>



<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><?php endif; ?>
<h2>パスワード再発行</h2>
<div class="contents">

<p class="info"><a href="<?php echo smarty_function_t_url(array('_absolute' => 1,'m' => 'pc','a' => 'page_f_home'), $this);?>
&amp;target_c_member_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['c_member_id']); ?>
" target="_blank"><?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['nickname']); ?>
</a>さんのパスワードを変更します。</p>
<ul class="caution">
<li>パスワードは6～12文字の半角英数で入力してください。</li>
<li>パスワード変更ボタンを押すと、メンバーに新しいパスワードの書かれたメールが送信されます。</li>
</ul>

<form action="./" method="post">
<table>
<tr>
<th>
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('passwd','do')); ?>
" />
<input type="hidden" name="target_c_member_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['c_member_id']); ?>
" />
新しいパスワード</th>
<td>：<input type="password" name="password" size="12" /></td>
</tr>
<tr>
<th>新しいパスワード(確認)</th>
<td>：<input type="password" name="password2" size="12" /></td>
</tr>
</table>
<p class="textBtn"><input type="submit" value="パスワード変更" /></p>
</form>

<p class="groupLing"><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('list_c_member')); ?>
" onClick="history.back(); return false;" onKeyPress="history.back(); return false;">前のページに戻る</a></p>
<?php echo $this->_tpl_vars['inc_footer']; ?>
