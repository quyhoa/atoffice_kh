<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class admin_do_delete_c_agencylist extends OpenPNE_Action
{
    function execute($requests)
    {
	//var_dump($_POST);

	$sql = "select * from a_agency where agency_id = ".$_POST['target_c_agencylist_id'];
        $c_agency_list = db_get_all($sql);
	$c_agency_list = $c_agency_list[0];

        if (!$c_agency_list) {
            admin_client_redirect('agency_list', '代理店値引きに登録されていません');
        }



	// 削除
	$sql = "delete from a_agency where agency_id = ".$_POST['target_c_agencylist_id'];
	db_get_all($sql);


        admin_client_redirect('agency_list', '代理店値引きから削除しました');
    }
}

?>
