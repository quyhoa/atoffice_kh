<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 管理用アカウント削除
class admin_do_edit_c_admin_user extends OpenPNE_Action
{
	function handleError($errors)
    {
        admin_client_redirect('edit_c_admin_user', array_shift($errors));
    }
    function execute()
    {
    	$errors = array();
	    if(!$_POST['username_acc']){
	        $errors[] = 'username_acc not null';
	    }
	    if(!$_POST['name_acc']){
	        $errors[] = 'name_acc not_null';
	    }
		if(!$_POST['atoffice_auth_type']){
	        $errors[] = 'atofficeacc not_null';
	    }
	    if ($errors){
	        $this->handleError($errors);
	    }
	    $array1 = array($_POST['ad']);
	    $array2 = array($_POST['ad1']);
	    if($_POST['check_type'] == 3){
	    	$array = $array2;
	    }	  
	    else{
	    	$array = $array1;
	    }  
	    if($array[0]){
	    	$hall_id = implode(",", $array[0]);
		}
		else{
			$hall_id = 0;
		}
	    $type = $_POST['atoffice_auth_type'];
	    $c_admin_user_id = $_POST['c_admin_user_id'];
	    if($type != 3){
	    	$sql = "UPDATE c_admin_user SET username = '".$_POST['username_acc']."', name = '".$_POST['name_acc']."', atoffice_auth_type = ".$type.", hall_id = '0' WHERE c_admin_user_id = ".$c_admin_user_id."";
	    }
	    else	    
	    	$sql = "UPDATE c_admin_user SET username = '".$_POST['username_acc']."', name = '".$_POST['name_acc']."', atoffice_auth_type = ".$type.", hall_id = '".$hall_id."' WHERE c_admin_user_id = ".$c_admin_user_id."";
	    	//var_dump($sql);
	    $result = db_get_all($sql);

	    admin_client_redirect('list_c_admin_user');
    }
}

?>
