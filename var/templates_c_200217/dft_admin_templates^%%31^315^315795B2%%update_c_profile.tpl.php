<?php /* Smarty version 2.6.18, created on 2016-12-19 04:24:36
         compiled from file:E:%5CA_project%5Catoffice/webapp/modules/admin/templates/update_c_profile.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:E:\\A_project\\atoffice/webapp/modules/admin/templates/update_c_profile.tpl', 2, false),array('modifier', 't_escape', 'file:E:\\A_project\\atoffice/webapp/modules/admin/templates/update_c_profile.tpl', 5, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminStatisticalInformation.tpl"), $this);?>


<?php $this->assign('parent_page_name', "顧客情報項目設定"); ?>
<?php ob_start(); ?>?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('edit_c_profile')); ?>
<?php $this->_smarty_vars['capture']['parent_page_url'] = ob_get_contents(); ob_end_clean(); ?>

<?php $this->assign('page_name', "顧客情報項目編集"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminStatisticalInformation.tpl"), $this);?>

</div>

<?php if ($this->_tpl_vars['atoffice_auth_type'] == 4): ?>

<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><?php endif; ?>
<h2>顧客情報項目編集</h2>
<div class="contents">

<form action="./" method="post">
<table class="basicType2">
<tr>
<th><input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" /><input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('update_c_profile','do')); ?>
" /><input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" /><input type="hidden" name="c_profile_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['requests']['c_profile_id']); ?>
" />項目名</th>
<td><input type="text" class="basic" name="caption" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_profile']['caption']); ?>
" size="30" /></td>
</tr>
<tr>
<th>識別名</th>
<td><input type="text" class="basic" name="name" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_profile']['name']); ?>
" size="20" />　<span class="caution">※半角英数 と _ のみ（数値のみも不可）</span></td>
</tr>
<tr>
<th>必須</th>
<td><input type="checkbox" name="is_required" value="1"<?php if ($this->_tpl_vars['c_profile']['is_required']): ?> checked="checked"<?php endif; ?> /></td>
</tr>
<tr>
<th>公開設定の選択</th>
<td>
<label><input type="radio" name="public_flag_edit" value="0"<?php if (! $this->_tpl_vars['c_profile']['public_flag_edit']): ?> checked="checked"<?php endif; ?> />固定</label>
<label><input type="radio" name="public_flag_edit" value="1"<?php if ($this->_tpl_vars['c_profile']['public_flag_edit']): ?> checked="checked"<?php endif; ?> />メンバー選択</label></td>
</tr>
<tr>
<th>公開設定<br>デフォルト値</th>
<td><select class="basic" name="public_flag_default">
<option value="public"<?php if ($this->_tpl_vars['c_profile']['public_flag_default'] == 'public'): ?> selected="selected"<?php endif; ?>>全員に公開</option>
<option value="friend"<?php if ($this->_tpl_vars['c_profile']['public_flag_default'] == 'friend'): ?> selected="selected"<?php endif; ?>><?php echo smarty_modifier_t_escape($this->_tpl_vars['WORD_MY_FRIEND']); ?>
まで公開</option>
<option value="private"<?php if ($this->_tpl_vars['c_profile']['public_flag_default'] == 'private'): ?> selected="selected"<?php endif; ?>>公開しない</option>
</select></td>
</tr>
<tr>
<th>並び順</th>
<td><input type="text" class="basic" name="sort_order" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_profile']['sort_order']); ?>
" size="10" /></td>
</tr>
<tr>
<th>新規登録</th>
<td>
<label><input type="radio" name="disp_regist" value="1"<?php if ($this->_tpl_vars['c_profile']['disp_regist']): ?> checked="checked"<?php endif; ?> />表示する</label>
<label><input type="radio" name="disp_regist" value="0"<?php if (! $this->_tpl_vars['c_profile']['disp_regist']): ?> checked="checked"<?php endif; ?> />表示しない</label></td>
</tr>
<tr>
<th>登録情報変更</th>
<td>
<label><input type="radio" name="disp_config" value="1"<?php if ($this->_tpl_vars['c_profile']['disp_config']): ?> checked="checked"<?php endif; ?> />表示する</label>
<label><input type="radio" name="disp_config" value="0"<?php if (! $this->_tpl_vars['c_profile']['disp_config']): ?> checked="checked"<?php endif; ?> />表示しない</label></td>
</tr>
<tr>
<th>メンバー検索</th>
<td>
<label><input type="radio" name="disp_search" value="1"<?php if ($this->_tpl_vars['c_profile']['disp_search']): ?> checked="checked"<?php endif; ?> />表示する</label>
<label><input type="radio" name="disp_search" value="0"<?php if (! $this->_tpl_vars['c_profile']['disp_search']): ?> checked="checked"<?php endif; ?> />表示しない</label></td>
</tr>
<tr>
<th>説明</th>
<td><input type="text" name="info" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_profile']['info']); ?>
" size="30"></td>
</tr>
<tr>
<th>フォームタイプ</th>
<td><select class="basic" name="form_type">
<option value="text"<?php if ($this->_tpl_vars['c_profile']['form_type'] == 'text'): ?> selected="selected"<?php endif; ?>>テキスト</option>
<option value="textlong"<?php if ($this->_tpl_vars['c_profile']['form_type'] == 'textlong'): ?> selected="selected"<?php endif; ?>>テキスト(長)</option>
<option value="textarea"<?php if ($this->_tpl_vars['c_profile']['form_type'] == 'textarea'): ?> selected="selected"<?php endif; ?>>テキスト(複数行)</option>
<option value="select"<?php if ($this->_tpl_vars['c_profile']['form_type'] == 'select'): ?> selected="selected"<?php endif; ?>>単一選択(プルダウン)</option>
<option value="radio"<?php if ($this->_tpl_vars['c_profile']['form_type'] == 'radio'): ?> selected="selected"<?php endif; ?>>単一選択(ラジオボタン)</option>
<option value="checkbox"<?php if ($this->_tpl_vars['c_profile']['form_type'] == 'checkbox'): ?> selected="selected"<?php endif; ?>>複数選択(チェックボックス)</option>
</select></td>
</tr>
<tr>
<td colspan="2" class="caution">以下の項目はフォームタイプが「テキスト」、「テキスト(長)」、「テキスト(複数行)」の場合のみ有効です。</td>
</tr>
<tr>
<th>入力値タイプ</th>
<td><select class="basic" name="val_type">
<option value="string"<?php if ($this->_tpl_vars['c_profile']['val_type'] == 'string'): ?> selected="selected"<?php endif; ?>>文字列</option>
<option value="int"<?php if ($this->_tpl_vars['c_profile']['val_type'] == 'int'): ?> selected="selected"<?php endif; ?>>数値</option>
<option value="regexp"<?php if ($this->_tpl_vars['c_profile']['val_type'] == 'regexp'): ?> selected="selected"<?php endif; ?>>正規表現</option>
</select></td>
</tr>
<tr>
<th>最小値&#xff5e;最大値</th>
<td><input type="text" class="basic" name="val_min" value="<?php if ($this->_tpl_vars['c_profile']['val_min'] != 0): ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['c_profile']['val_min']); ?>
<?php endif; ?>" size="10">&#xff5e;<input type="text" class="basic" name="val_max" value="<?php if ($this->_tpl_vars['c_profile']['val_max'] != 0): ?><?php echo smarty_modifier_t_escape($this->_tpl_vars['c_profile']['val_max']); ?>
<?php endif; ?>" size="10" /><br />
<span class="caution">※入力値タイプが「数値」の場合は数値の範囲、それ以外の場合は(半角の)文字数</span></td>
</tr>
<tr>
<th>正規表現</th>
<td><input type="text" class="basic" name="val_regexp" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['c_profile']['val_regexp']); ?>
" size="30" /><br />
<span class="caution">※入力値タイプで「正規表現」を選んだ場合のみ有効(PHPのPerl互換(PCRE)正規表現関数を使用)<br />例： /^[a-c]\d+$/</span></td>
</tr>
</table>
<p class="textBtn"><input type="submit" value="編集する" /></p>
</form>
<p class="groupLing"><a href="?m=<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
&amp;a=page_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('edit_c_profile')); ?>
">顧客情報項目設定へ戻る</a></p>

<?php else: ?>
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
<?php endif; ?>
<div>
<?php echo $this->_tpl_vars['inc_footer']; ?>

