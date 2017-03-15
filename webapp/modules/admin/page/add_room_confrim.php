<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_page_add_room_confrim extends OpenPNE_Action
{

    function execute($requests)
    {
	// アクセス権限
	$sql = "select name, atoffice_auth_type from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$this->set('name', $result[0]['name']);
	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);

	if(isset($_GET['msg']) && $_GET['msg']){
		$hall_id = preg_replace("/[^0-9]+/", "", $_GET['msg']);
		$this->set('msg', preg_replace("/[0-9]+/", "", $_GET['msg']));
	}else{
		$hall_id = $_POST['hall_id'];
	}
	$this->set('hall_id', $hall_id);

	$room_id = $_POST['room_id'];
	$this->set('room_id', $room_id);

	//会場名データ取得
	$sql = "select * from a_hall where hall_id = $hall_id";
	$result = db_get_all($sql);
	$begin1 = ($result[0]['begin1'] != '')?$result[0]['begin1']:$result[0]['begin'];
	$begin2 = ($result[0]['begin2'] != '')?$result[0]['begin2']:$result[0]['begin'];
	$begin3 = ($result[0]['begin3'] != '')?$result[0]['begin3']:$result[0]['begin'];
	$begin4 = ($result[0]['begin4'] != '')?$result[0]['begin4']:$result[0]['begin'];

	$finish1 = ($result[0]['finish1'] != '')?$result[0]['finish1']:$result[0]['finish'];
	$finish2 = ($result[0]['finish2'] != '')?$result[0]['finish2']:$result[0]['finish'];
	$finish3 = ($result[0]['finish3'] != '')?$result[0]['finish3']:$result[0]['finish'];
	$finish4 = ($result[0]['finish4'] != '')?$result[0]['finish4']:$result[0]['finish'];
	if($_POST['type'] == 1){
		$result[0]['begin'] = $begin1;
		$result[0]['finish'] = $finish1;
	}
	if($_POST['type'] == 2){
		$result[0]['begin'] = $begin2;
		$result[0]['finish'] = $finish2;
	}
	if($_POST['type'] == 3){
		$result[0]['begin'] = $begin3;
		$result[0]['finish'] = $finish3;
	}
	if($_POST['type'] == 4){
		$result[0]['begin'] = $begin4;
		$result[0]['finish'] = $finish4;
	}
	$this->set('hall_name', $result[0]['hall_name']);
	$this->set('begin', $result[0]['begin']);
	$this->set('finish', $result[0]['finish']);

	//データチェック
	$errors=array();

	if(!$_POST['type']){
		array_push($errors, 'コマ設定タイプを選択してください。');
	}elseif($_POST['type']==1){
		if(!$_POST['room_name1']){
			array_push($errors, '部屋名称を入力してください。');
		}

		if(is_null($_POST['num_school1'])){
			array_push($errors, '収容人数【スクール】を入力してください。');
		}elseif(!preg_match("/^[0-9]+$/", $_POST['num_school1'])) {
			array_push($errors, '収容人数【スクール】は正の半角数字で入力してください。');
		}
		if(is_null($_POST['num_mouth1'])){
			array_push($errors, '収容人数【口の字】を入力してください。');
		}elseif(!preg_match("/^[0-9]+$/", $_POST['num_mouth1'])) {
			array_push($errors, '収容人数【口の字】は正の半角数字で入力してください。');
		}
		if(is_null($_POST['num_theater1'])){
			array_push($errors, '収容人数【シアター】を入力してください。');
		}elseif(!preg_match("/^[0-9]+$/", $_POST['num_theater1'])) {
			array_push($errors, '収容人数【シアター】は正の半角数字で入力してください。');
		}


		if(!$_POST['corp1'] and !$_POST['individual1']){
			array_push($errors, '利用可能属性は１つ以上選択してください。');
		}

		if(!$_POST['conference1'] and !$_POST['seminar1'] and !$_POST['training1'] and !$_POST['interview1'] and !$_POST['party1'] and !$_POST['etc1']){
			array_push($errors, '利用可能用途は１つ以上選択してください。');
		}

	for($x=1; $x<8; $x++){
		if(!$_POST['begin_time'.$x] and !$_POST['finish_time'.$x] and !$_POST['price'.$x]){
			if($x==1){
				array_push($errors, $x.'コマ目の設定は必須です。');
				break;
			}
		}elseif(is_null($_POST['begin_time'.$x]) or !$_POST['finish_time'.$x] or !$_POST['price'.$x]){
				array_push($errors, $x.'コマ目に入力漏れがあります。');
				break;
		}

		// 数字か
		if($_POST['begin_time'.$x] and !preg_match("/^[0-9]+$/", $_POST['begin_time'.$x])){
			array_push($errors, $x.'コマ目の開始時間は正の半角数字で入力してください。');
			break;
		}
		if($_POST['finish_time'.$x] and !preg_match("/^[0-9]+$/", $_POST['finish_time'.$x])){
			array_push($errors, $x.'コマ目の終了時間は正の半角数字で入力してください。');
			break;
		}
		if($_POST['price'.$x] and !preg_match("/^[0-9]+$/", $_POST['price'.$x])){
			array_push($errors, $x.'コマ目の料金は正の半角数字で入力してください。');
			break;
		}

		// 時間範囲

		if($_POST['begin_time'.$x]>24 or $_POST['finish_time'.$x]>24){
			array_push($errors, $x.'コマ目の時間に時間範囲外の数値が入力されています。');
		}

		if($_POST['begin_time'.$x] and $_POST['begin_time'.$x]>=$_POST['finish_time'.$x]){
			array_push($errors, $x.'コマ目の終了時間が、開始時間より早いです。');
		}

		if($x==1){
			if($_POST['begin_time'.$x] < $begin1){
				array_push($errors, $x.'コマ目の開始時間が会場の営業開始時間よりも前です。');
			}
		}else{
			if($_POST['begin_time'.$x] and $_POST['begin_time'.$x]<$_POST['finish_time'.($x-1)]){
				array_push($errors, $x.'コマ目の開始時間が前のコマの終了時間より早いです。');
			}
		}
		if($_POST['finish_time'.$x] > $finish1){
				array_push($errors, $x.'コマ目の終了時間が会場の営業終了時間よりも後です。');
		}


	}



	}elseif($_POST['type']==2){
		if(is_null($_POST['room_name2'])){
			array_push($errors, '部屋名称を入力してください。');
		}
		if(is_null($_POST['num_school2'])){
			array_push($errors, '収容人数【スクール】を入力してください。');
		}elseif(!preg_match("/^[0-9]+$/", $_POST['num_school2'])) {
			array_push($errors, '収容人数【スクール】は正の半角数字で入力してください。');
		}
		if(is_null($_POST['num_mouth2'])){
			array_push($errors, '収容人数【口の字】を入力してください。');
		}elseif(!preg_match("/^[0-9]+$/", $_POST['num_mouth2'])) {
			array_push($errors, '収容人数【口の字】は正の半角数字で入力してください。');
		}
		if(is_null($_POST['num_theater2'])){
			array_push($errors, '収容人数【シアター】を入力してください。');
		}elseif(!preg_match("/^[0-9]+$/", $_POST['num_theater2'])) {
			array_push($errors, '収容人数【シアター】は正の半角数字で入力してください。');
		}

		if(!$_POST['corp2'] and !$_POST['individual2']){
			array_push($errors, '利用可能属性は１つ以上選択してください。');
		}

		if(!$_POST['conference2'] and !$_POST['seminar2'] and !$_POST['training2'] and !$_POST['interview2'] and !$_POST['party2'] and !$_POST['etc2']){
			array_push($errors, '利用可能用途は１つ以上選択してください。');
		}

		if(!$_POST['k_lowest_price'] and !$_POST['k_highest_price'] and !$_POST['k_price2']){
			array_push($errors, '1コマあたりの値段を入力してください。');
		}else{
			if($_POST['k_lower_price'] and !preg_match("/^[0-9]+$/", $_POST['k_lower_price'])) {
			array_push($errors, '１コマあたりの値段１は正の半角数字で入力してください。');
			}
			if($_POST['k_higher_price'] and !preg_match("/^[0-9]+$/", $_POST['k_higher_price'])) {
			array_push($errors, '１コマあたりの値段４は正の半角数字で入力してください。');
			}
			if($_POST['k_price2'] and !preg_match("/^[0-9]+$/", $_POST['k_price2'])) {
			array_push($errors, '１コマあたりの値段２は正の半角数字で入力してください。');
			}
		}

		// 最大収容人数は？
		if($_POST['num_school2'] > $_POST['num_mouth2'] and $_POST['num_school2'] > $_POST['num_theater2']){
			$max_num = $_POST['num_school2'];
		}elseif($_POST['num_theater2'] > $_POST['num_mouth2']){
			$max_num = $_POST['num_theater2'];
		}else{
			$max_num = $_POST['num_mouth2'];
		}

		//　値がある場合は数字か
		if($_POST['k_capa_lowest'] and !preg_match("/^[0-9]+$/", $_POST['k_capa_lowest'])){
		//値段1人数
			array_push($errors, '１コマあたりの値段１の人数は正の半角数字で入力してください。');
		}elseif($_POST['k_lowest_price'] and !preg_match("/^[0-9]+$/", $_POST['k_lowest_price'])){
		//値段1価格
			array_push($errors, '１コマあたりの値段１の値段は正の半角数字で入力してください。');
		}elseif(($_POST['k_capa_low2'] and $_POST['k_capa_high2']) and (!preg_match("/^[0-9]+$/", $_POST['k_capa_low2']) or !preg_match("/^[0-9]+$/", $_POST['k_capa_high2']))){
		//値段2人数
			array_push($errors, '１コマあたりの値段２の人数は正の半角数字で入力してください。');
		}elseif($_POST['k_price2'] and !preg_match("/^[0-9]+$/", $_POST['k_price2'])){
		//値段2価格
			array_push($errors, '１コマあたりの値段２の値段は正の半角数字で入力してください。');
		}elseif(($_POST['k_capa_low3'] and $_POST['k_capa_high3']) and (!preg_match("/^[0-9]+$/", $_POST['k_capa_low3']) or !preg_match("/^[0-9]+$/", $_POST['k_capa_high3']))){
		//値段3人数
			array_push($errors, '１コマあたりの値段３の人数は正の半角数字で入力してください。');
		}elseif($_POST['k_price3'] and !preg_match("/^[0-9]+$/", $_POST['k_price3'])){
		//値段3価格
			array_push($errors, '１コマあたりの値段３の値段は正の半角数字で入力してください。');
		}elseif($_POST['k_capa_highest'] and !preg_match("/^[0-9]+$/", $_POST['k_capa_highest'])){
		//値段4人数
			array_push($errors, '１コマあたりの値段４の人数は正の半角数字で入力してください。');
		}elseif($_POST['k_highest_price'] and !preg_match("/^[0-9]+$/", $_POST['k_highest_price'])){
		//値段4価格
			array_push($errors, '１コマあたりの値段４の値段は正の半角数字で入力してください。');
		}else{
			// 全部数字
			// 値があるか、価格ベース
			if ($_POST['k_lowest_price'] and !$_POST['k_capa_lowest']){
				array_push($errors, '１コマあたりの値段１に未入力があります。');
			}
			if ($_POST['k_price2'] and (!$_POST['k_capa_low2'] or !$_POST['k_capa_high2'])){
				array_push($errors, '１コマあたりの値段２に未入力があります。');
			}
			if ($_POST['k_price3'] and (!$_POST['k_capa_low3'] or !$_POST['k_capa_high3'])){
				array_push($errors, '１コマあたりの値段３に未入力があります。');
			}
			if ($_POST['k_highest_price'] and !$_POST['k_capa_highest']){
				array_push($errors, '１コマあたりの値段４に未入力があります。');
			}

			// 値があるか、人数ベース
			if ($_POST['k_capa_lowest'] and !$_POST['k_lowest_price']){
				array_push($errors, '１コマあたりの値段１に未入力があります。');
			}
			if (($_POST['k_capa_low2'] or $_POST['k_capa_high2']) and !$_POST['k_price2']){
				array_push($errors, '１コマあたりの値段２に未入力があります。');
			}
			if (($_POST['k_capa_low3'] or $_POST['k_capa_high3']) and !$_POST['k_price3']){
				array_push($errors, '１コマあたりの値段３に未入力があります。');
			}
			if ($_POST['k_capa_highest'] and !$_POST['k_highest_price']){
				array_push($errors, '１コマあたりの値段４に未入力があります。');
			}


			if($_POST['k_capa_lowest'] > $max_num){
				array_push($errors, '１コマあたりの値段１の人数が、収容人数の最大より大きいです。');
			}elseif(($_POST['k_capa_lowest'] and $_POST['k_capa_low2']) and $_POST['k_capa_lowest'] != ($_POST['k_capa_low2']-1)){
				
				array_push($errors, '１コマあたりの値段２の開始人数は、値段１の人数から＋１の値にしてください。');				
			}elseif((!$_POST['k_capa_lowest'] and !$_POST['k_capa_highest']) and $_POST['k_capa_low2']!=1){
				array_push($errors, '値段1と値段4を設定しない場合、１コマあたりの値段２の開始人数は、１人からにしてください。');
			}elseif($_POST['k_capa_high2'] < $_POST['k_capa_low2']){				array_push($errors, '１コマあたりの値段２の終了人数が、開始人数よりも小さいです。');
			}elseif($_POST['k_capa_high2'] > $max_num){				array_push($errors, '１コマあたりの値段２の終了人数が、収容人数の最大より大きいです。');
			}elseif($_POST['k_capa_low3'] and $_POST['k_capa_high2'] != ($_POST['k_capa_low3']-1)){
				
				array_push($errors, '１コマあたりの値段３の開始人数は、値段２の終了人数から＋１の値にしてください。');			
			}elseif($_POST['k_capa_high3'] < $_POST['k_capa_low3']){				array_push($errors, '１コマあたりの値段３の終了人数が、開始人数よりも小さいです。');
			}elseif($_POST['k_capa_high3'] > $max_num){						array_push($errors, '１コマあたりの値段３の終了人数が、収容人数の最大より大きいです。');
			}elseif(($_POST['k_capa_high3'] and $_POST['k_capa_highest']) and ($_POST['k_capa_highest']-1 != $_POST['k_capa_high3'])){
				array_push($errors, '１コマあたりの値段４の人数は、値段３の終了人数から＋１の値にしてください。');
			}elseif((!$_POST['k_capa_high3'] and $_POST['k_capa_high2'] and $_POST['k_capa_highest']) and ($_POST['k_capa_highest']-1 != $_POST['k_capa_high2'])){
				array_push($errors, '１コマあたりの値段４の人数は、値段２の終了人数から＋１の値にしてください。');
			}elseif((!$_POST['k_capa_high3'] and !$_POST['k_capa_high2'] and $_POST['k_capa_lowest'] and $_POST['k_capa_highest']) and ($_POST['k_capa_highest']-1 != $_POST['k_capa_lowest'])){
				array_push($errors, '１コマあたりの値段４の人数は、値段１の人数から＋１の値にしてください。');
			}elseif(($_POST['k_capa_highest'] and !$_POST['k_capa_lowest'] and !$_POST['k_capa_high2'] and !$_POST['k_capa_high3']) and $_POST['k_capa_highest']!=1){
				array_push($errors, '１コマあたりの値段４の人数は、１の値にしてください。');
			}

		}



		if($_POST['k_price3'] and !preg_match("/^[0-9]+$/", $_POST['k_price3'])) {
			array_push($errors, '１コマあたりの値段３は正の半角数字で入力してください。');
		}

		if(!$_POST['lowest_koma']){
			array_push($errors, '最低予約コマ数を入力してください。');
		}elseif(!preg_match("/^[0-9]+$/", $_POST['lowest_koma'])) {
			array_push($errors, '最低予約コマ数は正の半角数字で入力してください。');
		}


	}

	if(!$_POST['cancel']){
		array_push($errors, 'キャンセル料率パターンを選択してください。');
	}


        if ($errors) {
            $this->set('errors', $errors);
        }


	if($_POST['type']==1){
		// コマ設定数（7コマ）
		$koma_list = array();
		for($x=0; $x<7; $x++){

			$koma_list[$x]['num']=$x+1;
			$koma_list[$x]['price']=$_POST['price'.($x+1)];
			$koma_list[$x]['begin_time']=$_POST['begin_time'.($x+1)];
			$koma_list[$x]['finish_time']=$_POST['finish_time'.($x+1)];

		}
		$this->set('koma_list', $koma_list);
	}
	// 選択されたキャンセル料パターン
	$sql = "select * from a_cancel_charge where hall_id = $hall_id and ";
	$sql.= "pattern_id = ".$_POST['cancel'];
	$result = db_get_all($sql);
	$this->set('cancel_charge', $result[0]);



	$this->set('post_data', $_POST);


        return 'success';
    }
}

?>
