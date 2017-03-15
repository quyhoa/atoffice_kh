<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_page_add_hall_confirm extends OpenPNE_Action
{

    function execute($requests)
    {
	//データチェック

	$sql = "select hall_id from a_hall where hall_name = '".$_POST['hall_name']."'";

	if ($_POST['hall_id']){
		$sql.= " and hall_id != ".$_POST['hall_id'];
	}
	$result = db_get_all($sql);

	$errors=array();
	if(!$_POST['hall_name']){
		array_push($errors, '会場名称を入力してください。');
	}elseif($result){
		array_push($errors, 'その会場名は既に使われています。');
	}
	if($_POST['hall_attribute']==""){
		array_push($errors, '会場属性を選択してください。');
	}
	if(!$_POST['cancel_days']){
		array_push($errors, 'キャンセル有効期限を入力してください。');
	}elseif (!preg_match("/^[0-9]+$/", $_POST['cancel_days'])) {
		array_push($errors, 'キャンセル有効期限には半角数字を入力してください。');
	}
	if(!$_POST['rooms']){
		array_push($errors, '総部屋数を入力してください');
	}elseif (!preg_match("/^[0-9]+$/", $_POST['rooms'])) {
		array_push($errors, '総部屋数には半角数字を入力してください。');
	}
	if($_POST['begin']==""){
		array_push($errors, '利用開始時間を選択してください。');
	}
	if($_POST['finish']==""){
		array_push($errors, '利用終了時間を選択してください。');
	}
	if(is_null($_POST['bank_flag'])){
		array_push($errors, '振込方式を選択してください。');
	}
	if(is_null($_POST['kanban'])){
		array_push($errors, '看板出力ルールを選択してください。');
	}
	if(is_null($_POST['web_reserve'])){
		array_push($errors, '予約形態を選択してください。');
	}

	if(!preg_match("/^[0-9]+$/", $_POST['owner_room'])){
		array_push($errors, '部屋収益配分を半角数字で入力してください。');
	}
	if(!preg_match("/^[0-9]+$/", $_POST['owner_vessel'])){
		array_push($errors, '備品収益配分を半角数字で入力してください。');
	}

	if(!$_POST['address_zip']){
		array_push($errors, '住所【郵便番号】を入力してください。');
	}elseif(!preg_match("/^\d{3}\-\d{4}$/", $_POST['address_zip'])){
		array_push($errors, '有効な郵便番号を入力してください。');
	}
	if($_POST['address_prefecture']==""){
		array_push($errors, '住所【都道府県】を選択してください。');
	}
	if(!$_POST['address_city']){
		array_push($errors, '住所【市区町村】を入力してください。');
	}
	if(!$_POST['address_other']){
		array_push($errors, '住所【以下住所】を入力してください。');
	}
	if(!$_POST['telephone']){
		array_push($errors, '住所【電話番号】を入力してください。');
	}elseif(!preg_match("/^\d{2,5}-\d{1,4}-\d{4}$/", $_POST['telephone'])){
		array_push($errors, '有効な電話番号を入力してください。');
	}
	if($_POST['fax'] and !preg_match("/^\d{2,5}-\d{1,4}-\d{4}$/", $_POST['fax'])){
		array_push($errors, '有効なFAX番号を入力してください。');
	}
	if(!$_POST['line1']){
		array_push($errors, '交通【最寄り駅１】【路線名】を入力してください。');
	}
	if(!$_POST['station1']){
		array_push($errors, '交通【最寄り駅１】【駅名】を入力してください。');
	}
	if(!$_POST['transportation1']){
		array_push($errors, '交通【最寄り駅１】【交通手段】を選択してください。');
	}
	if($_POST['time1']==""){
		array_push($errors, '交通【最寄り駅１】【所要時間】を入力してください。');
	}elseif (!preg_match("/^[0-9]+$/", $_POST['time1'])) {
		array_push($errors, '交通【最寄り駅１】【所要時間】には半角数字を入力してください。');
	}
	if($_POST['begin_often'] >= $_POST['finish_often']){
		array_push($errors, 'error time!');
	}
	if($_POST['begin_often'] < $_POST['begin']){
		array_push($errors, 'error time!');
	}
	if($_POST['finish_often'] > $_POST['finish']){
		array_push($errors, 'error time!');
	}
	if(!array($_POST['usedate'])){
		array_push($errors, 'error use day!');
	}
	if($_POST['line2']){
		if(!$_POST['station2']){
			array_push($errors, '交通【最寄り駅２】【駅名】を入力してください。');
		}
		if(!$_POST['transportation2']){
			array_push($errors, '交通【最寄り駅２】【交通手段】を選択してください。');
		}
		if($_POST['time2']==""){
			array_push($errors, '交通【最寄り駅２】【所要時間】を入力してください。');
		}elseif (!preg_match("/^[0-9]+$/", $_POST['time2'])) {
			array_push($errors, '交通【最寄り駅２】【所要時間】には半角数字を入力してください。');
		}
	}elseif($_POST['station2'] or $_POST['transportation2'] or $_POST['time2']){
		array_push($errors, '交通【最寄り駅２】【路線名】を入力してください。');
	}
	if($_POST['line3']){
		if(!$_POST['station3']){
			array_push($errors, '交通【最寄り駅３】【駅名】を入力してください。');
		}
		if(!$_POST['transportation3']){
			array_push($errors, '交通【最寄り駅３】【交通手段】を選択してください。');
		}
		if($_POST['time3']==""){
			array_push($errors, '交通【最寄り駅３】【所要時間】を入力してください。');
		}elseif (!preg_match("/^[0-9]+$/", $_POST['time3'])) {
			array_push($errors, '交通【最寄り駅３】【所要時間】には半角数字を入力してください。');
		}
	}elseif($_POST['station3'] or $_POST['transportation3'] or $_POST['time3']){
		array_push($errors, '交通【最寄り駅３】【路線名】を入力してください。');
	}
    if ($errors) {
        $this->set('errors', $errors);
    }
	if(!$_POST['pulldown']){
		$_POST['pulldown'] = 0;
	}elseif (!preg_match("/^[0-9]+$/", $_POST['pulldown'])) {
		$_POST['pulldown'] = 0;
	}

	$usedate = array($_POST['usedate']);
	$array_check = split(",", $usedate);
	if($_POST['usedate']){
		$arVal = array();
		foreach($usedate[0] as $key=>$val)
		{
			switch ($val) {
				case '1':
					$arVal[] = '平日'; 
					break;
				case '2':
					$arVal[] = '土曜日'; 
					break;
				case '3':
					$arVal[] = '日曜日'; 
					break;
				case '4':
					$arVal[] = '祝日'; 
					break;
				
				
			}
		}
		$usedate_data =  implode(',', $usedate[0]);
		$usedate = implode(',', $arVal);
		
	}
	else{
		$usedate = '';
		$usedate_data = '';
	}
	$a = db_member_c_profile_list();
	$address_list = $a[pre_addr_pref];
	$transportation_list = $a[transportation];
	//var_dump($transportation_list);
	$this->set('profile_list', $address_list);
	$this->set('transportation_list', $transportation_list);
	$this->set('post_data', $_POST);
	$this->set('usedate', $usedate);
	$this->set('usedate_data', $usedate_data);
	//var_dump($_POST);exit;
	$sql = "select value from c_profile_option where c_profile_option_id = ".$_POST['address_prefecture'];
	$result = db_get_all($sql);
	$this->set('prefecture', $result[0]['value']);


	// アクセス権限
	$sql = "select name, atoffice_auth_type from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$this->set('name', $result[0]['name']);
	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);

        return 'success';
    }
}

?>
