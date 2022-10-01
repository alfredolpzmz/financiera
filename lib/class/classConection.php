<?php
	class Mysql
	{
		private $Host=BDserver;

		private $UserName=BDuser;

		private $Password=BDpass;

		private $DbName=BDdatos;

		public  $link;

		public $query;

		public $last_error;

		public $res;

		function __construct() {
			$this->Connect();
		}
		function __destruct() {
			//$this->Close();
		}
		public function Connect() {
			$this->link = mysqli_connect($this->Host, $this->UserName, $this->Password,$this->DbName);
			//$this->link->set_charset("utf8");
			$this->SetError(mysqli_error($this->link));		
		}
		
		public function begTrans() {
			$this->link->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
			$this->SetError(mysqli_error($this->link));
		}

		public function comTrans() {
			$this->link->commit();
			$this->SetError(mysqli_error($this->link));
		}

		public function query($query) {
			return $this->query = mysqli_query($this->link,$query);
			$this->SetError(mysqli_error($this->link));
		}

		// Devuelve el objeto db
		public function getThis() {
			return $this;
		}
		
		public function lastinsertId() {
			return $this->res = mysqli_insert_id($this->link);
			$this->SetError(mysqli_error($this->link));
		}
		
		public function assoc() {
			return mysqli_fetch_assoc($this->query);
			$this->SetError(mysqli_error($this->link));
		}
		
		public function Data() {
			return mysqli_fetch_array($this->query);
			$this->SetError(mysqli_error($this->link));
		}

		public function DataObjet(){
			return mysqli_fetch_object($this->query);
			$this->SetError(mysqli_error($this->link));
		}

		public function rowcount() {
			return mysqli_num_rows($this->query);
			$this->SetError(mysqli_error($this->link));
		}
		
		public function columncount() {
			return mysqli_num_fields($this->query);
			$this->SetError(mysqli_error($this->link));
		}
		
		public function result($index=0) {
			return mysqli_result($this->query,$index);
			$this->SetError(mysqli_error($this->link));
		}
		
		public function free_sql() {
			mysqli_free_result($this->query);
		}
		
		private function SetError($error) {
			$this->last_error=$error;
		}

		public function ShowError() {
			return $this->last_error;
		}

		public function Close() {
			mysqli_close($this->link);
			$this->SetError(mysqli_error($this->link));
		}
	}
?>