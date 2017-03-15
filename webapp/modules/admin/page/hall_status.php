<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_page_hall_status extends OpenPNE_Action
{

    function execute($requests)
    {

	// アクセス権限
	$sql = "select name, atoffice_auth_type from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$result[0]['name'] = isset($result[0]['name']) ? $result[0]['name'] : null;
	$result[0]['atoffice_auth_type'] = isset($result[0]['atoffice_auth_type']) ? $result[0]['atoffice_auth_type'] : null;
	$this->set('name', $result[0]['name']);
	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);

	//var_dump($_REQUEST);

	if(isset($_GET['msg']) && $_GET['msg']){
		$hall_id = preg_replace("/[^0-9]+/", "", $_GET['msg']);
		$this->set('msg', preg_replace("/[0-9]+/", "", $_GET['msg']));
	}else{
		$hall_id = $_POST['hall_id'];
	}
	$this->set('hall_id', $hall_id);

	//会場データ取得
	$sql = "select * from a_hall where hall_id = $hall_id";
	$hall_data = db_get_all($sql);
	$hall_data[0] =isset($hall_data[0]) ? $hall_data[0] : null;
	$this->set('hall_data', $hall_data[0]);

	$error=0;

	if(!$hall_data[0]['agreement']){
		$error++;
	}

	// 有効になっている部屋が1つ以上あるか
	$sql = "select count(*) as count from a_room where hall_id = $hall_id and flag = 1";
	$result = db_get_all($sql);
	if(!$result[0]['count']){
		$error++;
	}
	
	$this->set('room_flag_check', $result[0]['count']);

	// 画像１・２が登録されているか
	$sql = "select count(*) as count from a_hall_image where hall_id = $hall_id and image_id = 1";
	$result = db_get_all($sql);
	if(!$result[0]['count']){
		$error++;
	}
	$this->set('image1_check', $result[0]['count']);
	$sql = "select count(*) as count from a_hall_image where hall_id = $hall_id and image_id = 2";
	$result = db_get_all($sql);
	if(!$result[0]['count']){
		$error++;
	}
	$this->set('image2_check', $result[0]['count']);

	//口座設定がされているか
	if($hall_data[0]['bank_flag']){
		$sql = "select count(*) as count from a_bank_data where hall_id = $hall_id";
		$result = db_get_all($sql);
		if(!$result[0]['count']){
			$error++;
		}
		$this->set('bank_check', $result[0]['count']);
	}else{
		$this->set('bank_check', '1');
	}

	$this->set('error', $error);

        return 'success';
    }
}

?>
