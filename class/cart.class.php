<?php
/**
* 
*/
	class cart
	{
		public $creationDate;
		public $password = "PacoDeLucia";

		function __construct()
		{
			$this->cartInit();
		}

		public function cartInit()
		{
			$this->creationDate = time();
			$_SESSION[cart][info] = array();
			$_SESSION[cart][items] = array();
			$_SESSION[cart][obj] = $this;
			$_SESSION[billingAddress] = 0;
			$_SESSION[paymentMethod] = 0;
			$_SESSION[deliveryAddress] = 0;
		}
	
		public function listCart()
		{
			if ($_SESSION['cart']['items']) {
				foreach ($_SESSION['cart']['items'] as $key => $item) {
	 					echo '<div class="product">
	                    <figure>
	                        <img src="product/termek-1.jpg">
	                        <figcaption>Képaláírás</figcaption>
	                        <span>'.$item->itemPrice.' Ft</span>
	                    </figure>
	                    <div>
	                        <h2>'.$item->itemName.'</h2>
	                    </div>
	                </div>';
				}
			}
		}
	
		public function placeOrder()
		{

			if (filter_has_var(INPUT_POST, "placeOrder")){
				//User belépett?
				if ($_SESSION['user']->getUserID()) {
					//Kosár tartalma?
					if ($_SESSION['cart']['items']) {
						if ($_SESSION['deliveryAddress'] && 
							$_SESSION['billingAddress'] &&
							$_SESSION['paymentMethod']) {
							
							$userID = $_SESSION['user']->getUserID();
							$deliveryAddress = $_SESSION['deliveryAddress'];
							$billingAddress = $_SESSION['billingAddress'];
							$paymentMethod = $_SESSION['paymentMethod'];

							//Kosár előkészítése
							$items = $_SESSION['cart']['items'];
							$cart = base64_encode(serialize($items));

							$orderDate = time();
							$cartDate = $this->creationDate;

							//Rendelés leadása
							$pdo = MyPDO::getPDO();
							$pdo->query("INSERT INTO orders (userID,deliveryAddress,billingAddress,paymentMethod,cart,orderDate,cartDate) 
								VALUES('$userID','$deliveryAddress','$billingAddress','$paymentMethod','$cart','$orderDate','$cartDate')");

							$this->orderID =  $pdo->lastInsertId();


							//Email küldése a felhasználónak, no és persze nekem!
							require 'class/phpmailer/PHPMailerAutoload.php';

							$mail = new PHPMailer;

							$mail->isSMTP();                                      // Set mailer to use SMTP
							$mail->Host = 'smtp.gmail.com';  					  // Specify main and backup SMTP servers
							$mail->SMTPAuth = true;                               // Enable SMTP authentication
							$mail->Username = 'dr.ambrus.laszlo@gmail.com';       // SMTP username
							$mail->Password = $this->password;                    // SMTP password
							$mail->SMTPSecure = 'ssl';                            // Enable encryption, 'ssl' also accepted
							$mail->Port = '465';
							$mail->CharSet = 'utf-8';

							$mail->From = 'info@mywebshop.com';
							$mail->FromName = 'myWebshop';
							$mail->addAddress('dr.ambrus.laszlo@gmail.com', 'Ambrus László');     // Add a recipient
							//$mail->addAddress('ellen@example.com');               // Name is optional
							//$mail->addReplyTo('info@example.com', 'Information');
							//$mail->addCC('cc@example.com');
							//$mail->addBCC('bcc@example.com');

							$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
							//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
							//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
							$mail->isHTML(true);                                  // Set email format to HTML

							$mail->Subject = 'Visszaigazolás megrendelésről';
							$mail->Body = $this->HTMLBody();
							//echo $this->HTMLBody();
							$mail->AltBody = strip_tags($mail->MsgHTML);

							if(!$mail->send()) {
							    echo 'Message could not be sent.';
							    echo 'Mailer Error: ' . $mail->ErrorInfo;
							} else {
							    echo 'Message has been sent';
							    //Kosár ürítése
								$this->cartInit();
							}
						}
					}
				}
			}
		}
	
		public function HTMLBody()
		{
			$HTML = '';
			$HTML.= '<div><h1>Megrendelés visszaigazolása</h1>';
			$HTML.= '<h2>Tisztelt '.$_SESSION['user']->lastName.' '.$_SESSION['user']->firstName.'!</h2>
					 <h3>Köszönjük, hogy igénybe vette szolgáltatásunkat. Az Ön rendelésének adatai:</h3>';
			
			$HTML.= '<h3>Az Ön rendelésének azonosítója: '.$this->orderID.'</h3>';
			$HTML.=	 '<table border="0" cellpadding="10" width="100%">
						<thead> 
							<tr>
								<th style="background-color:#666; color:#FFF;">Azonosító</th>
								<th style="background-color:#666; color:#FFF;">Termék</th>
								<th style="background-color:#666; color:#FFF;">Mennyiség</th>
								<th style="background-color:#666; color:#FFF;">Nettó DB ár</th>
								<th style="background-color:#666; color:#FFF;">Nettó összes</th>
							</tr>
						</thead>
						<tbody>';
			
			$totalNET = '';
			$totalBRUTTO = '';
			foreach ($_SESSION[cart][items] as $key => $item){
				$totalNET+=$item->itemTotal;
				$HTML.='<tr>
					<td style="background-color:#EEE; color:#666;">'.$item->ID.'</td>
					<td style="background-color:#EEE; color:#666;">'.$item->itemName.'</td>
					<td style="background-color:#EEE; color:#666;">'.$item->quantity.'</td>
					<td style="background-color:#EEE; color:#666;">'.$item->itemPrice.'</td>
					<td style="background-color:#EEE; color:#666;">'.$item->itemTotal.'</td></tr>';
			}

			$totalBRUTTO = $totalNET * 1.27;

			$HTML.= '<tr><td colspan="3">&nbsp;</td>
						<td style="background-color:#666; color:#FFF;">Össesen Nettó</td>
						<td style="background-color:#EEE; color:#666;">'.$totalNET.'</td></tr>';

			$HTML.= '<tr><td colspan="3">&nbsp;</td>
						<td style="background-color:#000; color:#FFF;">Bruttó összes</td>
						<td style="background-color:#EEE; color:#F00;">'.$totalBRUTTO.'</td></tr>';
		
			$HTML.='</tbody>
					<tfoot>
						<tr><td colspan="5" style="background-color:#666; color:#FFF;">Valamilyen plussz üzenet!</td></tr>
					</tfoot>
					</table>';
			
			$HTML.= '<h3>Szállítási cím: '.$_SESSION['user']->deliveryAddresses[$_SESSION['deliveryAddress']].'</h3>';

			$HTML.= '<h3>Számlázási cím: '.$_SESSION['user']->billingAddresses[$_SESSION['billingAddress']].'</h3>';

			$HTML.='<p>Amennyiben megrendelésével kapcsolatban kérdése van, kérjük hívja Ügyfélszolgálatunkat: </p>
						<p>Üdvözlettel: Az xy Webshop csapata.</p>
			</div>';
			
			return $HTML;
		}
	}
?>

