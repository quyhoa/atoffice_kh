<?php /* Smarty version 2.6.18, created on 2016-11-07 12:55:53
         compiled from db:m_pc_password_reset_query */ ?>
【<?php echo $this->_tpl_vars['SNS_NAME']; ?>
】パスワード再設定用URL発行のお知らせ
<?php echo $this->_tpl_vars['c_member']['nickname']; ?>
さん、こんにちは。
<?php echo $this->_tpl_vars['CATCH_COPY']; ?>
<?php echo $this->_tpl_vars['SNS_NAME']; ?>
 からのお知らせです。

パスワード再設定の要求を受け付けました。

<?php if ($this->_tpl_vars['login_id']): ?>ログインID : <?php echo $this->_tpl_vars['login_id']; ?>

<?php endif; ?>
メールアドレス : <?php echo $this->_tpl_vars['pc_address']; ?>


下記の URL にアクセスし、パスワードの再設定をおこなってください。

<?php echo $this->_tpl_vars['password_reset_url']; ?>


<?php echo $this->_tpl_vars['SNS_NAME']; ?>
のログインページ
<?php echo $this->_tpl_vars['OPENPNE_URL']; ?>


今後とも、ぜひ、<?php echo $this->_tpl_vars['SNS_NAME']; ?>
をご活用ください。


<?php echo $this->_tpl_vars['inc_signature']; ?>
