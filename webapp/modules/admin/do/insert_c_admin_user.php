<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// プロフィール項目追加
class admin_do_insert_c_admin_user extends OpenPNE_Action
{
    function handleError($errors)
    {
        admin_client_redirect('insert_c_admin_user', array_shift($errors));
    }

    function execute($requests)
    {


        $errors = array();
        if (db_admin_exists_c_admin_username($_REQUEST['mail_address'])) {
            $errors[] = 'そのアカウント名は既に登録されています';
        }
        if ($requests['password'] !== $requests['password2']) {
            $errors[] = 'パスワードが一致していません';
        }

		if (!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_REQUEST['mail_address'])) {
		    $errors[] =  'アカウント名にはメールアドレスを入力してください';
		}

		if (!$_REQUEST['full_name']){
			$errors[] =  '担当者氏名を入力してください';
		}
		$array = array($_POST['ad']);
		if ($_POST['atoffice_auth_type']==3 && !$array[0]){
			$errors[] =  '準備担当者の担当会場を選択してください。';
		}elseif(!$_POST['atoffice_auth_type']==3){
			$_POST['hall_id'] = 0;
		}

        if ($errors) {
            $this->handleError($errors);
        }
        
	    if($array[0]){
	    	$hall_id = implode(",", $array[0]);
		}
		else{
			$hall_id = 0;
		}
        db_admin_insert_c_admin_user(
            $_REQUEST['mail_address'],
            $requests['password'],
            $requests['auth_type'],
		    $_REQUEST['atoffice_auth_type'],
		    $_REQUEST['full_name'],
		    $hall_id
        );

		send_message_mail_info($_REQUEST['mail_address'], $requests['password'], $_REQUEST['mail_address']);
        admin_client_redirect('list_c_admin_user', 'アカウントを追加しました');
    }
}


function send_message_mail_info($user_name, $password, $mail_address){

	require_once("./atoffice/at_office_config.php");
	if(!isset($mysql_db)) $mysql_db="at_office";

	$subject = "貸し会議室管理ページにあなたのアカウントが発行されました。";
	$pc_body  = "お疲れ様です。あなた用の管理ページアカウントが発行されました。\n\n";
	$pc_body .= "あなたのアカウントは、\n";
	$pc_body .= "ユーザー名：".$user_name."\n";
	$pc_body .= "パスワード：".$password."\n";
	$pc_body .= "\n\n";
	$pc_body .= "管理ページは以下のURLへアクセスしてください\n";
	$pc_body .= "URL:".$OPENPNE_ADMIN_URL."\n\n";
	$pc_body .= "アカウントは紛失、漏洩しないように気をつけて管理してください。\n";

	if (OPENPNE_MAIL_QUEUE) {
		//メールキューに蓄積
		put_mail_queue($mail_address, $subject, $pc_body);
	} else {
		t_send_email($mail_address, $subject, $pc_body);
	}

}

?>
