<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class admin_page_save_data_pre_resever extends OpenPNE_Action
{
    function execute($requests)
    {
		
		$pre_id=isset($_POST['pre_id'])?trim($_POST['pre_id']):'';
		$message=isset($_POST['message'])?trim($_POST['message']):'';
		$c_member_id=isset($_POST['uid'])?trim($_POST['uid']):'';
		$long_term=isset($_POST['long_term'])?trim($_POST['long_term']):'';
		$mail_flag=isset($_POST['mail_flag'])?trim($_POST['mail_flag']):'';
		$shimei=isset($_POST['shimei'])?trim($_POST['shimei']):'';
		$kana=isset($_POST['kana'])?trim($_POST['kana']):'';
		$riyo=isset($_POST['riyo'])?trim($_POST['riyo']):'';
		$daihyou=isset($_POST['daihyou'])?trim($_POST['daihyou']):'';
		$busho=isset($_POST['busho'])?trim($_POST['busho']):'';
		$mail=isset($_POST['mail'])?trim($_POST['mail']):'';
		$ken=isset($_POST['ken'])?trim($_POST['ken']):'';
		$zip=isset($_POST['zip'])?trim($_POST['zip']):'';
		$address_city=isset($_POST['address_city'])?trim($_POST['address_city']):'';
		$address_banchi=isset($_POST['address_banchi'])?trim($_POST['address_banchi']):'';
		$address_build=isset($_POST['address_build'])?trim($_POST['address_build']):'';
		$tel=isset($_POST['tel'])?trim($_POST['tel']):'';
		$fax=isset($_POST['fax'])?trim($_POST['fax']):'';
		$sql1="select id from a_tmp_user where pre_id='$pre_id'";
		$isset_pre_id=db_get_all($sql1);
		if(empty($isset_pre_id)){
			$sql="insert into a_tmp_user values(
				'','$pre_id','$c_member_id','$message','$long_term','$mail_flag','$shimei','$kana','$riyo','$daihyou','$busho','$mail','$ken','$zip','$address_city','$address_banchi','$address_build','$tel','$fax'			
			)		
			";
		}else{
			$sql="update a_tmp_user set 
				message='$message',
				c_member_id='$c_member_id',
				long_term='$long_term',
				mail_flag='$mail_flag',
				shimei='$shimei',
				kana='$kana',
				riyo='$riyo',
				daihyou='$daihyou',
				busho='$busho',
				mail='$mail',
				ken='$ken',
				zip='$zip',
				address_city='$address_city',
				address_banchi='$address_banchi',
				address_build='$address_build',
				tel='$tel',
				fax='$fax'
				WHERE pre_id='$pre_id'
			";
		}
        db_get_all($sql);
        return 'success';
    }
}

?>
