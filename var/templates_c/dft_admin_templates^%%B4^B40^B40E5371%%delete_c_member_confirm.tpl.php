<?php /* Smarty version 2.6.18, created on 2017-03-02 09:08:54
         compiled from file:/var/www/html/atoffice/webapp/modules/admin/templates/delete_c_member_confirm.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/delete_c_member_confirm.tpl', 2, false),array('function', 't_img_url', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/delete_c_member_confirm.tpl', 26, false),array('function', 't_url', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/delete_c_member_confirm.tpl', 35, false),array('modifier', 't_escape', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/delete_c_member_confirm.tpl', 5, false),array('modifier', 'date_format', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/delete_c_member_confirm.tpl', 39, false),array('modifier', 't_implode', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/delete_c_member_confirm.tpl', 53, false),array('modifier', 't_truncate', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/delete_c_member_confirm.tpl', 53, false),array('modifier', 'nl2br', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/delete_c_member_confirm.tpl', 53, false),array('modifier', 'escape', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/delete_c_member_confirm.tpl', 59, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminSiteMember.tpl"), $this);?>

<?php $this->assign('page_name', "強制退会の確認"); ?>
<?php $this->assign('parent_page_name', "メンバーリスト"); ?>
<?php ob_start(); ?>?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('list_c_member')); ?>
<?php $this->_smarty_vars['capture']['parent_page_url'] = ob_get_contents(); ob_end_clean(); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminSiteMember.tpl"), $this);?>

</div>


<h2 id="ttl01">強制退会の確認</h2>
<div class="contents">
<p class="caution" id="c01">本当にこのメンバーを強制退会させてもよろしいですか？</p>
<ul class="cautionList">
    <li class="caution" ><strong>※強制退会させると、このメンバーに関する情報は削除され元に戻すことはできません。</strong></li>
    <li class="caution" ><strong>※このメンバーが管理者になっている<?php echo smarty_modifier_t_escape($this->_tpl_vars['WORD_COMMUNITY']); ?>
があれば、副管理者に管理権限が移管されます。また、副管理者がいない場合は参加日時のもっとも早いメンバーに権限が移管されます。</strong></li>
</ul>

<form action="./" method="post">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('delete_c_member','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<input type="hidden" name="target_c_member_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['c_member_id']); ?>
" />
<p class="textBtn"><input type="submit" value="強制退会させる" /></p>
</form>
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
		<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['c_member_id']); ?>
</td>
	</tr>
	<tr>
		<th><?php echo smarty_modifier_t_escape($this->_tpl_vars['WORD_NICKNAME']); ?>
</th>
		<td><a href="<?php echo smarty_function_t_url(array('m' => 'pc','a' => 'page_f_home'), $this);?>
&amp;target_c_member_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['c_member_id']); ?>
" target="_blank"><?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['nickname']); ?>
</a></td>
	</tr>
	<tr>
		<th>最終ログイン</th>
		<td><?php if ($this->_tpl_vars['c_member']['access_date'] != '0000-00-00 00:00:00'): ?><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['c_member']['access_date']))) ? $this->_run_mod_handler('date_format', true, $_tmp, "%y-%m-%d %H:%M") : smarty_modifier_date_format($_tmp, "%y-%m-%d %H:%M")); ?>
<?php else: ?>未ログイン<?php endif; ?></td>
	</tr>
	<tr>
		<th>登録日</th>
		<td><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['c_member']['r_date']))) ? $this->_run_mod_handler('date_format', true, $_tmp, "%y-%m-%d") : smarty_modifier_date_format($_tmp, "%y-%m-%d")); ?>
</td>
	</tr>
	<tr>
		<th>生年月日</th>
		<td><?php if ($this->_tpl_vars['c_member']['birth_year']): ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['birth_year']); ?>
年<?php else: ?>&nbsp;<?php endif; ?><?php if ($this->_tpl_vars['c_member']['birth_month']): ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['birth_month']); ?>
月<?php else: ?>&nbsp;<?php endif; ?><?php if ($this->_tpl_vars['c_member']['birth_day']): ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['birth_day']); ?>
日<?php else: ?>&nbsp;<?php endif; ?></td>
	</tr>
	<?php $_from = $this->_tpl_vars['c_profile_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['prof']):
?>
	<?php if ($this->_tpl_vars['item']['value'] !== ''): ?>
	<tr>
		<th><?php echo smarty_modifier_t_escape($this->_tpl_vars['prof']['caption']); ?>
</th>
		<td><?php if ($this->_tpl_vars['prof']['form_type'] == checkbox): ?><?php echo smarty_modifier_t_implode(smarty_modifier_t_escape($this->_tpl_vars['c_member']['profile'][$this->_tpl_vars['prof']['name']]['value']), ", "); ?>
<?php else: ?><?php echo ((is_array($_tmp=((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['c_member']['profile'][$this->_tpl_vars['prof']['name']]['value']))) ? $this->_run_mod_handler('t_truncate', true, $_tmp, 60) : smarty_modifier_t_truncate($_tmp, 60)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
<?php endif; ?></td>
	</tr>
	<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	<tr>
		<th>PCメールアドレス</th>
		<td><?php if ($this->_tpl_vars['c_member']['secure']['pc_address']): ?><a href="mailto:<?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['c_member']['secure']['pc_address']))) ? $this->_run_mod_handler('escape', true, $_tmp, 'hexentity') : smarty_modifier_escape($_tmp, 'hexentity')); ?>
"><?php echo ((is_array($_tmp=smarty_modifier_t_escape($this->_tpl_vars['c_member']['secure']['pc_address']))) ? $this->_run_mod_handler('escape', true, $_tmp, 'hexentity') : smarty_modifier_escape($_tmp, 'hexentity')); ?>
</a><?php else: ?>&nbsp;<?php endif; ?></td>
	</tr>
	<tr>
		<th>携帯メールアドレス</th>
		<td><?php if ($this->_tpl_vars['c_member']['secure']['ktai_address']): ?><a href="mailto:<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['secure']['ktai_address']); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['secure']['ktai_address']); ?>
</a><?php else: ?>&nbsp;<?php endif; ?></td>
	</tr>
	<tr>
		<th>登録メールアドレス</th>
		<td><?php if ($this->_tpl_vars['c_member']['secure']['regist_address']): ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['c_member']['secure']['regist_address']); ?>
<?php else: ?>&nbsp;<?php endif; ?></td>
	</tr>
	</tbody>
</table>
<p class="groupLing"><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('list_c_member')); ?>
" onClick="history.back(); return false;" onKeyPress="history.back(); return false;">メンバーリストに戻る</a></p>
<?php echo $this->_tpl_vars['inc_footer']; ?>
