<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// プロフィール項目追加
class admin_do_customer_edit extends OpenPNE_Action
{
    function execute($requests)
    {
	$cmi=trim($_POST['c_member_id'])+0;
	// 1) 氏名、生年月日更新 (c_member)
	$qq=""; $qcn="";
	if(isset($_POST["nickname"])){
		$a=$_POST["nickname"];
		if($a!=""){ $qq.=$qcn."nickname='".mysql_real_escape_string($a)."'"; $qcn=","; }
	}
	if(isset($_POST['birth_year'])){
		$a=trim($_POST['birth_year'])+0;
		if($a>0){ $qq.=$qcn."birth_year=".$a; $qcn=","; }
	}
	if(isset($_POST['birth_month'])){
		$a=trim($_POST['birth_month'])+0;
		if($a>0 && $a<13){ $qq.=$qcn."birth_month=".$a; $qcn=","; }
	}
	if(isset($_POST['birth_day'])){
		$a=trim($_POST['birth_day'])+0;
		if($a>0 && $a<32){ $qq.=$qcn."birth_day=".$a; $qcn=","; }
	}

	if($qq!=""){
		$sql="update c_member set $qq where c_member_id=$cmi";
		db_get_all($sql);
	}
	//
	// 2) 各プロフィール抽出
        $v['c_profile_list'] = db_member_c_profile_list4null();
	foreach($v['c_profile_list'] as $ck=>$cv){
		if($cv['c_profile_id']!=9){
			$a=$cv['name'];
			if(isset($_POST[$a])){
				$cpi=$cv['c_profile_id'];
				$sql="select * from c_member_profile where c_member_id=$cmi and c_profile_id=$cpi";
				$result = db_get_all($sql);
				if($result[0]==NULL){
					$sql="insert into c_member_profile (c_member_id,c_profile_id,public_flag) values($cmi,$cpi,".$cv['public_flag_default'].")";
					db_get_all($sql);
				}
				$sql="update c_member_profile set value='".mysql_real_escape_string($_POST[$a])."' where c_member_id=$cmi and c_profile_id=$cpi";
				db_get_all($sql);
			}
		}
	}
	// 1) 氏名、生年月日更新 (c_member)
	$qq=""; $qcn="";
	if(isset($_POST["pc_address"])){
		$a=trim($_POST["pc_address"]);
		if($a!=""){ $qq.=$qcn."pc_address='".mysql_real_escape_string(t_encrypt($a))."'"; $qcn=","; }
	}
	if(isset($_POST['regist_address'])){
		$a=trim($_POST['regist_address']);
		if($a!=""){ $qq.=$qcn."regist_address='".mysql_real_escape_string(t_encrypt($a))."'"; $qcn=","; }
	}

	if($qq!=""){
		$sql="update c_member_secure set $qq where c_member_id=$cmi";
		db_get_all($sql);
	}

	admin_client_redirect('customer_edit_detail', '登録情報を更新しました。',"target_c_member_id=$cmi");
//	admin_client_redirect('customer_edit_detail', $vvv,"target_c_member_id=$cmi");


    }
}


?>
