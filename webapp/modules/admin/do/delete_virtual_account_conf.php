<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// プロフィール項目追加
class admin_do_delete_virtual_account_conf extends OpenPNE_Action
{

    function execute($requests)
    {
	// var_dump($_REQUEST);

	$sql = "delete from a_virtual_account_conf where branch_id = ".$_POST['branch_id'];
	db_get_all($sql);

	admin_client_redirect('virtual_account_setup', 'バーチャル口座設定を削除しました。');

    }
}




?>
