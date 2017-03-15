<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_page_hall_list extends OpenPNE_Action
{
    function execute($requests)
    {

	// アクセス権限
	$sql = "select name, atoffice_auth_type from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$this->set('name', $result[0]['name']);
	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);

// リクエストデータ
	if(isset($_REQUEST['flag']) && $_REQUEST['flag']){
		$flag = $_REQUEST['flag'];
	}else{
		$flag = 0;
	}
	$this->set('flag', $flag);

	if(isset($_REQUEST['attribute']) && $_REQUEST['attribute']){
		$attribute = $_REQUEST['attribute'];
	}else{
		$attribute = 0;
	}
	$this->set('attribute', $attribute);

	if(isset($_REQUEST['prefecture']) && $_REQUEST['prefecture']){
		$prefecture = $_REQUEST['prefecture'];
	}else{
		$prefecture = 0;
	}
	$this->set('prefecture', $prefecture);

	if(isset($_REQUEST['index']) && $_REQUEST['index']){
		$index=$_REQUEST['index'];
	}else{
		$index=0;
	}
	$this->set('index', $index);

	// 件数
	$sql = "select count(*) as hall_num from a_hall where hall_id > 0 ";
	if($flag==1){
		$sql.= "and flag=0 ";
	}elseif($flag==2){
		$sql.= "and flag=1 ";
	}elseif($flag==3){
		$sql.= "and flag=2 ";
	}
	if($attribute==1){
		$sql.= "and hall_attribute=0 ";
	}elseif($attribute==2){
		$sql.= "and hall_attribute=1 ";
	}
	if($prefecture>0){
		$sql.= "and address_prefecture=$prefecture ";
	}

	$result = db_get_all($sql);
	$num = $result[0]['hall_num'];
	$this->set('num', $num);


	$page_list = get_page_list($index, $num, 50, 30);
	$this->set('page_list', $page_list);


	// 会場検索
	$sql = "select hall_id, hall_name, flag, hall_attribute, rooms from a_hall where hall_id > 0 ";
	if($flag==1){
		$sql.= "and flag=0 ";
	}elseif($flag==2){
		$sql.= "and flag=1 ";
	}elseif($flag==3){
		$sql.= "and flag=2 ";
	}
	if($attribute==1){
		$sql.= "and hall_attribute=0 ";
	}elseif($attribute==2){
		$sql.= "and hall_attribute=1 ";
	}
	if($prefecture>0){
		$sql.= "and address_prefecture=$prefecture ";
	}
	$sql.= "limit ".$index.", 50";

	$hall_list = db_get_all($sql);



	foreach($hall_list as $key => $val){

		// 口座設定フラグ

		$sql = "select bank_flag from a_hall where hall_id = ".$val['hall_id'];
		$result = db_get_all($sql);
		$hall_list[$key]['bank_flag'] = $result[0]['bank_flag'];

		$sql = "select count(*) as bank from a_bank_data where hall_id = ".$val['hall_id'];
		$result = db_get_all($sql);
		$hall_list[$key]['bank'] = $result[0]['bank'];

		// キャンセル料率パターン設定フラグ
		$sql = "select count(*) as cancel from a_cancel_charge where hall_id = ".$val['hall_id'];
		$result = db_get_all($sql);
		$hall_list[$key]['cancel'] = $result[0]['cancel'];

		// 画像設定フラグ
		$sql = "select count(*) as count from a_hall_image where hall_id  = ".$val['hall_id'];

		$result = db_get_all($sql);
		$hall_list[$key]['image'] = $result[0]['count'];

		// 休日設定フラグ
		// 定休日
		$sql = "select count(*) as regular from a_hall_regular_holiday";		$sql.= " where hall_id = ".$val['hall_id'];
		$result1 = db_get_all($sql);

		//指定日
		$this_year = date("Y");
		$this_month = date("m");
		$today = date("d");

		// すべてが過ぎていた場合は、休日なしにする。
		$sql = "select count(*) as holiday from a_hall_holiday";			$sql.= " where hall_id = ".$val['hall_id']." and (year >= $this_year and month >= $this_month and day >= $today)";
		$result2 = db_get_all($sql);

		if($result1[0]['regular'] or $result2[0]['holiday']){
			$hall_list[$key]['holiday'] = 1;
		}else{
			$hall_list[$key]['holiday'] = 0;
		}

		// 部屋設定数
		$sql = "select count(*) as config_rooms from a_room where hall_id = ".$val['hall_id'];
		$result = db_get_all($sql);
		
		if(!$result[0]['config_rooms']){
			$result[0]['config_rooms']=0;
		}
		$hall_list[$key]['config_rooms'] = $result[0]['config_rooms'];

		// 登録備品数
		$sql = "select count(*) as vessel from a_vessel_data where hall_id = ".$val['hall_id'];
		$result = db_get_all($sql);
		
		if(!$result[0]['vessel']){
			$result[0]['vessel']=0;
		}
		$hall_list[$key]['vessel'] = $result[0]['vessel'];

		// 登録サービス数
		$sql = "select count(*) as service from a_service_data where hall_id = ".$val['hall_id'];
		$result = db_get_all($sql);
		
		if(!$result[0]['service']){
			$result[0]['service']=0;
		}
		$hall_list[$key]['service'] = $result[0]['service'];

	}
	
	$this->set('hall_list', $hall_list);

	$a = db_member_c_profile_list();
	// $address_list = $a[pre_addr_pref];
	$address_list = $a['pre_addr_pref'];
	$this->set('profile_list', $address_list);


        return 'success';
    }
}

?>
