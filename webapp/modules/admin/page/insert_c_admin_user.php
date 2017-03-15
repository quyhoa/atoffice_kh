<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// プロフィール項目追加
class admin_page_insert_c_admin_user extends OpenPNE_Action
{
    function execute($requests)
    {
	// 会場リスト
	$sql = "select hall_id, hall_name from a_hall where flag = 0";
	$result = db_get_all($sql);
	$this->set('hall_list', $result);
        return 'success';
    }
}

?>
