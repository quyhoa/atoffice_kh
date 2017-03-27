<?php 
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// プロフィール項目追加
class admin_do_add_agency extends OpenPNE_Action
{

    function execute($requests)
    {
    	// set hall_list
	    $hallLists = array();
	    $hallCheck = array();

	    $sql = "select hall_id, hall_name from a_hall where flag=0 order by pulldown desc";
		$hall_list = db_get_all($sql, $db);
		if(!empty($hall_list)){
			foreach ($hall_list as $key => $halls) {			
				$hallLists[$halls['hall_id']] = 'percent_'.$halls['hall_id'];
				$hallCheck['percents_'.$halls['hall_id']] = 'percent_'.$halls['hall_id'];
			}
		}

		$type = isset($_POST['flag']) ? $_POST['flag'] : 0;
		if($type == 0){
			if(!preg_match("/^[0-9]+$/", $_POST['percent']) or $_POST['percent'] < 1 or $_POST['percent'] > 100){
				admin_client_redirect('c_member_detail&target_c_member_id='.$_POST['c_member_id'], '値引き率には1以上100以下の半角数字を入力してください。');
			}
			// 一旦削除
			$sql = "delete from a_agency where c_member_id = ".$_POST['c_member_id'];
			db_get_all($sql);
			// 登録
			$sql = "insert into a_agency (c_member_id, percent, info) values (".$_POST['c_member_id'].", ".$_POST['percent'].", '".$_POST['info']."')";
			db_get_all($sql);

			admin_client_redirect('agency_list', '代理店値引き対象に設定しました。');
		}else{	
			// check validate
			foreach ($hallCheck as $key => $value) {
				if (array_key_exists($key,$_POST))
				{
					if(!preg_match("/^[0-9]+$/", $_POST[$value]) or $_POST[$value] < 1 or $_POST[$value] > 100){
						admin_client_redirect('c_member_detail&target_c_member_id='.$_POST['c_member_id'], '値引き率には1以上100以下の半角数字を入力してください。');
					}
				}
			}
			foreach ($hallLists as $key => $value) {
				if(!empty($_POST[$value])){
					$varInser[$key] = $_POST[$value];
				}
			}
			unset($_POST['percent']);			
			$vaHall = json_encode($varInser);
			// 一旦削除
			$sql = "delete from a_agency where c_member_id = ".$_POST['c_member_id'];
			db_get_all($sql);
			// 登録
			$sql = "insert into a_agency (c_member_id,percent, info, type, hall_list) values (".$_POST['c_member_id'].",'', '".$_POST['info']."',".$_POST['flag'].", '".$vaHall."')";
			db_get_all($sql);

			admin_client_redirect('agency_list', '代理店値引き対象に設定しました。');
		}
    }
}


?>
