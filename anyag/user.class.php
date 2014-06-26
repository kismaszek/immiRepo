<?php 
	/**
	* 
	*/
	class user
	{
		protected $userID;
		protected $userName;
		protected $userEmail;

		function __construct()
		{
			$this->init();
		}

		protected function init()
		{
			$this->userID = 0;
			$this->userName = 'Guest';
			$this->userEmail = '';
			$_SESSION['user'] = $this;
		}

		public function getUserName()
		{
			return $this->userName;
		}

		//Felhasználó bejelentkezése
		public function userLogin()
		{
			if ($_SERVER["REQUEST_METHOD"] == "POST"){
				if (filter_has_var(INPUT_POST, 'email') 
					&& filter_has_var(INPUT_POST, 'pw')){
					$email = $_POST['email'];
					$pw = $_POST['pw'];
					
					$email = trim($email);
					$pw = trim($pw);
					
					echo $email;
					echo $pw;

					if (!empty($email) && !empty($pw)){
						//Van ilyen felhasználó?
						
						//MySQL kapcsolat GLOBALS-on keresztül
						/*
						echo gettype($pdo);
						$GLOBALS['pdo']->prepare("SELECT * FROM user WHERE userEmail=:email AND password=:pw");
						$GLOBALS['pdo']->bindValue(':email',$email,PDO::PARAM_STR);
						$GLOBALS['pdo']->bindValue(':pw',$pw,PDO::PARAM_STR);
						try {
							$GLOBALS['pdo']->execute();
						} catch (PDOException $e) {
							echo $e->getMessage();
						}
						$GLOBALS['pdo']->fetchAll();
						$result = $GLOBALS['pdo']->getResult();
						echo '<pre>';
						print_r($result);
						echo '</pre>';
						*/

						/* SINGLETON PATTERN */
						
						$DB_DSN = 'mysql:dbname=wp;host=localhost;charset=utf8';
						$DB_USER = 'root';
						$DB_PASS = 'admin';
						
						//Statikus hívás
						//$pdo = myPDO::getPDO($DB_DSN,$DB_USER,$DB_PASS);
						$pdo = myPDO::getPDO();
						$pdo->teszt();
						$pdo->prepare("SELECT * FROM user WHERE userEmail=:email AND password=:pw");
						$pdo->bindValue(':email',$email,PDO::PARAM_STR);
						$pdo->bindValue(':pw',$pw,PDO::PARAM_STR);
						try {
							/* ROW COUNT 0-át ad vissza!!! */
							//echo $pdo->stmt->rowCount();
							$pdo->execute();
						} catch (PDOException $e) {
							echo $e->getMessage();
						}
						$pdo->fetchAll();
						$result = $pdo->getResult();
						$result = $result[0];
						echo $result->userName;
						echo '<pre>';
						print_r($result);
						echo '</pre>';


					}else{
						echo 'Minden mező kitöltése kötelező';
					}
				}
			}else{
				//Ha nem POST-al jönnek az adatok
			}

		}
	
	}
?>