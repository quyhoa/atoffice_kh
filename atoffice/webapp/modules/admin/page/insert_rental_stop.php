<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class admin_page_insert_rental_stop extends OpenPNE_Action
{
    function execute($requests)
    {
    	$stop_id = $_POST['stop_id'];
    	if(isset($_POST['customerName'])){
    		$customerName = $_POST['customerName'];
    	}
		else{
			$customerName = '';
		}
		if(isset($_POST['customerNameKana'])){
    		$customerNameKana = $_POST['customerNameKana'];
    	}
		else{
			$customerNameKana = '';
		}
		if(isset($_POST['org'])){
    		$org = $_POST['org'];
    	}
		else{
			$org = '';
		}
		if(isset($_POST['postalCode'])){
    		$postalCode = $_POST['postalCode'];
    	}
		else{
			$postalCode = '';
		}
		if(isset($_POST['streetAddress'])){
    		$streetAddress = $_POST['streetAddress'];
    	}
		else{
			$streetAddress = '';
		}
		if(isset($_POST['phoneNumber'])){
    		$phoneNumber = $_POST['phoneNumber'];
    	}
		else{
			$phoneNumber = '';
		}
		if(isset($_POST['faxNumber'])){
    		$phoneNumber = $_POST['faxNumber'];
    	}
		else{
			$phoneNumber = '';
		}
		if(isset($_POST['email'])){
    		$email = $_POST['email'];
    	}
		else{
			$email = '';
		}
		if(isset($_POST['memo'])){
    		$memo = $_POST['memo'];
    	}
		else{
			$memo = '';
		}
		if(isset($_POST['user_id'])){
    		$user_id = $_POST['user_id'];
    	}
		else{
			$user_id = '';
		}
		$sql="insert into a_rental_user(c_member_id, customer_name, customer_name_kana, corporation_name, post_code, address, phone_number, fax, email, memo) value('".$user_id."','".$customerName."','".$customerNameKana."','".$org."','".$postalCode."','".$streetAddress."','".$phoneNumber."','".$faxNumber."','".$email."','".$memo."')";db_get_all($sql);	
		$sql="SELECT MAX(ID) AS id FROM a_rental_user";
		$result= db_get_all($sql);		
		$stop_user_id = $result[0]['id'];
		$sql1 = "update a_rental_stop SET stop_user_id = '".$stop_user_id."' where stop_id =".$stop_id;
		db_get_all($sql1);
		$sql = "select * from a_rental_stop where stop_id = "+$stop_id;
		$result = db_get_all($sql);		
    }
}

?>
