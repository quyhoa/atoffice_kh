<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// プロフィール項目追加
class admin_do_add_hall_data extends OpenPNE_Action
{

    function execute($requests)
    {
	if($_POST['hall_attribute']==""){
		$_POST['hall_attribute'] = 0;
	}	
	// 編集の場合は前のデータを削除	
	$sql = "select * from a_hall where hall_id = ".$_POST['hall_id'];
	$result_check  = db_get_all($sql);
	if($result_check != NULL){			
			$sql = "DESCRIBE a_hall";
			$col_list = db_get_all($sql);
			$sql = "update a_hall set ";
			foreach($col_list as $value){
				if($value['Field']!="hall_id" and $value['Field']!="image1_filename" and $value['Field']!="image2_filename" and $value['Field']!="flag" and $value['Field']!="reservation_month"){
					if(!is_null($_POST[$value['Field']])){
						$sql.= $value['Field']." = '".$_POST[$value['Field']]."', ";
					}
				}
			}
			//$sql.= "begin = ".$_POST['begin'].", ";
			//$sql.= "finish = ".$_POST['finish'].", ";			
			$sql.= "reservation_month = ".$_POST['reservation_month']. ",";
			$sql.= "begin1 = ".$_POST['begin1'].", ";
			$sql.= "finish1 = ".$_POST['finish1'].", ";
			$sql.= "begin2 = ".$_POST['begin2'].", ";
			$sql.= "finish2 = ".$_POST['finish2'].", ";
			$sql.= "begin3 = ".$_POST['begin3'].", ";
			$sql.= "finish3 = ".$_POST['finish3'].", ";
			$sql.= "begin4 = ".$_POST['begin4'].", ";
			$sql.= "finish4 = ".$_POST['finish4'].", ";
			$sql.= "begin_often1 = ".$_POST['begin_often1'].", ";
			$sql.= "finish_often1 = ".$_POST['finish_often1'].", ";
			$sql.= "begin_often2 = ".$_POST['begin_often2'].", ";
			$sql.= "finish_often2 = ".$_POST['finish_often2'].", ";
			$sql.= "begin_often3 = ".$_POST['begin_often3'].", ";
			$sql.= "finish_often3 = ".$_POST['finish_often3'].", ";
			$sql.= "begin_often4 = ".$_POST['begin_often4'].", ";
			$sql.= "finish_often4 = ".$_POST['finish_often4'].", ";
			$sql.= "usedate = '".$_POST['usedate']."'";			
			$sql.= " where hall_id = ".$_POST['hall_id'];
			db_get_all($sql);	
		    admin_client_redirect('add_hall', '会場データを更新しました'.$_POST['hall_id']);		
	}
	else{
		$sql  = "insert into a_hall ";
		$sql .= "(hall_name, hall_attribute, ";

		if ($_POST['hall_attribute']==1){
			$sql .= "share_option1, share_option2, ";
		}
		$sql .= "flag, cancel_days, rooms, ";
		$sql .= "reservation_month, address_zip, address_prefecture, ";
		$sql .= "address_city, address_other, telephone, fax, ";
		$sql .= "line1, station1, transportation1, time1, begin_often, finish_often, ";

		if ($_POST['line2']){
			$sql .= "line2, station2, transportation2, time2, ";
		}
		if ($_POST['line3']){
			$sql .= "line3, station3, transportation3, time3, ";
		}
		$sql .= "characteristic, facilities, remarks, agreement, bank_flag, google_maps, access, kanban, web_reserve, owner_room, owner_vessel, kiyaku_url, mailing_list, pulldown, usedate,begin1, finish1,begin2, finish2,begin3, finish3,begin4, finish4,begin_often1, finish_often1,begin_often2, finish_often2,begin_often3, finish_often3,begin_often4, finish_often4)";
		$sql .= "values ('".$_POST['hall_name']."', '";
		$sql .= $_POST['hall_attribute']."', '";

		if($_POST['hall_attribute']==1){
			$sql .= $_POST['share_option1']."', '".$_POST['share_option2']."', '";
		}
		$sql .= $_POST['flag']."', '".$_POST['cancel_days']."', '";
		$sql .= $_POST['rooms']."', '";
		$sql .= $_POST['reservation_month']."', '".$_POST['address_zip']."', '";
		$sql .= $_POST['address_prefecture']."', '".$_POST['address_city']."', '";
		$sql .= $_POST['address_other']."', '".$_POST['telephone']."', '";
		$sql .= $_POST['fax']."', '".$_POST['line1']."', '";
		$sql .= $_POST['station1']."', '".$_POST['transportation1']."', '";
		$sql .= $_POST['time1']."', '";
		$sql .= $_POST['begin_often']."', '";
		$sql .= $_POST['finish_often']."', '";

		if($_POST['line2']){
			$sql .= $_POST['line2']."', '".$_POST['station2']."', '".$_POST['transportation2']."', '".$_POST['time2']."', '";
		}
		if($_POST['line3']){
			$sql .= $_POST['line3']."', '".$_POST['station3']."', '".$_POST['transportation3']."', '".$_POST['time3']."', '";
		}
		$sql .= $_POST['characteristic']."', '".$_POST['facilities']."', '".$_POST['remarks']."', '".$_POST['agreement']."', '".$_POST['bank_flag']."', '".$_POST['google_maps']."', '".$_POST['access']."', '".$_POST['kanban']."', '".$_POST['web_reserve']."', '".$_POST['owner_room']."', '".$_POST['owner_vessel']."', '".$_POST['kiyaku_url']."', '".$_POST['mailing_list']."', '".$_POST['pulldown']."', '".$_POST['usedate']."','".$_POST['begin1']."', '".$_POST['finish1']."', '".$_POST['begin2']."', '".$_POST['finish2']."', '".$_POST['begin3']."', '".$_POST['finish3']."', '".$_POST['begin4']."', '".$_POST['finish4']."','".$_POST['begin_often1']."', '".$_POST['finish_often1']."', '".$_POST['begin_often2']."', '".$_POST['finish_often2']."', '".$_POST['begin_often3']."', '".$_POST['finish_often3']."', '".$_POST['begin_often4']."', '".$_POST['finish_often4']."')";	
		$result = db_get_all($sql);	
		if($result)
		{
			admin_client_redirect('add_hall', '会場を追加しました');
		}
		else{
			admin_client_redirect('add_hall', 'Error insert data');
		}
	}
    }
}

?>
