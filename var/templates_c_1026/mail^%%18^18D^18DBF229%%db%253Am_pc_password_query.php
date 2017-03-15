<?php /* Smarty version 2.6.18, created on 2016-10-26 15:39:01
         compiled from db:m_pc_password_query */ ?>
【<?php echo $this->_tpl_vars['SNS_NAME']; ?>
】パスワード再発行のお知らせ
<?php echo $this->_tpl_vars['c_member']['nickname']; ?>
さん、こんにちは。
<?php echo $this->_tpl_vars['CATCH_COPY']; ?>
<?php echo $this->_tpl_vars['SNS_NAME']; ?>
 からのお知らせです。

パスワードを再発行いたしました。

<?php if ($this->_tpl_vars['login_id']): ?>ログインID : <?php echo $this->_tpl_vars['login_id']; ?>

<?php endif; ?>
メールアドレス : <?php echo $this->_tpl_vars['pc_address']; ?>

パスワード : <?php echo $this->_tpl_vars['password']; ?>


なお、パスワードの変更は、「設定変更」画面からおこなってください。

<?php echo $this->_tpl_vars['SNS_NAME']; ?>
のログインページ
<?php echo $this->_tpl_vars['OPENPNE_URL']; ?>


今後とも、ぜひ、<?php echo $this->_tpl_vars['SNS_NAME']; ?>
をご活用ください。


<?php echo $this->_tpl_vars['inc_signature']; ?>
