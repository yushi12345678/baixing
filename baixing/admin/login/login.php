<?php 
	require_once '../DB/DB.php';

	if (isset($_POST['data'])) {
		$l = new Login;
		
		$l->DB_login();
	}

	/**
	 * 
	 */
	class Login
	{
		public $data;

		/**
		登录验证
			array  $data
			return bool
		*/
		
		function DB_login(){
			$data = json_decode($_POST['data']);
			
			$this->data = [
				'user'=>$data[0],
				'pwd'=>$data[1]
			];
			if (empty($this->data['user'])) {
				echo "用户名为空";die;
			}
			if (empty($this->data['pwd'])) {
				echo "密码为空";die;
			}

			$key = $this->data['user'];
			$db = new DB;
			$result = $db->select_one('bx_users',"user='$key'");
			

			if ($result['pwd'] == $this->data['pwd']) {
				echo "true";
				
			}else{
				echo "false";
			}
		}

	}


	

	
 ?>