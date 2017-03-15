<?php /* Smarty version 2.6.18, created on 2016-12-29 08:31:26
         compiled from file:/var/www/html/atoffice/webapp/modules/admin/templates/incomplete_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/incomplete_list.tpl', 2, false),array('modifier', 't_escape', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/incomplete_list.tpl', 21, false),array('modifier', 'default', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/incomplete_list.tpl', 238, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminDesign.tpl"), $this);?>

<?php $this->assign('page_name', "未完了報告リスト"); ?>
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

<h2 id="ttl01">【<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_name']); ?>
】未完了報告リスト (
<?php if ($this->_tpl_vars['reserve_data']): ?>
	<?php echo smarty_modifier_t_escape($this->_tpl_vars['num']); ?>
件中　<?php echo smarty_modifier_t_escape($this->_tpl_vars['index']+1); ?>
件～
	<?php if ($this->_tpl_vars['index'] + 10 > $this->_tpl_vars['num']): ?>
		<?php echo smarty_modifier_t_escape($this->_tpl_vars['num']); ?>

	<?php else: ?>
		<?php echo smarty_modifier_t_escape($this->_tpl_vars['index']+10); ?>

	<?php endif; ?>
	件を表示
<?php else: ?>
	0件
<?php endif; ?>
)</h2>
<br>
<center>
<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><br><br><?php endif; ?>

<br><br>

<?php if ($this->_tpl_vars['atoffice_auth_type'] == 2 || $this->_tpl_vars['atoffice_auth_type'] == 4): ?>
	<form name="change_hall_id" method="POST" action="./">
	<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
	<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('incomplete_list','page')); ?>
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
<?php if ($this->_tpl_vars['atoffice_auth_type'] == 3): ?>
	<form name="change_hall_id" method="POST" action="./">
	<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
	<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('incomplete_list','page')); ?>
" />
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
	<input type="submit" value="　決定　">
	</form>
	<br>
<?php endif; ?>
<?php $_from = $this->_tpl_vars['page_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<?php if ($this->_tpl_vars['item']['select']): ?>
	<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['page']); ?>

<?php else: ?>
	<a href="./?m=admin&a=page_incomplete_list&hall_list=<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
&index=<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['index']); ?>
" ><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['page']); ?>
</a>
<?php endif; ?>
|
<?php endforeach; endif; unset($_from); ?>
<hr>
<br>
<?php $_from = $this->_tpl_vars['reserve_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>

<table width=700>

<tr>
<th colspan=4 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FF6666>予約情報</th>
</tr>
<tr>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD>予約ID</td>
<td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
</td>
<td width=100 rowspan=2 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD>利用日</td>
<td rowspan=2 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['begin_datetime']); ?>
<br>～<br><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['finish_datetime']); ?>
</td>
</tr>
<tr>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD>予約状態</td>
<td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'><?php if ($this->_tpl_vars['item']['tmp_flag'] == 1): ?>
	仮予約
<?php elseif ($this->_tpl_vars['item']['pay_flag'] == 0 && $this->_tpl_vars['pay_money'] == 0): ?>
	未入金
<?php elseif ($this->_tpl_vars['item']['pay_flag'] == 0 && $this->_tpl_vars['pay_money'] > 0): ?>
	一部入金
<?php elseif ($this->_tpl_vars['item']['pay_flag'] == 1): ?>
	入金済み
<?php else: ?>
	???
<?php endif; ?>

</td>
</tr>

<tr>
<th colspan=4 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FF6666>申込者情報</th>
</tr>
<tr>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD>登録番号</td>
<td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_member_data']['c_member_id']); ?>
</td>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD></td>
<td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'></td>
</tr>

<tr>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD>法人・個人名</td>
<td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['corp']); ?>
</td>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD>部署名</td>
<td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'><?php if ($this->_tpl_vars['busho']): ?>
	<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['busho']); ?>

<?php else: ?>
	-- --
<?php endif; ?>
</td>
</tr>
</table>
<form method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="reporter" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['reporter']); ?>
" />
<input type="hidden" name="page" value="incomplete_list" />
<input type="hidden" name="reserve_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
" />
<input type="hidden" name="tail" value="hall_list=<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
&index=<?php echo smarty_modifier_t_escape($this->_tpl_vars['index']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('add_report','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />

<table width=700>
<tr>
<th colspan=2 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FF6666>完了報告</th>
</tr>
<tr>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD>報告担当者</td>
<td style='border: 1px #000000 solid;text-align: left;vertical-align:middle;'>
<span style="margin:5px"><?php echo smarty_modifier_t_escape($this->_tpl_vars['name']); ?>
</span>
</td>
</tr>

<tr>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD>チェック事項</td>
<td style='border: 1px #000000 solid;text-align: left;vertical-align:middle;'>

<table>
<tr>
<td>①原状復帰されたか？</td>
<td>
<input type="radio" name="original_state" value="0" checked> はい
<input type="radio" name="original_state" value="1"> いいえ
</td>
<td></td>
</tr>
<tr>
<td>②貸出備品は回収したか？</td>
<td>
<input type="radio" name="vessel_collect" value="0" checked> はい
<input type="radio" name="vessel_collect" value="1"> いいえ
</td>
<td></td>
</tr>
<tr>
<td>③利用者はごみを持ち帰ったか？</td>
<td>
<input type="radio" name="garbage" value="0" checked> はい
<input type="radio" name="garbage" value="1"> いいえ
</td>
<td></td>
</tr>
<tr>
<td>④室内の汚れ、破損はないか？</td>
<td>
<input type="radio" name="room_check" value="0" checked> はい
<input type="radio" name="room_check" value="1"> いいえ
</td>
<td>
<span style="margin:5px">報告：<input type="text" name="room_check_info" size=30></span>
</td>
</tr>
<tr>
<td>⑤忘れ物はないか？</td>
<td>
<input type="radio" name="thing_left" value="0" checked> はい
<input type="radio" name="thing_left" value="1"> いいえ
</td>
<td>
<span style="margin:5px">報告：<input type="text" name="thing_left_info" size=30></span>
</td>
</tr>
</table>

</td>
</tr>

<tr>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD>ブラックリスト<br>追加依頼</td>
<td style='border: 1px #000000 solid;text-align: left;vertical-align:middle;'>
<input type="radio" name="blacklist_request" value="1"> 追加依頼
<input type="radio" name="blacklist_request" value="0" checked> なし
<span style="margin:5px">理由：<input type="text" name="blacklist_request_info" size=60></span>
</td>
</tr>

<tr>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD>その他問題事項</td>
<td style='border: 1px #000000 solid;text-align: left;vertical-align:middle;'>
<textarea id="mce_editor_textarea" name="report" rows="<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['_rows']))) ? $this->_run_mod_handler('default', true, $_tmp, '6') : smarty_modifier_default($_tmp, '6')); ?>
" cols="<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['_cols']))) ? $this->_run_mod_handler('default', true, $_tmp, '70') : smarty_modifier_default($_tmp, '70')); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['agreement']); ?>
</textarea>
</td>
</tr>

<tr>
<td colspan=2 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'>
<input type="submit" value="　報　告　">
</td>
</tr>
</table>
</form>
<br>


<?php endforeach; else: ?>
未報告な予約データはありません。
<?php endif; unset($_from); ?>

<br>
<hr>
<?php $_from = $this->_tpl_vars['page_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<?php if ($this->_tpl_vars['item']['select']): ?>
	<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['page']); ?>

<?php else: ?>
	<a href="./?m=admin&a=page_incomplete_list&hall_list=<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
&index=<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['index']); ?>
" ><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['page']); ?>
</a>
<?php endif; ?>
|
<?php endforeach; endif; unset($_from); ?>
<br>

</center>

<?php else: ?>
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
<?php endif; ?>
<div>
<?php echo $this->_tpl_vars['inc_footer']; ?>
