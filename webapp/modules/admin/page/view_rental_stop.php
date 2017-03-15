<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class admin_page_view_rental_stop extends OpenPNE_Action
{
    function execute($requests)
    {
		$stop_user_id = $_POST['stop_user_id'];
		$nick = db_member_c_member4c_member_id($stop_user_id, true, true, 'private');	
		
		$member=array(
			'customerName' => $nick['nickname'],
			'customerNameKana'=> $nick['profile']['name_kana']['value'],
			'org'=> $nick['profile']['corporation']['value'],
			'postalCode'=> $nick['post_code'],	
			'streetAddress'=> $nick['profile']['address_city']['value'],	
			'phoneNumber'=> $nick['profile']['tel']['value'],	
			'faxNumber'=> $nick['profile']['fax']['value'],	
			'email'=> $nick['secure']['pc_address'],	
		);		
		echo json_encode($member);
    }
}

?>
