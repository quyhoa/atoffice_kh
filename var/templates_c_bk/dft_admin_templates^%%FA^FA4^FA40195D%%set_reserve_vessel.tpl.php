<?php /* Smarty version 2.6.18, created on 2010-08-30 20:12:07
         compiled from file:/var/www/atoffice_torioki20100712/webapp/modules/admin/templates/set_reserve_vessel.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/atoffice_torioki20100712/webapp/modules/admin/templates/set_reserve_vessel.tpl', 2, false),array('modifier', 't_escape', 'file:/var/www/atoffice_torioki20100712/webapp/modules/admin/templates/set_reserve_vessel.tpl', 32, false),array('modifier', 'nl2br', 'file:/var/www/atoffice_torioki20100712/webapp/modules/admin/templates/set_reserve_vessel.tpl', 173, false),array('modifier', 't_url2cmd', 'file:/var/www/atoffice_torioki20100712/webapp/modules/admin/templates/set_reserve_vessel.tpl', 173, false),array('modifier', 't_cmd', 'file:/var/www/atoffice_torioki20100712/webapp/modules/admin/templates/set_reserve_vessel.tpl', 173, false),array('modifier', 't_decoration', 'file:/var/www/atoffice_torioki20100712/webapp/modules/admin/templates/set_reserve_vessel.tpl', 173, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminSiteMember.tpl"), $this);?>

<?php $this->assign('page_name', "予約備品入力"); ?>
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

<script type="text/javascript">
function pre_kanban(){
	kanban = encodeURI(document.getElementById("kanban").value);
	window.open('./atoffice/pages/sub/kanban.php?kanban='+kanban,'','scrollbars=yes,width=1050,height=750,');

}
</script>

<h2 id="ttl01">予約備品入力</h2>
<br>
<center>
<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><br><br>
<INPUT TYPE=button VALUE="　戻る　" style="width:250px;font:20px;border:3px ridge;background:#090;color:#fff; padding:3px; font-weight:bold;" onClick="self.history.back()">
<?php else: ?>

<form name="do_set_reserve" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('reserve_confirm','page')); ?>
" />
<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
">
<input type="hidden" name="room_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_id']); ?>
">
<input type="hidden" name="begin_datetime" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['begin_datetime']); ?>
">
<input type="hidden" name="finish_datetime" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['finish_datetime']); ?>
">
<input type="hidden" name="purpose" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['purpose']); ?>
">
<input type="hidden" name="people" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['people']); ?>
">
<input type="hidden" name="room_price" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_price']); ?>
">
<input type="hidden" name="c_member_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member_id']); ?>
">
<input type="hidden" name="vessel_num" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['vessel_num']); ?>
">
<input type="hidden" name="service_num" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['service_num']); ?>
">


<table border=1 width=700>
<tr>
<td width=100 bgcolor=#AACCFF>利用施設名</td>
<td width=250><?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_name']); ?>
</td>
<td width=100 bgcolor=#AACCFF>部屋名</td>
<td width=250>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_name']); ?>

</td>
</tr>
<tr>
<td bgcolor=#AACCFF>利用日時</td>
<td colspan=3><?php echo smarty_modifier_t_escape($this->_tpl_vars['begin_datetime']); ?>
 ～ <?php echo smarty_modifier_t_escape($this->_tpl_vars['finish_datetime']); ?>
</td>
</tr>

<tr>
<td width=100 bgcolor=#AACCFF>利用目的</td>
<td>
<?php if ($this->_tpl_vars['purpose'] == 0): ?>
	未選択
<?php elseif ($this->_tpl_vars['purpose'] == 1): ?>
	会議
<?php elseif ($this->_tpl_vars['purpose'] == 2): ?>
	セミナー
<?php elseif ($this->_tpl_vars['purpose'] == 3): ?>
	研修
<?php elseif ($this->_tpl_vars['purpose'] == 4): ?>
	面接・試験
<?php elseif ($this->_tpl_vars['purpose'] == 5): ?>
	懇談会・パーティ
<?php elseif ($this->_tpl_vars['purpose'] == 6): ?>
	その他
<?php endif; ?>
</td>
<td width=100 bgcolor=#AACCFF>利用人数</td><td><?php echo smarty_modifier_t_escape($this->_tpl_vars['people']); ?>
 人</td>
</tr>

<tr>
<td bgcolor=#AACCFF>利用料金</td>
<td colspan=3>
<?php if ($this->_tpl_vars['percent']): ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['waribiki']); ?>
 / <?php echo smarty_modifier_t_escape($this->_tpl_vars['percent']); ?>
%割引：<?php endif; ?>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_price']); ?>
 円
</td>
</tr>

<tr>
<td bgcolor=#AACCFF>看板入力</td>
<td colspan=3>
<textarea id=kanban name=kanban rows="3" cols="40"></textarea>
<input type="button" value="　プレビュー　" onClick="pre_kanban();"/>
</td>
</tr>

<tr>
<td bgcolor=#AACCFF>顧客ID</td>
<td>
<?php if ($this->_tpl_vars['c_member_id']): ?>
	<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member_id']); ?>

<?php else: ?>
	-- --
<?php endif; ?>
</td>
<td bgcolor=#AACCFF>顧客氏名</td>
<td>
<?php if ($this->_tpl_vars['c_member_id']): ?>
	<a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('c_member_detail')); ?>
&amp;target_c_member_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member_id']); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['nickname']); ?>
</a>
<?php else: ?>
	新規契約者
<?php endif; ?>
</td>
</tr>

</table>
<br>

<?php if ($this->_tpl_vars['vessel_list']): ?>
<table border=1 width=700>
<tr>
<th colspan=6 bgcolor=#EEFFCC>備品選択</th>
</tr>
<tr>
<th bgcolor=#DEDEDE>選択</th>
<th bgcolor=#DEDEDE>名称</th>
<th bgcolor=#DEDEDE>利用料金</th>
<th bgcolor=#DEDEDE>数量</th>
<th bgcolor=#DEDEDE>料金区分</th>
<th bgcolor=#DEDEDE>メモ</th>
</tr>
<?php $_from = $this->_tpl_vars['vessel_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
	<tr>
	<td>
	<?php if ($this->_tpl_vars['value']['remainder']): ?>
		<input type="checkbox" name="select_vessel<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['vessel_id']); ?>
" >
	<?php else: ?>
		--
	<?php endif; ?>

	</td>
	<td>
	<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['vessel_name']); ?>

	</td>
	<td>
	<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['price']); ?>
 円
	</td>
	<td>
	<?php if ($this->_tpl_vars['value']['remainder']): ?>
		<select name="remainder<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
">
		<?php $_from = $this->_tpl_vars['value']['remainder']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
			<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
		</select>
	<?php else: ?>
		在庫切れ
	<?php endif; ?>
	</td>
	<td>
	<?php if ($this->_tpl_vars['value']['charge_devision'] == 1): ?>
		予約毎
	<?php else: ?>
		時間毎
	<?php endif; ?>
	</td>
	<td>
		<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['value']['memo1']))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('t_url2cmd', true, $_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id'])) : smarty_modifier_t_url2cmd($_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id']))))) ? $this->_run_mod_handler('t_cmd', true, $_tmp, 'diary') : smarty_modifier_t_cmd($_tmp, 'diary')))) ? $this->_run_mod_handler('t_decoration', true, $_tmp) : smarty_modifier_t_decoration($_tmp)); ?>

	</td>
	</tr>
<?php endforeach; endif; unset($_from); ?>

</table>
<br>
<?php endif; ?>

<?php if ($this->_tpl_vars['service_list']): ?>
<table border=1 width=700>
<tr>
<th colspan=6 bgcolor=#EECCFF>サービス選択</th>
</tr>
<tr>
<th bgcolor=#DEDEDE>選択</th>
<th bgcolor=#DEDEDE>名称</th>
<th bgcolor=#DEDEDE>利用料金</th>
<th bgcolor=#DEDEDE>数量</th>
<th bgcolor=#DEDEDE>キャンセル料に<br>含まれるか</th>
<th bgcolor=#DEDEDE>メモ</th>
</tr>
<?php $_from = $this->_tpl_vars['service_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
	<tr>
	<td>
	<input type="checkbox" name="select_service<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['service_id']); ?>
" >
	</td>
	<td>
	<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['service_name']); ?>

	</td>
	<td>
	<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['price']); ?>
 円
	</td>
	<td>
	<input type="text" name="service_remainder<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['minimum_orders']); ?>
" style="text-align:right;padding-right:5px;"><br>
	最低予約数：<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['minimum_orders']); ?>

	</td>
	<td>
	<?php if ($this->_tpl_vars['value']['cancel_mode'] == 1): ?>
		含む
	<?php else: ?>
		含まない
	<?php endif; ?>
	</td>
	<td>
		<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['value']['memo1']))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('t_url2cmd', true, $_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id'])) : smarty_modifier_t_url2cmd($_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id']))))) ? $this->_run_mod_handler('t_cmd', true, $_tmp, 'diary') : smarty_modifier_t_cmd($_tmp, 'diary')))) ? $this->_run_mod_handler('t_decoration', true, $_tmp) : smarty_modifier_t_decoration($_tmp)); ?>

	</td>
	</tr>
<?php endforeach; endif; unset($_from); ?>

</table>
<?php endif; ?>


<br>
<INPUT TYPE=button VALUE="　戻る　" style="width:250px;font:20px;border:3px ridge;background:#090;color:#fff; padding:3px; font-weight:bold;" onClick="self.history.back()">
<INPUT TYPE="submit" VALUE="　確認　" style="width:250px;font:20px;border:3px ridge;background:#090;color:#fff; padding:3px; font-weight:bold;">

</form>

</center>

<?php endif; ?>
<?php else: ?>
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
<?php endif; ?>
<div>
<?php echo $this->_tpl_vars['inc_footer']; ?>
