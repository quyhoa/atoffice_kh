<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_page_incomplete_list extends OpenPNE_Action
{

    function execute($requests)
    {

	// アクセス権限
	$sql = "select * from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$this->set('name', $result[0]['name']);
	$this->set('reporter', $result[0]['c_admin_user_id']);
	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);
	$hall_id = $result[0]['hall_id'];
	if($result[0]['atoffice_auth_type']==2 or $result[0]['atoffice_auth_type']==4){
		$sql = "select * from a_hall where flag=0";
		$hall_list = db_get_all($sql);
		if(isset($_REQUEST['hall_list']) && $_REQUEST['hall_list']){
			$hall_id = $_REQUEST['hall_list'];
		}else{
			$hall_id = $hall_list[0]['hall_id'];
		}
		$this->set('hall_list', $hall_list);
		$this->set('hall_id', $hall_id);
	}

	if($result[0]['atoffice_auth_type']==3){
		$array_push = array();
		$hall_list_id = explode(",",$result[0]['hall_id']);
		foreach($hall_list_id as $key => $value){
			$sql = "select * from a_hall where hall_id = ".$value."";	
			$hall_list = db_get_all($sql);
			array_push($array_push, $hall_list);
		}
		if($_REQUEST['hall_list']){
			$hall_id = $_REQUEST['hall_list'];
		}else{
			$hall_id = $array_push[0][0]['hall_id'];
		}
		$this->set('hall_list', $array_push);			
	}
    $this->set('hall_id', $hall_id);
	$check_date = date("Y-m-d H:I:s");

	if(isset($_REQUEST['index']) && $_REQUEST['index']){
		$index=$_REQUEST['index'];
	}else{
		$index=0;
	}
	$this->set('index', $index);

	//件数
	$sql = "select count(reserve_id) as reserve_num from a_reserve_list where hall_id = $hall_id and cancel_flag = 0 and complete_flag = 0 and finish_datetime < '$check_date'";
	$result = db_get_all($sql);

	$num = $result[0]['reserve_num'];
	$this->set('num', $num);

	$page_list = get_page_list($index, $num, 10, 30);
	$this->set('page_list', $page_list);



	// 10件取得
	$sql = "select * from a_reserve_list where hall_id = $hall_id and cancel_flag = 0 and complete_flag = 0 and finish_datetime < '$check_date' order by begin_datetime limit ".$index.", 10";
	$reserve_data = db_get_all($sql);

	// 会場名
	$sql = "select hall_name from a_hall where hall_id = $hall_id";
	$result = db_get_all($sql);
	$this->set('hall_name', $result[0]['hall_name']);

	foreach($reserve_data as $key=>$value){

		$dt = new DateTime($value['begin_datetime']);
        $w = $dt->format("Ymd");
        $w = get_week($w);
		$reserve_data[$key]['begin_datetime'] = $dt->format("Y年m月d日($w) H時i分s秒");
		$dt = new DateTime($value['finish_datetime']);
        $w = $dt->format("Ymd");
        $w = get_week($w);
		$reserve_data[$key]['finish_datetime'] = $dt->format("Y年m月d日($w) H時i分s秒");

		$uid = $value['c_member_id'];


	// 顧客データ
		$sql = "select * from c_member where c_member_id = $uid";
		$c_member_data = db_get_all($sql);
		$c_member_data = $c_member_data[0];
	// メール
		$sql = "select pc_address from c_member_secure where c_member_id = $uid";
		$result=db_get_all($sql);
		$mail = t_decrypt($result[0]['pc_address']);

		$reserve_data[$key]['c_member_data'] = $c_member_data;
		$reserve_data[$key]['mail'] = $mail;

		$reserve_data[$key]['kana'] = get_profile_value($uid, 11);
		$reserve_data[$key]['corp'] = get_profile_value($uid, 12);
		$reserve_data[$key]['busho'] = get_profile_value($uid, 19);
		$reserve_data[$key]['tel'] = get_profile_value($uid, 17);
		$reserve_data[$key]['fax'] = get_profile_value($uid, 18);
	}
	$this->set('reserve_data', $reserve_data);

	$this->set('count', count($reserve_data));

        return 'success';
    }
}


?>
