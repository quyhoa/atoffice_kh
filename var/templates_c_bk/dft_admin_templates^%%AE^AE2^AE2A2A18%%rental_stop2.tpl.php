<?php /* Smarty version 2.6.18, created on 2016-03-08 14:04:12
         compiled from file:/var/www/atoffice/webapp/modules/admin/templates/rental_stop2.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/atoffice/webapp/modules/admin/templates/rental_stop2.tpl', 2, false),array('modifier', 't_escape', 'file:/var/www/atoffice/webapp/modules/admin/templates/rental_stop2.tpl', 24, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminDesign.tpl"), $this);?>

<?php $this->assign('page_name', "貸し止め(準備担当)"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminDesign.tpl"), $this);?>

</div>


<?php if ($this->_tpl_vars['atoffice_auth_type'] == 2 || $this->_tpl_vars['atoffice_auth_type'] == 3 || $this->_tpl_vars['atoffice_auth_type'] == 4): ?>

<style type="text/css">
<!--
HR {
	border-style:dotted;color:#3399FF

}
-->
</style>

<h2 id="ttl01">貸し止め(準備担当)</h2>
<br>
<center>
<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><br><br><?php endif; ?>

<br><br>
<table border=1>
<?php if ($this->_tpl_vars['atoffice_auth_type'] == 4): ?>

<form name="change_hall_id" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('rental_stop2','page')); ?>
" />

<tr>
<td>
会場選択</td>
<td>
<select name="hall_list">
<?php $_from = $this->_tpl_vars['hall_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
	<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_id']); ?>
" <?php if ($this->_tpl_vars['item']['hall_id'] == $this->_tpl_vars['hall_id']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
</td>
<td rowspan=2>
<input type="submit" value="　変更　">
</td>
</tr>

<tr>
<td>日付変更</td>
<td>
<select name="year">
	<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['this_year']); ?>
" <?php if ($this->_tpl_vars['this_year'] == $this->_tpl_vars['year']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['this_year']); ?>
</option>
	<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['this_year']+1); ?>
" <?php if ($this->_tpl_vars['this_year'] + 1 == $this->_tpl_vars['year']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['this_year']+1); ?>
</option>
</select> 年 
<select name="month">
<?php $_from = $this->_tpl_vars['month_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
	<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" <?php if ($this->_tpl_vars['item'] == $this->_tpl_vars['month']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select> 月 
<select name="day">
<?php $_from = $this->_tpl_vars['day_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
	<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" <?php if ($this->_tpl_vars['item'] == $this->_tpl_vars['day']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
（<?php echo smarty_modifier_t_escape($this->_tpl_vars['week_list'][$this->_tpl_vars['key']]); ?>
）</option>
<?php endforeach; endif; unset($_from); ?>
</select> 日
</td>
</tr>
</form>

<?php else: ?>
<form name="change_hall_id" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('rental_stop2','page')); ?>
" />
<tr>
	<td>
	会場選択</td>
	<td colspan="2">
	<select name="hall_list">
		<?php $_from = $this->_tpl_vars['hall_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['label']):
?>			
			<?php $_from = $this->_tpl_vars['label']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
				<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_id']); ?>
" <?php if ($this->_tpl_vars['item']['hall_id'] == $this->_tpl_vars['hall_id']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
		<?php endforeach; endif; unset($_from); ?>
	</select>
	</td>
</tr>
<tr>
<td>日付変更</td>
<td>
<select name="year">
	<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['this_year']); ?>
" <?php if ($this->_tpl_vars['this_year'] == $this->_tpl_vars['year']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['this_year']); ?>
</option>
	<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['this_year']+1); ?>
" <?php if ($this->_tpl_vars['this_year'] + 1 == $this->_tpl_vars['year']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['this_year']+1); ?>
</option>
</select> 年 
<select name="month">
<?php $_from = $this->_tpl_vars['month_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
	<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" <?php if ($this->_tpl_vars['item'] == $this->_tpl_vars['month']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select> 月 
<select name="day">
<?php $_from = $this->_tpl_vars['day_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
	<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" <?php if ($this->_tpl_vars['item'] == $this->_tpl_vars['day']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select> 日 
</td>
<td>
<input type="submit" value="　変更　">
</td>
</tr>
</form>
<?php endif; ?>

<tr>
<td>
メモ
</td>
<form name="rental_stop" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('set_rental_stop2','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<td colspan=2><input type="text" name="memo" value="" size=50></td>
</tr>

</table>
<br>



<table width=100%>
<tr>
<td height=60px bgcolor=#CCCCFF style='border: 1px #000000 solid;text-align:center;vertical-align:middle;font-size:15px;'>
<b><?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_data']['hall_name']); ?>
 <?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']); ?>
日（<?php echo smarty_modifier_t_escape($this->_tpl_vars['week']); ?>
）</b>
<input type="submit" value="貸し止め更新">
<input type="hidden" name="year" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
">
<input type="hidden" name="month" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
">
<input type="hidden" name="day" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']); ?>
">
<input type="hidden" name="hid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
">
</td>
</tr>
</table>
<table width=100%>
<tr>
<th style='border: 1px #000000 solid;text-align: center;' width="150">
	部屋名
</th>
<?php $_from = $this->_tpl_vars['open_time']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['time']):
?>
	<th bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;' colspan=4><b>
		<?php echo smarty_modifier_t_escape($this->_tpl_vars['time']); ?>
:00 ～ <?php echo smarty_modifier_t_escape($this->_tpl_vars['time']+1); ?>
:00
	</b></th>
<?php endforeach; endif; unset($_from); ?>
</tr>

<?php $_from = $this->_tpl_vars['room_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
	<tr>
	<td style='border: 1px #000000 solid;text-align: center;' >
		<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['room_name']); ?>

	</td>
	<?php if ($this->_tpl_vars['value']['holiday']): ?>
		<td colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['ct']*4); ?>
 style='border: 1px #000000 solid;text-align: center;' bgcolor=#FF6666><b>休室日</b></td>
		</tr>
	<?php else: ?>
		<?php if ($this->_tpl_vars['value']['type'] == 2): ?>
			<?php $_from = $this->_tpl_vars['value']['opentime']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				<td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['cs']); ?>
 
				<?php if ($this->_tpl_vars['v']['reserved']): ?>
					bgcolor=#FFDCDC><span style='color:#FF0000;'><b>
予約ID:<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['reserved']); ?>
<br>
代表名：<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['corp']); ?>
<br>
予約者：<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['c_member']['nickname']); ?>
 様<br>
状態：
<?php if ($this->_tpl_vars['v']['reserve_data']['tmp_flag'] == 1): ?>
	仮予約
<?php elseif ($this->_tpl_vars['v']['reserve_data']['pay_flag'] == 0 && $this->_tpl_vars['v']['reserve_data']['pay_money'] == 0): ?>
	未入金
<?php elseif ($this->_tpl_vars['v']['reserve_data']['pay_flag'] == 0 && $this->_tpl_vars['v']['reserve_data']['pay_money'] > 0): ?>
	一部入金
<?php elseif ($this->_tpl_vars['v']['reserve_data']['pay_flag'] == 1): ?>
	入金済み
<?php elseif ($this->_tpl_vars['v']['reserve_data']['pay_flag'] == 2): ?>
	過剰入金
<?php endif; ?>
</b></span>
				<?php elseif ($this->_tpl_vars['v']['stoped']): ?>
					bgcolor=#FFCCFF>貸し止め中<br>
					有効期限：<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['stoped']['limit_datetime']); ?>
<br>
					担当者：<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['stoped']['admin_name']); ?>
<br>
					<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['stoped']['memo']); ?>
<br>
					削除：<input type='checkbox' name='delete_data<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
_<?php echo smarty_modifier_t_escape($this->_tpl_vars['k']); ?>
' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['stoped']['stop_id']); ?>
'>

				<?php else: ?>
					>
					<input type='checkbox' name='stop_data<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
_<?php echo smarty_modifier_t_escape($this->_tpl_vars['k']); ?>
' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_data']['hall_id']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['room_id']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']); ?>
 <?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['begin_time']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']); ?>
 <?php if ($this->_tpl_vars['v']['finish_time'] == "24:00"): ?>23:59:59<?php else: ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['finish_time']); ?>
<?php endif; ?>'>
				<?php endif; ?>
				</td>
			<?php endforeach; endif; unset($_from); ?>
		<?php else: ?>
			<?php $_from = $this->_tpl_vars['value']['komawari']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				<td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' colspan=<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['cs']); ?>
 
				<?php if ($this->_tpl_vars['v']['reserved']): ?>
					bgcolor=#FFDCDC><span style='color:#FF0000;'><b>
予約ID:<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['reserved']); ?>
<br>
代表名：<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['corp']); ?>
<br>
予約者：<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['c_member']['nickname']); ?>
 様<br>
状態：
<?php if ($this->_tpl_vars['v']['reserve_data']['tmp_flag'] == 1): ?>
	仮予約
<?php elseif ($this->_tpl_vars['v']['reserve_data']['pay_flag'] == 0 && $this->_tpl_vars['v']['reserve_data']['pay_money'] == 0): ?>
	未入金
<?php elseif ($this->_tpl_vars['v']['reserve_data']['pay_flag'] == 0 && $this->_tpl_vars['v']['reserve_data']['pay_money'] > 0): ?>
	一部入金
<?php elseif ($this->_tpl_vars['v']['reserve_data']['pay_flag'] == 1): ?>
	入金済み
<?php elseif ($this->_tpl_vars['v']['reserve_data']['pay_flag'] == 2): ?>
	過剰入金
<?php endif; ?>
<br>


</b></span>
				<?php elseif ($this->_tpl_vars['v']['stoped']): ?>
					bgcolor=#FFCCFF>貸し止め中<br>
					有効期限：<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['stoped']['limit_datetime']); ?>
<br>
					担当者：<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['stoped']['admin_name']); ?>
<br>
					<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['stoped']['memo']); ?>
<br>
					削除：<input type='checkbox' name='delete_data<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
_<?php echo smarty_modifier_t_escape($this->_tpl_vars['k']); ?>
' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['stoped']['stop_id']); ?>
'>
				<?php elseif ($this->_tpl_vars['v']['rest']): ?>
					bgcolor=#CDCDCD>休憩
				<?php else: ?>
					>
					<input type='checkbox' name='stop_data<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
_<?php echo smarty_modifier_t_escape($this->_tpl_vars['k']); ?>
' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_data']['hall_id']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['room_id']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']); ?>
 <?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['begin_time']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
-<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']); ?>
 <?php if ($this->_tpl_vars['v']['finish_time'] == "24:00"): ?>23:59:59<?php else: ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['finish_time']); ?>
<?php endif; ?>'>
				<?php endif; ?>
				</td>
			<?php endforeach; endif; unset($_from); ?>
		<?php endif; ?>
	<?php endif; ?>	</td>
	</tr>
<?php endforeach; endif; unset($_from); ?>

</table>

</form>

</center>

<?php else: ?>
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
<?php endif; ?>
<div>
<?php echo $this->_tpl_vars['inc_footer']; ?>
