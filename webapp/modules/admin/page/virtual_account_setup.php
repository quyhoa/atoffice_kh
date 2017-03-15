<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_page_virtual_account_setup extends OpenPNE_Action
{
    function execute($requests)
    {

	// アクセス権限
	$sql = "select name, atoffice_auth_type from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$this->set('name', $result[0]['name']);
	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);


	$sql = "select * from a_virtual_account_conf";
	$virtual = db_get_all($sql);
	$this->set('virtual_ac', $virtual);
	$_REQUEST['msg'] = !empty($_REQUEST['msg']) ? $_REQUEST['msg'] : null;// add by quyhoa
	$this->set('msg', $_REQUEST['msg']);

	if(!empty($_REQUEST['index'])){
		$index=$_REQUEST['index'];
	}else{
		$index=0;
	}
	$this->set('index', $index);

	/**
	 * =============== OLD =================
	 */
	// ユーザー削除で存在しないc_member_idの開放
	/* $sql = "select * from a_virtual_account_list ";
	$data = db_get_all($sql);
	foreach($data as $value){
		if($value['c_member_id'] > 0){
			$sql = "select count(*) as count_num from c_member ";
			$sql.= "where c_member_id = ".$value['c_member_id'];
			$result = db_get_all($sql);
			if($result[0]['count_num']==0){
				$sql = "update a_virtual_account_list SET ";
				$sql.= "c_member_id = 0, ";
				$sql.= "flag = 0 ";
				$sql.= "where seq_number = ".$value['seq_number'];
				db_get_all($sql);
			}
		}

	}


	// 口座リスト
	// 件数
	$sql = "select count(*) as count_num from a_virtual_account_list";
	$result = db_get_all($sql);
	$num = $result[0]['count_num'];
	$this->set('num', $num);

	$page_list = get_page_list($index, $num, 100, 30);
	$this->set('page_list', $page_list);

	// 固定数
	$sql = "select count(*) as count_num from a_virtual_account_list ";
	$sql.= "where c_member_id > 0";
	$result = db_get_all($sql);
	$this->set('kotei', $result[0]['count_num']);

	// 利用中数
	$sql = "select count(*) as count_num from a_virtual_account_list ";
	$sql.= "where flag > 0";
	$result = db_get_all($sql);
	$this->set('using', $result[0]['count_num']);
 */
	// 表示分
	/* $sql = "select * from a_virtual_account_list ";
	$sql.= "limit ".$index.", 100";
	$kouza_list = db_get_all($sql);
	if($kouza_list){
		foreach($kouza_list as $key=>$value){
			// 顧客データ
			$sql = "select * from c_member where c_member_id = ".$value['c_member_id'];
			$c_member = db_get_all($sql);
			$kouza_list[$key]['c_member'] = $c_member[0];
			// 予約データ
			$sql = "select * from a_reserve_list where virtual_code = ".$value['virtual_number']." and pay_flag = 0 and cancel_flag = 0 and complete_flag = 0";
			$reserve_data = db_get_all($sql);
			$kouza_list[$key]['reserve'] = $reserve_data[0];				// キャンセル請求データ
			$sql = "select * from a_amount_billed where virtual_code = '".$value['virtual_number']."' and flag=0";
			$ab_data = db_get_all($sql);
			$kouza_list[$key]['ab_data'] = $ab_data[0];
		}
	}else{
		$kouza_list = 0;
	} */

	//var_dump($kouza_list);

	
	/**
	 * =============== NEW =================
	 */
	// ユーザー削除で存在しないc_member_idの開放
	$sql = "SELECT a_virtual_account_list.c_member_id, COUNT(c_member.c_member_id) AS count_member
            FROM a_virtual_account_list
            LEFT JOIN c_member ON a_virtual_account_list.c_member_id = c_member.c_member_id
            WHERE a_virtual_account_list.c_member_id > 0
	        GROUP BY a_virtual_account_list.c_member_id
            HAVING  count_member = 0";
	$c_member = db_get_all($sql);
	$member_ids = array();
	if ($c_member) {
	    foreach ($c_member as $member) {
	        array_push($member_ids, $member['c_member_id']);
	    }
	    // Update member
	    if (count($member_ids) > 0){
	        $ids = implode(", ", $member_ids);
	        $sql = "UPDATE a_virtual_account_list
	        SET c_member_id = 0, flag = 0
	        WHERE c_member_id IN($ids) ";
	        db_get_all($sql);
	    }
	}
	
	// 口座リスト
	// 件数/固定数/利用中数
	$sql = "SELECT  COUNT(*) AS count_num,
                SUM( CASE WHEN c_member_id > 0 THEN 1 ELSE 0 END ) count_kotei,
                SUM( CASE WHEN flag > 0 THEN 1 ELSE 0 END ) count_using
            FROM a_virtual_account_list";
	$result = db_get_all($sql);
	$num = $result[0]['count_num'];
	$this->set('num', $num);
	$page_list = get_page_list($index, $num, 100, 30);
	$this->set('page_list', $page_list);
	$this->set('kotei', $result[0]['count_kotei']);
	$this->set('using', $result[0]['count_using']);

	// 表示分
	$sql = "SELECT c_member.c_member_id, c_member.nickname, a_virtual_account_list.*
            FROM a_virtual_account_list 
            LEFT JOIN c_member ON a_virtual_account_list.c_member_id = c_member.c_member_id
            LIMIT $index, 100";
	$kouza_list = db_get_all($sql);
	
	if(!$kouza_list){
	    $kouza_list = 0;
	}
	
	$this->set('kouza_list', $kouza_list);
        return 'success';
    }
}

?>
