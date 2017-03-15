<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// アカウント管理
class admin_page_list_c_customer_stt extends OpenPNE_Action
{
    function execute($requests)
    {
	/* number of page*/
	$limit = 100;
 // アクセス権限
		if(!empty($_POST)){
			$index= (isset($_POST['ok']))?0:$_POST['page_num'];    				
			$ok = true;
	    	$dBeginRequest = $_POST['date1'];	   	  	    	
	    	$dFinishRequest = $_POST['date2'];
	    	$dBeginDefault = $_POST['date3'];	    		
	    	$dFinishDefault = $_POST['date4'];	    	 
	    	$flag = 0;  
	    	if(empty($_POST['c2']) || $_POST['c2'] == ''){
	    		$dBeginRequests = '';
	    		$dFinishRequest = '';	    		
	    	}	    	
	    	else{
	    		$dBeginRequests = $dBeginRequest." 00:00:00";
	    		$dFinishRequest = $dFinishRequest." 23:59:59";	    		
	    	}	    	
	    	if(empty($_POST['c3']) || $_POST['c3'] == ''){
	    		$dBeginDefault  = '';
	    		$dFinishDefault = '';	    		
	    	}	   
	    	else{
	    		$dBeginDefault  = $dBeginDefault." 00:00:00";
	    		$dFinishDefault = $dFinishDefault." 23:59:59";	    		
	    	} 
	    	if(strtotime($dBeginRequests) > strtotime($dFinishRequest) || strtotime($dBeginDefault) > strtotime($dFinishDefault)){
	    		$flag = 0;
	    	}
	    	else{
	    		$flag = 1;
	    	}

	    	if($flag == 0){
	    		$error = 'error';
	    		$this->set("error", $error);
	    	}	
	    	else{	  
		 		$sql = " FROM a_rental_stop where true ";			 		
		 		if(isset($_POST['c1']) && $_POST['c1'] == '0'){
		 			$sql.= " AND  flag = '1'";	
		 			$this->set('check', '有効期限なし'); 			 			
		 		}
		 		if(isset($_POST['c2']) && $_POST['c2'] == '1'){
		 						
		 			$sql.= " AND flag = '0' AND limit_datetime >= '".$dBeginRequests."' AND limit_datetime <= '".$dFinishRequest."' ";
		 			$dBeginRequests = substr($dBeginRequests, 0,10);	 
		 			$this->set('dBeginRequests', $dBeginRequests);
		 			$dFinishRequest = substr($dFinishRequest, 0,10);	
	    			$this->set('dFinishRequest', $dFinishRequest);	    			
		 		}	
		 		if(isset($_POST['c3']) && $_POST['c3'] == '2'){
		 			$sql.= " AND begin_datetime >= '".$dBeginDefault."' AND finish_datetime <= '".$dFinishDefault."' ";
		 		
		 			$dBeginDefault = substr($dBeginDefault, 0,10);
		 			$this->set('dBeginDefault', $dBeginDefault);
		 			$dFinishDefault = substr($dFinishDefault, 0,10);
	    			$this->set('dFinishDefault', $dFinishDefault);	
		 		}
		 		$sql.= "GROUP BY hall_id,room_id,user_date,created_date order by stop_id";			 		
				$sql1 = "SELECT *,min(begin_datetime) as begin_time, max(finish_datetime) as finish_time ,DATE_FORMAT(begin_datetime,'%Y-%m-%d') as user_date " .$sql." limit $index,$limit";
				$result = db_get_all($sql1);
				$number = db_get_all("SELECT *,min(begin_datetime) as begin_time, max(finish_datetime) as finish_time ,DATE_FORMAT(begin_datetime,'%Y-%m-%d') as user_date  $sql");
				$num_page = (!empty($number))?count($number):0;
				$page_list = get_page_list($index, $num_page, $limit, 30);
				foreach ($result as $key => $value){			 			
	    			$sql = "SELECT hall_name FROM a_hall where hall_id = ".$value['hall_id'];			
		 			$hall_name = db_get_all($sql);	
		 			$this->set("hall_name",$hall_name);		
		 			$result[$key]['hall_name']	= $hall_name[0]['hall_name'];	

		 			$sql = "SELECT room_name FROM a_room where room_id = ".$value['room_id'] ." AND hall_id = ".$value['hall_id'];			
		 			$room_name = db_get_all($sql);	
		 			$this->set("room_name",$room_name);		
		 			$result[$key]['room_name']	= $room_name[0]['room_name'];

		 			$time_stop = strstr($value['finish_time'], " ");	
		 			$time_start = strstr($value['begin_time'], " ");	
		 			$result[$key]['time_stop']	= substr($time_start, 0, 6)."～".substr($time_stop, 0, 6);	
		 			$created_date = substr($value['created_date'], 0, 10);
		 			$result[$key]['created_date']	= $created_date; 			
		 			$result[$key]['limit_datetime']	= substr($result[$key]['limit_datetime'], 0, 10);
		 			$result[$key]['begin_datetime']	= substr($result[$key]['begin_datetime'], 0, 10);
	    		}
	    		$this->set('page_num',count($page_list));
				$this->set('page_list', $page_list);
	    		$this->set('result', $result);
		    	$this->set('dBeginRequest', $dBeginRequest);
		    	$this->set('ok', $ok);
		    	$this->set('begin_limit', $_POST['date1']);
		    	$this->set('end_limit', $_POST['date2']);
		    	$this->set('begin_time', $_POST['date3']);
		    	$this->set('finish_time', $_POST['date4']);
	    	}
    	}
    	
    	$date_current = null;   		
    	$date_year_ago = null;
    	if(!isset($_POST["ok"])){
    		$date_current = date("Y-m-d");   		
    		$date_year_ago = date("Y-m-d");
    	}
    	$this->set('date_current', $date_current);
    	$this->set('date_year_ago', $date_year_ago);
	 	$sql = "select hall_id, name, atoffice_auth_type from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
		$result = db_get_all($sql);
		$this->set('name', $result[0]['name']);
		$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);
		$list = db_admin_c_admin_user_list();
		 
		foreach($list as $key=>$value){
			if($value['hall_id']){
			    $hall_ids = $value['hall_id'];
			    $sql = "SET SESSION group_concat_max_len = 1000000";
			    $result = db_get_all($sql);
			 	$sql = "select GROUP_CONCAT(hall_name) AS hall_names, 1 AS id_temp from a_hall where hall_id IN($hall_ids) GROUP BY id_temp";
			    $result = db_get_all($sql);
			    $list[$key]['hall_name'] = $result[0]['hall_names'];  			
			}
		} 
		$this->set('user_list', $list);
		return 'success';


	}
}
?>
