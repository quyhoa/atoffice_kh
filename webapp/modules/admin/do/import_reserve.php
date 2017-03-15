<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// メンバー情報一括登録
class admin_do_import_reserve extends OpenPNE_Action
{
    function handleError($msg)
    {
        admin_client_redirect('import_c_member', $msg);
    }

    function execute($requests)
    {
        $member_file = $_FILES['member_file'];

        $limit = 1000;  // 行数制限

        if (empty($member_file) || $member_file['error'] === UPLOAD_ERR_NO_FILE) {
            $this->handleError('ファイルを指定してください');
        }

        $filename_parts = explode('.', $member_file['name']);
        if (array_pop($filename_parts) != 'csv') {
            $this->handleError('拡張子は.csvにしてください');
        }

        $handle = fopen($member_file['tmp_name'], 'r');

        if (($data = fgetcsv($handle, 4096)) === false) {
            $this->handleError('ファイルの内容が空です');
        }


        $row = 1; // 1行目がタイトル行
        $count = 0; // 登録に成功した数

        while (($data = fgetcsv($handle, 4096)) !== false && $row <= $limit) {
		$row++;
		//var_dump($data);
		//print "<br>";

		// hid取得
		$sql = "select * from a_hall where hall_name = '".$data[4]."'";
		$hall_id = db_get_all($sql);
		$hall_id = $hall_id[0]['hall_id'];
		//print "hall_id = $hall_id ".mb_convert_encoding($data[4], "UTF-8", "sjis-win")."<br>";

		if(!$hall_id){
			admin_client_redirect('import_reserve', $row.'行目：会場名を会場IDに変換できませんでした。変換できなかった会場名【'.$data[4]."】");
			exit();
		}

		// rid取得
		$room_name = $data[5];
		$result = convert_room_name($hall_id, $room_name);
		$hall_id = $result['hall_id'];
		$room_name = $result['room_name'];
		$sql = "select * from a_room where hall_id = $hall_id and room_name = '$room_name'";
		$room_id = db_get_all($sql);
		$room_id = $room_id[0]['room_id'];
		//print $hall_id."<>".$room_id."<br>";

		if(!$room_id){
			admin_client_redirect('import_reserve', $row.'行目：部屋名を部屋IDに変換できませんでした。変換できなかった会場・部屋名【'.$data[4]."】【".$data[5]."】");
			exit();
		}


		// 顧客ID取得
		$hashed_mail = t_encrypt($data[15]);
		$sql = "select c_member_id from c_member_secure where pc_address = '".$hashed_mail."'";
		$c_member_id = db_get_all($sql);
		$c_member_id = $c_member_id[0]['c_member_id'];
		if(!$c_member_id){
			// ゲストとして登録
			$sql = "insert into c_member (nickname, birth_year, birth_month, birth_day, r_date, is_login_rejected, guest_flag) values (";
			$sql.= "'".$data[9]."', ";
			$sql.= "2000, ";
			$sql.= "1, ";
			$sql.= "1, ";
			$sql.= "now(), 1, 1)";
			//print $sql."<br>";
			db_get_all($sql);

			$sql = "SELECT c_member_id FROM c_member where nickname = ";
			$sql.= "'".$data[9]."'  and ";
			$sql.= "(r_date  BETWEEN (NOW() - INTERVAL 1 minute) AND NOW())";
			$c_member_id = db_get_all($sql);
			$c_member_id = $c_member_id[0]['c_member_id'];
			$u = $c_member_id;

			// c_member_secure 追加
			$hashed_password = md5('guest');
			$sql = "insert into c_member_secure (c_member_id, hashed_password, pc_address, regist_address) values (";
			$sql.= $u.", '".$hashed_password."', '".$hashed_mail."', '".$hashed_mail."')";
			//print $sql."<br>";
			db_get_all($sql);

			// プロフィール「カナ」
			$sql = "insert into c_member_profile (c_member_id, c_profile_id, c_profile_option_id, value) values (";
			$sql.= $u.", ";
			$sql.= "11, 0, ";
			$sql.= "'".$data[10]."')";
			//print $sql."<br>";
			db_get_all($sql);

			// プロフィール「法人名」
			$sql = "insert into c_member_profile (c_member_id, c_profile_id, c_profile_option_id, value) values (";
			$sql.= $u.", ";
			$sql.= "12, 0, ";
			$sql.= "'".$data[11]."')";
			//print $sql."<br>";
			db_get_all($sql);

			// プロフィール「電話番号」
			$sql = "insert into c_member_profile (c_member_id, c_profile_id, c_profile_option_id, value) values (";
			$sql.= $u.", ";
			$sql.= "17, 0, ";
			$sql.= "'".$data[16]."')";
			//print $sql."<br>";
			db_get_all($sql);

			// プロフィール「郵便番号」
			$sql = "insert into c_member_profile (c_member_id, c_profile_id, c_profile_option_id, value) values (";
			$sql.= $u.", ";
			$sql.= "13, 0, ";
			$sql.= "'".$data[13]."')";
			//print $sql."<br>";
			db_get_all($sql);

			// プロフィール「県」

			// 都道府県ID
			$ken = get_ken_id($data[27]);
			$sql = "insert into c_member_profile (c_member_id, c_profile_id, c_profile_option_id, value) values (";
			$sql.= $u.", ";
			$sql.= "'3', '".$ken."', ";
			$sql.= "'".$data[27]."')";
			//print $sql."<br>";
			db_get_all($sql);

			// プロフィール「市区町村」
			$sql = "insert into c_member_profile (c_member_id, c_profile_id, c_profile_option_id, value) values (";
			$sql.= $u.", ";
			$sql.= "14, 0, ";
			$sql.= "'".$data[28]."')";
			//print $sql."<br>";
			db_get_all($sql);

			// プロフィール「番地」
			$sql = "insert into c_member_profile (c_member_id, c_profile_id, c_profile_option_id, value) values (";
			$sql.= $u.", ";
			$sql.= "15, 0, ";
			$sql.= "'".$data[29]."')";
			//print $sql."<br>";
			db_get_all($sql);


			// プロフィール「建物名」
			$sql = "insert into c_member_profile (c_member_id, c_profile_id, c_profile_option_id, value) values (";
			$sql.= $u.", ";
			$sql.= "16, 0, ";
			$sql.= "'".$data[30]."')";
			//print $sql."<br>";
			db_get_all($sql);



		}
		//print "c_member_id = $c_member_id<br>";

		// 開始・終了時間
		$datetime = split('～', $data[6]);
		$date = $data[1];
		$date = str_replace('/', '-', $date);

		$begin_datetime = $date." ".$datetime[0].":00";
		if($datetime[1] == "24:00"){
			$finish_datetime = $date." 23:59:59";
		}else{
			$finish_datetime = $date." ".$datetime[1].":00";
		}
//print $begin_datetime."<br>";
		//print "$begin_datetime ～ $finish_datetime<br>";

		// 申し込み日
		$add_date = $data[0];
		$add_date = str_replace('/', '-', $add_date);
		$tmp_reserve_datetime = $add_date." 00:00:00";


		// 利用目的
		$purpose = get_purpose_id($data[18]);
		//print $purpose;

		// 入金データ関連
		if($data[31]){
			// 仮予約
			$reserve_datetime = "";
			$pay_limitdate = "";
			$pay_money = 0;
			$pay_checkdate = "";
			$pay_flag = 0;
			$virtual_number = 0;
			$bill_id = 0;

		}else{
			// 承認済み予約

			$reserve_datetime = $data[32];
			$pay_limitdate = $data[33];
			$pay_money = $data[34];
			$pay_checkdate = $data[35];
			$pay_flag = $data[36];

			// 仮想口座番号取得
			$virtual_number = get_virtual_number($c_member_id);
			if(!$virtual_number){
				admin_client_redirect('import_reserve', $row.'行目：バーチャル口座番号に空きがありません');
				exit();
			}else{
				// 登録
				$sql = "update a_virtual_account_list SET ";
				$sql.= "flag = 1, ";
				$sql.= "c_member_id = '".$c_member_id."' ";
				$sql.= "where virtual_number = '$virtual_number'";
				db_get_all($sql);
			}
		}

		// 登録sql
		$sql = "insert into a_reserve_list (hall_id,room_id,c_member_id,begin_datetime,finish_datetime,tmp_reserve_datetime,tmp_flag,room_price,vessel_price,service_price,total_price,people,purpose,kanban,memo,reserve_datetime,pay_limitdate,pay_money,pay_checkdate,pay_flag,virtual_code) values (";
		$sql.= "'".$hall_id."', ";
		$sql.= "'".$room_id."', ";
		$sql.= "'".$c_member_id."', ";
		$sql.= "'".$begin_datetime."', ";
		$sql.= "'".$finish_datetime."', ";
		$sql.= "'".$tmp_reserve_datetime."', ";
		$sql.= "'".$data[31]."', ";
		$sql.= "'".$data[22]."', ";
		$sql.= "'".$data[24]."', ";
		$sql.= "'0', ";
		$sql.= "'".($data[22] + $data[24])."', ";
		$sql.= "'".$data[21]."', ";
		$sql.= "'".$purpose."', ";
		$sql.= "'".$data[17]."', ";
		if($data[23]){
			$memo = $data[23]."\nASPからのインポートデータ。\n要台帳チェック。";
		}else{
			$memo = "ASPからのインポートデータ。\n要台帳チェック。";
		}
		$sql.= "'".$memo."', ";

		$sql.= "'".$reserve_datetime."', ";
		$sql.= "'".$pay_limitdate."', ";
		$sql.= "'".$pay_money."', ";
		$sql.= "'".$pay_checkdate."', ";
		$sql.= "'".$pay_flag."', ";
		$sql.= "'".$virtual_number."' ";

		$sql.= ")";

		//print $sql."<br>";
		db_get_all($sql);

		// 請求番号更新
		if(!$data[31]){
			// 予約ID取得
			$sql = "select reserve_id from a_reserve_list where ";
			$sql.= "hall_id = '".$hall_id."' and ";
			$sql.= "room_id = '".$room_id."' and ";
			$sql.= "c_member_id = '".$c_member_id."' and ";
			$sql.= "begin_datetime = '".$begin_datetime."' and ";
			$sql.= "finish_datetime = '".$finish_datetime."' and ";
			$sql.= "tmp_reserve_datetime = '".$tmp_reserve_datetime."'";
			$reserve_id = db_get_all($sql);
			$reserve_id = $reserve_id[0]['reserve_id'];
//print $sql."<br>";
//print ">>>".$reserve_id."<br>";
			$bill_id = get_bill_id($reserve_id, 0);
			if(!$bill_id){
				admin_client_redirect('import_reserve', $row.'行目：請求番号が取得できませんでした。');
				exit();
			}
			$sql = "update a_reserve_list SET bill_id = ".$bill_id." where reserve_id = ".$reserve_id;
			//print $sql."<br>";
			db_get_all($sql);
		}

		$count++;
        }
        fclose($handle);

        admin_client_redirect('import_reserve', "{$count}件の予約インポートが完了しました");
    }

}

function convert_room_name($hall_id, $room_name){

	$return_data = array();

	// 池袋
	if($hall_id==3 and $room_name=='本館501号室（50人）'){
		$return_data['hall_id'] = $hall_id;
		$return_data['room_name'] = '501号室';
	}
	if($hall_id==3 and $room_name=='本館601号室（50人）'){
		$return_data['hall_id'] = $hall_id;
		$return_data['room_name'] = '601号室';
	}
	if($hall_id==3 and $room_name=='本館701号室（50人）'){
		$return_data['hall_id'] = $hall_id;
		$return_data['room_name'] = '701号室';
	}
	if($hall_id==3 and $room_name=='本館801号室（10人）'){
		$return_data['hall_id'] = $hall_id;
		$return_data['room_name'] = '801号室';
	}
	if($hall_id==3 and $room_name=='本館802号室（24人）'){
		$return_data['hall_id'] = $hall_id;
		$return_data['room_name'] = '802号室';
	}
	if($hall_id==3 and $room_name=='本館803号室（12人）'){
		$return_data['hall_id'] = $hall_id;
		$return_data['room_name'] = '803号室';
	}
	if($hall_id==3 and $room_name=='本館901号室（10人）'){
		$return_data['hall_id'] = $hall_id;
		$return_data['room_name'] = '901号室';
	}
	if($hall_id==3 and $room_name=='本館902号室（24人）'){
		$return_data['hall_id'] = $hall_id;
		$return_data['room_name'] = '902号室';
	}
	if($hall_id==3 and $room_name=='本館903号室（12人）'){
		$return_data['hall_id'] = $hall_id;
		$return_data['room_name'] = '903号室';
	}
	if($hall_id==3 and $room_name=='本館1001号室（36人）多目的スペース'){
		$return_data['hall_id'] = $hall_id;
		$return_data['room_name'] = '1001号室（多目的スペース）';
	}
	if($hall_id==3 and $room_name=='別館9階（72人）※本館並び'){
		$hall_id = 25;
		$room_name = '別館9階（72人）※本館並び';
	}

	// 表参道
	if($hall_id==17 and $room_name=='702号室（33人）'){
		$return_data['hall_id'] = $hall_id;
		$return_data['room_name'] = '702号室';
	}

	// AOYAMA-I
	if($hall_id==20 and $room_name=='ホワイト（801号室）'){
		$return_data['hall_id'] = $hall_id;
		$return_data['room_name'] = 'ホワイトルーム（801号室）';
	}
	if($hall_id==20 and $room_name=='ブラック（802号室）'){
		$return_data['hall_id'] = $hall_id;
		$return_data['room_name'] = 'ブラックルーム（802号室）';
	}
	if($hall_id==20 and $room_name=='401'){
		$return_data['hall_id'] = $hall_id;
		$return_data['room_name'] = '401号室';
	}

	// 神田
	if($hall_id==14 and $room_name=='駅前会議室'){
		$return_data['hall_id'] = $hall_id;
		$return_data['room_name'] = '3階';
	}

	// 千駄ヶ谷
	if($hall_id==18 and $room_name=='701号室（69人）'){
		$return_data['hall_id'] = $hall_id;
		$return_data['room_name'] = '701号室';
	}

	// 八重洲
	if($hall_id==13 and $room_name=='I号室（３５席）'){
		$return_data['hall_id'] = $hall_id;
		$return_data['room_name'] = '１号室';
	}
	if($hall_id==13 and $room_name=='II号室（５２席）'){
		$return_data['hall_id'] = $hall_id;
		$return_data['room_name'] = '２号室';
	}
	if($hall_id==13 and $room_name=='III号室（２８席）'){
		$return_data['hall_id'] = $hall_id;
		$return_data['room_name'] = '３号室';
	}
	if($hall_id==13 and $room_name=='IV号室（５３席）'){
		$return_data['hall_id'] = $hall_id;
		$return_data['room_name'] = '４号室';
	}
	if($hall_id==13 and $room_name=='V号室（３５席）'){
		$return_data['hall_id'] = $hall_id;
		$return_data['room_name'] = '５号室';
	}
	if($hall_id==13 and $room_name=='ミーティングA（６席）'){
		$return_data['hall_id'] = $hall_id;
		$return_data['room_name'] = 'ミーティングルームＡ';
	}
	if($hall_id==13 and $room_name=='ミーティングB（８席）'){
		$return_data['hall_id'] = $hall_id;
		$return_data['room_name'] = 'ミーティングルームＢ';
	}
	if($hall_id==13 and $room_name=='ミーティングルームＣ（１２席）'){
		$return_data['hall_id'] = $hall_id;
		$return_data['room_name'] = 'ミーティングルームＣ';
	}

	// 茅場町
	if($hall_id==16 and $room_name=='２０１号室'){
		$return_data['hall_id'] = $hall_id;
		$return_data['room_name'] = '201号室';
	}
	if($hall_id==16 and $room_name=='８０１号室'){
		$return_data['hall_id'] = $hall_id;
		$return_data['room_name'] = '801号室';
	}

	// 南青山
	if($hall_id==22 and $room_name=='２階'){
		$return_data['hall_id'] = $hall_id;
		$return_data['room_name'] = '2階';
	}

	// 関内
	if($hall_id==19 and $room_name=='８階（８０２号室）'){
		$return_data['hall_id'] = $hall_id;
		$return_data['room_name'] = '8階（802号室）';
	}
	if($hall_id==19 and $room_name=='２階（２０２号室）'){
		$return_data['hall_id'] = $hall_id;
		$return_data['room_name'] = '2階（202号室）';
	}

	// 新宿
	if($hall_id==15 and $room_name=='カンファレンスルーム'){
		$return_data['hall_id'] = $hall_id;
		$return_data['room_name'] = 'カンファレンスルーム';
	}
	if($hall_id==15 and $room_name=='ミーティングルームA'){
		$return_data['hall_id'] = $hall_id;
		$return_data['room_name'] = 'ミーティングルームA';
	}
	if($hall_id==15 and $room_name=='ミーティングルームB'){
		$return_data['hall_id'] = $hall_id;
		$return_data['room_name'] = 'ミーティングルームB';
	}
	if($hall_id==15 and $room_name=='商談ルーム1'){
		$return_data['hall_id'] = $hall_id;
		$return_data['room_name'] = '商談ルーム-1';
	}
	if($hall_id==15 and $room_name=='商談ルーム2'){
		$return_data['hall_id'] = $hall_id;
		$return_data['room_name'] = '商談ルーム-2';
	}
	if($hall_id==15 and $room_name=='小会議室1'){
		$return_data['hall_id'] = $hall_id;
		$return_data['room_name'] = '小会議室-1';
	}
	if($hall_id==15 and $room_name=='小会議室2'){
		$return_data['hall_id'] = $hall_id;
		$return_data['room_name'] = '小会議室-2';
	}
	if($hall_id==15 and $room_name=='中会議室1'){
		$return_data['hall_id'] = $hall_id;
		$return_data['room_name'] = '中会議室-1';
	}
	if($hall_id==15 and $room_name=='中会議室2'){
		$return_data['hall_id'] = $hall_id;
		$return_data['room_name'] = '中会議室-2';
	}

	// @SHIBUYA-I
	if($hall_id==26 and $room_name=='６階　B号室'){
		$return_data['hall_id'] = $hall_id;
		$return_data['room_name'] = '6階　B号室';
	}

	// なし
	if(is_null($return_data['room_name'])){
		$return_data['hall_id'] = $hall_id;
		$return_data['room_name'] = $room_name;
	}

	return $return_data;

}

function get_purpose_id($purpose){

	if($purpose=="仮：会議"){
		$purpose_id = 1;
	}elseif($purpose=="仮：セミナー"){
		$purpose_id = 2;
	}elseif($purpose=="仮：研修"){
		$purpose_id = 3;
	}elseif($purpose=="仮：面接"){
		$purpose_id = 4;
	}elseif($purpose=="仮：懇親会"){
		$purpose_id = 5;
	}else{
		$purpose_id = 6;
	}

	return $purpose_id;

}

function get_ken_id($value){
	$sql = "select * from c_profile_option where value = '".$value."'";

	$ken = db_get_all($sql);

	return $ken['c_profile_option_id'];

}



?>
