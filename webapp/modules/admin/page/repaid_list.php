<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_page_repaid_list extends OpenPNE_Action
{
    function execute($requests)
    {

	// アクセス権限
	$sql = "select name, atoffice_auth_type from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$this->set('name', $result[0]['name']);
	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);

//　検索オプション

	if(!empty($_REQUEST['repayment_money'])){
		$repayment_money = $_REQUEST['repayment_money'];
	}else{
		$repayment_money = 0;
	}
	$this->set('repayment_money', $repayment_money);

	$reserve_id = !empty($reserve_id) ? $reserve_id : null;// add by quyhoa
	if(!empty($_REQUEST['reserve_id'])){
		$reserve_id = $_REQUEST['reserve_id'];
	}
	$this->set('reserve_id', $reserve_id);
	if(!empty($_REQUEST['begin_date'])){
		$begin_date = $_REQUEST['begin_date'];
	}else{
		$begin_date = '0000-00-00';
	}
	$this->set('begin_date', $begin_date);

	if(!empty($_REQUEST['finish_date'])){
		$finish_date = $_REQUEST['finish_date'];
	}else{
		$finish_date = '0000-00-00';
	}
	$this->set('finish_date', $finish_date);

	if(!empty($_REQUEST['index'])){
		$index=$_REQUEST['index'];
	}else{
		$index=0;
	}
	$this->set('index', $index);

	// 件数
	$sql = "select count(reserve_id) as repay_num from a_repayment_list where flag = 1 ";

	if($repayment_money>0){
		$sql.= "and repayment_money >= '$repayment_money' ";
	}
	if($reserve_id){
		$sql.= "and reserve_id = '$reserve_id' ";
	}
	if($begin_date!='0000-00-00' and $finish_date!='0000-00-00'){
		$sql.= "and (repayment_datetime >= '".$begin_date." 00:00:00' ";
		$sql.= "and repayment_datetime <= '".$finish_date." 23:59:59') ";
	}

	$sql.= "order by repayment_datetime ";

	$result = db_get_all($sql);
	$num = $result[0]['repay_num'];
	$this->set('num', $num);

	$page_list = get_page_list($index, $num, 10, 30);
	$this->set('page_list', $page_list);
// 検索
	$sql = "select * from a_repayment_list where flag = 1 ";
	if($repayment_money>0){
		$sql.= "and repayment_money >= '$repayment_money' ";
	}
	if($reserve_id){
		$sql.= "and reserve_id = '$reserve_id' ";
	}
	if($begin_date!='0000-00-00' and $finish_date!='0000-00-00'){
		$sql.= "and (repayment_datetime >= '".$begin_date." 00:00:00' ";
		$sql.= "and repayment_datetime <= '".$finish_date." 23:59:59') ";
	}

	$sql.= "order by repayment_datetime ";
	$sql.= "limit ".$index.", 10";
	$repayment_list = db_get_all($sql);

	if($repayment_list){
		foreach($repayment_list as $key=>$value){

            $dt = new DateTime($value['repayment_datetime']);
            $repayment_list[$key]['repayment_datetime'] = $dt->format("Y年m月d日 H時i分s秒");

			$sql = "select * from a_reserve_list where reserve_id = ".$value['reserve_id'];
			$reserve_data = db_get_all($sql);

            $dt = new DateTime($reserve_data[0]['tmp_reserve_datetime']);
            $reserve_data[0]['tmp_reserve_datetime'] = $dt->format("Y年m月d日 H時i分s秒");
            $dt = new DateTime($reserve_data[0]['reserve_datetime']);
            $reserve_data[0]['reserve_datetime'] = $dt->format("Y年m月d日 H時i分s秒");
            $dt = new DateTime($reserve_data[0]['begin_datetime']);
            $reserve_data[0]['begin_datetime'] = $dt->format("Y年m月d日 H時i分");
            $dt = new DateTime($reserve_data[0]['finish_datetime']);
            $reserve_data[0]['finish_datetime'] = $dt->format("Y年m月d日 H時i分");
            $dt = new DateTime($reserve_data[0]['pay_limitdate']);
            $reserve_data[0]['pay_limitdate'] = $dt->format("Y年m月d日");
            if($reserve_data[0]['cancel_datetime'] != "0000-00-00 00:00:00"){
                $dt = new DateTime($reserve_data[0]['cancel_datetime']);
                $reserve_data[0]['cancel_datetime'] = $dt->format("Y年m月d日 H時i分s秒");
            }else{
                $reserve_data[0]['cancel_datetime'] = "-- --";
            }


			$repayment_list[$key]['reserve_data'] = $reserve_data[0];
			$repayment_list[$key]['hall_name'] = get_hall_name($reserve_data[0]['hall_id']);
			$repayment_list[$key]['room_name'] = get_room_name($reserve_data[0]['hall_id'], $reserve_data[0]['room_id']);
			$sql = "select * from c_member where c_member_id = ".$reserve_data[0]['c_member_id'];
			$c_member = db_get_all($sql);
			$repayment_list[$key]['c_member'] = $c_member[0];
			// プロフィール
			$repayment_list[$key]['corp'] = get_profile_value($reserve_data[0]['c_member_id'], 12);
			// メアド取得
			$sql = "select pc_address from c_member_secure where c_member_id =".$reserve_data[0]['c_member_id'];
			$result=db_get_all($sql);
			$repayment_list[$key]['mail'] = t_decrypt($result[0]['pc_address']);
		}
	}

	$this->set('repayment_list', $repayment_list);

        return 'success';
    }
}

?>
