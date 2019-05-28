<?php 
	/**
	 * 
	 */
	header("Content-type:text/html; charset=utf-8");
 
	define('DB_HOST', '127.0.0.1');
	define('DB_USER', 'root');
	define('DB_PWD', 'root');
	define('DB_NAME', 'baixing');
	define('DB_charset', 'utf-8');
	class DB
	{
		public $dbhost;
		public $dbuser;
		public $dbpwd;
		public $dbbase;
		public $dbcharset;

		function __construct(){
			$this->dbhost = DB_HOST;
			$this->dbuser = DB_USER;
			$this->dbpwd = DB_PWD;
			$this->dbbase = DB_NAME;
			$this->dbcharset = DB_charset;
		}

		
		function DB_connect(){
			$link = mysqli_connect($this->dbhost,$this->dbuser,$this->dbpwd) or die("连接数据库失败").mysqli_error();
			mysqli_set_charset($link,$this->dbcharset);
			mysqli_select_db($link,$this->dbbase);

			return $link;
			
		}

		/**
		增加数据库
		@param array $data            
        @param string $table            
        @return boolean
		*/

		function DB_insert($data,$table){
			$link = $this->DB_connect();
			$keys = join(',',array_keys($data));
			$vals = "'" . join("','", array_values($data)) . "'";
         	$query = "INSERT INTO {$table}({$keys}) VALUES({$vals})";
          // echo $query;
         	$result = mysqli_query($link, $query) or die('插入数据出错，请检查！<br />ERROR ' . mysqli_errno($link) . ':' . mysqli_error($link));

	         if ($result) {
	             $id = mysqli_insert_id($link);
	         } else {
	             $id = false;
	         }

	         mysqli_close($link);

	         return $id;
			}

		/**
     	删除数据
      	
      	@param string $table            
      	@param string $where            
      	@return boolean
      	*/

		function DB_delect($table,$where){
			$link = $this->DB_connect();
			$query = "DELECT from {$table} where {$where}";
			$result = mysqli_query($link,$query);

			if ($result) {
				$id = mysqli_affected_rows($result);
			}else{
				$id = false;
			}

			return $id;
		}

		/**
       修改数据
      *
      * @param array $data            
      * @param string $table            
      * @param string $where            
      * @return boolean
      */
     public function update($data, $table, $where = null)
        {
         $link = $this->DB_connect();
         $set = '';
         foreach ($data as $key => $val) {
             $set .= "{$key}='{$val}',";
         }
         $set = trim($set, ',');
         $query = "UPDATE {$table} SET {$set}"."where"."{$where}";
         $result = mysqli_query($link, $query) or die('数据修改错误，请检查！<br />ERROR ' . mysqli_errno($link) . ':' . mysqli_error($link));
         if ($result) {
             $row = mysqli_affected_rows($link);
         } else {
             $row = false;
         }
         mysqli_close($link);
         return $row;
     }
 
     /**
       查询指定记录
      *
      * @param string $table  
      * @param string $where            
      * @param string $result_type            
      * @return array|boolean
      */
     public function select_one($table,$where, $result_type = MYSQLI_ASSOC)
     {
         $link = $this->DB_connect();
         $query = "SELECT * from {$table} where {$where}";
         // print($query);
         $result = mysqli_query($link, $query) or die('false');

         if ($result && mysqli_num_rows($result) > 0) {
             // $row = mysqli_fetch_array($result, $result_type);
             while ($row = mysqli_fetch_array($result, $result_type)) {
                 $rows[] = $row;
             }
         } else {
             $rows = false;
         }
         mysqli_free_result($result);
         mysqli_close($link);
         return $rows;
     }
 
     /**
       查询所有记录
      *
      * @param string $table            
      * @param string $result_type            
      * @return array|boolean
      */
     public function select_all($table, $result_type = MYSQLI_ASSOC)
     {
         $link = $this->DB_connect();
         $query = "SELECT * FROM {$table}";
         $result = mysqli_query($link, $query) or die('查询语句错误，请检查！<br />ERROR ' . mysqli_errno($link) . ':' . mysqli_error($link));
         if ($result && mysqli_num_rows($result) > 0) {
             while ($row = mysqli_fetch_array($result, $result_type)) {
                 $rows[] = $row;
             }
         } else {
             $rows = false;
         }
         mysqli_free_result($result);
         mysqli_close($link);
         return $rows;
     }
 
     /**
      得到表中记录数
      *
      * @param string $table            
      * @return number|boolean
      */
     public function get_total_rows($table)
     {
         $link = $this->DB_connect();
         $query = "SELECT COUNT(*) AS totalRows FROM {$table}";
         $result = mysqli_query($link, $query);
         if ($result && mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
         } else {
            $row['totalRows'] = false;
         }
	      	mysqli_close($link);
         	return $row['totalRows'];
     }


	}

?>