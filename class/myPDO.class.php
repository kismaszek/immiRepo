<?php
	/**
	* SINGLETON PATTERN
	*/
	class myPDO extends PDO
	{
		
		//Ezek a tulajdonságok a konstruktornak paraméterként is átadhatók
		private $DB_DSN = 'mysql:dbname=weboldal_hu;host=localhost;charset=utf8';
		private $DB_USER = 'root';
		private $DB_PASS = '';

		//Itt tárolom a MySQL kapcsolatot
		private static $instance;

		//MySQL kapcsolat létrehozása
		function __construct()
		{
			try {
				//PDO osztály konstruktorát meghívom
				parent::__construct($this->DB_DSN, $this->DB_USER, $this->DB_PASS);
				//Kivétel kezelés mód bekapcsolása
				$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				//Alapértelmezett adat lekérési mód (objektumba)
				$this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ); 
			} catch (PDOException $e) {
				//Hiba üzenetet lekezelem
				echo $e->getMessage();
			}
		}

		//MySQL példány beállítása
		public static function getPDO()
		{
			//Le van tárolva a MySQL kapcsolat az osztályon belül?
			if (!self::$instance) {
				//Ha nincs akkor meghivom a konstruktort
				self::$instance = new myPDO();
			}
			//Visszaadom a MySQL kapcsolatot a hívónak
			return self::$instance;
		}
	}
?>