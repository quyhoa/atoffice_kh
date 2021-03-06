<?php /* Smarty version 2.6.18, created on 2016-03-08 14:02:48
         compiled from file:/var/www/atoffice/webapp/modules/admin/templates/tomorrow_reservation.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/atoffice/webapp/modules/admin/templates/tomorrow_reservation.tpl', 2, false),array('modifier', 't_escape', 'file:/var/www/atoffice/webapp/modules/admin/templates/tomorrow_reservation.tpl', 31, false),array('modifier', 'nl2br', 'file:/var/www/atoffice/webapp/modules/admin/templates/tomorrow_reservation.tpl', 227, false),array('modifier', 't_url2cmd', 'file:/var/www/atoffice/webapp/modules/admin/templates/tomorrow_reservation.tpl', 227, false),array('modifier', 't_cmd', 'file:/var/www/atoffice/webapp/modules/admin/templates/tomorrow_reservation.tpl', 227, false),array('modifier', 't_decoration', 'file:/var/www/atoffice/webapp/modules/admin/templates/tomorrow_reservation.tpl', 227, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminDesign.tpl"), $this);?>

<?php $this->assign('page_name', "予約状況検索"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminDesign.tpl"), $this);?>

</div>


<?php if ($this->_tpl_vars['atoffice_auth_type'] == 3 || $this->_tpl_vars['atoffice_auth_type'] == 4): ?>


<script type="text/javascript">
function newwinprint(kanban){
	winprint=window.open("./atoffice/pages/sub/kanban.php?kanban="+kanban);
}
</script>

<style type="text/css">
<!--
HR {
	border-style:dotted;color:#3399FF

}
-->
</style>

<h2 id="ttl01">予約状況検索</h2>
<br>
<center>
<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><br><br><?php endif; ?>

<br><br>

	<form name="change_hall_id" method="POST" action="./">
	<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
	<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('tomorrow_reservation','page')); ?>
" />
	<table border=1 width=700>
	<tr>
	<?php if ($this->_tpl_vars['atoffice_auth_type'] == 4): ?>
	<th>会場選択</th>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['atoffice_auth_type'] == 3): ?>
	<th>会場選択</th>
	<?php endif; ?>
	<th>日にち選択</th>
	<td rowspan=2>
	<input type="submit" value="　決定　">
	</td>
	</tr>

	<tr>
	<?php if ($this->_tpl_vars['atoffice_auth_type'] == 4): ?>
	<td>
		<select name="hall_list">

			<?php $_from = $this->_tpl_vars['hall_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
				<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_id']); ?>
"<?php if ($this->_tpl_vars['item']['hall_id'] == $this->_tpl_vars['hall_id']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
		</select>
	</td>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['atoffice_auth_type'] == 3): ?>
	<td>	
		<select name="hall_list">
			<?php $_from = $this->_tpl_vars['hall_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['label']):
?>			
				<?php $_from = $this->_tpl_vars['label']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
					<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_id']); ?>
"<?php if ($this->_tpl_vars['item']['hall_id'] == $this->_tpl_vars['hall_id']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			<?php endforeach; endif; unset($_from); ?>
		</select>
	</td>
	<?php endif; ?>
	<td>
	<select name="year">
	<?php $_from = $this->_tpl_vars['year_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
		<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" 
		<?php if ($this->_tpl_vars['item'] == $this->_tpl_vars['year']): ?>selected<?php endif; ?>
		><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
</option>
	<?php endforeach; endif; unset($_from); ?>
	</select> 年 
	<select name="month">
	<?php $_from = $this->_tpl_vars['month_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
		<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" 
		<?php if ($this->_tpl_vars['item'] == $this->_tpl_vars['month']): ?>selected<?php endif; ?>
		><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
</option>
	<?php endforeach; endif; unset($_from); ?>
	</select> 月 
	<select name="day">
	<?php $_from = $this->_tpl_vars['day_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
		<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" 
		<?php if ($this->_tpl_vars['item'] == $this->_tpl_vars['day']): ?>selected<?php endif; ?>
		><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
（<?php echo smarty_modifier_t_escape($this->_tpl_vars['week_list'][$this->_tpl_vars['key']]); ?>
）</option>
	<?php endforeach; endif; unset($_from); ?>
	</select> 日

	</td>
	</tr>
	</table>
	</form>
	<br>


<table width=100%>
<tr>
<td height=60px bgcolor=#CCCCFF style='border: 1px #000000 solid;text-align:center;vertical-align:middle;font-size:15px;'>
<center>
<table>
<tr>
<td width=100>
<form name="change_date1" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('tomorrow_reservation','page')); ?>
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
<td width=450>
<b><?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_data']['hall_name']); ?>
 <?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']); ?>
日（<?php echo smarty_modifier_t_escape($this->_tpl_vars['week']); ?>
）</b>
</td>
<td>
<form name="change_date1" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('tomorrow_reservation','page')); ?>
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
</table>
</center>
</td>
</tr>
</table>
<table width=100%>

<?php $this->assign('line', 0); ?>
<?php $_from = $this->_tpl_vars['room_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
	<?php if (( $this->_tpl_vars['line'] % 5 ) == 0): ?>
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
	<?php endif; ?>
	<?php $this->assign('line', smarty_modifier_t_escape($this->_tpl_vars['line']+1)); ?>
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
***利用目的***<br>
<?php if ($this->_tpl_vars['v']['reserve_data']['purpose'] == 1): ?>
	会議
<?php elseif ($this->_tpl_vars['v']['reserve_data']['purpose'] == 2): ?>
	セミナー
<?php elseif ($this->_tpl_vars['v']['reserve_data']['purpose'] == 3): ?>
研修
<?php elseif ($this->_tpl_vars['v']['reserve_data']['purpose'] == 4): ?>
面接・試験
<?php elseif ($this->_tpl_vars['v']['reserve_data']['purpose'] == 5): ?>
懇談会・パーティ
<?php elseif ($this->_tpl_vars['v']['reserve_data']['purpose'] == 6): ?>
その他
<?php else: ?>
未選択
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

<?php if ($this->_tpl_vars['v']['kanban']): ?>
<INPUT type='button' onclick=newwinprint('<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['kanban']); ?>
') value='　看板印刷　'>
<?php else: ?>
看板入力なし<br>
<?php endif; ?>
</b></span>

                <?php elseif ($this->_tpl_vars['v']['stoped']): ?>
					bgcolor=#FFCCFF>貸し止め中<br>
					有効期限：<?php if ($this->_tpl_vars['v']['stoped']['limit_datetime'] == "0000-00-00 00:00:00"): ?>なし<?php else: ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['stoped']['limit_datetime']); ?>
<?php endif; ?><br>
					担当者：<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['stoped']['admin_name']); ?>
<br>
					<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['stoped']['memo']); ?>
<br>

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
***利用目的***<br>
<?php if ($this->_tpl_vars['v']['reserve_data']['purpose'] == 1): ?>
	会議
<?php elseif ($this->_tpl_vars['v']['reserve_data']['purpose'] == 2): ?>
	セミナー
<?php elseif ($this->_tpl_vars['v']['reserve_data']['purpose'] == 3): ?>
研修
<?php elseif ($this->_tpl_vars['v']['reserve_data']['purpose'] == 4): ?>
面接・試験
<?php elseif ($this->_tpl_vars['v']['reserve_data']['purpose'] == 5): ?>
懇談会・パーティ
<?php elseif ($this->_tpl_vars['v']['reserve_data']['purpose'] == 6): ?>
その他
<?php else: ?>
未選択
<?php endif; ?>
<br>*** 準備備品 ***<br>
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
<?php if ($this->_tpl_vars['v']['kanban']): ?>
<INPUT type='button' onclick=newwinprint('<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['kanban']); ?>
') value='　看板印刷　'>
<?php else: ?>
看板入力なし<br>
<?php endif; ?>
</b></span>




</b></span>
                <?php elseif ($this->_tpl_vars['v']['stoped']): ?>
					bgcolor=#FFCCFF>貸し止め中<br>
					有効期限：<?php if ($this->_tpl_vars['v']['stoped']['limit_datetime'] == "0000-00-00 00:00:00"): ?>なし<?php else: ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['stoped']['limit_datetime']); ?>
<?php endif; ?><br>
					担当者：<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['stoped']['admin_name']); ?>
<br>
					<?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['stoped']['memo']); ?>
<br>
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

</table>

</center>
<h2 id="ttl01"><?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']); ?>
日（<?php echo smarty_modifier_t_escape($this->_tpl_vars['week']); ?>
）の予約一覧</h2>
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
</td><td><?php echo smarty_modifier_t_escape($this->_tpl_vars['v']['corp']); ?>
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
