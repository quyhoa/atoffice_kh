<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class admin_page_search_data_customer extends OpenPNE_Action
{
    function execute($requests)
    {
		$cusID=$_POST['customerId'];
		$nick=db_member_c_member4c_member_id($cusID, true, true, 'private');
		$member=array(
			'name'=>$nick['nickname'],
			'nameKana'=> $nick['profile']['name_kana']['value'],
			'corporation'=> $nick['profile']['corporation']['value'],
			'address_zip'=> $nick['profile']['address_zip']['value'],
			'address_city'=> $nick['profile']['address_city']['value'],
			'tel'=> $nick['profile']['tel']['value'],
			'fax'=> $nick['profile']['fax']['value'],
			'mail'=> $nick['secure']['pc_address'],			
		);
		echo json_encode($member);
    }
}

?>
