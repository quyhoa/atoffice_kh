<?php /* Smarty version 2.6.18, created on 2011-05-27 06:19:16
         compiled from file:/var/www/atoffice/webapp/modules/ktai/templates/o_whatis_easy_login.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 't_escape', 'file:/var/www/atoffice/webapp/modules/ktai/templates/o_whatis_easy_login.tpl', 2, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_ktai_header']; ?>

<table width="100%"><tr><td align="center" bgcolor="#<?php echo smarty_modifier_t_escape($this->_tpl_vars['ktai_color_config']['bg_02']); ?>
">
<font color="#<?php echo smarty_modifier_t_escape($this->_tpl_vars['ktai_color_config']['font_05']); ?>
"><a name="top">かんたんﾛｸﾞｲﾝ設定</a></font><br>
</td></tr>
<tr><td bgcolor="#<?php echo smarty_modifier_t_escape($this->_tpl_vars['ktai_color_config']['bg_03']); ?>
" align="center">
<font color="#<?php echo smarty_modifier_t_escape($this->_tpl_vars['ktai_color_config']['color_24']); ?>
">かんたんﾛｸﾞｲﾝとは</font><br>
</td></tr></table>
かんたんﾛｸﾞｲﾝとは、携帯端末の個体識別番号(*)を利用して、毎回ﾊﾟｽﾜｰﾄﾞを入力しなくてもﾛｸﾞｲﾝできる機能です。<br>
<br>
(*)電話番号などの個人情報は含まれません。<br>
<br>
設定は通常ﾛｸﾞｲﾝ後、「設定変更」→「かんたんﾛｸﾞｲﾝ設定」からおこなってください。<br>
設定後はﾎﾞﾀﾝ一つでかんたんにﾛｸﾞｲﾝすることができます。<br>
<br>
<font color="#<?php echo smarty_modifier_t_escape($this->_tpl_vars['ktai_color_config']['font_06']); ?>
">※一部機種では携帯の個体識別番号を送信できないためご利用になれません｡</font>
<?php echo $this->_tpl_vars['inc_ktai_footer']; ?>
