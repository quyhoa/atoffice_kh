<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// メール文言の更新
class admin_do_update_mail extends OpenPNE_Action
{
    function execute($requests)
    {

	//var_dump($_REQUEST);

if($_REQUEST['target']=="m_atoffice_syounin2"){

	if($_REQUEST['hall_id']){
		$hall_id = $_REQUEST['hall_id'];
	}else{
		$params = sprintf('target=%s', $requests['target']);
		admin_client_redirect('edit_mail', '会場IDが取得できませんでした', $params);
		exit();
	}

	$sql = "update a_hall SET ";
	$sql.= "mail = '".$_REQUEST['body']."' ";
	$sql.= "where hall_id = $hall_id";

	db_get_all($sql);
	//$params = sprintf('target=%s', $requests['target']);
	$params = array(
		'target' => $requests['target'],
		'hall_id' => $hall_id
	);

	admin_client_redirect("edit_mail", '変更しました。', $params);
	exit();
}else{

        $name = $requests['target'];
        if ($name == 'inc_signature') {
            $source = $requests['body'];
        } else {
            $source = $requests['subject'] . "\n" . $requests['body'];
        }

        db_replace_c_template($name, $source);

        $params = sprintf('target=%s', $requests['target']);
        admin_client_redirect('edit_mail', '変更しました', $params);
    }
}

}

?>
