<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_page_repayment_list extends OpenPNE_Action
{
    function execute($requests)
    {
     	// アクセス権限
    	$sql = "select name, atoffice_auth_type from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
    	$result = db_get_all($sql);
    	$this->set('name', $result[0]['name']);
    	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);
    
        //検索オプション
    	if($_REQUEST['repayment_money']){
    		$repayment_money = $_REQUEST['repayment_money'];
    	}else{
    		$repayment_money = 0;
    	}
        
    	if($_REQUEST['reserve_id']){
    		$reserve_id = $_REQUEST['reserve_id'];
    	}
    	$this->set('reserve_id', $reserve_id);
    	if($_REQUEST['begin_date']){
    		$begin_date = $_REQUEST['begin_date'];
    	}else{
    		$begin_date = '0000-00-00';
    	}
    	$this->set('begin_date', $begin_date);
    
    	if($_REQUEST['finish_date']){
    		$finish_date = $_REQUEST['finish_date'];
    	}else{
    		$finish_date = '0000-00-00';
    	}
    	$this->set('finish_date', $finish_date);
    
    	if($_REQUEST['index']){
    		$index=$_REQUEST['index'];
    	}else{
    		$index=0;
    	}
    	$this->set('index', $index);
    
    	// 件数
    	$sql = "select count(reserve_id) as repay_num from a_repayment_list where flag = 0 ";
    	if($repayment_money>0){
    		$sql.= "and repayment_money >= '$repayment_money' ";
    	}
    	if($reserve_id){
    		$sql.= "and reserve_id = '$reserve_id' ";
    	}
    	if($begin_date!='0000-00-00' and $finish_date!='0000-00-00')
        {
    		$sql.= "and (add_datetime >= '".$begin_date." 00:00:00' ";
    		$sql.= "and add_datetime <= '".$finish_date." 23:59:59') ";
    	}
    
    	$sql.= "order by repayment_datetime ";
    	$result = db_get_all($sql);
    	$num = $result[0]['repay_num'];
    	$this->set('num', $num);
    
    	$page_list = get_page_list($index, $num, 10, 30);
    	$this->set('page_list', $page_list);
    
    // 検索
    	$sql = "select * from a_repayment_list where flag = 0 ";
        if($reserve_id){
            $sql.= "and reserve_id = '$reserve_id' ";
        }
    	if($repayment_money>0){
    		$sql.= "and repayment_money >= '$repayment_money' ";
    	}    	
    	if($begin_date!='0000-00-00' and $finish_date!='0000-00-00')
        {
    		$sql.= "and (add_datetime >= '".$begin_date." 00:00:00' ";
    		$sql.= "and add_datetime <= '".$finish_date." 23:59:59') ";
    	}
    
    	$sql.= "order by repayment_datetime ";
    	$sql.= "limit ".$index.", 10";
    	$repayment_list = db_get_all($sql);
    	if($repayment_list)
        {
    		foreach($repayment_list as $key=>$value)
            {
    			$sql = "select * from a_reserve_list where reserve_id = ".$value['reserve_id'];
    			$reserve_data = db_get_all($sql);
				if($reserve_data[0]['tmp_reserve_datetime'] != "0000-00-00 00:00:00")
                {
					$dt = new DateTime($reserve_data[0]['tmp_reserve_datetime']);
					$reserve_data[0]['tmp_reserve_datetime'] = $dt->format("Y年m月d日 H時i分s秒");
				}else{
					$reserve_data[0]['tmp_reserve_datetime'] = "-- --";
				}
				if($reserve_data[0]['reserve_datetime'] != "0000-00-00 00:00:00")
                {
					$dt = new DateTime($reserve_data[0]['reserve_datetime']);
					$reserve_data[0]['reserve_datetime'] = $dt->format("Y年m月d日 H時i分s秒");
				}else{
					$reserve_data[0]['reserve_datetime'] = "-- --";
				}
				if($reserve_data[0]['begin_datetime'] != "0000-00-00 00:00:00")
                {
					$dt = new DateTime($reserve_data[0]['begin_datetime']);
					$reserve_data[0]['begin_datetime'] = $dt->format("Y年m月d日 H時i分");
				}else{
					$reserve_data[0]['begin_datetime'] = "-- --";
				}
				if($reserve_data[0]['finish_datetime'] != "0000-00-00 00:00:00")
                {
					$dt = new DateTime($reserve_data[0]['finish_datetime']);
					$reserve_data[0]['finish_datetime'] = $dt->format("Y年m月d日 H時i分");
				}else{
					$reserve_data[0]['finish_datetime'] = "-- --";
				}
				if($reserve_data[0]['pay_limitdate'] != "0000-00-00 00:00:00")
                {
					$dt = new DateTime($reserve_data[0]['pay_limitdate']);
					$reserve_data[0]['pay_limitdate'] = $dt->format("Y年m月d日");
				}else{
					 $reserve_data[0]['pay_limitdate'] = "-- --";
				}
                if($reserve_data[0]['cancel_datetime'] != "0000-00-00 00:00:00")
                {
                    $dt = new DateTime($reserve_data[0]['cancel_datetime']);
                    $reserve_data[0]['cancel_datetime'] = $dt->format("Y年m月d日 H時i分s秒");
                }
                else
                {
                    $reserve_data[0]['cancel_datetime'] = "-- --";
                }
    
    			$repayment_list[$key]['reserve_data'] = $reserve_data[0];
    			$repayment_list[$key]['hall_name'] = get_hall_name($reserve_data[0]['hall_id']);
    			$repayment_list[$key]['room_name'] = get_room_name($reserve_data[0]['hall_id'], $reserve_data[0]['room_id']);
    			$sql = "select * from c_member where c_member_id = ".$reserve_data[0]['c_member_id'];
    			$c_member = db_get_all($sql);
    			$repayment_list[$key]['c_member'] = $c_member[0];
    			// プロフィール
    			$repayment_list[$key]['corp'] = get_profile_value($reserve_data[0]['c_member_id'], 12);
    			// メアド取得
    			$sql = "select pc_address from c_member_secure where c_member_id =".$reserve_data[0]['c_member_id'];
    			$result=db_get_all($sql);
    			$repayment_list[$key]['mail'] = t_decrypt($result[0]['pc_address']);
    
    		}
    	}
    	
        
        $arrayBody = array();
        foreach($repayment_list as $item)
        {
             $reserve_id=$item["reserve_id"];
             $repayment_id =$item["repayment_id"];
             $repayment_money =$item["repayment_money"];
             $body="";   
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
            $body = "$corp\n";
    	    $body.= "$nickname 様\n\n";
        
        	$source = get_c_template_mail_source('m_atoffice_repay');
    	    list($subject, $tmp_body) = explode("\n", $source, 2);
            
            $body.= $tmp_body."\n\r";
    
        	$body.= "**************************************************\n";
        	$body.= "■予約ID：".$reserve_data['reserve_id']."\n";
        	$body.= "■施設名：".get_hall_name($reserve_data['hall_id'])."\n\n";
            //$reserve_data['total'] = $reserve_data['pay_money'] - $reserve_data['total_price'];
        	if($reserve_data['total_price'] < $reserve_data['pay_money'] and $reserve_data['cancel_flag'] == 0){
        		// 過剰入金分
            	//$sql = "update a_reserve_list SET pay_money = pay_money - $repayment_money where reserve_id = $reserve_id";
        		//db_get_all($sql);
            	//$sql = "update a_repayment_list SET flag=1, repayment_datetime=now() where repayment_id = $repayment_id";
        	    //db_get_all($sql);
        		$body.=  "過剰入金分の返金をいたしました。\n";
        		$body.= "■請求総額：".number_format($reserve_data['total_price'])." 円\n";
        	}
            else
            {
        		// キャンセル分
        		//$sql = "update a_repayment_list SET flag=1, repayment_datetime=now() where repayment_id = $repayment_id";
        		//db_get_all($sql);
        		//$body.= "ご利用キャンセルに伴う返金をいたしました。\n";
        		$cancel = get_cancel_price2($reserve_id);
        		$body.= "■キャンセル料金：".number_format($cancel['cancel_price'])."\n";
        	}
        	$body.= "<ご返金内容>\n";
        	$body.= "■お客様ご入金金額：".number_format($reserve_data['pay_money'])." 円\n";
        	$body.= "■今回ご返金金額：".number_format($repayment_money)." 円\n";
        	$body.= "振込人名義：　株式会社アットオフィス\n\n";
        	$body.= "--------------------------------------------------\n";
        	$body.= "<予約者情報>\n";
        	$body.= "■アカウント登録：".$account."\n";
        	$body.= "■お客様ID：".$reserve_data['c_member_id']."\n";
        	$body.= "■仮予約者名：".$nickname." 様\n";
        	$body.= "■法人/団体名：".$corp."\n";
        	$body.= "■住所：".$address."\n";
        	$body.= "■TEL：".get_profile_value($reserve_data['c_member_id'], 17)."\n";
        	$body.= "■E-Mail：".$mail."\n\n";
        
        	$body.= "**************************************************\n";

            $arrayBody[]=array("body" =>$body,'reserve_id'=>$reserve_id,"repayment_id"=>$repayment_id,"repayment_money"=>$repayment_money);
          
       }

 
       $this->set('repayment_list', $repayment_list);
       $this->set('count', count($repayment_list));
       $this->set('arrayBody', $arrayBody);
     
    
        
     

        return 'success';
    }
}

?>
