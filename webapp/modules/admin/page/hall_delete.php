<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_page_hall_delete extends OpenPNE_Action
{
    function execute($requests)
    {

	// アクセス権限
	$sql = "select name, atoffice_auth_type from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$this->set('name', $result[0]['name']);
	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);

	$hall_id = $_POST['hall_id'];
	$this->set('hall_id', $hall_id);

	$sql = "select * from a_hall where hall_id = $hall_id";
	$hall_data = db_get_all($sql);
	$hall_data = $hall_data[0];
	$this->set('hall_data', $hall_data);

	// 関連設定件数

	// キャンセル料率
	$sql = "select count(*) as count_num from a_cancel_charge where hall_id = $hall_id";
	$result = db_get_all($sql);
	$this->set('cancel_charge', $result[0]['count_num']);

	// 会場休日設定
	$sql = "select count(*) as count_num from a_hall_holiday where hall_id = $hall_id";
	$result = db_get_all($sql);
	$this->set('a_hall_holiday', $result[0]['count_num']);

	// 会場画像設定
	$sql = "select count(*) as count_num from a_hall_image where hall_id = $hall_id";
	$result = db_get_all($sql);
	$this->set('a_hall_image', $result[0]['count_num']);

	// 会場定休日設定
	$sql = "select count(*) as count_num from a_hall_regular_holiday where hall_id = $hall_id";
	$result = db_get_all($sql);
	$this->set('a_hall_regular_holiday', $result[0]['count_num']);

	// 会場貸し止め設定
	$sql = "select count(*) as count_num from a_rental_stop where hall_id = $hall_id";
	$result = db_get_all($sql);
	$this->set('a_rental_stop', $result[0]['count_num']);

	// 会場予約データ
	$sql = "select count(*) as count_num from a_reserve_list where hall_id = $hall_id";
	$result = db_get_all($sql);
	$this->set('a_reserve_list', $result[0]['count_num']);

	// 会場部屋設定
	$sql = "select count(*) as count_num from a_room where hall_id = $hall_id";
	$result = db_get_all($sql);
	$this->set('a_room', $result[0]['count_num']);

	// 会場サービス品設定
	$sql = "select count(*) as count_num from a_service_data where hall_id = $hall_id";
	$result = db_get_all($sql);
	$this->set('a_service_data', $result[0]['count_num']);

	// 会場備品設定
	$sql = "select count(*) as count_num from a_vessel_data where hall_id = $hall_id";
	$result = db_get_all($sql);
	$this->set('a_vessel_data', $result[0]['count_num']);




        return 'success';
    }
}

?>
