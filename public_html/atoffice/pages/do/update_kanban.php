<?php

	require_once("../../at_office_config.php");
	if(!isset($mysql_db)) $mysql_db="at_office";
	require_once 'HTTP.php';

	global $mysql_addr;
	global $port;
	global $user;
	global $pass;

	$db = mysql_connect("$mysql_addr:$port", $user, $pass);
	if ($db == false)
	{
		HTTP::redirect("../../../?page=error");
		exit(1);
	}
	mysql_select_db($mysql_db,$db) or die("sql database select error");

	mysql_query("SET NAMES 'utf8'");

	//var_dump($_POST);

/// 2013.12.21 Á”ïÅ‰ü’è‘Î‰ž begin
//
//	if(!$_REQUEST['PHPSESSID']){
//		HTTP::redirect("../../../?page=error");
//		exit(1);
//	}
//
/// 2013.12.21 Á”ïÅ‰ü’è‘Î‰ž end

	if(preg_match("/^[0-9]+$/", $_POST['reserve_id'])){
		$reserve_id = $_POST['reserve_id'];
	}else{
		HTTP::redirect("../../../?page=error");
	}
	session_start();
	$u = $_SESSION['u'];
	if(!$u){
		print "ƒƒOƒCƒ“‚µ‚Ä‚­‚¾‚³‚¢B";
	}

/*
	$org = mb_internal_encoding();
	mb_internal_encoding("utf8");
	if(mb_strlen($_POST['kanban']) > 14){
		HTTP::redirect("../../../?page=error");
	}
	mb_internal_encoding($org);
*/

	$kanban = $_POST['kanban'];
	$kanban = ereg_replace("'", '\\\'', $kanban);

	//print "$reserve_id<br>";

	$sql = "update a_reserve_list SET kanban = '".mysql_real_escape_string($kanban)."' where reserve_id = '$reserve_id'";

	mysql_query($sql, $db);

	HTTP::redirect("../../../?page=reserved_info");


?>
