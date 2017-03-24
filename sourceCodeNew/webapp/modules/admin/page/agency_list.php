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
			$c_agencylist_list[$key]['hall_list'] = json_decode($value['hall_list'],true);
			// get corporation
			$corporationName = db_member_c_member4c_member_id($value['c_member_id'], true, true, 'private');
			$c_agencylist_list[$key]['corporation'] = isset($corporationName['profile']['corporation']['value']) ? $corporationName['profile']['corporation']['value'] : '';

			if(!empty($c_agencylist_list[$key]['hall_list'])){		
				$hallListName = array();
				$hallListPecent = array();	
				
				foreach($c_agencylist_list[$key]['hall_list'] as $keys => $agencylist){

					$sql = "select hall_name from a_hall where flag=0 and hall_id = $keys";
					$hall_list_name = db_get_all($sql, $db);
					$hallListName[] = isset($hall_list_name[0]['hall_name']) ? $hall_list_name[0]['hall_name'] : '';
					$hallListPecent[] = $agencylist;		
				}
				$c_agencylist_list[$key]['hall_list_name'] = $hallListName;
				$c_agencylist_list[$key]['hall_list_percent'] = $hallListPecent;				
			}else{
				$c_agencylist_list[$key]['hall_list_name'] = null;
				$c_agencylist_list[$key]['hall_list_percent'] = null;
			}
		}
	}

        $this->set("c_agencylist_list", $c_agencylist_list);
        return 'success';
    }
}

?>
