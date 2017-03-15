<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// プロフィール項目追加
class admin_do_add_report extends OpenPNE_Action
{

    function execute($requests)
    {
	//var_dump($_POST);


	// レポート保存
	$sql = "insert into a_report (reserve_id, reporter, report, report_datetime, original_state, vessel_collect, garbage, room_check, room_check_info, thing_left, thing_left_info, blacklist_request, blacklist_request_info) values (".$_POST['reserve_id'].", ".$_POST['reporter'].", '".$_POST['report']."', now(), ".$_POST['original_state'].", ".$_POST['vessel_collect'].", ".$_POST['garbage'].", ".$_POST['room_check'].", '".$_POST['room_check_info']."', ".$_POST['thing_left'].", '".$_POST['thing_left_info']."', ".$_POST['blacklist_request'].", '".$_POST['blacklist_request_info']."')";
	db_get_all($sql);

	// 予約状態を完了済みに変更
	$sql = "update a_reserve_list SET complete_flag=1 where reserve_id = ".$_POST['reserve_id'];
	db_get_all($sql);

	admin_client_redirect($_POST['page'], '完了報告しました。',$_POST['tail']);


    }
}


?>
