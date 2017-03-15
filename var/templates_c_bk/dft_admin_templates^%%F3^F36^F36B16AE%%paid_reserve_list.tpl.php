<?php /* Smarty version 2.6.18, created on 2016-03-08 17:24:43
         compiled from file:/var/www/atoffice/webapp/modules/admin/templates/paid_reserve_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/atoffice/webapp/modules/admin/templates/paid_reserve_list.tpl', 2, false),array('modifier', 't_escape', 'file:/var/www/atoffice/webapp/modules/admin/templates/paid_reserve_list.tpl', 24, false),array('modifier', 'nl2br', 'file:/var/www/atoffice/webapp/modules/admin/templates/paid_reserve_list.tpl', 195, false),array('modifier', 't_url2cmd', 'file:/var/www/atoffice/webapp/modules/admin/templates/paid_reserve_list.tpl', 195, false),array('modifier', 't_cmd', 'file:/var/www/atoffice/webapp/modules/admin/templates/paid_reserve_list.tpl', 195, false),array('modifier', 't_decoration', 'file:/var/www/atoffice/webapp/modules/admin/templates/paid_reserve_list.tpl', 195, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminSiteMember.tpl"), $this);?>

<?php $this->assign('page_name', "入金済み予約一覧"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminSiteMember.tpl"), $this);?>

</div>


<?php if ($this->_tpl_vars['atoffice_auth_type'] == 2 || $this->_tpl_vars['atoffice_auth_type'] == 4): ?>

<script type="text/javascript">
function confirm1(){
	if(window.confirm('予約をキャンセルしますか？')){
		return;
	}else{
		return false;
	}
}
</script>

<h2 id="ttl01">入金済み予約一覧 (
<?php if ($this->_tpl_vars['reserve_list']): ?>
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
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('paid_reserve_list','page')); ?>
" />

<table border=1 width=800>
<tr>
<td colspan=4 bgcolor=#CDCDCD>検索オプション</td>
</tr>
<tr>
<th bgcolor=#FFD9DC>会場選択</th>
<th bgcolor=#FFD9DC>顧客ID</th>
<th bgcolor=#FFD9DC>入金状態</th>
<td rowspan=2 bgcolor=#FFD9DC>
<input type="submit" value="検索する">
</td>
</tr>
<tr>
<td>
<select name="hall_list">
<option value="0">すべての会場</option>
<?php $_from = $this->_tpl_vars['hall_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
	<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_id']); ?>
" <?php if ($this->_tpl_vars['item']['hall_id'] == $this->_tpl_vars['hall_id']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</td>
<td>
<input type="text" name="u" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member_id']); ?>
">
</td>
<td>
<input type="radio" name="pay_flag" value="0" 
<?php if ($this->_tpl_vars['pay_flag'] == 0): ?>checked<?php endif; ?>>すべて
<input type="radio" name="pay_flag" value="1" 
<?php if ($this->_tpl_vars['pay_flag'] == 1): ?>checked<?php endif; ?>>入金済み
<input type="radio" name="pay_flag" value="2" 
<?php if ($this->_tpl_vars['pay_flag'] == 2): ?>checked<?php endif; ?>>過剰入金
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
	<a href="./?m=admin&a=page_paid_reserve_list&hall_list=<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
&u=<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member_id']); ?>
&pay_flag=<?php echo smarty_modifier_t_escape($this->_tpl_vars['pay_flag']); ?>
&index=<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['index']); ?>
" ><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['page']); ?>
</a>
<?php endif; ?>
|
<?php endforeach; endif; unset($_from); ?>
<hr>

<?php $_from = $this->_tpl_vars['reserve_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
	<table border=1 width=800>
	<tr>
	<td colspan=4 bgcolor=#CC1111>
	<b><span style="color: #FFFFFF;">□　予約ID : <?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
　□ <?php if ($this->_tpl_vars['item']['bill_id']): ?>(請求番号:<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['bill_id']); ?>
)<?php endif; ?></span></b>
	</td>
	</tr>

	<tr>
	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>予約日</span></td>
	<td><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['tmp_reserve_datetime']); ?>
</span></td>	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>承認日</span></td>
	<td><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_datetime']); ?>
</span></td>


	</tr>

	<tr>
	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>入金日</span></td>
	<td><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['pay_checkdate']); ?>
</span></td>	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>入金状態</span></td>
	<td><span style='margin:5px;'>
	<?php if ($this->_tpl_vars['item']['pay_money'] == $this->_tpl_vars['item']['total_price']): ?>
		入金済み（<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['pay_money']); ?>
円）
	<?php elseif ($this->_tpl_vars['item']['pay_money'] > $this->_tpl_vars['item']['total_price']): ?>
		<span style="color:#FF0000;"><b>過剰入金(<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['pay_money']); ?>
円)</b></span>
	<?php endif; ?>

	</span></td>
	</tr>

	<tr>
	<td bgcolor=#FFD9DC><span style='margin:5px;'>予約者</span></td>
	<td width=300><span style='margin:5px;'>
		<a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('c_member_detail')); ?>
&amp;target_c_member_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_member']['c_member_id']); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_member']['nickname']); ?>
</a>
	</span></td>
	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>企業・個人名</span></td>
	<td width=300><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['corp']); ?>
</span></td>
	</tr>

	<tr>
	<td bgcolor=#FFD9DC><span style='margin:5px;'>施設名</span></td>
	<td width=300><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_data']['hall_name']); ?>
</span></td>
	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>部屋名</span></td>
	<td width=300><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_data']['room_name']); ?>
</span></td>
	</tr>

	<tr>
	<td bgcolor=#FFD9DC rowspan=2><span style='margin:5px;'>予約時間</span></td>
	<td rowspan=2><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['datetime']); ?>
<br><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['begin_datetime']); ?>
 ～ <?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['finish_datetime']); ?>
</td>
	<td bgcolor=#FFD9DC><span style='margin:5px;'>利用人数/目的</span></td>
	<td><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['people']); ?>
 人　/　

	<?php if ($this->_tpl_vars['item']['purpose'] == 0): ?>
		未選択
	<?php elseif ($this->_tpl_vars['item']['purpose'] == 1): ?>
		会議
	<?php elseif ($this->_tpl_vars['item']['purpose'] == 2): ?>
		セミナー
	<?php elseif ($this->_tpl_vars['item']['purpose'] == 3): ?>
		研修
	<?php elseif ($this->_tpl_vars['item']['purpose'] == 4): ?>
		面接・試験
	<?php elseif ($this->_tpl_vars['item']['purpose'] == 5): ?>
		懇談会・パーティ
	<?php elseif ($this->_tpl_vars['item']['purpose'] == 6): ?>
		その他
	<?php endif; ?>

	</span></td>
	</tr>

	<tr>
	<td bgcolor=#FFD9DC><span style='margin:5px;'>ﾊﾞｰﾁｬﾙ口座</span></td>
	<td><span style='margin:5px;'>
	<?php if ($this->_tpl_vars['item']['virtual_code']): ?>
		<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['virtual_code']); ?>

	<?php else: ?>
		固定口座
	<?php endif; ?>
	</span></td>
	</tr>


	<tr>
	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>利用料金</span></td>
	<td colspan=3><span style='margin:5px;'>【部屋利用料：<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_price1']); ?>
円】＋【備品利用料：<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['vessel_price1']); ?>
円】＋【サービス利用料：<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['service_price1']); ?>
円】＝【合計請求額：<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_price1']+$this->_tpl_vars['item']['vessel_price1']+$this->_tpl_vars['item']['service_price1']); ?>
円】</span></td>
	</tr>

<?php if ($this->_tpl_vars['item']['reserve_v_list']): ?>
	<tr>
	<td bgcolor=#FFD9DC width=100 style='vertical-align:middle;'><span style='margin:5px;'>予約備品一覧</span></td>
	<td colspan=3><span style='margin:5px;'>

	<table style='border: 1px #000000 solid;' width=100%>
	<tr>
	<th style='border: 1px #000000 solid;' bgcolor=#EFEFEF>備品名</th>
	<th style='border: 1px #000000 solid;' bgcolor=#EFEFEF>予約時単価</th>
	<th style='border: 1px #000000 solid;' bgcolor=#EFEFEF>数量</th>
	<th style='border: 1px #000000 solid;' bgcolor=#EFEFEF>備品管理メモ</th>
	</tr>
	<?php $_from = $this->_tpl_vars['item']['reserve_v_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
	<td style='border: 1px #000000 solid;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['i']['vessel_name']); ?>
</td>
	<td style='border: 1px #000000 solid;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['i']['price']); ?>
</td>
	<td style='border: 1px #000000 solid;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['i']['num']); ?>
</td>
	<td style='border: 1px #000000 solid;'>
	<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['i']['memo']))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('t_url2cmd', true, $_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id'])) : smarty_modifier_t_url2cmd($_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id']))))) ? $this->_run_mod_handler('t_cmd', true, $_tmp, 'diary') : smarty_modifier_t_cmd($_tmp, 'diary')))) ? $this->_run_mod_handler('t_decoration', true, $_tmp) : smarty_modifier_t_decoration($_tmp)); ?>

	</td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
	</table>

	</span></td>
	</tr>
<?php endif; ?>

<?php if ($this->_tpl_vars['item']['reserve_s_list']): ?>
	<tr>
	<td bgcolor=#FFD9DC width=100 style='vertical-align:middle;'><span style='margin:5px;'>予約ｻｰﾋﾞｽ一覧</span></td>
	<td colspan=3><span style='margin:5px;'>

	<table style='border: 1px #000000 solid;' width=100%>
	<tr>
	<th style='border: 1px #000000 solid;' bgcolor=#EFEFEF>サービス名</th>
	<th style='border: 1px #000000 solid;' bgcolor=#EFEFEF>予約時単価</th>
	<th style='border: 1px #000000 solid;' bgcolor=#EFEFEF>数量</th>
	<th style='border: 1px #000000 solid;' bgcolor=#EFEFEF>サービス管理メモ</th>
	</tr>
	<?php $_from = $this->_tpl_vars['item']['reserve_s_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
	<td style='border: 1px #000000 solid;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['i']['service_name']); ?>
</td>
	<td style='border: 1px #000000 solid;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['i']['price']); ?>
</td>
	<td style='border: 1px #000000 solid;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['i']['num']); ?>
</td>
	<td style='border: 1px #000000 solid;'>
	<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['i']['memo']))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('t_url2cmd', true, $_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id'])) : smarty_modifier_t_url2cmd($_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id']))))) ? $this->_run_mod_handler('t_cmd', true, $_tmp, 'diary') : smarty_modifier_t_cmd($_tmp, 'diary')))) ? $this->_run_mod_handler('t_decoration', true, $_tmp) : smarty_modifier_t_decoration($_tmp)); ?>

	</td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
	</table>

	</span></td>
	</tr>
<?php endif; ?>

	<tr>
	<td bgcolor=#FFD9DC width=100 style='vertical-align:middle;'><span style='margin:5px;'>お客さま<br>メッセージ</span></td>
	<td colspan=3 align=left>
	<?php if ($this->_tpl_vars['item']['message']): ?>
		<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['message']))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('t_url2cmd', true, $_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id'])) : smarty_modifier_t_url2cmd($_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id']))))) ? $this->_run_mod_handler('t_cmd', true, $_tmp, 'diary') : smarty_modifier_t_cmd($_tmp, 'diary')))) ? $this->_run_mod_handler('t_decoration', true, $_tmp) : smarty_modifier_t_decoration($_tmp)); ?>

	<?php else: ?>
		<center>--</center>
	<?php endif; ?>
	</td>
	</tr>

	<tr>
	<td bgcolor=#FFD9DC width=100 style='vertical-align:middle;'><span style='margin:5px;'>社内メモ</span></td>
	<td colspan=3 align=left>
	<?php if ($this->_tpl_vars['item']['memo']): ?>
		<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['memo']))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('t_url2cmd', true, $_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id'])) : smarty_modifier_t_url2cmd($_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id']))))) ? $this->_run_mod_handler('t_cmd', true, $_tmp, 'diary') : smarty_modifier_t_cmd($_tmp, 'diary')))) ? $this->_run_mod_handler('t_decoration', true, $_tmp) : smarty_modifier_t_decoration($_tmp)); ?>

	<?php else: ?>
		<center>--</center>
	<?php endif; ?>
	</td>
	</tr>


	<tr>
	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>キャンセル料</span></td>
	<td colspan=3>

	<?php if ($this->_tpl_vars['item']['cancel_list']['before'] > 0): ?>
	<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['cancel_list']['before']); ?>
日前　<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['cancel_list']['percent']); ?>
% 徴収<br>
	<?php endif; ?>
	【キャンセルに含む総額：<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['cancel_price1']); ?>
円】=【部屋利用料：<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_price1']); ?>
円】＋【備品利用料：<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['vessel_price1']); ?>
円】＋【キャンセル料金に含まれるサービス料：<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['service_price1']); ?>
円】<br>
	【キャンセル料：<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['cancel_price']); ?>
円】=【キャンセルに含む総額：<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_price1']+$this->_tpl_vars['item']['vessel_price1']+$this->_tpl_vars['item']['service_price1']); ?>
円】-【キャンセル料率：<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['cancel_list']['percent']); ?>
x0.01】<br><br>

	<?php if ($this->_tpl_vars['item']['pay_money'] > $this->_tpl_vars['item']['cancel_price']): ?>
		【返金額：<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['pay_money']-$this->_tpl_vars['item']['cancel_price']); ?>
円】=【入金額】-【キャンセル料】
	<?php else: ?>
		【請求額：<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['cancel_price']-$this->_tpl_vars['item']['pay_money']); ?>
】=【キャンセル料】-【入金額】
	<?php endif; ?>

	</td>
	</tr>

	<tr>
	<td bgcolor=#FFD9DC>予約修正</td>
	<td>
<center>
	<form name="reserve_revision<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
" method="POST" action="./">
	<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
	<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('reserve_revision','page')); ?>
" />
	<input type="hidden" name="reserve_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
" />
	<input type="submit" value="　修　正　">
	</form>
</center>
	</td>
	<td bgcolor=#FFD9DC>予約キャンセル</td>
	<td>
<center>
	<table><tr><td>
	<form onSubmit="return confirm1();" name="cancel<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
" method="POST" action="./">
	<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
	<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('reserve_cancel','do')); ?>
" />
	<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
	<input type="hidden" name="reserve_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
" />
	<input type="hidden" name="page" value="paid_reserve_list">
	<?php if ($this->_tpl_vars['item']['pay_money'] > $this->_tpl_vars['item']['cancel_price']): ?>
		<input type="hidden" name="mode" value="1">
		<input type="hidden" name="cancel_price" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['pay_money']-$this->_tpl_vars['item']['cancel_price']); ?>
">
	<?php else: ?>
		<input type="hidden" name="mode" value="2">
		<input type="hidden" name="cancel_price" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['cancel_price']-$this->_tpl_vars['item']['pay_money']); ?>
">
	<?php endif; ?>

	<input type="submit" value="　メールしないでキャンセル　">
	</form>
	</td><td>
	<form action="./" method="post" target="_blank">
	<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
	<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('send_cancel_mail','do')); ?>
" />
	<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
	<input type="hidden" name="reserveid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
" />
	<input type="hidden" name="page" value="paid_reserve_list">
	<input type="hidden" name="hall_list" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
" />
	<input type="hidden" name="u" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member_id']); ?>
" />
	<input type="hidden" name="pay_flag" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['pay_flag']); ?>
" />
	<input type="hidden" name="index" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['index']); ?>
" />
	<?php if ($this->_tpl_vars['item']['pay_money'] > $this->_tpl_vars['item']['cancel_price']): ?>
		<input type="hidden" name="mode" value="1">
		<input type="hidden" name="cancel_price" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['pay_money']-$this->_tpl_vars['item']['cancel_price']); ?>
">
	<?php else: ?>
		<input type="hidden" name="mode" value="2">
		<input type="hidden" name="cancel_price" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['cancel_price']-$this->_tpl_vars['item']['pay_money']); ?>
">
	<?php endif; ?>

	<input type="submit" value="　メールしてキャンセル　">
	</form>
	</td></tr></table>

</center>

	</td>
	</tr>

	</table>
	<br>
<?php endforeach; else: ?>
	該当するデータはありませんでした。
<?php endif; unset($_from); ?>
<hr>
<?php $_from = $this->_tpl_vars['page_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<?php if ($this->_tpl_vars['item']['select']): ?>
	<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['page']); ?>

<?php else: ?>
	<a href="./?m=admin&a=page_paid_reserve_list&hall_list=<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
&u=<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member_id']); ?>
&pay_flag=<?php echo smarty_modifier_t_escape($this->_tpl_vars['pay_flag']); ?>
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
