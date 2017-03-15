<?php /* Smarty version 2.6.18, created on 2011-05-27 21:13:54
         compiled from file:/var/www/atoffice/webapp/modules/ktai/templates/o_password_query.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 't_escape', 'file:/var/www/atoffice/webapp/modules/ktai/templates/o_password_query.tpl', 2, false),array('function', 't_form', 'file:/var/www/atoffice/webapp/modules/ktai/templates/o_password_query.tpl', 11, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_ktai_header']; ?>

<table width="100%"><tr><td align="center" bgcolor="#<?php echo smarty_modifier_t_escape($this->_tpl_vars['ktai_color_config']['bg_02']); ?>
">
<font color="#<?php echo smarty_modifier_t_escape($this->_tpl_vars['ktai_color_config']['font_05']); ?>
"><a name="top">ﾊﾟｽﾜｰﾄﾞ再設定</a></font><br>
</td></tr></table>
ﾊﾟｽﾜｰﾄﾞ再設定用URLを携帯ﾒｰﾙｱﾄﾞﾚｽに送信します。<br>

<?php if ($this->_tpl_vars['msg']): ?>
<font color="#<?php echo smarty_modifier_t_escape($this->_tpl_vars['ktai_color_config']['font_09']); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</font><br>
<?php endif; ?>

<?php echo smarty_function_t_form(array('m' => 'ktai','a' => 'do_o_password_query'), $this);?>

<font color="#<?php echo smarty_modifier_t_escape($this->_tpl_vars['ktai_color_config']['font_06']); ?>
">携帯ﾒｰﾙｱﾄﾞﾚｽ：</font><br>
<textarea name="ktai_address" rows="1" istyle="3" mode="alphabet"></textarea><br>
<br>
<?php if (@IS_PASSWORD_QUERY_ANSWER): ?>
<font color="#<?php echo smarty_modifier_t_escape($this->_tpl_vars['ktai_color_config']['font_06']); ?>
">秘密の質問：</font><br>
<select name="c_password_query_id">
<option value="0">選択してください
<?php $_from = $this->_tpl_vars['password_query_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<option value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['key']); ?>
"><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>

<?php endforeach; endif; unset($_from); ?>
</select><br>
<br>
<font color="#<?php echo smarty_modifier_t_escape($this->_tpl_vars['ktai_color_config']['font_06']); ?>
">秘密の質問の答え：</font><br>
<input type="text" name="password_query_answer" value=""><br>
<?php endif; ?>
<center>
<input type="submit" value="送信"><br>
</center>
</form>

<?php echo $this->_tpl_vars['inc_ktai_footer']; ?>
