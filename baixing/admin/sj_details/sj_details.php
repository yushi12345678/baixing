<?php 

/**
 * 
 */
class sj_details
{
	
	function __construct()
	{
		
		@$data = json_decode($_POST['data']);
		$this->data = [
			'sj_logo'=>"$data[0]",
			'sj_name'=>"$data[1]",
			'sj_jianjie'=>"$data[2]",
			'sj_fuwu'=>"$data[3]",
			'sj_BusinessLicense'=>"$data[4]",
			'sj_BusinessCertificate'=>"$data[5]",
			'sj_LicensingCompany'=>"$data[6]",
			'sj_Awards'=>"$data[7]",
			'sj_address'=>"$data[8]",
			'sj_phone'=>"$data[9]",
			'zhuangtai'=>0
		];             
	}

	function add(){
		require '../DB/DB.php';
		$db = new DB;
		$result = $db->DB_insert($this->data,"bx_sj_details");
		if ($result != false) {
			echo'true';
		}else{
			echo'false';
		}
	}
}

if (isset($_POST['data'])) {
	$sj_details = new sj_details;
	$sj_details->add();
}
 ?>