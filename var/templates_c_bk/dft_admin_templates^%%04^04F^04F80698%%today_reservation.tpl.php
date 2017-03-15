<?php /* Smarty version 2.6.18, created on 2010-08-30 20:12:37
         compiled from file:/var/www/atoffice_torioki20100712/webapp/modules/admin/templates/today_reservation.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/atoffice_torioki20100712/webapp/modules/admin/templates/today_reservation.tpl', 2, false),array('modifier', 't_escape', 'file:/var/www/atoffice_torioki20100712/webapp/modules/admin/templates/today_reservation.tpl', 24, false),array('modifier', 'nl2br', 'file:/var/www/atoffice_torioki20100712/webapp/modules/admin/templates/today_reservation.tpl', 114, false),array('modifier', 't_url2cmd', 'file:/var/www/atoffice_torioki20100712/webapp/modules/admin/templates/today_reservation.tpl', 114, false),array('modifier', 't_cmd', 'file:/var/www/atoffice_torioki20100712/webapp/modules/admin/templates/today_reservation.tpl', 114, false),array('modifier', 't_decoration', 'file:/var/www/atoffice_torioki20100712/webapp/modules/admin/templates/today_reservation.tpl', 114, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminDesign.tpl"), $this);?>

<?php $this->assign('page_name', "本日のご予約状況"); ?>
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

<h2 id="ttl01">本日のご予約状況</h2>
<br>
<center>
<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><br><br><?php endif; ?>

<br><br>
<?php if ($this->_tpl_vars['atoffice_auth_type'] == 2 || $this->_tpl_vars['atoffice_auth_type'] == 4): ?>
	<form name="change_hall_id" method="POST" action="./">
	<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
	<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('today_reservation','page')); ?>
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
	<input type="submit" value="　決定　">
	</form>
	<br>
<?php endif; ?>


<table width=100%>
<tr>
<td height=60px bgcolor=#CCCCFF style='border: 1px #000000 solid;text-align:center;vertical-align:middle;font-size:15px;'>
<b><?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_data']['hall_name']); ?>
 <?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']); ?>
日</b>
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
<?php endif; ?>
<?php if ($this->_tpl_vars['v']['reserve_data']['complete_flag'] == 0): ?>
	(完了報告待ち)
<?php else: ?>
	(完了報告済み)
<?php endif; ?>
<br>
*** 準備備品 ***<br>
<?php $_from = $this->_tpl_vars['v']['reserve_v_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
	<?php if ($this->_tpl_vars['item'] == 0): ?>
		なし<br>
	<?php else: ?>
		<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['vessel_name']); ?>
(<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['num']); ?>
)<br>
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
*** 準備ｻｰﾋﾞｽ ***<br>
<?php $_from = $this->_tpl_vars['v']['reserve_s_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
	<?php if ($this->_tpl_vars['item'] == 0): ?>
		なし<br>
	<?php else: ?>
		<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['service_name']); ?>
(<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['num']); ?>
)<br>
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>

*** 社内メモ ***<br>
<?php if ($this->_tpl_vars['v']['reserve_data']['memo']): ?>
<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['v']['reserve_data']['memo']))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('t_url2cmd', true, $_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id'])) : smarty_modifier_t_url2cmd($_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id']))))) ? $this->_run_mod_handler('t_cmd', true, $_tmp, 'diary') : smarty_modifier_t_cmd($_tmp, 'diary')))) ? $this->_run_mod_handler('t_decoration', true, $_tmp) : smarty_modifier_t_decoration($_tmp)); ?>

<?php else: ?>
なし<br>
<?php endif; ?>
<br>

</b></span>
<?php if ($this->_tpl_vars['v']['reserve_data']['complete_flag'] == 0): ?>
	<form name="completion_report" method="POST" action="./">
	<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
	<input type="hidden" name="reserve_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['reserved']); ?>
" />
	<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('completion_report','page')); ?>
" />
	<input type='submit' value="完了報告">
	</form>
<?php endif; ?>

				<?php else: ?>
					>
					-- --
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
<?php endif; ?>
<?php if ($this->_tpl_vars['v']['reserve_data']['complete_flag'] == 0): ?>
	(完了報告待ち)
<?php else: ?>
	(完了報告済み)
<?php endif; ?>
<br>
*** 準備備品 ***<br>
<?php $_from = $this->_tpl_vars['v']['reserve_v_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
	<?php if ($this->_tpl_vars['item'] == 0): ?>
		なし<br>
	<?php else: ?>
		<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['vessel_name']); ?>
(<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['num']); ?>
)<br>
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
*** 準備ｻｰﾋﾞｽ ***<br>
<?php $_from = $this->_tpl_vars['v']['reserve_s_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
	<?php if ($this->_tpl_vars['item'] == 0): ?>
		なし<br>
	<?php else: ?>
		<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['service_name']); ?>
(<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['num']); ?>
)<br>
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>

*** 社内メモ ***<br>
<?php if ($this->_tpl_vars['v']['reserve_data']['memo']): ?>
<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['v']['reserve_data']['memo']))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('t_url2cmd', true, $_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id'])) : smarty_modifier_t_url2cmd($_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id']))))) ? $this->_run_mod_handler('t_cmd', true, $_tmp, 'diary') : smarty_modifier_t_cmd($_tmp, 'diary')))) ? $this->_run_mod_handler('t_decoration', true, $_tmp) : smarty_modifier_t_decoration($_tmp)); ?>

<?php else: ?>
なし<br>
<?php endif; ?>
<br>

</b></span>
<?php if ($this->_tpl_vars['v']['reserve_data']['complete_flag'] == 0): ?>
	<form name="completion_report" method="POST" action="./">
	<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
	<input type="hidden" name="reserve_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['reserved']); ?>
" />
	<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('completion_report','page')); ?>
" />
	<input type='submit' value="完了報告">
	</form>
<?php endif; ?>


</b></span>
				<?php elseif ($this->_tpl_vars['v']['rest']): ?>
					bgcolor=#CDCDCD>休憩
				<?php else: ?>
					>
					-- --
				<?php endif; ?>
				</td>
			<?php endforeach; endif; unset($_from); ?>
		<?php endif; ?>
	<?php endif; ?>	</td>
	</tr>
<?php endforeach; endif; unset($_from); ?>

</table>

</center>

<h2 id="ttl01"><?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']); ?>
日の予約一覧</h2>
<br>
<table border=1>
<tr>
<th width=200>部屋名</th>
<th width=200>予約時間</th>
<th width=200>法人/団体名</th>
<th width=400>看板</th>
</tr>

<?php $_from = $this->_tpl_vars['room_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
	<?php $_from = $this->_tpl_vars['value']['opentime']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		<?php if ($this->_tpl_vars['v']['reserve_data']): ?>
<tr>
			<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['room_name']); ?>
</td><td><?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['begin']); ?>
～<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['finish']); ?>
</td><td><?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['crp']); ?>
</td><td><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['v']['reserve_data']['kanban']))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('t_url2cmd', true, $_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id'])) : smarty_modifier_t_url2cmd($_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id']))))) ? $this->_run_mod_handler('t_cmd', true, $_tmp, 'diary') : smarty_modifier_t_cmd($_tmp, 'diary')))) ? $this->_run_mod_handler('t_decoration', true, $_tmp) : smarty_modifier_t_decoration($_tmp)); ?>
</td>
</tr>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	<?php $_from = $this->_tpl_vars['value']['komawari']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		<?php if ($this->_tpl_vars['v']['reserve_data']): ?>
<tr>
			<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['room_name']); ?>
</td><td><?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['begin']); ?>
～<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['finish']); ?>
</td><td><?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['corp']); ?>
</td><td><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['v']['reserve_data']['kanban']))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('t_url2cmd', true, $_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id'])) : smarty_modifier_t_url2cmd($_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id']))))) ? $this->_run_mod_handler('t_cmd', true, $_tmp, 'diary') : smarty_modifier_t_cmd($_tmp, 'diary')))) ? $this->_run_mod_handler('t_decoration', true, $_tmp) : smarty_modifier_t_decoration($_tmp)); ?>
</td>
</tr>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
<?php endforeach; endif; unset($_from); ?>

</table>

<?php else: ?>
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
<?php endif; ?>
<div>
<?php echo $this->_tpl_vars['inc_footer']; ?>
