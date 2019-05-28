<?php 
	include_once '../DB/DB.php';

	/**
	 * 
	 */
	class REGIST
	{
		public $data;
		function __construct()
		{
			$user = $_POST['user'];
			$pwd = $_POST['pwd'];
			$this->data = [
				'user'=>"$user",
				'pwd'=>"$pwd"
			];
		}


		/**
		登录验证
			array  $data
			return bool
		*/

		function regist(){
			
			$db = new DB;
			$result = $db->DB_insert($this->data,"bx_users");
			if ($result != false) {
				echo'true';
			}else{
				echo'false';
			}
		}

	}


	if (isset($_POST['user'])) {
		$r = new REGIST;

		$r->regist();
	}


	
 ?>