<?php

/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_do_delete_gva_csv extends OpenPNE_Action
{

    function isSecure ()
    {
        session_cache_limiter('public');
        return true;
    }

    function handleError ($errors)
    {
        admin_client_redirect('delete_gva_confirm', array_shift($errors));
    }

    function execute ($requests)
    {
        $dm = $_POST['delete_month'];
        
        /**
         * ========== OLD ==========
         */
        // ゲストのメンバーIDリスト
        /*
         * $sql = "select * from c_member where guest_flag = 1";
         * $c_member = db_get_all($sql);
         *
         * // CSV作成
         * $list_data = array();
         * $line = 0;
         * $member_key_string = array(
         * "取引先コード",
         * "取引先グループコード",
         * "取引先名（カナ）",
         * "取引先名（漢字）",
         * "期日到来日数",
         * "期日超過日数",
         * "金額調整区分",
         * "調整金額from",
         * "調整金額to",
         * "振り込み専用口座使用フラグ",
         * "振込専用銀行コード",
         * "振込専用支店コード",
         * "振込専用口座科目",
         * "振込専用支店口座番号"
         * );
         *
         * if ($c_member) {
         *
         * foreach ($c_member as $key => $value) {
         * // ○ヵ月以内の予約があるか
         * $sql = "select * from a_reserve_list where c_member_id = " .
         * $value['c_member_id'] .
         * " and (tmp_reserve_datetime >= now() - INTERVAL $dm month) order by
         * tmp_reserve_datetime desc";
         * $check = db_get_all($sql);
         *
         * if (! $check) {
         *
         * $sql = "select * from a_virtual_account_list where c_member_id = " .
         * $value['c_member_id'] . " and flag = 0";
         * $vc = db_get_all($sql);
         * if ($vc) {
         *
         * $sql = "select * from a_reserve_list where c_member_id = " .
         * $value['c_member_id'] .
         * " order by tmp_reserve_datetime desc";
         * $reserve_data = db_get_all($sql);
         *
         * $value['corporation'] = get_profile_value(
         * $value['c_member_id'], 12);
         *
         * $sql = "select * from a_virtual_account_list where c_member_id = '" .
         * $value['c_member_id'] . "' and kotei='1'";
         * $va = db_get_all($sql);
         * $va = $va[0];
         * if ($va['virtual_number']) {
         * $flag = 1;
         * $bank_code = '0001';
         * $code = 1;
         * $virtual = substr($va['virtual_number'], 4, 7);
         * $branch_id = substr($va['virtual_number'], 0, 3);
         * } else {
         * $flag = 0;
         * $bank_code = '';
         * $branch_id = '';
         * $code = '';
         * $virtual = '';
         * }
         *
         * $new_list = array(
         * 'c_member_id' => $value['c_member_id'],
         * 'group_code' => '',
         * 'corp_kana' => 'ｶｲｷﾞｼﾂﾖﾔｸ',
         * 'corp' => $value['corporation'],
         * 'limit_date' => '',
         * 'time_up' => '',
         * 'adjustment' => '',
         * 'from' => '',
         * 'to' => '',
         * 'flag' => $flag,
         * 'bank_code' => $bank_code,
         * 'branch_id' => $branch_id,
         * 'code' => $code,
         * 'virtual' => $virtual
         * );
         * $list_data[$line] = $new_list;
         * $line ++;
         * } else {
         * $c_member[$key]['delete_flag'] = 0;
         * }
         * } else {
         * $c_member[$key]['delete_flag'] = 0;
         * }
         * } // foreach
         *
         * $member_csv_data = $this->create_csv_data($member_key_string,
         * $list_data);
         * // IE以外の場合、キャッシュをさせないヘッダを出力
         * if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') === false) {
         * send_nocache_headers(true);
         * }
         * header("Content-Type: application/octet-stream");
         * header(
         * "Content-Disposition: attachment; filename=delete_master.csv");
         * echo $member_csv_data;
         * exit();
         * }
         */
        
        /**
         * ========== NEW ==========
         */
        // CSV作成
        $member_key_string = array(
                "取引先コード",
                "取引先グループコード",
                "取引先名（カナ）",
                "取引先名（漢字）",
                "期日到来日数",
                "期日超過日数",
                "金額調整区分",
                "調整金額from",
                "調整金額to",
                "振り込み専用口座使用フラグ",
                "振込専用銀行コード",
                "振込専用支店コード",
                "振込専用口座科目",
                "振込専用支店口座番号"
        );
        
        // Set max lenght group concat
        $sql = "SET SESSION group_concat_max_len = 1000000";
        db_get_all($sql);
        
        // Get member all id
        $sql = "SELECT GROUP_CONCAT(c_member_id ORDER BY c_member.c_member_id) AS c_member_id
            FROM c_member
	        ORDER BY c_member_id";
        $all_members = db_get_all($sql);
        $all_member_ids = array(
                explode(',', $all_members[0]['c_member_id'])
        );
        
        // Get member check id
        $sql = "SELECT GROUP_CONCAT( DISTINCT c_member.c_member_id ORDER BY c_member.c_member_id) AS c_member_id
        FROM a_reserve_list
        LEFT JOIN c_member ON  a_reserve_list.c_member_id = c_member.c_member_id
        WHERE  a_reserve_list.tmp_reserve_datetime >= now() - INTERVAL $dm month";
        $check_members = db_get_all($sql);
        $check_member_ids = array(
                explode(',', $check_members[0]['c_member_id'])
        );
        
        $member_ids = array_diff($all_member_ids[0], $check_member_ids[0]);
        
        // Get member id virtual
        $sql = "SELECT GROUP_CONCAT( DISTINCT c_member.c_member_id ORDER BY c_member.c_member_id) AS c_member_id
            FROM c_member
            JOIN a_virtual_account_list ON  a_virtual_account_list.c_member_id = c_member.c_member_id
	        WHERE  a_virtual_account_list.flag = 0";
        $virtual_members = db_get_all($sql);
        $virtual_member_ids = array(
                explode(',', $virtual_members[0]['c_member_id'])
        );
        
        $ids = array_intersect($member_ids, $virtual_member_ids[0]);
        if ($ids) {
            
            $str_ids = implode(", ", $ids);
            // ゲストのメンバーIDリスト
            $sql = "SELECT member_infor.c_member_id, '' AS group_code,  'ｶｲｷﾞｼﾂﾖﾔｸ' AS corp_kana, member_infor.corp AS corporation, 
	                   '' AS limit_date, '' AS time_up, '' AS adjustment, '' AS 'from', '' AS 'to',
                        CASE WHEN member_infor.kotei = 1
                            THEN 1
                            ELSE 0
                        END AS flag,
                        CASE WHEN member_infor.kotei = 1
                            THEN '0001'
                            ELSE ''
                            END AS bank_code,
                        CASE WHEN member_infor.kotei = 1
                            THEN SUBSTR(member_infor.virtual_number, 1, 3)
                            ELSE ''
                        END AS branch_id,
                        CASE WHEN member_infor.kotei = 1
                            THEN 1
                            ELSE 0
                            END AS code,
                        CASE WHEN member_infor.kotei = 1
                            THEN SUBSTR(member_infor.virtual_number, 5, 7)
                            ELSE ''
                        END AS virtual
                    FROM
                    (
                        (   SELECT  c_member.c_member_id, c_member.nickname, c_member_profile.value AS corp,
    	                       MAX( a_reserve_list.tmp_reserve_datetime) AS tmp_reserve_datetime,
    	                       a_virtual_account_list.virtual_number AS virtual_number, 'a_virtual_account_list.kotei' AS kotei
                            FROM c_member
                            JOIN c_member_profile ON c_member.c_member_id = c_member_profile.c_member_id
                            LEFT JOIN a_reserve_list ON  a_reserve_list.c_member_id = c_member.c_member_id
                            RIGHT JOIN a_virtual_account_list ON c_member.c_member_id = a_virtual_account_list.c_member_id
                            WHERE c_member.c_member_id IN ($str_ids)
                            AND c_member_profile.c_profile_id = 12
                            AND a_virtual_account_list.flag= 0
                            AND a_reserve_list.tmp_reserve_datetime< now() - INTERVAL $dm month
                            GROUP BY c_member.c_member_id
                        )
    	            
                        UNION ALL 
    	            
                        (   SELECT  c_member.c_member_id, c_member.nickname, c_member_profile.value AS corp,
    	                       NULL AS tmp_reserve_datetime,
    	                       a_virtual_account_list.virtual_number AS virtual_number, 0 AS kotei
                            FROM c_member
                            JOIN c_member_profile ON c_member.c_member_id = c_member_profile.c_member_id
                            RIGHT JOIN a_virtual_account_list ON c_member.c_member_id = a_virtual_account_list.c_member_id
                            WHERE c_member.c_member_id IN ($str_ids)
                            AND c_member_profile.c_profile_id = 12
                             AND a_virtual_account_list.flag= 0
                            GROUP BY c_member.c_member_id
                        )
                    ) AS member_infor
                    GROUP BY member_infor.c_member_id
                    ORDER BY member_infor.c_member_id";
            $list_data = db_get_all($sql);
            
            if ($list_data) {
                $member_csv_data = $this->create_csv_data($member_key_string, 
                        $list_data);
                // IE以外の場合、キャッシュをさせないヘッダを出力
                if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') === false) {
                    send_nocache_headers(true);
                }
                header("Content-Type: application/octet-stream");
                header(
                        "Content-Disposition: attachment; filename=delete_master.csv");
                echo $member_csv_data;
            }
        }
        exit();
    }

    function create_csv_data ($key_string, $value_list)
    {
        $csv = "";
        foreach ($key_string as $each_key) {
            if ($csv != "") {
                $csv .= ",";
            }
            $csv .= mb_convert_encoding($each_key, 'SJIS', 'UTF-8');
        }
        $csv .= "\n";
        
        foreach ($value_list as $key => $value) {
            $temp = "";
            foreach ($value as $key2 => $value2) {
                $value2 = mb_convert_encoding($value2, 'SJIS', 'UTF-8');
                if ($value2 != null)
                    $value2 = str_replace('"', '""', $value2); // クォート
                if ($value2 != null)
                    $value2 = str_replace("\r\n", "", $value2); // 改行コードを変換
                $temp .= $value2 . ",";
            }
            $csv .= $temp . "\r\n";
        }
        return $csv;
    }
}

?>
