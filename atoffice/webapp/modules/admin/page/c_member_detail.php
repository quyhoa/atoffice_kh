<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// メンバー強制退会 確認画面
class admin_page_c_member_detail extends OpenPNE_Action
{
    function execute($requests)
    {

	if($_GET['msg']){
		$this->set('msg', $_GET['msg']);
	}

        $v = array();

        $v['c_profile_list'] = db_member_c_profile_list4null();
	// 必要のないプロフィール削除
	$check_v = array();
	$line=0;
	foreach($v['c_profile_list'] as $ck=>$cv){
		if($cv['c_profile_id']!=9){
			$check_v[$line] = $v['c_profile_list'][$ck];
			$line++;
		}
	}
	$v['c_profile_list'] = $check_v;


        $v['c_member'] = db_member_c_member4c_member_id($requests['target_c_member_id'], true, true, 'private');
        $v['from'] = $requests['from'];
        $this->set($v);

	// ブラックリストデータ
	$sql = "select info from c_blacklist where c_member_id = ".$requests['target_c_member_id'];
	$info = db_get_all($sql);
	$this->set('info', $info[0]['info']);

	// 代理店データ
	$sql = "select * from a_agency where c_member_id = ".$requests['target_c_member_id'];
	$agency_data = db_get_all($sql);
	$this->set('agency_data', $agency_data[0]);

	// バーチャル口座
	$sql = "select * from a_virtual_account_list where kotei=1 and c_member_id = ".$requests['target_c_member_id'];
	$virtual_number = db_get_all($sql);
	if($virtual_number[0]['virtual_number']){
		$vn = $virtual_number[0]['virtual_number'];
		$vn_flag = $virtual_number[0]['flag'];
	}else{
		$vn = 0;
	}
	$this->set('vn', $vn);
	$this->set('vn_flag', $vn_flag);

	$sql = "select * from c_blacklist where c_member_id = ".$requests['target_c_member_id'];
	$result = db_get_all($sql);
	if($result){
		$this->set('blist', 1);
	}else{
		$this->set('blist', 0);
	}

        return 'success';
    }
}

?>
