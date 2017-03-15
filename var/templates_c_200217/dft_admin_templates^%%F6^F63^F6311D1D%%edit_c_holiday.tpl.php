<?php /* Smarty version 2.6.18, created on 2016-11-17 20:05:21
         compiled from file:/var/www/atoffice/webapp/modules/admin/templates/edit_c_holiday.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/atoffice/webapp/modules/admin/templates/edit_c_holiday.tpl', 2, false),array('modifier', 't_escape', 'file:/var/www/atoffice/webapp/modules/admin/templates/edit_c_holiday.tpl', 13, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminStatisticalInformation.tpl"), $this);?>


<?php $this->assign('page_name', "祝日設定"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminStatisticalInformation.tpl"), $this);?>

</div>


<?php if ($this->_tpl_vars['atoffice_auth_type'] == 4): ?>

<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><?php endif; ?>
<h2>祝日設定</h2>
<div class="contents">

<p>祝日名称と祝日を設定してください。</p>

<table class="basicType2">
<thead>
<tr>
<th>祝日名称</th>
<th>祝日</th>
<th colspan="2">操作</th>
</tr>
</thead>
<tbody>
<?php $_from = $this->_tpl_vars['c_holiday_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<tr>
<form action="./" method="post">
<td>
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
">
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('update_c_holiday','do')); ?>
">
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
">
<input type="hidden" name="c_holiday_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_holiday_id']); ?>
">
<input type="text" class="basic" name="name" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['name']); ?>
" size="20"></td>
<td><select class="basic" name="month">
<?php $_from = $this->_tpl_vars['month_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['monthvalue']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['monthvalue']); ?>
"<?php if ($this->_tpl_vars['monthvalue'] == $this->_tpl_vars['item']['month']): ?> selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['monthvalue']); ?>

<?php endforeach; endif; unset($_from); ?>
</select>月
<select class="basic" name="day">
<?php $_from = $this->_tpl_vars['day_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['dayvalue']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['dayvalue']); ?>
"<?php if ($this->_tpl_vars['dayvalue'] == $this->_tpl_vars['item']['day']): ?> selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['dayvalue']); ?>

<?php endforeach; endif; unset($_from); ?>
</select>日</td>
<td><span class="textBtnS"><input type="submit" value="　変　更　"></span></td>
</form>
<form action="./" method="post">
<td>
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
">
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('delete_c_holiday','do')); ?>
">
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
">
<input type="hidden" name="c_holiday_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_holiday_id']); ?>
">
<span class="textBtnS"><input type="submit" class="submit" value="　削　除　"></span>
</td>
</form>
</tr>
<?php endforeach; endif; unset($_from); ?>
<tr>
<form action="./" method="post">
<td>
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
">
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('insert_c_holiday','do')); ?>
">
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
">
<input type="text" class="basic" name="name" value="" size="20"></td>
<td><select class="basic" name="month">
<?php $_from = $this->_tpl_vars['month_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['monthvalue']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['monthvalue']); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['monthvalue']); ?>

<?php endforeach; endif; unset($_from); ?>
</select>月
<select class="basic" name="day">
<?php $_from = $this->_tpl_vars['day_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['dayvalue']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['dayvalue']); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['dayvalue']); ?>

<?php endforeach; endif; unset($_from); ?>
</select>日</td>
<td colspan="2"><span class="textBtnS"><input type="submit" value="項目追加"></span></td>
</form>
</tr>
</tbody>
</table>

<?php else: ?>
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
<?php endif; ?>
<div>
<?php echo $this->_tpl_vars['inc_footer']; ?>
