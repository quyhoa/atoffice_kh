<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// キャンセルメールフォーム
class admin_page_send_cancel_mail extends OpenPNE_Action
{
    function execute($requests)
    {

	// アクセス権限
	$sql = "select name, atoffice_auth_type from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$this->set('name', $result[0]['name']);
	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);

	$reserve_id=$_REQUEST['reserveid'];
	$cancel = get_cancel_price($reserve_id);

	// 有効な会場一覧
	$sql = "select * from a_hall where flag=0";
	$hall_list = db_get_all($sql);
	if($_REQUEST['hall_list']){
		$hall_id = $_REQUEST['hall_list'];
	}else{
		$hall_id = 0;
	}
	$this->set('hall_list', $hall_list);
	$this->set('hall_id', $hall_id);

	$c_member_id = null;
	$pay_flag = null;
	if($_REQUEST['u']){
		$c_member_id = $_REQUEST['u'];
	}
	$this->set('c_member_id', $c_member_id);

	if($_REQUEST['pay_flag']){
		$pay_flag = $_REQUEST['pay_flag'];
	}
	$this->set('pay_flag', $pay_flag);

	if($_REQUEST['index']){
		$index=$_REQUEST['index'];
	}else{
		$index=0;
	}
	$this->set('index', $index);

	// 検索
	$sql = "select * from a_reserve_list where reserve_id = $reserve_id";
	$result = db_get_all($sql);
	$reserve_data = $result[0];

//	foreach($result as $key=>$value){
		// 会場
		$value['hall_id'] = isset($value['hall_id']) ? $value['hall_id'] : '';
		$sql = "select * from a_hall where hall_id = ".$value['hall_id'];
		$hall_data = db_get_all($sql);
		$reserve_data['hall_data'] = isset($hall_data[0]) ? $hall_data[0] : null;
		// 部屋
		$value['room_id'] = isset($value['room_id']) ? $value['room_id'] : '';
		$sql = "select * from a_room where hall_id = ".$value['hall_id']." and room_id = ".$value['room_id'];
		$room_data = db_get_all($sql);
		$reserve_data['room_data'] = isset($room_data[0]) ? $room_data[0] : null;

		//備品
		$sql = "select * from a_reserve_v where reserve_id =".$reserve_data['reserve_id']." and cancel_flag = 0";
		//echo $sql;
		$reserve_v_list = db_get_all($sql);
		$cancel_vessel_price = 0;
	if($reserve_v_list){
		foreach($reserve_v_list as $k=>$v){
			$vessel_data = get_vessel_data($v['vessel_id']);
			$reserve_v_list[$k]['vessel_name'] = $vessel_data['vessel_name'];
			$reserve_v_list[$k]['memo'] = $vessel_data['memo2'];
			$cancel_vessel_price += $vessel_data['price']*$v['num'];
		}
	}else{
		$reserve_v_list = 0;
	}
		$reserve_data['reserve_v_list'] = $reserve_v_list;

		//サービス
		$sql = "select * from a_reserve_s where reserve_id = ".$reserve_data['reserve_id']." and cancel_flag = 0";
		$reserve_s_list = db_get_all($sql);
		$cancel_service_price = 0;
	if(isset($reserve_s_list)){
		foreach($reserve_s_list as $k=>$v){
			$service_data = get_service_data($v['service_id']);
			$reserve_s_list[$k]['service_name'] = $service_data['service_name'];
			$reserve_s_list[$k]['memo'] = $service_data['memo2'];
			if($service_data['cancel_mode']==1){
				$cancel_service_price += $service_data['price']*$v['num'];
			}
		}
	}else{
		$reserve_s_list = 0;
	}
		$reserve_data['cancel_service_price'] = $cancel_service_price;
		$reserve_data['cancel_vessel_price'] = $cancel_vessel_price;
		$reserve_data['reserve_s_list'] = $reserve_s_list;

		// 会員情報
		$value['c_member_id'] = isset($value['c_member_id']) ? $value['c_member_id'] : '';
		$sql = "select * from c_member where c_member_id = ".$value['c_member_id'];
		$c_member = db_get_all($sql);
		$reserve_data['c_member'] = isset($c_member[0]) ? $c_member[0] : null;
		// プロフィール
		$reserve_data['corp'] = get_profile_value($value['c_member_id'], 12);
		// キャンセル料計算
		$reserve_data['cancel_list'] = isset($value['reserve_id']) ? get_cancel_list($value['reserve_id']) : null;
		// キャンセル料
		$value['room_price'] = isset($value['room_price']) ? $value['room_price'] : 0;
		$reserve_data['cancel_price'] = 0;
		if(isset($key) && isset($result[$key]['cancel_list']['percent'])){
			$reserve_data['cancel_price'] = round(($value['room_price']+$cancel_vessel_price+$cancel_service_price)*($result[$key]['cancel_list']['percent']*0.01));
		}


//------------
$u = $reserve_data['c_member_id'];

//担当者
$sql = "select name, atoffice_auth_type, hall_id from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
$result = db_get_all($sql);
$name = $result[0]['name'];

// メアド取得
$sql = "select pc_address from c_member_secure where c_member_id =".$reserve_data['c_member_id'];
$result=db_get_all($sql);
$mail = t_decrypt($result[0]['pc_address']);

// 名前取得
$sql = "select * from c_member where c_member_id = '$u'";
$nickname = db_get_all($sql);
$nickname = $nickname[0]['nickname'];

$corp = get_profile_value($u, 12);
$address = get_profile_value($u, 3).get_profile_value($u, 14).get_profile_value($u, 15).get_profile_value($u, 16);

$dt = new DateTime($reserve_data['tmp_reserve_datetime']);
$tmp_date = $dt->format("Y年m月d日 H:i");

$dt = new DateTime($reserve_data['begin_datetime']);
$week = get_week($dt->format("Ymd"));
$date_s = $dt->format("Y-m-d");
$date = $dt->format("Y年m月d日");
$date = $date." ".$week."曜日";
$begin = $dt->format("H時i分");
$dt = new DateTime($reserve_data['finish_datetime']);
$finish = $dt->format("H時i分");

$body = "$corp\n";
$body.= "$nickname 様\n\n";

$body.= "下記予約のキャンセルを受け付けました。\n";
$body.= "この変更により、規定のキャンセル料金が発生いたします。\n";
$body.= "内容をご確認ください。\n";
$body.= "ご返金およびご請求が発生する場合は弊社より別途ご連絡させていただきます。\n\n";

$body.= "**************************************************\n";
$body.= "<予約者情報>\n";
$body.= "■お客様ID：".$u."\n";
$body.= "■仮予約者名：".$nickname." 様\n";
$body.= "■法人／団体名：".$corp."\n";
$body.= "■住所：".$address."\n";
$body.= "■TEL：".get_profile_value($u, 17)."\n";
$body.= "■E-Mail：".$mail."\n";
$body.= "■仮予約受付日時：".$tmp_date."\n";
$body.= "■キャンセル受付日時：".date("Y年m月d日 H:i")."\n\n";
$body.= "■ キャンセル料率：".$cancel['percent']."％\n";
if($reserve_data['tmp_flag']==1){
	$body.= "(仮予約のキャンセルは無料です。)\n";
}else{
	if($cancel['before']>0){
		$body.= "(ご利用予定日の".$cancel['before']."日前キャンセルのため)\n";
	}elseif($cancel['before']==0){
		$body.= "(ご利用予定日当日キャンセルのため)\n";
	}elseif($cancel['before']<0){
		$body.= "(ご利用予定日から".($cancel['before']*-1)."日経過後キャンセルのため)\n";
	}
}
$body.= "■キャンセル料金：".number_format($cancel['cancel_price'])." 円\n";
$body.= "■キャンセル特記事項：お客様都合によりキャンセル\n\n";

$body.= "■入金済み金額：".number_format($reserve_data['pay_money'])." 円\n";

	if($reserve_data['pay_money'] > $cancel['cancel_price']){
		// 返金
		$repay = $reserve_data['pay_money'] - $cancel['cancel_price'];

// キャンセル請求テーブルにキャンセル料支払済みとして登録
$billed_money = $cancel['cancel_price'];
$virtual_number = get_virtual_number($reserve_data['c_member_id']);

		$body.="■差額返金額：".number_format($repay)." 円\n\n";

	}elseif($reserve_data['pay_money'] < $cancel['cancel_price'] and $reserve_data['tmp_flag']==0){

		// 請求
		$billed_money = $cancel['cancel_price'] - $reserve_data['pay_money'];
		$virtual_number = get_virtual_number($reserve_data['c_member_id']);

$limitdate = get_business_days(3);

// 3営業日後
$dt = new DateTime($limitdate);
$limit = $dt->format("Y年m月d日");

$virtual = substr($virtual_number, 4, 10);
$branch_id = substr($virtual_number, 0, 3);

$sql = "select * from a_virtual_account_conf where branch_id = '$branch_id'";
$virtual_conf = db_get_all($sql);
$virtual_conf = $virtual_conf[0];

$body.="■キャンセル料金請求金額：".number_format($cancel['cancel_price'])." 円\n";
$body.="■残り：".number_format($billed_money)." 円(税込)\n";
$body.= "■お振込期限　　：　".$limit."\n";
$body.= "■お振込先口座  ：　".$virtual_conf['bank']."　".$virtual_conf['branch']."　普通　".$virtual."\n";
$body.= "■口座名義人　  ：　".$virtual_conf['account']."\n\n";

	}else{

// キャンセル請求テーブルにキャンセル料支払済みとして登録
$billed_money = $cancel['cancel_price'];
$virtual_number = get_virtual_number($reserve_data['c_member_id']);

$body.= "・入金額とキャンセル料金との差額はございません。\n\n";
	}

$body.= "--------------------------------------------------\n";
$body.= "<予約施設情報>\n";
$body.= "■予約ID：".$reserve_id."\n";
$body.= "■施設名：".get_hall_name($reserve_data['hall_id'])."\n";
$body.= "■ご利用目的：仮：".get_purpose_word($reserve_data['purpose'])."\n";
$body.= "■看板表示：".$reserve_data['kanban']."\n";
$body.= "■利用日：".$date."\n";

$body.= "■人数：".$reserve_data['people']."名\n";
$body.= "■部屋名（利用時間）\n";
$body.= "・".get_room_name($reserve_data['hall_id'], $reserve_data['room_id'])."($begin ～ $finish)\n\n";
$body.= "・施設料金：".number_format($reserve_data['room_price'])." 円\n\n";
//echo '<pre>';
//var_dump($reserve_data);
if(isset($reserve_v_list)){
	$body.= "<予約備品情報>\n";
	if(!empty($reserve_v_list)){
		foreach($reserve_v_list as $v){
			$body.= "・".$v['vessel_name']."(数量：".$v['num'].")\n";
		}
	}
	
	$body.= "\n備品料金：".number_format($reserve_data['vessel_price'])." 円\n\n";
}

if(isset($reserve_s_list)){
	$body.= "<予約サービス品情報>\n";
	if(!empty($reserve_s_list)){
		foreach($reserve_s_list as $v){
			$body.= "・".$v['service_name']."(数量：".$v['num'].")\n";
		}
	}
	$body.= "\nサービス品料金：".number_format($reserve_data['service_price'])." 円\n\n";
}

$body.= "\n合計料金：".number_format($reserve_data['total_price'])." 円\n";
$body.= "************************************************\n\n";

	// 変更通知メール
	$source = get_c_template_mail_source('m_atoffice_ao_cancel');
	list($subject, $tmp_body) = explode("\n", $source, 2);

	if(!$subject){
		$subject = "★予約キャンセルを承りました。";
	}

	$subject.= "【".get_hall_name($reserve_data['hall_id'])."/".$date_s."/".$nickname."様】";

	$body.= $tmp_body;

//	put_mail_queue($mail, $subject, $body);
	$sql = "select mailing_list from a_hall where hall_id = ".$reserve_data['hall_id'];
	$ml = db_get_all($sql);
	$ml = $ml[0]['mailing_list'];
	// メーリングリストにも送信
	if($ml){
		$mail.="; $ml";
		//put_mail_queue($ml, $subject, $body);
	}
	$requests=Array();
//var_dump($_REQUEST);
	$requests["mails"]=isset($_REQUEST["mails"])?$_REQUEST["mails"]:$mail;
	$requests["subject"]=isset($_REQUEST["subject"])?$_REQUEST["subject"]:$subject;
	$requests["message"]=isset($_REQUEST["message"])?$_REQUEST["message"]:$body;
	$this->set('requests', $requests);

	$this->set('page',$_REQUEST['page']);

	$this->set('hall_list',$_REQUEST['hall_list']);
	$this->set('u',$_REQUEST['u']);
	$this->set('pay_flag',$_REQUEST['pay_flag']);
	$this->set('index',$_REQUEST['index']);

		$dt = new DateTime($reserve_data['tmp_reserve_datetime']);
		$reserve_data['tmp_reserve_datetime'] = $dt->format("Y年m月d日 H時i分s秒");
		$dt = new DateTime($reserve_data['reserve_datetime']);
		$reserve_data['reserve_datetime'] = $dt->format("Y年m月d日 H時i分s秒");
		$dt = new DateTime($reserve_data['begin_datetime']);
        $week = get_week($dt->format("Ymd"));
		$reserve_data['datetime'] = $dt->format("Y年m月d日(".$week.")");
		$reserve_data['begin_datetime'] = $dt->format("H時i分");
		$dt = new DateTime($reserve_data['finish_datetime']);
		$reserve_data['finish_datetime'] = $dt->format("H時i分");
		$value['pay_checkdate'] = isset($value['pay_checkdate']) ? $value['pay_checkdate'] : null;// add by quyhoa
		$dt = new DateTime($value['pay_checkdate']);
		$reserve_data['pay_checkdate'] = $dt->format("Y年m月d日");
	$this->set('reserve_list', $reserve_data);

//------------

        $v = array();
        $v['SNS_NAME'] = SNS_NAME;
        $this->set($v);

	return 'success';
    }
}

?>
