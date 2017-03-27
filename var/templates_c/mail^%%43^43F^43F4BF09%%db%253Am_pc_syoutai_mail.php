<?php /* Smarty version 2.6.18, created on 2017-03-02 09:09:22
         compiled from db:m_pc_syoutai_mail */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 't_url_mail', 'db:m_pc_syoutai_mail', 23, false),)), $this); ?>
<?php echo $this->_tpl_vars['c_member']['nickname']; ?>
さんから <?php echo $this->_tpl_vars['SNS_NAME']; ?>
 の招待状が届いています
いらっしゃいませ！<?php echo $this->_tpl_vars['CATCH_COPY']; ?>
<?php echo $this->_tpl_vars['SNS_NAME']; ?>
 からのお知らせです。

<?php echo $this->_tpl_vars['SNS_NAME']; ?>
 へ会員登録へのご招待をさせていただきます。

<?php if ($this->_tpl_vars['invite_message']): ?>
―――― < <?php echo $this->_tpl_vars['c_member']['nickname']; ?>
さん >からあなたへのメッセージ ―――

<?php echo $this->_tpl_vars['invite_message']; ?>


―――――――――――――――――――――――――――――
<?php endif; ?>


■ <?php echo $this->_tpl_vars['SNS_NAME']; ?>
 に参加する
<?php if (@OPENPNE_AUTH_MODE == 'slavepne'): ?>
<?php if (@SLAVEPNE_SYOUTAI_URL_PC): ?>
<?php echo @SLAVEPNE_SYOUTAI_URL_PC; ?>

<?php else: ?>
<?php echo @SLAVEPNE_SYOUTAI_URL_KTAI; ?>

<?php endif; ?>
<?php else: ?>
<?php echo smarty_function_t_url_mail(array('m' => 'pc','a' => 'page_o_ri'), $this);?>
&sid=<?php echo $this->_tpl_vars['sid']; ?>

<?php endif; ?>


◆メッセージの相手に覚えがない方へ
あなたがメッセージの相手に覚えがない場合、メールアドレスを
間違えて送信されている可能性がございます。そのような場合、
大変お手数ではございますが下記メールアドレスまでご連絡ください。

<?php echo $this->_tpl_vars['ADMIN_EMAIL']; ?>



<?php echo $this->_tpl_vars['inc_signature']; ?>
