<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_page_reserve_confirm extends OpenPNE_Action
{

    function execute($requests)
    {


	// アクセス権限
	$sql = "select name, atoffice_auth_type, hall_id from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$this->set('name', $result[0]['name']);
	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);

	//var_dump($_REQUEST);
	$post_data=array();

	$post_data['hall_id']=$_POST['hall_id'];
	$post_data['room_id']=$_POST['room_id'];

/// 2013.12.21 消費税改定対応 begin

	$tmp_ymd  = strtotime($_POST['begin_datetime']);
	$tmp_ymd  = date('Y-m-d 00:00:00', $tmp_ymd);
	$tmp_sql  = "";
	$tmp_sql .= "select rate from a_tax ";		/// 消費税率テーブル
	$tmp_sql .= "where stadate <= '$tmp_ymd' ";	/// 適用開始日
	$tmp_sql .= "order by stadate desc ";		/// 適用開始日の降順
	$tmp_sql .= "limit 0, 1";			/// 先頭１件
	$tmp_tab  = db_get_all($tmp_sql);
	$tmp_tax  = $tmp_tab[0]['rate'] / 100;		/// 消費税率

/// 2013.12.21 消費税改定対応 end

	$post_data['begin_datetime']=$_POST['begin_datetime'];
	$dt = new DateTime($_POST['begin_datetime']);
	$this->set('begin', $dt->format("Y年m月d日 H時i分"));

	$post_data['finish_datetime']=$_POST['finish_datetime'];
	$dt = new DateTime($_POST['finish_datetime']);
    $week = get_week($dt->format("Ymd"));
	$this->set('finish', $dt->format("Y年m月d日 H時i分 ($week)"));

	$post_data['purpose']=$_POST['purpose'];
	$post_data['c_member_id']=$_POST['c_member_id'];
	$post_data['vessel_num']=$_POST['vessel_num'];
	$post_data['service_num']=$_POST['service_num'];
	//$post_data['room_price']=$_POST['room_price'];
	$this->set('room_price', $_POST['room_price']);
	$post_data['people']=$_POST['people'];
	$post_data['kanban']=$_POST['kanban'];

	$post_data['hall_name'] = get_hall_name($_POST['hall_id']);
	$post_data['room_name'] = get_room_name($_POST['hall_id'], $_POST['room_id']);
	$sql = "select * from c_member where c_member_id = ".$_POST['c_member_id'];
	$result = db_get_all($sql);
	$post_data['c_member'] = $result[0];

	$vessel_list = array();
	$vessel_price = 0;
	for($x=0;$x<$_POST['vessel_num'];$x++){
		if($_POST['select_vessel'.$x]){
			$vessel_list[$x]['vessel_id']=$_POST['select_vessel'.$x];
			$post_data['select_vessel'.$x]=$_POST['select_vessel'.$x];
			$vessel_list[$x]['num']=$_POST['remainder'.$x];
			$post_data['remainder'.$x]=$_POST['remainder'.$x];
			$sql="select * from a_vessel_data where vessel_id = ".$_POST['select_vessel'.$x];
			$result = db_get_all($sql);

/// 2013.12.21 消費税改定対応 begin

			$tmp_price = $result[0]['price'];		/// 備品使用料
			$tmp_price = round($tmp_price * 100 / 105);	/// 本体価格
			$tmp_price = round($tmp_price * (1 + $tmp_tax));
			$result[0]['price'] = $tmp_price;		/// 書き戻し

/// 2013.12.21 消費税改定対応 end

			$vessel_list[$x]['vessel_data'] = $result[0];
			$vessel_price += $result[0]['price']*$_POST['remainder'.$x];
		}
	}
	$this->set('vessel_list', $vessel_list);
	$this->set('vessel_price', $vessel_price);

	$service_list = array();
	$service_price = 0;
	for($x=0;$x<$_POST['service_num'];$x++){
		if($_POST['select_service'.$x]){
			$service_list[$x]['service_id']=$_POST['select_service'.$x];
			$post_data['select_service'.$x]=$_POST['select_service'.$x];
			$service_list[$x]['num']=$_POST['service_remainder'.$x];
			$post_data['service_remainder'.$x]=$_POST['service_remainder'.$x];
			$sql="select * from a_service_data where service_id = ".$_POST['select_service'.$x];
			$result = db_get_all($sql);

/// 2013.12.21 消費税改定対応 begin

			$tmp_price = $result[0]['price'];		/// サービス使用料
			$tmp_price = round($tmp_price * 100 / 105);	/// 本体価格
			$tmp_price = round($tmp_price * (1 + $tmp_tax));
			$result[0]['price'] = $tmp_price;		/// 書き戻し

/// 2013.12.21 消費税改定対応 end

			$service_list[$x]['service_data'] = $result[0];
			$service_price += $result[0]['price']*$_POST['service_remainder'.$x];
		}
	}
	$this->set('service_list', $service_list);
	$this->set('service_price', $service_price);

	$total_price = $_POST['room_price']+$vessel_price+$service_price;

	$this->set('total_price', $total_price);
	$this->set('post_data', $post_data);
/*
	// 月リスト
	$birth_month_list = array();
	for($x=1;$x<=12;$x++){
		array_push($birth_month_list, $x);
	}
	// 日リスト
	$birth_day_list = array();
	for($x=1;$x<=31;$x++){
		array_push($birth_day_list, $x);
	}
*/
	// 都道府県オプション
		$sql = "select * from c_profile_option where c_profile_id = 3";
		$ken_list=db_get_all($sql);

	$this->set('birth_month_list', $birth_month_list);
	$this->set('birth_day_list', $birth_day_list);
	$this->set('ken_list', $ken_list);

    if($_POST['c_member_id']){
        if(check_guest($_POST['c_member_id'])){
            $this->set('guest', "ゲスト");
        }else{
            $this->set('guest', "会員");
        }
    }else{
        $this->set('guest', "ゲスト");
    }

        return 'success';
    }
}


?>
