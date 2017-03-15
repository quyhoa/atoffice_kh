<?php /* Smarty version 2.6.18, created on 2016-03-09 09:53:01
         compiled from file:/var/www/atoffice/webapp/modules/admin/templates/hall_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/atoffice/webapp/modules/admin/templates/hall_list.tpl', 2, false),array('modifier', 't_escape', 'file:/var/www/atoffice/webapp/modules/admin/templates/hall_list.tpl', 14, false),array('modifier', 'default', 'file:/var/www/atoffice/webapp/modules/admin/templates/hall_list.tpl', 69, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminImageKakikomi.tpl"), $this);?>

<?php $this->assign('page_name', "会場一覧"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminImageKakikomi.tpl"), $this);?>

</div>


<?php if ($this->_tpl_vars['atoffice_auth_type'] == 1 || $this->_tpl_vars['atoffice_auth_type'] == 4): ?>

<h2 id="ttl01">会場一覧(
<?php if ($this->_tpl_vars['hall_list']): ?>
	<?php echo smarty_modifier_t_escape($this->_tpl_vars['num']); ?>
件中　<?php echo smarty_modifier_t_escape($this->_tpl_vars['index']+1); ?>
件～
	<?php if ($this->_tpl_vars['index'] + 50 > $this->_tpl_vars['num']): ?>
		<?php echo smarty_modifier_t_escape($this->_tpl_vars['num']); ?>

	<?php else: ?>
		<?php echo smarty_modifier_t_escape($this->_tpl_vars['index']+50); ?>

	<?php endif; ?>
	件を表示
<?php else: ?>
	0件
<?php endif; ?>
)</h2>
<br>

<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><?php endif; ?>
<center>

<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('hall_list','page')); ?>
" />

<table border=1 width=800>
<tr>
<td colspan=4 bgcolor=#CDCDCD>検索オプション</td>
</tr>
<tr>
<th bgcolor=#FFD9DC>運営状態</th>
<th bgcolor=#FFD9DC>属性</th>
<th bgcolor=#FFD9DC>場所</th>
<td rowspan=2 bgcolor=#FFD9DC>
<input type="submit" value="検索する">
</td>
</tr>
<tr>
<td>
<input type="radio" name="flag" value="0" 
<?php if ($this->_tpl_vars['flag'] == 0): ?>checked<?php endif; ?>>すべて
<input type="radio" name="flag" value="1" 
<?php if ($this->_tpl_vars['flag'] == 1): ?>checked<?php endif; ?>>運営中
<input type="radio" name="flag" value="2" 
<?php if ($this->_tpl_vars['flag'] == 2): ?>checked<?php endif; ?>>メンテ中
<input type="radio" name="flag" value="3" 
<?php if ($this->_tpl_vars['flag'] == 3): ?>checked<?php endif; ?>>停止中
</td>
<td>
<input type="radio" name="attribute" value="0" 
<?php if ($this->_tpl_vars['attribute'] == 0): ?>checked<?php endif; ?>>すべて
<input type="radio" name="attribute" value="1" 
<?php if ($this->_tpl_vars['attribute'] == 1): ?>checked<?php endif; ?>>AO管理
<input type="radio" name="attribute" value="2" 
<?php if ($this->_tpl_vars['attribute'] == 2): ?>checked<?php endif; ?>>シェア
</td>
<td>
<select name="prefecture">
<option value="0">全国</option>
<?php $_from = $this->_tpl_vars['profile_list']['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
		<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_profile_option_id']); ?>
" <?php if ($this->_tpl_vars['item']['c_profile_option_id'] == $this->_tpl_vars['prefecture']): ?>selected<?php endif; ?>><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['value']))) ? $this->_run_mod_handler('default', true, $_tmp, "--") : smarty_modifier_default($_tmp, "--")); ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</td>
</tr>
</table>

</form>
<br>
<?php $_from = $this->_tpl_vars['page_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<?php if ($this->_tpl_vars['item']['select']): ?>
	<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['page']); ?>

<?php else: ?>
	<a href="./?m=admin&a=page_hall_list&flag=<?php echo smarty_modifier_t_escape($this->_tpl_vars['flag']); ?>
&attribute=<?php echo smarty_modifier_t_escape($this->_tpl_vars['attribute']); ?>
&prefecture=<?php echo smarty_modifier_t_escape($this->_tpl_vars['prefecture']); ?>
&index=<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['index']); ?>
" ><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['page']); ?>
</a>
<?php endif; ?>
|
<?php endforeach; endif; unset($_from); ?>
<hr>


<table border=1 cellpadding="5" cellspacing="5">
<tr>
<th bgcolor=#CCFFCC>会場番号</th>
<th bgcolor=#CCFFCC>会場名</th>
<th bgcolor=#CCFFCC width=100>属性</th>
<th bgcolor=#CCFFCC width=80>運営状態</th>
<th bgcolor=#CCFFCC>会場編集</th>
<th bgcolor=#CCFFCC>部屋設定</th>
<th bgcolor=#CCFFCC>画像設定</th>
<th bgcolor=#CCFFCC width=100>休日設定</th>
<th bgcolor=#CCFFCC>備品設定</th>
<th bgcolor=#CCFFCC>サービス設定</th>
<th bgcolor=#CCFFCC>口座設定</th>
<th bgcolor=#CCFFCC>キャンセル料率<br>パターン設定</th>
<th bgcolor=#CCFFCC>削除</th>
</tr>
<?php $_from = $this->_tpl_vars['hall_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<tr>
<td bgcolor=#DCDCDC>
<b><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_id']); ?>
</b>
</td>
<td bgcolor=#DCDCDC>
<b><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>
</b>
</td>
<?php if ($this->_tpl_vars['item']['hall_attribute'] == 0): ?>
<td bgcolor=#FFCCFF align=center>
AO管理会議室
</td>
<?php else: ?>
<td bgcolor=#FFFF99 align=center>
シェア会議室
<?php endif; ?>
</td>
<?php if ($this->_tpl_vars['item']['flag'] == 0): ?>
<td bgcolor=#66CC33 align=center>
<b>運営中
<?php elseif ($this->_tpl_vars['item']['flag'] == 1): ?>
<td bgcolor=#FFCC66 align=center>
<b>ﾒﾝﾃﾅﾝｽ中
<?php else: ?>
<td bgcolor=#FF3300 align=center>
<b>停止中
<?php endif; ?>
</b>
<br>
<form name="hall_conf" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('hall_status','page')); ?>
" />
<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_id']); ?>
" />
<input type="submit" value="変　更">
</form>
</td>
<td align=center>
<form name="hall_conf" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('add_hall','page')); ?>
" />
<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_id']); ?>
" />
<input type="submit" value="編　集">
</form>
</td>
<td align=center>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['config_rooms']); ?>
 / <?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['rooms']); ?>
<br>
<form name="bank" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('room_list','page')); ?>
" />
<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_id']); ?>
" />
<input type="submit" value="設　定">
</form>
</td>
<td align=center>
<?php if ($this->_tpl_vars['item']['image']): ?>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['image']); ?>
枚
<?php else: ?>
<span style="color: #FF0000;"><b>未設定</b></span>
<?php endif; ?>
<form name="bank" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('hall_image','page')); ?>
" />
<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_id']); ?>
" />
<input type="submit" value="設　定">
</form>
</td>
<td align=center>
<?php if ($this->_tpl_vars['item']['holiday']): ?>
休日あり
<?php else: ?>
<span style="color: #FF0000;"><b>毎日営業</b></span>
<?php endif; ?>
<form name="bank" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('hall_holiday_conf','page')); ?>
" />
<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_id']); ?>
" />
<input type="submit" value="設　定">
</form>
</td>
<td align=center>
登録数:<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['vessel']); ?>

<form name="bank" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('vessel_list','page')); ?>
" />
<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_id']); ?>
" />
<input type="submit" value="設　定">
</form>
</td>
<td align=center>
登録数:<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['service']); ?>

<form name="bank" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('service_list','page')); ?>
" />
<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_id']); ?>
" />
<input type="submit" value="設　定">
</form>
</td>
<td align=center>
<?php if ($this->_tpl_vars['item']['bank_flag']): ?>
<?php if ($this->_tpl_vars['item']['bank']): ?>
<form name="bank" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('bank_config','page')); ?>
" />
<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_id']); ?>
" />
<input type="submit" value="編　集">
</form>
<?php else: ?>
<form name="bank" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('bank_config','page')); ?>
" />
<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_id']); ?>
" />
<input type="submit" style="color:#FF0000" value="未設定">
</form>
<?php endif; ?>
<?php else: ?>
バーチャル
<?php endif; ?>
</td>
<td align=center>
<?php if ($this->_tpl_vars['item']['cancel']): ?>
<form name="cancel" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('cancel_config','page')); ?>
" />
<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_id']); ?>
" />
<input type="submit" value="編　集">
</form>
<?php else: ?>
<form name="cancel" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('cancel_config','page')); ?>
" />
<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_id']); ?>
" />
<input type="submit" style="color:#FF0000" value="未設定">
</form>
<?php endif; ?>
</td>
<td align=center>
<form name="preview" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('hall_delete','page')); ?>
" />
<input type="hidden" name="hall_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_id']); ?>
" />
<input type="submit" value="削除">
</form>
</td>

</tr>
<?php endforeach; endif; unset($_from); ?>
</table>

<hr>
<?php $_from = $this->_tpl_vars['page_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<?php if ($this->_tpl_vars['item']['select']): ?>
	<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['page']); ?>

<?php else: ?>
	<a href="./?m=admin&a=page_hall_list&flag=<?php echo smarty_modifier_t_escape($this->_tpl_vars['flag']); ?>
&attribute=<?php echo smarty_modifier_t_escape($this->_tpl_vars['attribute']); ?>
&prefecture=<?php echo smarty_modifier_t_escape($this->_tpl_vars['prefecture']); ?>
&index=<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['index']); ?>
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
