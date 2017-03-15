<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class admin_page_clear_reserve extends OpenPNE_Action
{
    function execute($requests)
    {
     
        $pid= $_REQUEST['pid'];
        $sql = "delete from a_pre_id WHERE pre_id='$pid'";
        db_get_all($sql, $db);
        $sql = "delete from a_pre_reserve where pre_id='$pid'";
        db_get_all($sql, $db);
        $sql = "delete from a_pre_rv where pre_id='$pid'";
        db_get_all($sql, $db);
        $sql = "delete from a_pre_rs where pre_id='$pid'";
        db_get_all($sql, $db);
        var_dump($sql);
        return 'success';
    }
}

?>
