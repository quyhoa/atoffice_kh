<?php /* Smarty version 2.6.18, created on 2016-03-09 11:52:23
         compiled from file:/var/www/atoffice/webapp/modules/admin/templates/reserve_revision.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/atoffice/webapp/modules/admin/templates/reserve_revision.tpl', 2, false),array('modifier', 't_escape', 'file:/var/www/atoffice/webapp/modules/admin/templates/reserve_revision.tpl', 31, false),array('modifier', 'nl2br', 'file:/var/www/atoffice/webapp/modules/admin/templates/reserve_revision.tpl', 179, false),array('modifier', 't_url2cmd', 'file:/var/www/atoffice/webapp/modules/admin/templates/reserve_revision.tpl', 179, false),array('modifier', 't_cmd', 'file:/var/www/atoffice/webapp/modules/admin/templates/reserve_revision.tpl', 179, false),array('modifier', 't_decoration', 'file:/var/www/atoffice/webapp/modules/admin/templates/reserve_revision.tpl', 179, false),array('modifier', 'default', 'file:/var/www/atoffice/webapp/modules/admin/templates/reserve_revision.tpl', 638, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminSiteMember.tpl"), $this);?>

<?php $this->assign('page_name', "予約修正"); ?>
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

　<a href="./?m=admin&a=page_vessel_revision&reserve_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['reserve_id']); ?>
">備品修正</a>｜<a href="./?m=admin&a=page_service_revision&reserve_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['reserve_id']); ?>
">サービス修正</a>｜
<br>
<br>
<h2 id="ttl01">予約修正</h2>
<br>
<center>
<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><br><br><?php endif; ?>

<br><br>

<?php $_from = $this->_tpl_vars['log']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>

<table border=1 width=700>
<tr>
<th colspan=4 bgcolor=#CCCCFF>変更ログ<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']+1); ?>
 （予約ID：<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_id']); ?>
）<br>(変更日：<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['change_datetime']); ?>
 変更者：<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['staff_name']); ?>
)</th>
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
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['hall_name']); ?>
</td>
<td width=100 bgcolor=#DEDEDE>部屋名</td>
<td>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_name']); ?>

</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>利用開始日時</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['begin_datetime']); ?>
</td>
<td width=100 bgcolor=#DEDEDE>利用終了日時</td>
<td>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['finish_datetime']); ?>

</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>仮予約日</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['tmp_reserve_datetime']); ?>
</td>
<td width=100 bgcolor=#DEDEDE>予約承認日</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['reserve_datetime']); ?>
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>仮予約フラグ</td>
<td>
<?php if ($this->_tpl_vars['item']['tmp_flag'] == 1): ?>
	仮予約
<?php else: ?>
	予約承認済み
<?php endif; ?>
</td>
<td width=100 bgcolor=#DEDEDE>キャンセルフラグ</td>
<td>
<?php if ($this->_tpl_vars['item']['cancel_flag'] == 1): ?>
	キャンセル済み
<?php else: ?>
	未キャンセル
<?php endif; ?>
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>予約変更フラグ</td>
<td>
<?php if ($this->_tpl_vars['item']['change_flag'] > 0): ?>
	変更済み
<?php else: ?>
	未変更
<?php endif; ?>
</td>
<td width=100 bgcolor=#DEDEDE>利用予定人数</td>
<td>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['people']); ?>
人
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>予約変更日</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['change_datetime']); ?>
</td>
<td width=100 bgcolor=#DEDEDE>予約キャンセル日</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['cancel_datetime']); ?>
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>利用目的</td>
<td>
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
</td>
<td width=100 bgcolor=#DEDEDE>バーチャル口座</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['virtual_code']); ?>
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>入金期限日</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['pay_limitdate']); ?>
</td>
<td width=100 bgcolor=#DEDEDE>最終入金日</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['pay_checkdate']); ?>
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>入金済みフラグ</td>
<td>
<?php if ($this->_tpl_vars['item']['pay_flag'] == 1): ?>
	入金済み
<?php else: ?>
	未入金 or 一部入金
<?php endif; ?>
</td>
<td width=100 bgcolor=#DEDEDE>入金済み金額</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['pay_money']); ?>
円</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>完了フラグ</td>
<td>
<?php if ($this->_tpl_vars['item']['complete_flag'] == 1): ?>
	完了
<?php else: ?>
	未完了
<?php endif; ?>
</td>
<td width=100 bgcolor=#DEDEDE>看板</td>
<td align=left>
<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['kanban']))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('t_url2cmd', true, $_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id'])) : smarty_modifier_t_url2cmd($_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id']))))) ? $this->_run_mod_handler('t_cmd', true, $_tmp, 'diary') : smarty_modifier_t_cmd($_tmp, 'diary')))) ? $this->_run_mod_handler('t_decoration', true, $_tmp) : smarty_modifier_t_decoration($_tmp)); ?>

</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>部屋利用料金</td>
<td>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_price']); ?>
円
</td>
<td width=100 bgcolor=#DEDEDE>備品利用料金</td>
<td>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['vessel_price']); ?>
円
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>サービス利用料金</td>
<td>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['service_price']); ?>
円
</td>
<td width=100 bgcolor=#DEDEDE>合計請求金額</td>
<td>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_price']+$this->_tpl_vars['item']['vessel_price']+$this->_tpl_vars['item']['service_price']); ?>
円
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>領収書印刷フラグ</td>
<td>
<?php if ($this->_tpl_vars['item']['receipt_flag'] == 0): ?>
未印刷
<?php else: ?>
印刷済み
<?php endif; ?>
</td>
<td width=100 bgcolor=#DEDEDE>領収書印刷日</td>
<td>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['receipt_datetime']); ?>

</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>請求番号</td>
<td colspan=3>

<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['bill_id']); ?>

</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>社内メモ</td>
<td colspan=3>
<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['memo']))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('t_url2cmd', true, $_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id'])) : smarty_modifier_t_url2cmd($_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id']))))) ? $this->_run_mod_handler('t_cmd', true, $_tmp, 'diary') : smarty_modifier_t_cmd($_tmp, 'diary')))) ? $this->_run_mod_handler('t_decoration', true, $_tmp) : smarty_modifier_t_decoration($_tmp)); ?>

</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>お客様メッセージ</td>
<td colspan=3>
<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['item']['message']))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('t_url2cmd', true, $_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id'])) : smarty_modifier_t_url2cmd($_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id']))))) ? $this->_run_mod_handler('t_cmd', true, $_tmp, 'diary') : smarty_modifier_t_cmd($_tmp, 'diary')))) ? $this->_run_mod_handler('t_decoration', true, $_tmp) : smarty_modifier_t_decoration($_tmp)); ?>

</td>
</tr>

</table>
<br>
<b>↓　↓　↓</b><br>
<br>
<?php endforeach; endif; unset($_from); ?>



<table border=1 width=700>
<tr>
<th colspan=4 bgcolor=#FFFF55>修正前/現在のデータ （予約ID：<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['reserve_id']); ?>
）<br>(最終変更日：<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['change_datetime']); ?>
)</th>
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
<td width=100 bgcolor=#DEDEDE>利用開始日時</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['begin_datetime']); ?>
</td>
<td width=100 bgcolor=#DEDEDE>利用終了日時</td>
<td>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['finish_datetime']); ?>

</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>仮予約日</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['tmp_reserve_datetime']); ?>
</td>
<td width=100 bgcolor=#DEDEDE>予約承認日</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['reserve_datetime']); ?>
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>仮予約フラグ</td>
<td>
<?php if ($this->_tpl_vars['reserve_data']['tmp_flag'] == 1): ?>
	仮予約
<?php else: ?>
	予約承認済み
<?php endif; ?>
</td>
<td width=100 bgcolor=#DEDEDE>キャンセルフラグ</td>
<td>
<?php if ($this->_tpl_vars['reserve_data']['cancel_flag'] == 1): ?>
	キャンセル済み
<?php else: ?>
	未キャンセル
<?php endif; ?>
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>予約変更フラグ</td>
<td>
<?php if ($this->_tpl_vars['reserve_data']['change_flag'] > 0): ?>
	変更済み
<?php else: ?>
	未変更
<?php endif; ?>
</td>
<td width=100 bgcolor=#DEDEDE>利用予定人数</td>
<td>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['people']); ?>
人
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>予約変更日</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['change_datetime']); ?>
</td>
<td width=100 bgcolor=#DEDEDE>予約キャンセル日</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['cancel_datetime']); ?>
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>利用目的</td>
<td>
	<?php if ($this->_tpl_vars['reserve_data']['purpose'] == 0): ?>
		未選択
	<?php elseif ($this->_tpl_vars['reserve_data']['purpose'] == 1): ?>
		会議
	<?php elseif ($this->_tpl_vars['reserve_data']['purpose'] == 2): ?>
		セミナー
	<?php elseif ($this->_tpl_vars['reserve_data']['purpose'] == 3): ?>
		研修
	<?php elseif ($this->_tpl_vars['reserve_data']['purpose'] == 4): ?>
		面接・試験
	<?php elseif ($this->_tpl_vars['reserve_data']['purpose'] == 5): ?>
		懇談会・パーティ
	<?php elseif ($this->_tpl_vars['reserve_data']['purpose'] == 6): ?>
		その他
	<?php endif; ?>
</td>
<td width=100 bgcolor=#DEDEDE>バーチャル口座</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['virtual_code']); ?>
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>入金期限日</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['pay_limitdate']); ?>
</td>
<td width=100 bgcolor=#DEDEDE>最終入金日</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['pay_checkdate']); ?>
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>入金済みフラグ</td>
<td>
<?php if ($this->_tpl_vars['reserve_data']['pay_flag'] == 1): ?>
	入金済み
<?php elseif ($this->_tpl_vars['reserve_data']['pay_flag'] == 0): ?>
	未入金 or 一部入金
<?php else: ?>
過剰入金
<?php endif; ?>
</td>
<td width=100 bgcolor=#DEDEDE>入金済み金額</td>
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['pay_money']); ?>
円</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>完了フラグ</td>
<td>
<?php if ($this->_tpl_vars['reserve_data']['complete_flag'] == 1): ?>
	完了
<?php else: ?>
	未完了
<?php endif; ?>
</td>
<td width=100 bgcolor=#DEDEDE>看板</td>
<td align=left>
<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['kanban']))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('t_url2cmd', true, $_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id'])) : smarty_modifier_t_url2cmd($_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id']))))) ? $this->_run_mod_handler('t_cmd', true, $_tmp, 'diary') : smarty_modifier_t_cmd($_tmp, 'diary')))) ? $this->_run_mod_handler('t_decoration', true, $_tmp) : smarty_modifier_t_decoration($_tmp)); ?>

</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>部屋利用料金</td>
<td>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['room_price']); ?>
円
</td>
<td width=100 bgcolor=#DEDEDE>備品利用料金</td>
<td>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['vessel_price']); ?>
円
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>サービス利用料金</td>
<td>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['service_price']); ?>
円
</td>
<td width=100 bgcolor=#DEDEDE>合計請求金額</td>
<td>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['room_price']+$this->_tpl_vars['reserve_data']['vessel_price']+$this->_tpl_vars['reserve_data']['service_price']); ?>
円
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>領収書印刷フラグ</td>
<td>
<?php if ($this->_tpl_vars['reserve_data']['receipt_flag'] == 0): ?>
未印刷
<?php else: ?>
印刷済み
<?php endif; ?>
</td>
<td width=100 bgcolor=#DEDEDE>領収書印刷日</td>
<td>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['receipt_datetime']); ?>

</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>請求番号</td>
<td colspan=3>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['bill_id']); ?>

</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>社内メモ</td>
<td colspan=3>
<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['memo']))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('t_url2cmd', true, $_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id'])) : smarty_modifier_t_url2cmd($_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id']))))) ? $this->_run_mod_handler('t_cmd', true, $_tmp, 'diary') : smarty_modifier_t_cmd($_tmp, 'diary')))) ? $this->_run_mod_handler('t_decoration', true, $_tmp) : smarty_modifier_t_decoration($_tmp)); ?>

</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>お客様メッセージ</td>
<td colspan=3>
<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['message']))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('t_url2cmd', true, $_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id'])) : smarty_modifier_t_url2cmd($_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id']))))) ? $this->_run_mod_handler('t_cmd', true, $_tmp, 'diary') : smarty_modifier_t_cmd($_tmp, 'diary')))) ? $this->_run_mod_handler('t_decoration', true, $_tmp) : smarty_modifier_t_decoration($_tmp)); ?>

</td>
</tr>

</table>
<br>
<b>↓　↓　↓</b><br>
<br>

<form onSubmit="return confirm1();" name="do_change_reserve" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('do_change_reserve','page')); ?>
" />
<input type="hidden" name="reserve_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['reserve_id']); ?>
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
<select name="room_id">
<?php $_from = $this->_tpl_vars['room_select']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
	<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_id']); ?>
" <?php if ($this->_tpl_vars['item']['room_id'] == $this->_tpl_vars['reserve_data']['room_id']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['room_name']); ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>利用開始日時</td>
<td>
<input type="text" name="begin_datetime" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['begin_datetime']); ?>
">
</td>
<td width=100 bgcolor=#DEDEDE>利用終了日時</td>
<td>
<input type="text" name="finish_datetime" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['finish_datetime']); ?>
">
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>仮予約日</td>
<td>
<input type="text" name="tmp_reserve_datetime" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['tmp_reserve_datetime']); ?>
">
</td>
<td width=100 bgcolor=#DEDEDE>予約承認日</td>
<td>
<input type="text" name="reserve_datetime" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['reserve_datetime']); ?>
">
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>仮予約フラグ</td>
<td>
<input type="radio" id="tmp_flag1" name="tmp_flag" value="1" <?php if ($this->_tpl_vars['reserve_data']['tmp_flag'] == 1): ?>checked<?php endif; ?>>仮予約
<input type="radio" id="tmp_flag0" name="tmp_flag" value="0" <?php if ($this->_tpl_vars['reserve_data']['tmp_flag'] == 0): ?>checked<?php endif; ?>>予約承認済み
</td>
<td width=100 bgcolor=#DEDEDE>キャンセルフラグ</td>
<td>
<input type="radio" name="cancel_flag" value="1" <?php if ($this->_tpl_vars['reserve_data']['cancel_flag'] == 1): ?>checked<?php endif; ?>>キャンセル済み
<input type="radio" name="cancel_flag" value="0" <?php if ($this->_tpl_vars['reserve_data']['cancel_flag'] == 0): ?>checked<?php endif; ?>>未キャンセル
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>予約変更フラグ</td>
<td>
<input type="radio" name="change_flag" id="change_flag1" value="1" <?php if ($this->_tpl_vars['reserve_data']['change_flag'] == 1): ?>checked<?php endif; ?>>変更済み
<input type="radio" id="change_flag0" name="change_flag" value="0" <?php if ($this->_tpl_vars['reserve_data']['change_flag'] == 0): ?>checked<?php endif; ?>>未変更
</td>
<td width=100 bgcolor=#DEDEDE>利用予定人数</td>
<td>
<input type="text" name="people" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['people']); ?>
" style="text-align:right;padding-right:5px;">人
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>予約変更日</td>
<td>
<input type="text" name="change_datetime" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['change_datetime']); ?>
">
</td>
<td width=100 bgcolor=#DEDEDE>予約キャンセル日</td>
<td>
<input type="text" name="cancel_datetime" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['cancel_datetime']); ?>
">
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>利用目的</td>
<td>
<select name="purpose">
<?php $_from = $this->_tpl_vars['purpose_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
	<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
" <?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['reserve_data']['purpose']): ?>selected<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</td>
<td width=100 bgcolor=#DEDEDE>バーチャル口座</td>
<td>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['virtual_code']); ?>
<br>
※ ゲストの顧客など口座が<br>
割当てられていない状態の顧客を<br>
一部入金などに修正した場合には、<br>
自動で空き番号を割り当てます。
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>入金期限日</td>
<td>
<input type="text" name="pay_limitdate" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['pay_limitdate']); ?>
">
</td>
<td width=100 bgcolor=#DEDEDE>最終入金日</td>
<td>
<input type="text" name="pay_checkdate" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['pay_checkdate']); ?>
">
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>入金済みフラグ</td>
<td>
<input type="radio" name="pay_flag" value="1" id="pay1" <?php if ($this->_tpl_vars['reserve_data']['pay_flag'] == 1): ?>checked<?php endif; ?>>入金済み
<input type="radio" name="pay_flag" value="0" id="pay0" <?php if ($this->_tpl_vars['reserve_data']['pay_flag'] == 0): ?>checked<?php endif; ?>>未入金 or 一部入金
<input type="radio" name="pay_flag" value="2" id="pay2" <?php if ($this->_tpl_vars['reserve_data']['pay_flag'] == 2): ?>checked<?php endif; ?>>過剰入金
</td>
<td width=100 bgcolor=#DEDEDE>入金済み金額</td>
<td>
<input type="text" name="pay_money" onchange="update_radio()" id="pay_money" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['pay_money']); ?>
" style="text-align:right;padding-right:5px;">円
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>完了フラグ</td>
<td>
<input type="radio" name="complete" value="1" <?php if ($this->_tpl_vars['reserve_data']['complete_flag'] == 1): ?>checked<?php endif; ?>>完了
<input type="radio" name="complete" value="0" <?php if ($this->_tpl_vars['reserve_data']['complete_flag'] == 0): ?>checked<?php endif; ?>>未完了
</td>
<td width=100 bgcolor=#DEDEDE>看板</td>
<td>
<textarea id=kanban name=kanban rows="3" cols="40"><?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['kanban']); ?>
</textarea>
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>部屋利用料金</td>
<td>
<input type="text" name="room_price" id="room_price" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['room_price']); ?>
" style="text-align:right;padding-right:5px;" onkeyup="return changePrice()">円
</td>
<td width=100 bgcolor=#DEDEDE>備品利用料金</td>
<td>
<input type="text" name="vessel_price" id="vessel_price" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['vessel_price']); ?>
" style="text-align:right;padding-right:5px;" onkeyup="return changePrice()">円
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>サービス利用料金</td>
<td>
<input type="text" name="service_price" id="service_price" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['service_price']); ?>
" style="text-align:right;padding-right:5px;" onkeyup="return changePrice()">円
</td>
<td width=100 bgcolor=#DEDEDE>合計請求金額</td>
<td>
<input type="text" name="total_price" id="total_price" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['room_price']+$this->_tpl_vars['reserve_data']['service_price']+$this->_tpl_vars['reserve_data']['vessel_price']); ?>
" style="text-align:right;padding-right:5px;">円
</td>
</tr>
<tr>
<td width=100 bgcolor=#DEDEDE>領収書印刷フラグ</td>
<td>
<input type="radio" name="receipt_flag" value="0" <?php if ($this->_tpl_vars['reserve_data']['receipt_flag'] == 0): ?>checked<?php endif; ?>>未印刷
<input type="radio" name="receipt_flag" value="1" <?php if ($this->_tpl_vars['reserve_data']['receipt_flag'] == 1): ?>checked<?php endif; ?>>印刷済み
</td>
<td width=100 bgcolor=#DEDEDE>領収書印刷日</td>
<td>
<input type="text" name="receipt_datetime" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['receipt_datetime']); ?>
">
</td>
</tr>
<tr>
<td width=100 bgcolor=#DEDEDE>請求番号</td>
<td colspan=3>
<input type="text" name="bill_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['bill_id']); ?>
" >　
<input type="radio" name="renew_bill_id" value="0" checked>テキスト入力　
<input type="radio" name="renew_bill_id" value="1">新規請求番号取得
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>社内メモ</td>
<td colspan=3>
<textarea id="mce_editor_textarea" name="memo" rows="<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['_rows']))) ? $this->_run_mod_handler('default', true, $_tmp, '4') : smarty_modifier_default($_tmp, '4')); ?>
" cols="<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['_cols']))) ? $this->_run_mod_handler('default', true, $_tmp, '70') : smarty_modifier_default($_tmp, '70')); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['memo']); ?>
</textarea>
</td>
</tr>

<tr>
<td width=100 bgcolor=#DEDEDE>お客さま<br>メッセージ</td>
<td colspan=3>
<textarea id="mce_editor_textarea" name="message" rows="<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['_rows']))) ? $this->_run_mod_handler('default', true, $_tmp, '4') : smarty_modifier_default($_tmp, '4')); ?>
" cols="<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['_cols']))) ? $this->_run_mod_handler('default', true, $_tmp, '70') : smarty_modifier_default($_tmp, '70')); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['message']); ?>
</textarea>
</td>
</tr>
<tr>
<td colspan=4>
<input type="submit" value="　変　更　">
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
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
	var JQry = jQuery.noConflict();
    function changePrice()
    {
        var room_price = document.getElementById('room_price').value;
        var ressel_price = document.getElementById('vessel_price').value;
        var service_price= document.getElementById('service_price').value;
		var pay_money= document.getElementById('pay_money').value;
        var total_price = document.getElementById('total_price');
        if(room_price == ''){
        	room_price = 0;
        }
        if(ressel_price == ''){
        	ressel_price = 0;
        }
        if(service_price == ''){
        	service_price = 0;
        }
        var total =parseFloat(room_price)+parseFloat(ressel_price)+parseFloat(service_price);
        total_price.value= total;
		if(pay_money<total){
			 document.getElementById("pay0").checked = true;
		}
		if(pay_money==total){
			 document.getElementById("pay1").checked = true;
		}
		if(pay_money>total){
			 document.getElementById("pay2").checked = true;
		}
    }
	function update_radio(){
		var room_price = document.getElementById('room_price').value;
        var ressel_price = document.getElementById('vessel_price').value;
        var pay_money= document.getElementById('pay_money').value;
        var service_price= document.getElementById('service_price').value;
        var total_price = document.getElementById('total_price');
        if(room_price == ''){
        	room_price = 0;
        }
        if(ressel_price == ''){
        	ressel_price = 0;
        }
        if(service_price == ''){
        	service_price = 0;
        }
        var total =parseFloat(room_price)+parseFloat(ressel_price)+parseFloat(service_price);
		if(pay_money<total){
			 document.getElementById("pay0").checked = true;			 
		}
		if(pay_money==total){
			 document.getElementById("pay1").checked = true;			 
		}
		if(pay_money>total){
			 document.getElementById("pay2").checked = true;			 
		}
	}
	JQry( document ).ready(function() {
		var pay_money= document.getElementById('pay_money').value;
		var total = document.getElementById('total_price').value;
		pay_money = parseInt(pay_money);
		total = parseInt(total);
		if(pay_money< total){
			 document.getElementById("pay0").checked = true;			 
			 
		}
		if(pay_money==total){
			 document.getElementById("pay1").checked = true;			 
			
		}
		if(pay_money>total){
			document.getElementById("pay2").checked = true;		
	
		}
    });
</script>
<?php echo $this->_tpl_vars['inc_footer']; ?>
