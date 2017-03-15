<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// プロフィール項目追加
class admin_do_add_virtual_account extends OpenPNE_Action
{

    function execute($requests)
    {
	//var_dump($_REQUEST);

	$u = $_POST['c_member_id'];
	
	$sql = "select virtual_number from a_virtual_account_list where kotei=1 and c_member_id = 0";
	$virtual = db_get_all($sql);
	$virtual = $virtual[0]['virtual_number'];

	if($virtual){
		$sql = "update a_virtual_account_list SET c_member_id = $u where virtual_number = '$virtual'";
		db_get_all($sql);

	}else{
		admin_client_redirect('c_member_detail&target_c_member_id='.$u, '固定範囲に口座番号の空きがありませんでした。');
	}

	admin_client_redirect('c_member_detail&target_c_member_id='.$u, 'バーチャル口座設定を更新しました。');


    }
}




?>
