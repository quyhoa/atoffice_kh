<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class admin_page_update_pre_reserve extends OpenPNE_Action
{
    function execute($requests)
    {
     
        if(isset($_REQUEST['reserve_id']) && !empty($_REQUEST['reserve_id']))
		{
			$reserve_id = explode(",",$_REQUEST['reserve_id']);
			foreach($reserve_id as $pid)
			{
				$room_price = $_REQUEST['room_price_'.$pid];
				$vessel_price = $_REQUEST['vessel_price_'.$pid];
				$service_price = $_REQUEST['service_price_'.$pid];
				$total_price = $_REQUEST['total_price_'.$pid];
				$kanban = $_REQUEST['kanban_'.$pid];
				$memo = $_REQUEST['memo_'.$pid];
				$sql = "UPDATE a_pre_reserve SET room_price='$room_price',vessel_price='$vessel_price',service_price='$service_price',total_price='$total_price',kanban='$kanban',memo='$memo' WHERE pid='$pid'";
				db_get_all($sql, $db);
			}
		}
        return 'success';
    }
}

?>
