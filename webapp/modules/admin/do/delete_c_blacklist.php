<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class admin_do_delete_c_blacklist extends OpenPNE_Action
{
    function execute($requests)
    {
        $c_black_list = db_admin_c_blacklist($requests['target_c_blacklist_id']);
        if (!$c_black_list) {
            admin_client_redirect('blacklist', 'ブラックリストに登録されていません');
        }

	//var_dump($_POST);
	// 削除
	$sql = "delete from c_blacklist where c_member_id = ".$_REQUEST['c_member_id'];
	db_get_all($sql);

	// ゲストでなければログイン可能に
	$sql = "select guest_flag from c_member where c_member_id = ".$_REQUEST['c_member_id'];
	$result = db_get_all($sql);
	if($result[0]['guest_flag']==0){
		$sql = "update c_member SET is_login_rejected = 0 where c_member_id = ".$_REQUEST['c_member_id'];
		db_get_all($sql);
	}

        admin_client_redirect('blacklist', 'ブラックリストから削除しました');
    }
}

?>
