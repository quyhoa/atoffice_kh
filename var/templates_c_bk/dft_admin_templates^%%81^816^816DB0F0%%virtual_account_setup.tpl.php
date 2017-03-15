<?php /* Smarty version 2.6.18, created on 2016-03-11 14:19:43
         compiled from file:/var/www/atoffice/webapp/modules/admin/templates/virtual_account_setup.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/atoffice/webapp/modules/admin/templates/virtual_account_setup.tpl', 2, false),array('modifier', 't_escape', 'file:/var/www/atoffice/webapp/modules/admin/templates/virtual_account_setup.tpl', 15, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminStatisticalInformation.tpl"), $this);?>

<?php $this->assign('page_name', "バーチャル口座設定"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminStatisticalInformation.tpl"), $this);?>

</div>


<?php if ($this->_tpl_vars['atoffice_auth_type'] == 4): ?>

<h2 id="ttl01">バーチャル口座設定</h2>
<br>
<center>
<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><br><br><?php endif; ?>



<table border=1>
<tr>
<th bgcolor=#cdcdcd><span style='margin:5px;'>銀行名</span></th>
<th bgcolor=#cdcdcd><span style='margin:5px;'>支店名</span></th>
<th bgcolor=#cdcdcd><span style='margin:5px;'>名義人</span></th>
<th bgcolor=#cdcdcd><span style='margin:5px;'>仮想支店番号</span></th>
<th bgcolor=#cdcdcd><span style='margin:5px;'>操作</span></th>
</tr>
<?php $_from = $this->_tpl_vars['virtual_ac']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<tr>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['bank']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['branch']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['account']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['branch_id']); ?>
</td>
<td>
<form name="approval<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('delete_virtual_account_conf','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<input type="hidden" name="branch_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['branch_id']); ?>
">
<input type="submit" value="　削除　">

</form>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
<tr>
<td>
<form name="approval" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('set_virtual_account','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<span style='margin:5px;'>
<input type="text" name="bank" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['virtual_ac']['bank']); ?>
">
</span></td>
<td><span style='margin:5px;'>
<input type="text" name="branch" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['virtual_ac']['branch']); ?>
" size=25>
</span></td>
<td><span style='margin:5px;'>
<input type="text" name="account" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['virtual_ac']['account']); ?>
" size=25>
</span></td>
<td><span style='margin:5px;'>
3桁：<input type="text" name="branch_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['virtual_ac']['branch_id']); ?>
">
</span></td>
<td>
<input type="submit" value="　登録　">
</td>
</tr>
</table>
</form>
</center>
<br>

<br>
<h2 id="ttl01">ゲスト未使用固定口座解放</h2>
<br>
<center>
<table border=1 bgcolor=#DDFFFF>
<tr>
<td style="text-align:center;" width=600>
<form name="delete_gva_confirm" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('delete_gva_confirm','page')); ?>
" />
ゲスト顧客で、
<input type="text" name="delete_month" value="3" size=8 style="text-align:right;padding-right:5px;">
ヵ月以内に予約のなかった固定口座を解除する。<br>
<input type="submit" value="　確認画面へ　">
</form>
</td>
</tr>
</table>
</center>

<br>
<h2 id="ttl01">バーチャル口座利用状況一覧(
<?php if ($this->_tpl_vars['kouza_list']): ?>
	<?php echo smarty_modifier_t_escape($this->_tpl_vars['num']); ?>
件中　<?php echo smarty_modifier_t_escape($this->_tpl_vars['index']+1); ?>
件～
	<?php if ($this->_tpl_vars['index'] + 100 > $this->_tpl_vars['num']): ?>
		<?php echo smarty_modifier_t_escape($this->_tpl_vars['num']); ?>

	<?php else: ?>
		<?php echo smarty_modifier_t_escape($this->_tpl_vars['index']+100); ?>

	<?php endif; ?>
	件を表示
<?php else: ?>
	0件
<?php endif; ?>
)</h2>
<br>
<center>
<span style="font-size:16px;">
<span style="color:#FFCC00;">■</span>
固定利用客用ID(<b><?php echo smarty_modifier_t_escape($this->_tpl_vars['kotei']); ?>
</b>件)</span>　
<span style="font-size:16px;">
<span style="color:#FF0000;">■</span>
利用中ID(<b><?php echo smarty_modifier_t_escape($this->_tpl_vars['using']); ?>
</b>件)</span>
<br><br>
<?php $_from = $this->_tpl_vars['page_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<?php if ($this->_tpl_vars['item']['select']): ?>
	<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['page']); ?>

<?php else: ?>
	<a href="./?m=admin&a=page_virtual_account_setup&index=<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['index']); ?>
" ><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['page']); ?>
</a>
<?php endif; ?>
|
<?php endforeach; endif; unset($_from); ?>
<hr>

<table border=1>
<tr>
<th bgcolor=#cdcdcd>SEQ番号</th><th bgcolor=#cdcdcd>口座番号</th><th bgcolor=#cdcdcd>状態</th><th bgcolor=#cdcdcd>利用者</th>
<th bgcolor=#cdcdcd>SEQ番号</th><th bgcolor=#cdcdcd>口座番号</th><th bgcolor=#cdcdcd>状態</th><th bgcolor=#cdcdcd>利用者</th>
<th bgcolor=#cdcdcd>SEQ番号</th><th bgcolor=#cdcdcd>口座番号</th><th bgcolor=#cdcdcd>状態</th><th bgcolor=#cdcdcd>利用者</th>
<th bgcolor=#cdcdcd>SEQ番号</th><th bgcolor=#cdcdcd>口座番号</th><th bgcolor=#cdcdcd>状態</th><th bgcolor=#cdcdcd>利用者</th>
</tr>
<tr>
<?php $_from = $this->_tpl_vars['kouza_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<td><span style='margin:5px;'>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['seq_number']); ?>

</span></td>
<td><span style='margin:5px;'>
<?php if ($this->_tpl_vars['item']['nickname']): ?>
<a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('reserve_view')); ?>
&amp;virtual_number=<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['virtual_number']); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['virtual_number']); ?>
</a>
<?php else: ?>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['virtual_number']); ?>

<?php endif; ?>
</span></td>
<td width=15 style='border: 1px #000000 solid;' <?php if ($this->_tpl_vars['item']['flag']): ?>bgcolor=#FF0000<?php elseif ($this->_tpl_vars['item']['kotei']): ?>bgcolor=#FFCC00<?php else: ?>bgcolor=#CCFFCC<?php endif; ?>></td>
<td width=100><span style='margin:5px;'>
<a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('c_member_detail')); ?>
&amp;target_c_member_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_member_id']); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['nickname']); ?>
</a>
</span></td>


<?php if ($this->_tpl_vars['key'] % 4 == 3): ?>
</tr><tr>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
</tr>
</table>
<hr>
<?php $_from = $this->_tpl_vars['page_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<?php if ($this->_tpl_vars['item']['select']): ?>
	<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['page']); ?>

<?php else: ?>
	<a href="./?m=admin&a=page_virtual_account_setup&index=<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['index']); ?>
" ><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['page']); ?>
</a>
<?php endif; ?>
|
<?php endforeach; endif; unset($_from); ?>

</center>
<?php else: ?>
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
<?php endif; ?>
<div>
<?php echo $this->_tpl_vars['inc_footer']; ?>
