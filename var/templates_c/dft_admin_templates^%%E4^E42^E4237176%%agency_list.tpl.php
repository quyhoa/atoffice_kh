<?php /* Smarty version 2.6.18, created on 2017-03-23 19:04:55
         compiled from file:/var/www/html/atoffice/webapp/modules/admin/templates/agency_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/agency_list.tpl', 2, false),array('modifier', 't_escape', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/agency_list.tpl', 18, false),array('modifier', 'nl2br', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/agency_list.tpl', 67, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminStatisticalInformation.tpl"), $this);?>

<?php $this->assign('page_name', "代理店値引き管理"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminStatisticalInformation.tpl"), $this);?>

</div>
<style>
	.txt_center{
		text-align: center;
	}
	.clss_p{
		padding-bottom: 3px !important;
	}
</style>
<?php if ($this->_tpl_vars['atoffice_auth_type'] == 4): ?>

<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><?php endif; ?>
<h2>代理店値引き管理</h2>
<div class="contents">


<table class="basicType2">
<?php ob_start(); ?>
<tr>
<th>ID</th>
<th>氏名</th>
<th>法人/団体名</th>
<th>会場指定</th>
<th>会場</th>
<th>値引き率</th>
<th>備考</th>
<th>操作</th>
</tr>
<?php $this->_smarty_vars['capture']['table_header'] = ob_get_contents(); ob_end_clean(); ?>
<thead>
<?php echo $this->_smarty_vars['capture']['table_header']; ?>

</thead>
<tbody>
<?php $_from = $this->_tpl_vars['c_agencylist_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<?php if ($this->_tpl_vars['item']): ?>
<tr>
<td class="cell01"><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_member_id']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['nickname']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['corporation']); ?>
</td>
<td class="txt_center"><?php if ($this->_tpl_vars['item']['type']): ?> あり <?php else: ?> なし <?php endif; ?></td>
<td class="txt_center">
<?php if ($this->_tpl_vars['item']['hall_list_name'] !== null): ?>
<?php $_from = $this->_tpl_vars['item']['hall_list_name']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['hall_name']):
?>
<p class="clss_p"><?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_name']); ?>
</p>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
</td>
<td>
<?php if ($this->_tpl_vars['item']['type'] == 0): ?>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['percent']); ?>
%引き
<?php else: ?>

<?php if ($this->_tpl_vars['item']['hall_list_percent'] !== null): ?>
<?php $_from = $this->_tpl_vars['item']['hall_list_percent']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['hall_pecent']):
?>
<p class="clss_p"><?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_pecent']); ?>
%引き</p>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>

<?php endif; ?>
</td>
<td><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['info']))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</td>
<td>
<ul>
<li><a href='?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('agencylist_edit','page')); ?>
&amp;target_c_agencylist_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['agency_id']); ?>
'>編集</a></li>
<li><a href='?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('agencylist_delete_confirm','page')); ?>
&amp;target_c_agencylist_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['agency_id']); ?>
'>代理店値引きから外す</a></li>
</ul>
</td>
</tr>
<?php endif; ?>
<?php endforeach; else: ?>
<tr>
<td colspan="5">代理店値引きは登録されていません</td>
</tr>
<?php endif; unset($_from); ?>
</table>

<?php if ($this->_tpl_vars['c_agencylist_list']): ?>
<div class="listControl" id="pager02">
<?php echo $this->_smarty_vars['capture']['pager']; ?>

</div>
<?php endif; ?>

<?php else: ?>
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
<?php endif; ?>
<div>

<?php echo $this->_tpl_vars['inc_footer']; ?>
