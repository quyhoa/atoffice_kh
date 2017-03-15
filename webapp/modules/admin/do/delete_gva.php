<?php

/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// プロフィール項目追加
class admin_do_delete_gva extends OpenPNE_Action
{

    function execute ($requests)
    {
        // var_dump($_REQUEST);
        $dm = $_POST['delete_month'];
        /**
         * ========= OLD ==========
         */
        // ゲストのメンバーIDリスト
        /* $sql = "select * from c_member where guest_flag = 1";
        $c_member = db_get_all($sql);
        
        if ($c_member) {
            foreach ($c_member as $key => $value) {
                // ○ヵ月以内の予約があるか
                $sql = "select * from a_reserve_list where c_member_id = " .
                         $value['c_member_id'] .
                         " and (tmp_reserve_datetime >= now() - INTERVAL $dm month) order by tmp_reserve_datetime desc";
                $check = db_get_all($sql);
                if (! $check) {
                    
                    $sql = "select * from a_virtual_account_list where c_member_id = " .
                             $value['c_member_id'] . " and flag = 0";
                    $vc = db_get_all($sql);
                    if ($vc) {
                        
                        $sql = "update a_virtual_account_list SET ";
                        $sql .= "flag = 0, ";
                        $sql .= "c_member_id = 0 ";
                        $sql .= "where c_member_id = " . $value['c_member_id'];
                        
                        db_get_all($sql);
                    }
                }
            }
        } */
        
        /**
         * ========= NEW ==========
         */
        // Set max lenght group concat
        $sql = "SET SESSION group_concat_max_len = 1000000";
        db_get_all($sql);
        
        // Get member all id
        $sql = "SELECT GROUP_CONCAT(c_member_id ORDER BY c_member.c_member_id) AS c_member_id
            FROM c_member
	        ORDER BY c_member_id";
        $all_members = db_get_all($sql);
        $all_member_ids = array(explode(',', $all_members[0]['c_member_id']));
        
        // Get member check id
        $sql = "SELECT GROUP_CONCAT( DISTINCT c_member.c_member_id ORDER BY c_member.c_member_id) AS c_member_id
        FROM a_reserve_list
        LEFT JOIN c_member ON  a_reserve_list.c_member_id = c_member.c_member_id
        WHERE  a_reserve_list.tmp_reserve_datetime >= now() - INTERVAL $dm month";
        $check_members = db_get_all($sql);
        $check_member_ids = array(explode(',', $check_members[0]['c_member_id']));
        
        $member_ids = array_diff($all_member_ids[0], $check_member_ids[0]);
        
        // Get member id virtual
        $sql = "SELECT GROUP_CONCAT( DISTINCT c_member.c_member_id ORDER BY c_member.c_member_id) AS c_member_id
            FROM c_member
            JOIN a_virtual_account_list ON  a_virtual_account_list.c_member_id = c_member.c_member_id
	        WHERE  a_virtual_account_list.flag = 0";
        $virtual_members = db_get_all($sql);
        $virtual_member_ids = array(explode(',', $virtual_members[0]['c_member_id']));
        
        $ids = array_intersect($member_ids, $virtual_member_ids[0]);
        if ($ids) {
             
            $str_ids = implode(", ", $ids);
            $sql = "UPDATE a_virtual_account_list
            SET
            a_virtual_account_list.flag = 0,
            c_member_id = 0
            WHERE c_member_id IN($str_ids)";
            db_get_all($sql);
        }
        
        admin_client_redirect('virtual_account_setup', 
                '期間内に利用していないゲストの仮想口座を解放しました。');
    }
}

?>
