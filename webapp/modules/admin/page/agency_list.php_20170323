<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class admin_page_agency_list extends OpenPNE_Action
{
    function execute($requests)
    {
	// アクセス権限
	$sql = "select name, atoffice_auth_type from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$this->set('name', $result[0]['name']);
	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);

        $page = isset($requests['page']) ? $requests['page'] : null;

	$sql = "select * from a_agency";
	$c_agencylist_list = db_get_all($sql);

	if($c_agencylist_list){
		foreach($c_agencylist_list as $key => $value){
			// 氏名
			$sql = "select nickname from c_member where c_member_id = ".$value['c_member_id'];
			$nickname = db_get_all($sql);
			$c_agencylist_list[$key]['nickname'] = $nickname[0]['nickname'];
		}
	}

        $this->set("c_agencylist_list", $c_agencylist_list);
        return 'success';
    }
}

?>
