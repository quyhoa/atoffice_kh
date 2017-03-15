<?php /* Smarty version 2.6.18, created on 2017-02-20 03:17:42
         compiled from file:/var/www/html/atoffice/webapp/modules/admin/templates/set_reserve_confirm.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/set_reserve_confirm.tpl', 2, false),array('modifier', 't_escape', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/set_reserve_confirm.tpl', 12, false),array('modifier', 'number_format', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/set_reserve_confirm.tpl', 172, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminSiteMember.tpl"), $this);?>

<?php $this->assign('page_name', "予約備品入力"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminSiteMember.tpl"), $this);?>

</div>



<center><div id="left" style='width:660px;'>
<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><br><br>
<INPUT TYPE=button VALUE="　戻る　" style="width:250px;font:20px;border:3px ridge;background:#090;color:#fff; padding:3px; font-weight:bold;" onClick="self.history.back()">
<?php else: ?> 
<?php if ($this->_tpl_vars['num_pre_data'] == 0): ?>
<table width="500"><tr>
<td width="250" style="text-align: center; vertical-align:middle;">
<form name="add_reserve" method="POST" action="./">
<input type="hidden" name="page" value="set_reserve">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('set_reserve','page')); ?>
" />
<input type="hidden" name="pre_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['pre_id']); ?>
">
<input type='hidden' name='uid' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member_id']); ?>
'>
<input type='hidden' name='old_member' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member_id']); ?>
'>
<input type='hidden' name='hall_list' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
'>
<input type='hidden' name='year' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
'>
<input type='hidden' name='reset_preid' value='1'>
<input type='hidden' name='month' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
'>
<input type='hidden' name='day' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']); ?>
'>
<INPUT TYPE="submit" VALUE="他の予約を追加する" style="width:250px;font:20px;border:3px ridge;background:#090;color:#fff; padding:3px; font-weight:bold;" >
</form>
</td>
</tr></table>
<?php else: ?> 

<span style="font-size:16px;">
★ 今回のご予約件数：<b><?php echo smarty_modifier_t_escape($this->_tpl_vars['num_pre_data']); ?>
</b> 件 ★<br>
</span>
<br>
<?php $_from = $this->_tpl_vars['pre_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
 <?php if (( $this->_tpl_vars['value']['purpose'] ) == 0): ?>
    <?php $this->assign('purpose', "未定"); ?>
<?php endif; ?>
<?php if (( $this->_tpl_vars['value']['purpose'] ) == 1): ?>
    <?php $this->assign('purpose', "会議"); ?>
<?php endif; ?>
<?php if (( $this->_tpl_vars['value']['purpose'] ) == 2): ?>
    <?php $this->assign('val', 1); ?>
<?php endif; ?>
<?php if (( $this->_tpl_vars['value']['purpose'] ) == 3): ?>
    <?php $this->assign('purpose', "研修"); ?>
<?php endif; ?>
<?php if (( $this->_tpl_vars['value']['purpose'] ) == 4): ?>
    <?php $this->assign('purpose', "面接・試験"); ?>
<?php endif; ?>
<?php if (( $this->_tpl_vars['value']['purpose'] ) == 5): ?>
    <?php $this->assign('purpose', "懇談会・パーティ"); ?>
<?php endif; ?>
<?php if (( $this->_tpl_vars['value']['purpose'] ) == 6): ?>
    <?php $this->assign('purpose', "その他"); ?>
<?php endif; ?>
<form name="set_reserve_complete" method="POST" action="./" id="frm_complete">
<input type="hidden" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_id']); ?>
" name="reserve_id"/>
<table width=600>
<tr>
   
<td colspan=4 bgcolor=#FFFF66 style='border: 1px #000000 solid;text-align: center;padding:2px;padding-left:15px;'><b>◆　予約：<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']+1); ?>
◆</b>
    <div style="float:right;width:80px">
     <INPUT TYPE="reset" VALUE="変更" style="float:left" onclick="editform(<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['pid']); ?>
)">
      <input type="reset" value="取消" onclick="deleteform(<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['pid']); ?>
)"/>
  
</div>
</td>
</tr>
<tr>
<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>施設名</td>
<td style='border: 1px #000000 solid;text-align: center;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['hall_data']['hall_name']); ?>
</td>

<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>部屋名称</td>
<td style='border: 1px #000000 solid;text-align: center;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['room_data']['room_name']); ?>
</td>

</tr>
<tr>
<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>利用日</td>
<td style='border: 1px #000000 solid;text-align: center;'>
	<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['date']); ?>
(<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['week']); ?>
)

</td>

<td rowspan=2 bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>利用時間帯</td>
<td rowspan=2 style='border: 1px #000000 solid;text-align: center;'>
	<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['begin']); ?>
～<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['finish']); ?>


</td>
</tr>

<tr>
<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>ご利用目的</td>
<td style='border: 1px #000000 solid;text-align: center;'>
	<?php echo smarty_modifier_t_escape($this->_tpl_vars['purpose']); ?>

</td>

</tr>
<tr>
<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>利用人数</td><td colspan="3" style='border: 1px #000000 solid;text-align: left;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['people']); ?>
 人</td>
</tr>

<tr>
<!--
<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>キャンセル料金</td>
<td colspan=3 style='border: 1px #000000 solid;text-align: center;'>
<table>
    <tr>
        <td>

	<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['cancel_list']['day1']); ?>
日以前<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['cancel_list']['percent1']); ?>
%
	</td>
	<?php if ($this->_tpl_vars['value']['cancel_list']['day2']): ?>
		<td>
                    <span style='margin:2px'>
		<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['cancel_list']['day2']); ?>
日前まで<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['cancel_list']['percent2']); ?>
%
		</span>
                </td>
        <?php endif; ?>
	<?php if ($this->_tpl_vars['value']['cancel_list']['day3']): ?>
		<td>
                    <span style='margin:2px'>
                        <?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['cancel_list']['day3']); ?>
日前まで<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['cancel_list']['percent3']); ?>
%
		</span>
		</td>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['value']['cancel_list']['day4']): ?>
		<td><span style='margin:2px'>
		<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['cancel_list']['day4']); ?>
日前まで<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['cancel_list']['percent4']); ?>
%
		</span>
		</td>

<?php endif; ?>
	<?php if ($this->_tpl_vars['value']['cancel_list']['day5']): ?>
		<td>
            <span style='margin:2px'>
            <?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['cancel_list']['day5']); ?>
日前まで<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['cancel_list']['percent5']); ?>
%
		</span>
		</td>
	<?php endif; ?>

	</tr></table>
</td>
</tr>
-->
<tr>
<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'>会議室入口<br>表示名<br>(※任意)</td>
<td colspan=3 style='border: 1px #000000 solid;text-align: left;'>

<textarea cols="60" rows="4" name="kanban_<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['pid']); ?>
" id="kanban_<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['pid']); ?>
" ><?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['kanban']); ?>
</textarea>
</td>
</tr>
<tr>
<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>利用料金</td>
<td colspan=3 style='border: 1px #000000 solid;text-align: left;padding:5px'>
<input type="text" name="room_price_<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['pid']); ?>
" id="room_price_<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['pid']); ?>
" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['room_price']); ?>
" style="text-align:right;padding-right:5px;" onkeyup="return changePrice(<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['pid']); ?>
)"> 円
</td>
</tr>

<tr>

<tr>
<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>予約備品</td>
<td colspan=3 style='border: 1px #000000 solid;text-align: left;padding:5px' >
<?php $_from = $this->_tpl_vars['value']['vessel_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['vessel']):
?>

	<?php echo smarty_modifier_t_escape($this->_tpl_vars['vessel']['vessel_data']['vessel_name']); ?>
：　<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['vessel']['vessel_data']['price']))) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>
円ｘ<?php echo smarty_modifier_t_escape($this->_tpl_vars['vessel']['num']); ?>
<br>
<?php endforeach; else: ?>
	なし<br>
<?php endif; unset($_from); ?>
<span style="color:#FF0000;font-size:15px;"><b>備品料金合計：
<input type="text" name="vessel_price_<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['pid']); ?>
" id="vessel_price_<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['pid']); ?>
" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['vessel_price']); ?>
" style="text-align:right;padding-right:5px;" onkeyup="return changePrice(<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['pid']); ?>
)">
円</b></span>
</td>
</tr>

<tr>
<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>予約サービス</td>
<td colspan=3 style='border: 1px #000000 solid;text-align: left;padding:5px'>
<?php $_from = $this->_tpl_vars['value']['service_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['service']):
?>
	<?php echo smarty_modifier_t_escape($this->_tpl_vars['service']['service_data']['service_name']); ?>
：　<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['service']['service_data']['price']))) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>
円ｘ<?php echo smarty_modifier_t_escape($this->_tpl_vars['service']['num']); ?>
<br>
<?php endforeach; else: ?>
	なし<br>
<?php endif; unset($_from); ?>
<span style="color:#FF0000;font-size:15px;"><b>サービス料金合計：
<input type="text" name="service_price_<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['pid']); ?>
" id="service_price_<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['pid']); ?>
" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['service_price']); ?>
" style="text-align:right;padding-right:5px;" onkeyup="return changePrice(<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['pid']); ?>
)">
円</b></span>
</td>
</tr>

<tr>
<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>合計金額</td>
<td colspan=3 style='border: 1px #000000 solid;text-align: left;padding:5px'>
<span style="color:#FF0000;font-size:15px;"><b>合計請求額：
<input type="hidden"  id="old_total_price_<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['pid']); ?>
"  value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['total_price']); ?>
" >
<input type="text" name="total_price_<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['pid']); ?>
" id="total_price_<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['pid']); ?>
"  value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['total_price']); ?>
" style="text-align:right;padding-right:5px;" onkeyup="return changeTotal(<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['pid']); ?>
)">
 円</b></span>
</td>
</tr>

<tr>
<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>社内メモ</td>
<td colspan=3 style='border: 1px #000000 solid;text-align: left;padding:5px'>
<textarea cols="60" rows="4" name="memo_<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['pid']); ?>
" id="memo_<?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['pid']); ?>
" ><?php echo smarty_modifier_t_escape($this->_tpl_vars['value']['memo']); ?>
</textarea></td>
</tr>


</td>
</tr>
</table>
<br>

<?php endforeach; endif; unset($_from); ?>
<!-- 2014-04-21 -->

<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('set_reserve_complete','page')); ?>
" />
<input type="hidden" name="uid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member_id']); ?>
" />
<input type="hidden" name="pre_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['pre_id']); ?>
" />
<!-- end -->
<table width="600" border="1">
<tbody>

<tr>
<td bgcolor=#AACCFF>顧客ID</td>
<td>
<?php if ($this->_tpl_vars['c_member_id']): ?>
	<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member_id']); ?>

<?php else: ?>
	-- --
<?php endif; ?>
</td>
</tr>
<tr>
<td  width="120" bgcolor=#AACCFF>顧客氏名</td>
<td>
<?php if ($this->_tpl_vars['c_member_id']): ?>
	<a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('c_member_detail')); ?>
&amp;target_c_member_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member_id']); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member_data']['nickname']); ?>
【<?php echo smarty_modifier_t_escape($this->_tpl_vars['guest']); ?>
】</a>
<?php else: ?>
	新規契約者
<?php endif; ?>
</td>
</tr>
<tr>
<td width="120" bgcolor="#AACCFF">お客様<br>メッセージ</td>
<td colspan="3">
<textarea cols="60" rows="4" onchange="save_data()" name="message" id="message"><?php echo smarty_modifier_t_escape($this->_tpl_vars['tmp_user']['message']); ?>
</textarea>
</td>
</tr>
<tr>
<td width="100" bgcolor="#FFAACC"><b>長期フラグ</b></td>
<td colspan="3">
<input type="radio" checked="" onClick="save_data()" value="0" name="long_term"
<?php if (! $this->_tpl_vars['tmp_user']['long_term']): ?>
 checked="checked"
<?php endif; ?>
> 通常予約
<input type="radio" value="1" onClick="save_data()" name="long_term"<?php if ($this->_tpl_vars['tmp_user']['long_term']): ?>
 checked="checked"
<?php endif; ?>> 長期予約
</td>
</tr>
<tr>
<td width="100" bgcolor="#FFAACC"><b>通知メール</b></td>
<td colspan="3">
<input type="radio" checked="checked" onclick="save_data()" value="1" name="mail_flag" <?php if ($this->_tpl_vars['tmp_user']['mail_flag']): ?>
 checked="checked"
<?php endif; ?>> 通知メールを送信する
<input type="radio" value="0" onclick="save_data()" name="mail_flag" <?php if (! $this->_tpl_vars['tmp_user']['mail_flag']): ?>
<?php endif; ?>> 通知メールを送信しない
</td>
</tr>

</tbody></table>

<?php if ($this->_tpl_vars['c_member_id'] == 0): ?>
<!-- info user -->
<br/>
<table border="1" width="600">
<tbody><tr>
<th colspan="4" bgcolor="#FFCCDD">ゲスト申請<span style="color:#FF0000">(※ 必須)</span></th>
</tr>
<tr>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">氏名<span style="color:#FF0000;">(※)</span></td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<input type="text" onchange="save_data()" id="mce_shimei" name="shimei" size="20" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['tmp_user']['shimei']); ?>
">
</td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">フリガナ(全角カタカナ)<span style="color:#FF0000">(※)</span></td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<input type="text" onchange="save_data()" id="Phonetic" name="kana" size="30" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['tmp_user']['kana']); ?>
">
</td>
</tr>

<tr>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">利用形態<span style="color:#FF0000;">(※)</span></td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<input type="radio" onClick="save_data()" name="riyo" value="106"
<?php if ($this->_tpl_vars['tmp_user']['riyo'] == '106'): ?>
checked="checked"
<?php endif; ?>
> 法人　
<input type="radio" onClick="save_data()" name="riyo" value="107"
<?php if ($this->_tpl_vars['tmp_user']['riyo'] == '107'): ?>
checked="checked"
<?php endif; ?>> 個人
</td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">法人名・代表者名<span style="color:#FF0000;">(※)</span></td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<input type="text" onchange="save_data()" id="Corporate_name" name="daihyou" size="20" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['tmp_user']['daihyou']); ?>
">
</td>
</tr>
<tr>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">部署名</td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<input type="text" onchange="save_data()" id="Division_name" name="busho" size="20" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['tmp_user']['busho']); ?>
">
</td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">メールアドレス<span style="color:#FF0000;">(※)</span></td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<input type="text" onchange="save_data()" id="mailaddress" name="mail" size="30" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['tmp_user']['mail']); ?>
">
</td>
</tr>
<tr>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">都道府県<span style="color:#FF0000;">(※)</span></td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<select name="ken" onchange="save_data()">
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '7'): ?>selected<?php endif; ?> value="7">北海道</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '8'): ?>selected<?php endif; ?> value="8">青森県</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '9'): ?>selected<?php endif; ?> value="9">岩手県</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '10'): ?>selected<?php endif; ?> value="10">宮城県</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '11'): ?>selected<?php endif; ?> value="11">秋田県</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '12'): ?>selected<?php endif; ?> value="12">山形県</option>
<option  <?php if ($this->_tpl_vars['tmp_user']['ken'] == '13'): ?>selected<?php endif; ?> value="13">福島県</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '14'): ?>selected<?php endif; ?> value="14">茨城県</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '15'): ?>selected<?php endif; ?> value="15">栃木県</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '16'): ?>selected<?php endif; ?> value="16">群馬県</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '17'): ?>selected<?php endif; ?> value="17">埼玉県</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '18'): ?>selected<?php endif; ?> value="18">千葉県</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '19'): ?>selected<?php endif; ?> value="19">東京都</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '20'): ?>selected<?php endif; ?> value="20">神奈川県</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '21'): ?>selected<?php endif; ?> value="21">新潟県</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '22'): ?>selected<?php endif; ?> value="22">富山県</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '23'): ?>selected<?php endif; ?> value="23">石川県</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '24'): ?>selected<?php endif; ?> value="24">福井県</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '25'): ?>selected<?php endif; ?> value="25">山梨県</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '26'): ?>selected<?php endif; ?> value="26">長野県</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '27'): ?>selected<?php endif; ?> value="27">岐阜県</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '28'): ?>selected<?php endif; ?> value="28">静岡県</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '29'): ?>selected<?php endif; ?> value="29">愛知県</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '30'): ?>selected<?php endif; ?> value="30">三重県</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '31'): ?>selected<?php endif; ?> value="31">滋賀県</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '32'): ?>selected<?php endif; ?> value="32">京都府</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '33'): ?>selected<?php endif; ?> value="33">大阪府</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '34'): ?>selected<?php endif; ?> value="34">兵庫県</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '35'): ?>selected<?php endif; ?> value="35">奈良県</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '36'): ?>selected<?php endif; ?> value="36">和歌山県</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '37'): ?>selected<?php endif; ?> value="37">鳥取県</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '38'): ?>selected<?php endif; ?> value="38">島根県</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '39'): ?>selected<?php endif; ?> value="39">岡山県</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '40'): ?>selected<?php endif; ?> value="40">広島県</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '41'): ?>selected<?php endif; ?> value="41">山口県</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '42'): ?>selected<?php endif; ?> value="42">徳島県</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '43'): ?>selected<?php endif; ?> value="43">香川県</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '44'): ?>selected<?php endif; ?> value="44">愛媛県</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '45'): ?>selected<?php endif; ?> value="45">高知県</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '46'): ?>selected<?php endif; ?> value="46">福岡県</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '47'): ?>selected<?php endif; ?> value="47">佐賀県</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '48'): ?>selected<?php endif; ?> value="48">長崎県</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '49'): ?>selected<?php endif; ?> value="49">熊本県</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '50'): ?>selected<?php endif; ?> value="50">大分県</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '51'): ?>selected<?php endif; ?> value="51">宮崎県</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '52'): ?>selected<?php endif; ?> value="52">鹿児島県</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '53'): ?>selected<?php endif; ?> value="53">沖縄県</option>
<option <?php if ($this->_tpl_vars['tmp_user']['ken'] == '54'): ?>selected<?php endif; ?> value="54">その他</option>
</select>

</td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">郵便番号<br>(ハイフン有り)</td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<input type="text" onchange="save_data()" id="zipcode" name="zip" size="20" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['tmp_user']['zip']); ?>
">
</td>
</tr>
<tr>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">市区町村<span style="color:#FF0000;">(※)</span></td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<input type="text" onchange="save_data()" id="address_city" name="address_city" size="20" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['tmp_user']['address_city']); ?>
">
</td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">番地<span style="color:#FF0000;">(※)</span></td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<input type="text" onchange="save_data()" id="address_banchi" name="address_banchi" size="30" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['tmp_user']['address_banchi']); ?>
">
</td>
</tr>
<tr>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">建物名</td>
<td colspan="3" style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<input type="text" onchange="save_data()" id="address_build" name="address_build" size="60" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['tmp_user']['address_build']); ?>
">
</td>
</tr>
<tr>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">電話番号<span style="color:#FF0000;">(※)</span><br>(ハイフン有り)</td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<input type="text" onchange="save_data()" id="tel" name="tel" size="20" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['tmp_user']['tel']); ?>
">
</td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">FAX番号<br>ハイフン有り</td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<input type="text" onchange="save_data()" id="fax" name="fax" size="20" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['tmp_user']['fax']); ?>
">
</td>
</tr>
</tbody></table>
<br/>
<!-- end -->
<?php endif; ?>

<table width=600>
<tr>
<td height=30 bgcolor=#FFCDCD style='border: 1px #000000 solid;text-align: center;'>
<span style="font:16px;"><b>請求予定総額</b></span>
</td>
</tr>
<tr>
<td style='border: 1px #000000 solid;text-align: center;'>
<input type="hidden" id="all_total_price" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['all_total']); ?>
" />
<span id="total_price" style="font-size:20px;color:#FF0000;font-weight:bold">

<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['all_total']))) ? $this->_run_mod_handler('number_format', true, $_tmp, 0) : number_format($_tmp, 0)); ?>

</span> 円(税込)
</td>
</tr>
</table>
<br>

<br>
</form>
<br><br>
<table width="500"><tr>
<td width="250" style="text-align: center; vertical-align:middle;">
<form name="add_reserve" method="POST" action="./">
<input type="hidden" name="page" value="set_reserve">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('set_reserve_list','page')); ?>
" />
<input type="hidden" name="pre_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['pre_id']); ?>
">
<input type='hidden' name='c_member_id' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member_id']); ?>
'>
<input type='hidden' name='old_member' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member_id']); ?>
'>
<input type='hidden' name='hall_list' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
'>
<input type='hidden' name='old_hall' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
'>
<input type='hidden' name='year' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
'>
<input type='hidden' name='month' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
'>
<input type='hidden' name='day' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']); ?>
'>
<INPUT TYPE="submit" VALUE="戻る" style="width:250px;font:20px;border:3px ridge;background:#090;color:#fff; padding:3px; font-weight:bold;" onclick="return updateprice()">
</form>
</td>
<td width="250" style="text-align: center; vertical-align:middle;">
<INPUT TYPE="reset" VALUE="仮予約登録" style="width:250px;font:20px;border:3px ridge;background:#090;color:#fff; padding:3px; font-weight:bold;" onclick="return complete()">

</td>
</tr></table>

   <form name="set_reserve" method="POST" action="./" id="edit_frm">
        <input type="hidden" name="page" value="set_reserve_edit">
        <input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
        <input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('set_reserve_edit','page')); ?>
" />
        <input type="hidden" name="pre_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['pre_id']); ?>
">
        <input type='hidden' name='uid' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member_id']); ?>
'>
        <input type='hidden' name='hall_list' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
'>
        
        <input type='hidden' name='pid' value='' id="edit_pid">
        
    </form>
    <form name="reserve_confirm" method="POST" action="./" id="del_frm">
        <input type="hidden" name="page" value="reserve_confirm">
        <input type="hidden" name="pre_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['pre_id']); ?>
">
        <input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
        <input type='hidden' name='uid' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member_id']); ?>
'>
        <input type='hidden' name='pid' value='' id="del_pid">
        <input type='hidden' name='delete' value='1'>
        <input type='hidden' name='hall_list' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['hall_id']); ?>
'>
        <input type='hidden' name='year' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['year']); ?>
'>
        <input type='hidden' name='month' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['month']); ?>
'>
        <input type='hidden' name='day' value='<?php echo smarty_modifier_t_escape($this->_tpl_vars['day']); ?>
'>
        <input type="hidden" name="a" value="page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('set_reserve_confirm','page')); ?>
" />
    
    </form>
</div>
<?php endif; ?>
<?php endif; ?>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
	var JQry = jQuery.noConflict();
    var pre_id="<?php echo smarty_modifier_t_escape($this->_tpl_vars['pre_id']); ?>
";
    var tryingToReload = true;
    window.onbeforeunload = function(e) //on before unload
    {
        if (!e) //Firefox and Safari gets argument directly.
        {
            e = window.event; // this is for IE
        }
    
        if (e.clientY != undefined && e.clientY < 0) // clicked on the close   button for IE
        {
             tryingToReload = true;
        }
        
        if (e.clientY != undefined && (e.clientY > 100 && e.clientY < 140)) //    select close from context menu from the right click on title bar on IE
        {
            tryingToReload = true;
        }
        console.log(tryingToReload);
        if (tryingToReload)
        {
            e = e || window.event;
            var url="?m=admin&a=page_clear_reserve&pid="+pre_id;
            var post=null;
            var xmlHttp = new XMLHttpRequest();
        	xmlHttp.open("POST", url, false);
        	xmlHttp.setRequestHeader("Content-Type" , "application/x-www-form-urlencoded;charset=UTF-8");
        	xmlHttp.send(post);
            
            return ;
        }
    }
    document.onkeydown = function(e) //attach to key down event to detect the F5 key
    {
        if (!e) //Firefox and Safari gets argument directly.
        {
            e = window.event;
        }

        var key = e.keyCode ? e.keyCode : e.which;
        tryingToReload=true;
        try //try
        {
               switch (key){
                  case 116 : //F5 button
                      tryingToReload=false;break;
                  case 82 : //R button
                          if (event.ctrlKey){ 
                             tryingToReload=false;break;
                          }
                    }
        }
        catch (ex) { }
        }

    document.oncontextmenu = function(e) //check for the right click
    {
        
        var srcElement = getEventSrc(e);
        tryingToReload=true;
        var tagName = '';
        if (srcElement.tagName != undefined) //Get the name of the tag
        {
            tagName = srcElement.tagName;
        }
        switch (tagName)
        {
            case "BODY":
            case "TD":
            case "DIV":
            case "CENTER":
            {
                tryingToReload = false;
                break;
            }
            default:
            break;
        }
    }

    function getEventSrc(e)
    {
        if (this.Event)
        {
        var targ = e.target;
        //nodeType of 1 means ELEMENT_NODE
          return targ.nodeType == 1 ? targ : targ.parentNode;
        }
        else //this is for IE
         return event.srcElement;
    }

    document.onclick = function(e) 
    {
        tryingToReload = false;
    }
    function complete()
    {
		var frm = document.getElementById('frm_complete');
        frm.submit();
        return true;
    }
    function editform(pid)
    {
        updateprice();
		document.getElementById('edit_pid').value=pid;
        var frm = document.getElementById('edit_frm');
        frm.submit();
        return true;
    }
    function deleteform(pid)
    {
        document.getElementById('del_pid').value=pid;
        var frm = document.getElementById('del_frm');
        frm.submit();
        return true;
    }
    function changePrice(id)
    {
		
        var price_hall = document.getElementById('room_price_'+id).value;
        var old_total = document.getElementById('total_price_'+id).value;
        var versel = document.getElementById('vessel_price_'+id).value;
        var service = document.getElementById('service_price_'+id).value;
        var old_total_price = document.getElementById('old_total_price_'+id).value;
        var total = document.getElementById('all_total_price').value;
        if(!price_hall)
        {
            price_hall=0;
        }
        if(!old_total)
        {
            old_total=0;
        }
        if(!versel)
        {
            versel=0;
        }
        if(!service)
        {
            service=0;
        }
        if(!old_total_price)
        {
            old_total_price=0;
        }
        if(!total)
        {
            total=0;
        }
        var new_total = parseFloat(versel)+parseFloat(service)+parseFloat(price_hall);
        var new_total_all = parseFloat(total)-parseFloat(old_total_price) + parseFloat(new_total);
        document.getElementById('total_price_'+id).value=new_total;
        document.getElementById('old_total_price_'+id).value=new_total;
        document.getElementById('all_total_price').value=new_total_all;
        document.getElementById('total_price').innerHTML=number_format(new_total_all);
    }
    function changeTotal(id)
    {
        var old_total = document.getElementById('old_total_price_'+id).value;
        var total_item =document.getElementById('total_price_'+id).value;
        var total = document.getElementById('all_total_price').value;
        if(!old_total)
        {
            old_total=0;
        }
        if(!total_item)
        {
            total_item=0;
        }
        if(!total)
        {
            total=0;
        }
        var new_total = parseFloat(total)-parseFloat(old_total)+parseFloat(total_item);
        document.getElementById('old_total_price_'+id).value=total_item;
        document.getElementById('all_total_price').value=new_total;
        document.getElementById('total_price').innerHTML=number_format(new_total);
        
    }
   
    function number_format(number, decimals, dec_point, thousands_sep) {
    
        var n = !isFinite(+number) ? 0 : +number, 
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }
	function updateprice()
	{
		var post=document.getElementById('frm_complete').serialize();
		var url="?m=admin&a=page_update_pre_reserve";
		var xmlHttp = new XMLHttpRequest();
		xmlHttp.open("POST", url, false);
		xmlHttp.setRequestHeader("Content-Type" , "application/x-www-form-urlencoded;charset=UTF-8");
		xmlHttp.send(post);
		xmlHttp.onreadystatechange = function() {
			alert(request.responseText);
		}
		return ;
	}
	
	function save_data(){
		var post=document.getElementById('frm_complete').serialize();
		var url="?m=admin&a=page_save_data_pre_resever"; 
		var xmlHttp = new XMLHttpRequest();
		xmlHttp.open("POST", url, false);
		xmlHttp.setRequestHeader("Content-Type" , "application/x-www-form-urlencoded;charset=UTF-8");
		xmlHttp.send(post);
		xmlHttp.onreadystatechange = function() {
			alert(request.responseText);
			/*if (request.readyState == 4) {
			  
			}*/
		}
		return ;
	}
	
	

</script>
<?php echo $this->_tpl_vars['inc_footer']; ?>
