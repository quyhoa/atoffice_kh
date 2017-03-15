<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// スキン画像更新
class admin_do_insert_a_image extends OpenPNE_Action
{
    function handleError($errors)
    {
        admin_client_redirect('hall_image', array_shift($errors));
    }

    function execute($requests)
    {
        $file = $_FILES['upfile'];

	//var_dump($_POST);

	// 削除
	if($_POST['delete_flag']){
		if($_POST['delete_flag']==$_POST['image_id']){

			$sql = "delete from  a_hall_image ";
			$sql.= "where hall_id = ".$_POST['hall_id'];
			$sql.= " and image_id = ".$_POST['image_id'];
			db_get_all($sql);

			admin_client_redirect('hall_image', '画像ファイル'.mb_convert_kana($_POST['image_id'], 'A').'を削除しました'.$_POST['hall_id']);
		}

		admin_client_redirect('hall_image', '画像ファイルを削除しました'.$_POST['hall_id']);
		exit();
	}


        if (empty($file) || $file['error'] === UPLOAD_ERR_NO_FILE) {
            admin_client_redirect('hall_image', '画像ファイルを指定してください'.$_POST['hall_id']);
        }

        if (!t_check_image($file)) {
            admin_client_redirect('edit_c_image', '画像は'.IMAGE_MAX_FILESIZE.'KB以内のGIF・JPEG・PNGにしてください'.$_POST['hall_id']);
        }

        db_image_data_delete($_POST['filename']);
        if (!admin_insert_c_image($_FILES['upfile'], $_POST['filename'])) {
            admin_client_redirect('hall_image', '画像が登録できませんでした'.$_POST['hall_id']);
        }

	// 一旦削除
	$sql = "delete from  a_hall_image ";
	$sql.= "where hall_id = ".$_POST['hall_id'];
	$sql.= " and image_id = ".$_POST['image_id'];
	db_get_all($sql);

	// 登録
	$sql = "insert into a_hall_image (hall_id, image_id, image_filename, title) values (";
	$sql.= $_POST['hall_id'].", ";
	$sql.= $_POST['image_id'].", ";
	$sql.= "'".$_POST['filename']."', ";
	$sql.= "'".$_POST['title']."')";

	//print $sql;
	db_get_all($sql);

        admin_client_redirect('hall_image', '画像'.mb_convert_kana($_POST['image_id'], 'A').'を登録しました'.$_POST['hall_id'], 'filename='.$_POST['filename']);
    }
}

?>
