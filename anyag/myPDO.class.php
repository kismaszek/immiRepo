<?php 
	
	/**
	* 
	*/
	class myPDO extends PDO
	{
		
		//Adatbázis kapcsolat beállításai
		private $DB_DSN = 'mysql:dbname=wp;host=localhost;charset=utf8';
		private $DB_USER = 'root';
		private $DB_PASS = 'admin';

		//myPDO példány letárolása
		    
		
		public $stmt;
		private $result;
		
		function __construct()
		{
			try {
				parent::__construct($this->DB_DSN, $this->DB_USER, $this->DB_PASS);
				$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
		}

		public function teszt()
		{
			echo 'teszt';
		}

		//MySQL példány beállítása
		public static function getPDO()
		{
			if (!self::$instance) {
				self::$instance = new myPDO();
			}
			return self::$instance;
		}

		public function query($query)
		{
			$this->stmt = parent::query($query);
		}

		public function fetchAll($mode=null)
		{
			//Alapértelmezett mód lecserélése
			if (!$mode) {
				$mode = PDO::FETCH_OBJ;
			}

			$this->result = $this->stmt->fetchAll($mode);
		}

		public function getResult()
		{
			return $this->result;
		}

		public function prepare($stmt)
		{
			$this->stmt = parent::prepare($stmt);
		}

		public function bindValue($param,$data,$opt)
		{
			$this->stmt->bindValue($param,$data,$opt);
		}

		public function execute()
		{
			$this->stmt->execute();
		}

		public function bind($stmt,$param)
		{
			//$this->stmt = parent::prepare($stmt);
			//"SELECT * FROM user WHERE userEmail=:email AND password=:pw"
			//parent::bindValue(':userEmail',$userEmail,PDO::PARAM_STR);	
		}


	}
?>