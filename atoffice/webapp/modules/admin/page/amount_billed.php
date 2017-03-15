<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_page_amount_billed extends OpenPNE_Action
{
    function execute($requests)
    {

	// アクセス権限
	$sql = "select name, atoffice_auth_type from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$this->set('name', $result[0]['name']);
	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);

//　検索オプション
	if($_REQUEST['pay_flag']){
		$pay_flag = $_REQUEST['pay_flag'];
	}else{
		$pay_flag = 0;
	}
	$this->set('pay_flag', $pay_flag);

	if($_REQUEST['reserve_id']){
		$reserve_id = $_REQUEST['reserve_id'];
	}
	$this->set('reserve_id', $reserve_id);
	if($_REQUEST['begin_date']){
		$begin_date = $_REQUEST['begin_date'];
	}else{
		$begin_date = '0000-00-00';
	}
	$this->set('begin_date', $begin_date);

	if($_REQUEST['finish_date']){
		$finish_date = $_REQUEST['finish_date'];
	}else{
		$finish_date = '0000-00-00';
	}
	$this->set('finish_date', $finish_date);

	if($_REQUEST['index']){
		$index=$_REQUEST['index'];
	}else{
		$index=0;
	}
	$this->set('index', $index);

	// 件数
	$sql = "select count(reserve_id) as billed_num from a_amount_billed where 0=0 ";

	if($pay_flag==1){
		$sql.= "and flag=0 ";
	}elseif($pay_flag==2){
		$sql.= "and flag=1 ";
	}
	if($reserve_id){
		$sql.= "and reserve_id = '$reserve_id' ";
	}
	if($begin_date!='0000-00-00' and $finish_date!='0000-00-00'){
		$sql.= "and (pay_limitdate >= '".$begin_date." 00:00:00' ";
		$sql.= "and pay_limitdate <= '".$finish_date." 23:59:59') ";
	}

	$sql.= "order by add_datetime ";

	$result = db_get_all($sql);
	$num = $result[0]['billed_num'];
	$this->set('num', $num);

	$page_list = get_page_list($index, $num, 10, 30);
	$this->set('page_list', $page_list);

// 検索
	$sql = "select * from a_amount_billed where 0=0 ";

	if($pay_flag==1){
		$sql.= "and flag=0 ";
	}elseif($pay_flag==2){
		$sql.= "and flag=1 ";
	}
	if($reserve_id){
		$sql.= "and reserve_id = '$reserve_id' ";
	}
	if($begin_date!='0000-00-00' and $finish_date!='0000-00-00'){
		$sql.= "and (pay_limitdate >= '".$begin_date." 00:00:00' ";
		$sql.= "and pay_limitdate <= '".$finish_date." 23:59:59') ";
	}

	$sql.= "order by add_datetime ";
	$sql.= "limit ".$index.", 10";

	$ab_list = db_get_all($sql);

	if($ab_list){
		foreach($ab_list as $key=>$value){
			$sql = "select * from a_reserve_list where reserve_id = ".$value['reserve_id'];
			$reserve_data = db_get_all($sql);
			$ab_list[$key]['reserve_data'] = $reserve_data[0];
			$ab_list[$key]['hall_name'] = get_hall_name($reserve_data[0]['hall_id']);
			$ab_list[$key]['room_name'] = get_room_name($reserve_data[0]['hall_id'], $reserve_data[0]['room_id']);
			$sql = "select * from c_member where c_member_id = ".$reserve_data[0]['c_member_id'];
			$c_member = db_get_all($sql);
			$ab_list[$key]['c_member'] = $c_member[0];
			// プロフィール
			$ab_list[$key]['corp'] = get_profile_value($reserve_data[0]['c_member_id'], 12);
			// メアド取得
			$sql = "select pc_address from c_member_secure where c_member_id =".$reserve_data[0]['c_member_id'];
			$result=db_get_all($sql);
			$ab_list[$key]['mail'] = t_decrypt($result[0]['pc_address']);
		}
	}

	$this->set('ab_list', $ab_list);

        return 'success';
    }
}

?>
