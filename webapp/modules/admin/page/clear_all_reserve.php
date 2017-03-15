<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class admin_page_clear_all_reserve extends OpenPNE_Action
{
    function execute($requests)
    {
     
        $pre_id=array_keys($_SESSION[$_SESSION['username']]);
        if(!empty($pre_id))
        {
            foreach($pre_id as $key=>$pid)
            {
                $sql = "delete from a_pre_id WHERE pre_id='$pid'";
                db_get_all($sql, $db);
                $sql = "delete from a_pre_reserve where pre_id='$pid'";
                db_get_all($sql, $db);
                $sql = "delete from a_pre_rv where pre_id='$pid'";
                db_get_all($sql, $db);
                $sql = "delete from a_pre_rs where pre_id='$pid'";
                db_get_all($sql, $db);
            }
        }
        unset($_SESSION[$_SESSION['username']]);
         
        return 'success';
    }
}

?>
