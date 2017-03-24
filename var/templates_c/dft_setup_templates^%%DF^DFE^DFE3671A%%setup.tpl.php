<?php /* Smarty version 2.6.18, created on 2017-03-20 03:49:03
         compiled from file:D:%5CA_project%5Catoffice_kh/webapp/modules/setup/templates/setup.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:D:\\A_project\\atoffice_kh/webapp/modules/setup/templates/setup.tpl', 1, false),array('function', 't_form', 'file:D:\\A_project\\atoffice_kh/webapp/modules/setup/templates/setup.tpl', 20, false),array('modifier', 't_escape', 'file:D:\\A_project\\atoffice_kh/webapp/modules/setup/templates/setup.tpl', 15, false),)), $this); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_header.tpl"), $this);?>


<p>必ず下記の設定をおこなってからセットアップを実行してください。</p>
<ul>
<li>setup/sql/xxx/install/install-2.14-create_tables.sql の実行</li>
<li>setup/sql/xxx/install/install-2.14-insert_data.sql の実行</li>
<li>config.php の設定</li>
</ul>
<p>一度、セットアップを実行した後でこのページを表示することはできません。<br>
セットアップをやり直したい場合はデータベースを空にしてからこのページへアクセスしてください。</p>

<?php if ($this->_tpl_vars['errors']): ?>
<ul class="caution">
<?php $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<li><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
</li>
<?php endforeach; endif; unset($_from); ?>
</ul>
<?php endif; ?>

<?php echo smarty_function_t_form(array('m' => 'setup','a' => 'do_setup'), $this);?>


<table>
<tr>
<th colspan="2">SNS名</th>
</tr>
<tr>
<th>SNS名</th>
<td><input type="text" name="SNS_NAME" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['requests']['SNS_NAME']); ?>
" size="30"></td>
</tr>

<tr><td colspan="2" style="padding:0;background:#000"><img src="skin/dummy.gif" height="1"></td></tr>

<tr>
<th colspan="2">初期メンバー</th>
</tr>
<tr>
<td colspan="2" style="background-color: #ffc">初期メンバーのログイン情報の設定をします。<br>
プロフィールやその他の設定項目はログイン後に設定してください。</td>
</tr>
<tr>
<th>PCメールアドレス</th>
<td><input type="text" name="pc_address" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['requests']['pc_address']); ?>
" size="30"></td>
</tr>
<?php if (@OPENPNE_AUTH_MODE != 'email'): ?>
<tr>
<th>
ログインID
</th>
<td><input type="text" name="username" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['requests']['username']); ?>
" size="30"></td>
</tr>
<?php endif; ?>
<tr>
<th>パスワード</th>
<td><input type="password" name="password" value="" size="15"></td>
</tr>
<?php if (@OPENPNE_AUTH_MODE == 'email'): ?>
<tr>
<th>パスワード(確認)</th>
<td><input type="password" name="password2" value="" size="15"></td>
</tr>
<?php endif; ?>

<tr><td colspan="2" style="padding:0;background:#000"><img src="skin/dummy.gif" height="1"></td></tr>

<tr>
<th colspan="2">管理用アカウント</th>
</tr>
<tr>
<td colspan="2" style="background-color: #ffc">管理画面へのログイン用アカウントの設定をします。</td>
</tr>
<tr>
<th>管理用アカウント名</th>
<td><input type="text" name="admin_username" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['requests']['admin_username']); ?>
" size="20"></td>
</tr>
<tr>
<th>管理用パスワード</th>
<td><input type="password" name="admin_password" value="" size="15"></td>
</tr>
<tr>
<th>管理用パスワード(確認)</th>
<td><input type="password" name="admin_password2" value="" size="15"></td>
</tr>

<tr><td colspan="2" style="padding:0;background:#000"><img src="skin/dummy.gif" height="1"></td></tr>

<tr>
<th>&nbsp;</th>
<td><input type="submit" value="セットアップ実行"></td>
</tr>
</table>
</form>

<?php echo smarty_function_ext_include(array('file' => "inc_footer.tpl"), $this);?>
