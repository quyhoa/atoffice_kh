<?php /* Smarty version 2.6.18, created on 2016-10-26 09:29:04
         compiled from file:/var/www/atoffice/webapp/modules/admin/templates/service_revision.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/atoffice/webapp/modules/admin/templates/service_revision.tpl', 2, false),array('modifier', 't_escape', 'file:/var/www/atoffice/webapp/modules/admin/templates/service_revision.tpl', 31, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminSiteMember.tpl"), $this);?>

<?php $this->assign('page_name', "サービス修正"); ?>
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
function confirm1(){
	if(window.confirm('【最終確認】\nもう一度データをよく確認して、よろしければOKを押してください。')){
		return;
	}else{
		return false;
	}
}
</script>

　<a href="./?m=admin&a=page_reserve_revision&reserve_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['reserve_id']); ?>
">予約修正</a>｜<a href="./?m=admin&a=page_vessel_revision&reserve_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['reserve_id']); ?>
">備品修正</a>｜<br>
<br>
<h2 id="ttl01">サービス修正</h2>
<br>
　※ 予約データの料金とは連動されませんので、サービス修正後に予約修正にて、サービス料金と請求金額を修正してください。<br>
<center>
<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><?php endif; ?>

<br><br>

<?php $_from = $this->_tpl_vars['log']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<table border=1 width=700>
<tr>
<th colspan=4 bgcolor=#CCCCFF>ログデータ<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']+1); ?>
 （予約ID：<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['reserve_id']); ?>
）<br>(変更日：<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['change_datetime']); ?>
変更者：<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['staff_name']); ?>
)</th>
</tr>

<tr>
<td colspan=4>
<table width=100% border=1>
<tr>
<th>選択</th>
<th>名称</th>
<th>価格</th>
<th>数量</th>
<th>キャンセル</th>
</tr>

<?php $_from = $this->_tpl_vars['item']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
<tr>
<td>
<?php if ($this->_tpl_vars['i']['num'] > 0): ?>
✔
<?php else: ?>
--
<?php endif; ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['i']['service_name']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['i']['price']); ?>
</td>
<td>
<?php if ($this->_tpl_vars['i']['num']): ?>
	<?php echo smarty_modifier_t_escape($this->_tpl_vars['i']['num']); ?>

<?php else: ?>
	--
<?php endif; ?>
</td>
<td>
<?php if ($this->_tpl_vars['i']['num'] > 0): ?>
	<?php if ($this->_tpl_vars['i']['cancel_flag'] == 1): ?>
		キャンセル
	<?php else: ?>
		未キャンセル
	<?php endif; ?>
<?php else: ?>
	-- --
<?php endif; ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>

</td>
</tr>


</table>
<br>
<b>↓　↓　↓</b><br>
<br>
<?php endforeach; endif; unset($_from); ?>




<table border=1 width=700>
<tr>
<th colspan=4 bgcolor=#FFFF55>修正前データ （予約ID：<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['reserve_id']); ?>
）<br>※ 修正は上書きの為、旧データが表示されるのはここが最後です。</th>
</tr>
<tr>
<td width=100 bgcolor=#DEDEDE>顧客ID</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['c_member_id']); ?>
</td>
<td width=100 bgcolor=#DEDEDE>氏名</td>
<td>
<a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('c_member_detail')); ?>
&amp;target_c_member_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['c_member_id']); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['nickname']); ?>
</a>
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>会場名</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['hall_name']); ?>
</td>
<td width=100 bgcolor=#DEDEDE>部屋名</td>
<td>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['room_name']); ?>

</td>
</tr>

<tr>
<td colspan=4>
<?php if ($this->_tpl_vars['service_list']): ?>
<table width=100% border=1>
<tr>
<th>選択</th>
<th>名称</th>
<th>価格</th>
<th>数量</th>
<th>キャンセル区分</th>
<th>キャンセル</th>
</tr>

<?php $_from = $this->_tpl_vars['service_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<tr>
<td>
<?php if ($this->_tpl_vars['item']['num'] > 0): ?>
✔
<?php else: ?>
--
<?php endif; ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['service_name']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['price']); ?>
</td>
<td>
<?php if ($this->_tpl_vars['item']['num']): ?>
	<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['num']); ?>

<?php else: ?>
	--
<?php endif; ?>
</td>
<td>
<?php if ($this->_tpl_vars['item']['charge_devision'] == 1): ?>
	含む
<?php else: ?>
	含まない
<?php endif; ?>
</td>
<td>
<?php if ($this->_tpl_vars['item']['num'] > 0): ?>
	<?php if ($this->_tpl_vars['item']['cancel_flag'] == 1): ?>
		キャンセル
	<?php else: ?>
		未キャンセル
	<?php endif; ?>
<?php else: ?>
	-- --
<?php endif; ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
<?php else: ?>
この部屋に登録されているサービスはありません。
<?php endif; ?>
</table>

</td>
</tr>


</table>
<br>
<b>↓　↓　↓</b><br>
<br>

<form onSubmit="return confirm1();" name="do_change_reserve" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('change_service','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<input type="hidden" name="reserve_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['reserve_id']); ?>
">
<input type="hidden" name="service_list_num" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['service_list_num']); ?>
">

<table border=1 width=700>
<tr>
<th colspan=4 bgcolor=#55FFFF>修正</th>
</tr>
<tr>
<td width=100 bgcolor=#DEDEDE>顧客ID</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['c_member_id']); ?>
</td>
<td width=100 bgcolor=#DEDEDE>氏名</td>
<td>
<a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('c_member_detail')); ?>
&amp;target_c_member_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['c_member_id']); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['nickname']); ?>
</a>
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>会場名</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['hall_name']); ?>
</td>
<td width=100 bgcolor=#DEDEDE>部屋名</td>
<td>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['room_name']); ?>

</td>
</tr>

<tr>
<td colspan=4>
<?php if ($this->_tpl_vars['service_list']): ?>
<table width=100% border=1>
<tr>
<th>選択</th>
<th>名称</th>
<th>価格</th>
<th>数量</th>
<th>区分</th>
<th>キャンセル</th>
</tr>

<?php $_from = $this->_tpl_vars['service_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<tr>
<td>
<?php if ($this->_tpl_vars['item']['num'] > 0): ?>
✔
<input type="hidden" name="service_id<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['service_id']); ?>
">
<?php else: ?>
<input type="checkbox" name="service_id<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['service_id']); ?>
">
<?php endif; ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['service_name']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['price']); ?>
</td>
<td>
<?php if ($this->_tpl_vars['item']['num']): ?>
	<input type="text" name="num<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['num']); ?>
" size=3>
<?php else: ?>
	<input type="text" name="num<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['minimum_orders']); ?>
" size=3>
<?php endif; ?>
最低予約数：<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['minimum_orders']); ?>

</td>
<td>
<?php if ($this->_tpl_vars['item']['charge_devision'] == 1): ?>
	予約毎
<?php else: ?>
	時間毎
<?php endif; ?>
</td>
<td>
<input type="checkbox" name="cancel_flag<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
" value="1" <?php if ($this->_tpl_vars['item']['cancel_flag'] == 1): ?>checked<?php endif; ?>>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>

</td>
</tr>

<tr>
<td colspan=4>
<input type="submit" value="　変　更　">
<?php else: ?>
この部屋に登録されているサービスはありません。
<?php endif; ?>
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
