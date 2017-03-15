<?php /* Smarty version 2.6.18, created on 2010-08-27 14:09:39
         compiled from file:/var/www/atoffice_torioki20100712/webapp/modules/admin/templates/set_reserve.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/atoffice_torioki20100712/webapp/modules/admin/templates/set_reserve.tpl', 2, false),array('modifier', 't_escape', 'file:/var/www/atoffice_torioki20100712/webapp/modules/admin/templates/set_reserve.tpl', 24, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminSiteMember.tpl"), $this);?>

<?php $this->assign('page_name', "予約入力"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminSiteMember.tpl"), $this);?>

</div>


<?php if ($this->_tpl_vars['atoffice_auth_type'] == 2 || $this->_tpl_vars['atoffice_auth_type'] == 4): ?>

<style type="text/css">
<!--
HR {
	border-style:dotted;color:#3399FF

}
-->
</style>

<h2 id="ttl01">予約入力</h2>
<br>
<center>
<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><br><br><?php endif; ?>

<br><br>

<table border=1>
<tr>
<td>会場選択</td>
<td>
<form name="change_hall_id" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('set_reserve','page')); ?>
" />
<select name="hall_list">
<?php $_from = $this->_tpl_vars['hall_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
	<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_id']); ?>
" <?php if ($this->_tpl_vars['item']['hall_id'] == $this->_tpl_vars['hall_id']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
</td><td rowspan=2>
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
    foreach ($_from as $this->_tpl_vars['item']):
?>
	<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" <?php if ($this->_tpl_vars['item'] == $this->_tpl_vars['day']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select> 日 
</form>
</td>
</tr>

<tr>
<td>
<form name="change_date1" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('set_reserve','page')); ?>
" />
<input type="hidden" name="hall_list" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
">
<input type="hidden" name="year" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
">
<input type="hidden" name="month" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
">
<input type="hidden" name="day" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']-1); ?>
">
<input type="submit" value="←前日">
</form>
</td>

<td>
<form name="change_date1" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('set_reserve','page')); ?>
" />
<input type="hidden" name="hall_list" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
">
<input type="submit" value="今日">
</form>
</td>

<td>
<form name="change_date1" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('set_reserve','page')); ?>
" />
<input type="hidden" name="hall_list" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
">
<input type="hidden" name="year" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
">
<input type="hidden" name="month" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
">
<input type="hidden" name="day" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']+1); ?>
">
<input type="submit" value="翌日→">
</form>
</td>
</tr>

<tr>
<td>利用予定人数</td>
<td colspan=2>
<form name="rental_stop" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('set_reserve_vessel','page')); ?>
" />
<input type="text" name="people" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['people']); ?>
"> 人 
</td>
</tr>
<tr>
<td>利用目的</td>
<td colspan=2>
<select name="purpose">
<option value="0">--未選択--</option>
<option value="1">会議</option>
<option value="2">セミナー</option>
<option value="3">研修</option>
<option value="4">面接・試験</option>
<option value="5">懇談会・パーティ</option>
<option value="6">その他</option>
</select>
</td>
</tr>

<tr>
<td>顧客ID番号</td>
<td colspan=2>
<input type="text" name="c_member_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['c_member_id']); ?>
"><br>
※ 新規の場合は未入力
</td>
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
日</b>
<input type="submit" value="備品選択へ">
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
 (<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['max']); ?>
人)<br>
		<?php if ($this->_tpl_vars['value']['type'] == 2): ?>最低<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['lowest_koma']); ?>
コマ以上<?php endif; ?>
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
<a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('reserve_view')); ?>
&amp;reserve_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['reserved']); ?>
">
予約ID:<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['reserved']); ?>
</a><br>
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
					予約：<input type='checkbox' name='reserve_data<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
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
 <?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['finish_time']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['type']); ?>
'>

				<?php else: ?>
					>
					<input type='checkbox' name='reserve_data<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
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
 <?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['finish_time']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['type']); ?>
'>
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
<a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('reserve_view')); ?>
&amp;reserve_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['reserved']); ?>
">
予約ID:<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['reserved']); ?>
</a><br>
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
					<input type='checkbox' name='reserve_data<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
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
 <?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['finish_time']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['type']); ?>
'>
				<?php elseif ($this->_tpl_vars['v']['rest']): ?>
					bgcolor=#CDCDCD>休憩
				<?php else: ?>
					>
					<input type='checkbox' name='reserve_data<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
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
 <?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['finish_time']); ?>
,<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['type']); ?>
'>
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
