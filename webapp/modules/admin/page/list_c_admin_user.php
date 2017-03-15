<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// アカウント管理
class admin_page_list_c_admin_user extends OpenPNE_Action
{
    function execute($requests)
    {

 // アクセス権限
	 	$sql = "select hall_id, name, atoffice_auth_type from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
		$result = db_get_all($sql);
		$this->set('name', $result[0]['name']);
		$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);
		$list = db_admin_c_admin_user_list();
		 
		foreach($list as $key=>$value){
			if($value['hall_id']){
			    $hall_ids = $value['hall_id'];
			    $sql = "SET SESSION group_concat_max_len = 1000000";
			    $result = db_get_all($sql);
			 	$sql = "select GROUP_CONCAT(hall_name) AS hall_names, 1 AS id_temp from a_hall where hall_id IN($hall_ids) GROUP BY id_temp";
			    $result = db_get_all($sql);
			    $list[$key]['hall_name'] = $result[0]['hall_names'];  			}
		} 
		$this->set('user_list', $list);
		return 'success';
	}
}
?>
