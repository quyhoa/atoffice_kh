<?php
if(isset($_REQUEST['m']) && $_REQUEST['m'] !='admin' && session_status() == PHP_SESSION_NONE)
{

	@session_start();
}
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */
require_once './config.inc.php';
require_once OPENPNE_WEBAPP_DIR . '/init.inc';

openpne_execute();

?>
