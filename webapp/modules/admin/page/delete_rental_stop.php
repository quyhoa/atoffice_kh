<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class admin_page_delete_rental_stop extends OpenPNE_Action
{
    function execute($requests)
    {
		$stop_id=$_POST['id'];
		$sql="delete from a_rental_stop where stop_id='$stop_id'";
		db_get_all($sql);
		return 'ok';
    }
}

?>
