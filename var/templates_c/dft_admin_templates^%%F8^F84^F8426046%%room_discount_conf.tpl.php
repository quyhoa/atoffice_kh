<?php /* Smarty version 2.6.18, created on 2017-03-24 03:06:26
         compiled from file:D:%5CA_project%5Catoffice_kh/webapp/modules/admin/templates/room_discount_conf.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:D:\\A_project\\atoffice_kh/webapp/modules/admin/templates/room_discount_conf.tpl', 2, false),array('modifier', 't_escape', 'file:D:\\A_project\\atoffice_kh/webapp/modules/admin/templates/room_discount_conf.tpl', 21, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminImageKakikomi.tpl"), $this);?>

<?php $this->assign('page_name', "部屋別割引設定"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminImageKakikomi.tpl"), $this);?>

</div>


<?php if ($this->_tpl_vars['atoffice_auth_type'] == 1 || $this->_tpl_vars['atoffice_auth_type'] == 4): ?>

<style type="text/css">
<!--
HR {
	border-style:dotted;color:#3399FF

}
-->
</style>

<h2 id="ttl01">部屋別割引設定【<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_name']); ?>
】【<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['room_name']); ?>
】</h2>
<br>
<div align=right>
<form name="add_room" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('room_list','page')); ?>
" />
<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
">
<input type="submit" value="部屋一覧へ戻る">
</form>
</div>
<br>
<center>
<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><br><br><?php endif; ?>

<br><br>
この部屋の標準価格一覧
<?php if ($this->_tpl_vars['room_data']['type'] == 1): ?>
<table border=1>
<?php $_from = $this->_tpl_vars['i_koma_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<tr>
<td width=80 bgcolor=#CDCDCD>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['num']); ?>
コマ目
</td>
<td width=120>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['begin']); ?>
時～<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['finish']); ?>
時
</td>
<td width=120>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['price']); ?>
円
</td>
<?php if ($this->_tpl_vars['item']['1']): ?>
<td align=left>
パターン1: <span style="color: #FF0000;"><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['1']); ?>
</span>円
</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['item']['2']): ?>
<td align=left>
パターン2: <span style="color: #FF0000;"><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['2']); ?>
</span>円
</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['item']['3']): ?>
<td align=left>
パターン3: <span style="color: #FF0000;"><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['3']); ?>
</span>円
</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['item']['4']): ?>
<td align=left>
パターン4: <span style="color: #FF0000;"><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['4']); ?>
</span>円
</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['item']['5']): ?>
<td align=left>
パターン5: <span style="color: #FF0000;"><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['5']); ?>
</span>円
</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['item']['6']): ?>
<td align=left>
パターン6: <span style="color: #FF0000;"><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['6']); ?>
</span>円
</td>
<?php endif; ?>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>
<?php else: ?>
<table border=1>
<?php if ($this->_tpl_vars['room_data']['k_lowest_price']): ?>
<tr>
<td bgcolor=#CDCDCD>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_capa_lowest']); ?>
 人 まで
</td>
<td width=80>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_lowest_price']); ?>
円
</td>
<?php if ($this->_tpl_vars['room_data']['k_lowest_discount']['1']): ?>
<td>
パターン1: <span style="color: #FF0000;"><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_lowest_discount']['1']); ?>
</span>円
</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['room_data']['k_lowest_discount']['2']): ?>
<td>
パターン2: <span style="color: #FF0000;"><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_lowest_discount']['2']); ?>
</span>円
</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['room_data']['k_lowest_discount']['3']): ?>
<td>
パターン3: <span style="color: #FF0000;"><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_lowest_discount']['3']); ?>
</span>円
</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['room_data']['k_lowest_discount']['4']): ?>
<td>
パターン4: <span style="color: #FF0000;"><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_lowest_discount']['4']); ?>
</span>円
</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['room_data']['k_lowest_discount']['5']): ?>
<td>
パターン5: <span style="color: #FF0000;"><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_lowest_discount']['5']); ?>
</span>円
</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['room_data']['k_lowest_discount']['6']): ?>
<td>
パターン6 <span style="color: #FF0000;"><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_lowest_discount']['6']); ?>
</span>円
</td>
<?php endif; ?>

</tr>
<?php endif; ?>
<?php if ($this->_tpl_vars['room_data']['k_price2']): ?>
<tr>
<td bgcolor=#CDCDCD>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_capa_low2']); ?>
 人 ～ <?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_capa_high2']); ?>
 人 まで
</td>
<td width=80>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_price2']); ?>
円
</td>

<?php if ($this->_tpl_vars['room_data']['k_price2_discount']['1']): ?>
<td>
パターン1: <span style="color: #FF0000;"><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_price2_discount']['1']); ?>
</span>円
</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['room_data']['k_price2_discount']['2']): ?>
<td>
パターン2: <span style="color: #FF0000;"><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_price2_discount']['2']); ?>
</span>円
</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['room_data']['k_price2_discount']['3']): ?>
<td>
パターン3: <span style="color: #FF0000;"><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_price2_discount']['3']); ?>
</span>円
</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['room_data']['k_price2_discount']['4']): ?>
<td>
パターン4: <span style="color: #FF0000;"><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_price2_discount']['4']); ?>
</span>円
</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['room_data']['k_price2_discount']['5']): ?>
<td>
パターン5: <span style="color: #FF0000;"><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_price2_discount']['5']); ?>
</span>円
</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['room_data']['k_price2_discount']['6']): ?>
<td>
パターン6 <span style="color: #FF0000;"><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_price2_discount']['6']); ?>
</span>円
</td>
<?php endif; ?>

</tr>
<?php endif; ?>
<?php if ($this->_tpl_vars['room_data']['k_price3']): ?>
<tr>
<td bgcolor=#CDCDCD>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_capa_low3']); ?>
 人 ～ <?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_capa_high3']); ?>
 人 まで
</td>
<td width=80>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_price3']); ?>
円
</td>

<?php if ($this->_tpl_vars['room_data']['k_price3_discount']['1']): ?>
<td>
パターン1: <span style="color: #FF0000;"><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_price3_discount']['1']); ?>
</span>円
</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['room_data']['k_price3_discount']['2']): ?>
<td>
パターン2: <span style="color: #FF0000;"><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_price3_discount']['2']); ?>
</span>円
</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['room_data']['k_price3_discount']['3']): ?>
<td>
パターン3: <span style="color: #FF0000;"><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_price3_discount']['3']); ?>
</span>円
</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['room_data']['k_price3_discount']['4']): ?>
<td>
パターン4: <span style="color: #FF0000;"><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_price3_discount']['4']); ?>
</span>円
</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['room_data']['k_price3_discount']['5']): ?>
<td>
パターン5: <span style="color: #FF0000;"><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_price3_discount']['5']); ?>
</span>円
</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['room_data']['k_price3_discount']['6']): ?>
<td>
パターン6 <span style="color: #FF0000;"><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_price3_discount']['6']); ?>
</span>円
</td>
<?php endif; ?>

</tr>
<?php endif; ?>
<?php if ($this->_tpl_vars['room_data']['k_highest_price']): ?>
<tr>
<td bgcolor=#CDCDCD>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_capa_highest']); ?>
 人 以上
</td>
<td width=80>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_highest_price']); ?>
円
</td>

<?php if ($this->_tpl_vars['room_data']['k_highest_discount']['1']): ?>
<td>
パターン1: <span style="color: #FF0000;"><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_highest_discount']['1']); ?>
</span>円
</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['room_data']['k_highest_discount']['2']): ?>
<td>
パターン2: <span style="color: #FF0000;"><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_highest_discount']['2']); ?>
</span>円
</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['room_data']['k_highest_discount']['3']): ?>
<td>
パターン3: <span style="color: #FF0000;"><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_highest_discount']['3']); ?>
</span>円
</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['room_data']['k_highest_discount']['4']): ?>
<td>
パターン4: <span style="color: #FF0000;"><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_highest_discount']['4']); ?>
</span>円
</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['room_data']['k_highest_discount']['5']): ?>
<td>
パターン5: <span style="color: #FF0000;"><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_highest_discount']['5']); ?>
</span>円
</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['room_data']['k_highest_discount']['6']): ?>
<td>
パターン6 <span style="color: #FF0000;"><?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['k_highest_discount']['6']); ?>
</span>円
</td>
<?php endif; ?>

</tr>
<?php endif; ?>
</table>
<?php endif; ?>
<br><br>

<table>
<tr>
<td valign=top>


<form name="discount" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('add_room_discount','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
" />
<input type="hidden" name="room_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_id']); ?>
" />
<input type="hidden" name="mode" value="0">
<table border=1>


<?php $_from = $this->_tpl_vars['discount']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<?php if ($this->_tpl_vars['item']['num'] < 4): ?>
<?php if ($this->_tpl_vars['item']['num'] == 1): ?>
<tr>
<th colspan=8 height=30 bgcolor="#FE3568"><span style="color:#FFFFFF">【割引設定1】※日付・期間での割引設定</span>
</th>
</tr>
<tr>
<td bgcolor="#FFC6C0"><b>有効</b></td>
<td bgcolor="#FFC6C0"><b>パターンID</b></td>
<td bgcolor="#FFC6C0"><b>開始期間</b></td>
<td></td>
<td bgcolor="#FFC6C0"><b>終了期間</b></td>
<td bgcolor="#FFC6C0"><b>割引率</b></td>
<td></td>
</tr>
<?php endif; ?>
<tr>
<td>
<input type="radio" name="pattern" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
" <?php if ($this->_tpl_vars['item']['list']['flag']): ?>checked<?php endif; ?>>
</td>
<td>
パターン<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['num']); ?>

</td>
<td>
<select name="begin_year<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['num']); ?>
">
<option value="">選択</option>
<?php $_from = $this->_tpl_vars['year_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['year']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
" <?php if ($this->_tpl_vars['year'] == $this->_tpl_vars['item']['list']['begin_year']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
年
<select name="begin_month<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['num']); ?>
">
<?php $_from = $this->_tpl_vars['month_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['month']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
" <?php if ($this->_tpl_vars['month'] == $this->_tpl_vars['item']['list']['begin_month']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
月
<select name="begin_day<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['num']); ?>
">
<?php $_from = $this->_tpl_vars['day_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['day']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']); ?>
" <?php if ($this->_tpl_vars['day'] == $this->_tpl_vars['item']['list']['begin_day']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['day']); ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
日
</td>
<td width=40>
から
</td>
<td>
<select name="finish_year<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['num']); ?>
">
<option value="">選択</option>
<?php $_from = $this->_tpl_vars['year_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['year']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
" <?php if ($this->_tpl_vars['year'] == $this->_tpl_vars['item']['list']['finish_year']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
年
<select name="finish_month<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['num']); ?>
">
<?php $_from = $this->_tpl_vars['month_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['month']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
" <?php if ($this->_tpl_vars['month'] == $this->_tpl_vars['item']['list']['finish_month']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
月
<select name="finish_day<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['num']); ?>
">
<?php $_from = $this->_tpl_vars['day_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['day']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']); ?>
" <?php if ($this->_tpl_vars['day'] == $this->_tpl_vars['item']['list']['finish_day']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['day']); ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
日
</td>
<td>
<input type="text" name="percent<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['num']); ?>
" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['list']['percent']); ?>
" size=5>
</td>
<td width=40>
%割引
</td>
</tr>
<?php else: ?>
<?php if ($this->_tpl_vars['item']['num'] == 4): ?>
<tr>
<th colspan=8 height=30 bgcolor="#FE3568"><span style="color:#FFFFFF">【割引設定2】※継続的な割引設定</span></th>
</tr>
<tr>
<td bgcolor="#FFC6C0"><b>有効</b></td>
<td bgcolor="#FFC6C0"><b>パターンID</b></td>
<td bgcolor="#FFC6C0"><b>対象 / 割引率</b></td>
</tr>
<?php endif; ?>
<tr>
<td>
<input type="radio" name="pattern" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
" <?php if ($this->_tpl_vars['item']['list']['flag']): ?>checked<?php endif; ?>>
</td>
<td>
パターン<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['num']); ?>

</td>
<td>
<select name="continuance<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['num']); ?>
">
<?php $_from = $this->_tpl_vars['continuance']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['continue']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
" <?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['item']['list']['continuance']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['continue']); ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
<input type="text" name="percent<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['num']); ?>
" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['list']['percent']); ?>
" size=5>
</td>
<td>
%割引
</td>
</tr>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<tr>
<td colspan=8>

<table>
<tr>
<td>
<input type="submit" value="　割　引　登　録　">
</form>
</td>
<td>
<form name="discount" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('add_room_discount','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
" />
<input type="hidden" name="room_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_id']); ?>
" />
<input type="hidden" name="mode" value="1">
<input type="submit" value=" 設　定　解　除　">
</form>
</td>
</tr>
</table>

</td>
</tr>
</table>

</td>
<td valign=top>




<form name="pack" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('add_room_pack','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
" />
<input type="hidden" name="room_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_id']); ?>
" />

<table>
<tr>
<?php $_from = $this->_tpl_vars['pack_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<td valign=top width=5></td>
<td>

<table border=1>
<tr>
<td colspan=2 height=30 bgcolor="#FE3568">
<input type="checkbox" name="pack_flag<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['num']); ?>
" value="1" <?php if ($this->_tpl_vars['item']['data']['pack_flag']): ?>checked<?php endif; ?>>
<span style="color:#FFFFFF"><b>パック料金設定<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['num']); ?>
</b></span></td>
</tr>
<tr>
<td bgcolor="#FFC6C0"><b>名称</b></td>
<td><input type="text" name="pack_name<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['num']); ?>
" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['data']['pack_name']); ?>
" size=15></td>
</tr>
<?php if ($this->_tpl_vars['room_data']['type'] == 1): ?>
<tr>
<td bgcolor="#FFC6C0"><b>適用時間</b></td>
<td>
<select name="begin_time<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['num']); ?>
">
<?php $_from = $this->_tpl_vars['open_time']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['open']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['open']); ?>
" <?php if ($this->_tpl_vars['open'] == $this->_tpl_vars['item']['data']['begin_time']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['open']); ?>
時</option>
<?php endforeach; endif; unset($_from); ?>
</select>
～
<select name="finish_time<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['num']); ?>
">
<?php $_from = $this->_tpl_vars['open_time']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['open']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['open']); ?>
" <?php if ($this->_tpl_vars['open'] == $this->_tpl_vars['item']['data']['finish_time']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['open']); ?>
時</option>
<?php endforeach; endif; unset($_from); ?>
</select>
</td>
</tr>
<?php else: ?>
<tr>
<td bgcolor="#FFC6C0"><b>連続コマ数</b></td>
<td>

<select name="koma1_<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['num']); ?>
">
<?php $_from = $this->_tpl_vars['koma_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['koma']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['koma']); ?>
" <?php if ($this->_tpl_vars['koma'] == $this->_tpl_vars['item']['data']['koma1']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['koma']); ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>

～

<select name="koma2_<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['num']); ?>
">
<?php $_from = $this->_tpl_vars['koma_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['koma']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['koma']); ?>
" <?php if ($this->_tpl_vars['koma'] == $this->_tpl_vars['item']['data']['koma2']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['koma']); ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>

 コマ<br>
最低予約コマ数：<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_data']['lowest_koma']); ?>

</td>
</tr>
<?php endif; ?>
<tr>
<td bgcolor="#FFC6C0"><b>Pack料金</b></td>
<td><input type="text" name="price<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['num']); ?>
" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['data']['price']); ?>
" size=10> <?php if ($this->_tpl_vars['room_data']['type'] == 1): ?>円<?php else: ?>%割引<?php endif; ?></td>
</tr>
</table>
</td>
<?php if ($this->_tpl_vars['key'] % 2 == 0): ?></tr><tr><?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
</tr>
</table>

<input type="submit" value="　Pack 登　録　">
</form>



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
