<?php /* Smarty version 2.6.18, created on 2011-05-26 16:52:56
         compiled from file:/var/www/atoffice/webapp/modules/admin/templates/reserve_confirm.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/atoffice/webapp/modules/admin/templates/reserve_confirm.tpl', 2, false),array('modifier', 't_escape', 'file:/var/www/atoffice/webapp/modules/admin/templates/reserve_confirm.tpl', 24, false),array('modifier', 'nl2br', 'file:/var/www/atoffice/webapp/modules/admin/templates/reserve_confirm.tpl', 94, false),array('modifier', 't_url2cmd', 'file:/var/www/atoffice/webapp/modules/admin/templates/reserve_confirm.tpl', 94, false),array('modifier', 't_cmd', 'file:/var/www/atoffice/webapp/modules/admin/templates/reserve_confirm.tpl', 94, false),array('modifier', 't_decoration', 'file:/var/www/atoffice/webapp/modules/admin/templates/reserve_confirm.tpl', 94, false),array('modifier', 'default', 'file:/var/www/atoffice/webapp/modules/admin/templates/reserve_confirm.tpl', 156, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminSiteMember.tpl"), $this);?>

<?php $this->assign('page_name', "予約確認"); ?>
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

<h2 id="ttl01">予約確認</h2>
<br>
<center>
<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><br><br><?php endif; ?>

<br>
<table>
<tr>
<td style="text-align:left;">
金額を手入力で、調整できます。<br>
金額を調整した場合は、登録担当者と理由をメモに必ず記入してください。<br>
</td>
</tr>
</table>
<br>


<form name="do_set_reserve" method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('do_set_reserve','page')); ?>
" />

<?php $_from = $this->_tpl_vars['post_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
	<input type="hidden" name="<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
">
<?php endforeach; endif; unset($_from); ?>



<table border=1 width=700>
<tr>
<td width=100 bgcolor=#AACCFF>利用施設名</td>
<td width=250><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['hall_name']); ?>
</td>
<td width=100 bgcolor=#AACCFF>部屋名</td>
<td width=250>
<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['room_name']); ?>

</td>
</tr>
<tr>
<td bgcolor=#AACCFF>利用日時</td>
<td colspan=3><?php echo smarty_modifier_t_escape($this->_tpl_vars['begin']); ?>
 ～ <?php echo smarty_modifier_t_escape($this->_tpl_vars['finish']); ?>
</td>
</tr>

<tr>
<td width=100 bgcolor=#AACCFF>利用目的</td>
<td>
<?php if ($this->_tpl_vars['post_data']['purpose'] == 0): ?>
	未選択
<?php elseif ($this->_tpl_vars['post_data']['purpose'] == 1): ?>
	会議
<?php elseif ($this->_tpl_vars['post_data']['purpose'] == 2): ?>
	セミナー
<?php elseif ($this->_tpl_vars['post_data']['purpose'] == 3): ?>
	研修
<?php elseif ($this->_tpl_vars['post_data']['purpose'] == 4): ?>
	面接・試験
<?php elseif ($this->_tpl_vars['post_data']['purpose'] == 5): ?>
	懇談会・パーティ
<?php elseif ($this->_tpl_vars['post_data']['purpose'] == 6): ?>
	その他
<?php endif; ?>
</td>
<td width=100 bgcolor=#AACCFF>利用人数</td><td><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['people']); ?>
 人</td>
</tr>

<tr>
<td bgcolor=#AACCFF>利用料金</td>
<td colspan=3>
<input type="text" name="room_price" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['room_price']); ?>
" style="text-align:right;padding-right:5px;"> 円
</td>
</tr>

<tr>
<td bgcolor=#AACCFF>看板</td>
<td colspan=3 align=left>
<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['post_data']['kanban']))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('t_url2cmd', true, $_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id'])) : smarty_modifier_t_url2cmd($_tmp, 'diary', smarty_modifier_t_escape($this->_tpl_vars['member']['c_member_id']))))) ? $this->_run_mod_handler('t_cmd', true, $_tmp, 'diary') : smarty_modifier_t_cmd($_tmp, 'diary')))) ? $this->_run_mod_handler('t_decoration', true, $_tmp) : smarty_modifier_t_decoration($_tmp)); ?>

</td>
</tr>

<tr>
<td bgcolor=#AACCFF>顧客ID</td>
<td>
<?php if ($this->_tpl_vars['post_data']['c_member_id']): ?>
	<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['c_member_id']); ?>

<?php else: ?>
	-- --
<?php endif; ?>
</td>
<td bgcolor=#AACCFF>顧客氏名</td>
<td>
<?php if ($this->_tpl_vars['post_data']['c_member_id']): ?>
	<a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('c_member_detail')); ?>
&amp;target_c_member_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['c_member_id']); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['c_member']['nickname']); ?>
【<?php echo smarty_modifier_t_escape($this->_tpl_vars['guest']); ?>
】</a>
<?php else: ?>
	新規契約者
<?php endif; ?>
</td>
</tr>

<tr>
<td bgcolor=#AACCFF>予約備品</td>
<td colspan=3>
<?php $_from = $this->_tpl_vars['vessel_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['value']):
?>
	<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['vessel_data']['vessel_name']); ?>
：　<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['vessel_data']['price']); ?>
円ｘ<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['num']); ?>
<br>
<?php endforeach; else: ?>
	なし<br>
<?php endif; unset($_from); ?>
<span style="color:#FF0000;font-size:15px;"><b>備品料金合計：
<input type="text" name="vessel_price" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['vessel_price']); ?>
" style="text-align:right;padding-right:5px;">
円</b></span>
</td>
</tr>

<tr>
<td bgcolor=#AACCFF>予約サービス</td>
<td colspan=3>
<?php $_from = $this->_tpl_vars['service_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['value']):
?>
	<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['service_data']['service_name']); ?>
：　<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['service_data']['price']); ?>
円ｘ<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['num']); ?>
<br>
<?php endforeach; else: ?>
	なし<br>
<?php endif; unset($_from); ?>
<span style="color:#FF0000;font-size:15px;"><b>サービス料金合計：
<input type="text" name="service_price" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['service_price']); ?>
" style="text-align:right;padding-right:5px;">
円</b></span>
</td>
</tr>

<tr>
<td bgcolor=#AACCFF>合計金額</td>
<td colspan=3>
<span style="color:#FF0000;font-size:15px;"><b>合計請求額：
<input type="text" name="total_price" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['total_price']); ?>
" style="text-align:right;padding-right:5px;">
 円</b></span>
</td>
</tr>
<tr>
<td width=100 bgcolor=#AACCFF>お客様<br>メッセージ</td>
<td colspan=3>
<textarea id="mce_editor_textarea" name="message" rows="<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['_rows']))) ? $this->_run_mod_handler('default', true, $_tmp, '4') : smarty_modifier_default($_tmp, '4')); ?>
" cols="<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['_cols']))) ? $this->_run_mod_handler('default', true, $_tmp, '70') : smarty_modifier_default($_tmp, '70')); ?>
"></textarea>
</td>
</tr>
<tr>
<td width=100 bgcolor=#AACCFF>社内メモ</td>
<td colspan=3>
<textarea id="mce_editor_textarea" name="memo" rows="<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['_rows']))) ? $this->_run_mod_handler('default', true, $_tmp, '4') : smarty_modifier_default($_tmp, '4')); ?>
" cols="<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['_cols']))) ? $this->_run_mod_handler('default', true, $_tmp, '70') : smarty_modifier_default($_tmp, '70')); ?>
"></textarea>
</td>
</tr>
<tr>
<td width=100 bgcolor=#FFAACC><b>長期フラグ</b></td>
<td colspan=3>
<input type="radio" name="long_term" value="0" checked> 通常予約
<input type="radio" name="long_term" value="1"> 長期予約
</td>
</tr>
<tr>
<td width=100 bgcolor=#FFAACC><b>通知メール</b></td>
<td colspan=3>
<input type="radio" name="mail_flag" value="1" checked> 通知メールを送信する
<input type="radio" name="mail_flag" value="0"> 通知メールを送信しない
</td>
</tr>

</table>


<?php if ($this->_tpl_vars['post_data']['c_member_id'] == 0): ?>

<br>
<table border=1 width=700>
<tr>
<th colspan=4 bgcolor=#FFCCDD>ゲスト申請<span style="color:#FF0000">(※ 必須)</span></th>
</tr>
<tr>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">氏名<span style="color:#FF0000;">(※)</span></td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<input tyep="text" name="shimei" size=20 value="">
</td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">フリガナ(全角カタカナ)<span style="color:#FF0000">(※)</span></td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<input tyep="text" name="kana" size=30 value="">
</td>
</tr>

<tr>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">利用形態<span style="color:#FF0000;">(※)</span></td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<input type="radio" name="riyo" value="106"> 法人　
<input type="radio" name="riyo" value="107"> 個人
</td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">法人名・代表者名<span style="color:#FF0000;">(※)</span></td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<input tyep="text" name="daihyou" size=20 value="">
</td>
</tr>
<tr>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">部署名</td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<input tyep="text" name="busho" size=20 value="">
</td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">メールアドレス<span style="color:#FF0000;">(※)</span></td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<input type="text" name="mail" size=30 value="">
</td>
</tr>
<tr>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">都道府県<span style="color:#FF0000;">(※)</span></td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<select name="ken">
<?php $_from = $this->_tpl_vars['ken_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['value']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['c_profile_option_id']); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['value']); ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>

</td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">郵便番号<br>(ハイフン有り)</td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<input type="text" name="zip" size=20 value="">
</td>
</tr>
<tr>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">市区町村<span style="color:#FF0000;">(※)</span></td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<input type="text" name="address_city" size=20 value="">
</td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">番地<span style="color:#FF0000;">(※)</span></td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<input type="text" name="address_banchi" size=30 value="">
</td>
</tr>
<tr>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">建物名</td>
<td colspan=3 style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<input type="text" name="address_build" size=60 value="">
</td>
</tr>
<tr>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">電話番号<span style="color:#FF0000;">(※)</span><br>(ハイフン有り)</td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<input type="text" name="tel" size=20 value="">
</td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">FAX番号<br>ハイフン有り</td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<input type="text" name="fax" size=20 value="">
</td>
</tr>
</table>

<?php endif; ?>

<br>
<INPUT TYPE=button VALUE="　戻る　" style="width:250px;font:20px;border:3px ridge;background:#090;color:#fff; padding:3px; font-weight:bold;" onClick="self.history.back()">
<INPUT TYPE="submit" VALUE="　仮予約登録　" style="width:250px;font:20px;border:3px ridge;background:#090;color:#fff; padding:3px; font-weight:bold;">

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
