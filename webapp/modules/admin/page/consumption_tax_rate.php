<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_page_consumption_tax_rate extends OpenPNE_Action
{
    function execute($requests)
    {

	// アクセス権限
	$sql = "select name, atoffice_auth_type from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$this->set('name', $result[0]['name']);
	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);

/// 2013.12.18 消費税改定対応 begin

	$sql = "select * from a_tax order by stadate";		/// 消費税率テーブル
	$tax = db_get_all($sql);

	$rate    = array();					/// 消費税率
	$stadate = array();					/// 適用開始日
	for($ixa = 0; $ixa < count($tax); $ixa += 1){
		$rate[$ixa]    = $tax[$ixa]['rate'];		/// 消費税率
		$tmp           = $tax[$ixa]['stadate'];		/// 適用開始日
		$stadate[$ixa] = date('Y/m/d', strtotime($tmp));
	}
		$rate[]        = "";				/// 追加行の消費税率
		$stadate[]     = "";				/// 追加行の適用開始日

	$this->set('rate',    $rate);				/// 消費税率
	$this->set('stadate', $stadate);			/// 適用開始日
	$this->set('rows',    count($tax) + 1);			/// 行数

/// 2013.12.18 消費税改定対応 end

        return 'success';
    }
}

?>
