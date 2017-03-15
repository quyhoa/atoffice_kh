<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// プロフィール項目追加
class admin_do_delete_virtual_account extends OpenPNE_Action
{

    function execute($requests)
    {
	//var_dump($_REQUEST);

	$vn = $_POST['vn'];
	$u = $_POST['c_member_id'];

	$sql = "update a_virtual_account_list SET c_member_id = 0 where virtual_number = $vn";
	db_get_all($sql);

	admin_client_redirect('c_member_detail&target_c_member_id='.$u, 'バーチャル口座設定を削除しました。');


    }
}




?>
