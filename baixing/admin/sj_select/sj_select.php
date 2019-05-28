<?php 
	require_once '../DB/DB.php';
	/**
	* 
	*/
	class SJ_select
	{
		
		// function __construct(argument)
		// {
			
		// }

		function select(){
			$key = $_POST['fuwu'];
			// $key = $fuwu;
			$db = new DB;
			$result = $db->select_one('bx_sj',"sj_fw='$key' order by sj_jl asc");
			$data = json_encode($result);
			if ($result) {
				echo $data;
				
			}else{
				echo'false';
			}
		}
	}

if (isset($_POST['fuwu'])) {
	$s = new SJ_select;
	$s->select();
}
	

 ?>