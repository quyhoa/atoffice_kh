<?php /* Smarty version 2.6.18, created on 2016-10-25 20:49:33
         compiled from file:/var/www/atoffice/webapp/modules/admin/templates/customer_use_state.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/atoffice/webapp/modules/admin/templates/customer_use_state.tpl', 2, false),array('modifier', 't_escape', 'file:/var/www/atoffice/webapp/modules/admin/templates/customer_use_state.tpl', 13, false),array('modifier', 'number_format', 'file:/var/www/atoffice/webapp/modules/admin/templates/customer_use_state.tpl', 67, false),array('modifier', 'round', 'file:/var/www/atoffice/webapp/modules/admin/templates/customer_use_state.tpl', 68, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminSiteMember.tpl"), $this);?>

<?php $this->assign('page_name', "顧客利用状況"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminSiteMember.tpl"), $this);?>

</div>


<?php if ($this->_tpl_vars['atoffice_auth_type'] == 2 || $this->_tpl_vars['atoffice_auth_type'] == 4): ?>

<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('customer_use_state','page')); ?>
" />

顧客特定<br>
顧客ID
<input type="text" name="c_member_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member_id']); ?>
"><br>
予約者
<input type="text" name="nickname" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['nickname']); ?>
"><br>
法人/団体名
<input type="text" name="corp" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['corp']); ?>
"><br>
利用範囲
<input type="text" name="year1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year1']); ?>
" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month1']); ?>
" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day1']); ?>
" size=2 style="text-align:right;padding-right:5px;">日 ～ 
<input type="text" name="year2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year2']); ?>
" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month2']); ?>
" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day2']); ?>
" size=2 style="text-align:right;padding-right:5px;">日
<input type="submit" value="出力">
</form>
<br>
<hr>
<h3><?php echo smarty_modifier_t_escape($this->_tpl_vars['title']); ?>
</h3>
<?php if ($this->_tpl_vars['c_member']): ?>

法人/団体名：<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['corp']); ?>
<br>
予約者：<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['nickname']); ?>
<br>
顧客ID：<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['c_member_id']); ?>
<br>
電話：<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['tel']); ?>
<br>
FAX：<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['fax']); ?>
<br>
住所：<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['address']); ?>
<br>
<br>
<?php if ($this->_tpl_vars['year1'] && $this->_tpl_vars['month1'] && $this->_tpl_vars['day1'] && $this->_tpl_vars['year2'] && $this->_tpl_vars['month2'] && $this->_tpl_vars['day2']): ?>
利用範囲：<?php echo smarty_modifier_t_escape($this->_tpl_vars['year1']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['month1']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['day1']); ?>
日 ～ <?php echo smarty_modifier_t_escape($this->_tpl_vars['year2']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['month2']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['day2']); ?>
日<br>
<br>
<?php endif; ?>

<table border=1>
<tr>
<td>予約ID</td> <!-- Title Booking ID -->
<td>利用日</td>
<td>会場</td>
<td>部屋</td>
<td>利用時間帯</td>
<td>金額</td><!-- money -->

<!-- <td>利用時間</td>
<td>用途</td> -->
</tr>
<?php $_from = $this->_tpl_vars['reserve_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
</td> <!-- Add Booking ID -->
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['date']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_name']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['time']); ?>
</td>
<td><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['total_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>
円</td>
<!-- <td><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['between_time']))) ? $this->_run_mod_handler('round', true, $_tmp) : round($_tmp)); ?>
時間</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['purpose']); ?>
</td> -->
</tr>
<?php endforeach; endif; unset($_from); ?>
<!-- <td></td>
<td></td>
<td></td>
<td>総利用時間</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['total_time']); ?>
時間</td>
<td></td>
</tr> -->
<td></td>
<td></td>
<td></td>
<td></td>
<td>合計金額</td>
<td><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_money']))) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>
円</td>
</tr>
<?php else: ?>
顧客が特定できません。
<?php endif; ?>

</td>
</tr>
</table>

</center>
<?php else: ?>
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
<?php endif; ?>
<div>
<?php echo $this->_tpl_vars['inc_footer']; ?>
