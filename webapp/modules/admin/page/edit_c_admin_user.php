<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// プロフィール項目追加
class admin_page_edit_c_admin_user extends OpenPNE_Action
{
    function execute($requests)
    {
    $id = $_REQUEST['target_id'];	
	$sql = "select * from c_admin_user where c_admin_user_id = '".$id."'";
	$result = db_get_all($sql);

	$hall_id = $result[0]['hall_id'];
	$list_hall_id = explode(",", $hall_id);
	$this->set('info_admin', $result);
	$this->set('hall_id', $hall_id);
	$this->set('list_hall_id', $list_hall_id);

	$sql = "select hall_id, hall_name from a_hall where flag = 0";
	$result = db_get_all($sql);
	$this->set('hall_list', $result);
        return 'success';
    }
}

?>
