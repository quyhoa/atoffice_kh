<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class admin_page_save_data_customer extends OpenPNE_Action
{
    function execute($requests)
    {
		$customerId=isset($_POST['customerId'])?trim($_POST['customerId']):'';
		$customerName=isset($_POST['customerName'])?trim($_POST['customerName']):'';
		$customerNameKana=isset($_POST['customerNameKana'])?trim($_POST['customerNameKana']):'';
		$org =isset($_POST['org'])?trim($_POST['org']):'';
		$postalCode=isset($_POST['postalCode'])?trim($_POST['postalCode']):'';
		$streetAddress=isset($_POST['streetAddress'])?trim($_POST['streetAddress']):'';
		$phoneNumber=isset($_POST['phoneNumber'])?trim($_POST['phoneNumber']):'';
		$faxNumber=isset($_POST['faxNumber'])?trim($_POST['faxNumber']):'';
		$email=isset($_POST['email'])?trim($_POST['email']):'';
		$memo2=isset($_POST['memo2'])?trim($_POST['memo2']):'';
		$sql="insert into a_rental_user values(
				'now()','$customerId','$customerName','$customerNameKana','$org','$postalCode','$streetAddress','$phoneNumber','$faxNumber','$email','$memo2'
		)";
		$result = mysql_query($sql);
		$last=mysql_insert_id();
		if($result==1){
			echo $last;
		}
        return 0;
    }
}

?>
