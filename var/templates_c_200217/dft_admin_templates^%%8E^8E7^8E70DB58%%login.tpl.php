<?php /* Smarty version 2.6.18, created on 2016-12-29 07:51:03
         compiled from file:/var/www/html/atoffice/webapp/modules/admin/templates/login.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 't_escape', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/login.tpl', 2, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php if ($this->_tpl_vars['msg']): ?><p class="actionMsg"><?php echo smarty_modifier_t_escape($this->_tpl_vars['msg']); ?>
</p><?php endif; ?>

<div class="contents">

<p class="caution" id="c01">管理用のアカウント名とパスワードを入力してください。</p>

<form  action="./" method="post">
<dl>
<dt>
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('login','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<strong class="item"><label for="username">アカウント名</label></strong></dt>
<dd><input tabindex="1" name="username" id="username" type="text" class="basic" size="20" /></dd>
<dt><strong class="item"><label for="password">パスワード</label></strong></dt>
<dd><input tabindex="2" name="password" id="password" type="password" class="basic" size="20" /></dd>
<dd id="auto"><input tabindex="3" name="is_save" id="is_save" type="checkbox" value="1" /><label for="is_save">次回から自動的にログイン</label></dd>
<dd id="btn"><p class="textBtn"><input tabindex="4" type="submit" value="ログイン" /></p></dd>
</dl>
</form>
</div>
<?php echo $this->_tpl_vars['inc_footer']; ?>