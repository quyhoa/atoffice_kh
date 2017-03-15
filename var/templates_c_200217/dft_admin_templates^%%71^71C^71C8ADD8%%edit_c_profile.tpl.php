<?php /* Smarty version 2.6.18, created on 2016-12-13 09:51:14
         compiled from file:E:%5CA_project%5Catoffice/webapp/modules/admin/templates/edit_c_profile.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:E:\\A_project\\atoffice/webapp/modules/admin/templates/edit_c_profile.tpl', 2, false),array('function', 'counter', 'file:E:\\A_project\\atoffice/webapp/modules/admin/templates/edit_c_profile.tpl', 99, false),array('modifier', 't_escape', 'file:E:\\A_project\\atoffice/webapp/modules/admin/templates/edit_c_profile.tpl', 12, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminStatisticalInformation.tpl"), $this);?>


<?php $this->assign('page_name', "顧客情報項目設定"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminStatisticalInformation.tpl"), $this);?>

</div>

<?php if ($this->_tpl_vars['atoffice_auth_type'] == 4): ?>

<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><?php endif; ?>
<h2>顧客情報項目設定</h2>
<div class="contents">
<h3 class="item" id="ttl01">顧客情報項目一覧</h3>
<p id="itemAdd"><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('insert_c_profile')); ?>
">顧客情報項目追加</a></p>

<form action="./" method="post">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('update_profile_sort_order','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />

<table class="basicType2" id="itemList">
<thead>
<tr>
<th colspan="2">操作</th>
<th>ID</th>
<th>項目名</th>
<th>識別名</th>
<th>必須</th>
<th>公開設定<br />変更の可否</th>
<th>公開設定<br />デフォルト値</th>
<th>フォームタイプ</th>
<th>並び順<br />(昇順)</th>
<th>選択肢</th>
<th>登録</th>
<th>変更</th>
<th>検索</th>
</tr>
</thead>
<tbody>
<?php ob_start(); ?>
<tr class="default">
<td class="cell01A">&nbsp;</td>
<td class="cell01B">&nbsp;</td>
<td class="cell02">-</td>
<td class="cell03"><?php echo smarty_modifier_t_escape($this->_tpl_vars['WORD_NICKNAME']); ?>
</td>
<td class="cell04">&nbsp;</td>
<td class="cell05">○</td>
<td class="cell06">×</td>
<td class="cell07">全員に公開</td>
<td class="cell08">テキスト</td>
<td class="cell09"><input type="text" class="basic" name="sort_order_nick" size="5" value="<?php echo smarty_modifier_t_escape(@SORT_ORDER_NICK); ?>
" /></td>
<td class="cell10">&nbsp;</td>
<td class="cell11">○</td>
<td class="cell12">○</td>
<td class="cell13">○</td>
</tr>
<?php $this->_smarty_vars['capture']['nick'] = ob_get_contents(); ob_end_clean(); ?>
<?php ob_start(); ?>
<tr class="default">
<td class="cell01A">&nbsp;</td>
<td class="cell01B">&nbsp;</td>
<td class="cell02">-</td>
<td class="cell03">生まれた年</td>
<td class="cell04">&nbsp;</td>
<td class="cell05">○</td>
<td class="cell06">○</td>
<td class="cell07">全員に公開</td>
<td class="cell08">テキスト</td>
<td class="cell09" rowspan="2"><input type="text" class="basic" name="sort_order_birth" size="5" value="<?php echo smarty_modifier_t_escape(@SORT_ORDER_BIRTH); ?>
" /></td>
<td class="cell10">&nbsp;</td>
<td class="cell11">○</td>
<td class="cell12">○</td>
<td class="cell13">○</td>
</tr>
<tr class="default">
<td class="cell01A">&nbsp;</td>
<td class="cell01B">&nbsp;</td>
<td class="cell02">-</td>
<td class="cell03">誕生日</td>
<td class="cell04">&nbsp;</td>
<td class="cell05">○</td>
<td class="cell06">○</td>
<td class="cell07">全員に公開</td>
<td class="cell08">単一選択(プルダウン)</td>
<td class="cell09">&nbsp;</td>
<td class="cell11">○</td>
<td class="cell12">○</td>
<td class="cell13">○</td>
</tr>
<?php $this->_smarty_vars['capture']['birth'] = ob_get_contents(); ob_end_clean(); ?>

<?php $_from = $this->_tpl_vars['c_profile_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['prof'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['prof']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['prof']['iteration']++;
?>
<?php echo ''; ?><?php if (! smarty_modifier_t_escape($this->_tpl_vars['_cnt_nick']) && smarty_modifier_t_escape($this->_tpl_vars['item']['sort_order']) >= smarty_modifier_t_escape(@SORT_ORDER_NICK) && ! smarty_modifier_t_escape($this->_tpl_vars['_cnt_birth']) && smarty_modifier_t_escape($this->_tpl_vars['item']['sort_order']) >= smarty_modifier_t_escape(@SORT_ORDER_BIRTH)): ?><?php echo ''; ?><?php echo smarty_function_counter(array('assign' => '_cnt_nick'), $this);?><?php echo ''; ?><?php echo smarty_function_counter(array('assign' => '_cnt_birth'), $this);?><?php echo ''; ?><?php if (@SORT_ORDER_NICK > @SORT_ORDER_BIRTH): ?><?php echo ''; ?><?php echo $this->_smarty_vars['capture']['birth']; ?><?php echo ''; ?><?php echo $this->_smarty_vars['capture']['nick']; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo $this->_smarty_vars['capture']['nick']; ?><?php echo ''; ?><?php echo $this->_smarty_vars['capture']['birth']; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if (! $this->_tpl_vars['_cnt_nick'] && $this->_tpl_vars['item']['sort_order'] >= @SORT_ORDER_NICK): ?><?php echo ''; ?><?php echo smarty_function_counter(array('assign' => '_cnt_nick'), $this);?><?php echo ''; ?><?php echo $this->_smarty_vars['capture']['nick']; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if (! $this->_tpl_vars['_cnt_birth'] && $this->_tpl_vars['item']['sort_order'] >= @SORT_ORDER_BIRTH): ?><?php echo ''; ?><?php echo smarty_function_counter(array('assign' => '_cnt_birth'), $this);?><?php echo ''; ?><?php echo $this->_smarty_vars['capture']['birth']; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>

<tr>
<td class="cell01A"><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('update_c_profile')); ?>
&amp;c_profile_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_profile_id']); ?>
">変更</a></td>
<td class="cell01B"><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('delete_c_profile')); ?>
&amp;c_profile_id=<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_profile_id']); ?>
">削除</a></td>
<td class="cell02"><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_profile_id']); ?>
</td>
<td class="cell03"><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['caption']); ?>
</td>
<td class="cell04"><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['name']); ?>
</td>
<td class="cell05"><?php if ($this->_tpl_vars['item']['is_required']): ?>○<?php else: ?>×<?php endif; ?></td>
<td class="cell06"><?php if ($this->_tpl_vars['item']['public_flag_edit']): ?>○<?php else: ?>×<?php endif; ?></td>
<td class="cell07"><?php if ($this->_tpl_vars['item']['public_flag_default'] == 'private'): ?>公開しない<?php elseif ($this->_tpl_vars['item']['public_flag_default'] == 'friend'): ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['WORD_MY_FRIEND']); ?>
まで公開<?php else: ?>全員に公開<?php endif; ?></td>
<td class="cell08"><?php if ($this->_tpl_vars['item']['form_type'] == 'text'): ?>テキスト<?php elseif ($this->_tpl_vars['item']['form_type'] == 'textlong'): ?>テキスト(長)<?php elseif ($this->_tpl_vars['item']['form_type'] == 'textarea'): ?>テキスト(複数行)<?php elseif ($this->_tpl_vars['item']['form_type'] == 'select'): ?>単一選択(プルダウン)<?php elseif ($this->_tpl_vars['item']['form_type'] == 'radio'): ?>単一選択(ラジオボタン)<?php elseif ($this->_tpl_vars['item']['form_type'] == 'checkbox'): ?>複数選択(チェックボックス)<?php endif; ?></td>
<td class="cell09"><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['sort_order']); ?>
</td>
<td class="cell10"><?php if ($this->_tpl_vars['item']['form_type'] == 'select' || $this->_tpl_vars['item']['form_type'] == 'checkbox' || $this->_tpl_vars['item']['form_type'] == 'radio'): ?><a href="#opt_<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['name']); ?>
">一覧</a><?php else: ?>&nbsp;<?php endif; ?></td>
<td class="cell11"><?php if ($this->_tpl_vars['item']['disp_regist']): ?>○<?php else: ?>×<?php endif; ?></td>
<td class="cell12"><?php if ($this->_tpl_vars['item']['disp_config']): ?>○<?php else: ?>×<?php endif; ?></td>
<td class="cell13"><?php if ($this->_tpl_vars['item']['disp_search']): ?>○<?php else: ?>×<?php endif; ?></td>
</tr>
<?php endforeach; endif; unset($_from); ?>

<?php if (! $this->_tpl_vars['_cnt_nick'] && ! $this->_tpl_vars['_cnt_birth']): ?>
<?php if (@SORT_ORDER_NICK > @SORT_ORDER_BIRTH): ?>
<?php echo $this->_smarty_vars['capture']['birth']; ?>

<?php echo $this->_smarty_vars['capture']['nick']; ?>

<?php else: ?>
<?php echo $this->_smarty_vars['capture']['nick']; ?>

<?php echo $this->_smarty_vars['capture']['birth']; ?>

<?php endif; ?>
<?php else: ?>
<?php if (! $this->_tpl_vars['_cnt_nick']): ?><?php echo $this->_smarty_vars['capture']['nick']; ?>
<?php endif; ?>
<?php if (! $this->_tpl_vars['_cnt_birth']): ?><?php echo $this->_smarty_vars['capture']['birth']; ?>
<?php endif; ?>
<?php endif; ?>

<tr>
<td colspan="9">&nbsp;</td>
<td class="cell09"><span class="textBtnS"><input type="submit" value="　変　更　" /></span></td>
<td colspan="4">&nbsp;</td
></tr>
</table>
</form>

<h3 class="item" id="ttl02">プロフィール選択肢一覧</h3>
<ul class="caution" id="c01">
	<li>一項目ずつしか変更できません。</li>
	<li>選択肢を削除するとその選択肢を選択していたメンバーの値が(たとえ必須項目であっても)空になります。</li>
</ul>

<?php $_from = $this->_tpl_vars['c_profile_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<?php if ($this->_tpl_vars['item']['form_type'] == 'select' || $this->_tpl_vars['item']['form_type'] == 'checkbox' || $this->_tpl_vars['item']['form_type'] == 'radio'): ?>

<h4><a name="opt_<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['name']); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['caption']); ?>
</a></h4>

<table class="basicType2">
<tr>
<th>ID</th>
<th>項目名</th>
<th>並び順</th>
<th colspan="2">操作</th>
</tr>
<?php $_from = $this->_tpl_vars['item']['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['option']):
?>
<tr>
<form action="./" method="post">
<td><?php echo smarty_modifier_t_escape($this->_tpl_vars['option']['c_profile_option_id']); ?>
</td>
<td>
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('update_c_profile_option','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<input type="hidden" name="c_profile_option_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['option']['c_profile_option_id']); ?>
" />
<input type="text" class="basic" name="value" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['option']['value']); ?>
" size="20" /></td>
<td><input type="text" class="basic" name="sort_order" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['option']['sort_order']); ?>
" size="5" /></td>
<td><span class="textBtnS"><input type="submit" value="　変　更　" /></span></td>
</form>
<form action="./" method="post">
<td>
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('delete_c_profile_option','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<input type="hidden" name="c_profile_option_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['option']['c_profile_option_id']); ?>
" />
<span class="textBtnS"><input type="submit" value="　削　除　" /></span>
</td>
</form>
</tr>
<?php endforeach; endif; unset($_from); ?>
<tr>
<form action="./" method="post">
<td>-</td>
<td>
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('insert_c_profile_option','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<input type="hidden" name="c_profile_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['item']['c_profile_id']); ?>
" />
<input type="text" class="basic" name="value" value="" size="20" /></td>
<td><input type="text" class="basic" name="sort_order" value="" size="5" /></td>
<td colspan="2"><span class="textBtnS"><input type="submit" value="項目追加" /></span></td>
</form>
</tr>
</table>

<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<?php else: ?>
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
<?php endif; ?>
<div>
<?php echo $this->_tpl_vars['inc_footer']; ?>

