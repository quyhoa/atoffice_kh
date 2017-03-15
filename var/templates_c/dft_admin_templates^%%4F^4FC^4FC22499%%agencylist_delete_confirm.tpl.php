<?php /* Smarty version 2.6.18, created on 2017-03-14 05:04:04
         compiled from file:E:%5CA_project%5Catoffice_kh/webapp/modules/admin/templates/agencylist_delete_confirm.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:E:\\A_project\\atoffice_kh/webapp/modules/admin/templates/agencylist_delete_confirm.tpl', 2, false),array('modifier', 't_escape', 'file:E:\\A_project\\atoffice_kh/webapp/modules/admin/templates/agencylist_delete_confirm.tpl', 5, false),array('modifier', 'nl2br', 'file:E:\\A_project\\atoffice_kh/webapp/modules/admin/templates/agencylist_delete_confirm.tpl', 29, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminSiteMember.tpl"), $this);?>

<?php $this->assign('page_name', "代理店値引き削除確認"); ?>
<?php $this->assign('parent_page_name', "代理店値引き管理"); ?>
<?php ob_start(); ?>?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('blacklist')); ?>
<?php $this->_smarty_vars['capture']['parent_page_url'] = ob_get_contents(); ob_end_clean(); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminSiteMember.tpl"), $this);?>

</div>


<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><?php endif; ?>
<h2>代理店値引き削除確認</h2>
<div class="contents">

<p>以下の内容を削除します。よろしいですか？</p>

<table class="basicType2">
<tbody>
<tr>
<th>氏名</th>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['agencylist']['nickname']); ?>
</td>
</tr>
<tr>
<th>割引き率</th>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['agencylist']['percent']); ?>
%</td>
</tr>
<tr>
<th>備考</th>
<td width="250"><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['agencylist']['info']))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</td>
</tr>
</tbody>
</table>

<form action="./" method="post">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('delete_c_agencylist','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<input type="hidden" name="c_member_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['agencylist']['c_member_id']); ?>
" />
<input type="hidden" name="target_c_agencylist_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['agencylist']['agency_id']); ?>
" />
<p class="textBtn"><input type="submit" class="submit" value="　は　い　" /></p>
</form>

<form action="./" method="post">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('agency_list')); ?>
" />
<p class="textBtn"><input type="submit" class="submit" value="　いいえ　" /></p>
</form>

<?php echo $this->_tpl_vars['inc_footer']; ?>
