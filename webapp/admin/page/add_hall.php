<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_page_add_hall extends OpenPNE_Action
{
    function execute($requests)
    {
    $a = db_member_c_profile_list();
	if($_GET['msg']){
		$hall_id = preg_replace("/[^0-9]+/", "", $_GET['msg']);
		$this->set('msg', preg_replace("/[0-9]+/", "", $_GET['msg']));
	}else{
		$hall_id = $_POST['hall_id'];
	}
	if($_POST['correction']==100){
		$result1 = explode(",", $_POST['usedate']);
		$this->set('result1', $result1);
		$sql = "select * from a_hall where hall_id = $hall_id";
		$result = db_get_all($sql);
		$this->set('post_data', $result[0]);
	}elseif($hall_id){
		$this->set('hall_id', $hall_id);
		$post_data = array();
		$sql = "select * from a_hall where hall_id = $hall_id";
		$result = db_get_all($sql);
		$sql = "DESCRIBE a_hall";
		$col_list = db_get_all($sql);
		foreach($col_list as $value){
			$post_data[$value['Field']] = $result[0][$value['Field']];
		}
		$post_data['correction']=100;
		$sql = "select usedate,begin_often, finish_often,begin_often1, finish_often1,begin_often2, finish_often2,begin_often3, finish_often3,begin_often4, finish_often4 from a_hall where hall_id = $hall_id";
		$result1 = db_get_all($sql);
		$result1 = $result1[0]['usedate'];
		$result1 = explode(",", $result1);
		$sql_day = "select begin_often, finish_often,begin_often1, finish_often1,begin_often2, finish_often2,begin_often3, finish_often3,begin_often4, finish_often4 from a_hall where hall_id = $hall_id";
		$result2 = db_get_all($sql_day);
		$this->set('post_data', $post_data);
		$this->set('result1', $result1);
		$this->set('result2', $result2);
	}else{
		$this->set('hall_id', 0);
	}
	$address_list = $a[pre_addr_pref];
	$transportation_list = $a[transportation];
	$this->set('profile_list', $address_list);
	$this->set('transportation_list', $transportation_list);

	// アクセス権限
	$sql = "select name, atoffice_auth_type from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$this->set('name', $result[0]['name']);
	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);


	// プルダウンリスト
	$sql = "select hall_name, flag, pulldown from a_hall order by pulldown desc";
	$result = db_get_all($sql);
	$this->set('pulldown', $result);


        return 'success';
    }
}

?>
