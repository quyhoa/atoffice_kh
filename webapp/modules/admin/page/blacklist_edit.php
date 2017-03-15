<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class admin_page_blacklist_edit extends OpenPNE_Action
{
    function execute($requests)
    {
	$sql = "select * from c_blacklist where c_blacklist_id = ".$requests['target_c_blacklist_id'];
        $c_black_list = db_get_all($sql);
	$c_black_list = $c_black_list[0];

        if (!$c_black_list) {
            admin_client_redirect('blacklist', 'ブラックリストに登録されていません');
        }

        if ($requests['easy_access_id']) {
            $c_black_list['easy_access_id'] = $requests['easy_access_id'];
        }
        if ($requests['info']) {
            $c_black_list['info'] = $requests['info'];
        }

	// 氏名
	$sql = "select nickname from c_member where c_member_id = ".$c_black_list['c_member_id'];
	$nickname = db_get_all($sql);
	$c_black_list['nickname'] = $nickname[0]['nickname'];
	// メアド
	$sql = "select pc_address from c_member_secure where c_member_id = ".$c_black_list['c_member_id'];
	$mail = db_get_all($sql);
	$mail = t_decrypt($mail[0]['pc_address']);
	$c_black_list['mail'] = $mail;

        $this->set('blacklist', $c_black_list);

        return 'success';
    }
}

?>
