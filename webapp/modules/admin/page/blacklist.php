<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class admin_page_blacklist extends OpenPNE_Action
{
    function execute($requests)
    {

	// アクセス権限
	$sql = "select name, atoffice_auth_type from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$this->set('name', $result[0]['name']);
	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);

        $page = $requests['page'];

	$sql = "select * from c_blacklist";
	$c_blacklist_list = db_get_all($sql);

	if($c_blacklist_list){
		foreach($c_blacklist_list as $key => $value){
			// 氏名
			$sql = "select nickname from c_member where c_member_id = ".$value['c_member_id'];
			$nickname = db_get_all($sql);
			$c_blacklist_list[$key]['nickname'] = $nickname[0]['nickname'];
			// メアド
			$sql = "select pc_address from c_member_secure where c_member_id = ".$value['c_member_id'];
			$mail = db_get_all($sql);
			$mail = t_decrypt($mail[0]['pc_address']);
			$c_blacklist_list[$key]['mail'] = $mail;
		}
	}

        $this->set("c_blacklist_list", $c_blacklist_list);
        return 'success';
    }
}

?>
