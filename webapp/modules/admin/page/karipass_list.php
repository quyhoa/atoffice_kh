<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_page_karipass_list extends OpenPNE_Action
{
    function execute($requests)
    {

	// アクセス権限
	$sql = "select name, atoffice_auth_type from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$this->set('name', $result[0]['name']);
	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);


	if(isset($_REQUEST['index']) && $_REQUEST['index']){
		$index=$_REQUEST['index'];
	}else{
		$index=0;
	}
	$this->set('index', $index);

	// 仮パス件数
	$hashed_password = md5("karipass123");
	$sql = "select count(*) as num from c_member_secure where hashed_password = '$hashed_password'";
	$result = db_get_all($sql);
	//print $result[0]['num'];
	$num = $result[0]['num'];
	$this->set('num', $result[0]['num']);
	$page_list = get_page_list($index, $num, 10, 30);
	$this->set('page_list', $page_list);

	// 表示データ取得
	$sql = "select * from c_member_secure where hashed_password = '$hashed_password'";
	$data = db_get_all($sql);

	if(!empty($data)){
		foreach($data as $key=>$value){
			$sql = "select * from c_member where c_member_id = ".$value['c_member_id'];
			$result = db_get_all($sql);
			$data[$key]['c_member'] = $result[0];
			$corp = get_profile_value($value['c_member_id'], 12);
			$data[$key]['corp'] = $corp;
			$mail = t_decrypt($value['pc_address']);
			$data[$key]['mail'] = $mail;

		}
	}

	$this->set('data', $data);

        return 'success';
    }
}

?>
