<?php /* Smarty version 2.6.18, created on 2017-01-06 02:38:43
         compiled from file:/var/www/html/atoffice/webapp/modules/admin/templates/agencylist_edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/agencylist_edit.tpl', 2, false),array('modifier', 't_escape', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/agencylist_edit.tpl', 5, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminSiteMember.tpl"), $this);?>

<?php $this->assign('page_name', "代理店値引き編集"); ?>
<?php $this->assign('parent_page_name', "代理店値引き管理"); ?>
<?php ob_start(); ?>?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('blacklist')); ?>
<?php $this->_smarty_vars['capture']['parent_page_url'] = ob_get_contents(); ob_end_clean(); ?>

<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminSiteMember.tpl"), $this);?>

</div>


<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><?php endif; ?>
<h2>代理店値引き編集</h2>
<div class="contents">

<p class="caution">※部屋の値段から割引されます。（ログイン必須）。</p>

<form name="add_blacklist" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('add_agency','do')); ?>
" />
<input type="hidden" name="page" value="agencylist_edit" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<input type="hidden" name="c_member_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['agencylist']['c_member_id']); ?>
">

<table class="basicType2">
<tbody>
<tr>
<th>氏名</th>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['agencylist']['nickname']); ?>
</td>
</tr>
<tr>
<th>値引き率</th>
<td><input type="text" name="percent" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['agencylist']['percent']); ?>
" size=10> ％引き</td>
</tr>
<tr>
<th>備考</th>
<td><textarea class="basic" name="info" cols="30" rows="3"><?php echo smarty_modifier_t_escape($this->_tpl_vars['agencylist']['info']); ?>
</textarea></td>
</tr>
</tbody>
</table>

<p class="textBtn"><input type="submit" class="submit" value="　決　定　" /></p>
</form>

<?php echo $this->_tpl_vars['inc_footer']; ?>
