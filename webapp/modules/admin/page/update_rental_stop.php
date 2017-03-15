<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class admin_page_update_rental_stop extends OpenPNE_Action
{
    function execute($requests)
    {
		$stop_user_id = $_POST['stop_user_id'];
		$customerName = $_POST['customerName'];
		$customerNameKana = $_POST['customerNameKana'];
		$org = $_POST['org'];
		$postalCode = $_POST['postalCode'];
		$streetAddress = $_POST['streetAddress'];	
		$phoneNumber = $_POST['phoneNumber'];
		$faxNumber = $_POST['faxNumber'];
		$email = $_POST['email'];
		$memo = $_POST['memo'];
		$user_id = $_POST['user_id'];
		$sql="update a_rental_user SET customer_name = '".$customerName."', customer_name_kana ='".$customerNameKana."', corporation_name ='".$org."', post_code ='".$postalCode."', address='".$streetAddress."', phone_number = '".$phoneNumber."', fax = '".$faxNumber."', email = '".$email."', memo = '".$memo."', c_member_id = '".$user_id."' where id =".$stop_user_id;
		db_get_all($sql);			
    }
}

?>
