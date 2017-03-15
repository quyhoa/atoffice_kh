<?php /* Smarty version 2.6.18, created on 2011-05-27 21:00:50
         compiled from file:/var/www/atoffice/webapp/modules/ktai/templates/o_login.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 't_img_url_skin', 'file:/var/www/atoffice/webapp/modules/ktai/templates/o_login.tpl', 10, false),array('function', 't_form', 'file:/var/www/atoffice/webapp/modules/ktai/templates/o_login.tpl', 36, false),array('function', 't_url', 'file:/var/www/atoffice/webapp/modules/ktai/templates/o_login.tpl', 45, false),array('modifier', 't_escape', 'file:/var/www/atoffice/webapp/modules/ktai/templates/o_login.tpl', 10, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_ktai_header']; ?>


<?php if ($this->_tpl_vars['inc_ktai_entry_point'][1]): ?>
<?php echo $this->_tpl_vars['inc_ktai_entry_point'][1]; ?>

<?php endif; ?>

<table width="100%">
<?php if (@OPENPNE_USE_KTAI_LOGO): ?>
<tr><td align="center">
<img src="<?php echo smarty_function_t_img_url_skin(array('filename' => 'skin_ktai_header','f' => 'jpg'), $this);?>
" alt="<?php echo smarty_modifier_t_escape(@SNS_NAME); ?>
"><br>
</td></tr>
<?php else: ?>
<tr><td align="center" bgcolor="#<?php echo smarty_modifier_t_escape($this->_tpl_vars['ktai_color_config']['bg_02']); ?>
">
<font color="#<?php echo smarty_modifier_t_escape($this->_tpl_vars['ktai_color_config']['font_05']); ?>
"><?php echo smarty_modifier_t_escape(@SNS_NAME); ?>
</font><br>
</td></tr>
<?php endif; ?>
</table>
<?php if ($this->_tpl_vars['inc_ktai_entry_point'][2]): ?>
<?php echo $this->_tpl_vars['inc_ktai_entry_point'][2]; ?>

<?php endif; ?>
<br>
<center>
このﾍﾟｰｼﾞをﾌﾞｯｸﾏｰｸしてください<br>
<?php if ($this->_tpl_vars['msg']): ?>
<br>
<font color="#<?php echo smarty_modifier_t_escape($this->_tpl_vars['ktai_color_config']['font_09']); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</font><br>
<?php endif; ?>
</center>
<br>
<table width="100%"><tr><td bgcolor="#<?php echo smarty_modifier_t_escape($this->_tpl_vars['ktai_color_config']['bg_02']); ?>
">
[i:75]<font color="#<?php echo smarty_modifier_t_escape($this->_tpl_vars['ktai_color_config']['font_05']); ?>
">かんたんﾛｸﾞｲﾝ</font><br>
</td></tr>
<tr><td bgcolor="#<?php echo smarty_modifier_t_escape($this->_tpl_vars['ktai_color_config']['bg_04']); ?>
">
<br>
<center>
<?php echo smarty_function_t_form(array('_attr' => 'utn','m' => 'ktai','a' => 'do_o_easy_login'), $this);?>

<input type="hidden" name="login_params" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['requests']['login_params']); ?>
">
<?php if ($this->_tpl_vars['ktai_address']): ?>
<input type="hidden" name="ktai_address" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['ktai_address']); ?>
">
<?php endif; ?>
<input type="submit" value="かんたんﾛｸﾞｲﾝ"><br>
</form>
</center>
<br>
<a href="<?php echo smarty_function_t_url(array('m' => 'ktai','a' => 'page_o_whatis_easy_login'), $this);?>
">&gt;&gt;かんたんﾛｸﾞｲﾝとは</a><br>
</td></tr></table>
<br>

<table width="100%"><tr><td bgcolor="#<?php echo smarty_modifier_t_escape($this->_tpl_vars['ktai_color_config']['bg_02']); ?>
">
<font color="#<?php echo smarty_modifier_t_escape($this->_tpl_vars['ktai_color_config']['font_05']); ?>
">[i:116]ﾊﾟｽﾜｰﾄﾞﾛｸﾞｲﾝ</font><br>
</td></tr>
<tr><td bgcolor="#<?php echo smarty_modifier_t_escape($this->_tpl_vars['ktai_color_config']['bg_04']); ?>
">
<?php echo smarty_function_t_form(array('m' => 'ktai','a' => 'do_o_login'), $this);?>

<input type="hidden" name="login_params" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['requests']['login_params']); ?>
">
<?php if ($this->_tpl_vars['ktai_address']): ?>
<input type="hidden" name="username" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['ktai_address']); ?>
">
<?php else: ?>
<?php if (@OPENPNE_AUTH_MODE == 'email'): ?>
<font color="#<?php echo smarty_modifier_t_escape($this->_tpl_vars['ktai_color_config']['bg_02']); ?>
">★</font>携帯ﾒｰﾙｱﾄﾞﾚｽ<br>
<?php else: ?>
<font color="#<?php echo smarty_modifier_t_escape($this->_tpl_vars['ktai_color_config']['bg_02']); ?>
">★</font>ﾛｸﾞｲﾝID<br>
<?php endif; ?>
<textarea name="username" rows="1" istyle="3" mode="alphabet"></textarea><br>
<?php endif; ?>
<font color="#<?php echo smarty_modifier_t_escape($this->_tpl_vars['ktai_color_config']['bg_02']); ?>
">★</font>ﾊﾟｽﾜｰﾄﾞ<br>
<input name="password" type="text" istyle="3" mode="alphabet" value=""><br>
<center>
<input name="submit" value="ﾛｸﾞｲﾝ" type="submit"><br>
</center>
</form>
<?php if ($this->_tpl_vars['ktai_address']): ?>
<a href="<?php echo smarty_function_t_url(array('m' => 'ktai','a' => 'page_o_login'), $this);?>
">&gt;&gt;携帯ﾒｰﾙｱﾄﾞﾚｽを入力</a><br>
<?php endif; ?>
<?php if (@OPENPNE_AUTH_MODE == 'slavepne'): ?>
<?php if (@SLAVEPNE_PASSWORD_QUERY_URL_KTAI): ?>
<a href="<?php echo smarty_modifier_t_escape(@SLAVEPNE_PASSWORD_QUERY_URL_KTAI); ?>
">&gt;&gt;ﾊﾟｽﾜｰﾄﾞを忘れた方</a><br>
<?php endif; ?>
<?php else: ?>
<a href="<?php echo smarty_function_t_url(array('m' => 'ktai','a' => 'page_o_password_query'), $this);?>
">&gt;&gt;ﾊﾟｽﾜｰﾄﾞを忘れた方</a><br>
<?php endif; ?>
</td></tr></table>
<br>
<?php if (@OPENPNE_AUTH_MODE == 'slavepne'): ?>
<?php if (@SLAVEPNE_SYOUTAI_URL_KTAI): ?>
<hr color="#<?php echo smarty_modifier_t_escape($this->_tpl_vars['ktai_color_config']['border_01']); ?>
">
■<a href="<?php echo smarty_modifier_t_escape(@SLAVEPNE_SYOUTAI_URL_KTAI); ?>
">新規登録について</a><br>
<?php endif; ?>
<?php elseif ($this->_tpl_vars['IS_CLOSED_SNS']): ?>
<hr color="#<?php echo smarty_modifier_t_escape($this->_tpl_vars['ktai_color_config']['border_01']); ?>
">
<?php echo smarty_modifier_t_escape($this->_tpl_vars['SNS_NAME']); ?>
は招待制のｿｰｼｬﾙﾈｯﾄﾜｰｷﾝｸﾞｻｰﾋﾞｽです。<br>
登録には<?php echo smarty_modifier_t_escape($this->_tpl_vars['SNS_NAME']); ?>
<?php if (@IS_USER_INVITE): ?>参加者<?php else: ?>管理者<?php endif; ?>からの招待が必要です。<br>
<?php elseif (! ( ( ( @OPENPNE_REGIST_FROM ) & ( @OPENPNE_REGIST_FROM_KTAI ) ) >> 1 )): ?>
<hr color="#<?php echo smarty_modifier_t_escape($this->_tpl_vars['ktai_color_config']['border_01']); ?>
">
新規登録はPCからおこなってください。<br>
<?php else: ?>
<hr color="#<?php echo smarty_modifier_t_escape($this->_tpl_vars['ktai_color_config']['border_01']); ?>
">
新規登録するには以下のﾘﾝｸから、本文を入力せずにﾒｰﾙを送信してください。<br>
<br>
<a href="mailto:<?php echo smarty_modifier_t_escape(@MAIL_ADDRESS_PREFIX); ?>
get@<?php echo smarty_modifier_t_escape(@MAIL_SERVER_DOMAIN); ?>
">[i:106]ﾒｰﾙで登録!</a><br>
<br>
※かならず利用規約に同意してから登録をおこなってください。<br>
※ﾄﾞﾒｲﾝ指定受信を設定されている方は、「<?php echo smarty_modifier_t_escape(@ADMIN_EMAIL); ?>
」からのﾒｰﾙを受信できるように指定してください。<br>

<hr color="#<?php echo smarty_modifier_t_escape($this->_tpl_vars['ktai_color_config']['border_01']); ?>
">
■<a href="<?php echo smarty_function_t_url(array('m' => 'ktai','a' => 'page_o_sns_kiyaku'), $this);?>
">利用規約</a><br>
<?php if (@OPENPNE_DISP_KTAI_SNS_PRIVACY): ?>
■<a href="<?php echo smarty_function_t_url(array('m' => 'ktai','a' => 'page_o_sns_privacy'), $this);?>
">ﾌﾟﾗｲﾊﾞｼｰﾎﾟﾘｼｰ</a><br>
<?php endif; ?>
<?php endif; ?>

<?php echo $this->_tpl_vars['inc_ktai_footer']; ?>
