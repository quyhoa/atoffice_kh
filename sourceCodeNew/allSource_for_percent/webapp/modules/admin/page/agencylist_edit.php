<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class admin_page_agencylist_edit extends OpenPNE_Action
{
    function execute($requests)
    {
	$sql = "select * from a_agency where agency_id = ".$_GET['target_c_agencylist_id'];    
        $c_agency_list = db_get_all($sql);
	$c_agency_list = $c_agency_list[0];

        if (!$c_agency_list) {
            admin_client_redirect('agency_list', '代理店値引き対象に登録されていません');
        }

        if (!empty($requests['info'])) {
            $c_agency_list['info'] = $requests['info'];
        }

	// 氏名
	$sql = "select nickname from c_member where c_member_id = ".$c_agency_list['c_member_id'];
	$nickname = db_get_all($sql);
	$c_agency_list['nickname'] = $nickname[0]['nickname'];

    // set list checkbox
    $sql = "select hall_id, hall_name from a_hall where flag=0 order by pulldown desc";
    $hall_list = db_get_all($sql, $db);

    if(!empty($hall_list)){
        foreach ($hall_list as $key => $halls) {            
            $hallLists[] = $halls['hall_id'];
        }
    }
    $hallLists = isset($hallLists) ? $hallLists : null;
    $this->set('hallLists',json_encode($hallLists));

    $sql = "select * from a_agency where c_member_id = ".$c_agency_list['c_member_id'];
    $agency_data = db_get_all($sql);
    $agecyOld = empty($agency_data[0]['hall_list']) ? null : json_decode($agency_data[0]['hall_list'],true);
    // var_dump(json_decode($agency_data[0]['hall_list'],true));
    $hall_lists = $hall_list;
    
    foreach ($hall_lists as $key => $value) {
        if(!empty($agecyOld)){
            if(array_key_exists($value['hall_id'],$agecyOld)){
                $hall_list[$key]['flagChecked'] = 1;
                $hall_list[$key]['pecentValue'] = $agecyOld[$value['hall_id']];
            }               
        }
    }

    $this->set('hall_list',$hall_list);

        $this->set('agencylist', $c_agency_list);

        return 'success';
    }
} 

?>
