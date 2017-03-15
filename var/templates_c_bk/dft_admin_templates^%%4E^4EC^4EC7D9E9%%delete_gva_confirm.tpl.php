<?php /* Smarty version 2.6.18, created on 2016-03-11 14:22:51
         compiled from file:/var/www/atoffice/webapp/modules/admin/templates/delete_gva_confirm.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/atoffice/webapp/modules/admin/templates/delete_gva_confirm.tpl', 2, false),array('modifier', 't_escape', 'file:/var/www/atoffice/webapp/modules/admin/templates/delete_gva_confirm.tpl', 15, false),array('modifier', 'count', 'file:/var/www/atoffice/webapp/modules/admin/templates/delete_gva_confirm.tpl', 28, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminStatisticalInformation.tpl"), $this);?>

<?php $this->assign('page_name', "ゲスト未使用固定口座解放"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminStatisticalInformation.tpl"), $this);?>

</div>


<?php if ($this->_tpl_vars['atoffice_auth_type'] == 4): ?>

<h2 id="ttl01">ゲスト未使用固定口座解放</h2>
<br>
<center>
<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><br><br><?php endif; ?>

<br>
<center>
<table border=1 bgcolor=#DDFFFF>
<tr>
<td style="text-align:center;" width=600>
<h2 id="ttl01">CSVダウンロード</h2>
<form name="delete_gva_csv" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('delete_gva_csv','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<input type="hidden" name="delete_month" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['dm']); ?>
">
<input type="<?php if (count($this->_tpl_vars['c_member']) > 0): ?>submit<?php else: ?>button<?php endif; ?>" value="　ダウンロード　">
</form>
</td>
</tr>
</table>
</center>

<br>


<?php echo smarty_modifier_t_escape($this->_tpl_vars['dm']); ?>
ヵ月以内に利用していないゲストで、固定口座を持っている顧客<br>

<table width=700 border=1>
<tr>
<th bgcolor=#CDCDCD>顧客名</th>
<th bgcolor=#CDCDCD>法人/団体名</th>
<th bgcolor=#CDCDCD>最終仮予約登録日</th>
<th bgcolor=#CDCDCD>バーチャル口座番号</th>
</tr>
<?php $_from = $this->_tpl_vars['c_member']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<tr>
<td><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('c_member_detail')); ?>
&amp;target_c_member_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_member_id']); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['nickname']); ?>
</a></td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['corp']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['tmp_reserve_datetime']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['virtual_number']); ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>
<br>
<form name="delete_gva" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('delete_gva','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<input type="hidden" name="delete_month" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['dm']); ?>
">
<input type="submit" value="　解放する　">
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
