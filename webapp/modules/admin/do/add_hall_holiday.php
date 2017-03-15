<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// スキン画像更新
class admin_do_add_hall_holiday extends OpenPNE_Action
{
    function handleError($errors)
    {
        admin_client_redirect('hall_image', array_shift($errors));
    }

    function execute($requests)
    {

	//var_dump($_REQUEST);
	//print "<br>";

	if($_POST['checkbox_flag']){

		$data_list = array();
		$key=0;
		for($x=1; $x<32; $x++){
			if(isset($_POST['day'.$x]) && $_POST['day'.$x]){
				$data_list[$key]['year'] = $_POST['year'];
				$data_list[$key]['month'] = $_POST['month'];
				$data_list[$key]['day'] = $_POST['day'.$x];
				$key++;
			}
		}
		//var_dump($data_list);

		foreach($data_list as $value){
			$sql = "insert into a_hall_holiday (hall_id, year, month, day) values (";
			$sql.= $_POST['hall_id'].", ".$value['year'].", ".$value['month'].", ".$value['day'];
			$sql.= ")";

			//print $sql."<br>";
			db_get_all($sql);

		}
	        admin_client_redirect('hall_holiday_conf', '日付指定を更新しました'.$_POST['hall_id']);
		exit();
	}

	$error_msg = "";

	for($x=1; $x<51; $x++){
		// 3つの値が数字で入力されていて、日付として存在するか
		if(preg_match("/^[0-9]+$/", $_POST['year'.$x]) and preg_match("/^[0-9]+$/", $_POST['month'.$x]) and preg_match("/^[0-9]+$/", $_POST['day'.$x]) and checkdate($_POST['month'.$x], $_POST['day'.$x], $_POST['year'.$x])){

			if($_POST['delete'.$x]){

			// 削除
			$sql = "delete from a_hall_holiday where hall_id = ";
			$sql.= $_POST['hall_id']." and year = ".$_POST['year'.$x]." and month = ".$_POST ['month'.$x]." and day = ".$_POST['day'.$x];
			db_get_all($sql);

			}else{

			// 登録
			$sql = "insert into a_hall_holiday (hall_id, year, month, day) values (".$_POST['hall_id'].", ".$_POST['year'.$x].", ".$_POST['month'.$x].", ".$_POST['day'.$x].")";
			db_get_all($sql);

			}

		}elseif($_POST['year'.$x] or $_POST['month'.$x] or $_POST['day'.$x]){
			// 数字以外で、どれか一つの項目が入力されている
			$error_msg .= " 設定".mb_convert_kana($x, 'A')." ";
		}
	}

	if($error_msg){
	        admin_client_redirect('hall_holiday_conf', '正しい設定は登録できましたが、以下の設定は不正な値が入力されていた為、スキップしました。（'.$error_msg.'）'.$_POST['hall_id']);
	}else{
	        admin_client_redirect('hall_holiday_conf', '日付指定を更新しました'.$_POST['hall_id']);
	}
    }
}

?>
