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

        $this->set('agencylist', $c_agency_list);

        return 'success';
    }
}

?>
