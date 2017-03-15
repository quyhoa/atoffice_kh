<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_page_room_discount_conf extends OpenPNE_Action
{

    function execute($requests)
    {

	// アクセス権限
	$sql = "select name, atoffice_auth_type from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$this->set('name', $result[0]['name']);
	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);

	//var_dump($_REQUEST);

	if($_GET['msg']){
		$msg = explode("。", $_GET['msg']);
		$this->set('msg', $msg[0]);
		$id = explode("_", $msg[1]);
		$hall_id = $id[0];
		$room_id = $id[1];
	}else{
		$hall_id = $_POST['hall_id'];
		$room_id = $_POST['room_id'];
	}
	$this->set('hall_id', $hall_id);
	$this->set('room_id', $room_id);

	//会場名・総部屋数データ取得
	$sql = "select * from a_hall where hall_id = $hall_id";
	$hall_data = db_get_all($sql);
	//Add by RSDN 2017-01-06
	if(empty($hall_data[0]['begin']))
	{
		$hall_data[0]['begin']=1;
	}
	if(empty($hall_data[0]['finish']))
	{
		$hall_data[0]['finish']=24;
	}
	//END by RSDN 2017-06-01
	$this->set('hall_name', $hall_data[0]['hall_name']);

	// 部屋名
	$sql = "select * from a_room where hall_id = $hall_id ";
	$sql.= "and room_id = $room_id";
	$room_data = db_get_all($sql);
	


	// 割引パターン数（6）
	$discount = array();
	for($x=1; $x<7; $x++){
		$discount[$x]['num']=$x;
		$sql = "select * from a_room_discount where hall_id = $hall_id and room_id = $room_id and pattern_id = $x";
		$list = db_get_all($sql);
		$discount[$x]['list']=$list[0];
	}
	//var_dump($discount);
	$this->set('discount', $discount);

	// コマ別価格
	if($room_data[0]['type']==1){
		//池袋
		$i_koma_list=array();
		for($x=1;$x<8;$x++){
			if($room_data[0]['price'.$x]){
				$i_koma_list[$x-1]['num']=$x;
				$i_koma_list[$x-1]['begin']=$room_data[0]['begin_time'.$x];
				$i_koma_list[$x-1]['finish']=$room_data[0]['finish_time'.$x];
				$i_koma_list[$x-1]['price']=$room_data[0]['price'.$x];

				foreach($discount as $value){
					if($value['list']['percent']){
						$p = 1 - ($value['list']['percent'] * 0.01);
						$i_koma_list[$x-1][$value['list']['pattern_id']] = $i_koma_list[$x-1]['price'] * $p;
					}
				}

			}
		}
		$this->set('i_koma_list', $i_koma_list);
	}else{
		foreach($discount as $value){
			if($value['list']['percent']){
				//　○人まで
				if($room_data[0]['k_lowest_price']){
					$p = 1 - ($value['list']['percent'] * 0.01);
					$room_data[0]['k_lowest_discount'][$value['list']['pattern_id']] = $room_data[0]['k_lowest_price'] * $p;
				}

				// ○人～○人まで2
				if($room_data[0]['k_price2']){
					$p = 1 - ($value['list']['percent'] * 0.01);
					$room_data[0]['k_price2_discount'][$value['list']['pattern_id']] = $room_data[0]['k_price2'] * $p;
				}

				// ○人～○人まで3
				if($room_data[0]['k_price3']){
					$p = 1 - ($value['list']['percent'] * 0.01);
					$room_data[0]['k_price3_discount'][$value['list']['pattern_id']] = $room_data[0]['k_price3'] * $p;
				}

				//　○人以上
				if($room_data[0]['k_highest_price']){
					$p = 1 - ($value['list']['percent'] * 0.01);
					$room_data[0]['k_highest_discount'][$value['list']['pattern_id']] = $room_data[0]['k_highest_price'] * $p;
				}

			}
		}
	}

	$this->set('room_data', $room_data[0]);

	// 年リスト
	$this_year = date("Y");
	$year_list = array($this_year, $this_year+1, $this_year+2);
	$this->set('year_list', $year_list);

	// 月リスト
	$month_list = array(1,2,3,4,5,6,7,8,9,10,11,12);
	$this->set('month_list', $month_list);

	// 日リスト
	$day_list=array();
	for($x=1;$x<32;$x++){
		array_push($day_list, $x);
	}
	$this->set('day_list', $day_list);


	// パック数（6）
	$pack_list = array();
	for($x=1;$x<7;$x++){
		$pack_list[$x]['num'] = $x;

		// 設定済みデータ
		$sql = "select * from a_room_pack where hall_id = $hall_id and room_id = $room_id and pack_id = ".$x;
		$result = db_get_all($sql);
		$pack_list[$x]['data']=$result[0];

	}

	$this->set('pack_list', $pack_list);

	if($room_data[0]['type']==1){
		// 営業時間リスト
		$open_time = array();
		for($x=$hall_data[0]['begin']; $x<=$hall_data[0]['finish']; $x++){
			array_push($open_time, $x);
		}
		$this->set('open_time', $open_time);
	}else{
		// 連続コマリスト
		$koma_list = array();
		$koma_1 = $room_data[0]['koma'];
		$koma = ($hall_data[0]['finish'] - $hall_data[0]['begin']) / $koma_1;

		for($x=($room_data[0]['lowest_koma']+1); $x<=$koma; $x++){
			array_push($koma_list, $x);
		}
		$this->set('koma_list', $koma_list);

	}

	// 継続的な割引リスト
	$continuance = array('選択', '全ての平日営業日', '全ての土曜営業日', '全ての日祭日営業日', '全ての営業日');
	
	$this->set('continuance', $continuance);


	//var_dump($result);

	$this->set('service_list', $result);


        return 'success';
    }
}

?>
