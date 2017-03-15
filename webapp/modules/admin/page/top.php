<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 管理画面トップページ 認証済み
class admin_page_top extends OpenPNE_Action
{
    function execute($requests)
    {
        $v = array();

        $v['SNS_NAME'] = SNS_NAME;
        $v['OPENPNE_VERSION'] = OPENPNE_VERSION;

        $this->set($v);

	$sql = "select name, atoffice_auth_type, hall_id from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$this->set('name', $result[0]['name']);
	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);

	if($result[0]['hall_id']){
		$sql = "select hall_name from a_hall where hall_id = ".$result[0]['hall_id'];
		$result = db_get_all($sql);
		$this->set('hall_name', $result[0]['hall_name']);

	}

// 管理者監視
if($result[0]['atoffice_auth_type']==4){
	// 仮予約の承認待ち（２営業日経過）
	$business_days = get_before_business_days(2);

	$sql = "select count(*) as alert_num from a_reserve_list where ";
	$sql.= "tmp_flag = 1 ";
	$sql.= "and cancel_flag = 0 ";
	$sql.= "and complete_flag = 0 ";
	$sql.= "and tmp_reserve_datetime < '$business_days'";


	$result = db_get_all($sql);
	$this->set('tmp_alert', $result[0]['alert_num']);

	// 未返金数
	$sql = "select count(*) as alert_num from a_repayment_list where ";
	$sql.= "flag = 0";
	$result = db_get_all($sql);
	$this->set('repay_alert', $result[0]['alert_num']);

	// バーチャル口座数
	// 全体数
	$sql = "select count(*) as all_vn from a_virtual_account_list";
	$result = db_get_all($sql);
	$this->set('all_vn', $result[0]['all_vn']);

	// 固定利用数
	$sql = "select count(*) as kotei_vn from a_virtual_account_list where ";
	$sql.= "c_member_id > 0";
	$result = db_get_all($sql);
	$this->set('kotei_vn', $result[0]['kotei_vn']);

	// 完了報告漏れ・入金予定日超過件数
	$check_date = date("Y-m-d H:I:s");

	$sql = "select * from a_hall where flag = 0";
	$hall_list = db_get_all($sql);

	if($hall_list){
		$key=0;
		// 完了漏れ
		$comp_alert = array();
		// 入金予定日超過
		$unpayment_alert = array();
		foreach($hall_list as $value){
			$sql = "select count(*) as alert_num from a_reserve_list where hall_id = ".$value['hall_id']." and cancel_flag = 0 and complete_flag = 0 and finish_datetime < '$check_date'";
			$result = db_get_all($sql);

			if($result[0]['alert_num'] > 0){
				$comp_alert[$key]['hall_name'] = get_hall_name($value['hall_id']);
				$comp_alert[$key]['alert_num'] = $result[0]['alert_num'];
				$key++;
			}
			$sql = "select count(*) as alert_num from a_reserve_list where hall_id = ".$value['hall_id']." and cancel_flag = 0 and tmp_flag = 0 and pay_flag = 0 and pay_limitdate < '$check_date'";
			$result = db_get_all($sql);
			if($result[0]['alert_num'] > 0){
				$unpayment_alert[$key]['hall_name'] = get_hall_name($value['hall_id']);
				$unpayment_alert[$key]['alert_num'] = $result[0]['alert_num'];
				$key++;
			}
		}
	}

	$this->set('comp_alert', $comp_alert);
	$this->set('unpayment_alert', $unpayment_alert);

	// ブラックリスト登録申請待ち
	$sql = "select reserve_id from a_report where blacklist_request = 1";
	$blist_data = db_get_all($sql);

	$blist = array();
	foreach($blist_data as $value){
		$sql = "select c_member_id from a_reserve_list where reserve_id = ".$value['reserve_id'];
		$u = db_get_all($sql);
		$u = $u[0]['c_member_id'];
		$sql = "select count(*) as bl_num from c_blacklist where c_member_id = '$u'";

		$flag = db_get_all($sql);
		$flag = $flag[0]['bl_num'];

		if($flag==0){
			array_push($blist, $value['reserve_id']);
		}
	}
	$this->set('blist_alert', count($blist));


}//if($result[0]['atoffice_auth_type']==4)


        return 'success';
    }

}

?>
