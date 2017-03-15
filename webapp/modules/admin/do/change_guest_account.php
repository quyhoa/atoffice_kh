<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// プロフィール項目追加
class admin_do_change_guest_account extends OpenPNE_Action
{

    function execute($requests)
    {
	//var_dump($_POST);
	//print "<br>";
	$u = $_POST['c_member_id'];

	$sql = "update c_member SET ";
	$sql.= "is_login_rejected = '0', ";
	$sql.= "guest_flag = '0' ";
	$sql.= "where c_member_id = '$u'";

	db_get_all($sql);

	admin_client_redirect('c_member_detail&target_c_member_id='.$u, 'ゲストを解除しました。顧客一覧から仮パスワードを発行してください。');


    }
}


?>
