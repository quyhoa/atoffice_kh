<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// メール文言更新
class admin_page_edit_mail extends OpenPNE_Action
{
    function execute($requests)
    {

	// アクセス権限
	$sql = "select name, atoffice_auth_type from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$this->set('name', $result[0]['name']);
	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);

        $pc = array(
            'm_pc_syoutai_mail' => '新規登録招待メール',
            'm_pc_change_mail' => 'PCメールアドレス変更確認メール',
            'm_pc_invite_end' => '登録完了メール',
            'm_pc_password_query' => 'パスワード再発行メール',
            'm_pc_password_reset_query' => 'パスワード再設定メール',
        );

        $atoffice = array(
            'm_atoffice_kari' => '仮予約登録完了メール（顧客操作）',
            'm_atoffice_aokari' => '仮予約登録完了メール（AO操作）',
            'm_atoffice_syounin' => '仮予約承認メール',
            'm_atoffice_syounin2' => '予約承認メール内追加説明文',
            'm_atoffice_hisyounin' => '仮予約非承認メール',
            'm_atoffice_change_reserve' => '予約変更メール（顧客操作）',
            'm_atoffice_change_vessel' => '予約備品変更メール（顧客操作）',
            'm_atoffice_user_cancel' => '予約キャンセルメール（顧客操作）',
            'm_atoffice_ao_tmpcancel' => '仮予約取消メール（AO操作）',
            'm_atoffice_ao_cancel' => '予約キャンセルメール（AO操作）',
            'm_atoffice_paid' => '入金確認メール',
            'm_atoffice_repay' => '返金完了メール',
        );

        $this->set('pc', $pc);
        $this->set('atoffice', $atoffice);

	if($requests['target'] == 'm_atoffice_syounin2'){
		$sql = "select * from a_hall";
		$hall_list = db_get_all($sql);
		$this->set('hall_list', $hall_list);

		if(!empty($_REQUEST['hall_id'])){
			$this->set('hall_id', $_REQUEST['hall_id']);
			$this->set('hall_name', get_hall_name($_REQUEST['hall_id']));
			$sql = "select mail from a_hall where hall_id = ".$_REQUEST['hall_id'];
			$body = db_get_all($sql);
			$this->set('body', $body[0]['mail']);
		}

	}else{

	        $source = get_c_template_mail_source($requests['target']);
	        if ($requests['target'] == 'inc_signature') {
	            $subject = '';
	            $body = $source;
	        } else {
	            list($subject, $body) = explode("\n", $source, 2);
	        }
	        $this->set('subject', $subject);
	        $this->set('body', $body);

	}

        return 'success';
    }
}

?>
