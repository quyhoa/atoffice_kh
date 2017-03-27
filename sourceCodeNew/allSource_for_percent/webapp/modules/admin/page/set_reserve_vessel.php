<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 2013.12.21 消費税改定対応 begin

function tmp_room_price_convert(&$tab, $tax){

	for($i = 0; $i < count($tab); $i++){

		/// 本体価格計算
		if($tab[$i]["k_lowest_price"]	) $tab[$i]["k_lowest_price"]	=round($tab[$i]["k_lowest_price"]	/1.05);
		if($tab[$i]["price1"]		) $tab[$i]["price1"]		=round($tab[$i]["price1"]		/1.05);
		if($tab[$i]["price2"]		) $tab[$i]["price2"]		=round($tab[$i]["price2"]		/1.05);
		if($tab[$i]["price3"]		) $tab[$i]["price3"]		=round($tab[$i]["price3"]		/1.05);
		if($tab[$i]["price4"]		) $tab[$i]["price4"]		=round($tab[$i]["price4"]		/1.05);
		if($tab[$i]["price5"]		) $tab[$i]["price5"]		=round($tab[$i]["price5"]		/1.05);
		if($tab[$i]["price6"]		) $tab[$i]["price6"]		=round($tab[$i]["price6"]		/1.05);
		if($tab[$i]["price7"]		) $tab[$i]["price7"]		=round($tab[$i]["price7"]		/1.05);
		if($tab[$i]["k_price2"]		) $tab[$i]["k_price2"]		=round($tab[$i]["k_price2"]		/1.05);
		if($tab[$i]["k_price3"]		) $tab[$i]["k_price3"]		=round($tab[$i]["k_price3"]		/1.05);
		if($tab[$i]["k_highest_price"]	) $tab[$i]["k_highest_price"]	=round($tab[$i]["k_highest_price"]	/1.05);
		if($tab[$i]["price8"]		) $tab[$i]["price8"]		=round($tab[$i]["price8"]		/1.05);
		if($tab[$i]["price9"]		) $tab[$i]["price9"]		=round($tab[$i]["price9"]		/1.05);
		if($tab[$i]["price12"]		) $tab[$i]["price12"]		=round($tab[$i]["price12"]		/1.05);
		if($tab[$i]["price13"]		) $tab[$i]["price13"]		=round($tab[$i]["price13"]		/1.05);
		if($tab[$i]["price14"]		) $tab[$i]["price14"]		=round($tab[$i]["price14"]		/1.05);
		if($tab[$i]["price15"]		) $tab[$i]["price15"]		=round($tab[$i]["price15"]		/1.05);
		if($tab[$i]["price16"]		) $tab[$i]["price16"]		=round($tab[$i]["price16"]		/1.05);
		if($tab[$i]["price17"]		) $tab[$i]["price17"]		=round($tab[$i]["price17"]		/1.05);
		if($tab[$i]["price18"]		) $tab[$i]["price18"]		=round($tab[$i]["price18"]		/1.05);
		if($tab[$i]["price19"]		) $tab[$i]["price19"]		=round($tab[$i]["price19"]		/1.05);
		if($tab[$i]["price20"]		) $tab[$i]["price20"]		=round($tab[$i]["price20"]		/1.05);
		if($tab[$i]["price21"]		) $tab[$i]["price21"]		=round($tab[$i]["price21"]		/1.05);
		if($tab[$i]["price22"]		) $tab[$i]["price22"]		=round($tab[$i]["price22"]		/1.05);
		if($tab[$i]["price23"]		) $tab[$i]["price23"]		=round($tab[$i]["price23"]		/1.05);
		if($tab[$i]["price24"]		) $tab[$i]["price24"]		=round($tab[$i]["price24"]		/1.05);

		/// 消費税額計算
		if($tab[$i]["k_lowest_price"]	) $tab[$i]["k_lowest_price"]	=round($tab[$i]["k_lowest_price"]	*$tax);
		if($tab[$i]["price1"]		) $tab[$i]["price1"]		=round($tab[$i]["price1"]		*$tax);
		if($tab[$i]["price2"]		) $tab[$i]["price2"]		=round($tab[$i]["price2"]		*$tax);
		if($tab[$i]["price3"]		) $tab[$i]["price3"]		=round($tab[$i]["price3"]		*$tax);
		if($tab[$i]["price4"]		) $tab[$i]["price4"]		=round($tab[$i]["price4"]		*$tax);
		if($tab[$i]["price5"]		) $tab[$i]["price5"]		=round($tab[$i]["price5"]		*$tax);
		if($tab[$i]["price6"]		) $tab[$i]["price6"]		=round($tab[$i]["price6"]		*$tax);
		if($tab[$i]["price7"]		) $tab[$i]["price7"]		=round($tab[$i]["price7"]		*$tax);
		if($tab[$i]["k_price2"]		) $tab[$i]["k_price2"]		=round($tab[$i]["k_price2"]		*$tax);
		if($tab[$i]["k_price3"]		) $tab[$i]["k_price3"]		=round($tab[$i]["k_price3"]		*$tax);
		if($tab[$i]["k_highest_price"]	) $tab[$i]["k_highest_price"]	=round($tab[$i]["k_highest_price"]	*$tax);
		if($tab[$i]["price8"]		) $tab[$i]["price8"]		=round($tab[$i]["price8"]		*$tax);
		if($tab[$i]["price9"]		) $tab[$i]["price9"]		=round($tab[$i]["price9"]		*$tax);
		if($tab[$i]["price10"]		) $tab[$i]["price10"]		=round($tab[$i]["price10"]		*$tax);
		if($tab[$i]["price11"]		) $tab[$i]["price11"]		=round($tab[$i]["price11"]		*$tax);
		if($tab[$i]["price12"]		) $tab[$i]["price12"]		=round($tab[$i]["price12"]		*$tax);
		if($tab[$i]["price13"]		) $tab[$i]["price13"]		=round($tab[$i]["price13"]		*$tax);
		if($tab[$i]["price14"]		) $tab[$i]["price14"]		=round($tab[$i]["price14"]		*$tax);
		if($tab[$i]["price15"]		) $tab[$i]["price15"]		=round($tab[$i]["price15"]		*$tax);
		if($tab[$i]["price16"]		) $tab[$i]["price16"]		=round($tab[$i]["price16"]		*$tax);
		if($tab[$i]["price17"]		) $tab[$i]["price17"]		=round($tab[$i]["price17"]		*$tax);
		if($tab[$i]["price18"]		) $tab[$i]["price18"]		=round($tab[$i]["price18"]		*$tax);
		if($tab[$i]["price19"]		) $tab[$i]["price19"]		=round($tab[$i]["price19"]		*$tax);
		if($tab[$i]["price20"]		) $tab[$i]["price20"]		=round($tab[$i]["price20"]		*$tax);
		if($tab[$i]["price21"]		) $tab[$i]["price21"]		=round($tab[$i]["price21"]		*$tax);
		if($tab[$i]["price22"]		) $tab[$i]["price22"]		=round($tab[$i]["price22"]		*$tax);
		if($tab[$i]["price23"]		) $tab[$i]["price23"]		=round($tab[$i]["price23"]		*$tax);
		if($tab[$i]["price24"]		) $tab[$i]["price24"]		=round($tab[$i]["price24"]		*$tax);
	}

}

function tmp_pack_price_convert(&$tab, $tax){

	for($i = 0; $i < count($tab); $i++){

		if($tab[$i]["koma2"] == 0){

		/// 本体価格計算
		if($tab[$i]["price"]		) $tab[$i]["price"]		=round($tab[$i]["price"]		/1.05);

		/// 消費税額計算
		if($tab[$i]["price"]		) $tab[$i]["price"]		=round($tab[$i]["price"]		*$tax);

		}

	}

}

/// 2013.12.21 消費税改定対応 end

// 画像リスト
class admin_page_set_reserve_vessel extends OpenPNE_Action
{

    function execute($requests)
    {

/// 2013.12.21 消費税改定対応 begin
    $tmp_yy   = $_POST["year"];
	$tmp_mm   = $_POST["month"];
	$tmp_dd   = $_POST["day"];
	$tmp_ymd  = sprintf("%04d-%02d-%02d 00:00:00", $tmp_yy, $tmp_mm, $tmp_dd);
	$tmp_sql  = "";
	$tmp_sql .= "select rate from a_tax ";			/// 消費税率テーブル
	$tmp_sql .= "where stadate <= '$tmp_ymd' ";		/// 適用開始日
	$tmp_sql .= "order by stadate desc ";			/// 適用開始日の降順
	$tmp_sql .= "limit 0, 1";				/// 先頭１件
	$tmp_tab  = db_get_all($tmp_sql);
	$tmp_tax  = $tmp_tab[0]['rate'] / 100;	
    $pid='';		/// 消費税率
	$kanban;
    if($_POST['pid'])
    {
        $pid= $_POST['pid'];
        $sql = "select * from a_pre_rv where pid=$pid";
	    $a_pre_rv = db_get_all($sql);
        $sql=" select * from a_pre_rs where pid=$pid";
        $a_pre_rs = db_get_all($sql);
		$sql_pre_reserve = "select * from a_pre_reserve WHERE pid=$pid ";
        $pre_reser_data = db_get_all($sql_pre_reserve);
		
		$kanban = (!empty($pre_reser_data))?$pre_reser_data[0]['kanban']:'';
		$memo = (!empty($pre_reser_data))?$pre_reser_data[0]['memo']:'';
		
	}
    $edit=0;
    if(isset($_POST['edit']))
    {
        $edit = $_POST['edit'];
    }
    $this->set('edit',$edit);
    $this->set('pid',$pid);
	$sql = "delete from a_rental_stop where limit_datetime < now() and flag = 0";
	db_get_all($sql);
    
	// アクセス権限
	$sql = "select name, atoffice_auth_type, hall_id from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$this->set('name', $result[0]['name']);
	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);
    $this->set('pre_id',$_POST['pre_id']);
	//var_dump($_REQUEST);

	if(!$_POST['people']){
		$this->set('msg', '人数を入力してください。');
		return 'success';
	}else{
		$people = $_POST['people'];
	}

	if($_POST['c_member_id']){
	    if($_POST['c_member_id'] != $_POST['old_member'] && $_POST['old_member'])
        {
            $this->set('msg', '登録顧客ＩＤが異なっています。');
			return 'success';
        }
        else if ($_POST['old_member'])
        {
            $c_member_id = $_POST['old_member'];
        }
        else{
            $c_member_id = $_POST['c_member_id'];
        }
	//	$_SESSION['old_member']=$c_member_id;

		// ブラックリスト確認
		$sql = "select * from c_blacklist where c_member_id = '$c_member_id'";
		$result = db_get_all($sql);
		if($result){
			$this->set('msg', 'ブラックリストに追加されているユーザーです。');
			return 'success';
		}

		$sql = "select * from c_member where c_member_id = $c_member_id";
		$c_member = db_get_all($sql);
		$this->set('c_member', $c_member[0]);
	}else{
		$c_member_id = 0;
	}
    $room_id=isset($_POST['room_id'])?$_POST['room_id']:0;
	if($room_id){
	foreach($_POST as $key=>$value){

			if(preg_match('/reserve_data*/', $key)){
				$data = explode(',', $value);
				$hall_id = $data[0];

				$type = $data[4];

				if(is_null($room_id)){
					$room_id = $data[1];
				}else{
					if(is_null($reserve_day)){
						$reserve_day=date("Y-n-j",strtotime($data[2]));
					}else{
						if($reserve_day!=date("Y-n-j",strtotime($data[2]))){
							$this->set('msg', '同時に複数の日付の予約は設定できません。');
							return 'success';
						}
					}
				}

				if($type==2){
					preg_match("/_[0-9]+/",$key,$num);
					$num = explode('_', $num[0]);
					if(is_null($continue)){
						$continue.= $num[1];
						$koma = 1;
					}else{
						if($continue+1 != $num[1]){
							$this->set('msg', '選択したコマが不連続です。');
							return 'success';
						}else{
							$continue = $num[1];
							$koma++;
						}
					}
				}

				if(is_null($begin_datetime)){
					$begin_datetime = $data[2].":00";
				}

				if(preg_match("/24:00/", $data[3])){
					$finish_datetime2 = $data[3].":00";
					$finish_datetime = preg_replace("/24:00/", "23:59", $data[3]).":59";
				}else{
					$finish_datetime2 = "";
					$finish_datetime = $data[3].":00";
				}
			}
		}
	}else{
		// room mode

	foreach($_POST as $key=>$value){

		if(preg_match('/reserve_data*/', $key)){
			$data = explode(',', $value);
			$hall_id = $data[0];

			$type = $data[4];

				if(!$room_id){
					$room_id = $data[1];
				}else{
					if($room_id != $data[1]){
						$this->set('msg', '同時に複数の部屋予約は設定できません。');
						return 'success';
					}
				}

			if($type==2){
				preg_match("/_[0-9]+/",$key,$num);
				$num = explode('_', $num[0]);
				if(is_null($continue)){
					$continue.= $num[1];
					$koma = 1;
				}else{
					if($continue+1 != $num[1]){
						$this->set('msg', '選択したコマが不連続です。');
						return 'success';
					}else{
						$continue = $num[1];
						$koma++;
					}
				}
			}	
			if(is_null($begin_datetime)){
				$begin_datetime = $data[2].":00";
			}
            
            if(preg_match("/24:00/", $data[3])){
                $finish_datetime2 = $data[3].":00";                
                $finish_datetime = preg_replace("/24:00/", "23:59", $data[3]).":59";  
            }else{
                $finish_datetime2 = "";
    			$finish_datetime = $data[3].":00";
            }
		}

	}

	}// if period or room

$old_hall = $_REQUEST['old_hall'];
if(!$hall_id){
	$this->set('msg', '予約時間を選択してください。');
	return 'success';
}
else if($old_hall !="" && $old_hall !=$hall_id)
{   
    $this->set('msg', '会場が異なっています。');
	return 'success';
}

//$_SESSION['hid']=$hall_id;

	//print "<br>hall_id = $hall_id  room_id = $room_id<br>";
	//print "$hall_id -- $room_id -- $begin_datetime -- $finish_datetime<br>".$koma."コマ<br>";

// 部屋情報取得
	$sql="select * from a_room where hall_id = $hall_id and room_id = $room_id";
	$room_data = db_get_all($sql);

/// 2013.12.21 消費税改定対応 begin

	tmp_room_price_convert($room_data, 1 + $tmp_tax);

/// 2013.12.21 消費税改定対応 end

	$room_data = $room_data[0];

// 部屋利用料算出
	if($type==2){
		// 神田
		if($room_data['lowest_koma'] > $koma){
			$this->set('msg', '選択コマ不足です。');
			return 'success';
		}

		if($room_data['k_lowest_price'] and $people <= $room_data['k_capa_lowest']){
			$koma_price = $room_data['k_lowest_price'];
            $this->set('over_flag', '0');
		}elseif($room_data['k_price2'] and $room_data['k_capa_low2']<=$people and $people<=$room_data['k_capa_high2']){
			$koma_price = $room_data['k_price2'];
            $this->set('over_flag', '0');
		}elseif($room_data['k_price3'] and $room_data['k_capa_low3']<=$people and $people<=$room_data['k_capa_high3']){
			$koma_price = $room_data['k_price3'];
            $this->set('over_flag', '0');
		}elseif($room_data['k_highest_price'] and $room_data['k_capa_highest'] <= $people){
			$koma_price = $room_data['k_highest_price'];
            $this->set('over_flag', '0');
		}else{
            if($room_data['k_lowest_price']){
                $koma_price = $room_data['k_lowest_price'];
            }
            if($room_data['k_price2']){
                $koma_price = $room_data['k_price2'];
            }
            if($room_data['k_price3']){
                $koma_price = $room_data['k_price3'];
            }
            if($room_data['k_highest_price']){
                $koma_price = $room_data['k_highest_price'];
            }

			$this->set('over_flag', '1');
		}

		$room_price = $koma_price;
		//print "施設利用料（割引前）：$room_price 円<br>";

        // パック料金
		$sql = "select * from a_room_pack where hall_id = $hall_id and room_id = $room_id and pack_flag = 1 and koma1 <= $koma and koma2 >= $koma";

		$pack_data = db_get_all($sql);

/// 2013.12.21 消費税改定対応 begin

		tmp_pack_price_convert($pack_data, 1 + $tmp_tax);

/// 2013.12.21 消費税改定対応 end

		if($pack_data){
			$waribiki = $pack_data[0]['pack_name'];
			$waribiki.= $pack_data[0]['price']."%引き ";
			$room_price = round($room_price - ($room_price * ($pack_data[0]['price'] * 0.01)));
		}

		$reserve_date = $_POST['year'].sprintf('%02d', $_POST['month']).sprintf('%02d', $_POST['day']);
			//print "$reserve_date<br>";
		$percent = get_waribiki_percent($hall_id, $room_id, $reserve_date);
 		if($percent){
                	$waribiki.= "割引キャンペーン".$percent."%引き ";
			$room_price = round($room_price - ($room_price * ($percent * 0.01)));
		}

		// 代理店割引
		if($c_member_id){
			$percent = get_dairi_percent($c_member_id, $hall_id);
			if($percent){
				$waribiki.= "代理店割引き".$percent."%引き ";
				$room_price = round($room_price - ($room_price * ($percent * 0.01)));
			}
		}

		//print "1コマ　$koma_price 円<br>";
		$room_price = $room_price * $koma;

	}else{ // type
		//池袋

        $max = max($room_data['num_school'], $room_data['num_mouth'], $room_data['num_theater']);
        if($people > $max){
            $this->set('over_flag', '1');
        }else{
            $this->set('over_flag', '0');
        }

		// パック料金
		$begin_hour = explode(' ', $begin_datetime);
		$begin_hour = explode(':', $begin_hour[1]);
		$begin_hour = $begin_hour[0];

        if($finish_datetime2){
    		$finish_hour = explode(' ', $finish_datetime2);
    		$finish_hour = explode(':', $finish_hour[1]);
    		$finish_hour = $finish_hour[0];
        }else{
    		$finish_hour = explode(' ', $finish_datetime);
    		$finish_hour = explode(':', $finish_hour[1]);
    		$finish_hour = $finish_hour[0];
        }

		$sql = "select * from a_room_pack where hall_id = $hall_id and room_id = $room_id and pack_flag = 1 and begin_time = $begin_hour and finish_time = $finish_hour";

		$pack_data = db_get_all($sql);

/// 2013.12.21 消費税改定対応 begin

		tmp_pack_price_convert($pack_data, 1 + $tmp_tax);

/// 2013.12.21 消費税改定対応 end

		if($pack_data){
			$waribiki = $pack_data[0]['pack_name'];
			$room_price = $pack_data[0]['price'];

			// 代理店割引
			if($c_member_id){
				$percent = get_dairi_percent($c_member_id, $hall_id);
				if($percent){
					$waribiki.= " + 代理店割引き".$percent."%引き ";

/// 2014.01.14 料金が四捨五入されない不具合の修正 begin
					$room_price = round($room_price - ($room_price * $percent * 0.01));
/// 2014.01.14 料金が四捨五入されない不具合の修正 end

				}
			}
		}else{
			$room_price = 0;
			for($x=1;$x<=23;$x++){
				if($begin_hour <= $room_data['begin_time'.$x] and $finish_hour >= $room_data['finish_time'.$x]){
					$room_price += $room_data['price'.$x];
				}
			}

			// 代理店割引
			if($percent==0){
				$reserve_date = $_POST['year'].sprintf('%02d', $_POST['month']).sprintf('%02d', $_POST['day']);
				//print "$reserve_date<br>";
				$percent = get_waribiki_percent($hall_id, $room_id, $reserve_date);
				if($percent){
					$waribiki.= "割引キャンペーン".$percent."%引き ";

/// 2014.01.14 料金が四捨五入されない不具合の修正 begin
					$room_price = round($room_price - ($room_price * $percent * 0.01));
/// 2014.01.14 料金が四捨五入されない不具合の修正 end

				}
			}
			if($c_member_id){
				$percent = get_dairi_percent($c_member_id, $hall_id);
                		if($percent){
					$waribiki.= "代理店割引き".$percent."%引き ";

/// 2014.01.14 料金が四捨五入されない不具合の修正 begin
					$room_price = round($room_price - ($room_price * $percent * 0.01));
/// 2014.01.14 料金が四捨五入されない不具合の修正 end

				}
			}

//			if($percent){
//				$room_price = $room_price - ($room_price * $percent * 0.01);
//			}

		}

		//print "$waribiki $percent%引き>>> $room_price<br>";

	}


	// データセット
	$this->set('people', $people);
	$this->set('purpose', $_POST['purpose']);
	$this->set('c_member_id', $c_member_id);
	$this->set('year', $_POST['year']);
	$this->set('month', $_POST['month']);
	$this->set('day', $_POST['day']);
	$this->set('hall_id', $hall_id);
	$this->set('hall_name', get_hall_name($hall_id));
	$this->set('room_id', $room_id);
	$this->set('room_name', get_room_name($hall_id, $room_id));

	$this->set('begin_datetime', $begin_datetime);
	$dt = new DateTime($begin_datetime);
	$this->set('begin', $dt->format("Y年m月d日 H時i分"));
	$this->set('finish_datetime', $finish_datetime);
	$dt = new DateTime($finish_datetime);
    $week = get_week($dt->format("Ymd"));
	$this->set('finish', $dt->format("Y年m月d日 H時i分 ($week)"));
	$this->set('waribiki', $waribiki);
	$this->set('percent', $percent);
	$this->set('room_price', $room_price);
	$this->set('kanban',$kanban);

// 備品取得

	$sql = "select vessel_id from a_room_vessel where hall_id = $hall_id and room_id = $room_id and flag = 0";
	$vessel_id_list = db_get_all($sql);
	if($vessel_id_list){
		$sql = "select * from a_vessel_data where ";
		foreach($vessel_id_list as $key=>$value){
			$sql.="vessel_id = ".$value['vessel_id']." ";
			if ($vessel_id_list[($key+1)]['vessel_id']){
				$sql.="or ";
			}
		}
        $sql.=" order by weight desc";
		$vessel_num = count($vessel_id_list);

		$vessel_list = db_get_all($sql);
	// 在庫数

/// 2013.12.21 消費税改定対応 begin

	for($i = 0; $i < count($vessel_list); $i++){
		$tmp_price = $vessel_list[$i]['price'];			/// 備品使用料
		$tmp_price = round($tmp_price * 100 / 105);		/// 本体価格
		$tmp_price = round($tmp_price * (1 + $tmp_tax));	/// 税込み価格
		$vessel_list[$i]['price'] = $tmp_price;			/// 書き換え
	}
/// 2013.12.21 消費税改定対応 end		
		foreach($vessel_list as $key=>$value){
            if($finish_datetime2){
    			$reserve_vessel_num = get_reserve_vessel($hall_id, $room_id, $begin_datetime, $finish_datetime2, $value['vessel_id']);
            }else{
    			$reserve_vessel_num = get_reserve_vessel($hall_id, $room_id, $begin_datetime, $finish_datetime, $value['vessel_id']);
            }
			//print "vessel_id = ".$value['vessel_id']." 予約数＝".$reserve_vessel_num."<br>";
			//print $reserve_vessel_num."<br>";
			//予約数を引く
			$vessel_list[$key]['remainder'] = $value['num'] - $reserve_vessel_num;
			if($vessel_list[$key]['remainder'] > 0){
				$list = array();
				for($x=1;$x<=$vessel_list[$key]['remainder'];$x++){
					array_push($list, $x);
				}
				$vessel_list[$key]['remainder'] = $list;
			}else{
				$vessel_list[$key]['remainder'] = 0;
			}
            $vessel_list[$key]['check']=0;
            $vessel_list[$key]['number']=0;
            if(!empty($a_pre_rv))
            {
                foreach($a_pre_rv as $k=>$v)
                {
                    if($value['vessel_id']==$v['vessel_id'])
                    {
                        $vessel_list[$key]['check']=1;
                        $vessel_list[$key]['number']=$v['num'];
                    }
                }
            }

		}
	}else{
		$vessel_list = 0;
		$vessel_num = 0;
	}
    
	$this->set('vessel_num', count($vessel_list));
	$this->set('vessel_list', $vessel_list);

// サービス取得

	$sql = "select service_id from a_room_service where hall_id = $hall_id and room_id = $room_id and flag = 0";
	$service_id_list = db_get_all($sql);
	if($service_id_list){
		$sql = "select * from a_service_data where ";
		foreach($service_id_list as $key=>$value){
			$sql.="service_id = ".$value['service_id']." ";
			if ($service_id_list[($key+1)]['service_id']){
				$sql.="or ";
			}
		}
        $sql.=" order by weight desc";
		$service_list = db_get_all($sql);

/// 2013.12.21 消費税改定対応 begin

	for($i = 0; $i < count($service_list); $i++){
		$tmp_price = $service_list[$i]['price'];		/// サービス使用料
		$tmp_price = round($tmp_price * 100 / 105);		/// 本体価格
		$tmp_price = round($tmp_price * (1 + $tmp_tax));	/// 税込み価格
		$service_list[$i]['price'] = $tmp_price;		/// 書き換え
	}

/// 2013.12.21 消費税改定対応 end

	// 在庫数
		foreach($service_list as $key=>$value){
            
			$service_list[$key]['remainder'] = $value['num'];
            $service_list[$key]['check']=0;
            $service_list[$key]['number']=0;
            if(!empty($a_pre_rs))
            {
                foreach($a_pre_rs as $k=>$v)
                {
                    if($value['service_id']==$v['service_id'])
                    {
                        $service_list[$key]['check']=1;
                        $service_list[$key]['number']=$v['num'];
                    }
                }
            }

		}
	}else{
		$service_list = 0;
	}
    $this->set('service_num', count($service_list));
	$this->set('service_list', $service_list);

    if($c_member_id){
        if(check_guest($c_member_id)){
            $this->set('guest', "ゲスト");
        }else{
            $this->set('guest', "会員");
        }
    }

        $_SESSION['set_reserver_vesel']=1;
        return 'success';
    }
}

?>
