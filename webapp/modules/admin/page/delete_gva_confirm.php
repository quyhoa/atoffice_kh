<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_page_delete_gva_confirm extends OpenPNE_Action
{
    function execute($requests)
    {

	// アクセス権限
	$sql = "select name, atoffice_auth_type from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$this->set('name', $result[0]['name']);
	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);

	$dm = $_POST['delete_month'];
	$this->set('dm', $dm);

	/**
	 * ========= OLD ==========
	 */
	// ゲストのメンバーIDリスト
	/* $sql = "select * from c_member where guest_flag = 1";
	$c_member = db_get_all($sql);

	if($c_member){
		foreach($c_member as $key=>$value){
			// ○ヵ月以内の予約があるか
			$sql = "select * from a_reserve_list where c_member_id = ".$value['c_member_id']." and (tmp_reserve_datetime >= now() - INTERVAL $dm month) order by tmp_reserve_datetime desc";
			$check = db_get_all($sql);
			if(!$check){

				$sql = "select * from a_virtual_account_list where c_member_id = ".$value['c_member_id']." and flag = 0";
				$vc = db_get_all($sql);
if($vc){
				$c_member[$key]['vc'] = $vc[0]['virtual_number'];

				$sql = "select * from a_reserve_list where c_member_id = ".$value['c_member_id']." order by tmp_reserve_datetime desc";
				$reserve_data = db_get_all($sql);
				$c_member[$key]['reserve_data']=$reserve_data[0];
				$c_member[$key]['corp']=get_profile_value($value['c_member_id'], 12);
;
				$c_member[$key]['delete_flag']=1;
}else{
				$c_member[$key]['delete_flag']=0;
}
			}else{
				$c_member[$key]['delete_flag']=0;
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
	        WHERE  a_reserve_list.tmp_reserve_datetime >= now() - INTERVAL $dm month
	        ";
	$check_members = db_get_all($sql);
	$check_member_ids = array(explode(',', $check_members[0]['c_member_id']));
	
	$member_ids = array_diff($all_member_ids[0], $check_member_ids[0]);
	
	// Get member id virtual
	$sql = "SELECT GROUP_CONCAT( DISTINCT c_member.c_member_id ORDER BY c_member.c_member_id) AS c_member_id
            FROM c_member
            JOIN a_virtual_account_list ON  a_virtual_account_list.c_member_id = c_member.c_member_id
	        WHERE  a_virtual_account_list.flag = 0
	        ";
	$virtual_members = db_get_all($sql);
	$virtual_member_ids = array(explode(',', $virtual_members[0]['c_member_id']));
	
	$ids = array_intersect($member_ids, $virtual_member_ids[0]);
	
	if ($ids) {
	    
	    $str_ids = implode(", ", $ids);
	    
	    // ゲストのメンバーIDリスト
	    $sql = "SELECT * 
                FROM
                (
                    (   SELECT  c_member.c_member_id, c_member.nickname, c_member_profile.value AS corp,
	                       MAX( a_reserve_list.tmp_reserve_datetime) AS tmp_reserve_datetime,
	                       a_virtual_account_list.virtual_number AS virtual_number
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
	                       a_virtual_account_list.virtual_number AS virtual_number

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
	    $c_member = db_get_all($sql);
	}
	$this->set('c_member', $c_member);
        return 'success';
    }
}

?>
