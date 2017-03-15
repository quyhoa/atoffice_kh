<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_page_hall_image extends OpenPNE_Action
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

	//会場名取得
	$sql = "select hall_name from a_hall where hall_id = $hall_id";
	$result = db_get_all($sql);
	$result[0]['hall_name'] = isset($result[0]['hall_name']) ? $result[0]['hall_name'] : '';
	$this->set('hall_name', $result[0]['hall_name']);

	// 画像データ取得
	$sql = "select * from a_hall_image where hall_id = $hall_id order by image_id";
	$result = db_get_all($sql);
	//var_dump($result);
	$image_data = array();
	for($x=0;$x<20;$x++){
		foreach($result as $value){
			if($value['image_id']==$x+1){
				$image_data[$x]['image_filename']=$value['image_filename'];
				break;
			}
		}
	}
	$this->set('image_data', $image_data);

	// 画像数（20）
	$image_list = array();
	$image_x_size = array(270, 300, 88, 600, 88, 600, 88, 600, 88, 600, 88, 600, 88, 600, 88, 600, 88, 600, 88, 600);
	$image_y_size = array(360, 309, 66, 450, 66, 450, 66, 450, 66, 450, 66, 450, 66, 450, 66, 450, 66, 450, 66, 450);
	$image_use = array(
			'メイン画像',
			'地図',
			'紹介１縮小',
			'紹介１拡大',
			'紹介２縮小',
			'紹介２拡大',
			'紹介３縮小',
			'紹介３拡大',
			'紹介４縮小',
			'紹介４拡大',
			'紹介５縮小',
			'紹介５拡大',
			'紹介６縮小',
			'紹介６拡大',
			'紹介７縮小',
			'紹介７拡大',
			'紹介８縮小',
			'紹介８拡大',
			'紹介９縮小',
			'紹介９拡大',
			);
	for($x=0; $x<20; $x++){
		$image_list[$x]['num']=$x+1;
		$image_list[$x]['x']=$image_x_size[$x];
		$image_list[$x]['y']=$image_y_size[$x];
		$image_list[$x]['use']=$image_use[$x];
	}


	$this->set('image_list', $image_list);

        return 'success';
    }
}

?>
