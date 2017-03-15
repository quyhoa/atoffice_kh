<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// プロフィール項目追加
class admin_do_consumption_tax_rate extends OpenPNE_Action
{

    function execute($requests)
    {
	//var_dump($_POST);
	//print "<br>";

/// 2013.12.18 消費税改定対応 begin

	$tab = array();					/// 登録すべきデータ
	$msg = "";					/// エラーメッセージ

	$rows = $_POST["rows"];				/// 表示されている行数

	for($ixa = 0; $ixa < $rows; $ixa += 1){
		$rate    = trim($_POST["rate$ixa"]);	/// 消費税率
		$stadate = trim($_POST["stadate$ixa"]);	/// 適用開始日

		if($rate === ""){			/// 消費税率＝空白は削除行
			continue;
		}

		if(! preg_match("/^[0-9]+$/", $rate)){	/// 消費税率は数字
			$msg = "消費税率には数字を入力してください。";
			break;
		}

		if($rate > 50){				/// 消費税率は５０以下
			$msg = "消費税率の値が大きすぎます。";
			break;
		}

		$pat = "|^[0-9]+/[0-9]+/[0-9]+$|";	/// 日付パターン
		if(! preg_match($pat, $stadate)){	/// パターンチェック
			$msg = 3;
			$msg = "適用開始日の書式は「年/月/日」です。";
			break;
		}

		$ymd = explode("/", $stadate."/");	/// 日付分解
		$xyy = $ymd[0];				/// 年
		$xmm = $ymd[1];				/// 月
		$xdd = $ymd[2];				/// 日

		if($xyy < 2000){			/// 年の正当性チェック
			$msg = "適用開始日の年が小さすぎます。";
			break;
		}

		if($xyy > 2099){			/// 年の正当性チェック
			$msg = "適用開始日の年が大きすぎます。";
			break;
		}

		if(! checkdate($xmm, $xdd, $xyy)){	/// 日付の正当性チェック
			$msg = "適用開始日の日付が間違っています。";
			break;
		}

		$sta = sprintf("%04d-%02d-%02d 00:00:00", $xyy, $xmm, $xdd);

		foreach($tab as $key => $val){
			if($val["stadate"] === $sta){	/// 日付の重複チェック
				$msg = "適用開始日が重複しています。";
				break;
			}
		}

		$row = array();				/// 行データ
		$row["rate"]    = $rate;		/// 消費税率
		$row["stadate"] = $sta;			/// 適用開始日
		$tab[] = $row;				/// 登録すべきデータとして追加
	}

	if($msg === ""){				/// エラーなし
		if(count($tab) === 0){			/// 有効な行がない
			$msg = "有効なデータが設定されていません。";
		}
	}

	if($msg === ""){				/// エラーなし
		$sql = "delete from a_tax";		/// 全データ削除
		db_get_all($sql);

		foreach($tab as $row){			/// 行データ追加
			$rate    = $row["rate"];	/// 消費税率
			$stadate = $row["stadate"];	/// 適用開始日
			$sql  = "insert into a_tax(rate, stadate) ";
			$sql .= "values($rate, '$stadate')";
			db_get_all($sql);
		}

		admin_client_redirect("consumption_tax_rate", '消費税率を設定しました。');
	}
	else{
		admin_client_redirect("consumption_tax_rate", $msg);
	}

/// 2013.12.18 消費税改定対応 end

    }
}


?>
