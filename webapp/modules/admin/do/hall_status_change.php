<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// スキン画像更新
class admin_do_hall_status_change extends OpenPNE_Action
{

    function execute($requests)
    {

	//var_dump($_REQUEST);
	$sql = "update a_hall set flag = ".$_POST['flag']." where hall_id = ".$_POST['hall_id'];
	db_get_all($sql);


        admin_client_redirect('hall_status', '運営状態を変更しました。'.$_POST['hall_id']);

    }
}

?>
