<?php /* Smarty version 2.6.18, created on 2016-12-29 07:54:03
         compiled from file:/var/www/html/atoffice/webapp/modules/admin/templates/list_c_admin_user.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/list_c_admin_user.tpl', 2, false),array('modifier', 't_escape', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/list_c_admin_user.tpl', 12, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminStatisticalInformation.tpl"), $this);?>


<?php $this->assign('page_name', "アカウント管理"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminStatisticalInformation.tpl"), $this);?>

</div>

<?php if ($this->_tpl_vars['atoffice_auth_type'] == 4): ?>

<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><?php endif; ?>
<h2>アカウント管理</h2>
<div class="contents">
<p class="info">管理用アカウントを設定します。</p>
<p class="add"><strong class="item"><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('insert_c_admin_user')); ?>
">アカウントを追加する</a></strong></p>

<table class="basicType2">
<?php ob_start(); ?>
<tr>
<th>ID</th>
<th>アカウント名</th>
<th>氏　名</th>
<th>権限</th>
<th>担当会場</th>
<th>操作</th>
<th>編集</th>
</tr>
<?php $this->_smarty_vars['capture']['table_header'] = ob_get_contents(); ob_end_clean(); ?>
<thead>
<?php echo $this->_smarty_vars['capture']['table_header']; ?>

</thead>
<tbody>
<?php $_from = $this->_tpl_vars['user_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<tr id="userID<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_admin_user_id']); ?>
">
<td class="cell01"><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_admin_user_id']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['username']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['name']); ?>
</td>
<td>
<?php if ($this->_tpl_vars['item']['atoffice_auth_type'] == '1'): ?>
初期設定担当者
<?php elseif ($this->_tpl_vars['item']['atoffice_auth_type'] == '2'): ?>
予約受付担当者
<?php elseif ($this->_tpl_vars['item']['atoffice_auth_type'] == '3'): ?>
準備担当者
<?php elseif ($this->_tpl_vars['item']['atoffice_auth_type'] == '4'): ?>
管理者
<?php else: ?>
不明な権限
<?php endif; ?>
</td>
<td class="minth">
<?php if ($this->_tpl_vars['item']['hall_id']): ?>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>

<?php else: ?>
--
<?php endif; ?>

</td>
<td><?php if ($this->_tpl_vars['item']['c_admin_user_id'] != 1): ?><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('delete_c_admin_user','do')); ?>
&amp;target_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_admin_user_id']); ?>
&amp;sessid=<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
">削除</a><?php else: ?>&nbsp;<?php endif; ?></td>
<td><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('edit_c_admin_user')); ?>
&amp;target_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_admin_user_id']); ?>
"><input type="button" style="padding: 3px;" value="変更"></a></td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</tbody>
</table>


<p class="add">各担当メニューのみ、利用できます。</p>
<p class="add"><span style="color: #FF0033;">※　管理者はすべてのメニューが利用可能です。</span></p>

<?php else: ?>
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
<?php endif; ?>
<div>
<?php echo $this->_tpl_vars['inc_footer']; ?>

<style type="text/css">
.minth{
	width: 250px;
	word-break: break-all;
}
</style>