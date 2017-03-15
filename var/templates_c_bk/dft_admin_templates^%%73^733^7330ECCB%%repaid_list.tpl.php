<?php /* Smarty version 2.6.18, created on 2010-08-26 19:47:10
         compiled from file:/var/www/atoffice_torioki20100712/webapp/modules/admin/templates/repaid_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/atoffice_torioki20100712/webapp/modules/admin/templates/repaid_list.tpl', 2, false),array('modifier', 't_escape', 'file:/var/www/atoffice_torioki20100712/webapp/modules/admin/templates/repaid_list.tpl', 14, false),array('modifier', 'nl2br', 'file:/var/www/atoffice_torioki20100712/webapp/modules/admin/templates/repaid_list.tpl', 141, false),array('modifier', 't_url2cmd', 'file:/var/www/atoffice_torioki20100712/webapp/modules/admin/templates/repaid_list.tpl', 141, false),array('modifier', 't_cmd', 'file:/var/www/atoffice_torioki20100712/webapp/modules/admin/templates/repaid_list.tpl', 141, false),array('modifier', 't_decoration', 'file:/var/www/atoffice_torioki20100712/webapp/modules/admin/templates/repaid_list.tpl', 141, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminStatisticalInformation.tpl"), $this);?>

<?php $this->assign('page_name', "返金処理済みリスト"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminStatisticalInformation.tpl"), $this);?>

</div>


<?php if ($this->_tpl_vars['atoffice_auth_type'] == 4): ?>

<h2 id="ttl01">返金処理済みリスト　(
<?php if ($this->_tpl_vars['repayment_list']): ?>
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


<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('repaid_list','page')); ?>
" />

<table border=1 width=800>
<tr>
<td colspan=4 bgcolor=#CDCDCD>検索オプション</td>
</tr>
<tr>
<th bgcolor=#FFD9DC>返金額</th>
<th bgcolor=#FFD9DC>予約ID</th>
<th bgcolor=#FFD9DC>返金処理日時範囲指定(年-月-日)</th>
<td rowspan=2 bgcolor=#FFD9DC>
<input type="submit" value="検索する">
</td>
</tr>
<tr>
<td>
<input type="text" name="repayment_money" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['repayment_money']); ?>
" size=5 style="text-align:right;padding-right:5px;">円以上
</td>
<td>
<input type="text" name="reserve_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_id']); ?>
">
</td>
<td>
<input type="text" name="begin_date" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['begin_date']); ?>
" size="8"> ～
<input type="text" name="finish_date" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['finish_date']); ?>
" size="8">
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
	<a href="./?m=admin&a=page_repaid_list&repayment_money=<?php echo smarty_modifier_t_escape($this->_tpl_vars['repayment_money']); ?>
&reserve_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_id']); ?>
&begin_date=<?php echo smarty_modifier_t_escape($this->_tpl_vars['begin_date']); ?>
&finish_date=<?php echo smarty_modifier_t_escape($this->_tpl_vars['finish_date']); ?>
&index=<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['index']); ?>
" ><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['page']); ?>
</a>
<?php endif; ?>
|
<?php endforeach; endif; unset($_from); ?>
<hr>


<?php $_from = $this->_tpl_vars['repayment_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<table border=1 width=800>
<tr>
<td colspan=4 bgcolor=#CCFFFF>■ 予約ID <?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
 ■　返金処理日(<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['repayment_datetime']); ?>
)</td>
</tr>
<tr>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>返金額</span></td>
<td><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['repayment_money']); ?>
 円</span></td>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>E-mail</span></td>
<td><span style='margin:5px;'>
<a href="mailto:<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['mail']); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['mail']); ?>
</a>
</span></td>
</td>
</tr>

<tr>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>氏名</span></td>
<td><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_member']['nickname']); ?>
</span></td>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>法人・個人名</span></td>
<td><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['corp']); ?>
</span></td>
</td>
</tr>

<tr>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>利用施設</span></td>
<td><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>
</span></td>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>部屋名</span></td>
<td><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_name']); ?>
</span></td>
</td>
</tr>

<tr>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>仮予約申込日</span></td>
<td><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_data']['tmp_reserve_datetime']); ?>
</span></td>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>予約承認日</span></td>
<td><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_data']['reserve_datetime']); ?>
</span></td>
</td>
</tr>

<tr>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>利用開始時間</span></td>
<td><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_data']['begin_datetime']); ?>
</span></td>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>利用終了時間</span></td>
<td><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_data']['finish_datetime']); ?>
</span></td>
</td>
</tr>

<tr>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>入金締切日</span></td>
<td><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_data']['pay_limitdate']); ?>
</span></td>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>キャンセル日</span></td>
<td><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_data']['cancel_datetime']); ?>
</span></td>
</td>
</tr>

<tr>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>利用金額</span></td>
<td><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_data']['total_price']); ?>
 円</span></td>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>入金済み金額</span></td>
<td><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_data']['pay_money']); ?>
 円</span></td>
</td>
</tr>

<tr>
<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>理由</span></td>
<td colspan=3 align=left><span style='margin:5px;'>
<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['info']))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('t_url2cmd', true, $_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id'])) : smarty_modifier_t_url2cmd($_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id']))))) ? $this->_run_mod_handler('t_cmd', true, $_tmp, 'diary') : smarty_modifier_t_cmd($_tmp, 'diary')))) ? $this->_run_mod_handler('t_decoration', true, $_tmp) : smarty_modifier_t_decoration($_tmp)); ?>

</span></td>
</tr>

</table>
<br>
<?php endforeach; else: ?>
該当する返金処理済みデータはありませんでした。
<?php endif; unset($_from); ?>
<hr>
<?php $_from = $this->_tpl_vars['page_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<?php if ($this->_tpl_vars['item']['select']): ?>
	<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['page']); ?>

<?php else: ?>
	<a href="./?m=admin&a=page_repaid_list&repayment_money=<?php echo smarty_modifier_t_escape($this->_tpl_vars['repayment_money']); ?>
&reserve_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_id']); ?>
&begin_date=<?php echo smarty_modifier_t_escape($this->_tpl_vars['begin_date']); ?>
&finish_date=<?php echo smarty_modifier_t_escape($this->_tpl_vars['finish_date']); ?>
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
