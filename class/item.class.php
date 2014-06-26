<?php
	/**
	* 
	*/
	class item
	{
		public $quantity;
		public $ID;
		public $itemName;
		public $itemPrice;
		public $itemTotal;
		public $itemURL;

		function __construct()
		{
			if ($this->checkQuantity($_POST['quantity'])) {
				//Letárolom a mennyiséget
				$this->quantity = $_POST['quantity'];
				if ($this->productExists()) {
					echo 'létezik';
				}else{
					//nem létező termék
				}
			}else{
				//Hibás mennyiség
			}
		}

		public function productExists(){
			if (filter_input(INPUT_POST, "productID", FILTER_VALIDATE_INT)){
				$pdo = myPDO::getPDO();
				$ID = $_POST['productID'];
				$stmt = $pdo->query("SELECT * FROM products WHERE ID='$ID'");
				//Van ilyen termék?
				if($item = $stmt->fetchAll()){
					//Van készleten?
					if ($item[0]->stock >= $this->quantity) {
						$this->ID = $item[0]->ID;
						$this->itemName = $item[0]->product;
						$this->itemPrice = $item[0]->price;
						$this->itemURL = $item[0]->URL;
						$this->itemTotal = $this->itemPrice * $this->quantity;
						if ($this->isInCart()){
							echo "Már van";
							//Frissítés
							$this->updateItem();
						}else{
							echo "Még nincs";
							//Új tétel a kosárba
							$_SESSION['cart']['items'][$this->ID] = $this;
						}
					}else{
						//nincs készleten							
						echo 'Nincs készleten';
					}
				}
			}
		}

		public function isInCart()
		{
			foreach ($_SESSION['cart']['items'] as $key => $item) {
				if ($key == $this->ID) {
					$van = TRUE;
				}
			}
			return $van;
		}

		//Itt folytatom
		public function updateItem()
		{
			$q = $_SESSION['cart']['items'][$this->ID]->quantity + $this->quantity;
			if($this->checkQuantity($q)){
				$_SESSION['cart']['items'][$this->ID]->quantity = $q;
				$p = $_SESSION['cart']['items'][$this->ID]->itemPrice;
				$_SESSION['cart']['items'][$this->ID]->itemTotal = $p*$q;
			}
		}

		public function checkQuantity($q = null)
		{
			$minQ = 1;
			$maxQ = 100;

			/*
			if (filter_input(INPUT_POST, "quantity", FILTER_VALIDATE_INT)){
				$q = $_POST['quantity'];
				if (($q>=$minQ) && ($q<=$maxQ)) {
					return $q;
				}
			}
			*/

			if ($q){
				if (($q>=$minQ) && ($q<=$maxQ)) {
					return $q;
				}
			}
		}
	}
?>