<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// プロフィール項目追加
class admin_do_set_rental_stop2 extends OpenPNE_Action
{

    function execute($requests)
    {
	//var_dump($_POST);
	//print "<br>";

	// 削除
	foreach($_POST as $key=>$value){

		if(preg_match('/delete_data*/', $key)){
			$sql = "delete from a_rental_stop where stop_id = $value";
			//print "$sql<br>";
			db_get_all($sql);
		}

	}
	if($_POST['limit_datetime']){
		$limit_datetime = $_POST['limit_datetime']." 23:59:59";
	}else{
		$limit_datetime = "0000-00-00 00:00:00";
	}
	$memo = $_POST['memo'];
	$now=date("Y-m-d H:i:s");
	// 登録者
	$sql = "select name, atoffice_auth_type, hall_id from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$name = $result[0]['name'];
	//print $name."<br>";

	foreach($_POST as $key=>$value){

		if(preg_match('/stop_data*/', $key)){
if($_POST['flag']==0){
			if(!$limit_datetime){
				admin_client_redirect('rental_stop&year='.$_POST['year'].'&month='.$_POST['month']."&day=".$_POST['day']."&hall_list=".$_POST['hid'], '有効期限を入力してください。');
			}
}
			$data = split(',', $value);
			$sql = "insert into a_rental_stop (hall_id, room_id, begin_datetime, finish_datetime, admin_name, memo, flag, created_date) values (".$data[0].", ".$data[1].", '".$data[2]."', '".$data[3]."', '".$name."', '".$memo."', 1,'".$now."')";
			db_get_all($sql);
		}

	}

	admin_client_redirect('rental_stop2&year='.$_POST['year'].'&month='.$_POST['month']."&day=".$_POST['day']."&hall_list=".$_POST['hid'], '貸し止め設定を登録しました。');


    }
}


?>
