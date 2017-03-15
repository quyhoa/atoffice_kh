<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// CSVダウンロード

class admin_page_csv_download2 extends OpenPNE_Action
{
    function execute($requests)
    {
	// アクセス権限
	$sql = "select name, atoffice_auth_type, hall_id from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$this->set('name', $result[0]['name']);
	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);

        $v = array();

        $v['SNS_NAME'] = SNS_NAME;
        $v['OPENPNE_VERSION'] = OPENPNE_VERSION;

        $this->set($v);

	// 請求中予約データ取得
	$sql = "select count(*) as reserve_bill from a_reserve_list where tmp_flag=0 and cancel_flag=0 and pay_flag=0 and total_price > pay_money";
	$reserve_bill = db_get_all($sql);
	$reserve_bill = $reserve_bill[0]['reserve_bill'];
	$sql = "select count(*) as etc_bill from a_amount_billed where flag=0 and total_billed_money > pay_money ";
	$etc_bill = db_get_all($sql);
	$etc_bill = $etc_bill[0]['etc_bill'];

	$total_bill = $reserve_bill + $etc_bill;
	$this->set('reserve_bill', $reserve_bill);
	$this->set('etc_bill', $etc_bill);
	$this->set('total_bill', $total_bill);

        return 'success';
    }
}

?>
