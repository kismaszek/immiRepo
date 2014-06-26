<?php
	/*
	Ez a felhasználó osztályom 
	*/
	class user
	{		
		//PROPERTIES - Tulajdonságok
		protected $userID;
		public $userEmail;
		public $userName;
		public $firstName;
		public $lastName;
		public $billingAddresses;
		public $deliveryAddresses;

		//TAGFÜGGVÉNYEIK, Metódusaik

		//A konstruktor automatikusan lefut
		//Ha egy új USER objektumot hozok létre
		function __construct()
		{
			$this->init();
		}


		//Felhasználó inicializálása
		public function init()
		{
			$this->userID = 0;
			$this->userName = 'guest';
			$this->userEmail = 'not set yet';
			$_SESSION['user'] = $this;
		}

		public function listAddress($addressType)
		{
			$pdo = MyPDO::getPDO();
			$stmt = $pdo->query("SELECT * FROM address WHERE userID = '$this->userID' AND addressType ='$addressType'");
			if ($addresses = $stmt->fetchAll()) {
				echo '<form method="POST" action="" name="'.$addressType.'Form">';
				echo '<select name="'.$addressType.'Address" onchange="'.$addressType.'Form.submit()">';
				echo '<option value="0">Kérjük válasszon szállítási címet!</option>';
				foreach ($addresses as $key => $a) {
					$option = $a->CountryCode.' '.$a->Zip.' '.$a->City.' '.$a->Street;
					echo'<option ';
					if ($_SESSION[$addressType.'Address'] == $a->ID){
						echo 'selected="selected"';
					}
					echo ' value="'.$a->ID.'">'.$option.'</option>';
				}
				echo '</select></form>';
			}

		}

		public function listPaymentMethods()
		{
			$pdo = MyPDO::getPDO();
			$stmt = $pdo->query("SELECT * FROM paymentMethod");
			if ($paymentMethods = $stmt->fetchAll()) {
				echo '<h2>Kérjük válasszon fizetési módot!</h2>';
				echo '<form method="POST" action="" name="paymentForm">';
				foreach ($paymentMethods as $key => $paymentMethod) {
					echo'<div class="radio"><input type="radio" onchange="paymentForm.submit()" name="paymentMethod"';
					if ($_SESSION['paymentMethod'] == $paymentMethod->ID){
						echo 'checked="checked"';
					}
					echo ' value="'.$paymentMethod->ID.'"><span>'.$paymentMethod->payment.'</span></div>';
				}
				echo '</form>';
			}

		}

		public function userLogin()
		{
			//$email = $_POST['email'];
			//$pw = $_POST['password'];

			//Beviteli mezők meglétének, változó típusának (POST) szűrése
			if (filter_has_var(INPUT_POST, "login") &&
				filter_has_var(INPUT_POST, "email") &&
				filter_has_var(INPUT_POST, "password")){
				
				if (filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL) &&
					filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING)) {
					
					//MySQL példány lekérése
					$pdo = myPDO::getPDO();

					//SQL lekérdezés 
					$sql = "SELECT * FROM user WHERE email=:email AND password=:password";

					//Előkészítés (PDOStatement típusú objektumot kapok vissza)
					$stmt = $pdo->prepare($sql);

					//Paraméterekhez (place holder) társítom a változókat ($_POST)
					$stmt->bindValue(':email',$_POST['email'],PDO::PARAM_STR);
					$stmt->bindValue(':password',$_POST['password'],PDO::PARAM_STR);

					//Futtatom a lekérdezést
					try {
						$stmt->execute();
					} catch (PDOException $e) {
						echo 'GÁZ VAN: '.$e->getMessage();
					}

					//Eredmény lekérése
					if($user = $stmt->fetchAll()){
						$this->firstName = $user[0]->firstName;
						$this->lastName = $user[0]->lastName;
						$this->rights = $user[0]->rights;
						$this->userEmail = $user[0]->email;
						$this->userID = $user[0]->ID;
						$this->getAddresses("billing");
						$this->getAddresses("delivery");
					}else{
						//Nincs ilyen felhasználó
					}

				}else{
					//Nem megfelelő adatok
				}

			}else{
				//Betörési kísérlet?
			}
		}

		public function getAddresses($addressType)
		{
			$pdo = MyPDO::getPDO();
			$stmt = $pdo->query("SELECT * FROM address WHERE userID = '$this->userID' AND addressType ='$addressType'");
			if ($addresses = $stmt->fetchAll()) {
				foreach ($addresses as $key => $a) {
					$address[$a->ID] = $a->CountryCode.' '.$a->Zip.' '.$a->City.' '.$a->Street;
				}
				$this->{$addressType.'Addresses'} = $address;
			}
		}

		public function userLogout()
		{
			$this->init();
		}

		//Lekérő (getter) fügvény
		function getUserID()
		{
			return $this->userID;
		}

		//Beállító (setter) függvény
		function setUserID($userID)
		{
			$this->userID = $userID;
		}
	}
?>