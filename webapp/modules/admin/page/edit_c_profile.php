<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// プロフィール項目変更
class admin_page_edit_c_profile extends OpenPNE_Action
{
    function execute($requests)
    {
	// アクセス権限
	$sql = "select name, atoffice_auth_type from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$this->set('name', $result[0]['name']);
	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);

        $v = array();

        $v['c_profile_list'] = db_member_c_profile_list();

        $this->set($v);
        return 'success';
    }
}

?>
