<?php 
	include_once '../DB/DB.php';
	$data['user'] = 'admin'; 
	$key = $data['user'];
	$db = new DB;
	$result =  $db->select_one("bx_users","user='$key'");

	var_dump($result);
 ?>