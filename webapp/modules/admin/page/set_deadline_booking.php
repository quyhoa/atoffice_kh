<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// メール文言更新
class admin_page_set_deadline_booking extends OpenPNE_Action
{
    function execute($requests)
    {
        global $db;
      	// アクセス権限
    	$sql = "select name, atoffice_auth_type from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
    	$result = db_get_all($sql);
    	$this->set('name', $result[0]['name']);
    	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);
     
        if(isset($_POST['hour']) && isset($_POST['minute']))
        {
            $hour=$_POST['hour'];   
            $minute=$_POST['minute']; 
            $sql = "delete from a_reserve_valid";
            $result = db_get_all($sql);
            if($result)
            {
                $sql = "insert into a_reserve_valid (hour, minute) values ('$hour','$minute')";
    	        db_get_all($sql, $db);
            }
        }
        $sql = "select * from a_reserve_valid";
    	$result = db_get_all($sql);
    	$this->set('hour', $result[0]['hour']);
    	$this->set('minute', $result[0]['minute']);
        
        $hours = range(0, 23);
        $minutes = range(0, 59);
        $this->set('hours',$hours);
        $this->set('minutes', $minutes);
      
        return 'success';
        
    }
}

?>
