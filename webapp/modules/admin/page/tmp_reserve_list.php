<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_page_tmp_reserve_list extends OpenPNE_Action
{
    function execute($requests)
    {

	// アクセス権限
	$sql = "select name, atoffice_auth_type from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$this->set('name', $result[0]['name']);
	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);

	// 有効な会場一覧
	$sql = "select * from a_hall where flag=0";
	$hall_list = db_get_all($sql);
	if(isset($_REQUEST['hall_list']) && $_REQUEST['hall_list']){
		$hall_id = $_REQUEST['hall_list'];
	}else{
		$hall_id = 0;
	}
	$this->set('hall_list', $hall_list);
	$this->set('hall_id', $hall_id);

	if(isset($_REQUEST['index']) && $_REQUEST['index']){
		$index=$_REQUEST['index'];
	}else{
		$index=0;
	}
	$this->set('index', $index);

	// 件数
	$sql = "select count(reserve_id) as reserve_num from a_reserve_list where tmp_flag = 1 and cancel_flag = 0 ";
	if($hall_id){
		$sql.= "and hall_id = $hall_id ";
	}
	$result = db_get_all($sql);
	$num = $result[0]['reserve_num'];
	$this->set('num', $num);



	$page_list = get_page_list($index, $num, 10, 30);

	$this->set('page_list', $page_list);

	// 検索
	$sql = "select * from a_reserve_list where tmp_flag = 1 and cancel_flag = 0 ";

	if($hall_id){
		$sql.= "and hall_id = $hall_id ";
	}

	$sql.= "order by tmp_reserve_datetime ";
	$sql.= "limit ".$index.", 10";



	$result = db_get_all($sql);


	foreach($result as $key=>$value){
		// 日付書式
		$dt = new DateTime($value['tmp_reserve_datetime']);
		$result[$key]['tmp_reserve_datetime'] = $dt->format("Y年m月d日 H時i分s秒");
		$dt = new DateTime($value['begin_datetime']);
        $week = get_week($dt->format("Ymd"));
		$result[$key]['datetime'] = $dt->format("Y年m月d日(".$week.")");
		$result[$key]['begin_datetime'] = $dt->format("H時i分");
		$dt = new DateTime($value['finish_datetime']);
		$result[$key]['finish_datetime'] = $dt->format("H時i分");

		// 会場
		$sql = "select * from a_hall where hall_id = ".$value['hall_id'];
		$hall_data = db_get_all($sql);
		$result[$key]['hall_data'] = isset($hall_data[0]) ? $hall_data[0] : null;
		// 部屋
		$sql = "select * from a_room where hall_id = ".$value['hall_id']." and room_id = ".$value['room_id'];
		$room_data = db_get_all($sql);
		$result[$key]['room_data'] = isset($room_data[0]) ? $room_data[0] : null;

		//備品
		$sql = "select * from a_reserve_v where reserve_id = ".$value['reserve_id']." and cancel_flag = 0";
		$reserve_v_list = db_get_all($sql);
		foreach($reserve_v_list as $k=>$v){
			$vessel_data = get_vessel_data($v['vessel_id']);
			$reserve_v_list[$k]['vessel_name'] = $vessel_data['vessel_name'];
			$reserve_v_list[$k]['memo'] = $vessel_data['memo2'];
		}
		$result[$key]['reserve_v_list'] = $reserve_v_list;

		//サービス
		$sql = "select * from a_reserve_s where reserve_id = ".$value['reserve_id']." and cancel_flag = 0";
		$reserve_s_list = db_get_all($sql);
		foreach($reserve_s_list as $k=>$v){
			$service_data = get_service_data($v['service_id']);
			$reserve_s_list[$k]['service_name'] = $service_data['service_name'];
			$reserve_s_list[$k]['memo'] = $service_data['memo2'];
		}
		$result[$key]['reserve_s_list'] = $reserve_s_list;

		// 会員情報
		$sql = "select * from c_member where c_member_id = ".$value['c_member_id'];
		$c_member = db_get_all($sql);
		$result[$key]['c_member'] = $c_member[0];
		// プロフィール
		$result[$key]['corp'] = get_profile_value($value['c_member_id'], 12);

	}


	$this->set('reserve_list', $result);


        return 'success';
    }
}

?>
