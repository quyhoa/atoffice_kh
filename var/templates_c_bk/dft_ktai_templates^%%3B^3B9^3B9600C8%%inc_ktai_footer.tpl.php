<?php /* Smarty version 2.6.18, created on 2011-05-27 06:19:16
         compiled from file:/var/www/atoffice/webapp/modules/ktai/templates/inc_ktai_footer.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 't_escape', 'file:/var/www/atoffice/webapp/modules/ktai/templates/inc_ktai_footer.tpl', 3, false),array('function', 't_url', 'file:/var/www/atoffice/webapp/modules/ktai/templates/inc_ktai_footer.tpl', 5, false),)), $this); ?>
<?php if ($this->_tpl_vars['tail']): ?>
<table width="100%">
<tr><td align="center" bgcolor="#<?php echo smarty_modifier_t_escape($this->_tpl_vars['ktai_color_config']['bg_02']); ?>
">
<?php if ($this->_tpl_vars['page'] == 'h_home' || $this->_tpl_vars['page'] == 'f_home' || $this->_tpl_vars['page'] == 'c_home' || $this->_tpl_vars['page'] == 'h_prof'): ?>
<font color="#<?php echo smarty_modifier_t_escape($this->_tpl_vars['ktai_color_config']['font_05']); ?>
"><a href="<?php echo smarty_function_t_url(array('m' => 'ktai','a' => 'page_h_home'), $this);?>
&amp;<?php echo smarty_modifier_t_escape($this->_tpl_vars['tail']); ?>
#top" accesskey="0"><font color="#<?php echo smarty_modifier_t_escape($this->_tpl_vars['ktai_color_config']['font_05']); ?>
">[i:134]ﾎｰﾑ</font></a> / <a href="#top"><font color="#<?php echo smarty_modifier_t_escape($this->_tpl_vars['ktai_color_config']['font_05']); ?>
">↑上へ</font></a> / <a href="#bottom" name="bottom" accesskey="8"><font color="#<?php echo smarty_modifier_t_escape($this->_tpl_vars['ktai_color_config']['font_05']); ?>
">[i:132]下へ</font></a></font><br>
<?php else: ?>
<font color="#<?php echo smarty_modifier_t_escape($this->_tpl_vars['ktai_color_config']['font_05']); ?>
"><a href="<?php echo smarty_function_t_url(array('m' => 'ktai','a' => 'page_h_home'), $this);?>
&amp;<?php echo smarty_modifier_t_escape($this->_tpl_vars['tail']); ?>
#top" accesskey="0"><font color="#<?php echo smarty_modifier_t_escape($this->_tpl_vars['ktai_color_config']['font_05']); ?>
">[i:134]ﾎｰﾑ</font></a> / <a href="#top" accesskey="2"><font color="#<?php echo smarty_modifier_t_escape($this->_tpl_vars['ktai_color_config']['font_05']); ?>
">[i:126]上へ</font></a> / <a href="#bottom" name="bottom" accesskey="8"><font color="#<?php echo smarty_modifier_t_escape($this->_tpl_vars['ktai_color_config']['font_05']); ?>
">[i:132]下へ</font></a></font><br>
<?php endif; ?>
</td></tr></table>
<?php endif; ?>
<?php echo $this->_tpl_vars['inc_ktai_footer']; ?>

</body>
</html>