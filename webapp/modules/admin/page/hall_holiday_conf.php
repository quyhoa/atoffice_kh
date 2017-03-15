<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_page_hall_holiday_conf extends OpenPNE_Action
{

    function execute($requests)
    {

	// アクセス権限
	$sql = "select name, atoffice_auth_type from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$this->set('name', $result[0]['name']);
	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);

	//var_dump($_REQUEST);

	if(!empty($_GET['msg'])){
		$hall_id = preg_replace("/[^0-9]+/", "", $_GET['msg']);
		$this->set('msg', preg_replace("/[0-9]+/", "", $_GET['msg']));
	}else{
		$hall_id = $_POST['hall_id'];
	}
	$this->set('hall_id', $hall_id);

	// 会場名
	$sql = "select hall_name from a_hall where hall_id = $hall_id";
	$result = db_get_all($sql);
	$result[0]['hall_name'] = isset($result[0]['hall_name']) ? $result[0]['hall_name'] : '';
	$this->set('hall_name', $result[0]['hall_name']);

	// 今日の日付

	if(isset($_POST['target_year']) && $_POST['target_year']){
		if($_POST['target_month']==0){
			$year = $_POST['target_year']-1;
		}elseif(isset($_POST['target_month']) && $_POST['target_month']==13){
			$year = $_POST['target_year']+1;
		}else{
			$year = $_POST['target_year'];
		}
	}else{
		$year = date("Y");
	}
	// if(!is_null($_POST['target_month']) and $_POST['target_year']){
	if(!empty($_POST['target_month']) and $_POST['target_year']){//edit by quyhoa
		if(strval($_POST['target_month'])==0){
			$month = 12;
		}elseif($_POST['target_month']==13){
			$month = 1;
		}else{
			$month = $_POST['target_month'];
		}
	}else{
		$month = date("m");
	}

	$this_year = date("Y");
	$this_month = date("m");
	$today = date("d");
	$this->set('this_year', $this_year);
	$this->set('this_month', $this_month);
	$this->set('today', $today);

	$wtop = date('w',mktime(0,0,0,$month,1,$year));
	$this->set('year', $year);
	$this->set('month', $month);
	$this->set('wtop', $wtop);

	// 過去の指定休日データ削除
	$sql = "delete from a_hall_holiday where hall_id = $hall_id and ";
	$sql.= "(year <= $this_year and month <= $this_month and day < $today)";
	db_get_all($sql);


	// 休日データ取得
	// 定休日
	$sql = "select * from a_hall_regular_holiday where hall_id = $hall_id";

	$regular_data = db_get_all($sql);
	$regular_data[0] = isset($regular_data[0]) ? $regular_data[0] : null;
	$this->set('regular_data', $regular_data[0]);

	// 指定日
	$sql = "select * from a_hall_holiday where hall_id = $hall_id";
	$result = db_get_all($sql);
	$this->set('holiday_list', $result);

	$day_list = array();
	$key=0;
	for($day = 1; checkdate($month, $day, $year); $day++ ){
		$day_list[$key]['day']=$day;
		$day_list[$key]['week']=$wtop;


		// 定休日

		// 会場-月
		if($regular_data[0]['january'] and $month==1){
			$day_list[$key]['holiday']=1;
		}
		if($regular_data[0]['february'] and $month==2){
			$day_list[$key]['holiday']=1;
		}
		if($regular_data[0]['march'] and $month==3){
			$day_list[$key]['holiday']=1;
		}
		if($regular_data[0]['april'] and $month==4){
			$day_list[$key]['holiday']=1;
		}
		if($regular_data[0]['may'] and $month==5){
			$day_list[$key]['holiday']=1;
		}
		if($regular_data[0]['june'] and $month==6){
			$day_list[$key]['holiday']=1;
		}
		if($regular_data[0]['july'] and $month==7){
			$day_list[$key]['holiday']=1;
		}
		if($regular_data[0]['august'] and $month==8){
			$day_list[$key]['holiday']=1;
		}
		if($regular_data[0]['september'] and $month==9){
			$day_list[$key]['holiday']=1;
		}
		if($regular_data[0]['october'] and $month==10){
			$day_list[$key]['holiday']=1;
		}
		if($regular_data[0]['november'] and $month==11){
			$day_list[$key]['holiday']=1;
		}
		if($regular_data[0]['december'] and $month==12){
			$day_list[$key]['holiday']=1;
		}

		// 会場-週

		$week = date('w',mktime(0,0,0,$month,$day,$year));

		if($regular_data[0]['monday'] and $week==1){
			$day_list[$key]['holiday']=1;
		}
		if($regular_data[0]['tuesday'] and $week==2){
			$day_list[$key]['holiday']=1;
		}
		if($regular_data[0]['wednesday'] and $week==3){
			$day_list[$key]['holiday']=1;
		}
		if($regular_data[0]['thursday'] and $week==4){
			$day_list[$key]['holiday']=1;
		}
		if($regular_data[0]['friday'] and $week==5){
			$day_list[$key]['holiday']=1;
		}
		if($regular_data[0]['saturday'] and $week==6){
			$day_list[$key]['holiday']=1;
		}
		if($regular_data[0]['sunday'] and $week==0){
			$day_list[$key]['holiday']=1;
		}

		// 日

		$sql = "select day$day from a_hall_regular_holiday where hall_id = $hall_id";
		$result = db_get_all($sql);
		if(isset($result[0]['day'.$day]) && $result[0]['day'.$day]){
			$day_list[$key]['holiday']=1;
		}

		// 指定日
		$sql = "select * from a_hall_holiday where hall_id = $hall_id and year = $year and month = $month and day = $day";
		$result = db_get_all($sql);
		if(isset($result[0]['hall_id']) && $result[0]['hall_id']){
			$day_list[$key]['holiday']=1;
		}

		// 選択月の祝日
		$sql = "select * from c_holiday where month = $month and day = $day";
		$result = db_get_all($sql);
		if(isset($result[0]) && $result[0]){
			$day_list[$key]['holiday_jp']=$result[0];
			if($regular_data[0]['holiday']){
				$day_list[$key]['holiday']=1;
			}
		}

		$key++;
		$wtop++;
		if($wtop>6){
			$wtop=0;
		}
	}
	$this->set('day_list', $day_list);

	// 日付指定個数(50)
	$holiday_num_list=array();
	for($x=1; $x<51; $x++){
		array_push($holiday_num_list, $x);
	}
	$this->set('holiday_num_list', $holiday_num_list);





        return 'success';
    }
}

?>
