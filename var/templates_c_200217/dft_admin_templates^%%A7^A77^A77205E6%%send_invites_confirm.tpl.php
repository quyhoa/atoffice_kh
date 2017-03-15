<?php /* Smarty version 2.6.18, created on 2017-01-06 02:08:01
         compiled from file:/var/www/html/atoffice/webapp/modules/admin/templates/send_invites_confirm.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/send_invites_confirm.tpl', 2, false),array('modifier', 't_escape', 'file:/var/www/html/atoffice/webapp/modules/admin/templates/send_invites_confirm.tpl', 20, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminSiteMember.tpl"), $this);?>

<?php $this->assign('page_name', "招待メール送信"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminSiteMember.tpl"), $this);?>

</div>


<h2>招待メール送信確認</h2>
<div class="contents">

<?php if ($this->_tpl_vars['requests']['pc_mails']): ?>
<?php if (! ( ( @OPENPNE_REGIST_FROM ) & ( @OPENPNE_REGIST_FROM_PC ) )): ?>
PCからは登録できない設定になっています。<br>
<div class="caution">※以下のメールアドレスには送信されません</div>
<?php else: ?>
<dl class="invitesAdd">
	<dt><strong>【PCメールアドレス】</strong></dt>
<?php endif; ?>
<dd><?php $_from = $this->_tpl_vars['requests']['pc_mails']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['pm'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['pm']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['pm']['iteration']++;
?><strong><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
</strong><?php if (! ($this->_foreach['pm']['iteration'] == $this->_foreach['pm']['total'])): ?>&nbsp;／&nbsp;<?php endif; ?><?php endforeach; endif; unset($_from); ?></dd>
</dl>
<?php endif; ?>
<?php if ($this->_tpl_vars['requests']['ktai_mails']): ?>
<?php if (! ( ( @OPENPNE_REGIST_FROM ) & ( @OPENPNE_REGIST_FROM_KTAI ) )): ?>
携帯からは登録できない設定になっています。<br>
<div class="caution">※以下のメールアドレスには送信されません</div>
<?php else: ?>
<dl class="invitesAdd">
	<dt><strong>【携帯メールアドレス】</strong></dt>
<?php endif; ?>
	<dd><?php $_from = $this->_tpl_vars['requests']['ktai_mails']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['km'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['km']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['km']['iteration']++;
?><strong><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
</strong><?php if (! ($this->_foreach['km']['iteration'] == $this->_foreach['km']['total'])): ?>&nbsp;／&nbsp;<?php endif; ?><?php endforeach; endif; unset($_from); ?></dd>
</dl>
<?php endif; ?>
<?php if (@IS_GET_EASY_ACCESS_ID == 2 || @IS_GET_EASY_ACCESS_ID == 3): ?>
<dl class="invitesAdd">
    <dt><strong>【携帯個体識別番号の登録】</strong></dt>
    <?php if ($this->_tpl_vars['requests']['is_disable_regist_easy_access_id']): ?>
    <dd><strong>必須にしない</strong></dd>
    <?php else: ?>
    <dd><strong>必須にする</strong></dd>
    <?php endif; ?>
</dl>
<?php if (@IS_GET_EASY_ACCESS_ID == 2): ?>
<div class="caution">※携帯メールアドレスへの招待のみ適用されます。</div>
<?php endif; ?>
<?php endif; ?>
<?php if ($this->_tpl_vars['requests']['registered_mails']): ?>
<dl class="invitesAdd warning">
	<dt><strong>以下のメールアドレスは登録済みのため送信されません。</strong></dt>
	<dd><?php $_from = $this->_tpl_vars['requests']['registered_mails']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['em'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['em']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['em']['iteration']++;
?><strong><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
</strong><?php if (! ($this->_foreach['em']['iteration'] == $this->_foreach['em']['total'])): ?>&nbsp;／&nbsp;<?php endif; ?><?php endforeach; endif; unset($_from); ?></dd>
</dl>
<?php endif; ?>

<?php if ($this->_tpl_vars['requests']['error_mails']): ?>
<dl class="invitesAdd warning">
	<dt><strong>不正なメールアドレスです。</strong></dt>
	<dd><?php $_from = $this->_tpl_vars['requests']['error_mails']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['em'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['em']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['em']['iteration']++;
?><strong><?php echo smarty_modifier_t_escape($this->_tpl_vars['item']); ?>
</strong><?php if (! ($this->_foreach['em']['iteration'] == $this->_foreach['em']['total'])): ?>&nbsp;／&nbsp;<?php endif; ?><?php endforeach; endif; unset($_from); ?></dd>
</dl>
<?php endif; ?>

<?php if (! $this->_tpl_vars['cannot_send']): ?>
<p class="caution" id="c02">送信してもよろしいですか？</p>
<?php endif; ?>
<form action="./" method="post">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('send_invites','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<input type="hidden" name="mails" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['requests']['mails']); ?>
" />
<input type="hidden" name="message" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['requests']['message']); ?>
" />
<input type="hidden" name="is_disable_regist_easy_access_id" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['requests']['is_disable_regist_easy_access_id']); ?>
" />
<?php if (! $this->_tpl_vars['cannot_send']): ?><p class="textBtn"><input name="complete" type="submit" value="送信する"></p><?php endif; ?><p class="textBtn"><input name="input" type="submit" value="修正する"></p>
</form>
<br class="clear" />
<?php if ($this->_tpl_vars['pc_subject'] || $this->_tpl_vars['ktai_subject']): ?>
<h3>招待メール内容確認<span>(※変更はできません)</span></h3>

<?php if ($this->_tpl_vars['pc_subject']): ?>
<h4>【PC向け】</h4>
<dl class="invitesDetail">
<dt><strong>件名</strong></dt>
<dd><?php echo smarty_modifier_t_escape($this->_tpl_vars['pc_subject']); ?>
</dd>
<dt><strong>本文</strong></dt>
<dd><textarea rows="10" cols="72" readonly="readonly"><?php echo smarty_modifier_t_escape($this->_tpl_vars['pc_body']); ?>
</textarea></dd>
</dl>
<?php endif; ?>
<?php if ($this->_tpl_vars['ktai_subject']): ?>
<h4>【携帯向け】</h4>
<dl class="invitesDetail">
<dt><strong>件名</strong></dt>
<dd><?php echo smarty_modifier_t_escape($this->_tpl_vars['ktai_subject']); ?>
</dd>
<dt><strong>本文</strong></dt>
<dd><textarea rows="10" cols="72" readonly="readonly"><?php echo smarty_modifier_t_escape($this->_tpl_vars['ktai_body']); ?>
</textarea></dd>
</dl>

<?php endif; ?>
<?php endif; ?>

<?php echo $this->_tpl_vars['inc_footer']; ?>
