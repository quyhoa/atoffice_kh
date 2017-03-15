<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// プロフィール項目追加
class admin_do_repayment extends OpenPNE_Action
{

    function execute($requests)
    {
    
        $IsEmail =$_POST["txtEmail"];
        $reserve_id = $_POST['reserve_id'];
    	$repayment_id = $_POST['repayment_id'];
    	$repayment_money = $_POST['repayment_money'];
        $body = $_POST['body'];
  
   
    	$sql = "select * from a_reserve_list where reserve_id = $reserve_id";
    	$reserve_data = db_get_all($sql);
    	$reserve_data = $reserve_data[0];
    
    	$sql = "select * from c_member where c_member_id = ".$reserve_data['c_member_id'];
    	$nickname = db_get_all($sql);
    
    	if($nickname[0]['guest_flag'] == 0)
        {
    		$account = "会員";
    	}
        else
        {
    		$account = "ゲスト";
    	}
    
    	$nickname = $nickname[0]['nickname'];

    	$corp = get_profile_value($reserve_data['c_member_id'], 12);
    	$address = get_profile_value($reserve_data['c_member_id'], 3).get_profile_value($reserve_data['c_member_id'], 14).get_profile_value($reserve_data['c_member_id'], 15).get_profile_value($reserve_data['c_member_id'], 16);
        
    	// メアド取得
    	$sql = "select pc_address from c_member_secure where c_member_id =".$reserve_data['c_member_id'];
    	$result=db_get_all($sql);
    	$mail = t_decrypt($result[0]['pc_address']);
        
        
    	//$body = "$corp\n";
    	//$body.= "$nickname 様\n\n";
        
    	$source = get_c_template_mail_source('m_atoffice_repay');
    	list($subject, $tmp_body) = explode("\n", $source, 2);
    
    	if(!$subject)
        {
    		$subject = "ご返金完了のお知らせ";
    	}
    	$subject.= "【".get_hall_name($reserve_data['hall_id'])."/".$nickname."様】";
    
    	//$body.= $tmp_body."\n\n";
    
    	//$body.= "**************************************************\n";
    	//$body.= "■予約ID：".$reserve_data['reserve_id']."\n";
    	//$body.= "■施設名：".get_hall_name($reserve_data['hall_id'])."\n\n";
    
    	if($reserve_data['total_price'] < $reserve_data['pay_money'] and $reserve_data['cancel_flag'] == 0)
        {
    		// 過剰入金分
    		$sql = "update a_reserve_list SET pay_money = pay_money - $repayment_money where reserve_id = $reserve_id";
    		db_get_all($sql);
    		$sql = "update a_repayment_list SET flag=1, repayment_datetime=now() where repayment_id = $repayment_id";
    		db_get_all($sql);
    	//	$body.=  "過剰入金分の返金をいたしました。\n";
    	//	$body.= "■請求総額：".number_format($reserve_data['total_price'])." 円\n";
    	}
        else
        {
    		// キャンセル分
    		$sql = "update a_repayment_list SET flag=1, repayment_datetime=now() where repayment_id = $repayment_id";
    		db_get_all($sql);
    		//$body.= "ご利用キャンセルに伴う返金をいたしました。\n";
    		$cancel = get_cancel_price2($reserve_id);
    		//$body.= "■キャンセル料金：".number_format($cancel['cancel_price'])."\n";
    	}
    
    
    	$body=$body;
        if($IsEmail==1)
        {
            put_mail_queue($mail, $subject, $body);
        }
        
    
    	$sql = "select mailing_list from a_hall where hall_id = ".$reserve_data['hall_id'];
    	$ml = db_get_all($sql);
    	$ml = $ml[0]['mailing_list'];
    	// メーリングリストにも送信
    	if($ml)
        {
               if($IsEmail==1)
               {  
    	   
    		      put_mail_queue($ml, $subject, $body);
               }
           
    	}
       
        if($IsEmail==1)
        {
           admin_client_redirect('repayment_list', '返金処理を行い、メール通知を送信しました。');
        }
        else
       {
             admin_client_redirect('repayment_list', ' 返金処理を行いました（メール送信しません）。');
       }
    
    }
}


?>
