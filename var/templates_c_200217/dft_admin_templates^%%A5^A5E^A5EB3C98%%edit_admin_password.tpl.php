<?php /* Smarty version 2.6.18, created on 2016-10-29 08:39:33
         compiled from file:/var/www/atoffice/webapp/modules/admin/templates/edit_admin_password.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/atoffice/webapp/modules/admin/templates/edit_admin_password.tpl', 2, false),array('modifier', 't_escape', 'file:/var/www/atoffice/webapp/modules/admin/templates/edit_admin_password.tpl', 10, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminAdminConfig.tpl"), $this);?>


<?php $this->assign('page_name', "パスワード変更"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminAdminConfig.tpl"), $this);?>

</div>


<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><?php endif; ?>
<h2>パスワード変更</h2>
<div class="contents">
<p class="info">管理画面用のパスワードを変更します。</p>
<p class="caution" id="c01">※パスワードは6～12文字の半角英数で入力してください。</p>
<form action="./" method="post">
<table class="basicType1">
<tr>
<th>
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('update_c_admin_user_password','do')); ?>
" />
現在のパスワード</th>
<td><input class="basic" type="password" name="old_password" value="" /></td>
</tr>
<tr>
<th>新しいパスワード</th>
<td><input class="basic" type="password" name="new_password" value="" /></td>
</tr>
<tr>
<th>新しいパスワード(確認)</th>
<td><input class="basic" type="password" name="new_password2" value="" /></td>
</tr>
</table>
<p class="textBtn"><input type="submit" value="変更する"></p>
</form>

<?php echo $this->_tpl_vars['inc_footer']; ?>
