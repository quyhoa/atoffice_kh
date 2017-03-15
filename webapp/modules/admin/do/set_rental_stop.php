<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// プロフィール項目追加
class admin_do_set_rental_stop extends OpenPNE_Action
{

    function execute($requests)
    {
	//var_dump($_POST);
	//print "<br>";

	// 削除
	$stop_user_id=$_POST['stop_user_id'];
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

	// 登録者
	$sql = "select name, atoffice_auth_type, hall_id from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$name = $result[0]['name'];
	//print $name."<br>";
	$result = false;
	foreach($_POST as $key=>$value){

		if(preg_match('/stop_data*/', $key)){
			if($_POST['flag']==0){
						if($limit_datetime == "0000-00-00 00:00:00"){
							admin_client_redirect('rental_stop&year='.$_POST['year'].'&month='.$_POST['month']."&day=".$_POST['day']."&hall_list=".$_POST['hid']."&stop_user_id=".$stop_user_id, '有効期限を入力してください。');
						}
						else if(strtotime($limit_datetime) < strtotime(date('Y-m-d')))
						{
							admin_client_redirect('rental_stop&year='.$_POST['year'].'&month='.$_POST['month']."&day=".$_POST['day']."&hall_list=".$_POST['hid']."&stop_user_id=".$stop_user_id, '');
					
						}
			}
			$data = explode(',', $value);
			$create_date = date('Y-m-d H:i:s');
			$sql = "insert into a_rental_stop (hall_id, room_id, begin_datetime, finish_datetime, limit_datetime, admin_name, memo, flag,stop_user_id,created_date) values (".$data[0].", ".$data[1].", '".$data[2]."', '".$data[3]."', '".$limit_datetime."', '".$name."', '".$memo."', ".$_POST['flag'].",'".$stop_user_id."','".$create_date."')";
			db_get_all($sql);
			$result = true;

		}

	}
	if($result){
		if($_POST['periodmode']==1){
	      admin_client_redirect('rental_stop&year='.$_POST['year'].'&month='.$_POST['month']."&day=".$_POST['day']."&hall_list=".$_POST['hid']."&hid=".$_POST['hid']."&periodmode=".$_POST['periodmode'].'&period='.$_POST['period']."&room_id=".$_POST['room_id'], '貸し止め設定を登録しました。');
	  
	    }
	    else{
	      admin_client_redirect('rental_stop&year='.$_POST['year'].'&month='.$_POST['month']."&day=".$_POST['day']."&hall_list=".$_POST['hid'], '貸し止め設定を登録しました。');

	    }
	}
	else{
		 admin_client_redirect('rental_stop&year='.$_POST['year'].'&month='.$_POST['month']."&day=".$_POST['day']."&hall_list=".$_POST['hid'], '');

	}
    


    }
}


?>
