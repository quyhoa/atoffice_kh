<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// プロフィール項目追加
class admin_do_a_send_mail extends OpenPNE_Action
{

    function execute($requests)
    {
	//var_dump($_POST);
	$subject = $_POST['subject'];
	$body = $_POST['body'];
	$mail_list = mb_split(',', $_POST['mail']);

	foreach($mail_list as $mail){
		put_mail_queue($mail, $subject, $body);
	}

	admin_client_redirect('mail_check', 'メールを送信しました。');

    }
}


?>
