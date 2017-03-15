<?php /* Smarty version 2.6.18, created on 2016-12-15 07:48:56
         compiled from file:E:%5CA_project%5Catoffice/webapp/modules/admin/templates/edit_point.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:E:\\A_project\\atoffice/webapp/modules/admin/templates/edit_point.tpl', 2, false),array('function', 't_url', 'file:E:\\A_project\\atoffice/webapp/modules/admin/templates/edit_point.tpl', 23, false),array('modifier', 't_escape', 'file:E:\\A_project\\atoffice/webapp/modules/admin/templates/edit_point.tpl', 7, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminSiteMember.tpl"), $this);?>

<?php $this->assign('page_name', "メンバーリスト：ポイント強制変更"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminSiteMember.tpl"), $this);?>

</div>

<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><?php endif; ?>
<h2>ポイント強制変更</h2>

<div class="contents">

<p>選択したメンバーのポイントを強制的に変更します。</p>

<form action="./" method="post" enctype="multipart/form-data">
<table class="basicType2">
<tbody>
<tr>
<th>メンバーID</th>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_member_id']); ?>
</td>
</tr>
<tr>
<th><?php echo smarty_modifier_t_escape($this->_tpl_vars['WORD_NICKNAME']); ?>
</th>
<td><a href="<?php echo smarty_function_t_url(array('_absolute' => 1,'m' => 'pc','a' => 'page_f_home'), $this);?>
&amp;target_c_member_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_member_id']); ?>
" target="_blank"><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['nickname']); ?>
</a></td>
</tr>
<tr>
<th>
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('update_point','do')); ?>
" />
<input type="hidden" name="target_c_member_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_member_id']); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
ポイント</th>
<td>
<input type="text" name="point" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['point']); ?>
"></td>
</tr>
<tr>
<td colspan="3" align="right"><span class="textBtnS"><input type="submit" class="submit" value="　変　更　"></span></td>
</tr>
</tbody>
</table>
</form>

<?php echo $this->_tpl_vars['inc_footer']; ?>
