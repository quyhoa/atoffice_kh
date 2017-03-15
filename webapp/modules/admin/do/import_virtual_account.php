<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// メンバー情報一括登録
class admin_do_import_virtual_account extends OpenPNE_Action
{
    function handleError($msg)
    {
        admin_client_redirect('import_virtual_account', $msg);
    }

    function execute($requests)
    {

        $member_file = $_FILES['virtual_file'];

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

        $row = 0;
        $count = 0;

        while (($data = fgetcsv($handle, 4096)) !== false && $row <= $limit) {
		$row++;
		if($data[0]==2){
			$sql = "delete from a_virtual_account_list where seq_number = ".$data[5];
			db_get_all($sql);
			$virtual = $data[1].$data[2].$data[3];
			$sql = "insert into a_virtual_account_list (virtual_number, seq_number, kotei) values ('".$virtual."', ".$data[5].", 1)";
			db_get_all($sql);
			$count++;
		}

        }


        admin_client_redirect('import_virtual_account', "{$count}件のインポートが完了しました");
    }

}

?>
