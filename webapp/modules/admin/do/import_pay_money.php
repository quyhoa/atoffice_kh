<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// メンバー情報一括登録
class admin_do_import_pay_money extends OpenPNE_Action
{
    function handleError($msg)
    {
        admin_client_redirect('import_pay_money', $msg);
    }

    function execute($requests)
    {

        $member_file = $_FILES['member_file'];

        $limit = 1000;  // 行数制限

        if (empty($member_file) || $member_file['error'] === UPLOAD_ERR_NO_FILE) {
            $this->handleError('ファイルを指定してください');
        }

        $filename_parts = explode('.', $member_file['name']);
        if (array_pop($filename_parts) != 'csv') {
            $this->handleError('拡張子は.csvにしてください');
        }

        $handle = fopen($member_file['tmp_name'], 'r');

        if (($data = fgetcsv($handle, 4096)) === false) {
            $this->handleError('ファイルの内容が空です');
        }

/*
        $required_list = array('bill_id', 'c_member_id', 'branch_id', 'type', 'virtual_code', 'pay_money');
        if (OPENPNE_AUTH_MODE == 'pneid') {
            $required_list[] = 'login_id';
        }
        foreach ($required_list as $required) {
            if (!in_array($required, $data)) {
                $this->handleError('1行目: ' . $required . 'は必須項目です');
            }
        }
*/


        $row = 1; // 1行目がタイトル行
        $count = 0; // メンバー登録に成功した数
    	$under = 0; // 一部入金数
    	$equal = 0; // 正常入金
    	$uper = 0; // 過剰入金数

        while (($data = fgetcsv($handle, 4096)) !== false && $row <= $limit) {
            $row++;

		$bill_id = $data[0];
		if(!preg_match("/^[0-9]+$/", $bill_id)){
			$this->handleError("{$row}行目【中断】：請求番号が半角数字ではありません。");
		}
		if(!preg_match("/^[0-9]{10}+$/", $bill_id)){
			$this->handleError("{$row}行目【中断】：bill_idは10文字が正しくありません。");
		}
		$u = $data[1];
		if(!preg_match("/^[0-9]+$/", $u)){
			$this->handleError("{$row}行目【中断】：取引先コードが半角数字ではありません。");
		}
		$branch_id = $data[2];
		if(!preg_match("/^[0-9]+$/", $branch_id)){
			$this->handleError("{$row}行目【中断】：仮想支店番号が半角数字ではありません。");
		}
		$type = $data[3];
		if(!preg_match("/^[0-9]+$/", $type)){
			$this->handleError("{$row}行目【中断】：口座科目が半角数字ではありません。");
		}
		$virtual_code = $data[4];
		if(!preg_match("/^[0-9]+$/", $virtual_code)){
			$this->handleError("{$row}行目【中断】：バーチャル口座番号が半角数字ではありません。");
		}
		$pay_money = $data[5];
		if(!preg_match("/^[0-9]+$/", $pay_money)){
			$this->handleError("{$row}行目【中断】：入金額が半角数字ではありません。");
		}
		$pay_checkdate = $data[6];
		if(!preg_match("/^[0-9]+$/", $pay_money)){
			$this->handleError("{$row}行目【中断】：入金日が半角数字ではありません。");
		}

		$pcd = substr($pay_checkdate, 0, 4)."年".substr($pay_checkdate, 4, 2)."月".substr($pay_checkdate, 6, 2)."日";


		$virtual_number = $branch_id.$type.$virtual_code;

		$sql = "select * from a_bill_id where bill_id = '$bill_id'";
		$id = db_get_all($sql);
		$id = $id[0];

		if($id['reserve_id']){
			$reserve_id = $id['reserve_id'];
			$billed_id = 0;
		}elseif($id['billed_id']){
			$reserve_id = 0;
			$billed_id = $id['billed_id'];
		}

		// 確認
		if(!$reserve_id and !$billed_id){
			$this->handleError("{$row}行目【中断】：請求番号に対応する予約ID、または請求IDが見つかりませんでした。");
		}
		if($reserve_id){
			// 部屋予約入金
			$sql = "select * from a_reserve_list where reserve_id = '$reserve_id'";
			$reserve_data = db_get_all($sql);
			$reserve_data = $reserve_data[0];
			if(!$reserve_data){
				$this->handleError("{$row}行目【中断】：予約ID{$reserve_id}が見つかりませんでした。");
			}
			if($reserve_data['cancel_flag']==1){
				$this->handleError("{$row}行目【中断】：キャンセルした予約ID{$reserve_id}に対して、入金しています。");
			}
			if($reserve_data['pay_flag']==1){
				$this->handleError("{$row}行目【中断】：入金済みになっている予約ID{$reserve_id}に対しての入金です。");
			}
			if($reserve_data['virtual_code']!=$virtual_number){
				$this->handleError("{$row}行目【中断】：予約ID{$reserve_id}のデータととCSVファイルでバーチャル口座番号が一致しませんでした。");
			}

			$sql = "select * from a_virtual_account_list where virtual_number = '$virtual_number'";
			$va_data = db_get_all($sql);
			$va_data = $va_data[0];
			if(!$va_data){
				$this->handleError("{$row}行目【中断】：バーチャル口座番号{$virtual_number}が見つかりませんでした。");
			}
			if($va_data['flag']==0){
				$this->handleError("{$row}行目【中断】：バーチャル口座番号{$virtual_number}は利用中の口座番号ではありません。");
			}
			if($va_data['c_member_id']!=$u){
				$this->handleError("{$row}行目【中断】：バーチャル口座番号{$virtual_number}の利用顧客IDとCSVの取引先コードが一致しませんでした。");
			}
			// 更新

			if($reserve_data['total_price'] > $pay_money + $reserve_data['pay_money']){
				// 一部入金の場合、新規請求番号に更新
				$new_bill_id = get_bill_id($reserve_id, 0);
				if(!new_bill_id){
					$this->handleError("{$row}行目【中断】：一部入金のデータで新しい請求番号が発行できませんでした。");
				}
			}

			$sql = "update a_reserve_list SET ";
			$sql.= "pay_money = pay_money + '$pay_money', ";
			$sql.= "pay_checkdate = '".$pay_checkdate."' ";
			if($reserve_data['total_price'] <= $pay_money + $reserve_data['pay_money']){
				$sql.= ", pay_flag = '1' ";
			}
			if($reserve_data['total_price'] > $pay_money + $reserve_data['pay_money']){
				$sql.= ", bill_id = '$new_bill_id' ";
				// 一部入金・支払期日延長
				$new_limitdate = get_business_days(2);
				$sql.= ", pay_limitdate = '$new_limitdate' ";

			}
			$sql.= "where reserve_id = '$reserve_id'";
			//print "$sql<br>";
			db_get_all($sql);

			// 口座利用中を閉じるか
			if($reserve_data['total_price'] <= $pay_money + $reserve_data['pay_money']){
				$check = check_virtual_code($virtual_number, $reserve_id);
				if($check==0){
					$sql = "update a_virtual_account_list SET flag = '0' where virtual_number = '$virtual_number'";
					db_get_all($sql);
				}
			}
////////////////////////////////////////////////////////////////////////////
// メール
// メアド
$sql = "select pc_address from c_member_secure where c_member_id = $u";
$mail = db_get_all($sql);
$mail = t_decrypt($mail[0]['pc_address']);

$sql = "select * from c_member where c_member_id = '$u'";
$nickname = db_get_all($sql);
$nickname = $nickname[0]['nickname'];

$dt = new DateTime($reserve_data['begin_datetime']);
$week = get_week($dt->format("Ymd"));
$date_s = $dt->format("Y-m-d");
$date = $dt->format("Y年m月d日");
$date = $date." ".$week."曜日";
$begin = $dt->format("H時i分");

$dt = new DateTime($reserve_data['finish_datetime']);
$finish = $dt->format("H時i分");

$corp = get_profile_value($u, 12);

// 返金メール
$body = "$corp\n";
$body.= "$nickname 様\n\n";

$body.= "ご利用いただきありがとうございます。\n\n";

$body.= "以下の通り、入金を確認いたしました。\n\n";
//$body.= "※アカウント登録がお済みのお客様は、ログイン後に請求書及び領収書の自動出力が可能です。\n";
//$body.= "請求書・領収書の自動出力はこちら( ".$_SESSION["_authsession"]["data"]["OPENPNE_URL"]." )\n";
//$body.= "（※一部入金の場合は入金済みになるまで領収書印刷ができません。）\n\n";


$body.= "■ご入金日：　".$pcd."\n";
$body.= "■ご請求金額：　".number_format($reserve_data['total_price'])."円（税込）\n";
$body.= "■今回お振り込み金額：　".number_format($pay_money)."円\n";
$body.= "■ご入金総額：　".number_format($pay_money + $reserve_data['pay_money'])."円\n";
$body.= "■過不足額：　".number_format(($pay_money + $reserve_data['pay_money']) - $reserve_data['total_price'])."円\n\n";
$body.= "■状態：　";
if($reserve_data['total_price'] > $pay_money + $reserve_data['pay_money']){
	$body.="一部入金\n\n";

	// 振り込み期限
	$body.= "※不足額は下記口座にお振込みください。\n";
	$dt = new DateTime($new_limitdate);
	$body.= "■次回お振り込み期限：　".$dt->format("Y年m月d日")."\n";
	// 振り込み先
	$virtual_code = $reserve_data['virtual_code'];
	$branch_code = substr($virtual_code, 0, 3);
	$virtual_code = substr($virtual_code, 4, 10);
	$sql = "select * from a_virtual_account_conf where branch_id = '$branch_code'";
	$bank_data = db_get_all($sql, $db);
	$bank_data = $bank_data[0];

	$body.= "■お振り込み先口座：　".$bank_data['bank']."　".$bank_data['branch']."　(支店番号：".$branch_code."）　口座番号：（普通）".$virtual_code."\n";
	$body.= "■口座名義人：　株式会社アットオフィス\n\n";


}elseif($reserve_data['total_price'] == $pay_money + $reserve_data['pay_money']){
	$body.="入金済み\n\n";
}elseif($reserve_data['total_price'] < $pay_money + $reserve_data['pay_money']){	$body.="入金済み\n";
	$body.="・入金額が請求額よりも多かったため、後ほど返金いたします。\n\n";
}

	// アカウント情報
	$sql = "select * from c_member where c_member_id = ".$reserve_data['c_member_id'];
	$c_member = db_get_all($sql);
	$c_member = $c_member[0];

	$body.= "************************************************\n";

	if($c_member['guest_flag']){
		$body.= "■アカウント登録：　ゲスト\n";
	}else{
		$body.= "■アカウント登録：　会員\n";
	}
	$body.= "■お客様ID：　".$reserve_data['c_member_id']."\n\n";
	$body.= "<ご予約内容>";
	$body.= "■予約ID：　".$reserve_data['reserve_id']."\n";
	$body.= "■施設名：　".get_hall_name($reserve_data['hall_id'])."\n";
	$body.= "■ご利用目的：　".get_purpose_word($reserve_data['purpose'])."\n";
	$body.= "■看板表示：\n";
	$body.= $reserve_data['kanban']."\n";
    $body.= "■利用日：".$date."\n";
	$body.= "■人数：　".$reserve_data['people']."\n";
	$body.= "■部屋名(利用時間)\n";
	$dtb = new DateTime($reserve_data['begin_datetime']);
	$dtf = new DateTime($reserve_data['finish_datetime']);
	$body.= "・".get_room_name($reserve_data['hall_id'], $reserve_data['room_id'])."（".$dtb->format("H:i")."～".$dtf->format("H:i")."）\n";
	$body.= "■施設利用料金：　".number_format($reserve_data['room_price'])."円\n";
	$body.= "■備品料金：　".number_format($reserve_data['vessel_price'])."円\n";
	// 備品取得
	$sql = "select * from a_reserve_v where reserve_id = ".$reserve_data['reserve_id'];
	$vessel_list = db_get_all($sql);
	foreach($vessel_list as $value){
		$body.= "・".get_vessel_name($value['vessel_id'])."（".$value['num']."個）\n";
	}

	$body.= "■サービス品料金：　".number_format($reserve_data['service_price'])."円\n";
	// サービス取得
	$sql = "select * from a_reserve_s where reserve_id = ".$reserve_data['reserve_id'];
	$service_list = db_get_all($sql);
	foreach($service_list as $value){
		$body.= "・".get_service_name($value['service_id'])."（".$value['num']."個）\n";
	}
	$body.= "■合計料金：　".number_format($reserve_data['total_price'])."円\n";
	$body.= "■メッセージ：\n";
	$body.= $reserve_data['message']."\n";

	$body.= "************************************************\n\n";

$source = get_c_template_mail_source('m_atoffice_paid');
list($subject, $tmp_body) = explode("\n", $source, 2);

if(!$subject){
	$subject = "ご入金を確認いたしました。";
}

$subject.= "【".get_hall_name($reserve_data['hall_id'])."/".$date_s."/".$nickname."様】";

$body.= $tmp_body;

// 規約URL追加
$sql = "select * from a_hall where hall_id = ".$reserve_data['hall_id'];
$hall_data = db_get_all($sql);
$body.= "\n【利用規約】\n".$hall_data[0]['kiyaku_url']."\n";

put_mail_queue($mail, $subject, $body);

$sql = "select mailing_list from a_hall where hall_id = ".$reserve_data['hall_id'];
$ml = db_get_all($sql);
$ml = $ml[0]['mailing_list'];
// メーリングリストにも送信
if($ml){
	put_mail_queue($ml, $subject, $body);
}

///////////////////////////////////////////////////////////////////////////

			// 返金あり
			if($reserve_data['total_price'] < $pay_money + $reserve_data['pay_money']){ 
				$repayment_money = ($pay_money + $reserve_data['pay_money']) - $reserve_data['total_price'];
				$sql = "insert into a_repayment_list (reserve_id, repayment_money, info, add_datetime) values ('$reserve_id', '$repayment_money', '入金過多のため', now())";
				db_get_all($sql);
				$uper++;
			}elseif($reserve_data['total_price'] == $pay_money + $reserve_data['pay_money']){
				$equal++;
			}elseif($reserve_data['total_price'] > $pay_money + $reserve_data['pay_money']){
				$under++;
			}

		}else{
			// キャンセル請求入金　確認
			$sql = "select * from a_amount_billed where billed_id = '$billed_id'";
			$ab_data = db_get_all($sql);
			$ab_data = $ab_data[0];
			if(!$ab_data){
				$this->handleError("{$row}行目【中断】：請求ID{$billed_id}が見つかりませんでした。");
			}
			if($ab_data['flag']==1){
				$this->handleError("{$row}行目【中断】：入金済みになっている請求ID{$billed_id}に対しての入金です。");
			}
			if($ab_data['virtual_code']!=$virtual_number){
				$this->handleError("{$row}行目【中断】：請求ID{$billed_id}のデータととCSVファイルでバーチャル口座番号が一致しませんでした。");
			}

			$sql = "select * from a_virtual_account_list where virtual_number = '$virtual_number'";
			$va_data = db_get_all($sql);
			$va_data = $va_data[0];
			if(!$va_data){
				$this->handleError("{$row}行目【中断】：バーチャル口座番号{$virtual_number}が見つかりませんでした。");
			}
			if($va_data['flag']==0){
				$this->handleError("{$row}行目【中断】：バーチャル口座番号{$virtual_number}は利用中の口座番号ではありません。");
			}
			if($va_data['c_member_id']!=$u){
				$this->handleError("{$row}行目【中断】：バーチャル口座番号{$virtual_number}の利用顧客IDとCSVの取引先コードが一致しませんでした。");
			}

			if($ab_data['total_billed_money'] > $pay_money + $ab_data['pay_money']){
				// 一部入金の場合、新規請求番号に更新
				$new_bill_id = get_bill_id(0, $billed_id);
				if(!$new_bill_id){
					$this->handleError("{$row}行目【中断】：一部入金のデータで新しい請求番号が発行できませんでした。");
				}
			}


			// 更新
			$sql = "update a_amount_billed SET ";
			$sql.= "pay_money = pay_money + '$pay_money', ";
			$sql.= "check_datetime = '".$pay_checkdate."' ";
			if($ab_data['total_billed_money'] <= $pay_money + $ab_data['pay_money']){
				$sql.= ", flag = '1' ";
			}
			if($ab_data['total_billed_money'] > $pay_money + $ab_data['pay_money']){
				$sql.= ", bill_id = '$new_bill_id' ";
				// 一部入金・支払期日延長
				$new_limitdate = get_business_days(2);
				$sql.= ", pay_limitdate = '$new_limitdate' ";

			}
			$sql.= "where billed_id = '$billed_id'";
			//print "$sql<br>";
			db_get_all($sql);

			// 口座利用中を閉じるか
			if($ab_data['total_billed_money'] <= $pay_money + $ab_data['pay_money']){
				$check = check_virtual_code($virtual_number, $reserve_id);
				if($check==0){
					$sql = "update a_virtual_account_list SET flag = '0' where virtual_number = '$virtual_number'";
					db_get_all($sql);
				}
			}

////////////////////////////////////////////////////////////////////////////
// メール
// メアド
$sql = "select pc_address from c_member_secure where c_member_id = $u";
$mail = db_get_all($sql);
$mail = t_decrypt($mail[0]['pc_address']);

$sql = "select * from a_reserve_list where reserve_id = ".$ab_data['reserve_id'];
db_get_all($sql);
$reserve_data = db_get_all($sql);
$reserve_data = $reserve_data[0];

$sql = "select * from c_member where c_member_id = '$u'";
$nickname = db_get_all($sql);
$nickname = $nickname[0]['nickname'];

$dt = new DateTime($reserve_data['finish_datetime']);
$finish = $dt->format("H時i分");

$corp = get_profile_value($u, 12);

// 返金メール

$body = "$corp\n";
$body.= "$nickname 様\n\n";

$body.= "ご利用いただきありがとうございます。\n\n";

$body.= "以下の通り、入金を確認いたしました。\n\n";
//$body.= "※アカウント登録がお済みのお客様は、ログイン後に請求書及び領収書の自動出力が可能です。。\n";
//$body.= "請求書・領収書の自動出力はこちら( ".$_SESSION["_authsession"]["data"]["OPENPNE_URL"]." )\n";
//$body.= "（※一部入金の場合は入金済みになるまで領収書印刷ができません。）\n\n";

$body.= "■ご入金日：　".$pcd."\n";
$body.= "■ご請求金額(キャンセル料金)：　".number_format($ab_data['total_billed_money'])."円\n";
$body.= "■今回お振り込み金額：　".number_format($pay_money)."円\n";
$body.= "■ご入金総額：　".number_format($pay_money + $ab_data['pay_money'])."円\n";
$body.= "■過不足額：　".number_format(($pay_money + $ab_data['pay_money']) - $ab_data['total_billed_money'])."円\n\n";

$body.= "■状態：　";
if($ab_data['total_billed_money'] > $pay_money + $ab_data['pay_money']){
	$body.="一部入金\n\n";

	// 振り込み期限
	$body.= "※不足額は下記口座にお振込みください。\n";
	$dt = new DateTime($new_limitdate);
	$body.= "■次回お振り込み期限：　".$dt->format("Y年m月d日")."\n";
	// 振り込み先
	$virtual_code = $ab_data['virtual_code'];
	$branch_code = substr($virtual_code, 0, 3);
	$virtual_code = substr($virtual_code, 4, 10);
	$sql = "select * from a_virtual_account_conf where branch_id = '$branch_code'";
	$bank_data = db_get_all($sql, $db);
	$bank_data = $bank_data[0];

	$body.= "■お振り込み先口座：　".$bank_data['bank']."　".$bank_data['branch']."　(支店番号：".$branch_code."）　口座番号：（普通）".$virtual_code."\n";
	$body.= "■口座名義人：　株式会社アットオフィス\n\n";


}elseif($ab_data['total_billed_money'] == $pay_money + $ab_data['pay_money']){
	$body.="入金済み\n\n";
}elseif($ab_data['total_billed_money'] < $pay_money + $ab_data['pay_money']){	$body.="入金済み\n";
	$body.="・入金額が請求額よりも多かったため、後ほど返金いたします。\n\n";
}

	// キャンセル済み予約データ取得
	$sql = "select * from a_reserve_list where reserve_id = ".$ab_data['reserve_id'];
	$reserve_data = db_get_all($sql);
	$reserve_data = $reserve_data[0];

	// アカウント情報
	$sql = "select * from c_member where c_member_id = ".$reserve_data['c_member_id'];
	$c_member = db_get_all($sql);
	$c_member = $c_member[0];

	$body.= "************************************************\n";

	if($c_member['guest_flag']){
		$body.= "■アカウント登録：　ゲスト\n";
	}else{
		$body.= "■アカウント登録：　会員\n";
	}

	$body.= "■お客様ID：　".$reserve_data['c_member_id']."\n\n";
	$body.= "<キャンセルをしたご予約内容>\n";
	$body.= "■予約ID：　".$reserve_data['reserve_id']."\n";
	$body.= "■施設名：　".get_hall_name($reserve_data['hall_id'])."\n";
	$body.= "■ご利用目的：　".get_purpose_word($reserve_data['purpose'])."\n";
	$body.= "■看板表示：\n";
	$body.= $reserve_data['kanban']."\n";
	$body.= "■人数：　".$reserve_data['people']."\n";
	$body.= "■部屋名(利用時間)\n";
	$dtb = new DateTime($reserve_data['begin_datetime']);
	$dtf = new DateTime($reserve_data['finish_datetime']);
	$body.= "・".get_room_name($reserve_data['hall_id'], $reserve_data['room_id'])."（".$dtb->format("H:i")."～".$dtf->format("H:i")."）\n";
	$body.= "■施設利用料金：　".number_format($reserve_data['room_price'])."円\n";
	$body.= "■備品料金：　".number_format($reserve_data['vessel_price'])."円\n";
	// 備品取得
	$sql = "select * from a_reserve_v where reserve_id = ".$reserve_data['reserve_id'];
	$vessel_list = db_get_all($sql);
	foreach($vessel_list as $value){
		$body.= "・".get_vessel_name($value['vessel_id'])."（".$value['num']."個）\n";
	}

	$body.= "■サービス品料金：　".number_format($reserve_data['service_price'])."円\n";
	// サービス取得
	$sql = "select * from a_reserve_s where reserve_id = ".$reserve_data['reserve_id'];
	$service_list = db_get_all($sql);
	foreach($service_list as $value){
		$body.= "・".get_service_name($value['service_id'])."（".$value['num']."個）\n";
	}
	$body.= "■合計料金：　".number_format($reserve_data['total_price'])."円\n";
	$body.= "■メッセージ：\n";
	$body.= $reserve_data['message']."\n";

	$body.= "************************************************\n";

$source = get_c_template_mail_source('m_atoffice_paid');
list($subject, $tmp_body) = explode("\n", $source, 2);

if(!$subject){
	$subject = "ご入金を確認いたしました。";
}
$subject.= "【".$corp."/".$nickname."様(お客様ID：".$u.")】";


$body.= $tmp_body;

// 規約URL追加
$sql = "select * from a_hall where hall_id = ".$reserve_data['hall_id'];
$hall_data = db_get_all($sql);
$body.= "\n【利用規約】\n".$hall_data[0]['kiyaku_url']."\n";

put_mail_queue($mail, $subject, $body);

// メーリングリスト取得
$sql = "select hall_id from a_reserve_list where reserve_id = ".$ab_data['reserve_id'];
$hall_id = db_get_all($sql);
$hall_id = $hall_id[0]['hall_id'];
$sql = "select mailing_list from a_hall where hall_id = '$hall_id'";
$ml = db_get_all($sql);
$ml = $ml[0]['mailing_list'];
// メーリングリストにも送信
if($ml){
	put_mail_queue($ml, $subject, $body);
}


///////////////////////////////////////////////////////////////////////////

			// 返金あり
			if($ab_data['total_billed_money'] < $pay_money + $ab_data['pay_money']){
				$repayment_money = ($pay_money + $ab_data['pay_money']) - $ab_data['total_billed_money'];
				$sql = "insert into a_repayment_list (reserve_id, repayment_money, info, add_datetime) values ('".$ab_data['reserve_id']."', '$repayment_money', '入金過多のため', now())";
				db_get_all($sql);
				$uper++;
			}elseif($ab_data['total_billed_money'] == $pay_money + $ab_data['pay_money']){
				$equal++;
			}elseif($ab_data['total_billed_money'] > $pay_money + $ab_data['pay_money']){
				$under++;
			}
		}





            $count++;
        }

        fclose($handle);

        admin_client_redirect('import_pay_money', "{$count}件の入金が完了しました。《ぴったり入金：{$equal}件　一部入金：{$under}件　過剰入金：{$uper}件》");
    }

}

?>
