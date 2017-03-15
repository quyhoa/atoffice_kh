<?php /* Smarty version 2.6.18, created on 2015-11-27 17:32:18
         compiled from file:/var/www/atoffice/webapp/modules/admin/templates/c_member_detail.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/atoffice/webapp/modules/admin/templates/c_member_detail.tpl', 2, false),array('function', 't_img_url', 'file:/var/www/atoffice/webapp/modules/admin/templates/c_member_detail.tpl', 14, false),array('modifier', 't_escape', 'file:/var/www/atoffice/webapp/modules/admin/templates/c_member_detail.tpl', 5, false),array('modifier', 'date_format', 'file:/var/www/atoffice/webapp/modules/admin/templates/c_member_detail.tpl', 27, false),array('modifier', 't_implode', 'file:/var/www/atoffice/webapp/modules/admin/templates/c_member_detail.tpl', 40, false),array('modifier', 't_truncate', 'file:/var/www/atoffice/webapp/modules/admin/templates/c_member_detail.tpl', 40, false),array('modifier', 'nl2br', 'file:/var/www/atoffice/webapp/modules/admin/templates/c_member_detail.tpl', 40, false),array('modifier', 'escape', 'file:/var/www/atoffice/webapp/modules/admin/templates/c_member_detail.tpl', 45, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminSiteMember.tpl"), $this);?>

<?php $this->assign('page_name', "メンバー詳細"); ?>
<?php $this->assign('parent_page_name', "メンバーリスト"); ?>
<?php ob_start(); ?>?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('list_c_member')); ?>
<?php $this->_smarty_vars['capture']['parent_page_url'] = ob_get_contents(); ob_end_clean(); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminSiteMember.tpl"), $this);?>

</div>

<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><?php endif; ?>
<h2 id="ttl01">メンバー詳細</h2>
<div class="contents">

<p id="userImg"><?php if ($this->_tpl_vars['c_member']['image_filename_1']): ?><a href="<?php echo smarty_function_t_img_url(array('filename' => smarty_modifier_t_escape($this->_tpl_vars['c_member']['image_filename_1'])), $this);?>
" target="_blank"><img src="<?php echo smarty_function_t_img_url(array('filename' => smarty_modifier_t_escape($this->_tpl_vars['c_member']['image_filename_1']),'w' => 120,'h' => 120), $this);?>
"></a><?php endif; ?><?php if ($this->_tpl_vars['c_member']['image_filename_2']): ?><a href="<?php echo smarty_function_t_img_url(array('filename' => smarty_modifier_t_escape($this->_tpl_vars['c_member']['image_filename_2'])), $this);?>
" target="_blank"><img src="<?php echo smarty_function_t_img_url(array('filename' => smarty_modifier_t_escape($this->_tpl_vars['c_member']['image_filename_2']),'w' => 120,'h' => 120), $this);?>
"></a><?php endif; ?><?php if ($this->_tpl_vars['c_member']['image_filename_3']): ?><a href="<?php echo smarty_function_t_img_url(array('filename' => smarty_modifier_t_escape($this->_tpl_vars['c_member']['image_filename_3'])), $this);?>
" target="_blank"><img src="<?php echo smarty_function_t_img_url(array('filename' => smarty_modifier_t_escape($this->_tpl_vars['c_member']['image_filename_3']),'w' => 120,'h' => 120), $this);?>
"></a><?php endif; ?></p>
<table class="userDetailTable">
	<tbody>
	<tr>
		<th>ID</th>
		<td style='border: 1px #CDCDCD solid;text-align: center;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['c_member_id']); ?>
</td>
	</tr>
	<tr>
		<th><?php echo smarty_modifier_t_escape($this->_tpl_vars['WORD_NICKNAME']); ?>
</th>
		<td style='border: 1px #CDCDCD solid;text-align: center;'><?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['nickname']); ?>
</td>
	</tr>
	<tr>
		<th>最終ログイン</th>
		<td style='border: 1px #CDCDCD solid;text-align: center;'><?php if ($this->_tpl_vars['c_member']['access_date'] != '0000-00-00 00:00:00'): ?><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['c_member']['access_date']))) ? $this->_run_mod_handler('date_format', true, $_tmp, "%y-%m-%d %H:%M") : smarty_modifier_date_format($_tmp, "%y-%m-%d %H:%M")); ?>
<?php else: ?>未ログイン<?php endif; ?></td>
	</tr>
	<tr>
		<th>登録日</th>
		<td style='border: 1px #CDCDCD solid;text-align: center;'><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['c_member']['r_date']))) ? $this->_run_mod_handler('date_format', true, $_tmp, "%y-%m-%d") : smarty_modifier_date_format($_tmp, "%y-%m-%d")); ?>
</td>
	</tr>
	<tr>
		<th>生年月日</th>
		<td style='border: 1px #CDCDCD solid;text-align: center;'><?php if ($this->_tpl_vars['c_member']['birth_year']): ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['birth_year']); ?>
年<?php else: ?>&nbsp;<?php endif; ?><?php if ($this->_tpl_vars['c_member']['birth_month']): ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['birth_month']); ?>
月<?php else: ?>&nbsp;<?php endif; ?><?php if ($this->_tpl_vars['c_member']['birth_day']): ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['birth_day']); ?>
日<?php else: ?>&nbsp;<?php endif; ?></td>
	</tr>
	<?php $_from = $this->_tpl_vars['c_profile_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['prof']):
?>
	<tr>
		<th><?php echo smarty_modifier_t_escape($this->_tpl_vars['prof']['caption']); ?>
</th>
		<td style='border: 1px #CDCDCD solid;text-align: center;'><?php if ($this->_tpl_vars['prof']['form_type'] == checkbox): ?><?php echo smarty_modifier_t_implode(smarty_modifier_t_escape($this->_tpl_vars['c_member']['profile'][$this->_tpl_vars['prof']['name']]['value']), ", "); ?>
<?php else: ?><?php echo ((is_array($_tmp=((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['c_member']['profile'][$this->_tpl_vars['prof']['name']]['value']))) ? $this->_run_mod_handler('t_truncate', true, $_tmp, 60) : smarty_modifier_t_truncate($_tmp, 60)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
<?php endif; ?></td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
	<tr>
		<th>PCメールアドレス</th>
		<td style='border: 1px #CDCDCD solid;text-align: center;'><?php if ($this->_tpl_vars['c_member']['secure']['pc_address']): ?><a href="mailto:<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['c_member']['secure']['pc_address']))) ? $this->_run_mod_handler('escape', true, $_tmp, 'hexentity') : smarty_modifier_escape($_tmp, 'hexentity')); ?>
"><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['c_member']['secure']['pc_address']))) ? $this->_run_mod_handler('escape', true, $_tmp, 'hexentity') : smarty_modifier_escape($_tmp, 'hexentity')); ?>
</a><?php else: ?>&nbsp;<?php endif; ?></td>
	</tr>

	<tr>
		<th>登録メールアドレス</th>
		<td style='border: 1px #CDCDCD solid;text-align: center;'><?php if ($this->_tpl_vars['c_member']['secure']['regist_address']): ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['secure']['regist_address']); ?>
<?php else: ?>&nbsp;<?php endif; ?></td>
	</tr>

	<tr>
		<th style="background-color:#6666FF;"><b>代理店値引きを設定する</b></th>
		<td style='border: 1px #CDCDCD solid;text-align: center;'>
			<form name="add_agency" method="POST" action="./">
			<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
			<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('add_agency','do')); ?>
" />
			<input type="hidden" name="page" value="c_member_detail" />
			<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
			<input type="hidden" name="c_member_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['c_member_id']); ?>
">
			値引き率：<input type="text" name="percent" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['agency_data']['percent']); ?>
" size=10> ％引き　
			備考：<input type="text" name="info" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['agency_data']['info']); ?>
" size=40>
			<input type="submit" value="代理店値引きに登録">
			</form>
		</td>
	</tr>

	<tr>
		<th style="background-color:#AA7700;"><b>固定ﾊﾞｰﾁｬﾙ口座番号を設定する</b></th>
		<td style='border: 1px #CDCDCD solid;text-align: center;'>

			<?php if ($this->_tpl_vars['vn']): ?>
				<form name="delete_virtual_account" method="POST" action="./">
				<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
				<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('delete_virtual_account','do')); ?>
" />
				<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
				<input type="hidden" name="c_member_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['c_member_id']); ?>
">
				<input type="hidden" name="vn" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['vn']); ?>
">
				バーチャル口座番号：【<?php echo smarty_modifier_t_escape($this->_tpl_vars['vn']); ?>
】　

				<?php if ($this->_tpl_vars['vn_flag']): ?>
					※ 使用中のため削除できません。
				<?php else: ?>
					<input type="submit" value="現在未使用のため削除できます">
				<?php endif; ?>
				</form>

			<?php else: ?>
			<form name="add_virtual_account" method="POST" action="./">
			<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
			<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('add_virtual_account','do')); ?>
" />
			<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
			<input type="hidden" name="c_member_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['c_member_id']); ?>
">
			

			<input type="submit" value="固定バーチャル口座番号を登録">
			</form>
			<?php endif; ?>
		</td>
	</tr>

	<tr>
		<th style="background-color:#FF5555;"><b>ブラックリストに追加する</b></th>
		<td style='border: 1px #CDCDCD solid;text-align: center;'>
<?php if ($this->_tpl_vars['blist']): ?>

	<a href="./?m=admin&a=page_blacklist">登録済みです</a>
<?php else: ?>
			<form name="add_blacklist" method="POST" action="./">
			<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
			<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('add_blacklist','do')); ?>
" />
			<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
			<input type="hidden" name="c_member_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['c_member_id']); ?>
">
			登録理由：<input type="text" name="info" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['info']); ?>
" size=80>
			<input type="submit" value="ブラックリストに登録">
			</form>
<?php endif; ?>
		</td>
	</tr>
	<tr>
		<th style="background-color:#558855;"><b>ゲスト解除</b></th>
		<td style='border: 1px #CDCDCD solid;text-align: center;'>
		<?php if ($this->_tpl_vars['c_member']['guest_flag']): ?>
			<form name="guest" method="POST" action="./">
			<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
			<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('change_guest_account','do')); ?>
" />
			<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
			<input type="hidden" name="c_member_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['c_member_id']); ?>
">
			<input type="submit" value="ゲストを解除する">
			</form>
			※ ゲストは一度解除すると元に戻せません。
		<?php else: ?>
			ゲストアカウントではありません。
		<?php endif; ?>
		</td>
	</tr>

	</tbody>
</table>

<p class="groupLing"><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('list_c_member')); ?>
" onClick="history.back(); return false;" onKeyPress="history.back(); return false;">メンバーリストに戻る</a></p>

<?php echo $this->_tpl_vars['inc_footer']; ?>
