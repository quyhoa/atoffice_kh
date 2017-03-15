<?php /* Smarty version 2.6.18, created on 2015-11-27 17:44:32
         compiled from file:/var/www/atoffice/webapp/modules/admin/templates/completion_report.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/atoffice/webapp/modules/admin/templates/completion_report.tpl', 2, false),array('modifier', 't_escape', 'file:/var/www/atoffice/webapp/modules/admin/templates/completion_report.tpl', 24, false),array('modifier', 'default', 'file:/var/www/atoffice/webapp/modules/admin/templates/completion_report.tpl', 160, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminDesign.tpl"), $this);?>

<?php $this->assign('page_name', "完了報告"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminDesign.tpl"), $this);?>

</div>


<?php if ($this->_tpl_vars['atoffice_auth_type'] == 2 || $this->_tpl_vars['atoffice_auth_type'] == 3 || $this->_tpl_vars['atoffice_auth_type'] == 4): ?>

<style type="text/css">
<!--
HR {
	border-style:dotted;color:#3399FF

}
-->
</style>

<h2 id="ttl01">完了報告</h2>
<br>
<center>
<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><br><br><?php endif; ?>

<br><br>

<table width=700>
<tr>
<th colspan=4 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FF6666>申込者情報</th>
</tr>
<tr>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD>登録番号</td>
<td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member_data']['c_member_id']); ?>
</td>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD></td>
<td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'></td>
</tr>

<tr>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD>法人・個人名</td>
<td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['corp']); ?>
</td>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD>部署名</td>
<td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'><?php if ($this->_tpl_vars['busho']): ?>
	<?php echo smarty_modifier_t_escape($this->_tpl_vars['busho']); ?>

<?php else: ?>
	-- --
<?php endif; ?>
</td>
</tr>

<tr>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD>電話番号</td>
<td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['tel']); ?>
</td>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD>FAX番号</td>
<td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'><?php if ($this->_tpl_vars['fax']): ?>
	<?php echo smarty_modifier_t_escape($this->_tpl_vars['fax']); ?>

<?php else: ?>
	-- --
<?php endif; ?>
</td>
</tr>
</table>

<br>

<form method="POST" action="./">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="reporter" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['reporter']); ?>
" />
<input type="hidden" name="page" value="today_reservation" />
<input type="hidden" name="reserve_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['reserve_data']['reserve_id']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('add_report','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />

<table width=700>
<tr>
<th colspan=2 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FF6666>完了報告</th>
</tr>
<tr>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD>報告担当者</td>
<td style='border: 1px #000000 solid;text-align: left;vertical-align:middle;'>
<span style="margin:5px"><?php echo smarty_modifier_t_escape($this->_tpl_vars['name']); ?>
</span>
</td>
</tr>

<tr>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD>チェック事項</td>
<td style='border: 1px #000000 solid;text-align: left;vertical-align:middle;'>

<table>
<tr>
<td>①原状復帰されたか？</td>
<td>
<input type="radio" name="original_state" value="0" checked> はい
<input type="radio" name="original_state" value="1"> いいえ
</td>
<td></td>
</tr>
<tr>
<td>②貸出備品は回収したか？</td>
<td>
<input type="radio" name="vessel_collect" value="0" checked> はい
<input type="radio" name="vessel_collect" value="1"> いいえ
</td>
<td></td>
</tr>
<tr>
<td>③利用者はごみを持ち帰ったか？</td>
<td>
<input type="radio" name="garbage" value="0" checked> はい
<input type="radio" name="garbage" value="1"> いいえ
</td>
<td></td>
</tr>
<tr>
<td>④室内の汚れ、破損はないか？</td>
<td>
<input type="radio" name="room_check" value="0" checked> はい
<input type="radio" name="room_check" value="1"> いいえ
</td>
<td>
<span style="margin:5px">報告：<input type="text" name="room_check_info" size=30></span>
</td>
</tr>
<tr>
<td>⑤忘れ物はないか？</td>
<td>
<input type="radio" name="thing_left" value="0" checked> はい
<input type="radio" name="thing_left" value="1"> いいえ
</td>
<td>
<span style="margin:5px">報告：<input type="text" name="thing_left_info" size=30></span>
</td>
</tr>
</table>

</td>
</tr>

<tr>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD>ブラックリスト<br>追加依頼</td>
<td style='border: 1px #000000 solid;text-align: left;vertical-align:middle;'>
<input type="radio" name="blacklist_request" value="1"> 追加依頼
<input type="radio" name="blacklist_request" value="0" checked> なし
<span style="margin:5px">理由：<input type="text" name="blacklist_request_info" size=60></span>
</td>
</tr>

<tr>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFDDDD>その他問題事項</td>
<td style='border: 1px #000000 solid;text-align: left;vertical-align:middle;'>
<textarea id="mce_editor_textarea" name="report" rows="<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['_rows']))) ? $this->_run_mod_handler('default', true, $_tmp, '6') : smarty_modifier_default($_tmp, '6')); ?>
" cols="<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['_cols']))) ? $this->_run_mod_handler('default', true, $_tmp, '70') : smarty_modifier_default($_tmp, '70')); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['post_data']['agreement']); ?>
</textarea>
</td>
</tr>

<tr>
<td colspan=2 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'>
<input type="submit" value="　報　告　">
</td>
</tr>
</table>
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
