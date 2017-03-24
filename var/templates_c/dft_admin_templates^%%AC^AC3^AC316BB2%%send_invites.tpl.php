<?php /* Smarty version 2.6.18, created on 2017-03-15 08:41:41
         compiled from file:D:%5CA_project%5Catoffice_kh/webapp/modules/admin/templates/send_invites.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ext_include', 'file:D:\\A_project\\atoffice_kh/webapp/modules/admin/templates/send_invites.tpl', 2, false),array('modifier', 't_escape', 'file:D:\\A_project\\atoffice_kh/webapp/modules/admin/templates/send_invites.tpl', 17, false),)), $this); ?>
<?php echo $this->_tpl_vars['inc_header']; ?>

<?php echo smarty_function_ext_include(array('file' => "inc_subnavi_adminSiteMember.tpl"), $this);?>

<?php $this->assign('page_name', "招待メール送信"); ?>
<?php echo smarty_function_ext_include(array('file' => "inc_tree_adminSiteMember.tpl"), $this);?>

</div>

<?php if ($this->_tpl_vars['atoffice_auth_type'] == 2 || $this->_tpl_vars['atoffice_auth_type'] == 4): ?>

<h2>招待メール送信</h2>
<div class="contents">
<?php if (@OPENPNE_REGIST_FROM == @OPENPNE_REGIST_FROM_NONE): ?>
<p>新規登録ができない設定になっているので送信できません。</p>
<?php else: ?>

<p class="info">入力されたメールアドレス宛に「<?php echo smarty_modifier_t_escape($this->_tpl_vars['SNS_NAME']); ?>
」への招待状を送信します。</p>
<ul class="caution" id="c01">
	<li>ID No.1のメンバーからの招待メールとして送信されます。</li>
	<li>既に登録済みのメールアドレスへは送信されません。</li>
	<li>一度に大量のメールアドレスを指定するとシステム側で送りきれない可能性があります。</li>
</ul>

<form action="./" method="post">
<input type="hidden" name="m" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['module_name']); ?>
" />
<input type="hidden" name="a" value="do_<?php echo smarty_modifier_t_escape($this->_tpl_vars['hash_tbl']->hash('send_invites','do')); ?>
" />
<input type="hidden" name="sessid" value="<?php echo smarty_modifier_t_escape($this->_tpl_vars['PHPSESSID']); ?>
" />
<dl>
<dt class="mails"><strong>メールアドレス</strong></dt>
<dd class="mails"><textarea cols="50" rows="8" name="mails"><?php echo smarty_modifier_t_escape($this->_tpl_vars['requests']['mails']); ?>
</textarea></dd>
<dd class="caution" id="c02">※複数のメールアドレス宛にメールを送信する場合は、改行で区切って入力してください。</dd>
<dt class="message"><strong>招待文</strong></dt>
<dd class="message"><textarea cols="60" rows="5" name="message"><?php echo smarty_modifier_t_escape($this->_tpl_vars['requests']['message']); ?>
</textarea></dd>
<?php if (@IS_GET_EASY_ACCESS_ID == 2 || @IS_GET_EASY_ACCESS_ID == 3): ?>
<dt><strong>携帯個体識別番号の登録</strong></dt>
<dd>
    <input type="radio" name="is_disable_regist_easy_access_id" value="0" <?php if ($this->_tpl_vars['requests']['is_disable_regist_easy_access_id'] === 0): ?> checked="checked" <?php endif; ?> />必須にする<br />
    <input type="radio" name="is_disable_regist_easy_access_id" value="1" <?php if ($this->_tpl_vars['requests']['is_disable_regist_easy_access_id'] !== 0): ?> checked="checked" <?php endif; ?> />必須にしない<br />
</dd>
<dd class="caution" id="c02">※「必須にしない」を選択して招待したメンバーは、携帯個体識別番号を登録しなくてもメンバー登録することができます。
<?php if (@IS_GET_EASY_ACCESS_ID == 2): ?><br />※携帯メールアドレスへの招待のみ適用されます。<?php endif; ?></dd>
<?php endif; ?>
</dl>
<p class="textBtn"><input type="submit" value="確認画面"></p>
</form>
<?php endif; ?>

<?php else: ?>
<br>
<center>
<span style="font-size: 16px; color: #FF0033;"><b>アクセス権がありません。</b></span>
</center>
<?php endif; ?>
<div>

<?php echo $this->_tpl_vars['inc_footer']; ?>
