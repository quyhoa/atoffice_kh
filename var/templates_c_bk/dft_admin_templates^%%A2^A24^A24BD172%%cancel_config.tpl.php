<?php /* Smarty version 2.6.18, created on 2010-09-01 08:38:12
         compiled from file:/var/www/atoffice_torioki20100712/webapp/modules/admin/templates/cancel_config.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/atoffice_torioki20100712/webapp/modules/admin/templates/cancel_config.tpl', 2, false),array('modifier', 't_escape', 'file:/var/www/atoffice_torioki20100712/webapp/modules/admin/templates/cancel_config.tpl', 13, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminImageKakikomi.tpl"), $this);?>

<?php $this->assign('page_name', "キャンセル料率設定"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminImageKakikomi.tpl"), $this);?>

</div>


<?php if ($this->_tpl_vars['atoffice_auth_type'] == 1 || $this->_tpl_vars['atoffice_auth_type'] == 4): ?>


<h2 id="ttl01">キャンセル料率設定【<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_name']); ?>
】</h2>
<br>
<center>
<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><br><br><?php endif; ?>
<span style="font-size: 15pt;color: #FF0000;">
※ この会議室のキャンセル設定範囲は<b><?php echo smarty_modifier_t_escape($this->_tpl_vars['cancel_days']); ?>
日</b>以前までです。
</span>
<br><br>
<form name="add_bank_data" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('add_cancel_charge','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
" />
<table border=1>
<tr>
<td>
<table>
<tr>
<td bgcolor="#FFCCFF" width=350 align=center height=30 colspan=2>
<input type="checkbox" name="1_flag" value="1" <?php if ($this->_tpl_vars['cancel_data']['0']['flag']): ?>checked<?php endif; ?>><b> 有効 / パターン１</b><span style="color: #FF0000;"><b>　（必須）</b></span></td>
</tr>
<tr>
<td>
<select name="1_day1">
<option value="">　--選択--　</option>
<?php $_from = $this->_tpl_vars['day_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" <?php if ($this->_tpl_vars['cancel_data']['0']['day1'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>>　<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
　</option>
<?php endforeach; endif; unset($_from); ?>
</select>
日以前 <input type="text" name="1_percent1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['cancel_data']['0']['percent1']); ?>
" size=15> ％
</td>
</tr>
<tr>
<td>
<select name="1_day2">
<option value="">　--選択--　</option>
<?php $_from = $this->_tpl_vars['day_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" <?php if ($this->_tpl_vars['cancel_data']['0']['day2'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>>　<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
　</option>
<?php endforeach; endif; unset($_from); ?>
</select>
日前まで <input type="text" name="1_percent2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['cancel_data']['0']['percent2']); ?>
" size=15> ％</td>
</tr>
<tr>
<td>
<select name="1_day3">
<option value="">　--選択--　</option>
<?php $_from = $this->_tpl_vars['day_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" <?php if ($this->_tpl_vars['cancel_data']['0']['day3'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>>　<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
　</option>
<?php endforeach; endif; unset($_from); ?>
</select>
日前まで <input type="text" name="1_percent3" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['cancel_data']['0']['percent3']); ?>
" size=15> ％</td>
</tr>
<tr>
<td>
<select name="1_day4">
<option value="">　--選択--　</option>
<?php $_from = $this->_tpl_vars['day_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" <?php if ($this->_tpl_vars['cancel_data']['0']['day4'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>>　<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
　</option>
<?php endforeach; endif; unset($_from); ?>
</select>
日前まで <input type="text" name="1_percent4" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['cancel_data']['0']['percent4']); ?>
" size=15> ％</td>
</tr>
<tr>
<td>
<select name="1_day5">
<option value="">　--選択--　</option>
<?php $_from = $this->_tpl_vars['day_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" <?php if ($this->_tpl_vars['cancel_data']['0']['day5'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>>　<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
　</option>
<?php endforeach; endif; unset($_from); ?>
</select>
日前まで <input type="text" name="1_percent5" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['cancel_data']['0']['percent5']); ?>
" size=15> ％</td>
</tr>
</table>
</td>
<td>
<table>
<tr>
<td bgcolor="#FFCCFF" width=350 align=center height=30>
<input type="checkbox" name="2_flag" value="1" <?php if ($this->_tpl_vars['cancel_data']['1']['flag']): ?>checked<?php endif; ?>><b> 有効 / パターン２</b></td>
</tr>
<tr>
<td><select name="2_day1">
<option value="">　--選択--　</option>
<?php $_from = $this->_tpl_vars['day_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" <?php if ($this->_tpl_vars['cancel_data']['1']['day1'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>>　<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
　</option>
<?php endforeach; endif; unset($_from); ?>
</select>
日以前 <input type="text" name="2_percent1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['cancel_data']['1']['percent1']); ?>
" size=15> ％</td>
</tr>
<tr>
<td><select name="2_day2">
<option value="">　--選択--　</option>
<?php $_from = $this->_tpl_vars['day_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" <?php if ($this->_tpl_vars['cancel_data']['1']['day2'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>>　<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
　</option>
<?php endforeach; endif; unset($_from); ?>
</select>
日前まで <input type="text" name="2_percent2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['cancel_data']['1']['percent2']); ?>
" size=15> ％</td>
</tr>
<tr>
<td><select name="2_day3">
<option value="">　--選択--　</option>
<?php $_from = $this->_tpl_vars['day_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" <?php if ($this->_tpl_vars['cancel_data']['1']['day3'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>>　<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
　</option>
<?php endforeach; endif; unset($_from); ?>
</select>
日前まで <input type="text" name="2_percent3" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['cancel_data']['1']['percent3']); ?>
" size=15> ％</td>
</tr>
<tr>
<td><select name="2_day4">
<option value="">　--選択--　</option>
<?php $_from = $this->_tpl_vars['day_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" <?php if ($this->_tpl_vars['cancel_data']['1']['day4'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>>　<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
　</option>
<?php endforeach; endif; unset($_from); ?>
</select>
日前まで <input type="text" name="2_percent4" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['cancel_data']['1']['percent4']); ?>
" size=15> ％</td>
</tr>
<tr>
<td><select name="2_day5">
<option value="">　--選択--　</option>
<?php $_from = $this->_tpl_vars['day_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" <?php if ($this->_tpl_vars['cancel_data']['1']['day5'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>>　<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
　</option>
<?php endforeach; endif; unset($_from); ?>
</select>
日前まで <input type="text" name="2_percent5" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['cancel_data']['1']['percent5']); ?>
" size=15> ％</td>
</tr>
</table>
</td>
</tr>
<tr>
<td>
<table>
<tr>
<td bgcolor="#FFCCFF" width=350 align=center height=30>
<input type="checkbox" name="3_flag" value="1" <?php if ($this->_tpl_vars['cancel_data']['2']['flag']): ?>checked<?php endif; ?>><b> 有効 / パターン３</b></td>
</tr>
<tr>
<td><select name="3_day1">
<option value="">　--選択--　</option>
<?php $_from = $this->_tpl_vars['day_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" <?php if ($this->_tpl_vars['cancel_data']['2']['day1'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>>　<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
　</option>
<?php endforeach; endif; unset($_from); ?>
</select>
日以前 <input type="text" name="3_percent1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['cancel_data']['2']['percent1']); ?>
" size=15> ％</td>
</tr>
<tr>
<td><select name="3_day2">
<option value="">　--選択--　</option>
<?php $_from = $this->_tpl_vars['day_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" <?php if ($this->_tpl_vars['cancel_data']['2']['day2'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>>　<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
　</option>
<?php endforeach; endif; unset($_from); ?>
</select>
日前まで <input type="text" name="3_percent2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['cancel_data']['2']['percent2']); ?>
" size=15> ％</td>
</tr>
<tr>
<td><select name="3_day3">
<option value="">　--選択--　</option>
<?php $_from = $this->_tpl_vars['day_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" <?php if ($this->_tpl_vars['cancel_data']['2']['day3'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>>　<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
　</option>
<?php endforeach; endif; unset($_from); ?>
</select>
日前まで <input type="text" name="3_percent3" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['cancel_data']['2']['percent3']); ?>
" size=15> ％</td>
</tr>
<tr>
<td><select name="3_day4">
<option value="">　--選択--　</option>
<?php $_from = $this->_tpl_vars['day_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" <?php if ($this->_tpl_vars['cancel_data']['2']['day4'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>>　<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
　</option>
<?php endforeach; endif; unset($_from); ?>
</select>
日前まで <input type="text" name="3_percent4" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['cancel_data']['2']['percent4']); ?>
" size=15> ％</td>
</tr>
<tr>
<td><select name="3_day5">
<option value="">　--選択--　</option>
<?php $_from = $this->_tpl_vars['day_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" <?php if ($this->_tpl_vars['cancel_data']['2']['day5'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>>　<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
　</option>
<?php endforeach; endif; unset($_from); ?>
</select>
日前まで <input type="text" name="3_percent5" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['cancel_data']['2']['percent5']); ?>
" size=15> ％</td>
</tr>
</table>
</td>
<td>
<table>
<tr>
<td bgcolor="#FFCCFF" width=350 align=center height=30>
<input type="checkbox" name="4_flag" value="1" <?php if ($this->_tpl_vars['cancel_data']['3']['flag']): ?>checked<?php endif; ?>><b> 有効 / パターン４</b></td>
</tr>
<tr>
<td><select name="4_day1">
<option value="">　--選択--　</option>
<?php $_from = $this->_tpl_vars['day_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" <?php if ($this->_tpl_vars['cancel_data']['3']['day1'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>>　<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
　</option>
<?php endforeach; endif; unset($_from); ?>
</select>
日以前 <input type="text" name="4_percent1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['cancel_data']['3']['percent1']); ?>
" size=15> ％</td>
</tr>
<tr>
<td><select name="4_day2">
<option value="">　--選択--　</option>
<?php $_from = $this->_tpl_vars['day_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" <?php if ($this->_tpl_vars['cancel_data']['3']['day2'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>>　<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
　</option>
<?php endforeach; endif; unset($_from); ?>
</select>
日前まで <input type="text" name="4_percent2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['cancel_data']['3']['percent2']); ?>
" size=15> ％</td>
</tr>
<tr>
<td><select name="4_day3">
<option value="">　--選択--　</option>
<?php $_from = $this->_tpl_vars['day_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" <?php if ($this->_tpl_vars['cancel_data']['3']['day3'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>>　<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
　</option>
<?php endforeach; endif; unset($_from); ?>
</select>
日前まで <input type="text" name="4_percent3" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['cancel_data']['3']['percent3']); ?>
" size=15> ％</td>
</tr>
<tr>
<td><select name="4_day4">
<option value="">　--選択--　</option>
<?php $_from = $this->_tpl_vars['day_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" <?php if ($this->_tpl_vars['cancel_data']['3']['day4'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>>　<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
　</option>
<?php endforeach; endif; unset($_from); ?>
</select>
日前まで <input type="text" name="4_percent4" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['cancel_data']['3']['percent4']); ?>
" size=15> ％</td>
</tr>
<tr>
<td><select name="4_day5">
<option value="">　--選択--　</option>
<?php $_from = $this->_tpl_vars['day_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" <?php if ($this->_tpl_vars['cancel_data']['3']['day5'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>>　<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
　</option>
<?php endforeach; endif; unset($_from); ?>
</select>
日前まで <input type="text" name="4_percent5" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['cancel_data']['3']['percent5']); ?>
" size=15> ％</td>
</tr>
</table>
</td>
</tr>
<tr>
<td>
<table>
<tr>
<td bgcolor="#FFCCFF" width=350 align=center height=30>
<input type="checkbox" name="5_flag" value="1" <?php if ($this->_tpl_vars['cancel_data']['4']['flag']): ?>checked<?php endif; ?>><b> 有効 / パターン５</b></td>
</tr>
<tr>
<td><select name="5_day1">
<option value="">　--選択--　</option>
<?php $_from = $this->_tpl_vars['day_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" <?php if ($this->_tpl_vars['cancel_data']['4']['day1'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>>　<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
　</option>
<?php endforeach; endif; unset($_from); ?>
</select>
日以前 <input type="text" name="5_percent1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['cancel_data']['4']['percent1']); ?>
" size=15> ％</td>
</tr>
<tr>
<td><select name="5_day2">
<option value="">　--選択--　</option>
<?php $_from = $this->_tpl_vars['day_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" <?php if ($this->_tpl_vars['cancel_data']['4']['day2'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>>　<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
　</option>
<?php endforeach; endif; unset($_from); ?>
</select>
日前まで <input type="text" name="5_percent2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['cancel_data']['4']['percent2']); ?>
" size=15> ％</td>
</tr>
<tr>
<td><select name="5_day3">
<option value="">　--選択--　</option>
<?php $_from = $this->_tpl_vars['day_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" <?php if ($this->_tpl_vars['cancel_data']['4']['day3'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>>　<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
　</option>
<?php endforeach; endif; unset($_from); ?>
</select>
日前まで <input type="text" name="5_percent3" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['cancel_data']['4']['percent3']); ?>
" size=15> ％</td>
</tr>
<tr>
<td><select name="5_day4">
<option value="">　--選択--　</option>
<?php $_from = $this->_tpl_vars['day_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" <?php if ($this->_tpl_vars['cancel_data']['4']['day4'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>>　<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
　</option>
<?php endforeach; endif; unset($_from); ?>
</select>
日前まで <input type="text" name="5_percent4" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['cancel_data']['4']['percent4']); ?>
" size=15> ％</td>
</tr>
<tr>
<td><select name="5_day5">
<option value="">　--選択--　</option>
<?php $_from = $this->_tpl_vars['day_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" <?php if ($this->_tpl_vars['cancel_data']['4']['day5'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>>　<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
　</option>
<?php endforeach; endif; unset($_from); ?>
</select>
日前まで <input type="text" name="5_percent5" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['cancel_data']['4']['percent5']); ?>
" size=15> ％</td>
</tr>
</table>
</td>
<td>
<table>
<tr>
<td bgcolor="#FFCCFF" width=350 align=center height=30>
<input type="checkbox" name="6_flag" value="1" <?php if ($this->_tpl_vars['cancel_data']['5']['flag']): ?>checked<?php endif; ?>><b> 有効 / パターン６</b></td>
</tr>
<tr>
<td><select name="6_day1">
<option value="">　--選択--　</option>
<?php $_from = $this->_tpl_vars['day_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" <?php if ($this->_tpl_vars['cancel_data']['5']['day1'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>>　<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
　</option>
<?php endforeach; endif; unset($_from); ?>
</select>
日以前 <input type="text" name="6_percent1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['cancel_data']['5']['percent1']); ?>
" size=15> ％</td>
</tr>
<tr>
<td><select name="6_day2">
<option value="">　--選択--　</option>
<?php $_from = $this->_tpl_vars['day_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" <?php if ($this->_tpl_vars['cancel_data']['5']['day2'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>>　<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
　</option>
<?php endforeach; endif; unset($_from); ?>
</select>
日前まで <input type="text" name="6_percent2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['cancel_data']['5']['percent2']); ?>
" size=15> ％</td>
</tr>
<tr>
<td><select name="6_day3">
<option value="">　--選択--　</option>
<?php $_from = $this->_tpl_vars['day_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" <?php if ($this->_tpl_vars['cancel_data']['5']['day3'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>>　<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
　</option>
<?php endforeach; endif; unset($_from); ?>
</select>
日前まで <input type="text" name="6_percent3" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['cancel_data']['5']['percent3']); ?>
" size=15> ％</td>
</tr>
<tr>
<td><select name="6_day4">
<option value="">　--選択--　</option>
<?php $_from = $this->_tpl_vars['day_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" <?php if ($this->_tpl_vars['cancel_data']['5']['day4'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>>　<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
　</option>
<?php endforeach; endif; unset($_from); ?>
</select>
日前まで <input type="text" name="6_percent4" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['cancel_data']['5']['percent4']); ?>
" size=15> ％</td>
</tr>
<tr>
<td><select name="6_day5">
<option value="">　--選択--　</option>
<?php $_from = $this->_tpl_vars['day_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
" <?php if ($this->_tpl_vars['cancel_data']['5']['day5'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>>　<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
　</option>
<?php endforeach; endif; unset($_from); ?>
</select>
日前まで <input type="text" name="6_percent5" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['cancel_data']['5']['percent5']); ?>
" size=15> ％</td>
</tr>
</table>
</td>
</tr>

</table>
<br>
<input type="submit" value="　登　録　">
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
