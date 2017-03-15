<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class admin_page_view_detail_rental_stop extends OpenPNE_Action
{
    function execute($requests)
    {
		$stop_user_id = $_POST['stop_user_id'];
		$sql="select * from a_rental_user where id='$stop_user_id'";
		$nick = db_get_all($sql);
		$member=array(
			'c_member_id' => $nick[0]['c_member_id'],
			'customerName' => $nick[0]['customer_name'],
			'customerNameKana'=> $nick[0]['customer_name_kana'],
			'org'=> $nick[0]['corporation_name'],
			'postalCode'=> $nick[0]['post_code'],	
			'streetAddress'=> $nick[0]['address'],	
			'phoneNumber'=> $nick[0]['phone_number'],	
			'faxNumber'=> $nick[0]['fax'],	
			'email'=> $nick[0]['email'],	
			'memo'=> $nick[0]['memo'],	
		);		
		echo json_encode($member);
    }
}

?>
