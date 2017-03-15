<?php /* Smarty version 2.6.18, created on 2016-10-27 18:43:05
         compiled from file:/var/www/atoffice/webapp/modules/admin/templates/send_cancel_mail.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/atoffice/webapp/modules/admin/templates/send_cancel_mail.tpl', 2, false),array('modifier', 't_escape', 'file:/var/www/atoffice/webapp/modules/admin/templates/send_cancel_mail.tpl', 17, false),array('modifier', 'nl2br', 'file:/var/www/atoffice/webapp/modules/admin/templates/send_cancel_mail.tpl', 117, false),array('modifier', 't_url2cmd', 'file:/var/www/atoffice/webapp/modules/admin/templates/send_cancel_mail.tpl', 117, false),array('modifier', 't_cmd', 'file:/var/www/atoffice/webapp/modules/admin/templates/send_cancel_mail.tpl', 117, false),array('modifier', 't_decoration', 'file:/var/www/atoffice/webapp/modules/admin/templates/send_cancel_mail.tpl', 117, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminSiteMember.tpl"), $this);?>

<?php $this->assign('page_name', "キャンセルメール送信"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminSiteMember.tpl"), $this);?>

</div>

<?php if ($this->_tpl_vars['atoffice_auth_type'] == 2 || $this->_tpl_vars['atoffice_auth_type'] == 4): ?>

<h2>キャンセルメール送信</h2>
<div class="contents">
この予約をキャンセルし、キャンセルメールを送信します。
	<table border=1 width=800>
	<tr>
	<td colspan=4 bgcolor=#CC1111>
	<b><span style="color: #FFFFFF;">□　予約ID : <?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_list']['reserve_id']); ?>
　□ <?php if ($this->_tpl_vars['reserve_list']['bill_id']): ?>(請求番号:<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_list']['bill_id']); ?>
)<?php endif; ?></span></b>
	</td>
	</tr>

	<tr>
	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>予約日</span></td>
	<td><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_list']['tmp_reserve_datetime']); ?>
</span></td>	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>承認日</span></td>
	<td><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_list']['reserve_datetime']); ?>
</span></td>


	</tr>

	<tr>
	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>入金日</span></td>
	<td><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_list']['pay_checkdate']); ?>
</span></td>	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>入金状態</span></td>
	<td><span style='margin:5px;'>
	<?php if ($this->_tpl_vars['reserve_list']['pay_money'] == $this->_tpl_vars['reserve_list']['total_price']): ?>
		入金済み（<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_list']['pay_money']); ?>
円）
	<?php elseif ($this->_tpl_vars['reserve_list']['pay_money'] > $this->_tpl_vars['reserve_list']['total_price']): ?>
		<span style="color:#FF0000;"><b>過剰入金(<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_list']['pay_money']); ?>
円)</b></span>
	<?php endif; ?>

	</span></td>
	</tr>

	<tr>
	<td bgcolor=#FFD9DC><span style='margin:5px;'>予約者</span></td>
	<td width=300><span style='margin:5px;'>
		<a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('c_member_detail')); ?>
&amp;target_c_member_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_list']['c_member']['c_member_id']); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_list']['c_member']['nickname']); ?>
</a>
	</span></td>
	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>企業・個人名</span></td>
	<td width=300><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_list']['corp']); ?>
</span></td>
	</tr>

	<tr>
	<td bgcolor=#FFD9DC><span style='margin:5px;'>施設名</span></td>
	<td width=300><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_list']['hall_data']['hall_name']); ?>
</span></td>
	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>部屋名</span></td>
	<td width=300><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_list']['room_data']['room_name']); ?>
</span></td>
	</tr>

	<tr>
	<td bgcolor=#FFD9DC rowspan=2><span style='margin:5px;'>予約時間</span></td>
	<td rowspan=2><?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_list']['datetime']); ?>
<br><?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_list']['begin_datetime']); ?>
 ～ <?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_list']['finish_datetime']); ?>
</td>
	<td bgcolor=#FFD9DC><span style='margin:5px;'>利用人数/目的</span></td>
	<td><span style='margin:5px;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_list']['people']); ?>
 人　/　

	<?php if ($this->_tpl_vars['reserve_list']['purpose'] == 0): ?>
		未選択
	<?php elseif ($this->_tpl_vars['reserve_list']['purpose'] == 1): ?>
		会議
	<?php elseif ($this->_tpl_vars['reserve_list']['purpose'] == 2): ?>
		セミナー
	<?php elseif ($this->_tpl_vars['reserve_list']['purpose'] == 3): ?>
		研修
	<?php elseif ($this->_tpl_vars['reserve_list']['purpose'] == 4): ?>
		面接・試験
	<?php elseif ($this->_tpl_vars['reserve_list']['purpose'] == 5): ?>
		懇談会・パーティ
	<?php elseif ($this->_tpl_vars['reserve_list']['purpose'] == 6): ?>
		その他
	<?php endif; ?>

	</span></td>
	</tr>

	<tr>
	<td bgcolor=#FFD9DC><span style='margin:5px;'>ﾊﾞｰﾁｬﾙ口座</span></td>
	<td><span style='margin:5px;'>
	<?php if ($this->_tpl_vars['reserve_list']['virtual_code']): ?>
		<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_list']['virtual_code']); ?>

	<?php else: ?>
		固定口座
	<?php endif; ?>
	</span></td>
	</tr>


	<tr>
	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>利用料金</span></td>
	<td colspan=3><span style='margin:5px;'>【部屋利用料：<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_list']['room_price']); ?>
円】＋【備品利用料：<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_list']['vessel_price']); ?>
円】＋【サービス利用料：<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_list']['service_price']); ?>
円】＝【合計請求額：<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_list']['total_price']); ?>
円】</span></td>
	</tr>

<?php if ($this->_tpl_vars['reserve_list']['reserve_v_list']): ?>
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
	<?php $_from = $this->_tpl_vars['reserve_list']['reserve_v_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
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

<?php if ($this->_tpl_vars['reserve_list']['reserve_s_list']): ?>
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
	<?php $_from = $this->_tpl_vars['reserve_list']['reserve_s_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
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
	<td bgcolor=#FFD9DC width=100 style='vertical-align:middle;'>
        <span style='margin:5px;'>お客さま<br>メッセージ</span>
    </td>
	<td colspan=3 align=left>
	<?php if ($this->_tpl_vars['reserve_list']['message']): ?>
		<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['reserve_list']['message']))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('t_url2cmd', true, $_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id'])) : smarty_modifier_t_url2cmd($_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id']))))) ? $this->_run_mod_handler('t_cmd', true, $_tmp, 'diary') : smarty_modifier_t_cmd($_tmp, 'diary')))) ? $this->_run_mod_handler('t_decoration', true, $_tmp) : smarty_modifier_t_decoration($_tmp)); ?>

	<?php else: ?>
		<center>--</center>
	<?php endif; ?>
	</td>
	</tr>

	<tr>
	<td bgcolor=#FFD9DC width=100 style='vertical-align:middle;'><span style='margin:5px;'>社内メモ</span></td>
	<td colspan=3 align=left>
	<?php if ($this->_tpl_vars['reserve_list']['memo']): ?>
		<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['reserve_list']['memo']))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('t_url2cmd', true, $_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id'])) : smarty_modifier_t_url2cmd($_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id']))))) ? $this->_run_mod_handler('t_cmd', true, $_tmp, 'diary') : smarty_modifier_t_cmd($_tmp, 'diary')))) ? $this->_run_mod_handler('t_decoration', true, $_tmp) : smarty_modifier_t_decoration($_tmp)); ?>

	<?php else: ?>
		<center>--</center>
	<?php endif; ?>
	</td>
	</tr>


	<tr>
	<td bgcolor=#FFD9DC width=100><span style='margin:5px;'>キャンセル料</span></td>
	<td colspan=3>

	<?php if ($this->_tpl_vars['reserve_list']['cancel_list']['before'] > 0): ?>
	<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_list']['cancel_list']['before']); ?>
日前　<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_list']['cancel_list']['percent']); ?>
% 徴収<br>
	<?php endif; ?>
	【キャンセルに含む総額：<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_list']['room_price']+$this->_tpl_vars['reserve_list']['cancel_service_price']); ?>
円】=【部屋利用料：<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_list']['room_price']); ?>
円】＋【備品利用料：<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_list']['cancel_vessel_price']); ?>
円】＋【キャンセル料金に含まれるサービス料：<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_list']['cancel_service_price']); ?>
円】<br>
	【キャンセル料：<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_list']['cancel_price']); ?>
円】=【キャンセルに含む総額：<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_list']['room_price']+$this->_tpl_vars['reserve_list']['cancel_vessel_price']+$this->_tpl_vars['reserve_list']['cancel_service_price']); ?>
円】-【キャンセル料率：<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_list']['cancel_list']['percent']); ?>
x0.01】<br><br>

	<?php if ($this->_tpl_vars['reserve_list']['pay_money'] > $this->_tpl_vars['reserve_list']['cancel_price']): ?>
		【返金額：<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_list']['pay_money']-$this->_tpl_vars['reserve_list']['cancel_price']); ?>
円】=【入金額】-【キャンセル料】
	<?php else: ?>
		【請求額：<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_list']['cancel_price']-$this->_tpl_vars['reserve_list']['pay_money']); ?>
】=【キャンセル料】-【入金額】
	<?php endif; ?>

	</td>
	</tr>
	</table>
	<br>

<p class="info">【キャンセルメール】</p>

<form action="./" method="post">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('send_cancel_mail','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<input type="hidden" name="resderveid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_list']['reserve_id']); ?>
" />
<input type="hidden" name="page" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['page']); ?>
" />
<input type="hidden" name="hall_list" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_list']); ?>
" />
<input type="hidden" name="u" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member_id']); ?>
" />
<input type="hidden" name="pay_flag" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['pay_flag']); ?>
" />
<input type="hidden" name="index" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['index']); ?>
" />
<input type="hidden" name="reserveid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_list']['reserve_id']); ?>
" />
<dl>
<dt class="mails"><strong>送信先</strong></dt>
<dd class="mails"><input size='100' type='text' name='mails' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['requests']['mails']); ?>
'></dd>
<dd class="caution" id="c02">※複数のメールアドレス宛にメールを送信する場合は、; で区切って入力してください。</dd>
<dt class="subject"><strong>表題</strong></dt>
<dd class="subject"><input size='100' type='text' name='subject' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['requests']['subject']); ?>
'></dd>
<dt class="message"><strong>本文</strong></dt>
<dd class="message"><textarea cols="90" rows="30" name="message"><?php echo smarty_modifier_t_escape($this->_tpl_vars['requests']['message']); ?>
</textarea></dd>
</dl>
<table><tbody><tr><td>
<p class="textBtn">
<input type="submit" name="cancel" value="戻る(キャンセル中止)">
</p>
</td><td>
<p class="textBtn">
<input type="submit" name="submit" value="確認画面">
</p>
</td></tbody></table>
</form>

<?php else: ?>
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
<?php endif; ?>
<div>

<?php echo $this->_tpl_vars['inc_footer']; ?>
