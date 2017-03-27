<?php /* Smarty version 2.6.18, created on 2017-03-27 09:28:36
         compiled from file:D:%5CA_project%5Catoffice_kh/webapp/modules/admin/templates/slip_output.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:D:\\A_project\\atoffice_kh/webapp/modules/admin/templates/slip_output.tpl', 2, false),array('modifier', 't_escape', 'file:D:\\A_project\\atoffice_kh/webapp/modules/admin/templates/slip_output.tpl', 16, false),array('modifier', 'number_format', 'file:D:\\A_project\\atoffice_kh/webapp/modules/admin/templates/slip_output.tpl', 298, false),array('modifier', 'date_format', 'file:D:\\A_project\\atoffice_kh/webapp/modules/admin/templates/slip_output.tpl', 582, false),array('modifier', 't_url2cmd', 'file:D:\\A_project\\atoffice_kh/webapp/modules/admin/templates/slip_output.tpl', 1210, false),array('modifier', 't_cmd', 'file:D:\\A_project\\atoffice_kh/webapp/modules/admin/templates/slip_output.tpl', 1210, false),array('modifier', 't_decoration', 'file:D:\\A_project\\atoffice_kh/webapp/modules/admin/templates/slip_output.tpl', 1210, false),array('modifier', 'round', 'file:D:\\A_project\\atoffice_kh/webapp/modules/admin/templates/slip_output.tpl', 1449, false),array('modifier', 'nl2br', 'file:D:\\A_project\\atoffice_kh/webapp/modules/admin/templates/slip_output.tpl', 1583, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminStatisticalInformation.tpl"), $this);?>

<?php $this->assign('page_name', "帳票出力"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminStatisticalInformation.tpl"), $this);?>

</div>


<?php if ($this->_tpl_vars['atoffice_auth_type'] == 4): ?>

<h2 id="ttl01">帳票出力</h2>
<br>
<center>

<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><br><br><?php endif; ?>

<table width = 1100>
<tr>
<td align=left width=198 valign=top>

<h3>管理系</h3>
<?php if ($this->_tpl_vars['menu'] == 'sales_expectation'): ?>
<span style="color:#FF0000;"><b>⇒売上見込表</b></span>
<?php else: ?>
<a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output')); ?>
&menu=sales_expectation">
売上見込表
</a>
<?php endif; ?>
<br>
<?php if ($this->_tpl_vars['menu'] == 'news_flash'): ?>
<span style="color:#FF0000;"><b>⇒予約・売上速報</b></span>
<?php else: ?>
<a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output')); ?>
&menu=news_flash">
予約・売上速報
</a>
<?php endif; ?>
<br>

<?php if ($this->_tpl_vars['menu'] == 'sales_report'): ?>
<span style="color:#FF0000;"><b>⇒売上報告書（社内）</b></span>
<?php else: ?>
<a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output')); ?>
&menu=sales_report">
売上報告書（社内）
</a>
<?php endif; ?>
<br>

<?php if ($this->_tpl_vars['menu'] == 'business_report'): ?>
<span style="color:#FF0000;"><b>⇒業務報告（委託者用）</b></span>
<?php else: ?>
<a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output')); ?>
&menu=business_report">
業務報告（委託者用）
</a>
<?php endif; ?>
<br>

<?php if ($this->_tpl_vars['menu'] == 'unpayment_list'): ?>
<span style="color:#FF0000;"><b>⇒未入金リスト</b></span>
<?php else: ?>
<a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output')); ?>
&menu=unpayment_list">
未入金リスト
</a>
<?php endif; ?>
<br>
<!-- add cancel payment-->
<?php if ($this->_tpl_vars['menu'] == 'cancelpayment_list'): ?>
<span style="color:#FF0000;"><b>=>キャンセル料未入金リスト</b></span>
<?php else: ?>
<a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output')); ?>
&menu=cancelpayment_list">
キャンセル料未入金リスト
</a>
<?php endif; ?>
<br>
<!-- end -->

<?php if ($this->_tpl_vars['menu'] == 'payment_record'): ?>
<span style="color:#FF0000;"><b>⇒入金記録</b></span>
<?php else: ?>
<a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output')); ?>
&menu=payment_record">
入金記録
</a>
<?php endif; ?>
<br>

<?php if ($this->_tpl_vars['menu'] == 'management_analysis'): ?>
<span style="color:#FF0000;"><b>⇒会場運営分析</b></span>
<?php else: ?>
<a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output')); ?>
&menu=management_analysis">
会場運営分析
</a>
<?php endif; ?>
<br>

<?php if ($this->_tpl_vars['menu'] == 'use_schedule_list'): ?>
<span style="color:#FF0000;"><b>⇒利用予定一覧</b></span>
<?php else: ?>
<a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output')); ?>
&menu=use_schedule_list">
利用予定一覧
</a>
<?php endif; ?>
<br>

<br>
<h3>分析系</h3>

<?php if ($this->_tpl_vars['menu'] == 'utilization_rates'): ?>
<span style="color:#FF0000;"><b>⇒稼働率一覧</b></span>
<?php else: ?>
<a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output')); ?>
&menu=utilization_rates">
稼働率一覧
</a>
<?php endif; ?>
<br>

<?php if ($this->_tpl_vars['menu'] == 'money_utilization_rates'): ?>
<span style="color:#FF0000;"><b>⇒金額稼働率推移</b></span>
<?php else: ?>
<a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output')); ?>
&menu=money_utilization_rates">
金額稼働率推移
</a>
<?php endif; ?>
<br>

<?php if ($this->_tpl_vars['menu'] == 'time_utilization_rates'): ?>
<span style="color:#FF0000;"><b>⇒時間稼働率推移</b></span>
<?php else: ?>
<a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output')); ?>
&menu=time_utilization_rates">
時間稼働率推移
</a>
<?php endif; ?>
<br>
<?php if ($this->_tpl_vars['menu'] == 'repetition_rate'): ?>
<span style="color:#FF0000;"><b>⇒リピート率分析</b></span>
<?php else: ?>
<a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output')); ?>
&menu=repetition_rate">
リピート率分析
</a>
<?php endif; ?>
<br>

<?php if ($this->_tpl_vars['menu'] == 'user_analysis'): ?>
<span style="color:#FF0000;"><b>⇒利用者分析（用途）</b></span>
<?php else: ?>
<a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output')); ?>
&menu=user_analysis">
利用者分析（用途）
</a>
<?php endif; ?>
<br>

<?php if ($this->_tpl_vars['menu'] == 'utilization_rates_order'): ?>
<span style="color:#FF0000;"><b>⇒会場稼働率順位</b></span>
<?php else: ?>
<a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output')); ?>
&menu=utilization_rates_order">
会場稼働率順位
</a>
<?php endif; ?>
<br>

<?php if ($this->_tpl_vars['menu'] == 'room_utilization_rates_order'): ?>
<span style="color:#FF0000;"><b>⇒部屋稼働率順位</b></span>
<?php else: ?>
<a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output')); ?>
&menu=room_utilization_rates_order">
部屋稼働率順位
</a>
<?php endif; ?>
<br>


<?php if ($this->_tpl_vars['menu'] == 'repetition_order'): ?>
<span style="color:#FF0000;"><b>⇒リピート率順位</b></span>
<?php else: ?>
<a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output')); ?>
&menu=repetition_order">
リピート率順位
</a>
<?php endif; ?>
<br>

<?php if ($this->_tpl_vars['menu'] == 'cancellation_analysis'): ?>
<span style="color:#FF0000;"><b>⇒キャンセル分析</b></span>
<?php else: ?>
<a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output')); ?>
&menu=cancellation_analysis">
キャンセル分析
</a>
<?php endif; ?>
<br>

<?php if ($this->_tpl_vars['menu'] == 'analysis_at_reservation_period'): ?>
<span style="color:#FF0000;"><b>⇒予約期間分析</b></span>
<?php else: ?>
<a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output')); ?>
&menu=analysis_at_reservation_period">
予約期間分析
</a>
<?php endif; ?>
<br>

<br>
<h3>顧客管理系</h3>

<?php if ($this->_tpl_vars['menu'] == 'customer_use_state'): ?>
<span style="color:#FF0000;"><b>⇒顧客利用状況</b></span>
<?php else: ?>
<a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output')); ?>
&menu=customer_use_state">
顧客利用状況
</a>
<?php endif; ?>
<br>

<?php if ($this->_tpl_vars['menu'] == 'long_term_use'): ?>
<span style="color:#FF0000;"><b>⇒長期利用顧客一覧</b></span>
<?php else: ?>
<a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output')); ?>
&menu=long_term_use">
長期利用顧客一覧
</a>
<?php endif; ?>
<br>

<?php if ($this->_tpl_vars['menu'] == 'repeat_customer_list'): ?>
<span style="color:#FF0000;"><b>⇒リピート顧客リスト</b></span>
<?php else: ?>
<a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output')); ?>
&menu=repeat_customer_list">
リピート顧客リスト
</a>
<?php endif; ?>
<br>


</td>
<td width=2 bgcolor=#CDCDCD>
</td>
<td width=900 valign=top align=left>
<h2 id="ttl01"><?php echo smarty_modifier_t_escape($this->_tpl_vars['title']); ?>
</h2>
<br>

<?php if ($this->_tpl_vars['menu'] == 'business_report'): ?>

<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output','page')); ?>
" />
<input type="hidden" name="menu" value="business_report">

<select name="hall_id" size=5 valign=top>
<?php $_from = $this->_tpl_vars['hall_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_id']); ?>
" <?php if ($this->_tpl_vars['item']['hall_id'] == $this->_tpl_vars['hall_id']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>

<?php endforeach; endif; unset($_from); ?>
</select>

<input type="text" name="year" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
" size=8 style="text-align:right;padding-right:5px;">年 
<input type="text" name="month" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
" size=2 style="text-align:right;padding-right:5px;">月度
<input type="submit" value="出力">
</form>
<br>
<hr>
<h3><?php echo smarty_modifier_t_escape($this->_tpl_vars['title']); ?>
</h3>
<br>

<?php if ($this->_tpl_vars['reserve_data']): ?>

<div style='width:900px;overflow-x:scroll;'>

【お支払表】<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_data']['hall_name']); ?>
　<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
月度<br>
<br>
１．<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
月度入金明細（対象期間に利用且つ入金済）<br>
<table border=1 width=1000>
<tr>
<th>予約ID</th>
<th>利用日</th>
<th>部屋</th>
<th>利用時間</th>
<th>部屋利用入金</th>
<th>キャンセル料</th>
<th>配分比</th>
<th>お支払い</th>
<th>備品利用入金(税込)</th>
<th>配分比</th>
<th>お支払い(税込)</th>
<th>お支払い総額(税込)</th>
<th>備品明細</th>
<th>入金期日</th>
<th>入金日</th>
<th>紹介代理店</th>
<th>キャンセル</th>
<th>AO収益</th>
</tr>
<?php $this->assign('total_vessel_aomops', '0'); ?>
<?php $this->assign('total_room_aomops', '0'); ?>
<?php $_from = $this->_tpl_vars['reserve_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<?php if ($this->_tpl_vars['item']['pay_date']): ?>
<tr>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
</td>
<td align=center><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['date']); ?>
</td>
<td align=center><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_name']); ?>
</td>
<td align=center><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['time']); ?>
</td>
<td align=right>
<?php if ($this->_tpl_vars['item']['cancel_price'] < 0): ?>
<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['room_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

<?php else: ?>
0
<?php endif; ?>
</td>
<td align=right>
<?php if ($this->_tpl_vars['item']['cancel_price'] >= 0): ?>
<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['cancel_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

<?php else: ?>
0
<?php endif; ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_data']['owner_room']); ?>
%</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['room_aomop']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['vessel_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_data']['owner_vessel']); ?>
%</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['vessel_aomop']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['total_aomop']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td>
<?php $_from = $this->_tpl_vars['item']['vessel_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i']):
?>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['i']['vessel_name']); ?>
/
<?php endforeach; endif; unset($_from); ?>
</td>
<td align=center>
<?php if ($this->_tpl_vars['item']['pay_limitdate'] == "0000-00-00 00:00:00"): ?>
<span style="color:#FF0000">未設定</span>
<?php else: ?>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['limit_date']); ?>

<?php endif; ?>
</td>
<td align=center><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['pay_date']); ?>
</td>

<td align=center><?php if ($this->_tpl_vars['agency_list'][$this->_tpl_vars['item']['c_member_id']]): ?>紹介<?php endif; ?></td>
<td align=center><?php if ($this->_tpl_vars['item']['cancel_price'] >= 0): ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['cancel_date']); ?>
<?php endif; ?></td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['earnings']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
</tr>
<?php $this->assign('total_room_aomops', ($this->_tpl_vars['total_room_aomops'])."+".($this->_tpl_vars['item']).".room_aomop"); ?>
<?php $this->assign('total_vessel_aomops', ($this->_tpl_vars['total_vessel_aomops'])."+".($this->_tpl_vars['item']).".vessel_aomop"); ?>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>

<tr>
<td>合計</td>
<td></td>
<td></td>
<td></td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_room_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_cancel_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td></td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_room_aomop']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_vessel_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td></td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_vessel_aomops']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_total_aomop']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_earnings']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
</tr>
</table>
<br>
<br>
２、過去利用者入金明細（過去に利用且つ対象期間に入金済）<br>
<table border=1 width=1000>
<tr>
<th>予約ID</th>
<th>利用日</th>
<th>部屋</th>
<th>利用時間</th>
<th>部屋利用入金(税込)</th>
<th>キャンセル料(税込)</th>
<th>配分比</th>
<th>お支払い(税込)</th>
<th>備品利用入金(税込)</th>
<th>配分比</th>
<th>お支払い(税込)</th>
<th>お支払い総額(税込)</th>
<th>備品明細</th>
<th>入金期日</th>
<th>入金日</th>
<th>紹介代理店</th>
<th>キャンセル</th>
<th>AO収益</th>
</tr>
<?php $_from = $this->_tpl_vars['paid_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<tr>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
</td>
<td align=center><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['date']); ?>
</td>
<td align=center><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_name']); ?>
</td>
<td align=center><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['time']); ?>
</td>
<td align=right>
<?php if ($this->_tpl_vars['item']['cancel_price'] < 0): ?>
<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['room_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

<?php else: ?>
0
<?php endif; ?>
</td>
<td align=right>
<?php if ($this->_tpl_vars['item']['cancel_price'] >= 0): ?>
<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['cancel_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

<?php else: ?>
0
<?php endif; ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_data']['owner_room']); ?>
%</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['room_aomop']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['vessel_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_data']['owner_vessel']); ?>
%</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['vessel_aomop']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['total_aomop']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td>
<?php $_from = $this->_tpl_vars['item']['vessel_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i']):
?>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['i']['vessel_name']); ?>
/
<?php endforeach; endif; unset($_from); ?>
</td>
<td align=center>
<?php if ($this->_tpl_vars['item']['pay_limitdate'] == "0000-00-00 00:00:00"): ?>
<span style="color:#FF0000">未設定</span>
<?php else: ?>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['limit_date']); ?>

<?php endif; ?>
</td>
<td align=center><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['pay_date']); ?>
</td>
<td align=center><?php if ($this->_tpl_vars['agency_list'][$this->_tpl_vars['item']['c_member_id']]): ?>紹介<?php endif; ?></td>
<td align=center><?php if ($this->_tpl_vars['item']['cancel_price'] >= 0): ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['cancel_date']); ?>
<?php endif; ?></td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['earnings']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
<tr>
<td>合計</td>
<td></td>
<td></td>
<td></td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_room_price_before']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_cancel_price_before']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td></td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_room_aomop_before']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_vessel_price_before']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td></td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_vessel_aomop_before']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_total_aomop_before']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_earnings_before']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
</tr>
</table>
<br>
<br>
３、利用済み入金待ち一覧（対象期間及び以前含む）<br>
<table border=1 width=1000>
<tr>
<th>予約ID</th>
<th>利用日</th>
<th>部屋</th>
<th>利用時間</th>
<th>部屋利用入金(税込)</th>
<th>キャンセル料(税込)</th>
<th>配分比</th>
<th>お支払い(税込)</th>
<th>備品利用入金(税込)</th>
<th>配分比</th>
<th>お支払い(税込)</th>
<th>お支払い総額(税込)</th>
<th>備品明細</th>
<th>入金期日</th>
<th>入金日</th>
<th>紹介代理店</th>
<th>キャンセル</th>
<th>AO収益</th>
</tr>
<?php $_from = $this->_tpl_vars['unpayment_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<tr>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
</td>
<td align=center><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['date']); ?>
</td>
<td align=center><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_name']); ?>
</td>
<td align=center><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['time']); ?>
</td>
<td align=right>
<?php if ($this->_tpl_vars['item']['cancel_price'] < 0): ?>
<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['room_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

<?php else: ?>
0
<?php endif; ?>
</td>
<td align=right>
<?php if ($this->_tpl_vars['item']['cancel_price'] >= 0): ?>
<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['cancel_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

<?php else: ?>
0
<?php endif; ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_data']['owner_room']); ?>
%</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['room_aomop']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['vessel_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_data']['owner_vessel']); ?>
%</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['vessel_aomop']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['total_aomop']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td>
<?php $_from = $this->_tpl_vars['item']['vessel_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i']):
?>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['i']['vessel_name']); ?>
/
<?php endforeach; endif; unset($_from); ?>
</td>
<td>
<?php if ($this->_tpl_vars['item']['pay_limitdate'] == "0000-00-00 00:00:00" || $this->_tpl_vars['item']['pay_limitdate'] == ''): ?>
<span style="color:#FF0000">未設定</span>
<?php else: ?>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['limit_date']); ?>

<?php endif; ?>
</td><td></td>

<td align=center><?php if ($this->_tpl_vars['agency_list'][$this->_tpl_vars['item']['c_member_id']]): ?>紹介<?php endif; ?></td>
<td align=center><?php if ($this->_tpl_vars['item']['cancel_price'] >= 0): ?>
	<?php if ($this->_tpl_vars['item']['cancel_date'] != '' && $this->_tpl_vars['item']['cancel_date'] != '0000-00-00 00:00:00'): ?>
		<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['cancel_date']); ?>

	<?php endif; ?>	
<?php endif; ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['earnings']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
<tr>
<td>合計</td>
<td></td>
<td></td>
<td></td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_room_price_before_unpayment']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_cancel_price_before_unpayment']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td></td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_room_aomop_before_unpayment']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_vessel_price_before_unpayment']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td></td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_vessel_aomop_before_unpayment']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_total_aomop_before_unpayment']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_earnings_before_unpayment']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
</tr>
</table>
<br>
<br>
４、当月お支払い金額<br>
利用入金済配分総額　<?php echo smarty_modifier_t_escape($this->_tpl_vars['price']); ?>
円（税込）<br>
その他清算費用<br>
当月お支払い金額<br>
<br>
振り込み予定日<br>
お振込先口座<br>

</div>
<?php else: ?>
対象データはありません。
<?php endif; ?>

<?php elseif ($this->_tpl_vars['menu'] == 'repetition_rate'): ?>
<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output','page')); ?>
" />
<input type="hidden" name="menu" value="repetition_rate">

<select name="hall_id" size=5 valign=top>
<?php $_from = $this->_tpl_vars['hall_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_id']); ?>
" <?php if ($this->_tpl_vars['item']['hall_id'] == $this->_tpl_vars['hall_id']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>

<?php endforeach; endif; unset($_from); ?>
</select>

<input type="text" name="year1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year1']); ?>
" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month1']); ?>
" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day1']); ?>
" size=2 style="text-align:right;padding-right:5px;">日 ～ 
<input type="text" name="year2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year2']); ?>
" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month2']); ?>
" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day2']); ?>
" size=2 style="text-align:right;padding-right:5px;">日
<input type="submit" value="出力">
</form>
<br>
<hr>
<h3><?php echo smarty_modifier_t_escape($this->_tpl_vars['title']); ?>
</h3>
<br>
表示日時 : <?php echo ((is_array($_tmp=smarty_modifier_t_escape(time()))) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M:%S")); ?>
<br><br>
<?php if (isset ( $this->_tpl_vars['rate'] )): ?>

会場名：　<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_name']); ?>
<br>
<table border=1 width=400>
<tr>
<td style='border: 1px #646464 solid;text-align: center;vertical-align:middle;'>予約期間</td>
<td style='border: 1px #646464 solid;text-align: center;vertical-align:middle;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['year1']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['month1']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['day1']); ?>
日</td>
<td style='border: 1px #646464 solid;text-align: center;vertical-align:middle;'>～</td>
<td style='border: 1px #646464 solid;text-align: center;vertical-align:middle;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['year2']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['month2']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['day2']); ?>
日</td>
</tr>
</table>
<br>
<table border=1>
<tr>
<td width=150></td>
<td norap style='border: 1px #646464 solid;text-align: center;vertical-align:middle;'>利用数</td>
<td norap style='border: 1px #646464 solid;text-align: center;vertical-align:middle;'>内リピート数</td>
<td norap style='border: 1px #646464 solid;text-align: center;vertical-align:middle;'>リピート率</td>
</tr>
<tr>
<td width=150></td>
<td style='border: 1px #646464 solid;text-align: center;vertical-align:middle;'><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['rate_total']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

</td>
<td style='border: 1px #646464 solid;text-align: center;vertical-align:middle;'><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['rate_count']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

</td>
<td style='border: 1px #646464 solid;text-align: center;vertical-align:middle;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['rate']); ?>
%
</td>
</tr>
</table>
<br>
リピート率推移<br>
<table border=1>
<tr>
<td rowspan="2" width="150"></td>
<td colspan="3" style='border: 1px #646464 solid;text-align: center;vertical-align:middle;'>会場全体</td>
</tr>
<tr>
<td norap style='border: 1px #646464 solid;text-align: center;vertical-align:middle;'>利用数</td>
<td norap style='border: 1px #646464 solid;text-align: center;vertical-align:middle;'>内リピート数</td>
<td norap style='border: 1px #646464 solid;text-align: center;vertical-align:middle;'>リピート率</td>
</tr>

<?php $_from = $this->_tpl_vars['repeat_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<tr>
<td style='border: 1px #646464 solid;text-align: center;vertical-align:middle;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['date']); ?>
</td>
<td style='border: 1px #646464 solid;text-align: center;vertical-align:middle;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['rate_total']); ?>

</td>
<td style='border: 1px #646464 solid;text-align: center;vertical-align:middle;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['repeat_count']); ?>

</td>
<td style='border: 1px #646464 solid;text-align: center;vertical-align:middle;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['rate']); ?>
%
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>

</table>
<br>

<?php 


 ?>

<?php endif; ?>

<?php elseif ($this->_tpl_vars['menu'] == 'utilization_rates'): ?>
<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output','page')); ?>
" />
<input type="hidden" name="menu" value="utilization_rates">

<select name="hall_id" size=5 valign=top>
<?php $_from = $this->_tpl_vars['hall_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_id']); ?>
" <?php if ($this->_tpl_vars['item']['hall_id'] == $this->_tpl_vars['hall_id']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>

<?php endforeach; endif; unset($_from); ?>
</select>

<input type="text" name="year1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year1']); ?>
" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month1']); ?>
" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day1']); ?>
" size=2 style="text-align:right;padding-right:5px;">日 ～ 
<input type="text" name="year2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year2']); ?>
" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month2']); ?>
" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day2']); ?>
" size=2 style="text-align:right;padding-right:5px;">日
<input type="submit" value="出力">
</form>
<br>
<hr>
<h3><?php echo smarty_modifier_t_escape($this->_tpl_vars['title']); ?>
</h3>
<br>

<?php if (isset ( $this->_tpl_vars['hall_name'] )): ?>
会場名：<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_name']); ?>
<br>
利用期間：<?php echo smarty_modifier_t_escape($this->_tpl_vars['date_s']); ?>
 ～ <?php echo smarty_modifier_t_escape($this->_tpl_vars['date_e']); ?>
<br>
<br>
<table border=1>
<tr>
<td></td>
<td colspan=2>金額稼働率</td>
<td>時間稼働率</td>
</tr>
<tr>
<td></td>
<td>利用のみ</td>
<td>OP含む</td>
<td></td>
</tr>
<tr>
<td>会場全体</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['all_rate_a']); ?>
％</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['all_rate_b']); ?>
％</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['all_rate_c']); ?>
％</td>
</tr>
<?php $_from = $this->_tpl_vars['room_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<tr>
<td>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_name']); ?>

</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['rate_a']); ?>
％</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['rate_b']); ?>
％</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['rate_c']); ?>
％</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>



<?php endif; ?>

<?php elseif ($this->_tpl_vars['menu'] == 'money_utilization_rates'): ?>
<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output','page')); ?>
" />
<input type="hidden" name="menu" value="money_utilization_rates">

<select name="hall_id" size=5 valign=top>
<?php $_from = $this->_tpl_vars['hall_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_id']); ?>
" <?php if ($this->_tpl_vars['item']['hall_id'] == $this->_tpl_vars['hall_id']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>

<?php endforeach; endif; unset($_from); ?>
</select>

<input type="text" name="year1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year1']); ?>
" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month1']); ?>
" size=2 style="text-align:right;padding-right:5px;">月 ～ 
<input type="text" name="year2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year2']); ?>
" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month2']); ?>
" size=2 style="text-align:right;padding-right:5px;">月

<input type="submit" value="出力">
</form>
<br>
<hr>
<h3><?php echo smarty_modifier_t_escape($this->_tpl_vars['title']); ?>
</h3>
<br>

<?php if (isset ( $this->_tpl_vars['room_data'] )): ?>
会場名：<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_name']); ?>
<br>
利用期間：<?php echo smarty_modifier_t_escape($this->_tpl_vars['date_s']); ?>
 ～ <?php echo smarty_modifier_t_escape($this->_tpl_vars['date_e']); ?>
<br>
<br>
金額稼働率　利用のみ
<table border=1>
<tr>
<td></td>
<td align=center>会場全体</td>
<?php $_from = $this->_tpl_vars['room_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<td align=center><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_name']); ?>
</td>
<?php endforeach; endif; unset($_from); ?>
</tr>
<?php $_from = $this->_tpl_vars['reserved_room_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<tr>
<td align=right>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['date']); ?>

</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['all_rate_a']); ?>
％</td>
<?php $_from = $this->_tpl_vars['item']['room_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i']):
?>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['i']['rate_a']); ?>
％</td>
<?php endforeach; endif; unset($_from); ?>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>
<br>
金額稼働率　OP含む
<table border=1>
<tr>
<td></td>
<td align=center>会場全体</td>
<?php $_from = $this->_tpl_vars['room_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<td align=center><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_name']); ?>
</td>
<?php endforeach; endif; unset($_from); ?>
</tr>
<?php $_from = $this->_tpl_vars['reserved_room_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<tr>
<td align=right>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['date']); ?>

</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['all_rate_b']); ?>
％</td>
<?php $_from = $this->_tpl_vars['item']['room_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i']):
?>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['i']['rate_b']); ?>
％</td>
<?php endforeach; endif; unset($_from); ?>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>
<br>
<?php 

 ?>

<?php endif; ?>

<?php elseif ($this->_tpl_vars['menu'] == 'time_utilization_rates'): ?>
<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output','page')); ?>
" />
<input type="hidden" name="menu" value="time_utilization_rates">

<select name="hall_id" size=5 valign=top>
<?php $_from = $this->_tpl_vars['hall_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_id']); ?>
" <?php if ($this->_tpl_vars['item']['hall_id'] == $this->_tpl_vars['hall_id']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>

<?php endforeach; endif; unset($_from); ?>
</select>

<input type="text" name="year1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year1']); ?>
" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month1']); ?>
" size=2 style="text-align:right;padding-right:5px;">月 ～ 
<input type="text" name="year2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year2']); ?>
" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month2']); ?>
" size=2 style="text-align:right;padding-right:5px;">月

<input type="submit" value="出力">
</form>
<br>
<hr>
<h3><?php echo smarty_modifier_t_escape($this->_tpl_vars['title']); ?>
</h3>
<br>

<?php if (isset ( $this->_tpl_vars['room_data'] )): ?>
会場名：<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_name']); ?>
<br>
利用期間：<?php echo smarty_modifier_t_escape($this->_tpl_vars['date_s']); ?>
 ～ <?php echo smarty_modifier_t_escape($this->_tpl_vars['date_e']); ?>
<br>
<br>
時間稼働率
<table border=1>
<tr>
<td></td>
<td align=center>会場全体</td>
<?php $_from = $this->_tpl_vars['room_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<td align=center><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_name']); ?>
</td>
<?php endforeach; endif; unset($_from); ?>
</tr>
<?php $_from = $this->_tpl_vars['reserved_room_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<tr>
<td align=right>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['date']); ?>

</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['all_rate_c']); ?>
％</td>
<?php $_from = $this->_tpl_vars['item']['room_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i']):
?>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['i']['rate_c']); ?>
％</td>
<?php endforeach; endif; unset($_from); ?>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>


<?php endif; ?>

<?php elseif ($this->_tpl_vars['menu'] == 'analysis_at_reservation_period'): ?>
<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output','page')); ?>
" />
<input type="hidden" name="menu" value="analysis_at_reservation_period">

<select name="hall_id" size=5 valign=top>
<?php $_from = $this->_tpl_vars['hall_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_id']); ?>
" <?php if ($this->_tpl_vars['item']['hall_id'] == $this->_tpl_vars['hall_id']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>

<?php endforeach; endif; unset($_from); ?>
</select>

<input type="text" name="year1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year1']); ?>
" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month1']); ?>
" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day1']); ?>
" size=2 style="text-align:right;padding-right:5px;">日 ～ 
<input type="text" name="year2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year2']); ?>
" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month2']); ?>
" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day2']); ?>
" size=2 style="text-align:right;padding-right:5px;">日
<input type="submit" value="出力">
</form>
<br>
<hr>
<h3><?php echo smarty_modifier_t_escape($this->_tpl_vars['title']); ?>
</h3>
<br>
<?php if ($this->_tpl_vars['room_data']): ?>

会場名：<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_name']); ?>
<br>
該当予約期間：<?php echo smarty_modifier_t_escape($this->_tpl_vars['year1']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['month1']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['day1']); ?>
日 ～ <?php echo smarty_modifier_t_escape($this->_tpl_vars['year2']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['month2']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['day2']); ?>
日<br>
<br>
<table border=1>
<tr>
<td></td>
<td align=center>予約数</td>
<td align=center>最短期間（日）</td>
<td align=center>最長期間（日）</td>
<td align=center>平均期間</td>
</tr>
<?php $_from = $this->_tpl_vars['room_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<tr>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_name']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['min']); ?>
日</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['max']); ?>
日</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['average']); ?>
日</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>


<?php endif; ?>

<?php elseif ($this->_tpl_vars['menu'] == 'user_analysis'): ?>
<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output','page')); ?>
" />
<input type="hidden" name="menu" value="user_analysis">

<select name="hall_id" size=5 valign=top>
<?php $_from = $this->_tpl_vars['hall_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_id']); ?>
" <?php if ($this->_tpl_vars['item']['hall_id'] == $this->_tpl_vars['hall_id']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>

<?php endforeach; endif; unset($_from); ?>
</select>

<input type="text" name="year1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year1']); ?>
" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month1']); ?>
" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day1']); ?>
" size=2 style="text-align:right;padding-right:5px;">日 ～ 
<input type="text" name="year2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year2']); ?>
" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month2']); ?>
" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day2']); ?>
" size=2 style="text-align:right;padding-right:5px;">日
<input type="submit" value="出力">
</form>
<br>
<hr>
<h3><?php echo smarty_modifier_t_escape($this->_tpl_vars['title']); ?>
</h3>
<br>
<?php if ($this->_tpl_vars['room_data']): ?>

会場名：<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_name']); ?>
<br>
利用期間：<?php echo smarty_modifier_t_escape($this->_tpl_vars['year1']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['month1']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['day1']); ?>
日 ～ <?php echo smarty_modifier_t_escape($this->_tpl_vars['year2']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['month2']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['day2']); ?>
日<br>
<br>
<table border=1>
<tr>
<td></td>
<td></td>
<td colspan=7 align=center>用途</td>
</tr>
<tr>
<td></td>
<td align=center>利用数</td>
<td align=center>会議</td>
<td align=center>セミナー</td>
<td align=center>研修</td>
<td align=center>面接・試験</td>
<td align=center>懇談会・パーティ</td>
<td align=center>その他</td>
<td align=center>未選択</td>
</tr>
<?php $_from = $this->_tpl_vars['room_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<tr>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_name']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['conference']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['seminar']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['training']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['interview']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['party']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['etc']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['no_data']); ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>

<?php endif; ?>

<?php elseif ($this->_tpl_vars['menu'] == 'repetition_order'): ?>
<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output','page')); ?>
" />
<input type="hidden" name="menu" value="repetition_order">

<input type="text" name="year1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year1']); ?>
" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month1']); ?>
" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day1']); ?>
" size=2 style="text-align:right;padding-right:5px;">日 ～ 
<input type="text" name="year2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year2']); ?>
" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month2']); ?>
" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day2']); ?>
" size=2 style="text-align:right;padding-right:5px;">日
<input type="submit" value="出力">
</form>
<br>
<hr>
<h3><?php echo smarty_modifier_t_escape($this->_tpl_vars['title']); ?>
</h3>
<br>
表示日時 : <?php echo ((is_array($_tmp=smarty_modifier_t_escape(time()))) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M:%S")); ?>
<br><br>

<?php if (isset ( $this->_tpl_vars['order_list'] )): ?>

申し込み期間：<?php echo smarty_modifier_t_escape($this->_tpl_vars['year1']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['month1']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['day1']); ?>
日 ～ <?php echo smarty_modifier_t_escape($this->_tpl_vars['year2']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['month2']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['day2']); ?>
日<br>
<br>
<table border=1>
<tr>
<td align="center">順位</td>
<td align="center">会場名</td>
<td align="center">利用数</td>
<td align="center">内リピート数</td>
<td align="center"><b>リピート率</b></td>
</tr>
<?php $_from = $this->_tpl_vars['order_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<tr>
<td align="right">
<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']+1); ?>

</td>
<td>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>

</td>
<td align="right">
<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['total']); ?>

</td>
<td align="right">
<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['count']); ?>

</td>
<td align="right">
<b><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['repeat_rate']); ?>
%</b>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>
<?php endif; ?>

<?php elseif ($this->_tpl_vars['menu'] == 'utilization_rates_order'): ?>
<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output','page')); ?>
" />
<input type="hidden" name="menu" value="utilization_rates_order">

<input type="radio" name="mode" value="0" <?php if ($this->_tpl_vars['mode'] == 0): ?>checked<?php endif; ?>>利用料
<input type="radio" name="mode" value="1" <?php if ($this->_tpl_vars['mode'] == 1): ?>checked<?php endif; ?>>利用料+OP
<input type="radio" name="mode" value="2" <?php if ($this->_tpl_vars['mode'] == 2): ?>checked<?php endif; ?>>時間稼働率
<br>
<input type="text" name="year1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year1']); ?>
" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month1']); ?>
" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day1']); ?>
" size=2 style="text-align:right;padding-right:5px;">日 ～ 
<input type="text" name="year2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year2']); ?>
" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month2']); ?>
" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day2']); ?>
" size=2 style="text-align:right;padding-right:5px;">日
<input type="submit" value="出力">
</form>
<br>
<hr>
<h3><?php echo smarty_modifier_t_escape($this->_tpl_vars['title']); ?>
</h3>
<br>

<?php if (isset ( $this->_tpl_vars['order_list'] )): ?>

該当利用期間：<?php echo smarty_modifier_t_escape($this->_tpl_vars['year1']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['month1']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['day1']); ?>
日 ～ <?php echo smarty_modifier_t_escape($this->_tpl_vars['year2']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['month2']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['day2']); ?>
日<br>
<br>

<table border=1>
<tr>
<td></td>
<td></td>
<td colspan=2 align=right>金額稼働率</td>
<td rowspan=2 align=right>時間稼働率</td>
</tr>
<tr>
<td align=right>順位</td>
<td align=right>会場名</td>
<td align=right>利用料</td>
<td align=right>利用料+OP</td>
</tr>
<?php $_from = $this->_tpl_vars['order_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<tr>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['key']+1); ?>
位</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['rate_a']); ?>
％</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['rate_b']); ?>
％</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['rate_c']); ?>
％</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>

<?php endif; ?>

<?php elseif ($this->_tpl_vars['menu'] == 'room_utilization_rates_order'): ?>
<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output','page')); ?>
" />
<input type="hidden" name="menu" value="room_utilization_rates_order">

<input type="radio" name="mode" value="0" <?php if ($this->_tpl_vars['mode'] == 0): ?>checked<?php endif; ?>>利用料
<input type="radio" name="mode" value="1" <?php if ($this->_tpl_vars['mode'] == 1): ?>checked<?php endif; ?>>利用料+OP
<input type="radio" name="mode" value="2" <?php if ($this->_tpl_vars['mode'] == 2): ?>checked<?php endif; ?>>時間稼働率
<br>
<input type="text" name="year1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year1']); ?>
" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month1']); ?>
" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day1']); ?>
" size=2 style="text-align:right;padding-right:5px;">日 ～ 
<input type="text" name="year2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year2']); ?>
" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month2']); ?>
" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day2']); ?>
" size=2 style="text-align:right;padding-right:5px;">日
<input type="submit" value="出力">
</form>
<br>
<hr>
<h3><?php echo smarty_modifier_t_escape($this->_tpl_vars['title']); ?>
</h3>
<br>

<?php if (isset ( $this->_tpl_vars['order_list'] )): ?>

該当利用期間：<?php echo smarty_modifier_t_escape($this->_tpl_vars['year1']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['month1']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['day1']); ?>
日 ～ <?php echo smarty_modifier_t_escape($this->_tpl_vars['year2']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['month2']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['day2']); ?>
日<br>
<br>

<table border=1>
<tr>
<td></td>
<td></td>
<td></td>
<td colspan=2 align=center>金額稼働率</td>
<td rowspan=2 align=center>時間稼働率</td>
</tr>
<tr>
<td align=center>順位</td>
<td align=center>会場名</td>
<td align=center>部屋名</td>
<td align=center>利用料</td>
<td align=center>利用料+OP</td>
</tr>
<?php $_from = $this->_tpl_vars['order_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<tr>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['key']+1); ?>
位</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_name']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['rate_a']); ?>
％</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['rate_b']); ?>
％</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['rate_c']); ?>
％</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>

<?php endif; ?>

<?php elseif ($this->_tpl_vars['menu'] == 'unpayment_list'): ?>
<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output','page')); ?>
" />
<input type="hidden" name="menu" value="unpayment_list">

<select name="hall_id" size=5 valign=top>
<option value="0" <?php if ($this->_tpl_vars['item']['hall_id'] == 0): ?>selected<?php endif; ?>>全会場
<?php $_from = $this->_tpl_vars['hall_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_id']); ?>
" <?php if ($this->_tpl_vars['item']['hall_id'] == $this->_tpl_vars['hall_id']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>

<?php endforeach; endif; unset($_from); ?>
</select>
<br>
期日指定：（入金予定日）
<input type="text" name="year" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']); ?>
" size=2 style="text-align:right;padding-right:5px;">日
<input type="submit" value="出力">
</form>
<br>
<hr>
<h3><?php echo smarty_modifier_t_escape($this->_tpl_vars['title']); ?>
</h3>
<br>

<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_name']); ?>
<br>
<?php if ($this->_tpl_vars['year'] && $this->_tpl_vars['month'] && $this->_tpl_vars['day']): ?>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']); ?>
日(以前の入金予定 未入金)<br>
<?php endif; ?>
<br>
<table border=1>
<tr>
<td>入金予定日</td>
<td>利用日</td>
<td>会場名</td>
<td>予約ID</td>
<td>法人名/団体名</td>
<td>入金予定金額</td>
<td>内部屋利用料金</td>
<td>内ＯＰ利用料</td>
<td>内サービス利用料</td>
<td>入金済み</td>
<td>未入金額</td>
<td>経過日数</td>
<td>備考</td>
</tr>
<?php $_from = $this->_tpl_vars['reserve_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<tr>
<td align=right>
<?php if ($this->_tpl_vars['item']['pay_limitdate'] == "-0001年11月30日"): ?>
<span style="color:#FF0000">未設定</span>
<?php else: ?>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['pay_limitdate']); ?>

<?php endif; ?>
</td>
<td><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['begin_datetime']))) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y年%m月%d日") : smarty_modifier_date_format($_tmp, "%Y年%m月%d日")); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_names'][$this->_tpl_vars['item']['hall_id']]); ?>
</td>
<td aligh=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['corp']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['total_price']); ?>
</td>
<?php if ($this->_tpl_vars['item']['cancel_flag'] == 1): ?>
<td colspan="3" align="center">キャンセル</td>
<?php else: ?>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['room_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['vessel_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['service_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<?php endif; ?>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['pay_money']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['unpayment']); ?>
</td>
<td align=right>
<?php if ($this->_tpl_vars['item']['pay_limitdate'] == "-0001年11月30日"): ?>
<span style="color:#FF0000">--</span>
<?php else: ?>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['over_days']); ?>
日
<?php endif; ?>
</td>
<td>

<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['memo']))) ? $this->_run_mod_handler('t_url2cmd', true, $_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id'])) : smarty_modifier_t_url2cmd($_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id']))))) ? $this->_run_mod_handler('t_cmd', true, $_tmp, 'diary') : smarty_modifier_t_cmd($_tmp, 'diary')))) ? $this->_run_mod_handler('t_decoration', true, $_tmp) : smarty_modifier_t_decoration($_tmp)); ?>


</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>


<!-- add cancel pay ment-->
<?php elseif ($this->_tpl_vars['menu'] == 'cancelpayment_list'): ?>
<form id="rental_form" name="search" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output','page')); ?>
"/>
<input type="hidden" name="menu" value="cancelpayment_list">
<input type="hidden" value="0" name="page_num" id="page_num"/>
<select name="hall_id" size=5 valign=top>
<option value="0" <?php if ($this->_tpl_vars['item']['hall_id'] == 0): ?>selected<?php endif; ?>>全会場
<?php $_from = $this->_tpl_vars['hall_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_id']); ?>
" <?php if ($this->_tpl_vars['item']['hall_id'] == $this->_tpl_vars['hall_id']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>

<?php endforeach; endif; unset($_from); ?>
</select>
<br>
利用日: 
<input type="text" name="yearto" value="<?php if (isset ( $this->_tpl_vars['yearto'] )): ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['yearto']); ?>
<?php endif; ?>" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="monthto" value="<?php if (isset ( $this->_tpl_vars['monthto'] )): ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['monthto']); ?>
<?php endif; ?>" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="dayto" value="<?php if (isset ( $this->_tpl_vars['dayto'] )): ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['dayto']); ?>
<?php endif; ?>" size=2 style="text-align:right;padding-right:5px;">日
<span style="margin: 0px 10px;">～</span>
<input type="text" name="yearfrom" value="<?php if (isset ( $this->_tpl_vars['yearfrom'] )): ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['yearfrom']); ?>
<?php endif; ?>" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="monthfrom" value="<?php if (isset ( $this->_tpl_vars['monthfrom'] )): ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['monthfrom']); ?>
<?php endif; ?>" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="dayfrom" value="<?php if (isset ( $this->_tpl_vars['dayfrom'] )): ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['dayfrom']); ?>
<?php endif; ?>" size=2 style="text-align:right;padding-right:5px;">日
<input type="submit" value="出力" name="ok">
</form>
<br>
<hr>
<h3><?php echo smarty_modifier_t_escape($this->_tpl_vars['title']); ?>
</h3>
<br>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_name']); ?>
<br>
<?php if ($this->_tpl_vars['yearto'] && $this->_tpl_vars['monthto'] && $this->_tpl_vars['dayto'] && $this->_tpl_vars['yearfrom'] && $this->_tpl_vars['monthfrom'] && $this->_tpl_vars['dayfrom']): ?>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['yearto']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['monthto']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['dayto']); ?>
日<span style="margin: 0px 10px;">～</span><?php echo smarty_modifier_t_escape($this->_tpl_vars['yearfrom']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['monthfrom']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['dayfrom']); ?>
日(以前の入金予定 未入金)<br>
<?php endif; ?>
<?php if ($this->_tpl_vars['reserve_data']): ?>
<br>
<table border=1>
<tr>
<td style="width:70px;">入金予定日</td>
<td style="width:70px;">利用日</td>
<td style="width:70px;">会場名</td>
<td style="width:70px;">予約ID</td>
<td style="width:70px;">法人名/団体名</td>
<td style="width:70px;">入金予定金額</td>
<td style="width:20px;">内部屋利用料金</td>
<td style="width:20px;">内ＯＰ利用料</td>
<td style="width:20px;">内サービス利用料</td>
<td style="width:30px;">入金済み</td>
<td style="width:30px;">未入金額</td>
<td style="width:30px;">経過日数</td>
<td style="width:150px;">備考</td>
</tr>
<?php endif; ?>
<?php $_from = $this->_tpl_vars['reserve_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<?php if ($this->_tpl_vars['item']['cash_balance'] > 0): ?>
<tr>
<td align=right>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['pay_limitdate']); ?>

</td>
<td><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['begin_datetime']))) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y年%m月%d日") : smarty_modifier_date_format($_tmp, "%Y年%m月%d日")); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_names'][$this->_tpl_vars['item']['hall_id']]); ?>
</td>
<td aligh=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['corp']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['cancel_price']); ?>
</td>
<?php if ($this->_tpl_vars['item']['cancel_flag'] == 1): ?>
<td colspan="3" align="center">キャンセル</td>
<?php else: ?>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['room_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['vessel_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['service_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<?php endif; ?>
<td align=right>
<?php if ($this->_tpl_vars['item']['ab_data']): ?>
	<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['ab_data']['pay_money']); ?>

<?php else: ?>

<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['pay_money']); ?>

<?php endif; ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['cash_balance']); ?>
</td>
<td align=right>
<?php if ($this->_tpl_vars['item']['over_days']): ?>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['over_days']); ?>
日
<?php endif; ?>
</td>
<td>

<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['memo']))) ? $this->_run_mod_handler('t_url2cmd', true, $_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id'])) : smarty_modifier_t_url2cmd($_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id']))))) ? $this->_run_mod_handler('t_cmd', true, $_tmp, 'diary') : smarty_modifier_t_cmd($_tmp, 'diary')))) ? $this->_run_mod_handler('t_decoration', true, $_tmp) : smarty_modifier_t_decoration($_tmp)); ?>


</td>
</tr>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
</table>
<br>
<div style="text-align:center;">
<?php $_from = $this->_tpl_vars['page_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<?php if ($this->_tpl_vars['item']['select']): ?>
	<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['page']); ?>

<?php else: ?>
	<a href="javascript:return false" onclick="paginate('<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['index']); ?>
');" ><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['page']); ?>
</a>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
</div>
<!-- end -->


<?php elseif ($this->_tpl_vars['menu'] == 'sales_expectation'): ?>
<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output','page')); ?>
" />
<input type="hidden" name="menu" value="sales_expectation">

売上見込月：
<input type="text" name="year" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
" size=2 style="text-align:right;padding-right:5px;">月
<br>
売上確認日：
<input type="text" name="check_year" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['check_year']); ?>
" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="check_month" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['check_month']); ?>
" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="check_day" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['check_day']); ?>
" size=2 style="text-align:right;padding-right:5px;">日
<input type="submit" value="出力">
</form>
<br>
<hr>
<h3><?php echo smarty_modifier_t_escape($this->_tpl_vars['title']); ?>
</h3>
<br>
<?php if ($this->_tpl_vars['hall_list']): ?>
売上見込月：<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
月<br>
売上確認日：<?php echo smarty_modifier_t_escape($this->_tpl_vars['check_year']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['check_month']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['check_day']); ?>
日<br>
<br>
<br>
(税抜き)
<div style='width:900px;overflow-x:scroll;'>
<table border=1 width=1400>
<tr>
<td></td>
<td colspan=2>当月利用済み金額</td>
<td colspan=2>当月利用予定金額</td>
<td colspan=2><?php echo smarty_modifier_t_escape($this->_tpl_vars['month_2']); ?>
月利用予定金額</td>
<td colspan=2><?php echo smarty_modifier_t_escape($this->_tpl_vars['month_3']); ?>
月利用予定金額</td>
<td colspan=2><?php echo smarty_modifier_t_escape($this->_tpl_vars['month_4']); ?>
月利用予定金額</td>
</tr>
<tr>
<td>会場名</td>
<td>利用料</td>
<td>OP料</td>
<td>利用料</td>
<td>OP料</td>
<td>利用料</td>
<td>OP料</td>
<td>利用料</td>
<td>OP料</td>
<td>利用料</td>
<td>OP料</td>
</tr>
<?php $_from = $this->_tpl_vars['hall_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<tr>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['total_room_price1']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['total_vessel_price1']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['total_room_price2']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['total_vessel_price2']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['total_room_price3']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['total_vessel_price3']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['total_room_price4']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['total_vessel_price4']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['total_room_price5']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['total_vessel_price5']); ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>
</div>

<?php endif; ?>

<?php elseif ($this->_tpl_vars['menu'] == 'customer_use_state'): ?>
<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output','page')); ?>
" />
<input type="hidden" name="menu" value="customer_use_state">

顧客特定<br>
顧客ID
<input type="text" name="c_member_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member_id']); ?>
"><br>
予約者
<input type="text" name="nickname" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['nickname']); ?>
"><br>
法人/団体名
<input type="text" name="corp" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['corp']); ?>
"><br>
利用範囲
<input type="text" name="year1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year1']); ?>
" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month1']); ?>
" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day1']); ?>
" size=2 style="text-align:right;padding-right:5px;">日 ～ 
<input type="text" name="year2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year2']); ?>
" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month2']); ?>
" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day2']); ?>
" size=2 style="text-align:right;padding-right:5px;">日
<input type="submit" value="出力">
</form>
<br>
<hr>
<h3><?php echo smarty_modifier_t_escape($this->_tpl_vars['title']); ?>
</h3>
<?php if ($this->_tpl_vars['c_member']): ?>

法人/団体名：<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['corp']); ?>
<br>
予約者：<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['nickname']); ?>
<br>
顧客ID：<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['c_member_id']); ?>
<br>
電話：<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['tel']); ?>
<br>
FAX：<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['fax']); ?>
<br>
住所：<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['address']); ?>
<br>
<br>
<?php if ($this->_tpl_vars['year1'] && $this->_tpl_vars['month1'] && $this->_tpl_vars['day1'] && $this->_tpl_vars['year2'] && $this->_tpl_vars['month2'] && $this->_tpl_vars['day2']): ?>
利用範囲：<?php echo smarty_modifier_t_escape($this->_tpl_vars['year1']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['month1']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['day1']); ?>
日 ～ <?php echo smarty_modifier_t_escape($this->_tpl_vars['year2']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['month2']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['day2']); ?>
日<br>
<br>
<?php endif; ?>

<table border=1>
<tr>
<td>利用日</td>
<td>会場</td>
<td>部屋</td>
<td>利用時間帯</td>
<td>利用時間</td>
<td>用途</td>
</tr>
<?php $_from = $this->_tpl_vars['reserve_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['date']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_name']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['time']); ?>
</td>
<td><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['between_time']))) ? $this->_run_mod_handler('round', true, $_tmp) : round($_tmp)); ?>
時間</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['purpose']); ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
<td></td>
<td></td>
<td></td>
<td>総利用時間</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['total_time']); ?>
時間</td>
<td></td>
</tr>
<?php else: ?>
顧客が特定できません。
<?php endif; ?>

<?php elseif ($this->_tpl_vars['menu'] == 'news_flash'): ?>
<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output','page')); ?>
" />
<input type="hidden" name="menu" value="news_flash">

売上見込月：
<input type="text" name="year" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
" size=2 style="text-align:right;padding-right:5px;">月
<br>
予約確認日：
<input type="text" name="check_year" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['check_year']); ?>
" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="check_month" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['check_month']); ?>
" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="check_day" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['check_day']); ?>
" size=2 style="text-align:right;padding-right:5px;">日
<input type="submit" value="出力">
</form>
<br>
<hr>
<h3><?php echo smarty_modifier_t_escape($this->_tpl_vars['title']); ?>
</h3>
<br>
<?php if ($this->_tpl_vars['hall_list']): ?>
売上見込月：<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
月<br>
予約確認日：<?php echo smarty_modifier_t_escape($this->_tpl_vars['check_year']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['check_month']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['check_day']); ?>
日<br>
<br>
<br>
(税抜き)
<div style='width:900px;overflow-x:scroll;'>
<table border=1 width=900>
<tr>
<td></td>
<td colspan=2>昨日予約</td>
<td colspan=2>当月予約</td>
<td colspan=2>当月キャンセル</td>
</tr>
<tr>
<td>会場名</td>
<td>金額</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['yesterday_reserve_count']); ?>
件</td>
<td>予約累計</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_count']); ?>
件</td>
<td>キャンセル差額</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_cancel_count']); ?>
件</td>
</tr>
<?php $_from = $this->_tpl_vars['hall_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<tr>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['total_room_price1']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['total_vessel_price1']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['total_room_price2']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['total_vessel_price2']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['total_room_price3']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['total_vessel_price3']); ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>
</div>

<?php endif; ?>

<?php elseif ($this->_tpl_vars['menu'] == 'cancellation_analysis'): ?>
<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output','page')); ?>
" />
<input type="hidden" name="menu" value="cancellation_analysis">

会場選択：
<select name="hall_id" size=5 valign=top>
<option value="0" <?php if ($this->_tpl_vars['item']['hall_id'] == $this->_tpl_vars['hall_id']): ?>selected<?php endif; ?>>全会場</option>
<?php $_from = $this->_tpl_vars['hall_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_id']); ?>
" <?php if ($this->_tpl_vars['item']['hall_id'] == $this->_tpl_vars['hall_id']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>

<?php endforeach; endif; unset($_from); ?>
</select>
<?php if ($this->_tpl_vars['room_list']): ?>
部屋選択：
<select name="room_id" size=5 valign=top>
<option value="0" <?php if ($this->_tpl_vars['item']['room_id'] == $this->_tpl_vars['room_id']): ?>selected<?php endif; ?>>全部屋</option>
<?php $_from = $this->_tpl_vars['room_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_id']); ?>
" <?php if ($this->_tpl_vars['item']['room_id'] == $this->_tpl_vars['room_id']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_name']); ?>

<?php endforeach; endif; unset($_from); ?>
</select>
<?php endif; ?>
<br>
キャンセル日対象期間：
<input type="text" name="year1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year1']); ?>
" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month1']); ?>
" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day1']); ?>
" size=2 style="text-align:right;padding-right:5px;">日 ～ 
<input type="text" name="year2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year2']); ?>
" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month2']); ?>
" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day2']); ?>
" size=2 style="text-align:right;padding-right:5px;">日
<input type="submit" value="出力">
</form>
<br>
<hr>
<h3><?php echo smarty_modifier_t_escape($this->_tpl_vars['title']); ?>
</h3>

<?php if ($this->_tpl_vars['list']): ?>
<div style='width:900px;overflow-x:scroll;'>
<table border=1 width=1500>
<tr>
<td align=center>予約ID</td>
<td align=center>会場名</td>
<td align=center>部屋名</td>
<td align=center>理由（メモ）</td>
<td align=center>キャンセル料率</td>
<td align=center>キャンセル料(税抜)</td>
<td align=center>キャンセル日</td>
<td align=center>仮予約からの経過日数</td>
<td align=center>承認日からの経過日数</td>
<td align=center>利用日までの日数</td>
</tr>
<?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<tr>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_name']); ?>
</td>
<td>
<?php if ($this->_tpl_vars['item']['memo']): ?>
	<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['memo']))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('t_url2cmd', true, $_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id'])) : smarty_modifier_t_url2cmd($_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id']))))) ? $this->_run_mod_handler('t_cmd', true, $_tmp, 'diary') : smarty_modifier_t_cmd($_tmp, 'diary')))) ? $this->_run_mod_handler('t_decoration', true, $_tmp) : smarty_modifier_t_decoration($_tmp)); ?>

<?php else: ?>
	特になし
<?php endif; ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['cancel_rate']); ?>
％</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['cancel_price']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['cancel_date']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['tmp_to_cancel_days']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_to_cancel_days']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['cancel_to_begin_days']); ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>
</div>

<?php else: ?>
対象のデータはありません。
<?php endif; ?>

<?php elseif ($this->_tpl_vars['menu'] == 'long_term_use'): ?>
<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output','page')); ?>
" />
<input type="hidden" name="menu" value="long_term_use">

会場選択：
<select name="hall_id" size=5 valign=top>
<option value="0" <?php if ($this->_tpl_vars['item']['hall_id'] == $this->_tpl_vars['hall_id']): ?>selected<?php endif; ?>>全会場</option>
<?php $_from = $this->_tpl_vars['hall_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_id']); ?>
" <?php if ($this->_tpl_vars['item']['hall_id'] == $this->_tpl_vars['hall_id']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>

<?php endforeach; endif; unset($_from); ?>
</select>
<br>
利用日期間：
<input type="text" name="year1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year1']); ?>
" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month1']); ?>
" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day1']); ?>
" size=2 style="text-align:right;padding-right:5px;">日 ～ 
<input type="text" name="year2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year2']); ?>
" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month2']); ?>
" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day2']); ?>
" size=2 style="text-align:right;padding-right:5px;">日<br>
仮予約期間：
<input type="text" name="year3" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year3']); ?>
" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month3" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month3']); ?>
" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day3" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day3']); ?>
" size=2 style="text-align:right;padding-right:5px;">日 ～ 
<input type="text" name="year4" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year4']); ?>
" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month4" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month4']); ?>
" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day4" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day4']); ?>
" size=2 style="text-align:right;padding-right:5px;">日
<input type="submit" value="出力">
</form>
<br>
<hr>
<h3><?php echo smarty_modifier_t_escape($this->_tpl_vars['title']); ?>
</h3>
<?php if ($this->_tpl_vars['list']): ?>

会場：<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_name']); ?>
<br>
利用日期間：
<?php if ($this->_tpl_vars['year1'] && $this->_tpl_vars['month1'] && $this->_tpl_vars['day1'] && $this->_tpl_vars['year2'] && $this->_tpl_vars['month2'] && $this->_tpl_vars['day2']): ?>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['year1']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['month1']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['day1']); ?>
日 ～ <?php echo smarty_modifier_t_escape($this->_tpl_vars['year2']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['month2']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['day2']); ?>
日<br><?php else: ?>
特定せず<br>
<?php endif; ?>
仮予約期間：
<?php if ($this->_tpl_vars['year3'] && $this->_tpl_vars['month3'] && $this->_tpl_vars['day3'] && $this->_tpl_vars['year4'] && $this->_tpl_vars['month4'] && $this->_tpl_vars['day4']): ?>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['year3']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['month3']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['day3']); ?>
日 ～ <?php echo smarty_modifier_t_escape($this->_tpl_vars['year4']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['month4']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['day4']); ?>
日<br><?php else: ?>
特定せず<br>
<?php endif; ?>
<br>
<div style='width:900px;overflow-x:scroll;'>
<table border=1 width=1600>
<tr>
<td>長期利用客</td>
<td>予約者</td>
<td>利用会場</td>
<td>利用人数</td>
<td>用途</td>
<td>過去利用回数</td>
<td>顧客ID</td>
<td>メールアドレス</td>
<td>電話</td>
<td>FAX</td>
<td>住所</td>
</tr>
<?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<tr>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['corp']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['name']); ?>
</td>
<td>
<?php $_from = $this->_tpl_vars['item']['reserve_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i']):
?>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['i']['hall_name']); ?>
<br>
<?php endforeach; endif; unset($_from); ?>
</td>
<td>
<?php $_from = $this->_tpl_vars['item']['reserve_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i']):
?>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['i']['people']); ?>
<br>
<?php endforeach; endif; unset($_from); ?>
</td>
<td>
<?php $_from = $this->_tpl_vars['item']['reserve_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i']):
?>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['i']['purpose']); ?>
<br>
<?php endforeach; endif; unset($_from); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['count']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_member_id']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['mail']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['tel']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['fax']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['address']); ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>
</div>
<?php else: ?>
対象のデータはありません。
<?php endif; ?>
<?php elseif ($this->_tpl_vars['menu'] == 'use_schedule_list'): ?>
<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output','page')); ?>
" />
<input type="hidden" name="menu" value="use_schedule_list">

<select name="hall_id" size=5 valign=top>
<option value="0" <?php if ($this->_tpl_vars['item']['hall_id'] == $this->_tpl_vars['hall_id']): ?>selected<?php endif; ?>>全会場</option>
<?php $_from = $this->_tpl_vars['hall_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_id']); ?>
" <?php if ($this->_tpl_vars['item']['hall_id'] == $this->_tpl_vars['hall_id']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>

<?php endforeach; endif; unset($_from); ?>
</select>

<input type="text" name="year" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']); ?>
" size=2 style="text-align:right;padding-right:5px;">日 ～ 
<input type="text" name="year2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year2']); ?>
" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month2']); ?>
" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day2']); ?>
" size=2 style="text-align:right;padding-right:5px;">日
<input type="submit" value="出力">
</form>
<br>
<hr>
<h3><?php echo smarty_modifier_t_escape($this->_tpl_vars['title']); ?>
</h3>
<br>
<?php if ($this->_tpl_vars['reserve_data']): ?>

対象日：<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']); ?>
日<br>
会場：<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_name']); ?>
<br>
<br>

<div style='width:900px;overflow-x:scroll;'>
<table border=1 width=1600>
<tr>
<td>利用日</td>
<td>会場名</td>
<td>部屋名</td>
<td>法人/団体名</td>
<td>利用者</td>
<td>顧客ID</td>
<td>用途</td>
<td>メール</td>
<td>電話</td>
<td>メッセージ</td>
<td>問題点</td>
</tr>
<?php $_from = $this->_tpl_vars['reserve_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<tr>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['begin_datetime']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_name']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['corp']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['name']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_member_id']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['purpose']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['mail']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['tel']); ?>
</td>
<td>
<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['message']))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('t_url2cmd', true, $_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id'])) : smarty_modifier_t_url2cmd($_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id']))))) ? $this->_run_mod_handler('t_cmd', true, $_tmp, 'diary') : smarty_modifier_t_cmd($_tmp, 'diary')))) ? $this->_run_mod_handler('t_decoration', true, $_tmp) : smarty_modifier_t_decoration($_tmp)); ?>

</td>
<td>
<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['report']['report']))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('t_url2cmd', true, $_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id'])) : smarty_modifier_t_url2cmd($_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id']))))) ? $this->_run_mod_handler('t_cmd', true, $_tmp, 'diary') : smarty_modifier_t_cmd($_tmp, 'diary')))) ? $this->_run_mod_handler('t_decoration', true, $_tmp) : smarty_modifier_t_decoration($_tmp)); ?>

</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>
</div>
<?php else: ?>
対象のデータはありません。
<?php endif; ?>

<?php elseif ($this->_tpl_vars['menu'] == 'payment_record'): ?>
<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output','page')); ?>
" />
<input type="hidden" name="menu" value="payment_record">

<select name="hall_id" size=5 valign=top>
<option value="0" <?php if ($this->_tpl_vars['item']['hall_id'] == $this->_tpl_vars['hall_id']): ?>selected<?php endif; ?>>全会場</option>
<?php $_from = $this->_tpl_vars['hall_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_id']); ?>
" <?php if ($this->_tpl_vars['item']['hall_id'] == $this->_tpl_vars['hall_id']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>

<?php endforeach; endif; unset($_from); ?>
</select>

<input type="text" name="year1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year1']); ?>
" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month1']); ?>
" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day1']); ?>
" size=2 style="text-align:right;padding-right:5px;">日 ～ 
<input type="text" name="year2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year2']); ?>
" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month2']); ?>
" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day2']); ?>
" size=2 style="text-align:right;padding-right:5px;">日
<input type="submit" value="出力">
</form>
<br>
<hr>
<h3><?php echo smarty_modifier_t_escape($this->_tpl_vars['title']); ?>
</h3>
<br>
<?php if ($this->_tpl_vars['reserve_data'] || $this->_tpl_vars['ab_data']): ?>

対象日：<?php echo smarty_modifier_t_escape($this->_tpl_vars['year1']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['month1']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['day1']); ?>
日 ～ <?php echo smarty_modifier_t_escape($this->_tpl_vars['year2']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['month2']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['day2']); ?>
日<br>
会場：<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_name']); ?>
<br>
<br>
(税込)
<table border=1>
<tr>
<td align=center>入金日</td>
<td align=center>利用日</td>
<td align=center>会場名</td>
<td align=center>口座番号</td>
<td align=center>入金額</td>
<td align=center>法人/団体名</td>
<td align=center>利用者</td>
<td align=center>予約ID</td>
<td align=center>請求総額</td>
<td align=center>利用内容</td>
</tr>
<?php $_from = $this->_tpl_vars['reserve_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<tr>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['date']); ?>
</td>
<td><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['begin_datetime']))) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y年%m月%d日") : smarty_modifier_date_format($_tmp, "%Y年%m月%d日")); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['virtual_code']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['pay_money']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['corp']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['name']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['total_price']); ?>
</td>
<td align=center>予約</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
<?php $_from = $this->_tpl_vars['ab_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<?php if ($this->_tpl_vars['hall_id'] == 0 || $this->_tpl_vars['hall_id'] == $this->_tpl_vars['item']['hall_id']): ?>
<tr>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['date']); ?>
</td>
<td></td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['virtual_code']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['pay_money']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['corp']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['name']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
</td>
<td align=center><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['total_price']); ?>
</td>
<td align=center>キャンセル</td>
</tr>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
</table>

<?php else: ?>
対象のデータはありません。
<?php endif; ?>

<?php elseif ($this->_tpl_vars['menu'] == 'repeat_customer_list'): ?>
<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output','page')); ?>
" />
<input type="hidden" name="menu" value="repeat_customer_list">

会場選択：
<select name="hall_id" size=5 valign=top>
<?php $_from = $this->_tpl_vars['hall_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_id']); ?>
" <?php if ($this->_tpl_vars['item']['hall_id'] == $this->_tpl_vars['hall_id']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>

<?php endforeach; endif; unset($_from); ?>
</select>
<br>
利用日期間：
<input type="text" name="year1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year1']); ?>
" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month1']); ?>
" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day1']); ?>
" size=2 style="text-align:right;padding-right:5px;">日 ～ 
<input type="text" name="year2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year2']); ?>
" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month2']); ?>
" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day2']); ?>
" size=2 style="text-align:right;padding-right:5px;">日
<input type="submit" value="出力">
</form>
<br>
<hr>
<h3><?php echo smarty_modifier_t_escape($this->_tpl_vars['title']); ?>
</h3>
<?php if ($this->_tpl_vars['list']): ?>

会場：<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_name']); ?>
<br>
利用日期間：
<?php if ($this->_tpl_vars['year1'] && $this->_tpl_vars['month1'] && $this->_tpl_vars['day1'] && $this->_tpl_vars['year2'] && $this->_tpl_vars['month2'] && $this->_tpl_vars['day2']): ?>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['year1']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['month1']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['day1']); ?>
日 ～ <?php echo smarty_modifier_t_escape($this->_tpl_vars['year2']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['month2']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['day2']); ?>
日<br><?php else: ?>
特定せず<br>
<?php endif; ?>

<br>
<div style='width:900px;overflow-x:scroll;'>
<table border=1 width=1600>
<tr>
<td align=center>リピート利用者</td>
<td align=center>予約者</td>
<td align=center>利用会場</td>
<td align=center>利用人数</td>
<td align=center>用途</td>
<td align=center>過去利用回数</td>
<td align=center>顧客ID</td>
<td align=center>メールアドレス</td>
<td align=center>電話</td>
<td align=center>FAX</td>
<td align=center>住所</td>
</tr>
<?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<tr>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['corp']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['name']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_name']); ?>
</td>
<td align=right>
<?php $_from = $this->_tpl_vars['item']['reserve_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i']):
?>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['i']['people']); ?>
<br>
<?php endforeach; endif; unset($_from); ?>
</td>
<td align=center>
<?php $_from = $this->_tpl_vars['item']['reserve_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i']):
?>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['i']['purpose']); ?>
<br>
<?php endforeach; endif; unset($_from); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['count']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_member_id']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['mail']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['tel']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['fax']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['address']); ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>
</div>
<?php else: ?>
対象のデータはありません。
<?php endif; ?>

<?php elseif ($this->_tpl_vars['menu'] == 'sales_report'): ?>
<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output','page')); ?>
" />
<input type="hidden" name="menu" value="sales_report">

<select name="hall_id" size=5 valign=top>
<option value="0" <?php if ($this->_tpl_vars['item']['hall_id'] == $this->_tpl_vars['hall_id']): ?>selected<?php endif; ?>>全会場</option>
<?php $_from = $this->_tpl_vars['hall_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_id']); ?>
" <?php if ($this->_tpl_vars['item']['hall_id'] == $this->_tpl_vars['hall_id']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>

<?php endforeach; endif; unset($_from); ?>
</select>

<input type="text" name="year1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year1']); ?>
" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month1']); ?>
" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day1']); ?>
" size=2 style="text-align:right;padding-right:5px;">日 ～ 
<input type="text" name="year2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year2']); ?>
" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month2']); ?>
" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day2']); ?>
" size=2 style="text-align:right;padding-right:5px;">日
<input type="submit" value="出力">
</form>
<br>
<hr>
<h3><?php echo smarty_modifier_t_escape($this->_tpl_vars['title']); ?>
</h3>
<br>

<?php if ($this->_tpl_vars['hall_id'] == 0 && $this->_tpl_vars['hall_data']): ?>
対象期間：<?php echo smarty_modifier_t_escape($this->_tpl_vars['year1']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['month1']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['day1']); ?>
日 ～ <?php echo smarty_modifier_t_escape($this->_tpl_vars['year2']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['month2']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['day2']); ?>
日<br>
会場：全会場<br>
<br>
利用料(税込) ※キャンセル料含む<br>
<table border=1>
<tr>
<td>会場名</td>
<td>利用済　全額</td>
<td>利用済　入金済</td>
<td>利用済　未入金</td>
<td>以前利用の入金額</td>
<td>当社収益配分</td>
<td>売上（利用ベース）</td>
<td>売上（入金ベース）</td>
</tr>
<?php $_from = $this->_tpl_vars['hall_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<tr>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['all_room_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['all_room_price_paid']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['all_room_price_unpayment']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['room_use_before']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['ao_room']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['room_sales_use_base']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['room_sales_paid_base']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
<tr>
<td>合計</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_room_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_room_price_paid']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_room_price_unpayment']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_room_use_before']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right></td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_room_sales_use']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_room_sales_paid']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
</tr>
</table>
<br>
OP料金（備品のみ）（税込）  ※キャンセル料無し
<table border=1>
<tr>
<td>会場名</td>
<td>利用済　全額</td>
<td>利用済　入金済</td>
<td>利用済　未入金</td>
<td>以前利用の入金額</td>
<td>当社収益配分</td>
<td>売上（利用ベース）</td>
<td>売上（入金ベース）</td>
</tr>
<?php $_from = $this->_tpl_vars['hall_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<tr>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['all_vessel_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['all_vessel_price_paid']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['all_vessel_price_unpayment']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['vessel_use_before']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['ao_vessel']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['vessel_sales_use_base']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['vessel_sales_paid_base']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
<tr>
<td>合計</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_vessel_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_vessel_price_paid']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_vessel_price_unpayment']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_vessel_use_before']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right></td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_vessel_sales_use']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_vessel_sales_paid']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
</tr>
</table>
<br>
サービス料金（備品含まず）（税込）  ※キャンセル料無し
<table border=1>
<tr>
<td>会場名</td>
<td>利用済　全額</td>
<td>利用済　入金済</td>
<td>利用済　未入金</td>
<td>以前利用の入金額</td>
<td>当社収益配分</td>
<td>売上（利用ベース）</td>
<td>売上（入金ベース）</td>
</tr>
<?php $_from = $this->_tpl_vars['hall_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<tr>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['all_service_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['all_service_price_paid']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['all_service_price_unpayment']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['service_use_before']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['ao_service']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['service_sales_use_base']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['service_sales_paid_base']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
<tr>
<td>合計</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_service_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_service_price_paid']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_service_price_unpayment']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_service_use_before']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right></td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_service_sales_use']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_service_sales_paid']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
</tr>
</table>

<?php elseif ($this->_tpl_vars['hall_id'] > 0 && $this->_tpl_vars['hall_data']): ?>
対象期間：<?php echo smarty_modifier_t_escape($this->_tpl_vars['year1']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['month1']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['day1']); ?>
日 ～ <?php echo smarty_modifier_t_escape($this->_tpl_vars['year2']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['month2']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['day2']); ?>
日<br>
会場：<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_name']); ?>
<br>
<br>
<table border=1>
<tr>
<td>利用料当社収益配分</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_data']['ao_room']); ?>
%</td>
</tr>
<tr>
<td>OP料当社収益配分</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_data']['ao_vessel']); ?>
%</td>
</tr>
</table>
<br>
（税込）<br>
<table border=1>
<tr>
<td>利用料　合計</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_room_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
</tr>
<tr>
<td>利用売上（利用ベース）</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_room_sales_use']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
</tr>
<tr>
<td>利用売上（入金ベース）</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_room_sales_paid']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
</tr>
<tr>
<td>OP備品料　合計</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_vessel_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
</tr>
<tr>
<td>OP売上（利用ベース）</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_vessel_sales_use']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
</tr>
<tr>
<td>OP売上（入金ベース）</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_vessel_sales_paid']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
</tr>
<tr>
<td>利用＋OP総額</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
</tr>
<tr>
<td>利用＋OP売上（利用ベース）</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_sales_use']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
</tr>
<tr>
<td>利用＋OP売上（入金ベース）</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_sales_paid']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
</tr>

</table>
<br>
サービス料<br>
<table border=1>
<tr>
<td>サービス利用料（利用ベース）</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_service_price_paid']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
</tr>
<tr>
<td>サービス利用料（入金ベース）</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_service_sales_paid']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
</tr>
</table>
<br>
<br>
<span style="font-size: 20px;color: #3333FF;"><b>部屋利用料</b></span><br>
<table border=1>
<tr>
<td>利用日</td>
<td>予約番号</td>
<td>部屋</td>
<td>利用時間</td>
<td>部屋利用料</td>
<td>入金額(部屋)</td>
<td>未入金（利用+OP+サ総額）</td>
<td>キャンセル料</td>
</tr>
<?php $_from = $this->_tpl_vars['reserve_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<?php if ($this->_tpl_vars['item']['date'] != ''): ?>
	<tr>
	<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['date']); ?>
</td>
	<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
</td>
	<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_name']); ?>
</td>
	<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['time']); ?>
</td>
	<td align=right>
	<?php if ($this->_tpl_vars['item']['cancel_flag'] == 0): ?>
		<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['room_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

		<?php else: ?>
	0
	<?php endif; ?>
	</td>
	<td align=right>
	<?php if ($this->_tpl_vars['item']['unpayment_flag'] == 1): ?>
	※
	<?php else: ?>
	<?php if ($this->_tpl_vars['item']['cancel_flag'] == 0): ?>
		<?php if ($this->_tpl_vars['item']['pay_money'] > 0): ?>
			<?php if ($this->_tpl_vars['item']['pay_flag'] == 0): ?>
				0
			<?php else: ?>
				<?php if ($this->_tpl_vars['item']['room_price'] > $this->_tpl_vars['item']['pay_money']): ?>
				<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['pay_money']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

				<?php else: ?>
				<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['room_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

				<?php endif; ?>
			<?php endif; ?>
		<?php else: ?>
		0
		<?php endif; ?>
	<?php else: ?>
		<?php if ($this->_tpl_vars['item']['ab_data']['pay_money'] > 0): ?>
			<?php if ($this->_tpl_vars['item']['ab_data']['flag'] == 0): ?>
				0
			<?php else: ?>
			    <?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['ab_data']['pay_money']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

			<?php endif; ?>	
		<?php else: ?>
		0
		<?php endif; ?>
	
	<?php endif; ?>
	<?php endif; ?>
	</td>
	<td align=right>
	<?php if ($this->_tpl_vars['item']['unpayment'] > 0): ?>
		<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['unpayment']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

		<?php if ($this->_tpl_vars['item']['unpayment_flag'] == 1): ?>
			(一部)
		<?php endif; ?>
	<?php else: ?>
	0
	<?php endif; ?>
	</td>
	<td align=right>
	<?php if ($this->_tpl_vars['item']['cancel_flag'] == 1): ?>
		<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['cancel']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

	<?php else: ?>
	0
	<?php endif; ?>
	</td>
	</tr>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<tr>
<td>合計</td>
<td></td>
<td></td>
<td></td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_room_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_room_price_paid']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_unpayment_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_cancel_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
</tr>

</table>
<br>
<span style="font-size: 16px;color: #FF3333;"><b>部屋利用料未入金(当月利用)</b></span><br>
<table border=1>
<tr>
<td>利用日</td>
<td>予約番号</td>
<td>部屋</td>
<td>利用時間</td>
<td>部屋利用料</td>
<td>入金額(部屋)</td>
<td>未入金（利用+OP+サ総額）</td>
<td>キャンセル料</td>

</tr>
<?php $_from = $this->_tpl_vars['reserve_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<?php if ($this->_tpl_vars['item']['unpayment'] > 0): ?>
<tr>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['date']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_name']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['time']); ?>
</td>
<td align=right>

<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['room_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>


</td>
<td align=right>
<?php if ($this->_tpl_vars['item']['unpayment_flag'] == 1): ?>
※
<?php else: ?>
<?php if ($this->_tpl_vars['item']['pay_flag'] == 0): ?>
	<?php if ($this->_tpl_vars['item']['pay_money'] > 0): ?>
		<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['pay_money']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

	<?php else: ?>
	0
	<?php endif; ?>
<?php elseif ($this->_tpl_vars['item']['ab_data']['pay_money']): ?>
	<?php if ($this->_tpl_vars['item']['ab_data']['pay_money'] > 0): ?>
		<?php if ($this->_tpl_vars['item']['ab_data']['flag'] == 0): ?>
			0
		<?php else: ?>
			<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['ab_data']['pay_money']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

		<?php endif; ?>	
	<?php else: ?>
	0
	<?php endif; ?>
<?php else: ?>
0
<?php endif; ?>
<?php endif; ?>
</td>
<td align=right>
<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['unpayment']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

<?php if ($this->_tpl_vars['item']['unpayment_flag'] == 1): ?>
	(一部)
<?php endif; ?>
</td>
<td align=right>
<?php if ($this->_tpl_vars['item']['cancel_flag'] == 1): ?>
<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['cancel']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

<?php else: ?>
0
<?php endif; ?>
</td>
</tr>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<tr>
<td>合計</td>
<td></td>
<td></td>
<td></td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_price_unpaid']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right></td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_unpayment_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_cancel_price_unpayment']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
</tr>

</table>

<br>
<span style="font-size: 16px;color: #FF3333;"><b>部屋利用料入金（以前利用分）</b></span><br>
<table border=1>
<tr>
<td>利用日</td>
<td>予約番号</td>
<td>部屋</td>
<td>利用時間</td>
<td>部屋利用料</td>
<td>入金額(部屋)</td>
<td>未入金（利用+OP+サ総額）</td>
<td>キャンセル料</td>
</tr>
<?php $_from = $this->_tpl_vars['before_paid_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<tr>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['date']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_name']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['time']); ?>
</td>
<td align=right>
<?php if ($this->_tpl_vars['item']['cancel_flag'] == 0): ?>
	<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['room_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

<?php else: ?>
0
<?php endif; ?>
</td>
<td align=right>
<?php if ($this->_tpl_vars['item']['cancel_flag'] == 0): ?>
	<?php if ($this->_tpl_vars['item']['pay_money'] > 0): ?>
		<?php if ($this->_tpl_vars['item']['pay_flag'] == 0): ?>
			※
		<?php else: ?>
			<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['room_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

		<?php endif; ?>
	<?php else: ?>
	0
	<?php endif; ?>
<?php elseif ($this->_tpl_vars['item']['ab_data']['pay_money']): ?>
	<?php if ($this->_tpl_vars['item']['ab_data']['pay_money'] > 0): ?>
		<?php if ($this->_tpl_vars['item']['ab_data']['flag'] == 0): ?>
			※
		<?php endif; ?>
		<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['ab_data']['pay_money']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

	<?php else: ?>
	0
	<?php endif; ?>
<?php else: ?>
0
<?php endif; ?>
</td>
<td align=right>
0
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
<?php $_from = $this->_tpl_vars['before_paid_data2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<tr>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['date']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_name']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['time']); ?>
</td>
<td align=right>
<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['cancel_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

</td>
<td align=right>
<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['cancel_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

</td>
<td align=right>
0
</td>
<td>
<?php if ($this->_tpl_vars['item']['cancel_flag'] == 1): ?>
<?php if ($this->_tpl_vars['item']['ab_data']['total_billed_money']): ?>
	<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['ab_data']['total_billed_money']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

<?php else: ?>
0
<?php endif; ?>
<?php else: ?>
0
<?php endif; ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
<tr>
<td>合計</td>
<td></td>
<td></td>
<td></td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_room_use_before']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_room_use_before']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right>0</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_cancel_before']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
</tr>

</table>

<br>
<span style="font-size: 16px;color: #FF3333;"><b>未入金（以前利用分）</b></span><br>
<table border=1>
<tr>
<td>利用日</td>
<td>予約番号</td>
<td>部屋</td>
<td>利用時間</td>
<td>部屋利用料</td>
<td>入金額(部屋)</td>
<td>未入金（利用+OP+サ総額）</td>
<td>キャンセル料</td>
</tr>
<?php $_from = $this->_tpl_vars['before_unpayment_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<tr>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['date']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_name']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['time']); ?>
</td>
<td align=right>
<?php if ($this->_tpl_vars['item']['cancel_flag'] == 0): ?>
	<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['room_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

<?php else: ?>
0
<?php endif; ?>
</td>
<td align=right>
<?php if ($this->_tpl_vars['item']['cancel_flag'] == 0): ?>
	<?php if ($this->_tpl_vars['item']['pay_money'] > 0): ?>
		<?php if ($this->_tpl_vars['item']['pay_flag'] == 0): ?>
			※
		<?php else: ?>
			<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['room_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

		<?php endif; ?>
	<?php else: ?>
	0
	<?php endif; ?>
<?php elseif ($this->_tpl_vars['item']['ab_data']['pay_money']): ?>
	<?php if ($this->_tpl_vars['item']['ab_data']['pay_money'] > 0): ?>
		<?php if ($this->_tpl_vars['item']['ab_data']['flag'] == 0): ?>
			※
		<?php endif; ?>
		<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['ab_data']['pay_money']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

	<?php else: ?>
	0
	<?php endif; ?>
<?php else: ?>
0
<?php endif; ?>
</td>
<td align=right>
<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['unpayment_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

</td>
<td>
<?php if ($this->_tpl_vars['item']['cancel_flag'] == 1): ?>
<?php if ($this->_tpl_vars['item']['ab_data']['total_billed_money']): ?>
	<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['ab_data']['total_billed_money']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

<?php else: ?>
0
<?php endif; ?>
<?php else: ?>
0
<?php endif; ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
<?php $_from = $this->_tpl_vars['before_unpayment_data2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<tr>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['date']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_name']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['time']); ?>
</td>
<td align=right>
0
</td>
<td align=right>
<?php if ($this->_tpl_vars['item']['pay_money'] > 0): ?>
※
<?php else: ?>
0
<?php endif; ?>
</td>
<td align=right>
<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['unpayment_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

</td>
<td>
<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['cancel_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
<tr>
<td>合計</td>
<td></td>
<td></td>
<td></td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_room_use_before_unpayment']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right></td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_before_unpayment_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_cancel_before_unpayment']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
</tr>

</table>

<br>
<br>
<span style="font-size: 20px;color: #3333FF;"><b>OP利用料</b></span><br>
<table border=1>
<tr>
<td>利用日</td>
<td>予約番号</td>
<td>部屋</td>
<td>利用時間</td>
<td>OP利用料</td>
<td>入金額(OP)</td>
<td>未入金（利用+OP+サ総額）</td>
<td>備考</td>
</tr>
<?php $_from = $this->_tpl_vars['reserve_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<?php if ($this->_tpl_vars['item']['vessel_price']): ?>
<tr>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['date']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_name']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['time']); ?>
</td>
<td align=right>
<?php if ($this->_tpl_vars['item']['cancel_flag'] == 0): ?>
<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['vessel_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

<?php else: ?>
0
<?php endif; ?>
</td>
<td align=right>
 <?php if ($this->_tpl_vars['item']['unpayment_flag'] == 1): ?>
 ※
 <?php else: ?>
    <?php if ($this->_tpl_vars['item']['cancel_flag'] == 0): ?>
            <?php if ($this->_tpl_vars['item']['pay_money'] > 0): ?>
                    <?php if ($this->_tpl_vars['item']['pay_flag'] == 0): ?>
                            ※
                    <?php else: ?>
                            <?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['vessel_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

                    <?php endif; ?>
            <?php else: ?>
            0
            <?php endif; ?>
    <?php else: ?>
	   0
           
    <?php endif; ?>
	
	
  <?php endif; ?>  
</td>
<td align=right>
<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['unpayment']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

<?php if ($this->_tpl_vars['item']['unpayment_flag'] == 1): ?>
	(一部)
<?php endif; ?>
</td>
<td>
<?php if ($this->_tpl_vars['item']['cancel_flag'] == 1): ?>
キャンセル
<?php endif; ?>
</td>
</tr>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<tr>
<td>合計</td>
<td></td>
<td></td>
<td></td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_vessel_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_vessel_price_paid']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_unpayment_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right></td>
</tr>
</table>
<br>
<span style="font-size: 16px;color: #FF3333;"><b>OP利用済未入金</b></span><br>
<table border=1>
<tr>
<td>利用日</td>
<td>予約番号</td>
<td>部屋</td>
<td>利用時間</td>
<td>OP利用料</td>
<td>入金額(OP)</td>
<td>未入金（利用+OP+サ総額）</td>

</tr>
<?php $_from = $this->_tpl_vars['reserve_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<?php if ($this->_tpl_vars['item']['vessel_price']): ?>
<?php if ($this->_tpl_vars['item']['unpayment'] > 0): ?>
<tr>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['date']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_name']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['time']); ?>
</td>
<td align=right>
<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['vessel_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

</td>
<td align=right>
<?php if ($this->_tpl_vars['item']['unpayment_flag'] == 1): ?>
※
<?php else: ?>
    <?php if ($this->_tpl_vars['item']['cancel_flag'] == 0): ?>
            <?php if ($this->_tpl_vars['item']['pay_money'] > 0): ?>
                    <?php if ($this->_tpl_vars['item']['pay_flag'] == 0): ?>
                            ※
                    <?php else: ?>
                            <?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['vessel_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

                    <?php endif; ?>
            <?php else: ?>
            0
            <?php endif; ?>
   
    <?php else: ?>
		<?php if ($this->_tpl_vars['item']['pay_flag'] == 0): ?>
			0
		<?php else: ?>
				<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['vessel_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

		<?php endif; ?>
    <?php endif; ?>
<?php endif; ?>    
</td>
<td align=right>
<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['unpayment']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

<?php if ($this->_tpl_vars['item']['unpayment_flag'] == 1): ?>
	(一部)
<?php endif; ?>
</td>
</tr>
<?php endif; ?>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<tr>
<td>合計</td>
<td></td>
<td></td>
<td></td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_versel_unpaid']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right></td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_unpayment_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
</tr>

</table>

<br>
<span style="font-size: 16px;color: #FF3333;"><b>OP利用料入金（以前利用分）</b></span><br>
<table border=1>
<tr>
<td>利用日</td>
<td>予約番号</td>
<td>部屋</td>
<td>利用時間</td>
<td>OP利用料</td>
<td>入金額(OP)</td>
<td>未入金（利用+OP+サ総額）</td>
</tr>
<?php $_from = $this->_tpl_vars['before_paid_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<?php if ($this->_tpl_vars['item']['vessel_price']): ?>
<tr>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['date']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_name']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['time']); ?>
</td>
<td align=right>
<?php if ($this->_tpl_vars['item']['cancel_flag'] == 0): ?>
	<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['vessel_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

<?php elseif ($this->_tpl_vars['item']['ab_data']['total_billed_money']): ?>
	<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['ab_data']['total_billed_money']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

<?php else: ?>
<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['vessel_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

<?php endif; ?>
</td>
<td align=right>
<?php if ($this->_tpl_vars['item']['cancel_flag'] == 0): ?>
	<?php if ($this->_tpl_vars['item']['pay_money'] > 0): ?>
		<?php if ($this->_tpl_vars['item']['pay_flag'] == 0): ?>
			※
		<?php else: ?>
			<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['vessel_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

		<?php endif; ?>
	<?php else: ?>
	0
	<?php endif; ?>
<?php elseif ($this->_tpl_vars['item']['ab_data']['pay_money']): ?>
	<?php if ($this->_tpl_vars['item']['ab_data']['pay_money'] > 0): ?>
		<?php if ($this->_tpl_vars['item']['ab_data']['flag'] == 0): ?>
			※
		<?php endif; ?>
		<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['ab_data']['pay_money']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

	<?php else: ?>
	0
	<?php endif; ?>
<?php else: ?>
<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['vessel_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

<?php endif; ?>
</td>
<td align=right>
0
</td>
</tr>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<tr>
<td>合計</td>
<td></td>
<td></td>
<td></td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_vessel_use_before']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_vessel_use_before']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right>0</td>
</tr>

</table>

<br>
<span style="font-size: 16px;color: #FF3333;"><b>OP未入金（以前利用分）</b></span><br>
<table border=1>
<tr>
<td>利用日</td>
<td>予約番号</td>
<td>部屋</td>
<td>利用時間</td>
<td>OP利用料</td>
<td>入金額(OP)</td>
<td>未入金（利用+OP+サ総額）</td>
</tr>
<?php $_from = $this->_tpl_vars['before_unpayment_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<?php if ($this->_tpl_vars['item']['vessel_price']): ?>
<tr>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['date']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_name']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['time']); ?>
</td>
<td align=right>
<?php if ($this->_tpl_vars['item']['cancel_flag'] == 0): ?>
	<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['vessel_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

<?php elseif ($this->_tpl_vars['item']['ab_data']['total_billed_money']): ?>
	<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['ab_data']['total_billed_money']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

<?php else: ?>
<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['vessel_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

<?php endif; ?>
</td>
<td align=right>
<?php if ($this->_tpl_vars['item']['cancel_flag'] == 0): ?>
	<?php if ($this->_tpl_vars['item']['pay_money'] > 0): ?>
		<?php if ($this->_tpl_vars['item']['pay_flag'] == 0): ?>
			※
		<?php else: ?>
			<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['vessel_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

		<?php endif; ?>
	<?php else: ?>
	0
	<?php endif; ?>
<?php elseif ($this->_tpl_vars['item']['ab_data']['pay_money']): ?>
	<?php if ($this->_tpl_vars['item']['ab_data']['pay_money'] > 0): ?>
		<?php if ($this->_tpl_vars['item']['ab_data']['flag'] == 0): ?>
			※
		<?php endif; ?>
		<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['ab_data']['pay_money']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

	<?php else: ?>
	0
	<?php endif; ?>
<?php else: ?>
<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['vessel_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

<?php endif; ?>
</td>
<td align=right>
<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['unpayment_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

</td>
</tr>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<tr>
<td>合計</td>
<td></td>
<td></td>
<td></td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_vessel_use_before_unpayment']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right></td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_before_vessel_unpayment_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
</tr>

</table>

<br>
<br>

<span style="font-size: 20px;color: #3333FF;"><b>サービス利用料</b></span><br>
<table border=1>
<tr>
<td>利用日</td>
<td>予約番号</td>
<td>部屋</td>
<td>利用時間</td>
<td>サービス利用料</td>
<td>入金額(サービス)</td>
<td>未入金（利用+OP+サ総額）</td>
<td>&nbsp;</td>
</tr>
<?php $_from = $this->_tpl_vars['reserve_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<?php if ($this->_tpl_vars['item']['service_price']): ?>
<tr>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['date']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_name']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['time']); ?>
</td>
<td align=right>
<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['service_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

</td>
<td align=right>
<?php if ($this->_tpl_vars['item']['cancel_flag'] == 0): ?>
	<?php if ($this->_tpl_vars['item']['pay_money'] > 0): ?>
		<?php if ($this->_tpl_vars['item']['pay_flag'] == 0): ?>
			※
		<?php else: ?>
			<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['service_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

		<?php endif; ?>
	<?php else: ?>
	0
	<?php endif; ?>
<?php else: ?>
<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['service_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

<?php endif; ?>
</td>
<td align=right>
<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['unpayment']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

<?php if ($this->_tpl_vars['item']['unpayment_flag'] == 1): ?>
	(一部)
<?php endif; ?>
</td>
<td>
<?php if ($this->_tpl_vars['item']['list_service']): ?>
<?php $_from = $this->_tpl_vars['item']['list_service']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['service']):
?>
	<?php echo smarty_modifier_t_escape($this->_tpl_vars['service']['service_name']); ?>
:<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['service']['price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
(x<?php echo smarty_modifier_t_escape($this->_tpl_vars['service']['num']); ?>
)<br/>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
</td>
</tr>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<tr>
<td>合計</td>
<td></td>
<td></td>
<td></td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_service_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_service_price_paid']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_unpayment_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
</tr>
</table>
<br>
<span style="font-size: 16px;color: #FF3333;"><b>サービス利用済未入金</b></span><br>
<table border=1>
<tr>
<td>利用日</td>
<td>予約番号</td>
<td>部屋</td>
<td>利用時間</td>
<td>サービス利用料</td>
<td>入金額(サービス)</td>
<td>未入金（利用+OP+サ総額）</td>

</tr>
<?php $_from = $this->_tpl_vars['reserve_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<?php if ($this->_tpl_vars['item']['service_price']): ?>
<?php if ($this->_tpl_vars['item']['unpayment'] > 0): ?>
<tr>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['date']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_name']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['time']); ?>
</td>
<td align=right>
<?php if ($this->_tpl_vars['item']['cancel_flag'] == 0): ?>
	<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['service_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

<?php elseif ($this->_tpl_vars['item']['ab_data']['total_billed_money']): ?>
	<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['ab_data']['total_billed_money']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

<?php else: ?>
<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['service_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

<?php endif; ?>
</td>
<td align=right>
<?php if ($this->_tpl_vars['item']['cancel_flag'] == 0): ?>
	<?php if ($this->_tpl_vars['item']['pay_money'] > 0): ?>
		<?php if ($this->_tpl_vars['item']['pay_flag'] == 0): ?>
			※
		<?php else: ?>
			<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['service_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

		<?php endif; ?>
	<?php else: ?>
	0
	<?php endif; ?>
<?php elseif ($this->_tpl_vars['item']['ab_data']['pay_money']): ?>
	<?php if ($this->_tpl_vars['item']['ab_data']['pay_money'] > 0): ?>
		<?php if ($this->_tpl_vars['item']['ab_data']['flag'] == 0): ?>
			※
		<?php endif; ?>
		<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['ab_data']['pay_money']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

	<?php else: ?>
	0
	<?php endif; ?>
<?php else: ?>
<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['service_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

<?php endif; ?>
</td>
<td align=right>
<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['unpayment']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

<?php if ($this->_tpl_vars['item']['unpayment_flag'] == 1): ?>
	(一部)
<?php endif; ?>
</td>
</tr>
<?php endif; ?>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<tr>
<td>合計</td>
<td></td>
<td></td>
<td></td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_service_price_unpayment']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right></td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_unpayment_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
</tr>

</table>

<br>
<span style="font-size: 16px;color: #FF3333;"><b>サービス利用料入金（以前利用分）</b></span><br>
<table border=1>
<tr>
<td>利用日</td>
<td>予約番号</td>
<td>部屋</td>
<td>利用時間</td>
<td>サービス利用料</td>
<td>入金額(サービス)</td>
<td>未入金（利用+OP+サ総額）</td>
<td>&nbsp;</td>
</tr>
<?php $_from = $this->_tpl_vars['before_paid_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<?php if ($this->_tpl_vars['item']['service_price']): ?>
<tr>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['date']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_name']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['time']); ?>
</td>
<td align=right>
<?php if ($this->_tpl_vars['item']['cancel_flag'] == 0): ?>
	<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['service_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

<?php elseif ($this->_tpl_vars['item']['ab_data']['total_billed_money']): ?>
	<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['ab_data']['total_billed_money']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

<?php else: ?>
<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['service_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

<?php endif; ?>
</td>
<td align=right>
<?php if ($this->_tpl_vars['item']['cancel_flag'] == 0): ?>
	<?php if ($this->_tpl_vars['item']['pay_money'] > 0): ?>
		<?php if ($this->_tpl_vars['item']['pay_flag'] == 0): ?>
			※
		<?php else: ?>
			<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['service_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

		<?php endif; ?>
	<?php else: ?>
	0
	<?php endif; ?>
<?php elseif ($this->_tpl_vars['item']['ab_data']['pay_money']): ?>
	<?php if ($this->_tpl_vars['item']['ab_data']['pay_money'] > 0): ?>
		<?php if ($this->_tpl_vars['item']['ab_data']['flag'] == 0): ?>
			※
		<?php endif; ?>
		<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['ab_data']['pay_money']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

	<?php else: ?>
	0
	<?php endif; ?>
<?php else: ?>
<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['service_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

<?php endif; ?>
</td>
<td align=right>
0
</td>
<td>
<?php if ($this->_tpl_vars['item']['list_service']): ?>
<?php $_from = $this->_tpl_vars['item']['list_service']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['service']):
?>
	<?php echo smarty_modifier_t_escape($this->_tpl_vars['service']['service_name']); ?>
:<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['service']['price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
(x<?php echo smarty_modifier_t_escape($this->_tpl_vars['service']['num']); ?>
)<br/>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
</td>
</tr>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<tr>
<td>合計</td>
<td></td>
<td></td>
<td></td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_service_use_before']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_service_use_before']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right>0</td>
</tr>

</table>

<br>
<span style="font-size: 16px;color: #FF3333;"><b>サービス未入金（以前利用分）</b></span><br>
<table border=1>
<tr>
<td>利用日</td>
<td>予約番号</td>
<td>部屋</td>
<td>利用時間</td>
<td>サービス利用料</td>
<td>入金額(サービス)</td>
<td>未入金（利用+OP+サ総額）</td>
</tr>
<?php $_from = $this->_tpl_vars['before_unpayment_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<?php if ($this->_tpl_vars['item']['service_price']): ?>
<tr>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['date']); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_name']); ?>
</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['time']); ?>
</td>
<td align=right>
<?php if ($this->_tpl_vars['item']['cancel_flag'] == 0): ?>
	<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['service_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

<?php elseif ($this->_tpl_vars['item']['ab_data']['total_billed_money']): ?>
	<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['ab_data']['total_billed_money']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

<?php else: ?>
<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['service_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

<?php endif; ?>
</td>
<td align=right>
<?php if ($this->_tpl_vars['item']['cancel_flag'] == 0): ?>
	<?php if ($this->_tpl_vars['item']['pay_money'] > 0): ?>
		<?php if ($this->_tpl_vars['item']['pay_flag'] == 0): ?>
			※
		<?php else: ?>
			<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['service_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

		<?php endif; ?>
	<?php else: ?>
	0
	<?php endif; ?>
<?php elseif ($this->_tpl_vars['item']['ab_data']['pay_money']): ?>
	<?php if ($this->_tpl_vars['item']['ab_data']['pay_money'] > 0): ?>
		<?php if ($this->_tpl_vars['item']['ab_data']['flag'] == 0): ?>
			※
		<?php endif; ?>
		<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['ab_data']['pay_money']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

	<?php else: ?>
	0
	<?php endif; ?>
<?php else: ?>
<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['service_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

<?php endif; ?>
</td>
<td align=right>
<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['unpayment_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>

</td>
</tr>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<tr>
<td>合計</td>
<td></td>
<td></td>
<td></td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_service_use_before_unpayment']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right></td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['total_before_vessel_unpayment_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
</tr>

</table>

<br>
<br>


<?php endif; ?>

<?php elseif ($this->_tpl_vars['menu'] == 'management_analysis'): ?>
<form name="search" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('slip_output','page')); ?>
" />
<input type="hidden" name="menu" value="management_analysis">

<select name="hall_id" size=5 valign=top>
<?php $_from = $this->_tpl_vars['hall_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_id']); ?>
" <?php if ($this->_tpl_vars['item']['hall_id'] == $this->_tpl_vars['hall_id']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>

<?php endforeach; endif; unset($_from); ?>
</select>

<input type="text" name="year1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year1']); ?>
" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month1']); ?>
" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day1" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day1']); ?>
" size=2 style="text-align:right;padding-right:5px;">日 ～ 
<input type="text" name="year2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['year2']); ?>
" size=8 style="text-align:right;padding-right:5px;">年
<input type="text" name="month2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['month2']); ?>
" size=2 style="text-align:right;padding-right:5px;">月
<input type="text" name="day2" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['day2']); ?>
" size=2 style="text-align:right;padding-right:5px;">日
<input type="submit" value="出力">
</form>
<br>
<hr>
<h3><?php echo smarty_modifier_t_escape($this->_tpl_vars['title']); ?>
</h3>
<br>

<?php if ($this->_tpl_vars['room_data']): ?>
会場：<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_name']); ?>
<br>
対象期間：<?php echo smarty_modifier_t_escape($this->_tpl_vars['year1']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['month1']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['day1']); ?>
日 ～ <?php echo smarty_modifier_t_escape($this->_tpl_vars['year2']); ?>
年<?php echo smarty_modifier_t_escape($this->_tpl_vars['month2']); ?>
月<?php echo smarty_modifier_t_escape($this->_tpl_vars['day2']); ?>
日<br>
<br>
（税抜き）(四捨五入計算)
<div style='width:900px;overflow-x:scroll;'>
<table border=1 width=2500>
<tr>
<th>会場名</th>
<th>部屋名</th>
<th>予約件数</th>
<th>予約金額利用</th>
<th>予約OP含む</th>
<th>予約OP含・昨年同期差額</th>
<th>予約OP含・昨年同期比</th>
<th>利用金額</th>
<th>利用OP含む</th>
<th>利用OP含・昨年同期差額</th>
<th>利用OP含・昨年同期比</th>
<th>未入金事故</th>
<th>金額稼働率OP除く</th>
<th>金額稼働率・昨年同期差</th>
<th>時間稼働率</th>
<th>リピート率</th>
<th>リピート率・昨年同期差</th>
<th>会場の累計利用数</th>
<th>累計来場者数</th>
</tr>
<tr>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_name']); ?>
</td>
<td>全体</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['hall_data']['reserve_count']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['hall_data']['total_room_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['hall_data']['total_rv_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['hall_data']['total_rv_last_year']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td></td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['hall_data']['total_use_room_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['hall_data']['total_use_rv_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['hall_data']['total_use_rv_last_year']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td></td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['hall_data']['accident']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_data']['room_price_rate']); ?>
%</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['hall_data']['room_rate_difference']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_data']['time_rate']); ?>
%</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_data']['rate']); ?>
%</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['hall_data']['rate_difference']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['hall_data']['all_reserved']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['hall_data']['total_people']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
</tr>
<?php $_from = $this->_tpl_vars['room_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<tr>
<td></td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_name']); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_count']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['total_room_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['total_rv_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['total_rv_last_year']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td></td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['total_use_room_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['total_use_rv_price']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['total_use_rv_last_year']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td></td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['accident']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_price_rate']); ?>
%</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['room_rate_difference']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['time_rate']); ?>
%</td>
<td align=right>--</td>
<td align=right>--</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['all_reserved']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
<td align=right><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['total_people']))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>
</div>
<?php endif; ?>

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

<script type="text/javascript">
	function paginate(page)
	{
		$("#page_num").val(page);
		$("#rental_form").submit();
	}
</script>