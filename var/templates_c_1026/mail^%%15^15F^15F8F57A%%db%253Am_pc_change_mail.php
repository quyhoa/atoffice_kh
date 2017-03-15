<?php /* Smarty version 2.6.18, created on 2016-10-26 17:31:27
         compiled from db:m_pc_change_mail */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 't_url_mail', 'db:m_pc_change_mail', 9, false),)), $this); ?>
【<?php echo $this->_tpl_vars['SNS_NAME']; ?>
】メールアドレス登録ページのお知らせ
<?php echo $this->_tpl_vars['c_member']['nickname']; ?>
さん、こんにちは。
<?php echo $this->_tpl_vars['SNS_NAME']; ?>
メールアドレスの登録ページをご連絡致します。

以下のURLをクリックし、パスワードを入力して登録を完了してください。
既にPCメールアドレスが登録されている場合、新しいメールアドレスに
変更されます。

<?php echo smarty_function_t_url_mail(array('m' => 'pc','a' => 'page_o_l2'), $this);?>
&sid=<?php echo $this->_tpl_vars['sid']; ?>


今後とも、ぜひ、<?php echo $this->_tpl_vars['SNS_NAME']; ?>
をご活用ください。


◆変更した覚えがない方へ

あなたがこちらの変更に関して心当たりがない場合、
大変お手数ではございますが下記までご連絡ください。
また、登録前のメールアドレスでログインした場合、
こちらのメールアドレスへの変更は実行されません。

<?php echo $this->_tpl_vars['ADMIN_EMAIL']; ?>



<?php echo $this->_tpl_vars['inc_signature']; ?>