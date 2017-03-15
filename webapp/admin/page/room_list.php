<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_page_room_list extends OpenPNE_Action
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
		$hall_id = preg_replace("/[^0-9]+/", "", $_GET['msg']);
		$this->set('msg', preg_replace("/[0-9]+/", "", $_GET['msg']));
	}else{
		$hall_id = $_POST['hall_id'];
	}
	$this->set('hall_id', $hall_id);


	// 有効フラグ変更
	if($_POST['flag_change']==100 and $_POST['room_id']){

		$sql = "update a_room SET flag = 0 where hall_id = $hall_id and room_id = ".$_POST['room_id'];
		db_get_all($sql);

	}elseif($_POST['flag_change']==200 and $_POST['room_id']){

		$sql = "update a_room SET flag = 1 where hall_id = $hall_id and room_id = ".$_POST['room_id'];
		db_get_all($sql);

	}

	//会場名・総部屋数データ取得
	$sql = "select hall_name, rooms, begin, finish,begin1, finish1,begin2, finish2,begin3, finish3,begin4, finish4 from a_hall where hall_id = $hall_id";
	$result = db_get_all($sql);
	$this->set('hall_name', $result[0]['hall_name']);
	$this->set('hall_begin', $result[0]['begin']);
	$this->set('hall_finish', $result[0]['finish']);
	$open = $result[0]['finish'] - $result[0]['begin'];
	$begin = $result[0]['begin'];
	$finish = $result[0]['finish'];
	// add 2016-06-21
	if($result[0]['begin1']== '' || $result[0]['finish1']== '' )
	{
		$result[0]['begin1'] = $result[0]['begin'];
		$result[0]['finish1'] = $result[0]['finish'];
	}
	$this->set('hall_begin1', $result[0]['begin1']);
	$this->set('hall_finish1', $result[0]['finish1']);
	
	$open1 = $result[0]['finish1'] - $result[0]['begin1'];
	$begin1 = $result[0]['begin1'];
	$finish1 = $result[0]['finish1'];
	if($result[0]['begin2']== '' || $result[0]['finish2']== '' )
	{
		$result[0]['begin2'] = $result[0]['begin'];
		$result[0]['finish2'] = $result[0]['finish'];
	}
	$this->set('hall_begin2', $result[0]['begin2']);
	$this->set('hall_finish2', $result[0]['finish2']);
	$open2 = $result[0]['finish2'] - $result[0]['begin2'];
	$begin2 = $result[0]['begin2'];
	$finish2 = $result[0]['finish2'];
	if($result[0]['begin3']== '' || $result[0]['finish3']== '' )
	{
		$result[0]['begin3'] = $result[0]['begin'];
		$result[0]['finish3'] = $result[0]['finish'];
	}
	$this->set('hall_begin3', $result[0]['begin3']);
	$this->set('hall_finish3', $result[0]['finish3']);
	$open3 = $result[0]['finish3'] - $result[0]['begin3'];
	$begin3 = $result[0]['begin3'];
	$finish3 = $result[0]['finish3'];
	if($result[0]['begin4']== '' || $result[0]['finish4']== '' )
	{
		$result[0]['begin4'] = $result[0]['begin'];
		$result[0]['finish4'] = $result[0]['finish'];
	}
	$this->set('hall_begin4', $result[0]['begin4']);
	$this->set('hall_finish4', $result[0]['finish4']);
	$open4 = $result[0]['finish4'] - $result[0]['begin4'];
	$begin4 = $result[0]['begin4'];
	$finish4 = $result[0]['finish4'];
	//end
	
	$rooms = array();
	for($x=0; $x<$result[0]['rooms']; $x++){
		array_push($rooms, $x);
	}
	$this->set('rooms', $rooms);

	$sql = "select * from a_room where hall_id = $hall_id order by room_id";
	$result = db_get_all($sql);
	// 選択キャンセル料率
	foreach($result as $key=>$value){
		$sql = "select * from a_cancel_charge where hall_id = $hall_id and pattern_id = ".$value['cancel'];
		$cancel_pattern = db_get_all($sql);
		$result[$key]['cancel_pattern']=$cancel_pattern[0];

		// 有効割引パターン
		$sql = "select * from a_room_discount where hall_id = $hall_id and room_id = ".($key+1)." and flag = 1";
		$discount_list = db_get_all($sql);
		//var_dump($discount_list);
		$result[$key]['discount']=$discount_list;

		// 有効packパターン
		$sql = "select * from a_room_pack where hall_id = $hall_id and room_id = ".($key+1)." and pack_flag = 1";
		$pack_list = db_get_all($sql);
		$result[$key]['pack']=$pack_list;

		// 登録備品
		$result[$key]['vessel_list']="";
		$sql = "select vessel_id from a_room_vessel where hall_id = $hall_id and room_id = ".($key+1)." order by weight desc";
		$vessel_id_list = db_get_all($sql);
		foreach($vessel_id_list as $vessel_id){
			$sql = "select vessel_name from a_vessel_data where vessel_id = ".$vessel_id['vessel_id'];
			$vessel_name = db_get_all($sql);
			if ($vessel_name[0]['vessel_name']){
				$result[$key]['vessel_list'].=$vessel_name[0]['vessel_name']." ";
			}
		}


		// 登録サービス
		$result[$key]['service_list']="";
		$sql = "select service_id from a_room_service where hall_id = $hall_id and room_id = ".($key+1)." order by weight desc";
		$service_id_list = db_get_all($sql);
		foreach($service_id_list as $service_id){
			$sql = "select service_name from a_service_data where service_id = ".$service_id['service_id'];
			$service_name = db_get_all($sql);
			if ($service_name[0]['service_name']){
				$result[$key]['service_list'].=$service_name[0]['service_name']." ";
			}
		}

		if($value['type']==1){
//---1-----------			
			$span_list=array();
			$line = 0;
			if($begin1!=$value['begin_time1']){
						//開始休憩
						$span = $value['begin_time1']-$begin1;
						$span_list[$line]['rest']=1;
						$span_list[$line]['span']=$span;
						$line++;
			}

			//1コマ
			$span = $value['finish_time1']-$value['begin_time1'];
			$span_list[$line]['rest']=0;
			$span_list[$line]['span']=$span;
			$line++;

			// 24コマ
			for($x=2;$x<=24;$x++){
				//コマ間休憩
				if($value['begin_time'.$x]){

					$span = $value['begin_time'.$x]-$value['finish_time'.($x-1)];
					$span_list[$line]['rest']=1;
					$span_list[$line]['span']=$span;
				}else{
	                if($finish1 != $value['finish_time'.($x-1)]){
	    				//最終休憩
	    				$span = $finish1-$value['finish_time'.($x-1)];
	    				$span_list[$line]['rest']=1;
	    				$span_list[$line]['span']=$span;
	    				break;
	                }else{
	                    break;
	                }

				}
				$line++;
				// コマ
				if($value['begin_time'.$x]){
	                if($finish1 == $value['finish_time'.$x]){
	    				$span = $value['finish_time'.$x]-$value['begin_time'.$x];
	    				$span_list[$line]['rest']=0;
	    				$span_list[$line]['span']=$span;
	                    break;
	                }else{
	    				$span = $value['finish_time'.$x]-$value['begin_time'.$x];
	    				$span_list[$line]['rest']=0;
	    				$span_list[$line]['span']=$span;
	                }

				}
				$line++;

			}

			$result[$key]['span_list1']=$span_list;
//--- 2 ---
		$span_list=array();
			$line = 0;
			if($begin2!=$value['begin_time1']){
						//開始休憩
						$span = $value['begin_time1']-$begin2;
						$span_list[$line]['rest']=1;
						$span_list[$line]['span']=$span;
						$line++;
			}

			//1コマ
			$span = $value['finish_time1']-$value['begin_time1'];
			$span_list[$line]['rest']=0;
			$span_list[$line]['span']=$span;
			$line++;

			// 24コマ
			for($x=2;$x<=24;$x++){
				//コマ間休憩
				if($value['begin_time'.$x]){

					$span = $value['begin_time'.$x]-$value['finish_time'.($x-1)];
					$span_list[$line]['rest']=1;
					$span_list[$line]['span']=$span;
				}else{
	                if($finish2 != $value['finish_time'.($x-1)]){
	    				//最終休憩
	    				$span = $finish2-$value['finish_time'.($x-1)];
	    				$span_list[$line]['rest']=1;
	    				$span_list[$line]['span']=$span;
	    				break;
	                }else{
	                    break;
	                }

				}
				$line++;
				// コマ
				if($value['begin_time'.$x]){
	                if($finish2 == $value['finish_time'.$x]){
	    				$span = $value['finish_time'.$x]-$value['begin_time'.$x];
	    				$span_list[$line]['rest']=0;
	    				$span_list[$line]['span']=$span;
	                    break;
	                }else{
	    				$span = $value['finish_time'.$x]-$value['begin_time'.$x];
	    				$span_list[$line]['rest']=0;
	    				$span_list[$line]['span']=$span;
	                }

				}
				$line++;

			}

			$result[$key]['span_list2']=$span_list;
//---3----
	$span_list=array();
			$line = 0;
			if($begin3!=$value['begin_time1']){
						//開始休憩
						$span = $value['begin_time1']-$begin3;
						$span_list[$line]['rest']=1;
						$span_list[$line]['span']=$span;
						$line++;
			}

			//1コマ
			$span = $value['finish_time1']-$value['begin_time1'];
			$span_list[$line]['rest']=0;
			$span_list[$line]['span']=$span;
			$line++;

			// 24コマ
			for($x=2;$x<=24;$x++){
				//コマ間休憩
				if($value['begin_time'.$x]){

					$span = $value['begin_time'.$x]-$value['finish_time'.($x-1)];
					$span_list[$line]['rest']=1;
					$span_list[$line]['span']=$span;
				}else{
	                if($finish3 != $value['finish_time'.($x-1)]){
	    				//最終休憩
	    				$span = $finish3-$value['finish_time'.($x-1)];
	    				$span_list[$line]['rest']=1;
	    				$span_list[$line]['span']=$span;
	    				break;
	                }else{
	                    break;
	                }

				}
				$line++;
				// コマ
				if($value['begin_time'.$x]){
	                if($finish3 == $value['finish_time'.$x]){
	    				$span = $value['finish_time'.$x]-$value['begin_time'.$x];
	    				$span_list[$line]['rest']=0;
	    				$span_list[$line]['span']=$span;
	                    break;
	                }else{
	    				$span = $value['finish_time'.$x]-$value['begin_time'.$x];
	    				$span_list[$line]['rest']=0;
	    				$span_list[$line]['span']=$span;
	                }

				}
				$line++;

			}

			$result[$key]['span_list3']=$span_list;
//---4----
		$span_list=array();
			$line = 0;
			if($begin4 !=$value['begin_time1']){
						//開始休憩
						$span = $value['begin_time1']-$begin4;
						$span_list[$line]['rest']=1;
						$span_list[$line]['span']=$span;
						$line++;
			}

			//1コマ
			$span = $value['finish_time1']-$value['begin_time1'];
			$span_list[$line]['rest']=0;
			$span_list[$line]['span']=$span;
			$line++;

			// 24コマ
			for($x=2;$x<=24;$x++){
				//コマ間休憩
				if($value['begin_time'.$x]){

					$span = $value['begin_time'.$x]-$value['finish_time'.($x-1)];
					$span_list[$line]['rest']=1;
					$span_list[$line]['span']=$span;
				}else{
	                if($finish4 != $value['finish_time'.($x-1)]){
	    				//最終休憩
	    				$span = $finish4-$value['finish_time'.($x-1)];
	    				$span_list[$line]['rest']=1;
	    				$span_list[$line]['span']=$span;
	    				break;
	                }else{
	                    break;
	                }

				}
				$line++;
				// コマ
				if($value['begin_time'.$x]){
	                if($finish4 == $value['finish_time'.$x]){
	    				$span = $value['finish_time'.$x]-$value['begin_time'.$x];
	    				$span_list[$line]['rest']=0;
	    				$span_list[$line]['span']=$span;
	                    break;
	                }else{
	    				$span = $value['finish_time'.$x]-$value['begin_time'.$x];
	    				$span_list[$line]['rest']=0;
	    				$span_list[$line]['span']=$span;
	                }

				}
				$line++;

			}

			$result[$key]['span_list4']=$span_list;	
	$ikebukuro = array();
	for($x=1;$x<=24;$x++){
		if(!$value['price'.$x]){
			break;
		}
		$ikebukuro[$x]['koma']=$x;
		$ikebukuro[$x]['begin_time']=$value['begin_time'.$x];
		$ikebukuro[$x]['finish_time']=$value['finish_time'.$x];
		$ikebukuro[$x]['price']=$value['price'.$x];
	}
//var_dump($ikebukuro);
			$result[$key]['ikebukuro']=$ikebukuro;

		}elseif($value['type']==2){

			if($value['koma']>=1){
//---1-----
    			$loop = intval(($open1 / $value['koma']));
    			$loop_list=array();
    			for($x=0; $x<$loop; $x++){
    				array_push($loop_list, $x);
    			}
    			$result[$key]['loop_list1']=$loop_list;

    			// 余り
    			$etc = $open1 % $value['koma'];
    			$etc_list=array();
    			for($x=0; $x<$etc; $x++){
    				array_push($etc_list, $x);
    			}
    			$result[$key]['etc_list1']=$etc_list;
//---2-----
    			$loop = intval(($open2 / $value['koma']));
    			$loop_list=array();
    			for($x=0; $x<$loop; $x++){
    				array_push($loop_list, $x);
    			}
    			$result[$key]['loop_list2']=$loop_list;

    			// 余り
    			$etc = $open2 % $value['koma'];
    			$etc_list=array();
    			for($x=0; $x<$etc; $x++){
    				array_push($etc_list, $x);
    			}
    			$result[$key]['etc_list2']=$etc_list;
//---3-----
    			$loop = intval(($open3 / $value['koma']));
    			$loop_list=array();
    			for($x=0; $x<$loop; $x++){
    				array_push($loop_list, $x);
    			}
    			$result[$key]['loop_list3']=$loop_list;

    			// 余り
    			$etc = $open3 % $value['koma'];
    			$etc_list=array();
    			for($x=0; $x<$etc; $x++){
    				array_push($etc_list, $x);
    			}
    			$result[$key]['etc_list3']=$etc_list;
////---1-----
    			$loop = intval(($open4 / $value['koma']));
    			$loop_list=array();
    			for($x=0; $x<$loop; $x++){
    				array_push($loop_list, $x);
    			}
    			$result[$key]['loop_list4']=$loop_list;

    			// 余り
    			$etc = $open4 % $value['koma'];
    			$etc_list=array();
    			for($x=0; $x<$etc; $x++){
    				array_push($etc_list, $x);
    			}
    			$result[$key]['etc_list4']=$etc_list;
			}else{
				if($value['koma']==0.25){
					$result[$key]['th_span']=4;
				}else{
					$result[$key]['th_span']=2;
				}
				$minutes=array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24);
				$result[$key]['minutes']=$minutes;
			}

		}



	}


	$time_list = array();
	for($x=0; $x<=24; $x++){
		array_push($time_list, $x);
	}
	$this->set('time_list', $time_list);
	$this->set('day_time', '25');
	$this->set('room_data', $result);

        return 'success';
    }
}

?>
